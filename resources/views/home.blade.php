@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex flex-column justify-content-center">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @foreach($imagenes as $imagen)
                @include('includes.card', ['imagen' => $imagen])
            @endforeach
        </div>
        {{$imagenes->withQueryString()->links('pagination::bootstrap-5')}}
    </div>
</div>
@endsection
