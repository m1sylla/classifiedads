<?php

namespace App\Http\Controllers;

use App\Favorite as Favorite;
use App\Helpers\AdsHelper;
use App\Region as Region;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdsByRegController extends Controller
{
    public function region(Request $request, $region)
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


        switch ($region) {
            //kankan
            case 'kankan':
                $list_region = "Kankan";
                $region_id = Region::where('regions.name', 'Kankan')->select('regions.id')->first();

                if (isset($region_id)) {
                    $annonces = AdsHelper::ads_by_reg($region_id['id'], $sort, $direction);

                    $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                                                        DB::raw("COUNT(annonces.category_id) as total_ads"))
                                                        ->leftJoin('annonces', function ($join) use ($region_id) {
                                                            $join->on('categories.id', '=', 'annonces.category_id')
                                                            ->where('annonces.region_id', $region_id['id']);
                                                        })->groupBy('categories.id')->get();
                }

                return view('annonces.list',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            //conakry
            case 'conakry':
                $list_region = "Conakry";
                $region_id = Region::where('regions.name', 'Conakry')->select('regions.id')->first();

                if (isset($region_id)) {
                    $annonces = AdsHelper::ads_by_reg($region_id['id'], $sort, $direction);
                    
                    $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                                                        DB::raw("COUNT(annonces.category_id) as total_ads"))
                                                        ->leftJoin('annonces', function ($join) use ($region_id) {
                                                            $join->on('categories.id', '=', 'annonces.category_id')
                                                            ->where('annonces.region_id', $region_id['id']);
                                                        })->groupBy('categories.id')->get();
                }

                return view('annonces.list',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            //nzerekore
            case 'nzerekore':
                $list_region = "Nzérékoré";
                $region_id = Region::where('regions.name', 'Nzérékoré')->select('regions.id')->first();

                if (isset($region_id)) {
                    $annonces = AdsHelper::ads_by_reg($region_id['id'], $sort, $direction);
                    
                    $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                                                        DB::raw("COUNT(annonces.category_id) as total_ads"))
                                                        ->leftJoin('annonces', function ($join) use ($region_id) {
                                                            $join->on('categories.id', '=', 'annonces.category_id')
                                                            ->where('annonces.region_id', $region_id['id']);
                                                        })->groupBy('categories.id')->get();
                }

                return view('annonces.list',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            //labe
            case 'labe':
                $list_region = "Labé";
                $region_id = Region::where('regions.name', 'Labé')->select('regions.id')->first();

                if (isset($region_id)) {
                    $annonces = AdsHelper::ads_by_reg($region_id['id'], $sort, $direction);
                    
                    $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                                                        DB::raw("COUNT(annonces.category_id) as total_ads"))
                                                        ->leftJoin('annonces', function ($join) use ($region_id) {
                                                            $join->on('categories.id', '=', 'annonces.category_id')
                                                            ->where('annonces.region_id', $region_id['id']);
                                                        })->groupBy('categories.id')->get();
                }

                return view('annonces.list',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            //kindia
            case 'kindia':
                $list_region = "Kindia";
                $region_id = Region::where('regions.name', 'Kindia')->select('regions.id')->first();

                if (isset($region_id)) {
                    $annonces = AdsHelper::ads_by_reg($region_id['id'], $sort, $direction);
                    
                    $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                                                        DB::raw("COUNT(annonces.category_id) as total_ads"))
                                                        ->leftJoin('annonces', function ($join) use ($region_id) {
                                                            $join->on('categories.id', '=', 'annonces.category_id')
                                                            ->where('annonces.region_id', $region_id['id']);
                                                        })->groupBy('categories.id')->get();
                }

                return view('annonces.list',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            //boke
            case 'boke':
                $list_region = "Boké";
                $region_id = Region::where('regions.name', 'Boké')->select('regions.id')->first();

                if (isset($region_id)) {
                    $annonces = AdsHelper::ads_by_reg($region_id['id'], $sort, $direction);
                    
                    $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                                                        DB::raw("COUNT(annonces.category_id) as total_ads"))
                                                        ->leftJoin('annonces', function ($join) use ($region_id) {
                                                            $join->on('categories.id', '=', 'annonces.category_id')
                                                            ->where('annonces.region_id', $region_id['id']);
                                                        })->groupBy('categories.id')->get();
                }

                return view('annonces.list',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            //mamou
            case 'mamou':
                $list_region = "Mamou";
                $region_id = Region::where('regions.name', 'Mamou')->select('regions.id')->first();

                if (isset($region_id)) {
                    $annonces = AdsHelper::ads_by_reg($region_id['id'], $sort, $direction);
                    
                    $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                                                        DB::raw("COUNT(annonces.category_id) as total_ads"))
                                                        ->leftJoin('annonces', function ($join) use ($region_id) {
                                                            $join->on('categories.id', '=', 'annonces.category_id')
                                                            ->where('annonces.region_id', $region_id['id']);
                                                        })->groupBy('categories.id')->get();
                }

                return view('annonces.list',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            //faranah
            case 'faranah':
                $list_region = "Faranah";
                $region_id = Region::where('regions.name', 'Faranah')->select('regions.id')->first();

                if (isset($region_id)) {
                    $annonces = AdsHelper::ads_by_reg($region_id['id'], $sort, $direction);
                    
                    $number_per_catsubcats = Category::select('categories.id', 'categories.name',
                                                        DB::raw("COUNT(annonces.category_id) as total_ads"))
                                                        ->leftJoin('annonces', function ($join) use ($region_id) {
                                                            $join->on('categories.id', '=', 'annonces.category_id')
                                                            ->where('annonces.region_id', $region_id['id']);
                                                        })->groupBy('categories.id')->get();
                }

                return view('annonces.list',
                    compact('annonces', 'list_category', 'list_subcategory', 'list_ville','list_region', 'number_per_catsubcats', 'favorites', 'sort_type'));

            default:
                return abort(401);
        }

    }


}
