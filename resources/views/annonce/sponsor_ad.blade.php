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

    <!-- header -->
    <header class="">
        @include('includes.navbar')
        @include('includes.search_ad')
    </header>
    <!-- end header -->

    <main class="">

        <div class="row text-center my-5">
            <div class="col">
                <h3>Sponsoriser votre annonce</h3>
            </div>
        </div>

        @if (Session::has('ad_modified_success'))
        <div class="row mb-3">
            <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-success" role="alert">
                <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="p-2">
                {{ Session::get('ad_modified_success') }}
                </div>
            </div>
        </div>
        @endif 

        <div class="row">
            <div class="col text-center">
                <h4>Identifiant de l'annonce : {{ $annonce->identifiant }}</h4>
            </div>
        </div>

        <div class="row my-4">
            <div class="col text-center">
                <h5>Appeler nous au 629 37 35 30</h5>
            </div>
        </div>

        <form class="bg-white pb-3" id="form-upload-ad-photos" method="POST" action="{{ route('update.ad') }}" enctype="multipart/form-data">
            @csrf
        
            <input type="hidden" name="annonce_id" value="{{ $annonce->id }}">
        
        
        </form>
    </main>

    <!-- footer -->
    <footer>
        @include('includes.footer')
    </footer>
    <!-- end footer -->

</body>

</html>