<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Imagen;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function create(){

        return view('image.create');
    }

    public function save(Request $request){

        $validate = $this->validate($request, array(

            'descripcion' => 'required',
            //'imagen' => 'image', //o en lugarde mimes se puede usar image

        ));

        $description = $request->input('descripcion');
        $imagen = $request->file('imagen');

        $user = Auth::user();
        $image = new Imagen();
        $image->user_id = $user->id;
        $image->descripcion = $description;

        if($imagen){

            //nombre unico
            $image_path_full = time() . $imagen->getClientOriginalName();
            //Guardar en la carpeta storage users
            Storage::disk('images')->put($image_path_full, File::get($imagen));
            $image->ruta_imagen = $image_path_full;
        }

        $image->save();

        return redirect()->route('home')->with('message', 'La foto ha sido subida correctamente');
    }

    public function getImagen($filename){

        $file = Storage::disk('images')->get($filename);

        return new Response($file, 200);
    }

    public function detalle($id){

        $imagen = Imagen::where('imagen_id', $id)->first();

        return view('image.detalle', [

            'imagen' => $imagen,
        ]);
    }

    public function delete($id){

        $user = Auth::user();
        $imagen = Imagen::find($id);
        $comentarios = Comentario::where('imagen_id', $id)->get();
        $likes = Like::where('imagen_id', $id)->get();
        
        if($user && $imagen && ($imagen->user->id == $user->id)){

            if($comentarios && count($comentarios) >= 1){

                foreach($comentarios as $comentario){

                    $comentario->delete();
                }
            }

            if($likes && count($likes) >= 1){

                foreach($likes as $like){

                    $like->delete();
                }
            }

            Storage::disk('images')->delete($imagen->ruta_imagen);

            $imagen->delete();

            $mensaje = array('mesage' => 'La imagen se ha borrado correctamente');
        }else{

            $mensaje = array('mesage' => 'La imagen no se ha borrado correctamente');
        }

        return redirect()->route('home')->with($mensaje);

    }

    public function edit($id){

        $user = Auth::user();
        $imagen = Imagen::find($id);

        if($user && $imagen && $imagen->user->id == $user->id){

            return view('image.edit', ['imagen' => $imagen]);

        }else{

            return redirect()->route('home');
        }
    }

    public function update(Request $request){

        $validate = $this->validate($request, array(

            'descripcion' => 'required',
            //'imagen' => 'image', //o en lugarde mimes se puede usar image

        ));

        $imagen_id = $request->input('imagen_id');
        $description = $request->input('descripcion');
        $imagen = $request->file('imagen');
        $image = Imagen::find($imagen_id);
        $image->descripcion = $description;


        if($imagen){

            //nombre unico
            $image_path_full = time() . $imagen->getClientOriginalName();
            //Guardar en la carpeta storage users
            Storage::disk('images')->put($image_path_full, File::get($imagen));
            $image->ruta_imagen = $image_path_full;
        }

        $image->update();

        return redirect()->route('imagen.detalle', [$imagen_id])->with('message', 'Imagen actualizada con exito!');

    }
}
