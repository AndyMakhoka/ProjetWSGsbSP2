<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceActivite
{

    public function getListeActivites()
    {
        try {
            $lesActivites = DB::table('realiser')
                ->select()
                ->join('activite_compl', 'realiser.id_activite_compl', '=', 'activite_compl.id_activite_compl')
                ->get();
            return $lesActivites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getListeActivitesByVisiteur($id_visiteur)
    {
        try {
            $lesActivites = DB::table('realiser')
                ->select()
                ->join('activite_compl', 'realiser.id_activite_compl', '=', 'activite_compl.id_activite_compl')
                ->where('realiser.id_visiteur', '=', $id_visiteur)
                ->get();
            return $lesActivites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }


    public function updateActivite($id_visiteur, $id_activite_compl, $date_activite, $lieu_activite, $theme_activite, $motif_activite, $montant_ac)
    {
        try {
            $dateJour = date("Y-m-d");
            $last = DB::table('activite_compl')
                ->where('id_activite_compl', '=', $id_activite_compl)
                ->update([

                    'date_activite' => $date_activite,
                    'lieu_activite' => $lieu_activite,
                    'theme_activite' => $theme_activite,
                    'motif_activite' => $motif_activite


                ]);

            DB::table('realiser')
                ->where('id_visiteur', '=', $id_visiteur)
                ->where('id_activite_compl', '=', $last)
                ->update([


                    'montant_ac' => $montant_ac


                ]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);

        }
    }

    public function addActivite($id_visiteur, $date_activite, $lieu_activite, $theme_activite, $motif_activite, $montant_ac)
    {
        try {
            $dateJour = date("Y-m-d");
            $last = DB::table('activite_compl')
                ->where('id_visiteur', '=', $id_visiteur)
                ->insert([

                    'date_activite' => $date_activite,
                    'lieu_activite' => $lieu_activite,
                    'theme_activite' => $theme_activite,
                    'motif_activite' => $motif_activite

                ]);

            DB::table('realiser')

                ->insert([

                    'id_visiteur' => $id_visiteur,
                    'id_activite_compl' => $last,
                    'montant_ac' => $montant_ac

                ]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);

        }
    }







}
