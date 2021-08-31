<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use App\Annonce as Annonce;
use App\Favorite as Favorite;
use App\Category as Category;
use App\CategoryItem as CategoryItem;
use App\Photo as Photo;
use App\Ville as Ville;
use App\Region as Region;
use App\PriceOption as PriceOption;
use App\Professionnel as Professionnel;
use App\Compte as Compte;

use Illuminate\Support\Facades\Auth;

class SearchAdsController extends Controller
{
     // search
    public function search(Request $request){ 
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

        /*
        if ($request->category) {
            $cat_id = explode(';', $request->category)[0];
            $subcat_id = explode(';', $request->category)[1];
        }

        if ($request->location) {
            $reg_id = explode(';', $request->location)[0];
            $ville_id = explode(';', $request->location)[1];
        }*/


        $list_category = "";
        $list_subcategory = "";
        $list_ville = "";
        $list_region = "";

        $subcat_id = collect([]);
        $cat_id = collect([]);
        $ville_id = collect([]);
        $reg_id = collect([]);

        // number of ads per cat or subcat 
        $number_per_catsubcats = collect([]);

        $favorites = collect([
            ['id' => null, 'annonce_id' =>null]
        ]);

        if (Auth::check()) {
            $favs = Favorite::where('compte_id', Auth::user()->id)
                ->select('id', 'annonce_id')->get();
            $favorites = $favorites->concat($favs);
        }

        $query = Annonce::select('annonces.id', 'annonces.title','annonces.slug', 
                'annonces.price', 'annonces.sector_name', 'annonces.created_at', 
                'photos.thumbnail', 'photos.number as number_photo', 'photos.photo_link',
                'villes.name as ville_name', 'price_options.name as price_option',
                'categories.name as category', 'category_items.name as sub_category')
                ->leftJoin('photos', function ($join){
                        $join->on('photos.annonce_id', '=', 'annonces.id');
                    })
                ->join('villes', function ($join){
                        $join->on('annonces.ville_id', '=', 'villes.id');
                    })
                ->leftJoin('price_options', function ($join){
                        $join->on('annonces.price_option_id', '=', 'price_options.id');
                    })
                ->join('categories', function ($join){
                        $join->on('annonces.category_id', '=', 'categories.id');
                    })
                ->join('category_items', function($join) {
                        $join->on('annonces.category_item_id', '=', 'category_items.id');
                    })
                ->where([['suspended', 0],['validated', 1]]);
        
        // recupère cat et souscat de la requête
        if ($request->category) {
            $cat_name = explode(';', $request->category)[0];
            $subcat_name = explode(';', $request->category)[1];
            if ($subcat_name) {
                $list_category = $cat_name;
                $list_subcategory = $subcat_name;
                $subcat_id = CategoryItem::where('name', $subcat_name)->select('id')->first();
                if (isset($subcat_id)) {
                    $query->where('annonces.category_item_id', $subcat_id->id);
                }
            } elseif($cat_name) {
                $list_category = $cat_name;
                $cat_id = Category::where('name', $cat_name)->select('id')->first();
                if (isset($cat_id)) {
                    $query->where('annonces.category_id', $cat_id->id);
                }
            }
            
        }
        
        // recupère la region et la ville de la requête
        if ($request->location) {
            $reg_name = explode(';', $request->location)[0];
            $ville_name = explode(';', $request->location)[1];
            if ($ville_name) {
                $list_ville = $ville_name;
                $list_region = $reg_name;
                $ville_id = Ville::where('name', $ville_name)->select('id')->first();
                if (isset($ville_id)) {
                    $query->where('annonces.ville_id', $ville_id->id);
                }
            } elseif($reg_name) {
                $list_region = $reg_name;
                $reg_id = Region::where('name', $reg_name)->select('id')->first(); 
                if (isset($reg_id)) {
                    $query->where('annonces.region_id', $reg_id->id);
                }
            }
        }

        // number of ads per cat or subcat
        /*
        if (isset($cat_id)) {
            if (!isset($subcat_id)) {
                if (isset($reg_id)) {
                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                    ->leftJoin('annonces', function ($join) use ($reg_id) {
                        $join->on('category_items.id', '=', 'annonces.category_item_id')
                        ->where('annonces.region_id', $reg_id->id);
                    })->where('category_items.category_id', $cat_id->id)
                    ->groupBy('category_items.id')->get();
                } elseif (isset($ville_id)) {
                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                    ->leftJoin('annonces', function ($join) use ($ville_id) {
                        $join->on('category_items.id', '=', 'annonces.category_item_id')
                        ->where('annonces.ville_id', $ville_id->id);
                    })->where('category_items.category_id', $cat_id->id)
                    ->groupBy('category_items.id')->get();
                } else {
                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                    ->leftJoin('annonces', function ($join) {
                        $join->on('category_items.id', '=', 'annonces.category_item_id');
                    })->where('category_items.category_id', $cat_id->id)
                    ->groupBy('category_items.id')->get();
                }
                
            }
        } else {
            if (isset($reg_id)) {
                $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                DB::raw("COUNT(annonces.category_id) as total_ads"))
                ->leftJoin('annonces', function ($join) use ($reg_id) {
                    $join->on('categories.id', '=', 'annonces.category_id')
                    ->where('annonces.region_id', $reg_id->id);
                })->groupBy('categories.id')->get();
            } elseif (isset($ville_id)) {
                $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                DB::raw("COUNT(annonces.category_id) as total_ads"))
                ->leftJoin('annonces', function ($join) {
                    $join->on('categories.id', '=', 'annonces.category_id')
                    ->where('annonces.ville_id', $ville_id->id);
                })->groupBy('categories.id')->get();
            } else {
                $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                DB::raw("COUNT(annonces.category_id) as total_ads"))
                ->leftJoin('annonces', function ($join) {
                    $join->on('categories.id', '=', 'annonces.category_id');
                })->groupBy('categories.id')->get();
            }
        }*/
        

        if ($request->title) {
            $query->where('annonces.title', 'LIKE', "%$request->title%");
        }
        
        $annonces = $query->orderBy($sort, $direction)->paginate(25);
                
        return view('annonces.list', compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites','sort_type')); 
    
    }
}
