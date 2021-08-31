<?php

namespace App\Http\Controllers\Admin;

use App\PriceOption as PriceOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriceOptionController extends Controller
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


    // PriceOption 
    public function priceOption(){ 
        $price_options = PriceOption::All();
        return view('admin.options_prix', compact('price_options'));
    }

    // add PriceOption 
    public function addPriceOption(Request $request){ 
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $price_option = PriceOption::create([
            'name' => $request['name'],
        ]);
        return redirect()->back();
    }

    // delete PriceOption 
    public function deletePriceOption($id){ 
        PriceOption::where('id',$id)->delete();
        return redirect()->back();
    }
}
