<?php

namespace App\Http\Controllers;

use App\Annonce; 
use App\Favorite; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class FavouriteAdController extends Controller
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

    // favourite ad 
    public function add(Request $request){ 
            $favorite = DB::table('favorites')->where([
                    ['compte_id', '=', Auth::user()->id],
                    ['annonce_id', '=', $request->annonceid],
                ])->first();
    
            if (!isset($favorite)) {
                DB::table('favorites')->insert([
                    'compte_id' => Auth::user()->id,
                    'annonce_id' => $request->annonceid
                ]);
            }
            return response()->json(['success' => true]);
        
    }

    public function delete(Request $request){ 
            $favorite = DB::table('favorites')->where([
                    ['compte_id', '=', Auth::user()->id],
                    ['annonce_id', '=', $request->annonceid]
                ])->first();
    
            if (isset($favorite)) {
                DB::table('favorites')->where([
                    ['compte_id', '=', Auth::user()->id],
                    ['annonce_id', '=', $request->annonceid]
                ])->delete();
            } 
            return response()->json(['success' => true]);
        
    }

    
    public function removeFavori(Request $request)
    {
        $auth_user = Auth::user();
        $deletefav = Favorite::where('compte_id', $auth_user->id)
                ->where('annonce_id', $request->annonceid)
                ->delete();
        return response()->json(['success' => true]);
    }

}
