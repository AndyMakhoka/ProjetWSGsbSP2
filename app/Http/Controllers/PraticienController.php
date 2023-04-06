<?php

namespace App\Http\Controllers;

use App\dao\ServiceActivite;
use App\dao\ServicePraticien;
use App\dao\ServiceVisiteur;
use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;
use MongoDB\Driver\Exception\Exception;

class PraticienController
{

    public function getListePraticien()
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServicePraticien = new ServicePraticien();
            $id_visiteur = Session::get('id');
            $mesPraticiens = $unServicePraticien->getPraticiens();

            $unServiceActivite = new ServiceActivite();
            $mesActivites = $unServiceActivite->getListeActivites();


            return view('Vues/Admin/listePraticiens', compact('mesPraticiens', 'mesActivites', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }

    public function getListePraticienByName($type, $nom = '') {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServicePraticien = new ServicePraticien();
            //$id_visiteur = Session::get('id');

            $mesPraticiens = $unServicePraticien->getPraticienNomType($type, $nom);
            $vide = false;
            if ($mesPraticiens->count() == 0)
                $vide = true;

            $unServiceActivite = new ServiceActivite();
            $mesActivites = $unServiceActivite->getListeActivites();


            return view('api.listePraticiens', compact('mesPraticiens', 'mesActivites', 'vide'));
        } catch (MonException $e) {
            //$erreur = $e->getMessage();
            if (!$vide){
                $erreur = "Trop de demandes";
            }
            return view('vues/error', compact('erreur'));
        }
    }

}
