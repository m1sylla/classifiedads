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

    <!-- header -->
    <header class="">
        @include('includes.navbar')
    </header>
    <!-- end header -->

    <main class="">

        <div class="row">
            <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-info " role="alert">
                <div class="p-2">
                    {{$status}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col my-5 p-5 d-flex">
                <div class="mx-auto">
                    <a class="p-0 d-inline-block my-5" href="{{ route('add.new.ad') }}">
                        <button class="btn text-white new-ad-link"><i class="fa fa-plus"></i> D&#233;poser une
                            annonce</button>
                    </a>
                </div>
            </div>
        </div>

    </main>

    <!-- espace publicitaire gauche et droite -->
    
    <!-- end espace publicitaire gauche et droite -->

    <!-- footer -->
    <footer>
        @include('includes.footer')
    </footer>
    <!-- end footer -->

</body>

</html>