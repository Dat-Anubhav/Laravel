<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

// // how to open page without GET method but for controller u have to use GET
// Route::view('/path','home');

Route::get('/about/{name}',function($name){
    // echo $name;
    return view('about',['name'=>$name]);// passing data with routing
});

// //redirect with routing

// redirect root page to the homepage means when u click on app-url in terminal after running npm run dev 
// u will get to /home page not the root page because of redirect

// Route::redirect('/','/home');

// // Calling or routing a controller

Route::get('user',[UserController::class,'getUser']);
Route::get('user2/{name}',[UserController::class,'getUser2']);// pass data

// // Routing a view with controller

Route::get('/view',[UserController::class,'getUserView']);

// // How to call a view which is in nested folder

Route::get('/nestedview',[UserController::class,'getNested']);

//How to know view exists or not?

Route::get('/checkview',[UserController::class,'checkview']);



