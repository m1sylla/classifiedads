<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Admin;
use App\VerifierAdmin;
use App\AdminPasswordReset;

use App\Http\Controllers\Controller;

use App\Events\NewAdminConfirmedEvent;
//use Illuminate\Foundation\Auth\VerifiesEmails;

//use App\Mail\ConfirmAdminSuccessEmail as ConfirmAdminSuccessEmail;
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
        //$this->middleware('auth');
        //$this->middleware('signed')->only('verify');
        //$this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    // verify admin
    public function verifyAdmin($token)
    {
        $verifyAdmin = VerifierAdmin::where('token', $token)->first();
        $sending = false;
        if(isset($verifyAdmin)){
            
            $admin = Admin::where('id', $verifyAdmin->admin_id)->first();
            
            if (isset($admin)) {
                
                if(!$admin->confirmed) {
                    $sending = true;
                    $admin->confirmed = 1; 
                    $admin->save();
                    $status = "Votre email a été vérifié avec succès.";
                } else {
                    $status = "Votre email a déjà été vérifié.";
                }
            }else{
                $status = "Compte non trouvé.";
            }
            
        } else {
            $status = "Cet email est introuvable.";
        }
        //Mail::to($admin->email)->queue(new ConfirmAdminSuccessEmail($admin));
        
        if ($sending) {
            $data = AdminPasswordReset::create([
                'email' => $admin->email,
                'token' => sha1(time())
            ]);
            event(new NewAdminConfirmedEvent($admin, $data));
        }

        return view('admin.confirm_admin_success')->with('status', $status);
    }

}
