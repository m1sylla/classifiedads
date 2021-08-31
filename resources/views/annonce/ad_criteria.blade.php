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
                <h2>Ajouter les critères votre annonce</h2>
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

        <form class="bg-white pb-3" id="form-ad-critere" method="POST" action="{{ route('ad.attribute.create') }}" enctype="multipart/form-data">
            @csrf
        <fieldset>
            <legend class="text-center text-white font-weight-bold py-2 background-blue">Ajouter des critères</legend>
            <input type="hidden" name="annonce_id" value="{{ $id }}">
            
                
                @foreach ($attributes as $attribute)
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label text-sm-right px-sm-1 px-4
                    font-weight-bold" for="attribute">
                        {{$attribute->name}} :
                    </label>
                    <div class="col-sm-4 col-md-3 d-flex px-sm-1 px-4">
                        <input type="hidden" name="attribute_id[]" value="{{$attribute->id}}">
                        @if ($attribute->possible_values)
                            <select class="form-control mr-1" name="attribute_value[]" id="attribute">
                                <option value="" style="display: none;"></option>
                                
                                @foreach(explode(',', $attribute->possible_values) as $possible_value) 
                                <option value="{{$possible_value}}">
                                    {{$possible_value}}
                                </option>
                                @endforeach

                                <option value="Autre">Autre</option>
                            </select>
                        @else
                        
                            <input type="text" class="form-control mr-1" name="attribute_value[]" id="attribute">

                        @endif
                        
                        <span class="px-1 py-2 text-muted">
                            <i>{{$attribute->unit}}</i><sup class="to-power">{{$attribute->unit_exposant}}</sup>
                        </span>
                    </div>
                </div>
                @endforeach
            
            </fieldset>

            <!-- Submit Button -->
            <div class="form-group">
                <div class="col-md-10 col-lg-offset-2 mx-auto">
                    <button class="btn btn-lg text-white w-100 background-blue darken-blue" type="submit">
                        Ajouter
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