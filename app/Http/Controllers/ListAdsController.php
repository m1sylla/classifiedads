<?php

namespace App\Http\Controllers;

use App\Helpers\AdsHelper;
use App\Annonce as Annonce;
use App\Compte as Compte;
use App\Category;
use App\Favorite as Favorite;
use App\Photo as Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ListAdsController extends Controller
{

    // offer
    public function offre(Request $request)
    {
        // sort type
        $sort_type = "";
        if ($request->input('sort') && $request->input('direction')) {
            if ($request->input('sort') == 'created_at') {
                if ($request->input('direction') == 'desc') {
                    $sort_type = "Plus récent";
                } else {
                    $sort_type = "Plus ancien";
                }
            }elseif ($request->input('sort') == 'price') {
                if ($request->input('direction') == 'desc') {
                    $sort_type = "Plus cher";
                } else {
                    $sort_type = "Moins cher";
                }
            }
        }
        // sort param
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['created_at', 'price']) ? $sort : 'created_at';
        // sort direction
        $direction = trim($request->input('direction'));
        $direction = in_array($direction, ['desc', 'asc']) ? $direction : 'desc';

        $list_category = "";
        $list_subcategory = "";
        $list_ville = "";
        $number_per_catsubcats = collect([]);

        
        $favorites = collect([
            ['id' => null, 'annonce_id' => null],
        ]);

        if (Auth::check()) {
            $favs = Favorite::where('compte_id', Auth::user()->id)
                ->select('id', 'annonce_id')->get();
            $favorites = $favorites->concat($favs);
        }
        
        $number_per_catsubcats = Category::select('categories.id', 'categories.name',
        DB::raw("COUNT(annonces.category_id) as total_ads"))
        ->leftJoin('annonces', function ($join) {
            $join->on('categories.id', '=', 'annonces.category_id')
            ->where('annonces.is_offer', true);
        })->groupBy('categories.id')->get();
        
        $annonces = AdsHelper::ads_by_type(true,$sort,$direction);


        return view('annonces.list', compact('annonces', 'list_category', 'list_subcategory', 'list_ville', 'number_per_catsubcats', 'favorites','sort_type'));
    }
    
    // demand
    public function demande(Request $request)
    {
        // sort type
        $sort_type = "";
        if ($request->input('sort') && $request->input('direction')) {
            if ($request->input('sort') == 'created_at') {
                if ($request->input('direction') == 'desc') {
                    $sort_type = "Plus récent";
                } else {
                    $sort_type = "Plus ancien";
                }
            }elseif ($request->input('sort') == 'price') {
                if ($request->input('direction') == 'desc') {
                    $sort_type = "Plus cher";
                } else {
                    $sort_type = "Moins cher";
                }
            }
        }
        // sort param
        $sort = trim($request->input('sort'));
        $sort = in_array($sort, ['created_at', 'price']) ? $sort : 'created_at';
        // sort direction
        $direction = trim($request->input('direction'));
        $direction = in_array($direction, ['desc', 'asc']) ? $direction : 'desc';

        $list_category = "";
        $list_subcategory = "";
        $list_ville = "";
        $number_per_catsubcats = collect([]);

        $favorites = collect([
            ['id' => null, 'annonce_id' => null],
        ]);

        if (Auth::check()) {
            $favs = Favorite::where('compte_id', Auth::user()->id)
                ->select('id', 'annonce_id')->get();
            $favorites = $favorites->concat($favs);
        }

        $number_per_catsubcats = Category::select('categories.id', 'categories.name',
        DB::raw("COUNT(annonces.category_id) as total_ads"))
        ->leftJoin('annonces', function ($join) {
            $join->on('categories.id', '=', 'annonces.category_id')
            ->where('annonces.is_offer', false);
        })->groupBy('categories.id')->get();

        $annonces = AdsHelper::ads_by_type(false,$sort,$direction);
        
        
        return view('annonces.list', compact('annonces', 'list_category', 'list_subcategory', 'list_ville', 'number_per_catsubcats', 'favorites','sort_type'));
    }

    // ad detail page
    public function adDetail($ville, $category, $slug)
    {
        $favorite = collect([]);
        // get ad's infos
        $annonce = Annonce::leftJoin('price_options', 'annonces.price_option_id', '=', 'price_options.id')
            ->join('regions', 'annonces.region_id', '=', 'regions.id')
            ->join('villes', 'annonces.ville_id', '=', 'villes.id')
            ->join('categories', 'annonces.category_id', '=', 'categories.id')
            ->join('category_items', 'annonces.category_item_id', '=', 'category_items.id')
            ->select('annonces.*', 'price_options.name as price_option',
                'regions.name as region_name', 'villes.name as ville_name',
                'category_items.name as sub_category', 'categories.name as category')
            ->where('annonces.slug', '=', $slug)
            ->first();

        // get ad
        if ($annonce) {
            // get account infos
            $compte = Compte::leftJoin('professionnels', function ($join) {
                $join->on('comptes.id', '=', 'professionnels.compte_id');
            })
            ->leftJoin('annonces', function ($join) {
                $join->on('comptes.id', '=', 'annonces.compte_id')
                    ->where('annonces.suspended', '=', 0);
            })
            ->select('comptes.id', 'comptes.first_name', 'comptes.last_name', 'comptes.phone',
                'comptes.email', 'comptes.avatar', 'comptes.created_at', 'professionnels.brand',
                'professionnels.location as adress', 'professionnels.logo',
                DB::raw("COUNT(annonces.compte_id) as total_ads"))
            ->where('comptes.id', '=', $annonce->compte_id)
            ->groupBy('comptes.id')->first();

            // get photos
            $photo = Photo::where('annonce_id', $annonce->id)->first();

            $attribute_values = DB::table('attribute_values')
                ->select('annonce_id', 'attribute_id', 'value')
                ->where('annonce_id', '=', $annonce->id);
            $attributes = DB::table('attributes')
                ->joinSub($attribute_values, 'attribute_values', function ($join) {
                    $join->on('attributes.id', '=', 'attribute_values.attribute_id');
                })
                ->select('attributes.name', 'attributes.unit', 'attributes.unit_exposant', 'attribute_values.value as value')
                ->get();

            if (Auth::check()) {
                $favorite = Favorite::where([
                    ['compte_id', '=', Auth::user()->id],
                    ['annonce_id', '=', $annonce->id]
                ])->select('annonce_id')->get();
            }
            
            return view('annonces.ad_detail', compact('annonce', 'compte', 'photo', 'attributes', 'favorite'));
        }else{
            return abort(404);
        }
        
    }
}
