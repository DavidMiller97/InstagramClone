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
                <div class="card pub_image">
                    <div class="card-header d-flex align-items-baseline">
                        @if($imagen->user->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar.imagen', [$imagen->user->image]) }}" alt="">
                            </div>
                        @endif
                        <div class="data-user">
                            <a href="{{ route('imagen.detalle', [$imagen->imagen_id]) }}">
                                {{ $imagen->user->name . ' ' . $imagen->user->surname}}
                            </a>
                            <span>{{ ' | @' . $imagen->user->nickname }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{ route('imagen.file', ['filename' => $imagen->ruta_imagen]) }}">
                        </div>
                        <div class="likes">       
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <div class="description">
                            <span>
                                {{'@' . $imagen->user->nickname}}
                            </span>
                            <p>
                                {{ $imagen->descripcion }}
                            </p>
                        </div>
                        <a href="" class="btn btn-warning btn-comments">Comentarios({{ count($imagen->comentarios) }})</a>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $imagenes->links() }}
    </div>
</div>
@endsection
