@extends('admin.layout')

@section('content')

<h5>Comptes </h5>
<hr class="mt-0 mb-3">

@if ($comptes->isEmpty())
<div class="row my-1" >
    <div class="col h4 text-center">
        Aucun nouveau compte
    </div>
</div>
@endif

@foreach ($comptes as $compte)
<div class="d-flex border p-2 m-1 manage-compte">
    <div class="py-2 mr-3">
        <img class="rounded-circle" src="/uploads/profiles/{{$compte->avatar}}" height="60"
        width="60" alt="username">
    </div>
    <div class="">
        <div class="">
            <span class="h5">{{$compte->first_name }} {{$compte->last_name }}</span>
            <span class="ml-3 text-muted">Inscrit le {{date('d-m-Y', strtotime($compte->created_at)) }}</span>
        </div>
        <div class="my-2">
            @if (!$compte->confirmed)
            <span class="mr-3 text-muted">Non confirmé</span>
            @endif
            <span class="badge badge-light">{{$annonces->where([['compte_id',$compte->id],['suspended',0]])->count() }}</span> annonces actives
            <span class="badge badge-light">{{$annonces->where([['compte_id',$compte->id],['suspended',0]])->count() }}</span> annonces suspendues
        </div>
        <div class="my-1"> 
            
            <button class="btn btn-sm btn-warning shadow-none" title="débloquer ce compte" name="suspend_free_compte" value="{{$compte->id}}"
                id="free_compte{{$compte->id}}" style="{{ $compte->suspended ? '' : 'display: none;' }}">
                Débloquer
            </button> 
            <button class="btn btn-sm shadow-none" title="Suspendre ce compte" name="suspend_free_compte" value="{{$compte->id}}"
                id="suspend_compte{{$compte->id}}" style="{{ $compte->suspended ? 'display: none;' : '' }}">
                Suspendre
            </button> 
            
            
            <form action="{{ route('admin.compte.delete', $compte->id) }}" method="post" class="d-inline-block">
                @csrf
                <input type="submit" class="btn btn-sm btn-danger shadow-none" value="Supprimer"
                title="Supprimer ce compte">
            </form>
            
        </div>
    </div>
</div>
@endforeach
    


@endsection