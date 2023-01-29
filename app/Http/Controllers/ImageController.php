<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Like;
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

    public function create()
    { //para crear las imagenes
        return view('images.create');
    }

    public function save(Request $request)
    {
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
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $imagen->image_path = $image_path_name;
        }
        $imagen->save(); //guarda en la base de datos, este metodo save parece q viene por defecto

        return redirect()->route('home')->with([
            'message' => 'La imagen se ha subido correctamente!'
        ]);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200); //esto devuelve las imagenes desde los discos virtuales
    }

    public function detail($id)
    {
        $image = Image::find($id); //el metodo find busca una imagen, en este caso mediente la id

        return view('images.detail', [
            'image' => $image
        ]);
    }

    public function delete($id)
    {
        //consiguiendo el user logueado
        $user = Auth::user();
        //consiguiendo la imagen que hay q borrar, y los comentarios y los likes de la misma
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if ($user && $image && $image->user_id == $user->id) { //si el user logueado es el mismo que creo la imagen
            //eliminar comentarios
            if ($comments && count($comments) >= 1) { //si los comentarios existen
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            //eliminar likes
            if ($likes && count($likes) >= 1) { //si los comentarios existen
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            //eliminar los archivos de imagen guardados en el storage
            Storage::disk('images')->delete($image->image_path);
            //eliminar el registro de la imagen
            $image->delete();

            $message = array('status' => 'La imagen se ha eliminado correctamente');
        } else {
            $message = array('status' => 'La imagen no se ha eliminado, ocurrio un error');
        }
        return redirect()->route('home')->with($message);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $image = Image::find($id);
        $image_path = $image->image_path;

        if ($user && $image && $image->user->id == $user->id) {
            return view('images.edit', [
                'image' => $image,
                'image_path' => $image_path
            ]);
        } else {
            return redirect()->route('home');
        }
    }

    public function update(Request $request)
    {
        //Validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'mimes:jpg,bmp,png'
        ]);

        //recoger los datos del formulario de edicion
        $image_id = $request->input('image_id');
        $image_old_path = $request->input('image_old_path');//recoger el path de la imagen anterior para borrarla del storage
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        //conseguir objeto imagen
        $image = Image::find($image_id);
        $image->description = $description;

        //subir la imagen
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->delete($image_old_path);
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        //actualizar registro de la BD
        $image->update();

        return redirect()->route('image.detail', ['id' => $image_id])
                         ->with(['status' => "imagen actualizada con exito"]);
    }
}
