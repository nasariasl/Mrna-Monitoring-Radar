<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('landing');
});

Route::get("/radar", function() { 
//    return Redirect::to("3-radar-v2.php");
    include(public_path() . '/front_body_radar.php');
   // return \File::get(public_path() . '/3-radar-v2.php');
});