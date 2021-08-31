<?php
namespace App\Helpers;

use File as File;
use Illuminate\Support\Facades\DB;
use App\Annonce;
use App\Favorite;
use App\Compte;
use App\Professionnel;
use App\Message;
use App\Following;

use App\Photo;
use App\AttributeValue;
use App\ReportedAd;
use App\SponsoredAd;


class CompteHelper
{

    /** delete compte */
    static function delete_compte($compte_id){
        //$deleteCompte = Compte::where('id',$compt_id)->delete();
        $deleteCompte = Compte::find($compte_id);
        $deleteCompte->delete();
        if ($deleteCompte) {
            
            // data related to user's ads
            $ads_photos = Photo::whereIn('annonce_id', function($query) use ($compte_id){
                $query->select('id')
                ->from(with(new Annonce)->getTable())
                ->where('compte_id', $compte_id);
            })->get();

            // delete files
            foreach ($ads_photos as $ads_photo) {
                if ($ads_photo->thumbnail) {
                    //$all_photos[] = "uploads/{$ads_photo->link}{$ads_photo->thumbnail}";
                    File::delete("uploads/{$ads_photo->photo_link}{$ads_photo->thumbnail}");
                }

                for ($i=1; $i <=20 ; $i++) { 
                    $img = "photo{$i}";
                    if ($ads_photo->$img) {
                        //$all_photos[] = "uploads/{$ads_photo->link}{$ads_photo->$img}";
                        File::delete("uploads/{$ads_photo->photo_link}{$ads_photo->$img}");
                    }
                }

            }
            // end delete files

            Favorite::whereIn('annonce_id', function($query) use ($compte_id){
                $query->select('id')
                ->from(with(new Annonce)->getTable())
                ->where('compte_id', $compte_id);
            })->delete();

            ReportedAd::whereIn('annonce_id', function($query) use ($compte_id){
                $query->select('id')
                ->from(with(new Annonce)->getTable())
                ->where('compte_id', $compte_id);
            })->delete();

            AttributeValue::whereIn('annonce_id', function($query) use ($compte_id){
                $query->select('id')
                ->from(with(new Annonce)->getTable())
                ->where('compte_id', $compte_id);
            })->delete();

            Photo::whereIn('annonce_id', function($query) use ($compte_id){
                $query->select('id')
                ->from(with(new Annonce)->getTable())
                ->where('compte_id', $compte_id);
            })->delete();

            SponsoredAd::whereIn('annonce_id', function($query) use ($compte_id){
                $query->select('id')
                ->from(with(new Annonce)->getTable())
                ->where('compte_id', $compte_id);
            })->delete();

            Message::whereIn('annonce_id', function($query) use ($compte_id){
                $query->select('id')
                ->from(with(new Annonce)->getTable())
                ->where('compte_id', $compte_id);
            })->delete();
            // end data related to user's ads

            // data related to user
            Annonce::where('compte_id', $compte_id)->delete();
            Favorite::where('compte_id', $compte_id)->delete();
            Professionnel::where('compte_id', $compte_id)->delete();
            Message::where('compte_id', $compte_id)->delete();
            Following::where('is_followed_id', $compte_id)->delete();
            Following::where('is_following_id', $compte_id)->delete();
            // end data related to user
            
            return true;
        }
        
        return false;
    }
    
    /** suspend or free compte */
    static function suspend_compte($compte_id){
        
        $compte = Compte::find($compte_id);

        if ($compte) {
            if ($compte->suspended) {
                //Compte::where('id', $compte_id)->update(['suspended' => 0]);
                $compte->suspended = 0;
                $compte->save();
                Annonce::where('compte_id', $compte_id)->update(['suspended' => 0]);
                return true;
            } else {
                //Compte::where('id', $compte_id)->update(['suspended' => 1]);
                $compte->suspended = 1;
                $compte->save();
                Annonce::where('compte_id', $compte_id)->update(['suspended' => 1]);
                return true;
            }
        }

        return false;
    }

}