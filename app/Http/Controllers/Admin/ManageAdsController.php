<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Helpers\AdsHelper;
use File;

use App\Annonce as Annonce;
use App\Compte as Compte;
use App\Category as Category;
use App\CategoryItem as CategoryItem;
use App\Region as Region;
use App\Ville as Ville;
use App\PriceOption as PriceOption;
use App\Photo as Photo;

use App\Favorite;  
use App\AttributeValue;
use App\ReportedAd;
use App\SponsoredAd;
use App\Message;
use App\Professionnel;
use App\Following;

class ManageAdsController extends Controller
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


    // annonces 
    public function index(){ 
        
        $annonces = Annonce::select('annonces.*', 'photos.photo1', 'photos.photo2',
                'photos.photo3', 'photos.photo4', 'photos.photo5', 'photos.photo6',
                'photos.photo7', 'photos.photo8', 'photos.photo9', 'photos.photo10', 
                'photos.photo11', 'photos.photo12', 'photos.number as number_photo', 
                'photos.photo_link', 'villes.name as ville_name', 'comptes.first_name',
                'comptes.last_name', 'category_items.name as sub_category')
                ->leftJoin('photos', function ($join){
                        $join->on('photos.annonce_id', '=', 'annonces.id');
                    })
                ->join('villes', function ($join){
                        $join->on('annonces.ville_id', '=', 'villes.id');
                    })
                ->leftJoin('comptes', function ($join){
                        $join->on('annonces.compte_id', '=', 'comptes.id');
                    })
                ->join('category_items', function ($join){
                        $join->on('annonces.category_item_id', '=', 'category_items.id');
                    })
                ->get();

        return view('admin.annonce.index', compact('annonces'));
    }

    // delete ad 
    public function deleteAd(Request $request){
        $delete_ad = AdsHelper::delete_ad($request->annonceid);

        if ($delete_ad) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);

    }

    // suspend ad 
    public function suspendAd(Request $request){
        $suspend_ad = AdsHelper::suspend_ad($request->annonceid);

        if ($suspend_ad) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    // validate ad 
    public function validateAd(Request $request){
        $ann = Annonce::find($request->annonceid);

        if ($ann) {
            $ann->validated = 1;
            $ann->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

}
