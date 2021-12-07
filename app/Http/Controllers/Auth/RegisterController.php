<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use DB;

use Mail;
use App\Mail\NewMemberMail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'contact_first_name' => ['required', 'string', 'max:255'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

      //  dd($data);
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

            'contact_first_name' => $data['contact_first_name'],
            'contact_last_name' => $data['contact_last_name'],
            'contact_email_address' => $data['contact_email_address'],
            'contact_telephone_number' => $data['contact_telephone_number'],
            'contact_mailing_address' => $data['contact_mailing_address'],
            'company_name' => $data['company_name'],
            'contact_fax_number' => $data['contact_fax_number'],
            'cheque_payable_to' => $data['cheque_payable_to'],

        ]);


        $getRole = DB::table('roles')->where('role_name', $data['userRole'])->first()->role_id;

        DB::table('roles_connect')->insert([
            ['user_id' => $user->id, 'role_id' => $getRole]
        ]);


        $mailData = new \stdClass();
        $mailData->name = $data['name'];
        $mailData->email = $data['email'];
        $mailData->password = $data['password'];

        Mail::to($data['email'])->send(new NewMemberMail($mailData));
    



        return $user;

    }
}
