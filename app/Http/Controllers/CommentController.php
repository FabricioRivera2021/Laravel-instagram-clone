<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){
        //Validacion
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);

        //Recoger los datos
        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        //asignar los valores al nuevo objeto de comentario a guardar en la BD
        $comment = New Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();//guardar en la DB

        return redirect()->route('image.detail', ['id' => $image_id])
                         ->with([
                            'status' => "Has ingresado un comentario con exito"
                         ]);
    }
}
