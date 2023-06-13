<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\PraticienController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/searchUser/{type}/{nom}', [VisiteurController::class, 'getListeUserByName']);
Route::get('/searchUser/{type}', [VisiteurController::class, 'getListeUserByName']);

Route::get('/searchPraticien/{type}/{nom}', [PraticienController::class, 'getListePraticienByName']);
Route::get('/searchPraticien/{type}', [PraticienController::class, 'getListePraticienByName']);



Route::get('/', function () {
    return view('home');
});

Route::post('/getConnexion', [VisiteurController::class , 'signIn']);
Route::get('/seDeconnecter', [VisiteurController::class, 'signOut']);
Route::get('/profil', [VisiteurController::class, 'getProfil']);

Route::get('/listeVisiteurs', [VisiteurController::class, 'getListeVisiteurs']);
Route::get('/profilVisiteur/{id}', [VisiteurController::class, 'getProfilVisiteur']);

Route::get('/listeSecteurs/{id}', [VisiteurController::class, 'getListeSecteurs']);
Route::get('/listeActivitesVisiteur/{id}', [VisiteurController::class, 'getListeActivitesVisiteur']);
Route::get('/AfficherActiviteVisiteur/{id}', [VisiteurController::class, 'getUneActiviteVisiteur']);

Route::get('/listelabo/{id}', [VisiteurController::class, 'getListeLabo']);

Route::post('/validerVisiteur/{id}', [VisiteurController::class, 'validateVisiteur']);

Route::post('/realiserActivite/{id}', [VisiteurController::class, 'realiserActivite']);
Route::post('/modifierActivite/{id_AC}', [VisiteurController::class, 'modifierActivite']);

Route::post('/inviterPraticien/{id_praticien}', [VisiteurController::class, 'inviterPraticien']);


Route::get('/listePraticiens', [PraticienController::class, 'getListePraticien']);








