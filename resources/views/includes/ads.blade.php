<div class="row mt-2 position-relative ads border">
    <div class="col-5 col-sm-4 mb-sm-0 img-bloc position-relative border">
        <img src="/uploads/@if ($annonce->number_photo > 0){{$annonce->photo_link}}{{$annonce->thumbnail}}
            @else{{"photos/placeholder.png"}}@endif" class="mh-100 mw-100 el-center" alt="{{ $annonce->title }}"> 
        <span class="badge py-1 px-2 position-absolute font-weight-bold text-white"><i
            class="fa fa-picture-o mr-1"></i>{{ $annonce->number_photo ? $annonce->number_photo:'0'}}</span>
    </div>
    
    <div class="col-7 col-sm-8 position-static txt-block p-2">
        <a class="text-decoration-none titre-annonce h5 text-dark stretched-link d-inline-block"
        href="{{ route('ad.detail', ['ville' => str_slug($annonce->ville_name,'-') , 'category' => str_slug($annonce->category,'-') , 'slug' => $annonce->slug]) }}">
            {{ $annonce->title }}
        </a>
        <div class="my-1 price">
            <p class="h5 d-inline"> 
                @if ($annonce->price)  {{ inserer_espace_string($annonce->price,3,true) }} GNF @endif
            </p>
            @if ($annonce->price_option)
            <span class="badge badge-pill badge-light">
                {{ $annonce->price_option }}
            </span>
            @endif
        </div>
        
        <h6 class="my-0 text-muted">
            {{$annonce->sub_category}}
        </h6>
        <h6 class="my-0 text-muted">
            {{$annonce->ville_name}} @if ($annonce->sector_name)  , {{ $annonce->sector_name}} @endif
        </h6>

        <span class="pt-1 text-muted"> 
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
        </span>

        <!-- fav -->
        <button type="submit" class="border bg-white p-1 position-absolute fav" 
        id="deletefavourite{{$annonce->id}}" value="{{$annonce->id}}"
        name="addfavourite" 
        style=" {{ $favorites->contains('annonce_id',$annonce->id) ? '' : 'display: none;' }}" >
            <i class="fa fa-heart" style="color:#e25739;"></i>
        </button>
        <button type="submit" class="border bg-white p-1 position-absolute fav"
        id="addfavourite{{$annonce->id}}" value="{{$annonce->id}}"
        name="deletefavourite"
        style="{{ $favorites->contains('annonce_id',$annonce->id) ? 'display: none;' : '' }}" >
            <i class="fa fa-heart-o"></i>
        </button>
        <!-- end fav  -->
        
        <a href="{{ route('ad.detail', ['ville' =>str_slug($annonce->ville_name,'-') ,'category' =>str_slug($annonce->category,'-') , 'slug' => $annonce->slug]) }}"
        class="btn text-decoration-none position-absolute voir-annonce text-white d-none d-sm-inline-block">
            Voir
        </a>
    
    </div>
</div>
