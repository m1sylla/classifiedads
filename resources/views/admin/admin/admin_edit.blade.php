@extends('admin.layout')

@section('content')

<h5>Modifier l'administrateur</h5>
<hr class="mt-0 mb-1">
<div class="row">
    {{ $admin->name }}
</div>

<form class="mt-2" method="POST" action="{{ route('admin.gestion_admin.update', $admin->id) }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Nom</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name"
                value="{{ $admin->name }}" required autocomplete="name">
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">Addresse E-Mail</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ $admin->email }}" required
                autocomplete="email">
        </div>
    </div>


    <div class="form-group row">
        <label for="level" class="col-md-4 col-form-label text-md-right">Niveau</label>

        <div class="col-md-6">
            <select class="form-control" id="level" name="level" value="{{ $admin->level }}">
                <option>1</option>
                <option>2</option>
            </select>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Valider
            </button>
        </div>
    </div>
</form>

@endsection