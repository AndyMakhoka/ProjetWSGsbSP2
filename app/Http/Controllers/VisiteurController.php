<?php

namespace App\Http\Controllers;

use MongoDB\Driver\Exception\Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use App\metier\Visiteur;
use App\dao\ServiceFrais;

use App\dao\ServiceVisiteur;
use App\Exceptions\MonException;

class VisiteurController extends Controller
{

    public function getLogin()
    {
        $erreur = "";
        try {
            $erreur = "";
            return view('Vues/formLogin', compact('erreur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));
        } catch (\Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));

        }
    }

    public function signIn(){
        $erreur = "";
        try {
            $login = Request::input('login');
            $pwd = Request::input('pwd');
            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login, $pwd);

            if ($connected) {
                $erreur = "";
                if (Session::get('type') === 'p') {
                    return view('Vues/homePraticien',  compact('erreur'));
                } else {
                    return view('home',   compact('erreur'));
                }
            } else {
                $erreur = "login ou mot de passe inconnu";
                return view('Vues/formLogin', compact('erreur'));
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));
        }
    }

    public function signOut(){
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return view('home');
    }


    public function getListeVisiteurs()
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceVisiteur = new ServiceVisiteur();
            $id_visiteur = Session::get('id');
            $mesVisiteurs = $unServiceVisiteur->getVisiteurs();
            return view('Vues/Admin/ListeVisiteurs', compact('mesVisiteurs', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }


    public function getListeUserByName($type, $nom = '') {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $user = new ServiceVisiteur();
            $id_visiteur = Session::get('id');

            $mesVisiteurs = $user->getUserNomType($type, $nom);
            $vide = false;
            if ($mesVisiteurs->count() == 0)
                $vide = true;
            return view('api.listeVisiteurs', compact('mesVisiteurs', 'vide'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('vues/error', compact('erreur'));
        }
    }





    public function getProfilVisiteur($idVisiteur)
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceVisiteur = new ServiceVisiteur();
            $profilVisiteur = $unServiceVisiteur->getProfilVisiteur($idVisiteur);
            return view('Vues/Admin/formModificationVisiteur', compact('profilVisiteur', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }


}
