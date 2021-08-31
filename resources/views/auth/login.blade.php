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
    
    <!-- end espace publicitaire top -->

    <!-- header -->
    <header class="">
        @include('includes.navbar')
        @include('includes.search_ad')
    </header>
    <!-- end header -->

<div class="container">
    @if (Session::has('user_auth_page'))
        <div class="row">
            <div class="col col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-info " role="alert">
                <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="p-2">
                {{ Session::get('user_auth_page') }}
                </div>
            </div>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-3">
                <div class="card-header text-center"><h2><strong>Connexion</strong></h2></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('compte.login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Addresse E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>

                                    <label class="form-check-label" for="remember">
                                        Se Rappeler de Moi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Valider
                                </button>

                                
                                <a class="btn btn-link" href="{{ route('password.restaurer.email') }}">
                                        Mot de Passe Oublié?
                                </a>
                                
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col text-center mt-2">
                            <a class="btn btn-link" href="{{ route('register') }}">
                                <u>Pas Encore Membre? Inscrivez-vous Gratuitement</u> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<footer>
    @include('includes.footer')
</footer>
<!-- end footer -->

</body>

</html>
