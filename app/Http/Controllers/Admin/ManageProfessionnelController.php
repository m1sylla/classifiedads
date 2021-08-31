<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageProfessionnelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('super.admin');
    }


    // Pros 
    public function index(){ 
        //$comptes = Compte::All();

        //return view('admin.compte.index', compact('comptes'));
    }
}
