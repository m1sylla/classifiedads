<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Annonce as Annonce;
use App\ContactUs as ContactUs; 
use App\ReportedAd;
use App\Message;
use App\Category as Category;
use App\SponsoredAd as SponsoredAd;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class PagesController extends Controller
{
    // home page
    public function index(){  

        $recommanded_ads = collect([]);

        $ads_by_cats = DB::table('annonces')
            ->join('categories', function ($join){
                $join->on('annonces.category_id', '=', 'categories.id');
                })
            ->select('annonces.id','categories.name as category')
            ->where('annonces.validated', true)
            ->get();
            
        /*
        $recommands = SponsoredAd::whereDate('end_at', '>=', Carbon::now())
        ->select('annonce_id')
        ->get(); */

        //if ($recommands->isNotEmpty()) {
            $recommanded_ads = DB::table('annonces')
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
            ->select('annonces.id', 'annonces.title','annonces.slug', 
                'annonces.price', 'annonces.sector_name', 'annonces.created_at', 
                'photos.photo1', 'photos.number as number_photo', 'photos.photo_link',
                'villes.name as ville_name', 'price_options.name as price_option',
                'categories.name as category')
            ->whereIn('annonces.id', function($query){
                $query->select('annonce_id')
                ->from(with(new SponsoredAd)->getTable())
                ->whereDate('end_at', '>=', Carbon::now());
            }) 
            ->get();
        //}
        
        //dd($recommanded_ads);
        return view('index', compact('ads_by_cats', 'recommanded_ads'));
    }

    // page qui sommes nous
    public function about(){ return view('liensutils.about'); }

    // page aide
    public function aide(){ return view('liensutils.aide'); }

    // page condition d'utilisation
    public function useTerm(){ return view('liensutils.use_term'); }

    // page politique de confidentialité
    public function privacyPolicy(){ return view('liensutils.privacy_policy'); }

    // page publicite
    public function publicite(){ return view('liensutils.publicite'); }
    
    // page nous contacter
    public function contact(){ return view('liensutils.contact_us'); }

    // Nous contacter
    public function contactSend(Request $request){ 

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|max:80',
            'phone' => 'required|regex:/^[0-9\s]{9,12}$/',
            'message' => 'required|string'
        ]);

        $contact = ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]); 

        Session::flash('contactus_send_success', "Votre message a été envoyé.");
        return redirect()->back(); 
    } 
    
    // signaler annonce
    public function reportAd($annonce_id){ 
        return view('liensutils.flag_ad', compact('annonce_id')); 
    }
    public function reportAdStore(Request $request){ 
        $request->validate([
            'annonce_id' => 'required|string',
            'title' => 'required|string',
            'message' => 'required|string|max:250',
        ]);
        $report = ReportedAd::create([
            'annonce_id' => $request->annonce_id,
            'title' => $request->title,
            'message' => $request->message,
        ]); 
        Session::flash('ad_reported_success', "Votre plainte a été ajoutée.");
        return redirect()->back(); 
    }

    // message to seller
    public function messageToSeller(Request $request){ 
        $request->validate([
            'compte_id' => 'required',
            'annonce_id' => 'required',
            'name' => 'required|string',
            'phone' => 'required|regex:/^[0-9\s]{9,12}$/',
            'email' => 'required|string|email|max:80',
            'message' => 'required|string|max:250',
        ]);
        $message = Message::create([
            'compte_id' => $request->compte_id,
            'annonce_id' => $request->annonce_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]); 
        Session::flash('message_sent_seller_success', "Votre message a été ajouté.");
        return redirect()->back(); 
    }

}
