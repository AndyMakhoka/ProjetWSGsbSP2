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
            $lesActivites = DB::table('activite_compl')
                ->select()
                ->get();
            return $lesActivites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }


}
