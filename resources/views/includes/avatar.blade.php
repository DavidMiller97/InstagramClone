@if (Auth::user()->image)
                                            
    <img src="{{ route('user.avatar.imagen', Auth::user()->image) }}" style="width: 100px; ">
                                
@endif