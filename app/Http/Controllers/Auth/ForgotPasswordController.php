<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\UserPasswordReset;
use App\Compte;
use Illuminate\Support\Facades\Validator;

use App\Events\UserPasswordResetEvent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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

    //use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest');
    }

    // reset password
    protected function resetEmail()
    {
        return view('auth.passwords.email');
    }

    protected function sendLink(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ]);
        $compte = Compte::where('email', $request->email)->first();
        
        if(isset($compte)){

            $token_found = UserPasswordReset::where('email', $request->email)
            ->whereDate('created_at', Carbon::today())->first();
            if(isset($token_found)){
                
                Session::flash('password_reset_email_not_found', "Un email a déjà été envoyé.");
                
            }else{
                $data = UserPasswordReset::create([
                    'email' => $request->email,
                    'token' => sha1(time())
                ]);
                event(new UserPasswordResetEvent($compte->email, $data));
                // send email
                Session::flash('password_reset_email', 'Un email de restauration de mot de passe vous a été envoyé');
            }
        }else{
            Session::flash('password_reset_email_not_found', "Cet email n'existe pas.");
        }
        return redirect()->back();
    }
}
