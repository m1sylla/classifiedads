<?php

namespace App\Listeners;

use App\Photo as Photo;

use Illuminate\Support\Arr;
use Carbon\Carbon as Carbon;
use Illuminate\Support\Str as Str;
use  Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;
use Image;
use File;
use Illuminate\Http\Request;

use App\Events\NewAdEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddPhotoListener
{

    /**
     * Handle the event.
     *
     * @param  NewAdEvent  $event
     * @return void
     */
    public function handle(NewAdEvent $event)
    {
        /*
        $photos = new  Photo();
        $allowedfileExtensions=['jpg','png','jpeg'];
        $dt = Carbon::now();
        $paths  = [];
        $link = 'photos/'.$dt->year.'/'.$dt->month.'/'.$dt->day.'/';
        $count_photo = 1;

        for ($i=0; $i < 12; $i++) { 
            $photo_attr = 'photo'.$i;
            $rotate_attr = 'rotate'.$i;

            if ($event->request->has($photo_attr) && $event->request->hasFile($photo_attr)) {
                $extension = $event->request->file($photo_attr)->getClientOriginalExtension();
                $checkExtension = in_array($extension,$allowedfileExtensions);

                if ($checkExtension) {
                    $filename  = Str::slug(Str::limit($event->request->title, 30), '-').'-' .$event->ann->id.''.$count_photo.'.'.$extension;
                    $paths[]   = $event->request->file($photo_attr)->storeAs($link, $filename,'public_uploads');
                    
                    $img = Image::make('uploads/'.$link.$filename);
                    $img->orientate();
                    $img->rotate(-$event->request->input($rotate_attr));
                    $img->insert('uploads/watermark.png', 'bottom-right', 10, 10);
                    
                    $img->save('uploads/'.$link.$filename);

                    switch($count_photo) {
                        case 1:
                            $photos->photo1 = $filename;
                            break;
                        case 2:
                            $photos->photo2 = $filename;
                            break;
                        case 3:
                            $photos->photo3 = $filename;
                            break;
                        case 4:
                            $photos->photo4 = $filename;
                            break;
                        case 5:
                            $photos->photo5 = $filename;
                            break;
                        case 6:
                            $photos->photo6 = $filename;
                            break;
                        case 7:
                            $photos->photo7 = $filename;
                            break;
                        case 8:
                            $photos->photo8 = $filename;
                            break;
                        case 9:
                            $photos->photo9 = $filename;
                            break;
                        case 10:
                            $photos->photo10 = $filename;
                            break;
                        case 11:
                            $photos->photo11 = $filename;
                            break;
                        case 12:
                            $photos->photo12 = $filename;
                            break;
                    }
                    $count_photo++;
                }
                

            }

        }

        if ($count_photo > 1) {
            $photos->annonce_id = $event->ann->id;
            $photos->number = $count_photo - 1;
            $photos->photo_link = $link;
            $photos->save();
        }
        */
    }

}
