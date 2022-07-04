<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as FacadesFile;

class UserController extends Controller
{

    public function __construct(){

        $this->middleware('auth');
    }

    public function config(){

        return view('user.config');

    }

    public function change_pass(){

        return view('user.changepass');
    }

    public function update(Request $request){

        //obtener sesion usuario
        $user = Auth::user();
        $id = Auth::user()->id;

        //Validar datos del formulairo
        $validate = $this->validate($request, array(

            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255', 'unique:users,nickname,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ));

        //Obtener datos del formulairo
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nickname = $request->input('nickname');
        $email = $request->input('email');

        //actualizar obj
        $user->name = $name;
        $user->surname = $surname;
        $user->nickname = $nickname;
        $user->email = $email;

        $image_path = $request->file('imagen');

        if($image_path){

            //nombre unico
            $image_path_full = time() . $image_path->getClientOriginalName();
            //Guardar en la carpeta storage users
            Storage::disk('users')->put($image_path_full, FacadesFile::get($image_path));
            $user->image = $image_path_full;
        }

        $user->update();

        return redirect()->route('config')->with('message', 'Usuario actualizado correctamente');
    }

    public function update_pass(Request $request){

  
        //obtener sesion usuario
        $user = Auth::user();
        $id = Auth::user()->id;

        $validate = $this->validate($request, array(

            'old-password' => ['required', 'string', 'min:8'],
            'new-password' => ['required', 'string', 'min:8', 'confirmed'],
        ));


        if(!Hash::check($request->input('old-password'), $user->password)){

            return redirect()->route('change_pass')->with('error', 'Contraseña incorrecta!');

        }


        #Update the new Password
        $user->password = Hash::make($request->input('new-password'));
        $user->update();


        return redirect()->route('change_pass')->with('status', 'Contraseña modificada correctamente!');

    }

    public function getImagen($filename){

        $file = Storage::disk('users')->get($filename);

        return new Response($file, 200);

    }
}
