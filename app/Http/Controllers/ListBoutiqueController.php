<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListBoutiqueController extends Controller
{
    // liste annuaire  
    public function listBoutique(){ 
        return view('annuaire.list_annuaire');
    } 

    // detail  
    public function detailBoutique(){ 
        return view('annuaire.detail_annuaire');
    } 
}
