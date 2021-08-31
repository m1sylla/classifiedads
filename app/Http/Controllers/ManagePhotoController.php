<?php

namespace App\Http\Controllers;

use App\Annonce as Annonce;
use App\NewAdProcess as NewAdProcess;
use App\Photo;
use Carbon\Carbon as Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str as Str;
use Image;

class ManagePhotoController extends Controller
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

    // photos form
    public function adPhotoForm($token)
    {

        // processus nouvelle ann
        $processus = DB::table('new_ad_processes')
            ->where('new_ad_processes.token', '=', $token)->first();

        if ($processus) {
            if ($processus->ended) {
                return abort(404);
            }

            $annonce = DB::table('annonces')
                ->where('annonces.id', '=', $processus->annonce_id)
                ->select('annonces.id')
                ->first();

            if ($annonce) {
                return view('annonce.ad_photos', ['id' => $annonce->id]);
            } else {
                return abort(401);
            }

        } else {
            return abort(401);
        }

    }

    // photos create
    public function adPhotoCreate(Request $request)
    {
        // processus
        $processus = NewAdProcess::where('new_ad_processes.annonce_id', $request->annonce_id)->first();

        if ($processus) {

            if ($processus->ended) {
                return abort(404);
            }

            $annonce = Annonce::where('annonces.id', $request->annonce_id)
                ->select('id', 'title')->first();

            $photos = new Photo();
            $dt = Carbon::now();
            $link = 'photos/' . $dt->year . '/' . $dt->month . '/' . $dt->day . '/';
            $link_direct = 'uploads/photos/' . $dt->year . '/' . $dt->month . '/' . $dt->day . '/';
            $count_photo = 1;

            for ($i = 0; $i < 12; $i++) {
                $photo_attr = 'photo' . $i;
                $rotate_attr = 'rotate' . $i;

                if ($request->has($photo_attr) && $request->hasFile($photo_attr)) {

                    $filename = Str::slug(Str::limit($annonce->title, 50), '-') . '-' . $annonce->id . '' . $count_photo . '.jpg';

                    $saving_path = public_path() . '/' . $link_direct;
                    if (!File::exists($saving_path)) {
                        File::makeDirectory($saving_path, 0777, true);
                    }

                    $img = Image::make(file_get_contents($request->{$photo_attr}));

                    //$img->orientate();
                    $img->rotate(-$request->input($rotate_attr));
                    $img->insert('uploads/watermark.png', 'bottom-right', 10, 10);

                    if ($photo_attr == 'photo1') {
                        $img_thumb_name = 'thumb_' . $filename;
                        $img_thumb = Image::make(file_get_contents($request->{$photo_attr}));
                        $img_thumb->rotate(-$request->input($rotate_attr));
                        $img_thumb->insert('uploads/watermark.png', 'bottom-right', 10, 10);
                        $img_thumb->resize(280, 220, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                        $img_thumb->save($saving_path . '' . $img_thumb_name);
                    }
                    
                    $img->resize(750, 500, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });

                    $img->save($saving_path . '' . $filename);

                    if ($photo_attr == 'photo1') {
                        $photos->thumbnail = $img_thumb_name;
                    }
                    $photos->{$photo_attr} = $filename;

                    $count_photo++;

                }

            }

            if ($count_photo > 1) {
                $photos->annonce_id = $annonce->id;
                $photos->number = $count_photo - 1;
                $photos->photo_link = $link;
                $photos->save();
            }

            switch ($request->submit) {
                case 'end':
                    $processus->ended = 1;
                    $processus->save();
                    Session::flash('ad_added_success', "Votre annonce a été ajoutée.");
                    $url = '/nouvelle/annonce/' . $annonce->id . '/success';
                    return $url;
                //break;

                case 'attribute':
                    $url = '/annonce/attribute/' . $processus->token;
                    return $url;
            }
        } else {
            return abort(404);
        }

        //return view('annonce.ad_criteria',['id' =>$request->annonce_id]);
        //dd($request);

    }

    // edit photos
    public function editPhotos($id)
    {
        return abort(404);

        $annonce = Annonce::where('annonces.id', $id)
            ->select('id')->first();

        $photo = Photo::where('photos.annonce_id', $annonce->id)->first();

        if ($annonce) {
            return view('annonce.edit_photos', compact('annonce', 'photo'));
        } else {
            return abort(404);
        }

    }

    // update photos
    public function updatePhotos(Request $request)
    {
        // update ad
    }
}