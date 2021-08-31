<?php

namespace App\Http\Controllers;

use App\Helpers\CompteHelper;
use App\Helpers\AdsHelper;
use File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Annonce;
use App\Favorite;  
use App\Photo;
use App\AttributeValue;
use App\ReportedAd;
use App\SponsoredAd;
use App\Message;
use App\Compte;
use App\Professionnel;
use App\Following;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.profile');
    }

    public function recherche()
    {
        return view('user.recherches');
    }

    public function annonce(Request $request)
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
            }
        }
        // sort param
        $sort = trim($request->input('sort'));
        $sort = $sort ? $sort : 'created_at';
        // sort direction
        $direction = trim($request->input('direction'));
        $direction = in_array($direction, ['desc', 'asc']) ? $direction : 'desc';

        $annonces = Annonce::select('annonces.id', 'annonces.identifiant','annonces.title','annonces.slug',
                'annonces.last_visit', 'annonces.created_at', 'suspended', 'views','photos.thumbnail',
                'photos.number as number_photo', 'photos.photo_link', 'villes.name as ville_name', 
                'categories.name as category', 'category_items.name as sub_category',
                DB::raw("COUNT(favorites.annonce_id) as total_favs"))
                ->leftJoin('photos', function ($join){
                        $join->on('photos.annonce_id', '=', 'annonces.id');
                    })
                ->join('villes', function ($join){
                        $join->on('annonces.ville_id', '=', 'villes.id');
                    })
                ->join('categories', function ($join){
                        $join->on('annonces.category_id', '=', 'categories.id');
                    })
                ->join('category_items', function($join) {
                    $join->on('annonces.category_item_id', '=', 'category_items.id');
                    })
                ->leftJoin('favorites', 'annonces.id', '=', 'favorites.annonce_id')
                ->groupBy('annonces.id')
                ->where('annonces.compte_id', Auth::user()->id)
                ->orderBy($sort, $direction)->paginate(10);

        return view('user.annonces', compact('annonces','sort_type'));
    }

    public function favori()
    {
        $annonces = Annonce::select('annonces.id', 'annonces.title','annonces.slug',
                'photos.thumbnail', 'photos.number as number_photo', 'photos.photo_link',
                'villes.name as ville_name', 'categories.name as category')
                ->leftJoin('photos', function ($join){
                        $join->on('photos.annonce_id', '=', 'annonces.id');
                    })
                ->join('villes', function ($join){
                        $join->on('annonces.ville_id', '=', 'villes.id');
                    })
                ->join('categories', function ($join){
                        $join->on('annonces.category_id', '=', 'categories.id');
                    })
                ->whereIn('annonces.id', function($query){
                    $query->select('annonce_id')
                        ->from(with(new Favorite)->getTable())
                        ->where('compte_id', Auth::user()->id);
                })
                ->get();
        return view('user.favoris', compact('annonces'));
    }

    public function information() 
    {
        return view('user.infos');
    }

    public function message()
    {
        $messages = Message::join('annonces', 'messages.annonce_id', '=', 'annonces.id')
            ->select('messages.*', 'annonces.identifiant')
            ->where([
                ['messages.compte_id', '=', Auth::user()->id],
                ['messages.seen', '=', 0]
            ])->get();

            Message::where('seen', 0)->update(['seen' => 1]);

        return view('user.messages', compact('messages'));
    }

    // delete ad
    public function deleteAd(Request $request){
        $res = AdsHelper::delete_ad($request->annonceid);

        if ($res){
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    } 

    // delete compte
    public function deleteCompte($compte_id){

        $res = CompteHelper::delete_compte($compte_id);
        
        if ($res){
            Auth::logout();
            return redirect()->route('index');
        }else{
            return redirect()->back();
        }
    }

}
