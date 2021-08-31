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
                <h2>Modifiez votre annonce</h2>
            </div>
        </div>

        @if (Session::has('ad_modified_success'))
        <div class="row mb-3">
            <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-success" role="alert">
                <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close"
                    data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="p-2">
                    {{ Session::get('ad_modified_success') }}
                </div>
            </div>
        </div>
        @endif

        <form class="bg-white pb-3" id="form-edit-ad" method="POST" action="{{ route('update.ad') }}"
            enctype="multipart/form-data">
            @csrf
            <fieldset>
                <legend class="text-center text-white font-weight-bold py-2 background-blue">Modifier cette annonce
                </legend>
                <input type="hidden" name="annonce_id" value="{{ $annonce[0]->id }}">
                <!-- Catégorie -->
                <div class="form-group row">
                    <label for="category" class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label font-weight-bold">
                        Catégorie :
                    </label>
                    <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                        <select id="category" class="form-control" name="category" disabled>
                            @foreach($categories as $category)
                            <optgroup class="text-dark bg-light" label="{{ $category->name }}">
                            </optgroup>
                            @foreach($sub_categories as $sub_category)
                            @if($category->id==$sub_category->category_id)
                            <option value=" {{$category->id }}; {{ $sub_category->id }}" @if ($annonce[0]->
                                category_item_id == $sub_category->id) selected @endif>
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
                        <select class="form-control" id="ville" name="location" disabled>
                            @foreach($regions as $region)
                            @foreach($villes as $ville)
                            @if($region->id==$ville->region_id)
                            <option value=" {{$region->id }}; {{ $ville->id }}" @if ($annonce[0]->ville_id ==
                                $ville->id) selected @endif>
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
                        Secteur :
                    </label>
                    <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                        <input type="text" class="form-control" name="sector_name" id="secteur"
                            placeholder="Commune, quartier ou secteur" @if ($annonce[0]->sector_name) readonly @endif
                        value="{{ $annonce[0]->sector_name }}">
                    </div>
                </div>
                <!-- condition -->
                <div class="form-group row">
                    <label for="condition" class="col-sm-3 text-sm-right px-sm-1 px-4
                col-form-label font-weight-bold">
                        Condition :
                    </label>
                    <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                        <select class="form-control" id="condition" name="is_new" disabled>
                            <option value="0" @if (!$annonce[0]->is_new) selected @endif>
                                Ancien
                            </option>
                            <option value="1" @if ($annonce[0]->is_new) selected @endif>
                                Nouveau
                            </option>
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
                            <input class="form-check-input" type="radio" name="is_offer" id="offre" value="1"
                                {{ $annonce[0]->is_offer ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="offre">
                                Offre
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_offer" id="demande" value="0"
                                {{ $annonce[0]->is_offer ? '' : 'checked' }} disabled>
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
                        <input type="text" class="form-control" name="title" id="titre" value="{{$annonce[0]->title}}">
                        <span class="help-block text-muted">Améliorer le titre de votre annonce. </span>
                    </div>
                </div>
                <!-- Description -->
                <div class="form-group row">
                    <label class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                font-weight-bold" for="description">
                        Description :
                    </label>
                    <div class="col-sm-7 col-md-6 px-sm-1 px-4">
                        <textarea class="form-control" id="description" rows="10" name="description">{{$annonce[0]->description}}
                    </textarea>
                        <span class="help-block text-muted">Améliorer la description de votre annonce..</span>
                    </div>
                </div>
                <!-- Prix -->
                <div class="form-group row">
                    <label for="prix" class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                font-weight-bold">Prix :</label>
                    <div class="col-sm-6 col-md-5 input-group px-sm-1 px-4">
                        <input type="text" class="form-control" id="prix" name="price" value="{{$annonce[0]->price}}">
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
                            <option value="" disabled="disabled" selected="selected" style="display: none;"></option>
                            @foreach($price_options as $price_option)
                            <option value="{{ $price_option->id }}" @if ($annonce[0]->price_option_id ==
                                $price_option->id) selected @endif>
                                {{ $price_option->name }}
                            </option>
                            @endforeach
                        </select>
                        <span class="px-1 py-2 text-muted">(Facultatif)</span>
                    </div>
                </div>
            </fieldset>

            @if ($attributes->isNotEmpty())
            <fieldset class="border-top pt-3">

                @foreach ($attributes as $attribute)
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-sm-right px-sm-1 px-4
                    font-weight-bold" for="attribute">
                        {{$attribute->name}} :
                    </label>
                    <div class="col-sm-4 col-md-3 d-flex px-sm-1 px-4">
                        <input type="hidden" name="attribute_id[]" value="{{$attribute->id}}">
                        @if ($attribute->possible_values)
                        <select class="form-control mr-1" name="attribute_value[]" id="attribute"
                            {{ $attribute_values->contains('attribute_id', $attribute->id) ? 'disabled' : '' }}>
                            <option value="" disabled="disabled" style="display: none;"
                                {{ $attribute_values->contains('attribute_id', $attribute->id) ? '' : 'selected' }}>
                            </option>

                            @foreach(explode(',', $attribute->possible_values) as $possible_value)
                            <option value="{{$possible_value}}"
                                {{ $attribute_values->contains('value', $possible_value) ? 'selected' : '' }}>
                                {{$possible_value}}
                            </option>
                            @endforeach

                            <option value="">Autre</option>
                        </select>
                        @else

                        @if ($attribute_values->contains('attribute_id', $attribute->id))
                        @foreach ($attribute_values as $attribute_value)
                        @if ($attribute_value->attribute_id == $attribute->id)
                        <input type="text" class="form-control mr-1" name="attribute_value[]" id="attribute" disabled
                            value="{{$attribute_value->value}}">
                        @break
                        @endif
                        @endforeach
                        @else
                        <input type="text" class="form-control mr-1" name="attribute_value[]" id="attribute">
                        @endif

                        @endif

                        <span class="px-1 py-2 text-muted">
                            <i>{{$attribute->unit}}</i><sup class="to-power">{{$attribute->unit_exposant}}</sup>
                        </span>
                    </div>
                </div>
                @endforeach

            </fieldset>
            @endif

            <!-- Submit Button -->
            <div class="form-group">
                <div class="col-md-10 col-lg-offset-2 mx-auto">
                    <button class="btn btn-lg text-white w-100 background-blue" type="submit">
                        Modifer
                    </button>
                </div>
            </div>

        </form>
    </main>

    <!-- footer -->
    <footer>
        @include('includes.footer')
    </footer>
    <!-- end footer -->

</body>

</html>