<?php

namespace App\Http\Controllers;

use App\dao\ServiceActivite;
use App\dao\ServiceSecteur;
use App\dao\ServiceSpecialite;
use MongoDB\Driver\Exception\Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use App\metier\Visiteur;

use App\dao\ServiceVisiteur;
use App\dao\ServiceLabo;
use App\Exceptions\MonException;

class VisiteurController extends Controller
{





    public function signIn()
    {
        $erreur = "";
        try {
            $json = file_get_contents('php://input'); // Récupération du flux JSON
            $visiteurJson = json_decode($json);
            if ($visiteurJson != null) {
                $login_visiteur = $visiteurJson->login_visiteur;
                $pwd_visiteur = $visiteurJson->pwd_visiteur;
                $unService = new ServiceVisiteur();
                $visiteur = $unService->login($login_visiteur, $pwd_visiteur);
                return json_encode($visiteur);
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return response()->json($erreur);
        }
    }

    public function signOut(){
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return view('home');
    }


    public function getListeVisiteurs()
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceVisiteur = new ServiceVisiteur();
            $id_visiteur = Session::get('id');
            $mesVisiteurs = $unServiceVisiteur->getVisiteurs();
            $response = $mesVisiteurs;



            //return view('Vues/Admin/ListeVisiteurs', compact('mesVisiteurs','erreur'));
            return json_encode($response);
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }


    public function getListeUserByName($type, $nom = '') {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');

            $user = new ServiceVisiteur();

            $mesVisiteurs = $user->getUserNomType($type, $nom);
            $vide = false;
            if ($mesVisiteurs->count() == 0)
                $vide = true;

            $response = $mesVisiteurs;
            return json_encode($response);
            //return view('api.listeVisiteurs', compact('mesVisiteurs', 'vide'));
        } catch (MonException $e) {
            //$erreur = $e->getMessage();
            $erreur = "Trop de demandes";
            //$erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }



    public function getProfil($id_visiteur)
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');


            Session::forget('monErreur');
            $unServiceVisiteur = new ServiceVisiteur();
            $profilVisiteur = $unServiceVisiteur->getProfil($id_visiteur);

            $unServiceLabo = new ServiceLabo();
            $mesLabo = $unServiceLabo->getListeLabo();

            $unServiceSecteur = new ServiceSecteur();
            $mesSecteurs = $unServiceSecteur->getListeSecteur();

            $unServicActivite = new ServiceActivite();
            $mesActivitesVisiteur = $unServicActivite->getListeActivitesByVisiteur($id_visiteur);

            $disabled = "";
            $selected = "";

            //return view('Vues/Admin/formModificationProfil', compact('profilVisiteur', 'mesLabo', 'mesSecteurs', 'disabled', 'selected', 'id_visiteur', 'mesActivitesVisiteur', 'erreur'));

            return response()->json($profilVisiteur, $mesLabo, (array)$mesSecteurs, $disabled, $selected, $id_visiteur, $mesActivitesVisiteur, $erreur);

        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }




    public function getProfilVisiteur($id_visiteur)
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $unServiceVisiteur = new ServiceVisiteur();
            $profilVisiteur = $unServiceVisiteur->getProfilVisiteur($id_visiteur);

            $unServiceLabo = new ServiceLabo();
            $mesLabo = $unServiceLabo->getListeLabo();

            $unServiceSecteur = new ServiceSecteur();
            $mesSecteurs = $unServiceSecteur->getListeSecteur();

            $unServicActivite = new ServiceActivite();
            $mesActivitesVisiteur = $unServicActivite->getListeActivitesByVisiteur($id_visiteur);
            //$mesActivitesVisiteurs = "";
            $disabled = "";
            $selected = "";

            $response = $profilVisiteur;


            //return view('Vues/Admin/formModificationVisiteur', compact('profilVisiteur', 'mesLabo', 'mesSecteurs', 'disabled', 'selected', 'id_visiteur', 'mesActivitesVisiteur', 'erreur'));
            return json_encode($response);

        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    public function getListeActivitesVisiteur($id_visiteur)
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');

            $unServicActivite = new ServiceActivite();
            $mesActivitesVisiteur = $unServicActivite->getListeActivitesByVisiteur($id_visiteur);
            //$mesActivitesVisiteurs = "";
            $disabled = "";
            $selected = "";

            $response = $mesActivitesVisiteur;

            //return view('Vues/Admin/formModificationVisiteur', compact('profilVisiteur', 'mesLabo', 'mesSecteurs', 'disabled', 'selected', 'id_visiteur', 'mesActivitesVisiteur', 'erreur'));
            return json_encode($response);

        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    public function getUneActiviteVisiteur($id_activite_compl)
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');

            $unServicActivite = new ServiceActivite();
            $uneActiviteVisiteur = $unServicActivite->getUneActiviteVisiteur($id_activite_compl);
            //$mesActivitesVisiteurs = "";
            $disabled = "";
            $selected = "";

            $response = $uneActiviteVisiteur;

            //return view('Vues/Admin/formModificationVisiteur', compact('profilVisiteur', 'mesLabo', 'mesSecteurs', 'disabled', 'selected', 'id_visiteur', 'mesActivitesVisiteur', 'erreur'));
            return json_encode($response);

        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }
    public function getListeSecteurs($id_visiteur)
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');

            $unServiceSecteur = new ServiceSecteur();
            $mesSecteurs = $unServiceSecteur->getListeSecteur();
            //$mesActivitesVisiteurs = "";
            $disabled = "";
            $selected = "";

            $response = $mesSecteurs;

            //return view('Vues/Admin/formModificationVisiteur', compact('profilVisiteur', 'mesLabo', 'mesSecteurs', 'disabled', 'selected', 'id_visiteur', 'mesActivitesVisiteur', 'erreur'));
            return json_encode($response);

        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }

    public function getListeLabo($id_visiteur)
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');

            $unServiceLabo = new ServiceLabo();
            $mesLabo = $unServiceLabo->getListeLabo();
            //$mesActivitesVisiteurs = "";
            $disabled = "";
            $selected = "";

            $response = $mesLabo;

            //return view('Vues/Admin/formModificationVisiteur', compact('profilVisiteur', 'mesLabo', 'mesSecteurs', 'disabled', 'selected', 'id_visiteur', 'mesActivitesVisiteur', 'erreur'));
            return json_encode($response);

        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return response()->json($erreur, 204);
        }
    }




    public function validateVisiteur($id_visiteur)
    {
        try {
            $erreur = "";

            //$id_visiteur = Request::input('id_visiteur');

            $json = file_get_contents('php://input'); // Récupération du flux JSON
            $visiteurJson = json_decode($json);
            if ($visiteurJson != null) {

                $prenom_visiteur = $visiteurJson->prenom_visiteur;
                $nom_visiteur = $visiteurJson->nom_visiteur;
                $adresse_visiteur = $visiteurJson->adresse_visiteur;
                $cp_visiteur = $visiteurJson->cp_visiteur;
                $id_secteur = $visiteurJson->id_secteur;
                $id_laboratoire = $visiteurJson->id_laboratoire;


            }


            $unServiceVisiteur = new ServiceVisiteur();
            if ($id_visiteur > 0) {
                $uneReponse = $unServiceVisiteur->updateVisiteur($id_visiteur, $nom_visiteur, $prenom_visiteur, $adresse_visiteur, $cp_visiteur, $id_secteur, $id_laboratoire);
                return response()->json($uneReponse);
            }

            //return redirect('/profilVisiteur/$id_visiteur');
            return back();
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }


    }



    public function realiserActivite($id_visiteur)
    {
        try {
            $erreur = "";

            //$id_visiteur = Request::input('id_visiteur');
            $motif_activite = Request::input('motif');
            $date_activite = Request::input('date');
            $lieu_activite = Request::input('lieu');
            $theme_activite = Request::input('theme');
            $montant_ac = Request::input('montant_ac');

            $unServiceActivite = new ServiceActivite();
            if ($id_visiteur > 0) {
                $unServiceActivite->addActivite($id_visiteur, $date_activite, $lieu_activite, $theme_activite, $motif_activite, $montant_ac);
            }

            //return redirect('/profilVisiteur/$id_visiteur');
            return redirect('/profilVisiteur/' . $id_visiteur);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }

    }

        public function modifierActivite($id_Visiteur, $id_Activite)
        {
        try {
            $erreur = "";

            //$id_visiteur = Request::input('id_visiteur');
            $motif_activite = Request::input('motif');
            $date_activite = Request::input('date');
            $lieu_activite = Request::input('lieu');
            $theme_activite = Request::input('theme');
            $montant_ac = Request::input('montant_ac');

            $unServiceActivite = new ServiceActivite();
            if ($id_Activite > 0) {
                $unServiceActivite->updateActivite($id_Activite, $date_activite, $lieu_activite, $theme_activite, $motif_activite, $montant_ac);
            }

            //return redirect('/profilVisiteur/$id_visiteur');
            return redirect('/profilVisiteur/'.$id_Visiteur);
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }


    }

    public function inviterPraticien($id_praticien)
    {
        try {
            $erreur = "";




            $id_activite_compl = request::input('id_activite_compl');
            $id_specialite = request::input('lib_specialite');

            $unServiceVisiteur = new ServiceVisiteur();
            if ($id_praticien > 0) {
                $unServiceVisiteur->inviterPraticien($id_praticien, $id_activite_compl, $id_specialite);
            }

            //return redirect('/profilVisiteur/$id_visiteur');
            return back();
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }


    }



}
