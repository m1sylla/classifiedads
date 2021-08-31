@extends('liensutils.layout')
@section('title')
<title>Signaler l'annonce &#124; Yetecan </title>
@stop
@section('content')

        <div class="row text-center my-5">
            <div class="col">
                <h2>Signaler l'annonce</h2>
            </div>
        </div>

        @if (Session::has('ad_reported_success'))
        <div class="row mb-3">
            <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-success" role="alert">
                <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="p-2">
                {{ Session::get('ad_reported_success') }}
                </div>
            </div>
        </div>
        @endif 

        <form class="bg-white py-3 my-4" method="POST" action="{{ route('report.ad.store') }}">
            @csrf
            <input type="hidden" name="annonce_id" value="{{ $annonce_id }}">
            
            <!-- Titre -->
            <div class="form-group row">
                <label for="title" class="col-sm-3 text-sm-right px-sm-1 px-4
                col-form-label font-weight-bold">
                    Titre
                </label>
                <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                    <select class="form-control @error('title') is-invalid @enderror" id="title" name="title">
                        <option value="" selected style="display:none;" disabled>
                            Sélectionner un titre
                        </option>
                        <option value="Texte inapproprié">
                            Texte inapproprié
                        </option>
                        <option value="Image offensante">
                            Image offensante
                        </option>
                        <option value="Autre">
                            Autre
                        </option>
                    </select>
                </div>
            </div>
            
            <!-- Description -->
            <div class="form-group row">
                <label class="col-sm-3 text-sm-right px-sm-1 px-4 col-form-label
                font-weight-bold" for="message">
                    Message :
                </label>
                <div class="col-sm-7 col-md-6 px-sm-1 px-4">
                    <textarea class="form-control @error('message') is-invalid @enderror" 
                    id="message" rows="10" name="message" placeholder="Ecrire message"
                    ></textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <div class="col-3 col-md-4 col-lg-offset-2 mx-auto">
                    <button class="btn btn-lg text-white background-blue" type="submit">
                        Envoyer
                    </button>
                </div>
            </div>
        
        </form>
@stop