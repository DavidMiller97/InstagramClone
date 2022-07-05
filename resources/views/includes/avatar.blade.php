@if (Auth::user()->image)
                                            
    <img src="{{ route('user.avatar.imagen', Auth::user()->image) }}">
                                
@endif