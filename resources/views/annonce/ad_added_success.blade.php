<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Petites annonces en Guinée &#124; Yetecan </title>

    <!----  favicon  --->
    <link rel="shortcut icon" type="image/png" href="/uploads/favicon-192.png">
    <link rel="shortcut icon" sizes="192x192" href="/uploads/favicon-192.png">
    <link rel="apple-touch-icon" href="/uploads/favicon-192.png">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <script src="/js/app.js"> </script>
    <script src="/js/custom.js"> </script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


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


    <!-- header -->
    <header class="">
        @include('includes.navbar')
        @include('includes.search_ad')
    </header>
    <!-- end header -->

    <main class="">

        @if (Session::has('ad_added_success'))
        <div class="row mt-2">
            <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-success" role="alert">
                <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="p-2">
                {{ Session::get('ad_added_success') }}
                </div>
            </div>
        </div>
        @endif 

        
        <div class="row text-center my-5">
            <div class="col">
                <h3>Visitez votre annonce</h3>
                <div class="my-2 mx-auto d-inline-block">
                    <a href="{{ route('ad.detail', ['ville' => str_slug($annonce->ville_name,'-') , 'category' => str_slug($annonce->category,'-') , 'slug' => $annonce->slug]) }}">
                        <button class="text-white background-orange py-1 px-3" style="font-size: 17px; border:none;">
                            Voir annonce
                        </button>
                    </a>
                </div>
                <h3 class="mt-5">Partagez votre annonce</h3>
                <div class="my-2 mx-auto d-inline-block">
                    @include('includes.share_ad')
                </div>
                
            </div>
        </div>

    </main>

    <!-- footer -->
    <footer>
        @include('includes.footer')
    </footer>
    <!-- end footer -->

    <!--- FB share dialog  --->
    <script>
        document.getElementById('FBshareBtn').onclick = function() {
        var ad_detail_url = '{{ route("ad.detail", ["ville" => str_slug($annonce->ville_name,"-") , "category" => str_slug($annonce->category,"-") , "slug" => $annonce->slug]) }}';
        console.log(ad_detail_url);
            FB.ui({
                display: 'popup',
                method: 'share',
                href: ad_detail_url,
            }, function(response){});
        }
    </script>

</body>

</html>