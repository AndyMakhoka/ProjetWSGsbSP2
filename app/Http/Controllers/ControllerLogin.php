<?php


namespace App\Http\Controllers;

use App\dao\ServiceLogin;
use Illuminate\Support\Facades\Hash;

class ControllerLogin extends Controller
{



    public function updatePassword($pwd_visiteur)
    {
        $newpwd = Hash::make($pwd_visiteur);
        try {
            $unLogin = new ServiceLogin();
            $unLogin->miseAjourMotPasse($newpwd);
            return view('home');
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Error', compact('erreur'));
        }
    }
}
