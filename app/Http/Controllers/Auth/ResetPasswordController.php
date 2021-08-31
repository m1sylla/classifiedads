<?php

namespace App\Http\Controllers\Auth;

use App\UserPasswordReset;
use App\Compte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
//use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    //use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    // reset password 
    protected function editPassword($token)
    {
        $reset_token = DB::table('user_password_resets')
        ->where('token', '=', $token)->first();
        if ($reset_token) {
            return view('auth.passwords.reset');
        }
        return abort(404);
        
    }


    protected function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:60|same:password',
            'confirm_password' => 'required|string|same:password',
        ]);


        $reset_token = DB::table('user_password_resets')
        ->where('email', '=', $request->email)->first();
        
        if(isset($reset_token)){
            
            $compte = DB::table('comptes')->where('email', $request->email)
            ->update(['password' =>Hash::make($request->password)]);
            
            if($compte){
                Session::flash('password_reset_success', "Votre mot de passe a été modifié. ");
            }else{
                Session::flash('password_reset_fail', "Cet compte n'existe pas.");
            }
        }else{
            Session::flash('password_reset_fail', "Cet email n'existe pas.");
        }

        return redirect()->back();
    }

}
