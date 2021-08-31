@extends('user.user_layout')

@section('content')

<div class="row px-2 px-md-0 my-favoris">

    @if ($annonces->isEmpty())
    <div class="col">
        <h3 class="py-5 text-center">Vous n'avez aucun favori</h3>
    </div>
    @endif

    @foreach ($annonces as $annonce)
    <div class="card mb-2 mr-2">
        <a href="{{ route('ad.detail', ['ville' => str_slug($annonce->ville_name,'-') , 'category' => str_slug($annonce->category,'-') , 'slug' => $annonce->slug]) }}" 
        class="card-img-top bg-secondary position-relative" style="">
            <img class="mh-100 mw-100 position-absolute el-center" 
            src="/uploads/@if ($annonce->number_photo > 0){{$annonce->photo_link}}{{$annonce->thumbnail}}
            @else{{"photos/placeholder.png"}}@endif" alt="Car">
            <span class="badge py-1 px-2 position-absolute font-weight-bold text-white">
                <i class="fa fa-picture-o mr-1"></i> {{ $annonce->number_photo ? $annonce->number_photo:'0' }}
            </span>
        </a>
        <div class="card-body p-1">
            <h5 class="card-title my-1 text-truncate">{{ $annonce->title }}</h5>
            
            <button type="submit" class="btn btn-sm btn-primary" name="removeFromFavourite"
                id="removefromfavlist{{$annonce->id}}" value="{{$annonce->id}}" >Supprimer
            </button>
        </div>
    </div>
    @endforeach

</div> 

@stop