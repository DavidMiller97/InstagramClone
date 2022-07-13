<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    
    public function __construct(){

        $this->middleware('auth');
    }

    public function save(Request $request){

        $validate = $this->validate($request, array(

            'imagen_id' => ['integer', 'required'],
            'content' => ['required', 'string']
        ));

        $content = $request->input('content');
        $imagen_id = $request->input('imagen_id');
        $user = Auth::user();

        $comment = new Comentario();
        $comment->user_id = $user->id;
        $comment->imagen_id = $imagen_id;
        $comment->contenido = $content;

        $comment->save();

        return redirect()->route('imagen.detalle', [$imagen_id])->with('message', 'Has publicado tu comentario correctamente!');

    }

    public function delete($id){

        $user = Auth::user();
        $comment = Comentario::where('comentario_id', $id)->first();
        $imagen = $comment->imagen->imagen_id;

        if($user && !($comment->user_id == $user->id || $comment->imagen->user_id == $user->id)) return;

        //Da error porque toma como la columna por defecto id y al cambiarla en el modelo da otro error
        //$comment->delete();
        Comentario::where('comentario_id', $id)->delete();
            
        return redirect()->route('imagen.detalle', ['id' => $imagen])->with('message', 'Comentario borrado correctamente!');
        
    }
}
