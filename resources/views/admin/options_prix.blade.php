@extends('admin.layout')

@section('content')

<h5>Ajouter une option de prix</h5>
<hr class="mt-0 mb-1">

<div class="row pt-2">

    <div class="col col-sm-11 col-md-10 col-lg-9 accordion" id="accordionRegionVille">

        <div class="card">

            <div class="card-body py-0">
                <ul class="list-group list-group-flush text-secondary">
                    @foreach ($price_options as $price_option)

                    <li class="list-group-item d-flex">
                        <span class="flex-grow-1 align-self-center">{{ $price_option->name }}</span>
                        <!-- suppresion option prix  -->
                        <form class="align-self-center" method="POST"
                            action="{{ route('admin.price.option.delete', $price_option->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button class="btn btn-light btn-sm" type="submit">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </li>
                    
                    @endforeach
                    <li class="list-group-item">
                        <!-- ajout option prix  -->
                        <form method="POST" action="{{ route('admin.price.option.create') }}">
                            @csrf
                            <div class="form-row d-flex">
                                <div class="flex-grow-1">
                                    <input type="text" class="form-control form-control-sm" name="name"
                                        placeholder="Ajouter une option de prix(ex: /jour)">
                                </div>
                                <div class="ml-2">
                                    <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

    </div>

</div>
@endsection