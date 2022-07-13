@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 d-flex flex-col justify-content-center">
            <div class="card pub_image">
                <div class="card-header d-flex align-items-baseline">
                    @if($imagen->user->image)
                        <div class="container-avatar">
                            <img src="{{ route('user.avatar.imagen', [$imagen->user->image]) }}" alt="">
                        </div>
                    @endif
                    <div class="data-user">
                        {{ $imagen->user->name . ' ' . $imagen->user->surname}}
                        <span>{{ ' | @' . $imagen->user->nickname }}</span>
                    </div>
                </div>

                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ route('imagen.file', ['filename' => $imagen->ruta_imagen]) }}">
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <div class="likes-contenedor">
                            <?php $user_like = false; ?>
                            @foreach ($imagen->likes as $like)
                                @if($like->user->id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach
                            <div class="likes">       
                                <svg class="h-6 w-6 @if($user_like) btn-like @else btn-dislike @endif" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" data-imagen="{{$imagen->imagen_id}}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <span id="number-likes">{{count($imagen->likes)}}</span>
                        </div>
                        @if(Auth::user() && Auth::user()->id == $imagen->user->id)
                            @include('includes.modal')
                            <div class="actions">
                                <a href="{{route('imagen.edit', [$imagen->imagen_id])}}" class="btn btn-sm btn-primary">Actualizar</a>
                                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Borrar</a>
                            </div>
                        @endif
                    </div>
                    <div class="description">
                        <span>
                            {{'@' . $imagen->user->nickname}}
                        </span>
                        <span>{{'| ' . $imagen->created_at->locale('es_ES')->diffForHumans(null, false, false, 1) }}</span>
                        <p>
                            {{ $imagen->descripcion }}
                        </p>
                    </div>
                    <div class="comments">
                        @if(session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <h2>Comentarios({{ count($imagen->comentarios) }})</h2>
                        <form action="{{ route('comment.save') }}">
                            @csrf
                            <input type="hidden" name="imagen_id" value="{{$imagen->imagen_id}}"/>
                            <p>
                                <textarea name="content" id="content" class="form-control @error('content') 'is-invalid' @enderror"></textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>
                            <button type="submit" name="enviar" class="btn btn-success">Enviar</button>
                        </form>
                        @foreach($imagen->comentarios as $comentario)
                            <div class="comment">
                                    <span>
                                        {{'@' . $comentario->user->nickname}}
                                    </span>
                                    <span>{{'| ' . $comentario->created_at->locale('es_ES')->diffForHumans(null, false, false, 1) }}</span>
                                    <p>
                                        {{ $comentario->contenido }}
                                    </p>
                                    @if(Auth::check() && ($comentario->user_id == Auth::user()->id || $comentario->imagen->user_id == Auth::user()->id))
                                        <a href="{{ route('comment.delete', $comentario->comentario_id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                                    @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection