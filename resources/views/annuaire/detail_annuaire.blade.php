<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Guinée, Annonces, Petites annonces, Voitures, maisons, Téléphones, Ordinateurs">
    <meta name="description" content="Vente et location de bien immobilier (maison, appartement, terrain, parcelle)">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Immobilier - Trouvez une maison sur yetekan.net </title>

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


</head>

<body>

    <!-- header -->
    <header class="">
        @include('includes.navbar')
    </header>
    <!-- end header -->

    <main class="">

        <div class="row">

            <div class="col">
                <h3 class="my-4 p-3">Aucune boutique trouvée</h3>
            </div>

            <!--<div class="col">
                <div class="mt-2 pl-2">
                    <h5>
                        boutiques 
                        <i class="fa fa-chevron-right" style="font-size:10px;"></i>
                        CarDealer
                    </h5>
                </div>
            </div>-->
        </div>

        <div class="row mx-2 mx-lg-0">
            <div class="col col-md-8">

                <div class="row">
                    <!--<div class="col">
                        <div>
                            logo
                        </div>
                        <div>
                            Adresse
                        </div>
                        <div>
                            Phone
                        </div>
                        <div>
                            Email
                        </div>
                        <div>
                            Horaire
                        </div>
                    </div>
                    <div class="col">
                        <div>
                            Titre
                        </div>
                        <div>
                            Description
                        </div>
                        <div>
                            Site web
                        </div>
                    </div>-->
                </div>

                <div class="row">
                    <!--<div class="col d-flex border-bottom">
                        <div class="border">
                            5 annonces
                        </div>
                        <div>
                            Tri: date
                        </div>
                    </div>-->
                </div>
                <!-- list ads -->
                <div class="row mt-2 bg-white">
                    <!--<div class="col px-0 d-flex list-annuaire">
                        <div class="position-relative logo">
                            <a class="stretched-link" href="#">
                                <img src="/uploads/profiles/cardealer.jpg" class="mh-100 mw-100 el-center" alt=""> 
                            </a> 
                        </div>
                        <div class="py-2 pl-2">
                            <a class="text-decoration-none text-dark stretched-link" href="#">
                                <h5 class="my-0">CarDealer</h5>
                            </a>
                            <h6 class="my-0 text-muted">5 annonces</h6>
                            <h6 class="my-0">Voiture</h6>
                            <h6 class="my-0 text-muted">Conakry, Lambanyi</h6>
                        </div>
                    </div>-->
                </div>
                <!-- end list ad -->
                
                
            </div>
            <!--<div class="col-md-4 d-none d-md-block">
                <div class="p-4 border" style="height:200px;">Zone 1</div>
                <div class="p-4 mt-3 border" style="height:200px;">Zone 2</div>
                <div class="p-4 mt-3 border" style="height:200px;">Zone 3</div>
            </div>-->
        </div>

        <!-- espaces publicitaires d'en bas -->
        @include('includes.pub.bottom')
        <!-- end espaces publicitaires d'en bas -->
    </main>


    <!-- footer -->
    <footer>
        @include('includes.footer')
    </footer>
    <!-- end footer -->

</body>

</html>