<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('profile');
    }


    public function business_update(Request $request)
    {
        $request->validate([
            'contact_first_name' => 'required|string|max:255',
            'contact_last_name' => 'nullable|string|max:255',
            'contact_email_address' => 'required|string|email|max:255|',
            'contact_telephone_number' => 'required|string|max:255|',
            'contact_mailing_address' => 'required|string|max:500|',
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->contact_first_name = $request->input('contact_first_name');
        $user->contact_last_name = $request->input('contact_last_name');
        $user->contact_email_address = $request->input('contact_email_address');
        $user->contact_telephone_number = $request->input('contact_telephone_number');
        $user->contact_mailing_address = $request->input('contact_mailing_address');

        $user->company_name = $request->input('company_name');
        $user->contact_fax_number = $request->input('contact_fax_number');
        $user->cheque_payable_to = $request->input('cheque_payable_to');



        $user->save();

        return redirect()->route('profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|max:12|required_with:current_password',
            'password_confirmation' => 'nullable|min:8|max:12|required_with:new_password|same:new_password'
        ]);


        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        //$user->email = $request->input('email');

        if (!is_null($request->input('current_password'))) {
            if (Hash::check($request->input('current_password'), $user->password)) {
                $user->password = Hash::make($request->input('new_password'));
            } else {
                return redirect()->back()->withInput();
            }
        }

        $user->save();

        return redirect()->route('profile');
    }
}
