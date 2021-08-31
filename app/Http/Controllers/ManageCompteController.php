<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Compte;
use App\VerifierCompte;
use Illuminate\Support\Facades\Auth;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Providers\RouteServiceProvider;

class ManageCompteController extends Controller
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

    
    protected function updateUser(Request $request)
    {

        $user_id = Auth::User()->id;  
        $compte = Compte::find($user_id);

        if (!$compte) {
            return abort(404);
        }
        //dd($compte);
        $newval = false;
        if ($request->phone) {
            $request->phone = preg_replace('/\s+/', '', $request->phone);
        }
        
        if ($compte->first_name != $request->first_name) {
            $request->validate([
                'first_name' => 'bail|required|string|min:3|max:20',
            ]);
            $compte->first_name = $request->first_name;
            $newval = true;
        }
        if ($compte->last_name != $request->last_name) {
            $request->validate([
                'last_name' => 'bail|required|string|min:3|max:20',
            ]);
            $compte->last_name = $request->last_name;
            $newval = true;
        }
        if ($compte->phone != $request->phone) {
            $request->validate([
                'phone' => 'bail|nullable|regex:/^[0-9\s]{9,12}$/|unique:comptes',
            ]);
            $compte->phone = $request->phone;
            $compte->phone_verified = 0;
            $newval = true;
        }
        if ($compte->gender != $request->gender) {
            $compte->gender = $request->gender;
            $newval = true;
        } 
        if ($compte->email != $request->email) {
            $request->validate([
                'email' => 'bail|required|string|email|max:50|unique:comptes',
            ]);
            $compte->email = $request->email;
            $compte->confirmed = 0;
            $newval = true;
        }

        if ($newval) {
            $compte->save();
            Session::flash('compte_update_success', "Votre compte a été mis à jour");
        }

        return redirect()->back();
    }

    // update password
    protected function change(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|max:60|same:password',
            'confirm_password' => 'required|same:password',
        ]);

        $user_id = Auth::User()->id;  
        $compte = Compte::find($user_id);
        //dd($compte);
        
        if(Hash::check($request->current_password, $compte->password))
        {           
            $compte->password = Hash::make($request->password);
            $compte->save(); 
            Session::flash('password_update_success', "Votre mot de passe a été mis à jour");
            Auth::logout();
            return redirect()->back();
        }
        else
        {            
            Session::flash('error_current_password', "SVP! saisir le mot de passe actuel");
            return redirect()->back(); 
        }
    }
    


}
