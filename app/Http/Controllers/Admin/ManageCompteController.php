<?php

namespace App\Http\Controllers\Admin;

use App\Compte;
use App\Helpers\CompteHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ManageCompteController extends Controller
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


    // comptes 
    public function index(){ 
        $comptes = Compte::All();

        $comptes_id = $comptes->pluck('id')->toArray(); 
        
        $annonces = DB::table('annonces')->select('compte_id','suspended')
                    ->whereIn('compte_id', $comptes_id);
        
        return view('admin.compte.index', compact('comptes','annonces'));
    }

    // delete compte 
    public function deleteCompte($compteid){
        $delete_compte = CompteHelper::delete_compte($compteid);

        if ($delete_compte) {
            return redirect()->back();
        }
        return redirect()->back();
    }

    // suspend compte 
    public function suspendCompte(Request $request){
        $suspend_compte = CompteHelper::suspend_compte($request->compteid);

        if ($suspend_compte) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

}
