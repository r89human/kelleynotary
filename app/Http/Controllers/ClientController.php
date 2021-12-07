<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\general_notary_assignment;
use App\real_state_closing;
use App\tax_closing_assignment;
use App\process_server_assignment;

use App\Assignment_message;
use App\Assignment_upload;
use App\AssignmentAssignTo;
use App\Invoice;

use Image;
use DB;


use Mail;
use App\Mail\NewAssignmentPost;

class ClientController extends Controller
{
    public function dashboard(){


        $users = User::count();

        $widget = [
            'users' => $users,
        ];

        return view('clients.dashboard', compact('widget'));
    }



    public function general_notary_form(){

        $users = User::count();

        $widget = [
            'users' => $users,
        ];

        return view('clients.general_notary_form', compact('widget'));

    }

    public function general_notary_hash($hash){

        $users = User::count();
        $data = general_notary_assignment::where([['client_id', Auth::id()], ['hash', $hash]])->first();

        $messages = DB::table('assignment_messages')
            ->join('users', 'assignment_messages.message_from', '=', 'users.id')
            ->where('assignment_messages.hash', $hash)
            ->orderBy('assignment_messages.id', 'ASC')
            ->get();

        $files = DB::table('assignment_uploads')
            ->join('users', 'assignment_uploads.message_from', '=', 'users.id')
            ->where('assignment_uploads.hash', $hash)
            ->orderBy('assignment_uploads.id', 'DESC')
            ->get();


        $widget = [
            'users' => $users,
        ];

        return view('clients.all.general_notary_single', compact('widget', 'data', 'messages', 'files'));

    }


    public function general_notary_all(Request $req){

        if($req->do == 'delete' && DB::table('general_notary_assignments')->where('hash', $req->for)->exists()){
            general_notary_assignment::where('hash', $req->for)->delete();
            Assignment_message::where('hash', $req->for)->delete();
            Assignment_upload::where('hash', $req->for)->delete();
            AssignmentAssignTo::where('assignment_hash', $req->for)->delete();
            return redirect('/client/view-assignment/'.request()->segment(3).'?status=success&for=assignment_deleted');
        }

        $users = User::count();
        $datas = general_notary_assignment::where('client_id', Auth::id())->orderBy('status', 'ASC')->get();

        $widget = [
            'users' => $users,
        ];

        return view('clients.all.general_notary', compact('widget', 'datas'));

    }


    public function general_notary_create(Request $request){

    	/*$validatedData = $request->validate( array(
            'date_of_assignment				'           => 'required|min:10|max:250',
            'time_of_assignment				'         	=> 'required|min:10',
            'number_of_signers				'       	=> 'required|numeric',
            'first_signers_name				'  			=> 'numeric',
            'second_signers_name			'     		=> 'numeric',
            'telephone_number				'           => 'numeric',
            'address						'           => 'image',
            'city							'           => 'image',
            'state							'           => 'image',
            'zip							'           => 'image',
            'special_instructions			'           => 'image',
            'general_notary_assignment_image'           => 'image',
        ));*/
        $schedule_date_fix = date('Y-m-d', strtotime($request->date_of_assignment));


        $generalNotary = new general_notary_assignment;
        $generalNotary->client_id = Auth::id();
        $generalNotary->assignment_title					 = $request->assignment_title;
        $generalNotary->date_of_assignment					 = $schedule_date_fix;
        $generalNotary->time_of_assignment					 = $request->time_of_assignment;
        $generalNotary->number_of_signers					 = $request->number_of_signers;
        $generalNotary->first_signers_name					 = $request->first_signers_name;
        $generalNotary->second_signers_name					 = $request->second_signers_name;
        $generalNotary->telephone_number                     = $request->telephone_number;
        $generalNotary->telephone_number2					 = $request->telephone_number2;
        $generalNotary->address					 			 = $request->address;
        $generalNotary->city					 			 = $request->city;
        $generalNotary->state					 			 = $request->state;
        $generalNotary->zip					 				 = $request->zip;
        $generalNotary->special_instructions				 = $request->special_instructions;


        if ($request->file('file')) {
            $imageFile = $request->file('file');
            $fileRenae = time().'.'.$imageFile->getClientOriginalExtension();
            $path = "files/general_notary/".$fileRenae;
            $imageFile->move(storage_path().'/app/public/files/general_notary/',$fileRenae);
            $generalNotary->file = $path;
        }

        $generalNotary->hash = md5(time());
        $generalNotary->save();



        $mailData = [
            'client_name'           => Auth::user()->name,
            'assignment_name'       => $request->assignment_title,
            'assignment_type'       => "General Notary Assignment",
            'assignment_city'       => $request->city,
            'assignment_state'      => $request->state,
            'assignment_zip'        => $request->zip,
            'assignment_date_time'  => date('Y-m-d H:i:s'),
        ];



        Mail::to('orders@kmnsteam.com')->send(new NewAssignmentPost($mailData));
    

        return redirect('/client/new-assignment/'.request()->segment(3).'?status=success&for=assignment_created_successfully');

    }




    public function real_state_closing(){

        $users = User::count();

        $widget = [
            'users' => $users,
        ];

        return view('clients.real_state_closing', compact('widget'));

    }




    public function real_state_closing_create(Request $request){



    	/*$validatedData = $request->validate( array(
            'date_of_assignment				'           => 'required|min:10|max:250',
            'time_of_assignment				'         	=> 'required|min:10',
            'number_of_signers				'       	=> 'required|numeric',
            'first_signers_name				'  			=> 'numeric',
            'second_signers_name			'     		=> 'numeric',
            'telephone_number				'           => 'numeric',
            'address						'           => 'image',
            'city							'           => 'image',
            'state							'           => 'image',
            'zip							'           => 'image',
            'special_instructions			'           => 'image',
            'general_notary_assignment_image'           => 'image',
        ));*/


        $schedule_date_fix = date('Y-m-d', strtotime($request->date_of_assignment));


        $realStateClosing = new real_state_closing;
        $realStateClosing->client_id = Auth::id();
        $realStateClosing->assignment_title					 = $request->assignment_title;
        $realStateClosing->date_of_assignment					 = $schedule_date_fix;
        $realStateClosing->time_of_assignment					 = $request->time_of_assignment;
        $realStateClosing->select_closing_type					 = $request->select_closing_type;
        $realStateClosing->number_of_signers					 = $request->number_of_signers;
        $realStateClosing->fax_backs					 = $request->fax_backs;
        $realStateClosing->first_signers_name					 = $request->first_signers_name;
        $realStateClosing->second_signers_name					 = $request->second_signers_name;
        $realStateClosing->telephone_number					 = $request->telephone_number;
        $realStateClosing->telephone_number_2					 = $request->telephone_number_2;
        $realStateClosing->address					 			 = $request->address;
        $realStateClosing->city					 			 = $request->city;
        $realStateClosing->state					 			 = $request->state;
        $realStateClosing->zip					 				 = $request->zip;
        $realStateClosing->special_instructions				 = $request->special_instructions;


        if ($request->file('file')) {
            $imageFile = $request->file('file');
            $fileRenae = time().'.'.$imageFile->getClientOriginalExtension();
            $path = "files/real_state_closing/".$fileRenae;
            $imageFile->move(storage_path().'/app/public/files/real_state_closing/',$fileRenae);
            $realStateClosing->file = $path;
        }

        $realStateClosing->hash = md5(time());
        $realStateClosing->save();




        $mailData = [
            'client_name'           => Auth::user()->name,
            'assignment_name'       => $request->assignment_title,
            'assignment_type'       => "Real State Closing Assignment",
            'assignment_city'       => $request->city,
            'assignment_state'      => $request->state,
            'assignment_zip'        => $request->zip,
            'assignment_date_time'  => date('Y-m-d H:i:s'),
        ];



        Mail::to('orders@kmnsteam.com')->send(new NewAssignmentPost($mailData));
    




        return redirect('/client/new-assignment/'.request()->segment(3).'?status=success&for=assignment_created_successfully');
    }



    public function real_state_closing_all(Request $req){


        if($req->do == 'delete' && DB::table('real_state_closings')->where('hash', $req->for)->exists()){
            real_state_closing::where('hash', $req->for)->delete();
            Assignment_message::where('hash', $req->for)->delete();
            Assignment_upload::where('hash', $req->for)->delete();
            AssignmentAssignTo::where('assignment_hash', $req->for)->delete();
            return redirect('/client/view-assignment/'.request()->segment(3).'?status=success&for=assignment_deleted');
        }


        $users = User::count();
        $datas = real_state_closing::where('client_id', Auth::id())->orderBy('status', 'ASC')->get();

        $widget = [
            'users' => $users,
        ];

        return view('clients.all.real_state_closing', compact('widget', 'datas'));

    }


    public function real_state_closing_hash($hash){

        $users = User::count();
        $data = real_state_closing::where([['client_id', Auth::id()], ['hash', $hash]])->first();


        $messages = DB::table('assignment_messages')
            ->join('users', 'assignment_messages.message_from', '=', 'users.id')
            ->where('assignment_messages.hash', $hash)
            ->orderBy('assignment_messages.id', 'ASC')
            ->get();

        $files = DB::table('assignment_uploads')
            ->join('users', 'assignment_uploads.message_from', '=', 'users.id')
            ->where('assignment_uploads.hash', $hash)
            ->orderBy('assignment_uploads.id', 'DESC')
            ->get();


        $widget = [
            'users' => $users,
        ];

        return view('clients.all.real_state_closing_single', compact('widget', 'data', 'files', 'messages'));

    }




    public function tax_closing(){

        $users = User::count();

        $widget = [
            'users' => $users,
        ];

        return view('clients.tax_closing', compact('widget'));

    }





    public function tax_closing_create(Request $request){

    	/*$validatedData = $request->validate( array(
            'date_of_assignment				'           => 'required|min:10|max:250',
            'time_of_assignment				'         	=> 'required|min:10',
            'number_of_signers				'       	=> 'required|numeric',
            'first_signers_name				'  			=> 'numeric',
            'second_signers_name			'     		=> 'numeric',
            'telephone_number				'           => 'numeric',
            'address						'           => 'image',
            'city							'           => 'image',
            'state							'           => 'image',
            'zip							'           => 'image',
            'special_instructions			'           => 'image',
            'general_notary_assignment_image'           => 'image',
        ));*/

        $schedule_date_fix = date('Y-m-d', strtotime($request->date_of_assignment));

        $tax_closing = new tax_closing_assignment;
        $tax_closing->client_id = Auth::id();
        $tax_closing->assignment_title					     = $request->assignment_title;
        $tax_closing->date_of_assignment					 = $schedule_date_fix;
        $tax_closing->first_signers_name					 = $request->first_signers_name;
        $tax_closing->second_signers_name					 = $request->second_signers_name;
        $tax_closing->telephone_number					     = $request->telephone_number;
        $tax_closing->telephone_number_2					 = $request->telephone_number_2;
        $tax_closing->email					 			     = $request->email;
        $tax_closing->address					 			 = $request->address;
        $tax_closing->city					 			     = $request->city;
        $tax_closing->state					 			     = $request->state;
        $tax_closing->zip					 				 = $request->zip;
        $tax_closing->special_instructions				     = $request->special_instructions;


        if ($request->file('file')) {
            $imageFile = $request->file('file');
            $fileRenae = time().'.'.$imageFile->getClientOriginalExtension();
            $path = "files/tax_closing/".$fileRenae;
            $imageFile->move(storage_path().'/app/public/files/tax_closing/',$fileRenae);
            $tax_closing->file = $path;
        }

        $tax_closing->hash = md5(time());
        $tax_closing->save();



        $mailData = [
            'client_name'           => Auth::user()->name,
            'assignment_name'       => $request->assignment_title,
            'assignment_type'       => "Tax Closing Assignment",
            'assignment_city'       => $request->city,
            'assignment_state'      => $request->state,
            'assignment_zip'        => $request->zip,
            'assignment_date_time'  => date('Y-m-d H:i:s'),
        ];



        Mail::to('orders@kmnsteam.com')->send(new NewAssignmentPost($mailData));
    



        return redirect('/client/new-assignment/'.request()->segment(3).'?status=success&for=assignment_created_successfully');

    }







    public function tax_closing_all(Request $req){


        if($req->do == 'delete' && DB::table('tax_closing_assignments')->where('hash', $req->for)->exists()){
            tax_closing_assignment::where('hash', $req->for)->delete();
            Assignment_message::where('hash', $req->for)->delete();
            Assignment_upload::where('hash', $req->for)->delete();
            AssignmentAssignTo::where('assignment_hash', $req->for)->delete();
            return redirect('/client/view-assignment/'.request()->segment(3).'?status=success&for=assignment_deleted');
        }




        $users = User::count();
        $datas = tax_closing_assignment::where('client_id', Auth::id())->orderBy('status', 'ASC')->get();

        $widget = [
            'users' => $users,
        ];

        return view('clients.all.tax_closing', compact('widget', 'datas'));

    }


    public function tax_closing_hash($hash){

        $messages = DB::table('assignment_messages')
            ->join('users', 'assignment_messages.message_from', '=', 'users.id')
            ->where('assignment_messages.hash', $hash)
            ->orderBy('assignment_messages.id', 'ASC')
            ->get();

        $files = DB::table('assignment_uploads')
            ->join('users', 'assignment_uploads.message_from', '=', 'users.id')
            ->where('assignment_uploads.hash', $hash)
            ->orderBy('assignment_uploads.id', 'DESC')
            ->get();

        $users = User::count();
        $data = tax_closing_assignment::where([['client_id', Auth::id()], ['hash', $hash]])->first();

        $widget = [
            'users' => $users,
        ];

        return view('clients.all.tax_closing_single', compact('widget', 'data', 'files','messages'));

    }













    public function process_server(){

        $users = User::count();

        $widget = [
            'users' => $users,
        ];

        return view('clients.process_server', compact('widget'));

    }





    public function process_server_create(Request $request){

    	/*$validatedData = $request->validate( array(
            'date_of_assignment				'           => 'required|min:10|max:250',
            'time_of_assignment				'         	=> 'required|min:10',
            'number_of_signers				'       	=> 'required|numeric',
            'first_signers_name				'  			=> 'numeric',
            'second_signers_name			'     		=> 'numeric',
            'telephone_number				'           => 'numeric',
            'address						'           => 'image',
            'city							'           => 'image',
            'state							'           => 'image',
            'zip							'           => 'image',
            'special_instructions			'           => 'image',
            'general_notary_assignment_image'           => 'image',
        ));*/

        $schedule_date_fix = date('Y-m-d', strtotime($request->date_of_assignment));

        $process_server = new process_server_assignment;
        $process_server->client_id = Auth::id();
        $process_server->assignment_title					 = $request->assignment_title;
        $process_server->date_of_assignment					 = $schedule_date_fix;
        $process_server->select_rush					 	 = $request->select_rush;
        $process_server->number_of_defendants				 = $request->number_of_defendants;
        $process_server->defendant_1					 	 = $request->defendant_1;
        $process_server->defendant_2					 	 = $request->defendant_2;
        $process_server->telephone_number                    = $request->telephone_number;
        $process_server->telephone_number2                   = $request->telephone_number2;
        $process_server->physical_description				 = $request->physical_description;
        $process_server->served_location					 = $request->served_location;
        $process_server->special_instructions				 = $request->special_instructions;



        if ($request->file('file')) {
            $imageFile = $request->file('file');
            $fileRenae = time().'.'.$imageFile->getClientOriginalExtension();
            $path = "files/process_server/".$fileRenae;
            $imageFile->move(storage_path().'/app/public/files/process_server/',$fileRenae);
            $process_server->file = $path;
        }

        $process_server->hash = md5(time());
        $process_server->save();




        $mailData = [
            'client_name'           => Auth::user()->name,
            'assignment_name'       => $request->assignment_title,
            'assignment_type'       => "Process Server Assignment",
            'assignment_city'       => 'N\A',
            'assignment_state'      => 'N\A',
            'assignment_zip'        => 'N\A',
            'assignment_date_time'  => date('Y-m-d H:i:s'),
        ];



        Mail::to('orders@kmnsteam.com')->send(new NewAssignmentPost($mailData));
    



        return redirect('/client/new-assignment/'.request()->segment(3).'?status=success&for=assignment_created_successfully');


    }







    public function process_server_all(Request $req){


        if($req->do == 'delete' && DB::table('process_server_assignments')->where('hash', $req->for)->exists()){
            process_server_assignment::where('hash', $req->for)->delete();
            Assignment_message::where('hash', $req->for)->delete();
            Assignment_upload::where('hash', $req->for)->delete();
            AssignmentAssignTo::where('assignment_hash', $req->for)->delete();
            return redirect('/client/view-assignment/'.request()->segment(3).'?status=success&for=assignment_deleted');
        }


        $users = User::count();
        $datas = process_server_assignment::where('client_id', Auth::id())->orderBy('status', 'ASC')->get();

        $widget = [
            'users' => $users,
        ];

        return view('clients.all.process_server', compact('widget', 'datas'));

    }


    public function process_server_hash($hash){

        $messages = DB::table('assignment_messages')
            ->join('users', 'assignment_messages.message_from', '=', 'users.id')
            ->where('assignment_messages.hash', $hash)
            ->orderBy('assignment_messages.id', 'ASC')
            ->get();

        $files = DB::table('assignment_uploads')
            ->join('users', 'assignment_uploads.message_from', '=', 'users.id')
            ->where('assignment_uploads.hash', $hash)
            ->orderBy('assignment_uploads.id', 'DESC')
            ->get();


        $users = User::count();
        $data = process_server_assignment::where([['client_id', Auth::id()], ['hash', $hash]])->first();

        $widget = [
            'users' => $users,
        ];

        return view('clients.all.process_server_single', compact('widget', 'data', 'files','messages'));

    }






    public function assignment_message(Request $req, $assignment_type, $hash){

        $message = new Assignment_message;
        $message->message_from              = Auth::id();
        $message->hash                      = $hash;
        $message->assignment_type           = $assignment_type;
        $message->message                   = $req->message;
        $message->save();

        return redirect()->back();
    }

    public function assignment_fileupload(Request $req, $assignment_type, $hash){


        $message = new Assignment_upload;
        $message->message_from              = Auth::id();
        $message->hash                      = $hash;
        $message->assignment_type           = $assignment_type;
        $message->message                   = $req->message;

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


    public function invoices_all(Request $req){
        $invoices = Invoice::where('invoice_to', Auth::id())->orderBy('id','DESC')->get();
        return view('clients.invoices.all')->withInvoices($invoices);
    }

    public function single_invoice(Request $req, $hash){

        $invoice = Invoice::where([['invoice_to', Auth::id()], ['invoice_hash', $hash]])->first();
        return view('clients.invoices.single')->withInvoice($invoice);
    }


    public function getInvoiceData($assignment_type, $hash, $return_column){

        if($assignment_type == 'general-notary'){
            return general_notary_assignment::where('hash', $hash)->value($return_column);
        }elseif($assignment_type == 'real-state-closing'){
            return real_state_closing::where('hash', $hash)->value($return_column);;
        }elseif($assignment_type == 'tax-closing'){
            return tax_closing_assignment::where('hash', $hash)->value($return_column);;
        }elseif($assignment_type == 'process-server'){
            return process_server_assignment::where('hash', $hash)->value($return_column);;
        }

    }

    public function getStatus($status){
    	$val = '';
    	if($status == 0){
    		$val = 'Pending';
    	}elseif($status == 1){
    		$val = 'Received';
    	}elseif($status == 2){
    		$val = 'Assigned';
    	}elseif($status == 3){
    		$val = 'Scheduled';
    	}elseif($status == 4){
    		$val = 'Completed';
    	}

    	return $val;
    }


    public function getInvoiceStatus($status){
        $val = '';
        if($status == 0){
            $val = 'Pending';
        }elseif($status == 1){
            $val = 'Paid';
        }elseif($status == 2){
            $val = 'Cancelled';
        }
        return $val;
    }



}
