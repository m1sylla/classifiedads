<?php

namespace App\Http\Controllers\Admin;

use App\Region as Region;
use App\Ville as Ville;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionVilleController extends Controller
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

    // region ville 
    public function regionVille(){ 
        $regions = Region::All();
        $villes = Ville::All();
        //dd($regions);
        return view('admin.region_ville', compact('regions', 'villes'));
    }

    // add region 
    public function addRegion(Request $request){ 

        $request->validate([
            'name' => 'required|string|max:25',
        ]);
        $region = Region::create([
            'name' => $request->name,
        ]);
        return redirect()->back();

    }

    // delete region 
    public function deleteRegion($id){ 
        Region::where('id',$id)->delete();
        Ville::where('region_id',$id)->delete();
        return redirect()->back();
    }

    // add ville 
    public function addVille(Request $request){ 
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $ville = Ville::create([
            'region_id' => $request['region_id'],
            'name' => $request['name'],
        ]);
        return redirect()->back();
    }

    // delete ville 
    public function deleteVille($id){
        Ville::where('id',$id)->delete();
        return redirect()->back();
    }
}
