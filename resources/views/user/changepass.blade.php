@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Cambiar contraseña</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.changepass') }}">
                            @csrf
    
                            <div class="row mb-3">
                                <label for="old-password" class="col-md-4 col-form-label text-md-end">{{ __('Old Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="old-password" type="password" class="form-control @error('password') is-invalid @enderror" name="old-password" required autocomplete="old-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="new-password" class="col-md-4 col-form-label text-md-end">{{ __(' New Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password" required autocomplete="new-password">
    
                                    @error('new-password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="new-password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar cambios') }}
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