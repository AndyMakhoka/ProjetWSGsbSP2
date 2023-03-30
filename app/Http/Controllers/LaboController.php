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
            return view('Vues/Admin/formModificationVisiteur', compact('mesLabo', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }
}
