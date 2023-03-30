<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ServiceVisiteur
{
    public function login($login, $pwd){
        $connected = false;
        try {
            $visiteur = DB::table('visiteur')
                ->select()
                ->where('login_visiteur', '=', $login)
                ->first();
            if ($visiteur)
                if ($visiteur->pwd_visiteur == $pwd) {
                    Session::put('id', $visiteur->id_visiteur);
                    Session::put('type', $visiteur->type_visiteur);
                    $connected = true;
                }
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
        return $connected;
    }

    public function logout(){
        Session::put('id', 0);
        return view('home');

    }

    public function getVisiteurs()
    {
        try {
            $lesVisiteurs = DB::table('visiteur')
                ->select()
                ->join('laboratoire', 'visiteur.id_laboratoire', '=', 'laboratoire.id_laboratoire')
                ->join('secteur', 'visiteur.id_secteur', '=', 'secteur.id_secteur')
                ->orderBy('visiteur.id_visiteur')
                ->get();
            return $lesVisiteurs;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getUserNomType($type, $nom) {
        try {
            $liste = DB::table('visiteur')
                ->where($type, 'like', $nom.'%')
                ->select()
                ->join('laboratoire', 'visiteur.id_laboratoire', '=', 'laboratoire.id_laboratoire')
                ->join('secteur', 'visiteur.id_secteur', '=', 'secteur.id_secteur')
                ->orderBy('visiteur.nom_visiteur')
                ->orderBy('visiteur.prenom_visiteur')

                ->get();
            return $liste;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }

    public function getProfilVisiteur($idvisiteur)
    {
        try {
            $lesVisiteurs = DB::table('visiteur')
                ->select()
                ->join('laboratoire', 'visiteur.id_laboratoire', '=', 'laboratoire.id_laboratoire')
                ->join('secteur', 'visiteur.id_secteur', '=', 'secteur.id_secteur')
                ->where('visiteur.id_visiteur', '=', $idvisiteur)
                ->first();
            return $lesVisiteurs;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

}
