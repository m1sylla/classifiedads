<div class="row mt-3">
    <div class="col">
        <div class="row mx-3 font-weight-bold text-black">
            RECOMMANDATIONS
        </div>

        <div class="row mx-2 mx-lg-0 my-1 border">
            @foreach ($recommanded_ads as $recommanded_ad)
            <div class="col-10 col-sm-6 col-lg-3 float-left p-1 recommand">
                <div class="card">
                    <div class="card-img-top bg-secondary border-bottom img-bloc position-relative">
                        <img class="mh-100 mw-100 position-absolute el-center" src="/uploads/@if ($recommanded_ad->number_photo > 0){{$recommanded_ad->photo_link}}{{$recommanded_ad->photo1}}
                    @else{{"photos/placeholder.png"}}@endif" alt="Car">
                        <button class="position-absolute fav rounded-circle bg-white btn btn-sm"><i
                                class="fa fa-heart-o"></i></button>
                        <span class="badge py-1 px-2 position-absolute font-weight-bold text-white"><i
                                class="fa fa-picture-o mr-1"></i>{{ $recommanded_ad->number_photo }}</span>
                    </div>
                    <div class="card-body p-1">
                        <h5 class="card-title font-weight-bold">{{ $recommanded_ad->title }}</h5>
                        <p class="card-text">
                            @if ($recommanded_ad->price) {{ $recommanded_ad->price }} GNF @endif
                            <span>
                                @if ($recommanded_ad->price_option) {{ $recommanded_ad->price_option }} @endif
                            </span>
                        </p>
                    </div>
                    <div class="card-footer text-muted bg-white p-1">
                        <i class="fa fa-map-marker"></i>
                        <span class="ml-1">
                            {{$recommanded_ad->ville_name}} @if ($recommanded_ad->sector_name) ,
                            {{ $recommanded_ad->sector_name}} @endif
                        </span>
                        <a href="{{ route('ad.detail', ['ville' => slugword($recommanded_ad->ville_name) , 'category' => slugword($recommanded_ad->category) , 'slug' => $recommanded_ad->slug]) }}"
                            class="btn btn-sm btn-outline-light text-muted stretched-link float-right">
                            Voir
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>