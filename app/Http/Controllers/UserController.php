<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;

class UserController extends Controller
{
    //con esto si el usuario quiere ingresar a una pagina q solo sea para usuarios autenticados no podra acceder a esa vista. sera redirigido al login
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        //conseguir usuario identificado
        $user = Auth::user();        
        $id = Auth::user()->id;

        //validacion del formulario
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', Rule::unique('users', 'nick')->ignore($id, 'id')], //el unique es para que no se pueda usar un nick de otro usuario
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id, 'id')] //mismo unique pero para el email
        ]);

        //recoger los datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //asignar nuevos valores al objeto del usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir la imagen
        $image_path = $request->file('image_path');
        if($image_path){
            //renombrar la imagen para que tenga un nombre unico
            $image_path_full = time().$image_path->getClientOriginalName();

            //guardar la imagen en el storage
            Storage::disk('users')->put($image_path_full, File::get($image_path));

            //setear el nombre de la imagen en el objeto
            $user->image = $image_path_full;
        }

        //ejecutar consulta y cambios en la base de datos
        $user->update();

        return redirect()->route('config')->with(['status'=>'Datos actualizados']);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function profile($id){
        $user = User::find($id);

        return view('user.profile', [
            'user' => $user
        ]);
    }
}
