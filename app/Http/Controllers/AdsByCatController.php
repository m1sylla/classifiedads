<?php

namespace App\Http\Controllers;

use App\Category as Category;
use App\CategoryItem;
use App\Favorite as Favorite;
use Illuminate\Support\Facades\DB;
use App\Helpers\AdsHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdsByCatController extends Controller
{
    public function category(Request $request, $category)
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
            } elseif ($request->input('sort') == 'price') {
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
        $list_region = "";
        $annonces = collect([]);

        // number of ads per cat or subcat 
        $number_per_catsubcats = collect([]);

        $favorites = collect([
            ['id' => null, 'annonce_id' => null],
        ]);

        if (Auth::check()) {
            $favs = Favorite::where('compte_id', Auth::user()->id)
                ->select('id', 'annonce_id')->get();
            $favorites = $favorites->concat($favs);
        }

        switch ($category) {
            //immo
            case 'vente-immobilier-maison':
                $list_category = "Immobilier";
                $cat_id = Category::select('id')->where('name', 'Immobilier')->first();

                if (isset($cat_id)) {
                    $annonces = AdsHelper::ads_by_cat($cat_id['id'], $sort, $direction);

                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                                                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                                                    ->leftJoin('annonces', function ($join) {
                                                        $join->on('category_items.id', '=', 'annonces.category_item_id');
                                                    })->where('category_items.category_id', $cat_id['id'])
                                                    ->groupBy('category_items.id')->get();
                }

                return view('category.immobilier.index',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            // multimédia
            case 'vente-electronic-multimedia':
                $list_category = "Multimédia";
                $cat_id = Category::select('id')->where('name', 'Multimédia')->first();

                if (isset($cat_id)) {
                    $annonces = AdsHelper::ads_by_cat($cat_id['id'], $sort, $direction);

                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                                                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                                                    ->leftJoin('annonces', function ($join) {
                                                        $join->on('category_items.id', '=', 'annonces.category_item_id');
                                                    })->where('category_items.category_id', $cat_id['id'])
                                                    ->groupBy('category_items.id')->get();
                }

                return view('category.multimedia.index',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            // vehicule
            case 'vente-vehicule-voiture':
                $list_category = "Véhicule";
                $cat_id = Category::select('id')->where('name', 'Véhicule')->first();

                if (isset($cat_id)) {
                    $annonces = AdsHelper::ads_by_cat($cat_id['id'], $sort, $direction);

                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                                                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                                                    ->leftJoin('annonces', function ($join) {
                                                        $join->on('category_items.id', '=', 'annonces.category_item_id');
                                                    })->where('category_items.category_id', $cat_id['id'])
                                                    ->groupBy('category_items.id')->get();
                }

                return view('category.vehicule.index',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            // mode
            case 'produit-mode-beaute':
                $list_category = "Mode & Beauté";
                $cat_id = Category::select('id')->where('name', 'Mode & Beauté')->first();

                if (isset($cat_id)) {
                    $annonces = AdsHelper::ads_by_cat($cat_id['id'], $sort, $direction);

                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                                                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                                                    ->leftJoin('annonces', function ($join) {
                                                        $join->on('category_items.id', '=', 'annonces.category_item_id');
                                                    })->where('category_items.category_id', $cat_id['id'])
                                                    ->groupBy('category_items.id')->get();
                }

                return view('category.mode.index',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            // emploi
            case 'offre-emploi':
                $list_category = "Emploi";
                $cat_id = Category::select('id')->where('name', 'Emploi')->first();

                if (isset($cat_id)) {
                    $annonces = AdsHelper::ads_by_cat($cat_id['id'], $sort, $direction);

                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                                                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                                                    ->leftJoin('annonces', function ($join) {
                                                        $join->on('category_items.id', '=', 'annonces.category_item_id');
                                                    })->where('category_items.category_id', $cat_id['id'])
                                                    ->groupBy('category_items.id')->get();
                }

                return view('category.emploi.index',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            // meuble
            case 'vente-electromenager-meuble':
                $list_category = "Meuble & Jardin";
                $cat_id = Category::select('id')->where('name', 'Meuble & Jardin')->first();

                if (isset($cat_id)) {
                    $annonces = AdsHelper::ads_by_cat($cat_id['id'], $sort, $direction);

                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                                                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                                                    ->leftJoin('annonces', function ($join) {
                                                        $join->on('category_items.id', '=', 'annonces.category_item_id');
                                                    })->where('category_items.category_id', $cat_id['id'])
                                                    ->groupBy('category_items.id')->get();
                }

                return view('category.meuble.index',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            // service
            case 'prestation-service':
                $list_category = "Service";
                $cat_id = Category::select('id')->where('name', 'Service')->first();

                if (isset($cat_id)) {
                    $annonces = AdsHelper::ads_by_cat($cat_id['id'], $sort, $direction);

                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                                                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                                                    ->leftJoin('annonces', function ($join) {
                                                        $join->on('category_items.id', '=', 'annonces.category_item_id');
                                                    })->where('category_items.category_id', $cat_id['id'])
                                                    ->groupBy('category_items.id')->get();
                }

                return view('category.service.index',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            // loisir
            case 'culture-loisir':
                $list_category = "Culture & Loisir";
                $cat_id = Category::select('id')->where('name', 'Culture & Loisir')->first();

                if (isset($cat_id)) {
                    $annonces = AdsHelper::ads_by_cat($cat_id['id'], $sort, $direction);

                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                                                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                                                    ->leftJoin('annonces', function ($join) {
                                                        $join->on('category_items.id', '=', 'annonces.category_item_id');
                                                    })->where('category_items.category_id', $cat_id['id'])
                                                    ->groupBy('category_items.id')->get();
                }

                return view('category.loisir.index',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            // industrie
            case 'commerce-industrie':
                $list_category = "Commerce & Industrie";
                $cat_id = Category::select('id')->where('name', 'Commerce & Industrie')->first();

                if (isset($cat_id)) {
                    $annonces = AdsHelper::ads_by_cat($cat_id['id'], $sort, $direction);

                    $number_per_catsubcats = CategoryItem::select('category_items.id', 'category_items.name',
                                                    DB::raw("COUNT(annonces.category_item_id) as total_ads"))
                                                    ->leftJoin('annonces', function ($join) {
                                                        $join->on('category_items.id', '=', 'annonces.category_item_id');
                                                    })->where('category_items.category_id', $cat_id['id'])
                                                    ->groupBy('category_items.id')->get();
                }

                return view('category.industrie.index',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            default:
                return abort(401);
        }

    }
    
    
}