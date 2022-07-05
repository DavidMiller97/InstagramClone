<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
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
}
