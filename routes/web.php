<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//use App\Models\Image; para usar los metodos del modelo imagen, para probar el ORM

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    /*
    jugando con el ORM -------------------------------------------------
    $images = Image::all();
    foreach($images as $image){
        echo $image->image_path."<br/>";
        echo $image->description."<br/>";
        echo $image->user->name.' '.$image->user->surname."<br/>";//Esto funciona porque ya esta definido en el modelo de la imagen
        //ya hay un metodo que dice de que usuario es cada imagen
        foreach($image->comments as $comment){
            echo $comment->user->name.' '.$comment->user->surname.": ";
            echo $comment->content."<br/>";
        }
        echo "LIKES: ".count($image->likes)."<br/>";
        echo "<hr>";
    }

    die();
    return view('welcome');
    */
});

//Rutas generales
Auth::routes();

//Rutas usuarios
Route::get('/user/avatar/{filename}', [App\Http\Controllers\UserController::class, 'getImage'])->name('user.avatar');
Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
Route::get('/configuracion', [App\Http\Controllers\UserController::class, 'config'])->name('config');
Route::get('/users/{nick?}', [App\Http\Controllers\UserController::class, 'users'])->name('users');
Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'profile'])->name('profile');

//Rutas imagenes
Route::get('/image-Upload', [App\Http\Controllers\ImageController::class, 'create'])->name('image.create');
Route::post('/image/save', [App\Http\Controllers\ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [App\Http\Controllers\ImageController::class, 'getImage'])->name('image.file');
Route::get('/imagen/{id}', [App\Http\Controllers\ImageController::class, 'detail'])->name('image.detail');
Route::get('/image/delete/{id}', [App\Http\Controllers\ImageController::class, 'delete'])->name('image.delete');
Route::get('/image/edit/{id}', [App\Http\Controllers\ImageController::class, 'edit'])->name('image.edit');
Route::post('/image/update', [App\Http\Controllers\ImageController::class, 'update'])->name('image.update');

//Rutas HomePage
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas comentarios
Route::post('/comment/save', [App\Http\Controllers\CommentController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}', [App\Http\Controllers\CommentController::class, 'delete'])->name('comment.delete');

//Rutas likes
Route::get('/like/{image_id}', [App\Http\Controllers\LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/{image_id}', [App\Http\Controllers\LikeController::class, 'dislike'])->name('like.delete');
Route::get('/likes', [App\Http\Controllers\LikeController::class, 'likes'])->name('likes');



