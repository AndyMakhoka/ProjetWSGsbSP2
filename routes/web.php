<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\PraticienController;
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
    return view('home');
});


Route::get('/miseajour/{pwd}', [App\Http\Controllers\ControllerLogin::class, 'updatePassword']);



