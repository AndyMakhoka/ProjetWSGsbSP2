<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ServiceSpecialite
{

    public function getListeSpecialites()
    {
        try {
            $lesSpecialites = DB::table('specialite')
                ->select()
                ->get();
            return $lesSpecialites;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

}
