@extends('admin.layout')

@section('content')

<h5>Ajouter une ville ou une région</h5>
<hr class="mt-0 mb-1">

<div class="row pt-2">

    <div class="col col-sm-11 col-md-10 col-lg-9 accordion" id="accordionRegionVille">

        @foreach ($regions as $region)
        <div class="card">
            <div class="card-header px-0 py-1 d-flex" id="heading-{{ $region->id }}">
                <!-- suppresion region  -->
                <form class="align-self-center" method="POST" action="{{ route('admin.region.delete', $region->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button class="btn btn-light btn-sm" type="submit">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </button>
                </form>
                <button
                    class="btn btn-link @if($region->id != 1) collapsed @endif text-dark text-decoration-none flex-grow-1"
                    type="button" data-toggle="collapse" data-target="#collapse-{{ $region->id }}" aria-expanded="true"
                    aria-controls="collapse-{{ $region->id }}">
                    <span class="float-left">Région de {{ $region->name }}</span>
                    <i class="fa fa-plus text-secondary float-right"></i>
                </button>
            </div>

            <div id="collapse-{{ $region->id }}" class="collapse ville-collapse"
                aria-labelledby="heading-{{ $region->id }}" data-parent="#accordionRegionVille">
                <div class="card-body py-0">
                    <ul class="list-group list-group-flush text-secondary">
                        @foreach ($villes as $ville)
                        @if ($ville->region_id == $region->id)
                        <li class="list-group-item d-flex">
                            <span class="flex-grow-1 align-self-center">{{ $ville->name }}</span>
                            <!-- suppresion ville  -->
                            <form class="align-self-center" method="POST"
                                action="{{ route('admin.ville.delete', $ville->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button class="btn btn-light btn-sm" type="submit">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </button>
                            </form>
                        </li>
                        @endif
                        @endforeach
                        <li class="list-group-item">
                            <!-- ajout ville  -->
                            <form method="POST" action="{{ route('admin.ville.create') }}">
                                @csrf
                                <input type="hidden" name="region_id" value="{{ $region->id }}">
                                <div class="form-row d-flex">
                                    <div class="flex-grow-1">
                                        <input type="text" class="form-control form-control-sm" name="name"
                                            placeholder="Ajouter une ville(ex: Coyah)">
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

        @endforeach

        <div class="card">
            <div class="card-header ">
                <!-- ajout region  -->
                <form id="add_region" method="POST" action="{{route('admin.region.create')}}">
                    {{ csrf_field() }}
                    <div  class="form-row d-flex">
                        <div class="flex-grow-1">
                            <input type="text" id="name" class="form-control form-control-sm" name="name"
                                placeholder="Ajouter une région(ex: N'zérékoré)">
                        </div>
                        <div class="ml-2">
                            <button type="submit" id="send_region" class="btn btn-primary btn-sm">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection