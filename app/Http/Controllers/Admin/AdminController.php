<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Annonce as Annonce;
use App\Compte as Compte;
use Auth;

class AdminController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    // admin home 
    public function index(){ 
        $comptes = Compte::select('id','confirmed','suspended','deleted')
        ->get();
        $annonces = Annonce::select('id','suspended','deleted')
        ->get();
        return view('admin.index',compact('comptes','annonces')); 
    }
    
}
