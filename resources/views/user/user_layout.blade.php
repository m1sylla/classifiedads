<?php 
$new_messages = App\Message::where('seen', 0)->count();
$ads_total = App\Annonce::where('compte_id', Auth::user()->id)->get();
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Petites annonces en Guinée - {{Auth::user()->first_name}} {{Auth::user()->last_name}} &#124; Yetecan </title>

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
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- google icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>

<body>

    <!-- header -->
    <header class="">
        @include('includes.navbar')
    </header>
    <!-- end header -->

    <main class="">
        
    @if (Session::has('user_not_confirmed'))
    <div class="row">
        <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-danger " role="alert">
            <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="p-2">
            {{ Session::get('user_not_confirmed') }} Consulter votre boîte e-mail, ou <br>  <a href="#" class="alert-link">Renvoyer le lien de confirmation</a>
            </div>
        </div>
    </div>
    @endif 

        @if (!Auth::user()->confirmed)
        <div class="row">
            <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-warning " role="alert">
                <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="p-2">
                    Votre compte n'est pas confirmé. <a href="#" class="alert-link">Renvoyer le lien de confirmation</a>
                </div>
            </div>
        </div>
        @endif

        @if (!Auth::user()->phone_verified)
        <div class="row">
            <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-info " role="alert">
                <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="p-2">
                    @if (!Auth::user()->phone)
                    Vous n'avez pas ajouté de numéro. <a href="{{ route('profile') }}" class="alert-link">Ajouter un numéro</a>
                    @else
                    Votre numéro n'est pas vérifié. <a href="#" class="alert-link">Vérifiez votre numéro</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
        
        <!-- <div class="container"> -->
        <div class="row bg-white mx-0 my-3 border">
            <div class="col d-flex py-3">
                <div class="d-inline-block">
                    <img class="rounded-circle" src="/uploads/profiles/{{Auth::user()->avatar}}" 
                    height="60" width="60" alt="username">
                </div>
                
                <div class="d-flex flex-column ml-3">
                    <div>
                        <span class="h5">{{Auth::user()->first_name}} </span>
                        <span class="h5">{{Auth::user()->last_name}}</span>
                    </div>
                    <div>
                        <span>
                            {{$ads_total->where('suspended', 0)->count()}} annonces actives
                        <br>
                            {{$ads_total->where('suspended', 1)->count()}} annonces suspendues
                        </span>
                    </div>
                    
                </div>
                <!--
                <div>
                    <a class="float-right border" href="#">
                        Aller Pro
                    </a>
                </div> -->
                
            </div>

        </div>

        <div class="row mx-0 mb-3">
            <div class="col-12 col-md-2 mb-2 px-0">
                <div id="profile-link-active" class="px-2 py-3 bg-white border">

                    <a class="d-md-block py-1 ml-2 ml-md-0 a-grey text-decoration-none" href="{{ route('profile') }}">
                        Profil
                    </a>
    
                    <a class="d-md-block py-1 ml-2 ml-md-0 a-grey text-decoration-none" href="{{ route('profile.annonce') }}">
                        Annonces
                    </a>
    
                    <a class="d-md-block py-1 ml-2 ml-md-0 a-grey text-decoration-none" href="{{ route('profile.favori') }}">
                        Favoris
                    </a>
                    
                    <a class="d-none d-md-block py-1 a-grey text-decoration-none" href="{{ route('profile.recherche') }}">
                        Recherches
                    </a>
    
                    <a class="d-md-block py-1 ml-2 ml-md-0 a-grey text-decoration-none" href="{{ route('profile.message') }}">
                        Messages @if ($new_messages)
                        <span class="badge badge-danger rounded-circle float-right">{{$new_messages}}</span>
                        @endif 
                    </a>
    
                    <a class="d-none d-md-block py-1 a-grey text-decoration-none" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>

            </div>

            <div class="col-12 col-md-10 p-0">
                <div class="row ml-md-2 px-2">
                    <div class="col">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- footer -->
    <footer>
        @include('includes.footer')
    </footer>
    <!-- end footer -->

</body>

</html>