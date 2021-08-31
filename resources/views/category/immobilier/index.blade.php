
@include('includes.carbon')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Guinée, Conakry, Yetecan, Annonces, Vente, Achat, Location, Immobilier, Maisons, Appartements, Parcelles, Villas">
    <meta name="description" content="Vente, achat et location de biens immobiliers, maison, villa, appartement, terrain, parcelle.">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Immobilier - Trouvez une maison sur yetecan.com </title>

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

        <!-- list directory -->
        @include('includes.list_directory')
        <!-- end list directory -->

        <!-- ads for each category or subcat  -->
        @include('includes.ads_per_cat')
        <!-- end ads for each category or subcat  -->


        <!-- Filter1 -->
        @include('includes.filter1')
        <!-- end Filter1 -->

        <div class="row mx-2 mx-lg-0">
            <div class="col col-md-8">

                <!-- Annonces à la une -->
                @include('includes.pub.alaune')
                <!-- end Annonces à la une -->

                @if ($annonces->isEmpty())
                    <h4 class="text-center my-5">
                        Aucun résultat trouvé
                    </h4> 
                @endif

                <!-- ads -->
                @foreach ($annonces as $annonce)
                        @include('includes.ads')
                @endforeach 
                <!-- end ads -->
                
                <div class="row mt-4">
                    <!-- pagination -->
                    @if ($annonces->isNotEmpty())
                    @include('pagination.ads_pagination', ['paginator' => $annonces])
                    @endif
                    <!-- end pagination -->
                </div>

            </div>
            <!-- espaces publicitaires aside right -->
            <div class="col-md-4 d-none d-md-block">
                @include('includes.pub.aside_right')
            </div>
            <!-- end espaces publicitaires aside right  -->
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

    <!-- auth links modal -->
    @include('includes.user_auth_links_modal')
    <!-- end auth links modal -->
    
</body>

</html>