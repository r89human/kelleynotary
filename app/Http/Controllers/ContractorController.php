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
use App\Contractor_zip;

use \carbon\Carbon;

class ContractorController extends Controller
{
    
	public function notary_zip_view(Request $req){

		if($req->do == 'delete' && DB::table('contractor_zips')->where([['user_id', Auth::id()], ['id', $req->for]])->exists()){
			Contractor_zip::where('id', $req->for)->delete();
			return redirect('contact/notary-area?status=success&for=zip_area_deleted');
		}
		$zipareas = Contractor_zip::where('user_id', Auth::id())->orderBy('id','desc')->get();
		return view('contractor.notary_zip_view')->withZipareas($zipareas);
	}

	public function notary_zip_store(Request $req){
		$zipstore = new Contractor_zip;
		$zipstore->user_id 		=	Auth::id();
		$zipstore->state 		=	$req->state;
		$zipstore->city 		=	$req->city;
		$zipstore->zip 			=	$req->zip;
		$zipstore->save();

		return redirect()->route('contractors.notary.zip.view');
	}

    public function general_notary_hash($hash){

        $users = User::count();
        $data = general_notary_assignment::where([['hash', $hash]])->first();
        $staffs  = DB::table('users')
            ->join('roles_connect', 'users.id', '=', 'roles_connect.user_id')
            ->where('roles_connect.role_id', 3)
            ->select('users.*', 'roles_connect.role_id')
            ->get();

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


        return view('contractor.all.general_notary_single', compact('widget', 'data', 'staffs', 'messages','files'));

    }


    public function general_notary_all($status){


        $users = User::count();
        $datas = general_notary_assignment::where([['status', Self::getStatus($status)], ['assigned_to', Auth::id()]])->orderBy('status', 'ASC')->get();

        $widget = [
            'users' => $users,
        ];

        return view('contractor.all.general_notary', compact('widget', 'datas'));

    }

    public function real_state_closing_all($status){

        $users = User::count();
        $datas = real_state_closing::where([['status', Self::getStatus($status)], ['assigned_to', Auth::id()]])->orderBy('status', 'ASC')->get();

        $widget = [
            'users' => $users,
        ];

        return view('contractor.all.real_state_closing', compact('widget', 'datas'));

    }


    public function real_state_closing_hash($hash){



        $users = User::count();
        $data = real_state_closing::where([['hash', $hash]])->first();
        $contractors  = DB::table('users')
            ->join('roles_connect', 'users.id', '=', 'roles_connect.user_id')
            ->where('roles_connect.role_id', 3)
            ->select('users.*', 'roles_connect.role_id')
            ->get();

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


        return view('contractor.all.real_state_closing_single', compact('widget', 'data', 'contractors', 'messages','files'));


    }




    public function tax_closing_all($status){

        $users = User::count();
        $datas = tax_closing_assignment::where([['status', Self::getStatus($status)], ['assigned_to', Auth::id()]])->orderBy('status', 'ASC')->get();


        $widget = [
            'users' => $users,
        ];

        return view('contractor.all.tax_closing', compact('widget', 'datas'));

    }



    public function tax_closing_hash($hash){


      	$users = User::count();
        $data = tax_closing_assignment::where([['hash', $hash],['status', Self::getStatus(request()->segment(5))]])->first();
        $contractors  = DB::table('users')
            ->join('roles_connect', 'users.id', '=', 'roles_connect.user_id')
            ->where('roles_connect.role_id', 3)
            ->select('users.*', 'roles_connect.role_id')
            ->get();

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


        return view('contractor.all.tax_closing_single', compact('widget', 'data', 'contractors', 'messages','files'));


    }




    public function process_server_all($status){

        $users = User::count();
        $datas = process_server_assignment::where([['status', Self::getStatus($status)], ['assigned_to', Auth::id()]])->orderBy('status', 'ASC')->get();

        $widget = [
            'users' => $users,
        ];

        return view('contractor.all.process_server', compact('widget', 'datas'));

    }


    public function process_server_hash($hash){

      	$users = User::count();
        $data = process_server_assignment::where([['hash', $hash],['status', Self::getStatus(request()->segment(5))]])->first();
        $contractors  = DB::table('users')
            ->join('roles_connect', 'users.id', '=', 'roles_connect.user_id')
            ->where('roles_connect.role_id', 2)
            ->select('users.*', 'roles_connect.role_id')
            ->get();

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

        return view('contractor.all.process_server_single', compact('widget', 'data', 'contractors', 'messages','files'));


    }


    public function ShowMembers($role){
		$members = DB::table('users')
            ->join('roles_connect', 'users.id', '=', 'roles_connect.user_id')
            ->where('roles_connect.role_id', Self::getMemberType($role))
            ->select('users.*', 'roles_connect.role_id')
            ->get();

          //  dd($members);

        return view('contractor.members.all_members')->withMembers($members);

    }


    public function AssignmentAssign(Request $req, $assignment_type, $hash){

    	/*if($req->mark_as_assigned == 'assigned'){

    		$status_changed = general_notary_assignment::where('hash', $hash)->update(['status' => 2]);

		    return redirect('/staff/view-assignments/general-notary/pending?status=success&for=assignment_status_changed');


    	}elseif($req->mark_as_completed == 'completed'){

    		$status_changed = general_notary_assignment::where('hash', $hash)->update(['status' => 4]);

		    return redirect('/staff/view-assignments/general-notary/pending?status=success&for=assignment_completed');


    	}else{*/

	    	if(DB::table('assignments_assign_to')->where('assignment_hash', $hash)->exists()){

	    		return redirect('/contact/view-assignment/'.$assignment_type.'/'.$hash.'/pending?status=failed&for=this_staff_is_already_assigned');

	    	}else{

		    	$assign = new AssignmentAssignTo;
		    	$assign->assignment_hash			= 			$hash; 				
				$assign->assign_to					=			$req->assign_to;
				$assign->assign_by					=			Auth::id();
				$assign->assignment_type			=			$assignment_type;
				$assign->special_instruction		=			$req->special_instruction;



		        if ($req->file('instruction_file')) {
		            $imageFile = $req->file('instruction_file');
		            $fileRenae = time().'.'.$imageFile->getClientOriginalExtension();
		            $path = "files/general_notary/".$fileRenae;
		            $imageFile->move(storage_path().'/app/public/files/general_notary/',$fileRenae);
		            $assign->instruction_file = $path;
		        }


		        $assign->save();


                if($assignment_type == 'general-notary'){
                    general_notary_assignment::where('hash', $hash)->update(['status' => 3, 'assigned_to' => $req->assign_to]);
                }elseif($assignment_type == 'real-state-closing'){
                    real_state_closing::where('hash', $hash)->update(['status' => 3, 'assigned_to' => $req->assign_to]);
                }elseif($assignment_type == 'tax-closing'){
                    tax_closing_assignment::where('hash', $hash)->update(['status' => 3, 'assigned_to' => $req->assign_to]);
                }elseif($assignment_type == 'process-server'){
                    process_server_assignment::where('hash', $hash)->update(['status' => 3, 'assigned_to' => $req->assign_to]);
                }


		        return redirect('/contact/view-assignment/'.$assignment_type.'/'.$hash.'/scheduled?status=success&for=successfully_assigned');

	    	}
	    //}

    }


    public function assignment_schedule_confirm(Request $req,  $assignment_type, $hash){



    	$schedule_date_fix = date('Y-m-d', strtotime($req->schedule_date));

        if($assignment_type == 'general-notary'){
	        general_notary_assignment::where('hash', $hash)->update(['status' => 3, 'schedule_date' => $schedule_date_fix, 'schedule_time' => $req->schedule_time]);
        }elseif($assignment_type == 'real-state-closing'){
	        real_state_closing::where('hash', $hash)->update(['status' => 3, 'schedule_date' => $schedule_date_fix, 'schedule_time' => $req->schedule_time]);
        }elseif($assignment_type == 'tax-closing'){
	        tax_closing_assignment::where('hash', $hash)->update(['status' => 3, 'schedule_date' => $schedule_date_fix, 'schedule_time' => $req->schedule_time]);
        }elseif($assignment_type == 'process-server'){
	        process_server_assignment::where('hash', $hash)->update(['status' => 3, 'schedule_date' => $schedule_date_fix, 'schedule_time' => $req->schedule_time]);
        }

    	return redirect('/'.request()->segment(1).'/'.request()->segment(2).'/'.request()->segment(3).'/'.request()->segment(4).'/scheduled?status=success&for=assignment_successfully_scheduled');


    }

    public function assignment_assignment_complete(Request $req,  $assignment_type, $hash){



    	//$schedule_date_fix = date('Y-m-d', strtotime($req->schedule_date));

        if($assignment_type == 'general-notary'){
	        general_notary_assignment::where('hash', $hash)->update(
	        	[
	        		'status' => 4, 
	        		'assignment_complete_status'	=> $req->assignment_complete_status,
	        		'assignment_complete_comment'	=> $req->assignment_complete_comment,
	        		'completed_date_time'			=> \Carbon\Carbon::now()

	        	]
	        );
        }elseif($assignment_type == 'real-state-closing'){
	        real_state_closing::where('hash', $hash)->update(
	        	[
	        		'status' => 4, 
	        		'assignment_complete_status'	=> $req->assignment_complete_status,
	        		'assignment_complete_comment'	=> $req->assignment_complete_comment,
	        		'completed_date_time'			=> \Carbon\Carbon::now()

	        	]
	        );
        }elseif($assignment_type == 'tax-closing'){
	        tax_closing_assignment::where('hash', $hash)->update(
	        	[
	        		'status' => 4, 
	        		'assignment_complete_status'	=> $req->assignment_complete_status,
	        		'assignment_complete_comment'	=> $req->assignment_complete_comment,
	        		'completed_date_time'			=> \Carbon\Carbon::now()

	        	]
	        );
        }elseif($assignment_type == 'process-server'){
	        process_server_assignment::where('hash', $hash)->update(
	        	[
	        		'status' => 4, 
	        		'assignment_complete_status'	=> $req->assignment_complete_status,
	        		'assignment_complete_comment'	=> $req->assignment_complete_comment,
	        		'completed_date_time'			=> \Carbon\Carbon::now()

	        	]
	        );
        }


        //dd($req->back);
    	return redirect('/'.request()->segment(1).'/'.request()->segment(2).'/'.request()->segment(3).'/'.request()->segment(4).'/completed?status=success&for=assignment_mark_as_completed');


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



}
