@extends('user.user_layout')

@section('content')

@include('includes.carbon')

<div class="row">
    <div class="col col-lg-10">
        <div class="filter1 d-flex flex-wrap px-lg-0 mb-2">
            <div class="py-1">
                Total : @if ($annonces->isNotEmpty())
                {{ $annonces->total()}}@else {{ $annonces->count()}} 
                @endif 
            </div>


            <div id="sortBy" class="ml-auto p-0 position-relative border" style="width:150px;">
                <button id="sortBymenutoggle" class="btn shadow-none px-2 w-100">
                    <span class="float-left">{{ $sort_type ? $sort_type : 'Tri : Défaut'}}</span>
                    <i class="fa fa-angle-down float-right" style="font-size:20px;"></i>
                </button>
                <ul id="sortBymenu" class="list-group position-absolute my-0 w-100" 
                style="z-index:10000; display:none;">

                    <li class="list-group-item px-0 py-1">
                        <a href="{{ Request::url() }}" class="d-block px-2 m-0 text-decoration-none a-grey">
                            Tri : Défaut
                        </a>
                    </li>

                    <li class="list-group-item px-0 py-1">
                        <a class="d-block px-2 m-0 text-decoration-none a-grey"
                        href="{{ Request::fullUrlWithQuery(['sort' => 'created_at', 'direction' => 'desc']) }}">
                            Plus recent
                        </a>
                    </li>

                    <li class="list-group-item px-0 py-1">
                        <a class="d-block px-2 m-0 text-decoration-none a-grey"
                        href="{{ Request::fullUrlWithQuery(['sort' => 'created_at', 'direction' => 'asc']) }}">
                            Plus ancien
                        </a>
                    </li>

                </ul>
            </div> 
            


        </div>
    </div>
</div>


@if ($annonces->isEmpty())
<div class="row">
    <div class="col">
        <h3 class="py-5 text-center">Vous n'avez aucune annonce</h3>
    </div>
</div>
@endif


<div class="row px-2 px-md-0 my-ads">
    
    <div class="col col-lg-10 my-ads">
    @foreach ($annonces as $annonce)

    <div class="row mt-2 position-relative border">
        <div class=" col-4 mb-sm-0 img-bloc position-relative border">
            <img src="/uploads/@if ($annonce->number_photo > 0){{$annonce->photo_link}}{{$annonce->thumbnail}}
                @else{{"photos/placeholder.png"}}@endif" class="mh-100 mw-100 el-center" alt=""> 
            <span class="badge py-1 px-2 position-absolute font-weight-bold text-white"><i
                class="fa fa-picture-o mr-1"></i>{{ $annonce->number_photo ? $annonce->number_photo:'0'}}</span>
        </div>
        
        <div class="col-8 position-relative txt-block p-2 p-sm-3">
            <a class="text-decoration-none h5 text-dark d-block text-truncate mr-4"
            href="{{ route('ad.detail', ['ville' => str_slug($annonce->ville_name,'-') , 'category' => str_slug($annonce->category,'-') , 'slug' => $annonce->slug]) }}">
                {{ $annonce->title }}
            </a>
            <div class="mt-0 ">
                <span>Réf : {{$annonce->identifiant}}</span>
                @if ($annonce->suspended)
                    <span class="badge badge-pill badge-warning ml-3">Suspendue</span>
                @else
                    <span class="badge badge-pill badge-info ml-2">Active</span>
                @endif
                
            </div>
            <div class="my-1">
                <span>{{$annonce->sub_category}}</span> 
            </div>
            <div class="my-1">
                <span class="text-muted"> 
                    <?php $ad_created_at = Carbon::parse($annonce->created_at); ?>
                    <i class="fa fa-clock-o mr-1"></i>
                    @if ($ad_created_at->isCurrentDay()) 
                        {{$ad_created_at->calendar()}}
                    @elseif ($ad_created_at->isYesterday()) 
                        {{$ad_created_at->calendar()}}
                    @elseif ($ad_created_at->isCurrentYear())
                        {{$ad_created_at->isoFormat('DD MMM HH:mm')}}
                    @else 
                        {{$ad_created_at->isoFormat('lll')}}
                    @endif
                </span>
                <span class="ml-3">
                    <i class="fa fa-eye mr-1"></i>
                    {{ $annonce->views }}
                </span>
            </div>
            <div class="my-1 text-muted">
                <span class=""> 
                    <?php $ad_last_visit = Carbon::parse($annonce->last_visit); ?>
                    Vue : 
                    @if ($ad_last_visit->isCurrentDay()) 
                        {{$ad_last_visit->calendar()}}
                    @elseif ($ad_last_visit->isYesterday()) 
                        {{$ad_last_visit->calendar()}}
                    @elseif ($ad_last_visit->isCurrentYear())
                        {{$ad_last_visit->isoFormat('DD MMM HH:mm')}}
                    @else 
                        {{$ad_last_visit->isoFormat('lll')}}
                    @endif 
                </span>
                <span class="ml-3">
                    <i class="fa fa-heart mr-1"></i>
                    {{ $annonce->total_favs }}
                </span>
            </div>

            <div class="dropdown position-absolute actions ">
                <i class="material-icons mr-2 mt-2" id="myadActiondropdownBtn" data-toggle="dropdown" 
                aria-haspopup="true" aria-expanded="false">more_vert</i>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="myadActiondropdownBtn">
                    <a class="dropdown-item px-2 border-bottom" href="{{ route('sponsor.ad.form', ['id' => $annonce->id]) }}">
                        <i class="fa fa-tag mr-1"></i>
                        Sponsoriser
                    </a>
                    <a class="dropdown-item px-2 border-bottom" href="{{ route('edit.ad', ['id' => $annonce->id]) }}">
                        <i class="fa fa-edit mr-1"></i>
                        Modifier
                    </a> 
                    <button type="submit" class="dropdown-item px-2" name="deleteAd"
                    id="deleteAd{{$annonce->id}}" value="{{$annonce->id}}" >
                        <i class="fa fa-remove mr-1"></i>Supprimer
                    </button>
                </div>
            </div>
            
        </div>
    </div>
    
    
    @endforeach
    </div>

</div>

<div class="row mt-3">
    <div class="col">
        {{$annonces->render()}}
    </div>
</div>

@stop