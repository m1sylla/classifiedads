<?php

namespace App\Http\Controllers\Admin\Auth;

use App\AdminPasswordReset;
use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;

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

    public function resetForm($token){
        $reset_token = DB::table('admin_password_resets')
        ->where('token', '=', $token)->first();
        if ($reset_token) {
            return view('admin.passwords.reset');
        }
        return abort(404);
    }

    public function passwordSave(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:60|same:password',
            'confirm_password' => 'required|string|same:password',
        ]);


        $reset_token = DB::table('admin_password_resets')
        ->where('email', '=', $request->email)->first();
        
        if(isset($reset_token)){
            
            $admin = DB::table('admins')->where('email', $request->email)
            ->update(['password' =>Hash::make($request->password)]);
            
            if($admin){
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
