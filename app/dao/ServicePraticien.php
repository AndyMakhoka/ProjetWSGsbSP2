<?php

namespace App\dao;


use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ServicePraticien
{
    public function getPraticiens()
    {
        try {
            $lesPraticiens = DB::table('praticien')
                ->select()
                ->join('type_praticien', 'praticien.id_praticien', '=', 'type_praticien.id_type_praticien')
                ->orderBy('praticien.id_praticien')
                ->get();
            return $lesPraticiens;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

    public function getPraticienNomType($type, $nom) {
        try {
            $listePraticiens = DB::table('praticien')

                ->select()
                ->join('type_praticien', 'praticien.id_praticien', '=', 'type_praticien.id_type_praticien')
                ->where($type, 'like', $nom.'%')
                ->orderBy('praticien.id_praticien')
                ->get();
            return $listePraticiens;
        }
        catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }


}
