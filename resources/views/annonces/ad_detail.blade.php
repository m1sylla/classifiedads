@include('includes.carbon')
<?php
use Illuminate\Support\Facades\DB;
use App\Annonce as Annonce;
DB::table('annonces')->where('id',$annonce->id)->increment('views',1, ['last_visit' => Carbon::now()]);

$ad_has_img = false;
if (isset($photo)){
    if ($photo->photo1){
        $ad_has_img = true;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Guinée, Annonces, Yetecan, {{$annonce->category? $annonce->category : '' }}, {{$annonce->sub_category? $annonce->sub_category : '' }}">
    <meta name="description" content="Annonces en Guinée. {{ $annonce->title }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ $annonce->title }} &#124; Yetecan.com </title>

    <!--- Twitter meta -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@yetecan" />
    <meta name="twitter:creator" content="@yetecan" />

    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    <meta property="og:url"         content="{{ route('ad.detail', ['ville' => str_slug($annonce->ville_name,'-') , 'category' => str_slug($annonce->category,'-') , 'slug' => $annonce->slug]) }}" />
    <meta property="og:type"        content="website" />
    <meta property="og:title"       content="{{$annonce->title}}" />
    <meta property="og:description" content="{{$annonce->description}}" />
    @if ($ad_has_img)
    <meta property="og:image"       content="{{asset("/uploads/{$photo->photo_link}{$photo->photo1}")}}" />
    @else
    <meta property="og:image"       content="{{asset('/uploads/photos/placeholder.png')}}" />
    @endif
    <meta property="fb:app_id"      content="278664080029267" />

    <!----  favicon  --->
    <link rel="shortcut icon" type="image/png" href="/uploads/favicon-192.png">
    <link rel="shortcut icon" sizes="192x192" href="/uploads/favicon-192.png">
    <link rel="apple-touch-icon" href="/uploads/favicon-192.png">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/custom.css">
    <script src="https://kit.fontawesome.com/yourcode.js"></script>

    <!---  google icons  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>

<body>
    <!--- FB load SDK  --->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '278664080029267',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v7.0'
            });
        };
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>


    <!-- espace publicitaire top -->
    @include('includes.pub.top')
    <!-- end espace publicitaire top -->

    <!-- header -->
    <header class="">
        @include('includes.navbar')
        @include('includes.search_ad')
    </header>
    <!-- end header -->

    <main class="">

        <!-- espace publicitaire interne top -->
        @include('includes.pub.inside_top')
        <!-- end espace publicitaire interne top -->

        
        <div class="row">
            <div class="col">
                <div class="mt-2 px-2">
                    @if ($annonce->ville_name) 
                    <a class="color-blue hover-color-blue font-weight-bold"
                    href="{{ route('ads.search', ['location' => ';'.$annonce->ville_name, 'category' => '']) }}">
                        {{$annonce->ville_name}}
                    </a> 
                    @endif

                    <i class="fa fa-chevron-right text-muted mx-2" style="font-size:10px;"></i>
                    @if ($annonce->category) 
                    <a class="color-blue hover-color-blue font-weight-bold"
                    href="{{ route('ads.search', ['location' => ';'.$annonce->ville_name, 'category' => $annonce->category.';']) }}">
                        {{$annonce->category}} 
                    </a>
                    @endif

                    <i class="fa fa-chevron-right text-muted mx-2" style="font-size:10px;"></i>
                    @if ($annonce->sub_category)
                    <a class="color-blue hover-color-blue font-weight-bold"
                    href="{{ route('ads.search', ['location' => ';'.$annonce->ville_name, 'category' => $annonce->category.';'.$annonce->sub_category]) }}">
                        {{$annonce->sub_category}} 
                    </a>
                    @endif

                    <i class="fa fa-chevron-right text-muted mx-2" style="font-size:10px;"></i>
                    <span class="font-weight-bold">Référence : {{ $annonce->identifiant}}</span>
                </div>
            </div>
        </div>
        
                <!--- message sent to_seller success  -->
                @if (Session::has('message_sent_seller_success'))
                <div class="row my-3">
                    <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-success" role="alert">
                        <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close"
                            data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="p-2">
                            {{ Session::get('message_sent_seller_success') }}
                        </div>
                    </div>
                </div>
                @endif

        <div class="row ad-detail">
            <div class="col-12 col-md-8">
                <div class="row ">
                    <div class="col py-2 ">
                        <h3 class="px-2">{{$annonce->title}}</h3>
                    </div>
                </div>
                <div class="row bg-white my-1">

                    <div class="col p-0" id="slider">
                        <div id="adDetailCarousel" class="carousel slide">
                            <!-- main slider carousel items -->
                            <div class="carousel-inner border">

                                @if (isset($photo))

                                <!-- first slider -->
                                @if ($photo->photo1)
                                <div class="active carousel-item h-100 position-relative" data-slide-number="0">
                                    <img src="/uploads/{{$photo->photo_link}}{{$photo->photo1}}"
                                        class="mh-100 mw-100 position-absolute el-center">
                                </div>
                                @endif
                                <!-- other sliders -->
                                @for ($i = 1; $i < 20; $i++)
                                <?php $curr_slider = "photo".($i+1); ?> 
                                @if ($photo->$curr_slider)
                                <div class="carousel-item h-100 position-relative" data-slide-number="{{$i}}">
                                    <img src="/uploads/{{$photo->photo_link}}{{$photo->$curr_slider}}"
                                        class="mh-100 mw-100 position-absolute el-center">
                                </div>
                                @endif
                                @endfor

                                <!--- default image -->
                                @else
                                <div class="h-100 position-relative">
                                    <img src="/uploads/photos/placeholder.png"
                                        class="mh-100 mw-100 position-absolute el-center">
                                </div>
                                @endif

                                <!--- carousel nav -->
                                @if (isset($photo))
                                @if ($photo->number > 1)
                                <a class="carousel-control-prev" href="#adDetailCarousel" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon rounded-circle" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#adDetailCarousel" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon rounded-circle" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                @endif
                                @endif
                                <!--- end carousel nav -->

                            </div>
                            <!-- end main slider carousel items -->

                            <!--- carousel indicators -->
                            @if (isset($photo))
                            @if ($photo->number > 1)
                            <ul
                                class="carousel-indicators list-inline w-100 d-flex flex-wrap border border-top-0 px-2 m-0">

                                <!-- first indicator  -->
                                @if ($photo->photo1)
                                <li class="list-inline-item active">
                                    <a class="h-100 w-100 selected" id="carousel-selector-0" data-slide-to="0"
                                        data-target="#adDetailCarousel">
                                        <img src="/uploads/{{$photo->photo_link}}{{$photo->photo1}}"
                                            class="h-100 w-100">
                                    </a>
                                </li>
                                @endif
                                <!-- other indicators  -->
                                @for ($i = 1; $i < 20; $i++)
                                <?php $curr_indicator = "photo".($i+1); ?> 
                                @if ($photo->$curr_indicator)
                                <li class="list-inline-item">
                                    <a class="h-100 w-100" id="carousel-selector-{{$i}}" data-slide-to="{{$i}}"
                                        data-target="#adDetailCarousel">
                                        <img src="/uploads/{{$photo->photo_link}}{{$photo->$curr_indicator}}"
                                            class="h-100 w-100">
                                    </a>
                                </li>
                                @endif
                                @endfor

                            </ul>
                            @endif
                            @endif
                            <!--- end carousel indicators -->

                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col bg-white my-1 py-2 position-relative border">
                        <!--  add to or delete from fav  -->
                        <button type="submit" class="border bg-white p-2 position-absolute"
                            id="deletefavourite{{$annonce->id}}" value="{{$annonce->id}}" name="addfavourite"
                            style="top:2p; right:20px; cursor:pointer; {{ $favorite->isEmpty() ? 'display: none;' : '' }}">
                            <i class="fa fa-heart" style="color:#e25739;"></i>
                        </button>
                        <button type="submit" class="border bg-white p-2 position-absolute"
                            id="addfavourite{{$annonce->id}}" value="{{$annonce->id}}" name="deletefavourite"
                            style="top:2p; right:20px; cursor:pointer; {{ $favorite->isEmpty() ? '' : 'display: none;' }}">
                            <i class="fa fa-heart-o"></i>
                        </button>
                        <!--  end add to or delete from fav  -->

                        <div class="px-2 color-orange">
                            <p class="h4 d-inline">
                                @if ($annonce->price) {{ inserer_espace_string($annonce->price,3,true) }} GNF @endif
                            </p>
                            <span>
                                @if ($annonce->price_option) {{ $annonce->price_option }} @endif
                            </span>
                        </div>
                        <div class="d-flex py-2">
                            <div class=" px-2">
                                <i class="fa fa-map-marker mr-1"></i>
                                {{$annonce->ville_name}} @if ($annonce->sector_name) , {{ $annonce->sector_name}} @endif
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class=" px-2">
                                Ajouté :
                                <span class="text-muted ml-1">
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
                            </div>
                            <div class=" px-2">
                                <i class="fa fa-eye mr-1"></i>
                                {{$annonce->views}} fois
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ad attributes--->
                @if ($attributes->count()>0)
                <div class="row my-1">
                    <div class="col py-2 bg-white border">
                        <div class="row">
                            <div class="col mx-2">
                                <h5 class="font-weight-bold">Critères</h5>
                            </div>
                        </div>
                        <div class="row px-2">
                            @foreach ($attributes as $attribute)
                            <div class="col-6 col-sm-4">
                                <span class="font-weight-bold d-block">
                                    @if ($attribute->name) {{$attribute->name}} @endif
                                </span>
                                <span class="text-muted d-block">
                                    <span>@if ($attribute->value) {{$attribute->value}} @endif</span>
                                    <span>
                                        @if ($attribute->unit) {{$attribute->unit}} @endif
                                        <sup class="to-power">
                                            @if ($attribute->unit_exposant){{$attribute->unit_exposant}} @endif
                                        </sup>
                                    </span>
                                </span>
                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                @endif


                <div class="row">
                    <div class="col bg-white my-1 border">
                        <h3 class="px-2 pt-1">Description</h3>
                        <p class="px-2">
                            {{$annonce->description}}
                        </p>
                    </div>
                </div>

                <!-- envoyer un message-->
                <div class="row" id="send_message_to_seller" style="display:none;">
                    <div class="col bg-white my-1 p-3 border">
                        <h4 class="px-2 pt-1 font-weight-bold">
                            Envoyer un message à @if ($compte->brand){{$compte->brand}}
                            @else{{$compte->first_name}}@endif
                        </h4>

                        <form class="bg-white mt-3 " method="POST" action="{{ route('message.seller') }}">
                            @csrf

                            <input type="hidden" name="compte_id" value="{{$compte->id}}">
                            <input type="hidden" name="annonce_id" value="{{$annonce->id}}">

                            <div class="form-row">
                                <!-- Nom -->
                                <div class="col-sm-6 mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" placeholder="Votre nom">
                                </div>
                                <!-- Numero -->
                                <div class="col-sm-6 mb-3">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" placeholder="Votre numéro">
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col-12 col-sm-6 ">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Votre email">
                                </div>
                                <div class="col d-flex">
                                    <small class="align-self-center px-2 px-sm-0 text-muted">
                                        Le vendeur ne verra pas votre adresse.
                                    </small>
                                </div>
                            </div>

                            <!-- Message -->
                            <textarea class="form-control @error('message') is-invalid @enderror mb-3" id="message"
                                rows="7" name="message" placeholder="Ecrire message"></textarea>

                            <!-- Submit Button -->
                            <button class="btn btn-lg text-white mx-4 background-blue" type="submit">
                                Envoyer
                            </button>

                        </form>

                    </div>
                </div>
                <!---  end envoyer un message   --->

                <div class="row">
                    <!--  share ad  -->
                    <div class="col-12 my-1 py-3 bg-white d-flex border">
                        <div class="pl-2 pr-3 h5">
                            <i class="fa fa-share-alt mr-2"></i>Partage
                        </div>

                        @include('includes.share_ad')

                    </div>
                    <!-- end share ad  -->
                    <div class="col-12 my-1 py-3 bg-white border">
                        <div class="pl-2 pr-3">
                            Signaler cette annonce
                            <a class="mx-2 text-secondary"
                                href="{{ route('report.ad', ['annonce_id' =>$annonce->id]) }}">
                                <i class="fa fa-flag"></i>
                            </a>
                        </div>

                    </div>
                </div>

            </div>

            <div class="col-12 col-md-4">
                <div class="row">
                    <div class="col px-0 pb-1 mx-3 mt-1 mt-md-0 bg-white border">
                        <p class="p-2 text-center text-white bg-dark font-weight-bold">Le vendeur</p>
                        <!-- (count($compte)>0) -->

                        <p class="px-2 mx-auto" style="height:100px; width:150px;">
                            <img src="/uploads/profiles/{{$compte->avatar}}" class="h-100 w-100 border">
                        </p>
                        <p class="mb-1 px-2 text-center">
                            @if ($compte->brand)
                            {{$compte->brand}}
                            @else
                            {{$compte->first_name}} {{$compte->last_name}}
                            @endif
                        </p>
                        <p class="my-1 px-2 text-center">{{$compte->total_ads}} annonces actives</p>
                        @if ($compte->adress)
                        <p class="my-1 px-2 text-center">
                            <i class="fa fa-map-marker mr-2"></i>{{$compte->adress}}
                        </p>
                        @endif
                        <hr class="px-2 border">
                        <!--see contact infos -->
                        <div class="row my-1">
                            <div class="col-12 col-sm-6 col-md-12">
                                <button class="btn shadow-none text-white background-orange w-100" id="voirUserNumero">
                                    <i class="fa fa-phone mr-2"></i>
                                    <span id="hide">Voir numéro</span>
                                    <span id="show" style="display:none;">
                                        @if ($annonce->ad_phone) {{$annonce->ad_phone}} @else {{$compte->phone?$compte->phone:'Aucun Numéro'}}@endif
                                    </span>
                                </button>
                            </div>
                            <div class="col-12 col-sm-6 col-md-12">
                                <button class="btn shadow-none border-color-orange mt-2 mt-sm-0 mt-md-2 w-100"
                                    name="send_message_to_seller_btn">
                                    <i class="fa fa-envelope mr-2"></i>Envoyer un message
                                </button>
                            </div>
                        </div>
                        <!-- end see contact infos -->
                        <!-- endif -->
                    </div>
                </div>

                <!-- espaces publicitaires right ad detail -->
                    @include('includes.pub.right_ad_detail')
                <!-- end espaces publicitaires right ad detail -->
                

                <div class="row my-3">
                    <div class="col">
                        <div class="border border-danger alert alert-danger p-0">
                            <h4 class="px-2">Mise en garde</h4>
                            <p class="px-2">Yetecan.com n'a jamais rien avoir avec la transaction. Si quelqu'un déclare
                                vendre de la part de Yetecan, c'est une fraude et cela doit être signalé.
                            </p>
                            <p class="d-flex align-items-center px-2">
                                <i class="fa fa-money fa-2x mr-2"></i><span>Ne payer jamais à l'avance.
                                    Ne donner jamais les informations de votre compte bancaire à quelqu'un.
                                    N'envoyer jamais de l'argent à quelqu'un par un moyen de paiement électronique
                                    ou par une agence de transfert.</span>
                            </p>
                            <p class="d-flex align-items-center px-2">
                                <i class="fa fa-search-plus fa-2x mr-2"></i><span>Faire une recherche sur la valeur
                                    marchande du produit et voir d'abord le produit avant de l'acheter.</span>
                            </p>
                            <p class="d-flex align-items-center px-2">
                                <i class="fa fa-handshake-o fa-2x mr-2"></i>
                                <span>
                                    Se rencontrer pour faire la transaction.
                                </span>
                            </p>
                            <p class="d-flex align-items-center px-2">
                                <i class="fa fa-exclamation-triangle fa-2x mr-2"></i>
                                <span>
                                    Prendre garde des affaires qui semblent trop bonnes
                                    pour être vraies.
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- similar ads -->
        <div class="row">
            <div class="col my-3 border">
                
            </div>
        </div>
        <!-- end similar ads -->


        <!-- espaces publicitaires d'en bas -->
        @include('includes.pub.bottom')
        <!-- end espaces publicitaires d'en bas -->



    </main>

    <!-- footer -->
    <footer>
        @include('includes.footer')
    </footer>
    <!-- end footer -->

    <!-- call sms message -->
    @if ($annonce->ad_phone)
    <div class="fixed-bottom background-orange d-md-none d-flex py-0">
        <a href="tel:{{$annonce->ad_phone}}"
            class="btn shadow-none border-right active d-flex flex-fill justify-content-center text-white" role="button"
            aria-pressed="true">
            <i class="material-icons mr-2" style="font-size:18px">phone</i>
            <!--<i class="fa fa-phone mr-2"></i>-->
            <span> Appeler </span>
        </a>

        <a href="sms:{{$annonce->ad_phone}};?&body=Bonjour,%20je%20suis%20interesse%20par%20votre%20annonce%20sur%20yetecan.com"
            role="button" aria-pressed="true"
            class="btn shadow-none border-left border-right active flex-fill text-white d-flex justify-content-center">
            <i class="material-icons mr-2 " style="font-size:18px">message</i>
            <span> SMS </span>
        </a>
        <button class="btn shadow-none border-left flex-fill text-white d-flex justify-content-center"
            name="send_message_to_seller_btn">
            <!--<i class="fa fa-envelope mr-2"></i>-->
            <i class="material-icons mr-1" style="font-size:18px">email</i>
            <span> Message </span>
        </button>
    </div>
    @endif
    <!-- end call sms message -->

    <!-- auth links modal -->
    @include('includes.user_auth_links_modal')
    <!-- end auth links modal -->



    <script src="/js/app.js"> </script>
    <script src="/js/custom.js"> </script>

    <!-- Twitter twitt CDN -->
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8">
    </script>

    <!--- FB share dialog  --->
    <script>
        document.getElementById('FBshareBtn').onclick = function() {
        var ad_detail_url = '{{ route("ad.detail", ["ville" => str_slug($annonce->ville_name,"-") , "category" => str_slug($annonce->category,"-") , "slug" => $annonce->slug]) }}';
        //console.log(ad_detail_url);
            FB.ui({
                display: 'popup',
                method: 'share',
                href: ad_detail_url,
            }, function(response){});
        }
    </script>
</body>

</html>