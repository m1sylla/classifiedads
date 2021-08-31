<?php

namespace App\Http\Controllers;

use App\Annonce as Annonce;
use App\Attribute as Attribute;
use App\AttributeValue as AttributeValue;
use App\Category as Category;
use App\CategoryItem as CategoryItem;
use App\CategoryItemAttribute as CategoryItemAttribute;
use App\NewAdProcess as NewAdProcess;
use App\PriceOption as PriceOption;
use App\Region as Region;
use App\Ville as Ville;
use Carbon\Carbon as Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str as Str;

class ManageAdController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('confirmed.user');
    }

    // new ad page
    public function newAd()
    {
        $categories = Category::all();
        $sub_categories = CategoryItem::all();
        $regions = Region::all();
        $villes = Ville::all();
        $price_options = PriceOption::all();
        return view('annonce.new_ad', compact('categories', 'sub_categories', 'regions', 'villes', 'price_options'));
    }

    // create new ad
    public function createAd(Request $request)
    {
        //return redirect()->route('ad.photo.form', 5);

        $request->validate([
            'category' => 'required|string',
            'location' => 'required|string',
            'sector_name' => 'nullable|string',
            'is_new' => 'required',
            'is_offer' => 'required',
            'title' => 'required|string|min:5',
            'description' => 'required|string|min:10',
            'price' => 'nullable|regex:/(^[0-9 ]+$)+/',
            'price_option_id' => 'nullable|string',
            'ad_email' => 'required|string|email',
            'ad_phone' => 'required|regex:/^[0-9\s]{9,12}$/',
        ]);

        if ($request->price) {
            $request->price = preg_replace('/\s+/', '', $request->price);
        }

        $tp_cat = explode(";", $request->category);
        $tp_loc = explode(";", $request->location);
        $category_id = $tp_cat[0];
        $category_item_id = $tp_cat[1];
        $region_id = $tp_loc[0];
        $ville_id = $tp_loc[1];

        if (Str::length($request->title) > 100) {
            $request->title = Str::limit($request->title, 100);
        }
        if (Str::length($request->description) > 1500) {
            $request->description = Str::limit($request->description, 1500);
        }

        // create ad
        $ann = Annonce::create([
            'compte_id' => $request->compte_id,
            'category_id' => $category_id,
            'category_item_id' => $category_item_id,
            'region_id' => $region_id,
            'ville_id' => $ville_id,
            'sector_name' => $request->sector_name,
            'is_offer' => $request->is_offer,
            'is_new' => $request->is_new,
            'title' => $request->title,
            'description' => $request->description,
            'ad_email' => $request->ad_email,
            'ad_phone' => $request->ad_phone,
            'price' => $request->price,
            'price_option_id' => $request->price_option_id,
            'views' => 1,
            'last_visit' => Carbon::now(),
        ]);

        $slug = Str::slug($request->title, '-') . '-' . $ann->id;
        $ann->slug = $slug;

        $random_size = (int) $ann->id;
        if ($random_size < 1000) {
            $ann->identifiant = '000' . $ann->id;
        } else {
            $ann->identifiant = $ann->id;
        }

        $ann->save();

        //event(new NewAdEvent($request, $ann));

        if ($ann) {

            switch ($request->submit) {
                case 'save':
                    Session::flash('ad_added_success', "Votre annonce a été ajoutée.");
                    return redirect()->route('ad.added.success', $ann->id);
                    break;
                case 'photo':
                    // Photo
                    $processus = NewAdProcess::create([
                        'annonce_id' => $ann->id,
                        'token' => sha1(time()),
                    ]);
                    return redirect()->route('ad.photo.form', $processus->token);
                    break;
            }

        } else {
            return abort(401);
        }

    }

    // new ad success
    public function adAddedSuccess($id)
    {

        //$time = Carbon::now()->subMinutes(1);
        //['annonces.created_at', '>', $time],

        $annonce = DB::table('annonces')
            ->where([
                ['annonces.id', '=', $id],
                ['annonces.compte_id', '=', Auth::user()->id],
            ])
            ->select('annonces.id', 'annonces.slug', 'villes.name as ville_name', 'categories.name as category')
            ->join('villes', function ($join) {
                $join->on('annonces.ville_id', '=', 'villes.id');
            })
            ->join('categories', function ($join) {
                $join->on('annonces.category_id', '=', 'categories.id');
            })
            ->first();

        if ($annonce) {
            return view('annonce.ad_added_success', compact('annonce'));
        } else {
            return abort(401);
        }

    }

    // edit ad
    public function editAd($id)
    {
        $categories = Category::all();
        $sub_categories = CategoryItem::all();
        $regions = Region::all();
        $villes = Ville::all();
        $price_options = PriceOption::all();

        $annonce = Annonce::where('annonces.id', $id)
            ->get();

        $subcat_attibutes = CategoryItemAttribute::select('attribute_id')
            ->where('category_item_attributes.category_item_id', $annonce[0]->category_item_id)
            ->get();

        $attributes = Attribute::whereIn('attributes.id', $subcat_attibutes)->get();
        $attribute_values = AttributeValue::where('attribute_values.annonce_id', $annonce[0]->id)->get();

        return view('annonce.edit_ad', compact('annonce', 'categories', 'sub_categories', 'regions', 'villes', 'price_options', 'attributes', 'attribute_values'));
    }

    // update ad
    public function updateAd(Request $request)
    {
        // update ad
        $annonce = Annonce::where('id', $request->annonce_id)->first();
        $attribute_values = DB::table('attribute_values')->where('annonce_id', $request->annonce_id)->get();
        //$attribute_values = AttributeValue::where('attribute_values.annonce_id', $request->annonce_id)->get();
        $ad_modify = false;
        if ($request->sector_name) {
            if ($annonce->sector_name != $request->sector_name) {
                $annonce->sector_name = $request->sector_name;
                $ad_modify = true;
            }
        }

        if ($annonce->title != $request->title) {
            if (Str::length($request->title) > 100) {
                $request->title = Str::limit($request->title, 100);
            }
            $annonce->title = $request->title;
            $ad_modify = true;
        }

        if ($annonce->description != $request->description) {
            if (Str::length($request->description) > 1500) {
                $request->description = Str::limit($request->description, 1500);
            }
            $annonce->description = $request->description;
            $ad_modify = true;
        }

        if ($request->price) {
            if ($annonce->price != $request->price) {
                $annonce->price = $request->price;
                $ad_modify = true;
            }
        }

        if ($request->price_option_id) {
            if ($annonce->price_option_id != $request->price_option_id) {
                $annonce->price_option_id = $request->price_option_id;
                $ad_modify = true;
            }
        }

        if ($ad_modify) {
            $annonce->save();
        }

        // collect new attributes
        $collection_attributes = collect([]);
        $attr_modify = false;
        if ($request->has('attribute_id')) {
            $attr_number = count($request->attribute_id);
            if ($attr_number > 0) {

                for ($i = 0; $i < $attr_number; $i++) {
                    if (!$attribute_values->contains('attribute_id', $request->attribute_id[$i])) {
                        $collection_attributes = $collection_attributes->concat([
                            [
                                'annonce_id' => $request->annonce_id,
                                'attribute_id' => $request->attribute_id[$i],
                                'value' => $request->attribute_value[$i],
                            ],
                        ]);
                        $attr_modify = true;
                    }
                }
            }
        }

        if ($attr_modify) {
            $collection_attributes = $collection_attributes->toArray();
            AttributeValue::insert($collection_attributes);
        }
        if ($ad_modify || $attr_modify) {
            Session::flash('ad_modified_success', "Votre annonce a été mise à jour.");
        }

        return redirect()->back();
    }

    // delete ad
    public function deleteAd(Request $request)
    {
        // delete ad
    }

    // ad attribute form
    public function attributeAdForm($token)
    {
        // processus nouvelle ann
        $processus = DB::table('new_ad_processes')
            ->where('new_ad_processes.token', '=', $token)->first();

        //dd($ann);
        if ($processus) {

            if ($processus->ended) {
                return abort(404);
            }

            $ann = Annonce::where('annonces.id', $processus->annonce_id)
                ->select('category_item_id')->first();
            $id = $processus->annonce_id;

            $attributes = Attribute::whereIn('attributes.id', function ($query) use ($ann) {
                $query->select('attribute_id')
                    ->from('category_item_attributes')
                    ->where('category_item_attributes.category_item_id', $ann->category_item_id);
            })->get();

            if ($attributes->isEmpty()) {
                Session::flash('ad_added_success', "Votre annonce a été ajoutée.");
                return redirect()->route('ad.added.success', $processus->annonce_id);
            }

            return view('annonce.ad_criteria', compact('id', 'attributes'));
        } else {
            return abort(401);
        }

    }
    // ad attribute create
    public function attributeAdCreate(Request $request)
    {
        // processus
        $processus = NewAdProcess::where('new_ad_processes.annonce_id', $request->annonce_id)->first();

        if (!$processus) {
            return abort(401);
        }
        if ($processus->ended) {
            return abort(401);
        }

        $collection_attributes = collect([]);
        $attr_number = count($request->attribute_id);

        for ($i = 0; $i < $attr_number; $i++) {
            $collection_attributes = $collection_attributes->concat([
                [
                    'annonce_id' => $request->annonce_id,
                    'attribute_id' => $request->attribute_id[$i],
                    'value' => $request->attribute_value[$i],
                ],
            ]);
        }
        if ($collection_attributes) {
            $collection_attributes = $collection_attributes->toArray();
            AttributeValue::insert($collection_attributes);
        }
        Session::flash('ad_added_success', "Votre annonce a été ajoutée.");
        return redirect()->route('ad.added.success', $request->annonce_id);
    }

    // sponsor ad
    public function sponsorAdForm($id)
    {
        $annonce = Annonce::where('id', $id)
            ->select('id', 'identifiant')->first();

        return view('annonce.sponsor_ad', ['annonce' => $annonce]);
    }
    // sponsor ad
    public function sponsorAdStore(Request $request)
    {
    }
}
