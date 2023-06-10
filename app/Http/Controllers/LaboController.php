<?php

namespace App\Http\Controllers;

use MongoDB\Driver\Exception\Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use App\metier\Visiteur;

use App\dao\ServiceLabo;
use App\Exceptions\MonException;

class LaboController
{


    public function getListeLabo()
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceLabo = new ServiceLabo();
            $id_visiteur = Session::get('id');
            $mesLabo = $unServiceLabo->getListeLabo();
            $response = $mesLabo;

            return json_encode($response);
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }
}
