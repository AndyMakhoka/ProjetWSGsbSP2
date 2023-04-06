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

Route::get('/seConnecter', [VisiteurController::class, 'getLogin']);
Route::post('/login', [VisiteurController::class , 'signIn']);
Route::get('/seDeconnecter', [VisiteurController::class, 'signOut']);

Route::get('/listeVisiteurs', [VisiteurController::class, 'getListeVisiteurs']);
Route::get('/profilVisiteur/{id}', [VisiteurController::class, 'getProfilVisiteur']);
Route::post('/validerVisiteur/{id}', [VisiteurController::class, 'validateVisiteur']);


Route::get('/listePraticiens', [PraticienController::class, 'getListePraticien']);





