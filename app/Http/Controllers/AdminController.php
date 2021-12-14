<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\User;
use App\general_notary_assignment;
use App\real_state_closing;
use App\tax_closing_assignment;
use App\process_server_assignment;
use App\AssignmentAssignTo;
use App\Assignment_message;
use App\Assignment_upload;
use App\Invoice;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

use Mail;
use App\Mail\NewMemberMail;


use App\Mail\AssignmentAssignedToNotary;
use App\Mail\InvoiceSendToClient;



class AdminController extends Controller
{
    
    public function client_business_update(Request $request, $client_id)
    {


        $user = User::findOrFail($client_id);
        $user->contact_first_name = $request->input('contact_first_name');
        $user->email = $request->input('email');
        $user->contact_last_name = $request->input('contact_last_name');
        $user->contact_email_address = $request->input('contact_email_address');
        $user->contact_telephone_number = $request->input('contact_telephone_number');
        $user->contact_mailing_address = $request->input('contact_mailing_address');

        $user->company_name = $request->input('company_name');
        $user->contact_fax_number = $request->input('contact_fax_number');
        $user->cheque_payable_to = $request->input('cheque_payable_to');



        $user->save();

        return back();
    }


    public function client_profile_data_and_assignments($user_id){




        $general_notary_assignment  = general_notary_assignment::where('client_id', $user_id)->get();
        $real_state_closing         = real_state_closing::where('client_id', $user_id)->get();
        $tax_closing_assignment     = tax_closing_assignment::where('client_id', $user_id)->get();
        $process_server_assignment  = process_server_assignment::where('client_id', $user_id)->get();


        return view('admins.all.client_details_notaries', compact('general_notary_assignment', 'real_state_closing', 'tax_closing_assignment', 'process_server_assignment'));


    }

    public function general_notary_hash($hash){

        $users = User::count();
        $data = general_notary_assignment::where([['hash', $hash]])->first();



            if(request()->segment(3) == 'process-server'){
                $get_role_id = 4;            }

            if(request()->segment(3) != 'process-server'){
                $get_role_id = 3;
            }


            $contractors2 = DB::table('contractor_zips')
                ->join('users', 'users.id', '=', 'contractor_zips.user_id')
                ->join('roles_connect','roles_connect.user_id','=','users.id')
                ->where([['contractor_zips.status', 1], ['roles_connect.role_id', $get_role_id]]);

            if(request()->state || request()->city || request()->zip){
                if(request()->state && DB::table('contractor_zips')->where('state', request()->state)->exists()){
                    $contractors2->where('contractor_zips.state', request()->state);
                }elseif(request()->city && DB::table('contractor_zips')->where('city', request()->city)->exists()){
                    $contractors2->where('contractor_zips.city', request()->city);
                }elseif(request()->zip && DB::table('contractor_zips')->where('zip', request()->zip)->exists()){
                    $contractors2->where('contractor_zips.zip', request()->zip);
                }else{
                    $contractors2->where('contractor_zips.zip', '3456ygfddfghgf');
                }
            }


            $contractors = $contractors2->select('users.*', 'contractor_zips.state','contractor_zips.city','contractor_zips.zip', 'roles_connect.role_id')->get();

           

        $messages = DB::table('assignment_messages')
        	->join('users', 'assignment_messages.message_from', '=', 'users.id')
        	->where('assignment_messages.hash', $hash)
        	->get();

        $files = DB::table('assignment_uploads')
        	->join('users', 'assignment_uploads.message_from', '=', 'users.id')
        	->where('assignment_uploads.hash', $hash)
        	->get();


        //dd($messages);
        $widget = [
            'users' => $users,
        ];


        return view('admins.all.general_notary_single', compact('widget', 'data', 'contractors', 'messages','files'));

    }


    public function general_notary_all(Request $req, $status){


        //dd($req);

        if($req->do == 'delete' && DB::table('general_notary_assignments')->where('hash', $req->for)->exists()){
            general_notary_assignment::where('hash', $req->for)->delete();
            Assignment_message::where('hash', $req->for)->delete();
            Assignment_upload::where('hash', $req->for)->delete();
            AssignmentAssignTo::where('assignment_hash', $req->for)->delete();
            return redirect('/admin/view-assignments/'.request()->segment(3).'/'.request()->segment(4).'?status=success&for=assignment_deleted');
        }


        $users = User::count();
        $datas = general_notary_assignment::where('status', Self::getStatus($status))->orderBy('status', 'ASC')->get();

        $widget = [
            'users' => $users,
        ];

        return view('admins.all.general_notary', compact('widget', 'datas'));

    }







    public function AllAssignmentsByType($assignment_type){


        //dd($req);
        $status = 0;
        if($assignment_type == 'pending'){
            $status = 0;
        }elseif($assignment_type == 'assigned'){
            $status = 2;
        }elseif($assignment_type == 'scheduled'){
            $status = 3;
        }elseif($assignment_type == 'completed'){
            $status = 4;
        }

        $general_notary_assignment  = general_notary_assignment::where('status', $status)->get();
        $real_state_closing         = real_state_closing::where('status', $status)->get();
        $tax_closing_assignment     = tax_closing_assignment::where('status', $status)->get();
        $process_server_assignment  = process_server_assignment::where('status', $status)->get();


        return view('admins.all.view_all_by_type', compact('general_notary_assignment', 'real_state_closing', 'tax_closing_assignment', 'process_server_assignment'));

    }









    public function general_notary_post(Request $req){


        $invoice_date = $req->due_year.'-'.$req->due_month.'-'.$req->due_day; //date('Y-m-d', strtotime($req->due_date));

        //dd(request()->segment(3));
        //dd($req->assignment);
        //dd(DB::table('invoices')->where('assignment_hash', $req->assignment)->exists());

        if(DB::table('invoices')->where([['assignment_hash', $req->assignment], ['assignment_type', request()->segment(3)]])->exists()){

            $getInvoiceId = DB::table('invoices')->where([['assignment_hash', $req->assignment], ['assignment_type', request()->segment(3)]])->first()->id;

            $invoice = Invoice::find($getInvoiceId);

        }else{
            $invoice = new Invoice;
            $invoice->assignment_hash           =       $req->assignment;
            $invoice->assignment_type           =       request()->segment(3);
            $invoice->invoice_hash              =       md5(time());
            $invoice->invoice_to                =       $req->ci;

        }
       // dd($req->ci);

        $invoice->invoice_amount            =       $req->invoice_amount;
        $invoice->due_date                  =       $invoice_date;
        $invoice->logged_month              =       date('M');
        $invoice->status                    =       $req->invoice_status;
        $invoice->save();


        $getClient = User::find($req->ci);
        if($getClient == true){
            Mail::to($getClient->email)->send(new InvoiceSendToClient($invoice));
        }


       //dd($req->invoice_status);

        //return redirect()->back();
        return redirect('/admin/view-assignments/'.request()->segment(3).'/'.request()->segment(4).'?status=sucess&for=invoice_saved_successfully');
    }

    public function real_state_closing_all(Request $req, $status){


        if($req->do == 'delete' && DB::table('real_state_closings')->where('hash', $req->for)->exists()){
            real_state_closing::where('hash', $req->for)->delete();
            Assignment_message::where('hash', $req->for)->delete();
            Assignment_upload::where('hash', $req->for)->delete();
            AssignmentAssignTo::where('assignment_hash', $req->for)->delete();
            return redirect('/admin/view-assignments/'.request()->segment(3).'/'.request()->segment(4).'?status=success&for=assignment_deleted');
        }

        $users = User::count();
        $datas = real_state_closing::where('status', Self::getStatus($status))->orderBy('status', 'ASC')->get();

        $widget = [
            'users' => $users,
        ];

        return view('admins.all.real_state_closing', compact('widget', 'datas'));

    }


    public function real_state_closing_hash($hash){



        $users = User::count();
        $data = real_state_closing::where([['hash', $hash]])->first();




            if(request()->segment(3) == 'process-server'){
                $get_role_id = 4;            }

            if(request()->segment(3) != 'process-server'){
                $get_role_id = 3;
            }


            $contractors2 = DB::table('contractor_zips')
                ->join('users', 'users.id', '=', 'contractor_zips.user_id')
                ->join('roles_connect','roles_connect.user_id','=','users.id')
                ->where([['contractor_zips.status', 1], ['roles_connect.role_id', $get_role_id]]);

            if(request()->state || request()->city || request()->zip){
                if(request()->state && DB::table('contractor_zips')->where('state', request()->state)->exists()){
                    $contractors2->where('contractor_zips.state', request()->state);
                }elseif(request()->city && DB::table('contractor_zips')->where('city', request()->city)->exists()){
                    $contractors2->where('contractor_zips.city', request()->city);
                }elseif(request()->zip && DB::table('contractor_zips')->where('zip', request()->zip)->exists()){
                    $contractors2->where('contractor_zips.zip', request()->zip);
                }else{
                    $contractors2->where('contractor_zips.zip', '3456ygfddfghgf');
                }
            }


            $contractors = $contractors2->select('users.*', 'contractor_zips.state','contractor_zips.city','contractor_zips.zip', 'roles_connect.role_id')->get();

           




        $messages = DB::table('assignment_messages')
        	->join('users', 'assignment_messages.message_from', '=', 'users.id')
        	->where('assignment_messages.hash', $hash)
        	->get();

        $files = DB::table('assignment_uploads')
        	->join('users', 'assignment_uploads.message_from', '=', 'users.id')
        	->where('assignment_uploads.hash', $hash)
        	->get();


        //dd($messages);
        $widget = [
            'users' => $users,
        ];


        return view('admins.all.real_state_closing_single', compact('widget', 'data', 'contractors', 'messages','files'));


    }




    public function tax_closing_all(Request $req, $status){



        if($req->do == 'delete' && DB::table('tax_closing_assignments')->where('hash', $req->for)->exists()){
            tax_closing_assignment::where('hash', $req->for)->delete();
            Assignment_message::where('hash', $req->for)->delete();
            Assignment_upload::where('hash', $req->for)->delete();
            AssignmentAssignTo::where('assignment_hash', $req->for)->delete();
            return redirect('/admin/view-assignments/'.request()->segment(3).'/'.request()->segment(4).'?status=success&for=assignment_deleted');
        }

        $users = User::count();
        $datas = tax_closing_assignment::where('status', Self::getStatus($status))->orderBy('status', 'ASC')->get();


        $widget = [
            'users' => $users,
        ];

        return view('admins.all.tax_closing', compact('widget', 'datas'));

    }



    public function tax_closing_hash($hash){


      	$users = User::count();
        $data = tax_closing_assignment::where([['hash', $hash]])->first();
            if(request()->segment(3) == 'process-server'){
                $get_role_id = 4;            }

            if(request()->segment(3) != 'process-server'){
                $get_role_id = 3;
            }


            $contractors2 = DB::table('contractor_zips')
                ->join('users', 'users.id', '=', 'contractor_zips.user_id')
                ->join('roles_connect','roles_connect.user_id','=','users.id')
                ->where([['contractor_zips.status', 1], ['roles_connect.role_id', $get_role_id]]);

            if(request()->state || request()->city || request()->zip){
                if(request()->state && DB::table('contractor_zips')->where('state', request()->state)->exists()){
                    $contractors2->where('contractor_zips.state', request()->state);
                }elseif(request()->city && DB::table('contractor_zips')->where('city', request()->city)->exists()){
                    $contractors2->where('contractor_zips.city', request()->city);
                }elseif(request()->zip && DB::table('contractor_zips')->where('zip', request()->zip)->exists()){
                    $contractors2->where('contractor_zips.zip', request()->zip);
                }else{
                    $contractors2->where('contractor_zips.zip', '3456ygfddfghgf');
                }
            }


            $contractors = $contractors2->select('users.*', 'contractor_zips.state','contractor_zips.city','contractor_zips.zip', 'roles_connect.role_id')->get();

           

        $messages = DB::table('assignment_messages')
        	->join('users', 'assignment_messages.message_from', '=', 'users.id')
        	->where('assignment_messages.hash', $hash)
        	->get();

        $files = DB::table('assignment_uploads')
        	->join('users', 'assignment_uploads.message_from', '=', 'users.id')
        	->where('assignment_uploads.hash', $hash)
        	->get();


        //dd($messages);
        $widget = [
            'users' => $users,
        ];


        return view('admins.all.tax_closing_single', compact('widget', 'data', 'contractors', 'messages','files'));


    }




    public function process_server_all(Request $req, $status){



        if($req->do == 'delete' && DB::table('process_server_assignments')->where('hash', $req->for)->exists()){
            process_server_assignment::where('hash', $req->for)->delete();
            Assignment_message::where('hash', $req->for)->delete();
            Assignment_upload::where('hash', $req->for)->delete();
            AssignmentAssignTo::where('assignment_hash', $req->for)->delete();
            return redirect('/admin/view-assignments/'.request()->segment(3).'/'.request()->segment(4).'?status=success&for=assignment_deleted');
        }



        $users = User::count();
        $datas = process_server_assignment::where('status', Self::getStatus($status))->orderBy('status', 'ASC')->get();

        $widget = [
            'users' => $users,
        ];

        return view('admins.all.process_server', compact('widget', 'datas'));

    }


    public function process_server_hash($hash){

      	$users = User::count();
        $data = process_server_assignment::where([['hash', $hash]])->first();
            if(request()->segment(3) == 'process-server'){
                $get_role_id = 4;            }

            if(request()->segment(3) != 'process-server'){
                $get_role_id = 3;
            }


            $contractors2 = DB::table('contractor_zips')
                ->join('users', 'users.id', '=', 'contractor_zips.user_id')
                ->join('roles_connect','roles_connect.user_id','=','users.id')
                ->where([['contractor_zips.status', 1], ['roles_connect.role_id', $get_role_id]]);

            if(request()->state || request()->city || request()->zip){
                if(request()->state && DB::table('contractor_zips')->where('state', request()->state)->exists()){
                    $contractors2->where('contractor_zips.state', request()->state);
                }elseif(request()->city && DB::table('contractor_zips')->where('city', request()->city)->exists()){
                    $contractors2->where('contractor_zips.city', request()->city);
                }elseif(request()->zip && DB::table('contractor_zips')->where('zip', request()->zip)->exists()){
                    $contractors2->where('contractor_zips.zip', request()->zip);
                }else{
                    $contractors2->where('contractor_zips.zip', '3456ygfddfghgf');
                }
            }


            $contractors = $contractors2->select('users.*', 'contractor_zips.state','contractor_zips.city','contractor_zips.zip', 'roles_connect.role_id')->get();

           

        $messages = DB::table('assignment_messages')
        	->join('users', 'assignment_messages.message_from', '=', 'users.id')
        	->where('assignment_messages.hash', $hash)
        	->get();

        $files = DB::table('assignment_uploads')
        	->join('users', 'assignment_uploads.message_from', '=', 'users.id')
        	->where('assignment_uploads.hash', $hash)
        	->get();


        $widget = [
            'users' => $users,
        ];

        return view('admins.all.process_server_single', compact('widget', 'data', 'contractors', 'messages','files'));


    }


    public function ShowMembers(Request $req, $role){


        if($req->uid && ($req->do == 0 || $req->do ==1)){
           
            
            if($req->uid && ($req->delete == 1)){
            
            DB::table('roles_connect')->where('user_id',$req->uid)->delete();
                $udata = User::find($req->uid)->delete();
                return redirect()->back();
            }
            
            $udata = User::find($req->uid);
            $udata->status = $req->do;
            $udata->save();
            return redirect()->back();
        }
        
        if($req->uid && ($req->delete == 1)){
            dd("here");
            DB::table('roles_connect')->where('user_id',$req->uid)->delete();
            $udata = User::find($req->uid)->delete();
            return redirect()->back();
        }

		$members = DB::table('users')->orderBy('created_at', 'desc')
            ->join('roles_connect', 'users.id', '=', 'roles_connect.user_id')
            ->where('roles_connect.role_id', Self::getMemberType($role))
            ->select('users.*', 'roles_connect.role_id')
            ->get();

//            dd($members);

        return view('admins.members.all_members')->withMembers($members);

    }


    public function AssignmentAssign(Request $req, $assignment_type, $hash){

    	if(DB::table('assignments_assign_to')->where('assignment_hash', $hash)->exists()){

    		return redirect('/admin/view-assignment/'.$assignment_type.'/'.$hash.'/pending?status=failed&for=this_staff_is_already_assigned');

    	}else{

	    	$assign = new AssignmentAssignTo;
	    	$assign->assignment_hash			= 			$hash; 				
			$assign->assign_to					=			$req->assign_to;
			$assign->assign_by					=			Auth::id();
			$assign->assignment_type			=			$assignment_type;
            $assign->special_instruction        =           $req->special_instruction;
			$assign->paid_to_contractor		    =			$req->paid_to_contractor;



	        if ($req->file('instruction_file')) {
	            $imageFile = $req->file('instruction_file');
	            $fileRenae = time().'.'.$imageFile->getClientOriginalExtension();
	            $path = "files/general_notary/".$fileRenae;
	            $imageFile->move(storage_path().'/app/public/files/general_notary/',$fileRenae);
	            $assign->instruction_file = $path;
	        }


	        $assign->save();


            $readable_assignment_type = '';
            if($assignment_type == 'general-notary'){
                $readable_assignment_type = 'General Notary Assignment';

                general_notary_assignment::where('hash', $hash)->update(['status' => 2, 'assigned_to' => $req->assign_to]);
            }elseif($assignment_type == 'real-state-closing'){
                $readable_assignment_type = 'Real State Notary Assignment';

                real_state_closing::where('hash', $hash)->update(['status' => 2, 'assigned_to' => $req->assign_to]);
            }elseif($assignment_type == 'tax-closing'){
                $readable_assignment_type = 'Tax Closing Assignment';

                tax_closing_assignment::where('hash', $hash)->update(['status' => 2, 'assigned_to' => $req->assign_to]);
            }elseif($assignment_type == 'process-server'){
                $readable_assignment_type = 'Process Server Assignment';

                process_server_assignment::where('hash', $hash)->update(['status' => 2, 'assigned_to' => $req->assign_to]);
            }


            $notary_user_data = User::find($req->assign_to);

            $mailData = [
                'notary_name'           => $notary_user_data->name,
                'assigned_by'           => Auth::user()->name,
                'assignment_type'       => $readable_assignment_type,
                'special_instruction'   => $req->special_instruction,
                'pay_amount'            => $req->paid_to_contractor,
            ];

            Mail::to($notary_user_data->email)->send(new AssignmentAssignedToNotary($mailData));
        
	        return redirect('/admin/view-assignment/'.$assignment_type.'/'.$hash.'/assigned?status=success&for=successfully_assigned');

    	}

    }

    public function assignment_message(Request $req, $assignment_type, $hash){

    	$message = new Assignment_message;
    	$message->message_from				= Auth::id();
    	$message->hash						= $hash;
    	$message->assignment_type			= $assignment_type;
    	$message->message 					= $req->message;
    	$message->save();

    	return redirect()->back();
    }

    public function assignment_fileupload(Request $req, $assignment_type, $hash){

    	$message = new Assignment_upload;
    	$message->message_from				= Auth::id();
    	$message->hash						= $hash;
    	$message->assignment_type			= $assignment_type;
    	$message->message 					= $req->message;

        if ($req->file('file')) {
            $imageFile = $req->file('file');
            $fileRenae = time().'.'.$imageFile->getClientOriginalExtension();
            $path = "files/general_notary/".$fileRenae;
            $imageFile->move(storage_path().'/app/public/files/general_notary/',$fileRenae);
            $message->file = $path;
        }

    	$message->save();
    	return redirect()->back();
    }



    public function view_invoices_all($status){
        $final_status = 0;
        if($status == 'paid'){
            $final_status =1;
        }elseif($status == 'pending'){
            $final_status =0;
        }
        $invoices = Invoice::where('status', $final_status)->orderBy('id','DESC')->get();


        return view('admins.invoices.view_all_by_status')->withInvoices($invoices);
    }


    public function view_invoices_single($id){

        $invoice = Invoice::find($id);


        return view('admins.invoices.single')->withInvoice($invoice);
    }


    public function invoices_all(Request $req, $role, $id){
        $invoices = Invoice::where('invoice_to', $id)->orderBy('id','DESC')->get();


        return view('admins.invoices.all')->withInvoices($invoices);
    }

    public function invoices_update(Request $req, $role, $id){




        $invoice_date = $req->due_year.'-'.$req->due_month.'-'.$req->due_day; //date('Y-m-d', strtotime($req->due_date));

        //dd(request()->segment(3));
        //dd($req->assignment);
        //dd(DB::table('invoices')->where('assignment_hash', $req->assignment)->exists());

        if(DB::table('invoices')->where([['assignment_hash', $req->assignment], ['assignment_type', $req->at]])->exists()){

            $getInvoiceId = DB::table('invoices')->where([['assignment_hash', $req->assignment], ['assignment_type', $req->at]])->first()->id;

            $invoice = Invoice::find($getInvoiceId);

        }else{
            $invoice = new Invoice;
            $invoice->assignment_hash           =       $req->assignment;
            $invoice->assignment_type           =       request()->segment(3);
            $invoice->invoice_hash              =       md5(time());
            $invoice->invoice_to                =       $req->ci;

        }
       // dd($req->ci);

        $invoice->invoice_amount            =       $req->invoice_amount;
        $invoice->due_date                  =       $invoice_date;
        $invoice->logged_month              =       date('M');
        $invoice->status                    =       $req->invoice_status;
        $invoice->save();

        $getClient = User::find($req->ci);
        if($getClient == true){
            Mail::to($getClient->email)->send(new InvoiceSendToClient($invoice));
        }
       //dd($req->invoice_status);

        //return redirect()->back();
        return redirect('/admin/members/client/'.request()->segment(4).'/invoices?status=sucess&for=invoice_saved_successfully');


    }


    public function UserRatingSubmit(Request $req, $id){
        if($req->user_rating == '0'){
            return redirect('/'.request()->segment(1).'/members'.'/'.$req->third.'?status=failed&for=select_ratingrating_selection_missing');

            die();
        }

        $user = User::find($id);
        $user->rating = $req->user_rating;
        $user->save();

        return redirect('/'.request()->segment(1).'/members'.'/'.$req->third.'?status=success&for=successfully_rating_updated');

    }

    //return Numeric role
    public function getMemberType($role){
    	$type = null;

    	if($role == 'client'){
    		$type = 1;
    	}elseif($role == 'staff'){
    		$type = 2;
    	}elseif($role == 'mobilerotary'){
    		$type = 3;
    	}elseif($role == 'processserver'){
    		$type = 4;
    	}elseif($role == 'admin'){
    		$type = 5;
    	}else{
    		$type = null;
    	}

    	return $type;
    }


    //return String type role

    public function getMemberRole($role){
    	$type = null;

    	if($role == 1){
    		$type = 'client';
    	}elseif($role == 2){
    		$type = 'staff';
    	}elseif($role == 3){
    		$type = 'mobilerotary';
    	}elseif($role == 4){
    		$type = 'processserver';
    	}elseif($role == 5){
    		$type = 'admin';
    	}else{
    		$type = null;
    	}

    	return $type;
    }


    public function getStatus($status){
    	$val = null;
    	if($status == 'pending'){
    		$val = 0;
    	}elseif($status == 'assigned'){
    		$val = 2;
    	}elseif($status == 'scheduled'){
    		$val = 3;
    	}elseif($status == 'completed'){
    		$val = 4;
    	}

    	return $val;
    }



    public function getStatusByNumber($status){
        $val = null;
        if($status == 0){
            $val = 'pending';
        }elseif($status == 2){
            $val = 'assigned';
        }elseif($status == 3){
            $val = 'scheduled';
        }elseif($status == 4){
            $val = 'completed';
        }

        return $val;
    }


    public function getMemberStatus($status){
    	$val = '';
    	if($status == 0){
    		$val = 'inactive';
    	}elseif($status == 1){
    		$val = 'active';
    	}elseif($status == 2){
    		$val = 'deleted';
    	}

    	return $val;
    }


    public function newMemeberView(){

        return view('new-member');
    }

    public function newMemberStore(Request $request){


        $validation = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);


        $rand_pass = Str::random(8);
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($rand_pass),
        ]);




        $getRole = DB::table('roles')->where('role_name', $request->userRole)->first()->role_id;

        DB::table('roles_connect')->insert([
            ['user_id' => $user->id, 'role_id' => $getRole]
        ]);





        $data = [
            'name'      =>      $request->name,
            'email'      =>      $request->email,
            'password'  =>      $rand_pass,
        ];



        $mailData = new \stdClass();
        $mailData->name = $request->name;
        $mailData->email = $request->email;
        $mailData->password = $rand_pass;

        Mail::to($request->email)->send(new NewMemberMail($mailData));
    
    
    /*
        Mail::send('new_notary_email', $data, function($message) {
           $message->to($request->email)->subject('New account created on Notary ');
        });

*/

        return redirect(request()->segment(1).'/member/new-member?status=success&for=New_user_created_successfully');


    }
   






 
    

}
