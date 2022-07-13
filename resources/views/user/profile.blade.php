@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex flex-column justify-content-center">
            <div class="data-user mt-5">
                <div class="user-image">
                    @if($user->image)
                        <img src="{{ route('user.avatar.imagen', [$user->image]) }}" alt="">
                        
                    @else
                        
                        <img src="{{ asset('default.png') }}" alt="">
                    @endif
                </div>
                <div class="user-info">
                    <h2>{{'@'.$user->nickname}}</h2>
                    <h3>{{$user->name . ' ' . $user->surname}}</h3>
                    <p>{{ 'Se unio: ' . $user->created_at->locale('es_ES')->diffForHumans(null, false, false, 1) }}</p>
                </div>
            </div>
            <hr>
            @foreach($user->imagenes as $imagen)
                @include('includes.card', ['imagen' => $imagen])
            @endforeach
        </div>
    </div>
</div>
@endsection
