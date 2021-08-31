<?php
namespace App\Helpers;

use File as File;

use Illuminate\Support\Facades\DB;
use App\Annonce;
use App\Favorite;  
use App\Photo;
use App\AttributeValue;
use App\ReportedAd;
use App\SponsoredAd;
use App\Message;

class AdsHelper
{
    
    /** ads by cat */
    static function ads_by_cat($cat_id, $sort, $direction) {

        $annonces = DB::table('annonces')
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
        ->select('annonces.id', 'annonces.title','annonces.slug', 
            'annonces.price', 'annonces.sector_name', 'annonces.created_at', 
            'photos.thumbnail', 'photos.number as number_photo', 'photos.photo_link',
            'villes.name as ville_name', 'price_options.name as price_option',
            'categories.name as category', 'category_items.name as sub_category')
        ->where([
            ['annonces.category_id', $cat_id],
            ['suspended', 0],
            ['validated', 1]
        ])->orderBy($sort, $direction)->paginate(25);

        return $annonces;

    }

    
    /** ads by region */
    static function ads_by_reg($reg_id, $sort, $direction) {

        $annonces = DB::table('annonces')
        ->where([
            ['annonces.region_id', $reg_id],
            ['suspended', 0],
            ['validated', 1]
        ])->select('annonces.id', 'annonces.title','annonces.slug', 
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
                    })->orderBy($sort, $direction)->paginate(25);
        
        return $annonces;

    }

    /** ads by type */
    static function ads_by_type($type, $sort, $direction) {
        
        $annonces = Annonce::where([
            ['is_offer', $type],
            ['suspended', 0],
            ['validated', 1]
            ])->select('annonces.id', 'annonces.title', 'annonces.slug',
                'annonces.price', 'annonces.sector_name', 'annonces.created_at',
                'photos.thumbnail', 'photos.number as number_photo', 'photos.photo_link',
                'villes.name as ville_name', 'price_options.name as price_option',
                'categories.name as category', 'category_items.name as sub_category')
            ->leftJoin('photos', function ($join) {
                $join->on('photos.annonce_id', '=', 'annonces.id');
            })
            ->join('villes', function ($join) {
                $join->on('annonces.ville_id', '=', 'villes.id');
            })
            ->leftJoin('price_options', function ($join) {
                $join->on('annonces.price_option_id', '=', 'price_options.id');
            })
            ->join('categories', function ($join) {
                $join->on('annonces.category_id', '=', 'categories.id');
            })
            ->join('category_items', function($join) {
                $join->on('annonces.category_item_id', '=', 'category_items.id');
            })->orderBy($sort, $direction)->paginate(25);;

            return $annonces;
    }

    /* delete ad  */
	static  function delete_ad($annonce_id){
        $deleteAd = Annonce::find($annonce_id);
        $deleteAd->delete();
        if ($deleteAd) {

            $photo = Photo::where('annonce_id',$annonce_id)->first();
            // delete photos
            if (isset($photo)) {
                if ($photo->thumbnail) {
                    File::delete("uploads/{$photo->photo_link}{$photo->thumbnail}");
                }

                for ($i=1; $i <=20 ; $i++) { 
                    $img = "photo{$i}";
                    if ($photo->$img) {
                        File::delete("uploads/{$photo->photo_link}{$photo->$img}");
                    }
                }
            }

            Photo::where('annonce_id', $annonce_id)->delete();
            Favorite::where('annonce_id', $annonce_id)->delete();
            AttributeValue::where('annonce_id', $annonce_id)->delete();
            SponsoredAd::where('annonce_id', $annonce_id)->delete();
            ReportedAd::where('annonce_id', $annonce_id)->delete();
            Message::where('annonce_id', $annonce_id)->delete();
            
            return true;
        }
        
        return false;
    }
    
     /* suspend ad  */
	static  function suspend_ad($annonce_id){
        $ann = Annonce::find($annonce_id);

        if ($ann) {
            if ($ann->suspended) {
                $ann->suspended = 0;
                $ann->save();
                return true;
            } else {
                $ann->suspended = 1;
                $ann->save();
                return true;
            }
        }

        return false;
        
	}

}