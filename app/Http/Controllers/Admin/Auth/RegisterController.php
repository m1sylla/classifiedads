<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\VerifierAdmin;
use Auth;

use Illuminate\Contracts\Auth\Guard;

use App\Mail\ConfirmAdminEmail as ConfirmAdminEmail;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

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
    protected $redirectTo = '/admin_yetec224';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Admin
     */
    public function adminRegisterForm()
    {
        return view('admin.new_admin', ['url' => 'admin_yetek224/register']);
    }


    protected function createAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'level' => 'required',
            'password' => 'required|string|min:6',
        ]);
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'level' => $request['level'],
            'password' => Hash::make($request['password']),
        ]);

        $verifyAdmin = VerifierAdmin::create([
            'admin_id' => $admin->id,
            'token' => sha1(time())
        ]);

        \Mail::to($admin->email)->send(new ConfirmAdminEmail($admin,$verifyAdmin));

        return redirect()->route('admin.home');
    }

}
