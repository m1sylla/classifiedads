@extends('admin.layout')

@section('content')

<a type="button" class="btn btn-light mb-1" href="{{ route('admin.gestion_admin.create') }}">Ajouter un nouvel administrateur</a>
<hr class="mt-0 mb-1">
<h5 class="mt-3">Tous les administrateurs</h5>
<hr class="mt-0 mb-1">
<div class="row">
    <div class="table-responsive">
        <table class="table table-striped table-borderless">
            <tbody>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col-2">Nom</th>
                        <th scope="col-2">Email</th>
                        <th scope="col">Niveau</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                @for ($i = 0; $i < count($admins); $i++)
                <tr>
                    <th scope="row">{{ $i+1 }}</th>
                    <td>{{ $admins[$i]->name }}</td>
                    <td>{{ $admins[$i]->email }}</td>
                    <td>{{ $admins[$i]->level }}</td>
                    <td>
                        @if (Auth::guard('admin')->user()->level == 1)
                            @if ($admins[$i]->id == 1)
                                @if (Auth::guard('admin')->user()->id == 1)
                                    <a href="{{ route('admin.gestion_admin.edit', $admins[$i]->id) }}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('admin.gestion_admin.edit', $admins[$i]->id) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                        @endif
                    </td>
                    <td>
                        @if ($admins[$i]->id != 1)
                        <form method="POST" action="{{ route('admin.gestion_admin.destroy', $admins[$i]->id) }}">
                            {{ csrf_field() }}   
                            {{ method_field('DELETE') }} 

                            <button class="btn btn-light btn-sm delete-admin"  type="submit"> 
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection