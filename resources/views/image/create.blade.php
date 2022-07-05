@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <div class="card">
                   <div class="card-header">
                       Subir nueva imagen
                   </div>
                   <div class="card-body">
                       <form action="{{ route('image.save') }}" method="POST" enctype="multipart/form-data">
                           @csrf

                            <div class="row mb-3">
                                <label for="imagen" class="col-md-4 col-form-label text-md-end">{{ __('Imagen') }}</label>

                                <div class="col-md-6">
                                    <input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen">

                                    @error('imagen')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-end">{{ __('Descripción') }}</label>
    
                                <div class="col-md-6">
                                    <textarea id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"></textarea>
    
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Subir imagen') }}
                                    </button>
                                </div>
                            </div>
                       </form>
                   </div>
               </div>
            </div>
        </div>
    </div>

@endsection