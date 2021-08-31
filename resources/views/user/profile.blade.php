@extends('user.user_layout')

@section('content')

<!--
<div class="row">
  <div class="col d-flex border bg-white p-3 color-blue">
    <div class="pr-3">0 annonces vendues</div>
    <div class="pr-3">0 favoris</div>
    <div>0 noveaux messages</div>
  </div>
</div> -->

@if (Session::has('compte_update_success'))
<div class="row">
    <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-success " role="alert">
        <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="p-2">
        {{ Session::get('compte_update_success') }}
        </div>
    </div>
</div>
@endif

@if (Session::has('password_update_success'))
<div class="row">
    <div class="col-10 col-md-9 col-lg-8 my-2 mx-auto p-2 alert alert-success " role="alert">
        <button type="button" class="close float-right m-0 font-weight-bold" aria-label="Close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="p-2">
        {{ Session::get('password_update_success') }}
        </div>
    </div>
</div>
@endif

<div class="row border bg-white py-3 mb-3">
  <div class="col">
    <div class="h5 color-blue">
      Mes informations
    </div>
    <form method="POST" action="{{ route('compte.update') }}">
      @csrf
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="firstName">Prénom</label>
          <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" name="first_name" value="{{Auth::user()->first_name}}">
        </div>

        <div class="form-group col-md-6">
          <label for="lastName">Nom</label>
          <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastName" name="last_name" value="{{Auth::user()->last_name}}">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="telephone">Téléphone</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">+224</div>
            </div>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="telephone" name="phone" value="{{Auth::user()->phone}}">
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="gender">Genre</label>
          
            @if (!Auth::user()->gender)
            <select id="gender" class="form-control" name="gender">
            <option class="d-none" value="" selected ></option>
            <option value="Masculin">Masculin</option>
            <option value="Féminin">Féminin</option>
            <option value="Autre">Autre</option>
            </select>
            @else 
            <select id="gender" class="form-control" name="gender" disabled>
            <option >{{ Auth::user()->gender }}</option>
            </select>
            @endif
          
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{Auth::user()->email}}">
        </div>
      </div>
      <button type="submit" class="btn background-blue darken-blue text-white">Enregistrer</button>
    </form>
  </div>
</div>

<!--  change password  -->
<div class="row border bg-white py-3 my-3">
  <div class="col">
    <div class="h5 color-blue">
      Changer de mot de passe
    </div>

    <form method="POST" action="{{ route('password.change') }}">
      @csrf

      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="currentPassword">Actuel mot de passe</label>
          <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword"
            name="current_password" placeholder="Mot de passe actuel">
        </div>
        <div class="form-group col-md-4">
          <label for="password">Nouveau</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" 
          placeholder="Mot de passe">
        </div>
        <div class="form-group col-md-4">
          <label for="confirmPassword">Confirmer</label>
          <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirmPassword" 
          name="confirm_password" placeholder="Confirmer mot de passe">
        </div>
      </div>
      
      @if (Session::has('error_current_password'))
      <div class="text-danger p-2">
        <strong>{{ Session::get('error_current_password')}}</strong>
      </div>
      @endif

      <button type="submit" class="btn background-blue darken-blue text-white">Changer</button>
    </form>
  </div>
</div>

<div class="row border bg-white py-3 my-3">
  <div class="col">
    <div class="h5 color-blue">
      Notifications
    </div>
    <form class="form-inline">
      <div class="form-group my-1 mr-sm-2">
        <i style="font-size:24px; opacity:.7;" class="fa fa-check-square color-blue mr-2"></i>
        <input type="checkbox" style="display:none;" checked disabled> Informations de la part de Yetecan
      </div>
    </form>

    <form class="form-inline">
      <input class="d-none" type="text" readonly name="id" value="{{Auth::user()->id}}">
      <div class="form-group my-1 mr-sm-2">
        <i style="font-size:24px;" id="pub_from_yetecan" class="fa fa-check-square color-blue mr-2"></i>
        <input type="checkbox" style="display:none;" checked> Publicités de la part de Yetecan
      </div>
    </form>
    
    <form class="form-inline">
      <input class="d-none" type="text" readonly name="id" value="{{Auth::user()->id}}">
      <div class="form-group my-1 mr-sm-2">
        <i style="font-size:24px;" id="pub_from_partner" class="fa fa-check-square color-blue mr-2"></i>
        <input type="checkbox" style="display:none;" checked> Publicités des partenaires de Yetecan
        
      </div>
    </form>
  </div>
</div>

<!--  delete account  -->
<div class="row my-5">
  <div class="col border border-danger py-3" style="background-color:#fcdcdc;">
    
      <p>
        Pour supprimer votre compte et toutes les informations qui lui sont associées, 
        cliquez sur le button <strong>Supprimer ce compte</strong>
      </p>
      <p>
        <strong>Notes:</strong>
        <ul>
          <li>Cette action est irréversible</li>
          <li>Cette action supprimera toutes vos annonces</li>
        </ul>
      </p>
      <form action="{{ route('compte.delete', Auth::user()->id) }}" method="post">
        @csrf
        <input type="submit" class="btn btn-danger shadow-none" value="Supprimer ce compte">
      </form>
    
  </div>
</div>

@stop