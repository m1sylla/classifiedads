@extends('admin.layout')

@section('content')
@include('includes.carbon')

<h5>Annonces </h5>
<hr class="mt-0 mb-3">


@if ($annonces->count() > 0)

@foreach ($annonces as $annonce)
<div class="row my-1">
    <div class="col">
        <div class="border p-2 manage-ad">

            <div>
                <h5>
                    {{$annonce->title}}
                </h5>
            </div>

            @if ($annonce->number_photo)
            <div class="mb-2">
                @for ($i = 1; $i <= 20; $i++) 
                    <?php $curr_photo = "photo{$i}"; ?> 
                    @if ($annonce->$curr_photo)
                    <img src="/uploads/{{$annonce->photo_link}}{{$annonce->$curr_photo}}" height="80" width="100"
                        alt="">
                    @endif
                @endfor
            </div>
            @endif

            <div class="mb-2">
                <span class="h6">Réf :</span>
                <span class="text-muted">{{$annonce->identifiant}}</span> &nbsp;

                <span class="h6">Sous-catégorie :</span>
                <span class="text-muted">{{$annonce->sub_category}}</span> &nbsp;

                <span class="h6">Ville :</span>
                <span class="text-muted">{{$annonce->ville_name}}</span> &nbsp;

                <span class="h6">Ajoutée :</span>
                <span class="text-muted">
                    <?php $ad_created_at = Carbon::parse($annonce->created_at); ?>
                    @if ($ad_created_at->isCurrentDay())
                    {{$ad_created_at->calendar()}}
                    @elseif ($ad_created_at->isYesterday())
                    {{$ad_created_at->calendar()}}
                    @elseif ($ad_created_at->isCurrentYear())
                    {{$ad_created_at->isoFormat('DD MMM HH:mm')}}
                    @else
                    {{$ad_created_at->isoFormat('lll')}}
                    @endif
                </span> &nbsp;

                <span class="h6">Annonceur :</span>
                <span class="text-muted">{{$annonce->first_name}} {{$annonce->last_name}}</span>

            </div>

            <div class="mb-2">
                <span class="h6">Description :</span> {{$annonce->description}}
            </div>

            <div>
                
                <button class="btn btn-sm btn-warning shadow-none" title="Débloquer cette annonce" name="suspend_free_ad" value="{{$annonce->id}}"
                    id="free_ad{{$annonce->id}}" style="{{ $annonce->suspended ? '' : 'display: none;' }}">
                    Débloquer
                </button>
                <button class="btn btn-sm shadow-none" title="Suspendre cette annonce" name="suspend_free_ad" value="{{$annonce->id}}"
                    id="suspend_ad{{$annonce->id}}" style="{{ $annonce->suspended ? 'display: none;' : '' }}">
                    Suspendre
                </button>

                <button class="btn btn-sm btn-danger shadow-none" title="Supprimer cette annonce" name="delete_ad" value="{{$annonce->id}}"
                    id="delete_ad{{$annonce->id}}">
                    Supprimer
                </button>

                <button class="btn btn-sm btn-info shadow-none" title="Valider cette annonce" name="validate_ad" value="{{$annonce->id}}"
                    id="validate_ad{{$annonce->id}}" style="{{ $annonce->validated ? 'display: none;' : '' }}">
                    Valider
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@else
<div class="row my-1">
    <div class="col h4 text-center">
        Aucune nouvelle annonce
    </div>
</div>
@endif


@endsection