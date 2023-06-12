<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 29/01/2019
 * Time: 14:23
 */

namespace App\dao;

use App\Exceptions\MonException;
use App\metier\Visiteur;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;


class ServiceLogin
{
    /**
     * Vérifie le login et mdp visiteur
     * @param type $json
     * @return \Visitor
     * @throws Exception
     */




    public function miseAjourMotPasse($pwd) {
        try {
            DB::table('visiteur')
                ->update(['pwd_visiteur' => $pwd]);
        } catch (QueryException $e) {
            throw new MonException($e->getMessage());
        }
    }
}
