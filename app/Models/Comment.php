<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';//imdica cual va a ser la tabla que modifica el modelo

    //relacion 1 a muchos / Imagen creada por un usuario
    public function image(){
        return $this->belongsTo('App\Models\Image', 'user_id');
    }

    //relacion muchos a 1 / comentario creado por un usuario
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
