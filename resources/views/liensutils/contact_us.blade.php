@extends('liensutils.layout')
@section('title')
<title>Nous contacter &#124; Yetecan </title>
@stop
@section('content')
    <div class="row text-center my-5">
        <div class="col">
            <h2>Nous contacter</h2>
        </div>
    </div>

    @if (Session::has('contactus_send_success'))
    <div class="row mb-3">
        <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-success" role="alert">
            <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="p-2">
            {{ Session::get('contactus_send_success') }}
            </div>
        </div>
    </div>
    @endif 

    <form class="bg-white py-3 my-4" method="POST" action="{{ route('contact.send') }}">
        @csrf
        
        <!-- Nom -->
        <div class="form-group row">
            <label for="name" class="col-sm-3 text-sm-right px-sm-1 px-4
            col-form-label font-weight-bold">
                Nom
            </label>
            <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                id="name" name="name" placeholder="Votre nom">
            </div>
        </div>

        <!-- Email -->
        <div class="form-group row">
            <label for="email" class="col-sm-3 text-sm-right px-sm-1 px-4
            col-form-label font-weight-bold">
                Email
            </label>
            <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                <input type="text" class="form-control @error('email') is-invalid @enderror" 
                id="email" name="email" placeholder="Votre email">
            </div>
        </div>

        <!-- Numero -->
        <div class="form-group row">
            <label for="phone" class="col-sm-3 text-sm-right px-sm-1 px-4
            col-form-label font-weight-bold">
                Téléphone
            </label>
            <div class="col-sm-5 col-md-4 px-sm-1 px-4">
                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                id="phone" name="phone" placeholder="Votre numéro">
            </div>
        </div>
        
        <!-- Message -->
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