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
Route::get('/profil', [VisiteurController::class, 'getProfil']);

Route::get('/listeVisiteurs', [VisiteurController::class, 'getListeVisiteurs']);
Route::get('/profilVisiteur/{id}', [VisiteurController::class, 'getProfilVisiteur']);
Route::post('/validerVisiteur/{id}', [VisiteurController::class, 'validateVisiteur']);

Route::post('/realiserActivite/{id}', [VisiteurController::class, 'realiserActivite']);
Route::post('/modifierActivite/{id_V}{id_AC}', [VisiteurController::class, 'modifierActivite']);

Route::post('/inviterPraticien/{id_praticien}', [VisiteurController::class, 'inviterPraticien']);


Route::get('/listePraticiens', [PraticienController::class, 'getListePraticien']);





