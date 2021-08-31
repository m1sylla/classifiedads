<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Guinée, Annonces, Voitures, maisons, Téléphones, Ordinateurs">
    <meta name="description"
        content="Petites annonces en Guinée - Vente et achat de voitures, d'ordinateurs, de téléphones, de maisons, d'électroménagers, de chaussures, de vêtements">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Petites annonces en Guinée, voiture, mode, maison et plus &#124; Yetecan </title>

    
    <!--- Twitter meta -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@yetecan" />
    <meta name="twitter:creator" content="@yetecan" />

    <meta property="og:type"        content="website" />
    <meta property="og:title"       content="Petites annonces en Guinée, voiture, mode, maison et plus - Yetecan" />
    <meta property="og:description" content="Petites annonces en Guinée - Vente et achat de voitures, d'ordinateurs, de téléphones, de maisons, d'électroménagers, de chaussures, de vêtements" />
    <meta property="og:image"       content="{{asset('/uploads/images/opengraph.png')}}" />
    
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
    <script src="/js/app.js"> </script>
    <script src="/js/custom.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


</head>

<body>
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

        <!-- espace publicitaire interne -->
        @include('includes.pub.inside_top')
        <!-- end espace publicitaire interne -->

        <!-- catégorie et ville-->
        <div class="row mx-0">
            <!-- catégorie -->
            <div class="col col-md-8 col-lg-9 bg-white border py-2">
                <div class="row">
                    <div class="col body-bg-color m-3 p-3">
                        <h4 class="font-weight-bold text-center">Choisir une catégorie</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-sm-4">
                        <div class="row align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonces.categorie',['category' => 'vente-immobilier-maison']) }}">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/immobilier.png" height="45" width="45" alt="Immobilier">
                                </a>
                            </div>
                            <!--<div class="w-100 d-md-none"></div>-->
                            <div class="col pl-2 py-1">
                                <p class="py-0 my-0 h5">
                                    <a href="{{ route('annonces.categorie',['category' => 'vente-immobilier-maison']) }}">
                                        Immobilier
                                    </a>
                                </p>
                                <span class="text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Immobilier')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="row align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonces.categorie',['category' => 'vente-electronic-multimedia']) }}">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/multimedia.png"  height="45" width="45" alt="Multimédia">
                                </a>
                            </div>
                            <!--<div class="w-100 d-md-none"></div>-->
                            <div class="col pl-2 py-1">
                                <p class="py-0 my-0 h5">
                                    <a href="{{ route('annonces.categorie',['category' => 'vente-electronic-multimedia']) }}">
                                        Multimédia
                                    </a>
                                </p>
                                <span class="text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Multimédia')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="row align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonces.categorie',['category' => 'vente-vehicule-voiture']) }}">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/vehicle.png"  height="45" width="45" alt="Véhicule">
                                </a>
                            </div>
                            <!--<div class="w-100 d-md-none"></div>-->
                            <div class="col pl-2 py-1">
                                <p class="py-0 my-0 h5">
                                    <a href="{{ route('annonces.categorie',['category' => 'vente-vehicule-voiture']) }}">
                                        Véhicule
                                    </a>
                                </p>
                                <span class="text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Véhicule')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="row align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonces.categorie',['category' => 'produit-mode-beaute']) }}">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/mode.png"  height="45" width="45" alt="Mode &amp; Beauté">
                                </a>
                            </div>
                            <!--<div class="w-100 d-md-none"></div>-->
                            <div class="col pl-2 py-1">
                                <p class="py-0 my-0 h5">
                                    <a href="{{ route('annonces.categorie',['category' => 'produit-mode-beaute']) }}">
                                        Mode &amp; Beauté
                                    </a>
                                </p>
                                <span class="text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Mode & Beauté')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="row align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonces.categorie',['category' => 'offre-emploi']) }}">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/emploi.png"  height="45" width="45" alt="Emploi">
                                </a>
                            </div>
                            <!--<div class="w-100 d-md-none"></div>-->
                            <div class="col pl-2 py-1">
                                <p class="py-0 my-0 h5">
                                    <a href="{{ route('annonces.categorie',['category' => 'offre-emploi']) }}">
                                        Emploi
                                    </a>
                                </p>
                                <span class="text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Emploi')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="row align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonces.categorie',['category' => 'vente-electromenager-meuble']) }}">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/mobilier.png"  height="45" width="45" alt="Meuble &amp; Jardin">
                                </a>
                            </div>
                            <!--<div class="w-100 d-md-none"></div>-->
                            <div class="col pl-2 py-1">
                                <p class="py-0 my-0 h5">
                                    <a href="{{ route('annonces.categorie',['category' => 'vente-electromenager-meuble']) }}">
                                        Meuble &amp; Jardin
                                    </a>
                                </p>
                                <span class="text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Meuble & Jardin')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="row align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonces.categorie',['category' => 'commerce-industrie']) }}">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/industrie.png"  height="45" width="45" alt="Commerce &amp; Industrie">
                                </a>
                            </div>
                            <!--<div class="w-100 d-md-none"></div>-->
                            <div class="col pl-2 py-1">
                                <p class="py-0 my-0 h5">
                                    <a href="{{ route('annonces.categorie',['category' => 'commerce-industrie']) }}">
                                        Commerce &amp; Industrie
                                    </a>
                                </p>
                                <span class="text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Commerce & Industrie')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="row align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonces.categorie',['category' => 'culture-loisir']) }}">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/loisir.png"  height="45" width="45" alt="Culture &amp; Loisir">
                                </a>
                            </div>
                            <!--<div class="w-100 d-md-none"></div>-->
                            <div class="col pl-2 py-1">
                                <p class="py-0 my-0 h5">
                                    <a href="{{ route('annonces.categorie',['category' => 'culture-loisir']) }}">
                                        Culture &amp; Loisir
                                    </a>
                                </p>
                                <span class="text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Culture & Loisir')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4">
                        <div class="row align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonces.categorie',['category' => 'prestation-service']) }}">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/service.png"  height="45" width="45" alt="Service">
                                </a>
                            </div>
                            <!--<div class="w-100 d-md-none"></div>-->
                            <div class="col pl-2 py-1">
                                <p class="py-0 my-0 h5">
                                    <a href="{{ route('annonces.categorie',['category' => 'prestation-service']) }}">
                                        Service
                                    </a>
                                </p>
                                <span class="text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Service')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- end catégorie -->
            <!-- ville -->
            <div class="col-md-4 col-lg-3 d-none d-md-block">
                <div class="row border ml-2 p-2 bg-white">
                    <div class="col">
                        <div class="row">
                            <div class="col mt-3">
                                <h5 class="font-weight-bold text-center">Choisir une ville</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <a class="" href="{{ route('annonces.region',['region' => 'conakry']) }}">
                                    Conakry
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="" href="{{ route('annonces.region',['region' => 'kindia']) }}">
                                    Kindia
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="" href="{{ route('annonces.region',['region' => 'boke']) }}">
                                    Boké
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="" href="{{ route('annonces.region',['region' => 'mamou']) }}">
                                    Mamou
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="" href="{{ route('annonces.region',['region' => 'labe']) }}">
                                    Labé
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="" href="{{ route('annonces.region',['region' => 'kankan']) }}">
                                    Kankan
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="" href="{{ route('annonces.region',['region' => 'faranah']) }}">
                                    Faranah
                                </a>
                            </div>
                            <div class="col-12 col-md-6">
                                <a class="" href="{{ route('annonces.region',['region' => 'nzerekore']) }}">
                                    Nzérékoré
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end ville -->
        </div>
        <!-- end catégorie et ville -->

        <!-- annonces recommandées -->
        @include('includes.pub.recommand')
        <!-- end annonces recommandées -->

        <!-- espaces publicitaires d'en bas -->
        @include('includes.pub.bottom')
        <!-- end espaces publicitaires d'en bas -->

    <!-- espace publicitaire gauche et droite -->
    
    <!-- end espace publicitaire gauche et droite -->

    </main>

    <!-- footer -->
    <footer> 
        @include('includes.footer')
    </footer>
    <!-- end footer -->

</body>

</html>