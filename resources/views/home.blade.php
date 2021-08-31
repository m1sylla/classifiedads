<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Guinée, Annonces, Petites annonces, Voitures, maisons, Téléphones, Ordinateurs">
    <meta name="description"
        content="Petites annonces en Guinée - Vente et achat de voitures, d'ordinateurs, de téléphones, de maisons, d'électroménagers, de chaussures, de vêtements">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Petites annonces en Guinée, voiture, mode, maison et plus &#124; Yetecan </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
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
            {{--
            <div class="col-sm-8 col-lg-9 bg-white border py-2">
                <div class="row">
                    <div class="col body-bg-color m-3 p-3">
                        <h4 class="font-weight-bold text-center">Choisir une catégorie</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-md-4">
                        <div class="row justify-content-center align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                               
                            </div>
                            <div class="w-100 d-lg-none"></div>
                            <div class="col p-0 pl-lg-3 py-1 text-center text-lg-left">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="row justify-content-center align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonce.categorie.multimedia') }}" class="">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/multimedia.png"  height="45" width="45" alt="Multimédia">
                                </a>
                            </div>
                            <div class="w-100 d-lg-none"></div>
                            <div class="col p-0 pl-lg-3 py-1 text-center text-lg-left">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="row justify-content-center align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonce.categorie.vehicule') }}" class="">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/vehicle.png"  height="45" width="45" alt="Véhicule">
                                </a>
                            </div>
                            <div class="w-100 d-lg-none"></div>
                            <div class="col p-0 pl-lg-3 py-1 text-center text-lg-left">
                                <a href="{{ route('annonce.categorie.vehicule') }}" class="h5">
                                    Véhicule
                                </a>
                                <span class="d-block text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Véhicule')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="row justify-content-center align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonce.categorie.mode') }}" class="">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/mode.png"  height="45" width="45" alt="Mode &amp; Beauté">
                                </a>
                            </div>
                            <div class="w-100 d-lg-none"></div>
                            <div class="col p-0 pl-lg-3 py-1 text-center text-lg-left">
                                <a href="{{ route('annonce.categorie.mode') }}" class="h5">
                                    Mode &amp; Beauté
                                </a>
                                <span class="d-block text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Mode & Beauté')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="row justify-content-center align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonce.categorie.emploi') }}" class="">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/emploi.png"  height="45" width="45" alt="Emploi">
                                </a>
                            </div>
                            <div class="w-100 d-lg-none"></div>
                            <div class="col p-0 pl-lg-3 py-1 text-center text-lg-left">
                                
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="row justify-content-center align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonce.categorie.meuble') }}" class="">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/mobilier.png"  height="45" width="45" alt="Meuble &amp; Jardin">
                                </a>
                            </div>
                            <div class="w-100 d-lg-none"></div>
                            <div class="col p-0 pl-lg-3 py-1 text-center text-lg-left">
                            
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="row justify-content-center align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonce.categorie.industrie') }}" class="">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/industrie.png"  height="45" width="45" alt="Commerce &amp; Industrie">
                                </a>
                            </div>
                            <div class="w-100 d-lg-none"></div>
                            <div class="col p-0 pl-lg-3 py-1 text-center text-lg-left">
                                <a href="{{ route('annonce.categorie.industrie') }}" class="h5">
                                    Commerce &amp; Industrie
                                </a>
                                <span class="d-block text-muted">
                                    @if ($ads_by_cats->count()>0)
                                        {{$ads_by_cats->where('category', 'Commerce & Industrie')->count()}}
                                    @else 0 @endif annonces
                                </span>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="row justify-content-center align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                            
                            </div>
                            <div class="w-100 d-lg-none"></div>
                            <div class="col p-0 pl-lg-3 py-1 text-center text-lg-left">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="row justify-content-center align-items-center p-2">
                            <div class="col col-auto p-0 pl-lg-2 py-1">
                                <a href="{{ route('annonce.categorie.service') }}" class="">
                                    <img class="p-2 rounded-circle body-bg-color" src="/uploads/category/service.png"  height="45" width="45" alt="Service">
                                </a>
                            </div>
                            <div class="w-100 d-lg-none"></div>
                            <div class="col p-0 pl-lg-3 py-1 text-center text-lg-left">
                                <a href="{{ route('annonce.categorie.service') }}" class="h5">
                                    Service
                                </a>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- end catégorie -->
            ---}}
            <!-- ville -->
            <div class="col d-none d-sm-block">
                <div class="row border ml-2 p-2 bg-white">
                    <div class="col">
                        <div class="row">
                            <div class="col mt-3">
                                <h5 class="font-weight-bold text-center">Choisir une ville</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a class="d-block my-1" href="{{ route('annonce.ville.conakry') }}">
                                    Conakry
                                </a>
                                <a class="d-block my-1" href="{{ route('annonce.ville.kindia') }}">
                                    Kindia
                                </a>
                                <a class="d-block my-1" href="{{ route('annonce.ville.boke') }}">
                                    Boké
                                </a>
                                <a class="d-block my-1" href="{{ route('annonce.ville.mamou') }}">
                                    Mamou
                                </a>
                            </div>
                            <div class="w-100 d-lg-none"></div>
                            <div class="col">
                                <a class="d-block my-1" href="{{ route('annonce.ville.labe') }}">
                                    Labé
                                </a>
                                <a class="d-block my-1" href="{{ route('annonce.ville.kankan') }}">
                                    Kankan
                                </a>
                                <a class="d-block my-1" href="{{ route('annonce.ville.faranah') }}">
                                    Faranah
                                </a>
                                <a class="d-block my-1" href="{{ route('annonce.ville.nzerekore') }}">
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