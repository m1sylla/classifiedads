<?php

namespace App\Http\Controllers\Admin\Auth;



use Illuminate\Http\Request;
use App\AdminPasswordReset;
use App\Admin;
use Illuminate\Support\Facades\Validator;

use App\Events\AdminPasswordResetEvent;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public function emailForm(){
        return view('admin.passwords.email');
    }

    public function sendLink(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = Admin::where('email', $request->email)->first();
        
        if(isset($admin)){

            $token_found = AdminPasswordReset::where('email', $request->email)
            ->whereDate('created_at', Carbon::today())->first();
            if(isset($token_found)){
                Session::flash('password_reset_email_not_found', "Un email a déjà été envoyé.");
                
            }else{
                $data = AdminPasswordReset::create([
                    'email' => $request->email,
                    'token' => sha1(time())
                ]);
                event(new AdminPasswordResetEvent($admin->email, $data));
                // send email
                Session::flash('password_reset_email', 'Un email de restauration de mot de passe vous a été envoyé');
            }
        }else{
            Session::flash('password_reset_email_not_found', "Cet email n'existe pas.");
        }
        return redirect()->back();

    }

}
