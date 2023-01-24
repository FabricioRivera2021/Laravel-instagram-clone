<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;


class ImageController extends Controller
{
    //con esto si el usuario quiere ingresar a una pagina q solo sea para usuarios autenticados no podra acceder a esa vista. sera redirigido al login
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){//para crear las imagenes
        return view('images.create');
    }

    public function save(Request $request){
        //Validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|mimes:jpg,bmp,png'
        ]);
        
        //recoger los datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //asignar valores a un nuevo objeto de imagen
        $user = Auth::user();
        $imagen = new Image();
        $imagen->user_id = $user->id;
        $imagen->image_path = null;
        $imagen->description = $description;

        //subir la imagen
        if($image_path){
            $image_path_name = time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $imagen->image_path = $image_path_name;
        }
        $imagen->save();//guarda en la base de datos, este metodo save parece q viene por defecto

        return redirect()->route('home')->with([
            'message' => 'La imagen se ha subido correctamente!'
        ]);
    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200); //esto devuelve las imagenes desde los discos virtuales
    }

    public function detail($id){
        $image = Image::find($id);//el metodo find busca una imagen, en este caso mediente la id

        return view('images.detail', [
            'image' => $image
        ]);
    }
}
