<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';//imdica cual va a ser la tabla que modifica el modelo
    
    //relacion 1 a muchos / comentarios en una imagen
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    //relacion 1 a muchos / likes en una imagen
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    //relacion muchos a 1 / imagen creada por un usuario
    //Esto sirve para que despues podamos llamar desde imagen al metodo user y nos devuelva quien creo la imagen
    //muy interesante
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
