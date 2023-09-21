<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\teamController;
use App\Http\Controllers\GoogleController;

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

// geolocation route
Route::get('google-autocomplete', [GoogleController::class, 'index']);
// geolocation route

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/about_us', [teamController::class,'show']);
