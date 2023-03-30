<?php

namespace App\dao;

use App\Exceptions\MonException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ServiceSecteur
{

    public function getListeSecteur()
    {
        try {
            $lesLabo = DB::table('secteur')
                ->select()
                ->get();
            return $lesLabo;
        } catch (QueryException $e) {
            throw new MonException($e->getMessage(), 5);
        }
    }

}
