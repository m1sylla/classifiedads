@extends('admin.layout')

@section('content')

<h5>Annonces</h5>
<hr class="mt-0 mb-1">
<div class="row">
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
            
                <span>
                    @if ($annonces->count()>0)
                        {{$annonces->count()}}
                    @else 0 @endif
                </span><br />Annonces
            
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
            
                <span>
                    @if ($annonces->count()>0)
                        {{$annonces->where('suspended', 1)->count()}}
                    @else 0 @endif
                </span><br />Annonces suspendues
            
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
            
                <span>
                    @if ($annonces->count()>0)
                        {{$annonces->where('deleted', 1)->count()}}
                    @else 0 @endif
                </span><br />Annonces supprimées
            
        </div>
    </div>
</div>
<h5 class="mt-3">Comptes</h5>
<hr class="mt-0 mb-1">
<div class="row">
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
                <span>
                @if ($comptes->count()>0)
                    {{$comptes->count()}}
                @else 0 @endif
                </span><br />Comptes 
            
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
            
                <span>
                    @if ($comptes->count()>0)
                        {{$comptes->where('suspended', 1)->count()}}
                    @else 0 @endif
                </span><br />Comptes suspendus
            
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
            
                <span>
                    @if ($comptes->count()>0)
                        {{$comptes->where('deleted', 1)->count()}}
                    @else 0 @endif
                </span><br />Comptes supprimés
        
        </div>
    </div>
</div>
<h5 class="mt-3">Annuaires</h5>
<hr class="mt-0 mb-1">
<div class="row">
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
            
                <span>0</span><br />Professionnels actifs
            
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
           
                <span>0</span><br />Professionnels en attente de validation
            
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
            
                <span>0</span><br />Professionnels refusés
            
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
            
                <span>0</span><br />Professionnels suspendus
            
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2 p-1">
        <div class="bg-light h-100 w-100 p-2 text-secondary text-center">
            
                <span>0</span><br />Professionnels supprimés
            
        </div>
    </div>
</div>
@endsection