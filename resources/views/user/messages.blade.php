@extends('user.user_layout')

@section('content')

@include('includes.carbon')

<div class="row px-2 px-md-0 pt-2 bg-white border">

    @if ($messages->isEmpty())
    <div class="col">
        <h3 class="py-5 text-center">Vous n'avez aucun nouveau message</h3>
    </div>
    @endif
    @foreach ($messages as $message)
    <div class="col-12 mb-2">
        <div class="row ">
            <div class="col-2 px-1">
                <div class="pt-3 d-flex flex-column">
                    <i class="material-icons ml-auto" style="font-size:48px;">account_circle</i>
                    <span class="d-block ml-auto">{{$message->name}}</span>
                </div>
            </div>
            <div class="col-10">
            <div class="card position-relative" style="background-color: #f1f1f1;">
                <div class="card-body py-2 px-1">
                    <p class="card-text font-weight-light">
                        {{$message->message}}
                    </p>
                    <p class="card-text mb-0">Réf ann : {{$message->identifiant}}</p>
                    <p class="card-text w-75">Mon num : {{$message->phone}}</p>
                </div>
                <span class="position-absolute text-muted" style="bottom:0px;right:3px;">
                    <?php $mg_created_at = Carbon::parse($message->created_at); ?>
                    @if ($mg_created_at->isCurrentDay()) 
                        {{$mg_created_at->calendar()}}
                    @elseif ($mg_created_at->isYesterday()) 
                        {{$mg_created_at->calendar()}}
                    @elseif ($mg_created_at->isCurrentYear())
                        {{$mg_created_at->isoFormat('DD MMM HH:mm')}}
                    @else 
                        {{$mg_created_at->isoFormat('lll')}}
                    @endif
                </span>
            </div>
            </div>
        </div>
    </div> 
    @endforeach

</div> 


@stop