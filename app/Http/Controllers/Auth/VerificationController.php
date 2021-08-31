<?php

namespace App\Http\Controllers\Auth;

use App\Compte;
use App\VerifierCompte;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

use Carbon\Carbon as Carbon; 
use App\Events\NewUserConfirmedEvent;
//use App\Jobs\SendEmailJob as SendEmailJob;
//use Illuminate\Support\Facades\Mail;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    //use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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

    // verify user
    public function verifyCompte($token)
    {
        $verifyCompte = VerifierCompte::where('token', $token)->first();
        $sending = false;
        if(isset($verifyCompte)){
            
            $compte = Compte::where('id', $verifyCompte->compte_id)->first();
            if (isset($compte)) {
                if(!$compte->confirmed) {
                    $compte->confirmed = 1; 
                    $compte->save();
                    $status = "Votre email a été vérifié avec succès.";
                    $sending = true;
                } else {
                    $status = "Votre email a déjà été vérifié.";
                }
            }else{
                $status = "Compte non trouvé.";
            }
            
        } else {
            $status = "Cet email est introuvable.";
        }
        if ($sending) {
            event(new NewUserConfirmedEvent($compte->email));
        }
        
        return view('user.confirm_success_response')->with('status', $status);
    }
}
