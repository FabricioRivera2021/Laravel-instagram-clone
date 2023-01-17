<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        var_dump($request);
        die();
    }
}
