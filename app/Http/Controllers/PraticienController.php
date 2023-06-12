<?php

namespace App\Http\Controllers;

use App\dao\ServiceActivite;
use App\dao\ServicePraticien;
use App\dao\ServiceSpecialite;
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

            $unServiceSpecialite = new ServiceSpecialite();
            $mesSpecialites = $unServiceSpecialite->getListeSpecialites();

            $response = $mesPraticiens;


            //return view('Vues/Admin/listePraticiens', compact('mesPraticiens', 'mesActivites', 'mesSpecialites', 'erreur'));
            return json_encode($response);

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

            $mesPraticiens = $unServicePraticien->getPraticienNomType($type, $nom);
            $vide = false;
            if ($mesPraticiens->count() == 0)
                $vide = true;
-

            $response = $mesPraticiens;
            return json_encode($response);

            //return view('api.listePraticiens', compact('mesPraticiens', 'mesActivites', 'mesSpecialites', 'vide'));
        } catch (MonException $e) {
            //$erreur = $e->getMessage();
            $erreur = "Trop de demandes";
            //$erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

}
