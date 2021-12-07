<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
            //...
        ];

        return view('home', compact('widget'));
    }


    public function dashboard()
    {
        $users = User::count();

        $widget = [
            'users' => $users,
        ];

        if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 1]])->exists() ){
            return view('clients.dashboard', compact('widget'));

        }elseif(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 5]])->exists() ){
            return view('admins.dashboard', compact('widget'));

        }elseif(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 2]])->exists() ){
            return view('staffs.dashboard', compact('widget'));

        }elseif(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 3]])->exists() || DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 4]])->exists()){
            return view('contractor.dashboard', compact('widget'));

        }

    }
}
