@extends('admin.layout')

@section('content')

<h5>Ajouter des catégories et sous catégories</h5>
<hr class="mt-0 mb-1">

<div class="row pt-2">

    <div class="col col-sm-11 col-md-10 col-lg-9 accordion" id="accordionCategory">
        @foreach ($categories as $category)
        <div class="card">
            <div class="card-header px-0 py-1 d-flex" id="heading-{{ $category->id }}">
                <!-- suppresion category  -->
                <form class="align-self-center" method="POST"
                    action="{{ route('admin.category.delete', $category->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button class="btn btn-light btn-sm" type="submit">
                        <i class="fas fa-trash-alt text-danger"></i>
                    </button>
                </form>
                <button
                    class="btn btn-link @if($category->id != 1) collapsed @endif text-dark text-decoration-none flex-grow-1"
                    type="button" data-toggle="collapse" data-target="#collapse-{{ $category->id }}"
                    aria-expanded="true" aria-controls="collapse-{{ $category->id }}">
                    <span class="float-left">{{ $category->name }}</span>
                    <i class="fa fa-plus text-secondary float-right"></i>
                </button>
            </div>

            <div id="collapse-{{ $category->id }}" class="collapse category-collapse"
                aria-labelledby="heading-{{ $category->id }}" data-parent="#accordionCategory">
                <div class="card-body py-0">
                    <ul class="list-group list-group-flush text-secondary">
                        @foreach ($category_items as $category_item)
                        @if ($category_item->category_id == $category->id)
                        <li class="list-group-item d-flex">
                            <span class="flex-grow-1 align-self-center">{{ $category_item->name }}</span>
                            <!-- suppresion category_item  -->
                            <form class="align-self-center" method="POST"
                                action="{{ route('admin.category.item.delete', $category_item->id) }}">
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
                            <!-- ajout category_item  -->
                            <form method="POST" action="{{ route('admin.category.item.create') }}">
                                @csrf
                                <input type="hidden" name="category_id" value="{{ $category->id }}">
                                <div class="form-row d-flex">
                                    <div class="flex-grow-1">
                                        <input type="text" class="form-control form-control-sm" name="name"
                                            placeholder="Ajouter une sous catégorie">
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
                <!-- ajout category  -->
                <form method="POST" action="{{ route('admin.category.create') }}">
                    @csrf
                    <div class="form-row d-flex">
                        <div class="flex-grow-1">
                            <input type="text" class="form-control form-control-sm" name="name"
                                placeholder="Ajouter une catégorie(ex: Multimédia)">
                        </div>
                        <div class="ml-2">
                            <button type="submit" class="btn btn-primary btn-sm">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</div>
@endsection