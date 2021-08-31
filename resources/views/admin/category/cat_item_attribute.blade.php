@extends('admin.layout')

@section('content')

<h5>Ajouter un attribut</h5>
<hr class="mt-0 mb-1">

<div class="row pt-2">

    <div class="col col-sm-11 col-md-10 col-lg-9 accordion" id="accordionRegionVille">

        <form method="POST" action="{{ route('admin.attribute.create') }}">
            @csrf
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" placeholder="Nom attribut. Ex: Surface">
                </div>
                <div class="col">
                    <input type="text" class="form-control form-control-sm" name="unit" placeholder="Unité. Ex: m">
                </div>
                <div class="col">
                    <input type="text" class="form-control form-control-sm" name="unit_exposant" placeholder="Exposant. Ex: 2">
                </div>
            </div>
            <div class="form-row my-2">
                <div class="col">
                    <input type="text" class="form-control form-control-sm" name="possible_values"
                        placeholder="Valeurs possibles. Ex: Essence, Gasoil, Electrique">
                </div>
            </div>
            <div class="form-row">
                <div class="col-9">
                    <select id="validator" class="form-control form-control-sm @error('data_type') is-invalid @enderror" name="data_type">
                        <option class="d-none" value="" selected>Type de données. Texte, Entier</option>
                        <option value="Texte">Texte</option>
                        <option value="Entier">Entier</option>
                        <option value="Réel">Réel</option>
                        <option value="Date">Date</option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>
                </div>
            </div>
        </form>


        <h5 class="mt-4">Associer les attributs et les catégories</h5>
        <hr class="mt-0 mb-2">
        <form class="mb-3" method="POST" action="{{ route('admin.attribute.associate') }}">
            @csrf
            <div class="form-row">
            <div class="col-12 col-sm-6">
                <label for="attribute">Attributs : </label>
                <select class="form-control ml-2 @error('attribute') is-invalid @enderror" id="attribute" name="attribute">

                    <option selected value="" class="d-none">Choisir un attribut</option>
                    @foreach ($attributes as $attribute)
                    <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-12 col-sm-6">
                <label for="subcategory">Sous catégories : </label>
                <select class="form-control ml-2 @error('subcategory') is-invalid @enderror" id="subcategory" name="subcategory">

                    <option selected value="" class="d-none">Choisir une catégorie</option>
                    @foreach ($categories as $category)
                        @foreach ($subcategories as $subcategory)
                            @if ($category->id == $subcategory->category_id)
                                <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                            @endif
                        @endforeach
                    @endforeach

                </select>
            </div>
            </div>
            <div class="form-group m-2">
                <button type="submit" class="btn btn-primary">Associer</button>
            </div>
        </form>


        <!--  voir les attributs des categories  -->
        <h5 class="mt-4">Voir les attributs</h5>
        <hr class="mt-0 mb-2">

        <div class="row" id="show_subcat_attr">
            <div class="col">
                <div class="form-group mx-sm-3 mb-2">
                    <select class="form-control ml-2" id="subcategory" name="subcategory">

                        <option selected value="" class="d-none">Choisir une catégorie</option>
                        @foreach ($categories as $category)
                        @foreach ($subcategories as $subcategory)
                        @if ($category->id == $subcategory->category_id)
                        <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                        @endif
                        @endforeach
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="col">
                <div class="no-attr">Aucun attribut</div>
                <ul class="list-group" style="display:none;">
                    <li class="list-group-item">Carburant</li>
                    <li class="list-group-item">Carrossérie</li>
                </ul>
            </div>
            
        </div>

    </div>
    @endsection