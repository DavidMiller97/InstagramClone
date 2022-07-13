@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex flex-column justify-content-center">
            <h1>Mis imagenes favoritas</h1>
            <hr>
            @foreach($likes as $like)
                @include('includes.card', ['imagen' => $like->imagen])
            @endforeach
        </div>
    </div>
</div>
@endsection
