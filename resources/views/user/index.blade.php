@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex flex-column justify-content-center">
            <form action="{{route('users')}}" method="GET" id="buscador">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Buscar') }}</label>
    
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" required autocomplete="name">
                    </div>
                    <div class="col-md-2">
                        <input type="submit" value="Buscar" class="btn btn-primary">
                    </div>
                </div>
            </form>
            @foreach($users as $user)
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
                        <a href="{{ route('user.perfil', [$user->id]) }}" class="btn btn-success">Ir al perfil</a>
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        {{$users->withQueryString()->links('pagination::bootstrap-5')}}
    </div>
</div>
@endsection