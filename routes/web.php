<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/test', function () { // call back function
//    $localName = 'Ziad';   // the var ( $localName ) will be assigned to the var ( $name ) in this case ( in the test view )
//    $LocalBooks = ['HTML' , 'CSS' , 'JS']; // the same here also!
//    return view('test' , ['name' => $localName , 'books' => $LocalBooks]); // view -> is a global helper method
//});

Route::get('/test', [PostController::class, 'firstAction']); // example on how to use the controller
// :: -> scope resolution

// 1- define a new route
// 2- define controller to render the view
// 3- define view
// 4- remove static html data

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/create' , [PostController::class, 'create'])->name('posts.create');

Route::post('/' , [PostController::class, 'store'])->name('posts.store');

Route::get('/posts/{post}/edit' , [PostController::class , 'edit'])->name('posts.edit');

Route::put('/posts/{post}' , [PostController::class , 'update'])->name('posts.update');

Route::delete('/posts/{post}' , [PostController::class , 'destroy'])->name('posts.destroy');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


// structure change : ( create columns - drop - add )
// operations on database : ( insert record - delete - update )












