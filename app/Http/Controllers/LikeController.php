<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Like;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id)
    {
        //recoger datos del usuario y la imagen
        $user = Auth::user();

        //condicion para saber si ya existe el like
        $isset_like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->count();

        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            //guardar
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        } else {
            return response()->json([
                'message' => 'El like ya existe'
            ]);
        }
    }

    public function dislike($image_id)
    {
        //recoger datos del usuario y la imagen
        $user = Auth::user();

        //condicion para saber si ya existe el like
        $like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();

        if ($like) {
            //eliminar like
            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'El like se ha eliminado correctamente'
            ]);
        } else {
            return response()->json([
                'message' => 'El like no existe'
            ]);
        }
    }

    public function likes(){
        $user = Auth::user();
        $likes = Like::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(5);
            
        return view('like.likes', [
            'likes' => $likes
        ]);
    }
}
