<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function like($id){

        $user = Auth::user();

        //Compromar si existe el like
        $isLike = Like::where('user_id', $user->id)->where('imagen_id', $id)->count();
        
        if($isLike !== 0) return;
        
        $like = new Like();

        $like->user_id = $user->id;
        $like->imagen_id = (int)$id;

        $like->save();
        $totalLikes = Like::all()->where('imagen_id', $id)->count();

        return response()->json(['like' => $like, 'message' => 'Te gusta', 'numeroLikes' => $totalLikes]);
    }

    public function dislike($id) {

        $user = Auth::user();

        //Compromar si existe el like
        $isLike = Like::where('user_id', $user->id)->where('imagen_id', $id)->first();
        

        if(!$isLike) return;

        $isLike->delete();
        $totalLikes = Like::all()->where('imagen_id', $id)->count();

        return response()->json(['like' => $isLike, 'message' => 'Ya no te gusta', 'numeroLikes' => $totalLikes]);

    }

    public function index(){

        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)->orderBy('like_id', 'desc')->paginate(5);

        return view('likes.index', ['likes' => $likes]);
    }
}
