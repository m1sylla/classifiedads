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
                <h2>Postez vos annonces! C'est gratuit</h2>
            </div>
        </div>

        <form class="bg-white pb-3" id="form-ad" method="POST" action="{{ route('new.ad.create') }}" enctype="multipart/form-data">
            @csrf
        <fieldset>
            <legend class="text-center text-white font-weight-bold py-2 background-blue">Que vendez-vous?</legend>
            <input type="hidden" name="compte_id" value="{{ Auth::user()->id }}">
            <!-- Catégorie -->
            <div class="form-group row">
                <label for="category" class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label font-weight-bold">
                    Catégorie :
                </label>
                <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                    <select id="category" class="form-control @error('category') is-invalid @enderror" name="category">
                        <option value="" disabled="disabled" style="display: none;"
                        {{ old("category") ? "":"selected" }}>
                            Choisir une catégorie
                        </option>
                        @foreach($categories as $category)
                            <optgroup class="text-dark bg-light" label="{{ $category->name }}">
                            </optgroup>
                                @foreach($sub_categories as $sub_category)
                                    @if($category->id==$sub_category->category_id)
                                        <option value="{{$category->id}};{{$sub_category->id}}" {{ old("category") == $category->id.';'.$sub_category->id ? "selected":"" }}>
                                            &nbsp; &nbsp;{{ $sub_category->name }}
                                        </option>
                                    @endif
                                @endforeach
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Ville -->
            <div class="form-group row">
                <label for="ville" class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label font-weight-bold">
                    Ville :
                </label>
                <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                    <select class="form-control @error('location') is-invalid @enderror" id="ville" name="location">
                        <option value="" disabled="disabled" class="d-none text-muted"
                        {{ old("location") ? "":"selected" }}>
                            Choisir une ville
                        </option>

                        @foreach($regions as $region)
                            @foreach($villes as $ville)
                                @if($region->id==$ville->region_id)
                                    <option value=" {{$region->id}};{{$ville->id}}" {{ old("location") == $region->id.';'.$ville->id ? "selected":"" }}>
                                        {{ $ville->name }}
                                    </option>
                                @endif
                            @endforeach
                        @endforeach
                        
                    </select>
                </div>
            </div>
            <!-- Secteur -->
            <div class="form-group row">
                <label for="secteur" class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                font-weight-bold">
                    Secteur
                </label>
                <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                    <input type="text" class="form-control @error('sector_name') is-invalid @enderror" 
                    name="sector_name" id="secteur" placeholder="Commune, quartier ou secteur" value="{{ old('sector_name') }}">
                </div>
            </div>
            <!-- condition -->
            <div class="form-group row">
                <label for="condition" class="col-sm-3 text-sm-right px-sm-1 px-4
                col-form-label font-weight-bold">
                    Condition
                </label>
                <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                    <select class="form-control @error('is_new') is-invalid @enderror" id="condition" name="is_new">
                        <option value="0" {{ old("is_new") == 0 ? "selected":"" }}>
                            Ancien</option>
                        <option value="1" {{ old("is_new") == 1 ? "selected":"" }}>
                            Nouveau</option>
                    </select>
                </div>
            </div>
            <!-- Type -->
            <div class="form-group row">
                <label for="type" class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                font-weight-bold">
                    Type :
                </label>
                <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_offer" id="offre" value="1" checked>
                        <label class="form-check-label" for="offre">
                            Offre
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_offer" id="demande" value="0">
                        <label class="form-check-label" for="demande">
                            Demande
                        </label>
                    </div>
                </div>
            </div>
            <!-- Titre -->
            <div class="form-group row">
                <label class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                font-weight-bold" for="titre">
                    Titre :
                </label>
                <div class="col-sm-6 col-md-5 px-sm-1 px-4">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                    name="title" id="titre" placeholder="Titre de votre annonce" value="{{ old('title') }}">
                    <span class="help-block text-muted">&Eacute;viter un seul mot. Inutile d'écrire "à vendre"</span>
                </div>
            </div>
            <!-- Description -->
            <div class="form-group row">
                <label class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                font-weight-bold" for="description">
                    Description :
                </label>
                <div class="col-sm-7 col-md-6 px-sm-1 px-4">
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                    id="description" rows="10" name="description" placeholder="Détails de votre annonce"
                    >{{ old('description') }}</textarea>
                    <span class="help-block text-muted">Donner la description qui correspond au mieux à votre produit.
                        Donner des informations réelles.
                        Décrire la condition de votre produit, sa couleur, sa taille, etc.</span>
                </div>
            </div>
            <!-- Prix -->
            <div class="form-group row">
                <label for="prix" class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                font-weight-bold">Prix :</label>
                <div class="col-sm-6 col-md-5 input-group px-sm-1 px-4">
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="prix" 
                    name="price" value="{{ old('price') }}">
                    <div class="input-group-append ml-2">
                        <span class="input-group-text">GNF</span>
                    </div>
                    <span class="d-block px-1 py-2 text-muted">(Facultatif)</span>
                </div>
            </div>
            <!-- Price options -->
            <div class="form-group row">
                <label for="price_option" class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                    font-weight-bold">Options du prix :
                </label>
                <div class="col-sm-5 col-md-4 d-flex px-sm-1 px-4">
                    <select class="form-control " id="price_option" name="price_option_id">
                        <option value="" disabled="disabled" selected="selected" style="display: none;"
                        {{ old("price_option_id") ? "":"selected" }}></option>
                        @foreach($price_options as $price_option)
                        <option value="{{$price_option->id}}"
                            {{ old("price_option_id") == $price_option->id ? "selected":"" }}>
                            {{ $price_option->name }}
                        </option>
                        @endforeach
                    </select>
                    <span class="px-1 py-2 text-muted">(Facultatif)</span>
                </div>
            </div>

        </fieldset>

        <!----  contacts  ---->
        <fieldset class="">
            <legend class="border-top pt-3 text-center font-weight-bold py-2">
                Vos Contacts
            </legend>
            
            <!-- Email -->
            <div class="form-group row">
                <label class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                font-weight-bold" for="ad_email">
                    Email :
                </label>
                <div class="col-sm-6 col-md-5 px-sm-1 px-4">
                    <input type="text" class="form-control @error('ad_email') is-invalid @enderror" 
                    name="ad_email" id="ad_email" value="{{ Auth::user()->email }}">
                    <span class="help-block text-muted">Votre email ne sera pas visible</span>
                </div>
            </div>
            <!-- Phone -->
            <div class="form-group row">
                <label class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                font-weight-bold" for="ad_phone">
                    Téléphone :
                </label>
                <div class="col-sm-6 col-md-5 px-sm-1 px-4">
                    <input type="text" class="form-control @error('ad_phone') is-invalid @enderror" 
                    name="ad_phone" id="ad_phone" value="{{Auth::user()->phone ? Auth::user()->phone : ''}}">
                    <span class="help-block text-muted">Les acheteurs pourront voir votre numéro</span>
                </div>
            </div>
        </fieldset>
        
            <!-- Submit Button -->
            <div class="form-group mt-4">
                <div class="col-sm-7 col-md-6 mx-auto d-flex">
                    <div>
                        <button class="btn shadow-none text-white background-blue darken-blue" title="Ajouter sans photo"
                        type="submit" name="submit" value="save">
                            Ajouter
                        </button>
                    </div>
                    <div class="ml-auto">
                        <button class="btn shadow-none text-white background-blue darken-blue ml-5" title="Ajouter des photos"
                        type="submit" name="submit" value="photo">
                            Ajouter des photos
                        </button>
                    </div>
                </div>
            </div>

        </form>

        <!--<img id='blob_img'>-->

    </main>

    <!-- footer -->
    <footer>
        @include('includes.footer')
    </footer>
    <!-- end footer -->

</body>

</html>