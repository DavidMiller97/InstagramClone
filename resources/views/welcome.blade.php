@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 d-flex justify-content-center align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('instagram.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <ul class="list-group">
                        @if (Route::has('login'))
                
                        @auth
                        <li class="list-group-item text-center"><a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a></li>
                        @else
                        <li class="list-group-item text-center"><a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a></li>
                        @if (Route::has('register'))
                            <li class="list-group-item text-center"><a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a></li>
                            
                        @endif
                    @endauth
                
            @endif    
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection