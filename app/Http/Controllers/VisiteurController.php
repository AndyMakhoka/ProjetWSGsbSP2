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



    public function getLogin()
    {
        $erreur = "";
        try {
            $erreur = "";



            return view('Vues/formLogin', compact('erreur'));
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));
        } catch (\Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));

        }
    }

    public function signIn(){
        $erreur = "";
        try {
            $login = Request::input('login');
            $pwd = Request::input('pwd');
            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login, $pwd);

            if ($connected) {
                $erreur = "";
                $unServiceVisiteur = new ServiceVisiteur();
                $profil = $unServiceVisiteur->getProfil(Session::get('id'));
                $nomPrenom = "$profil->prenom_visiteur"." $profil->nom_visiteur";
                Session::put('nomCompte', $nomPrenom);
                if (Session::get('type') === 'p') {
                    return view('Vues/homePraticien',  compact('profil', 'erreur'));
                } else {
                    return view('home',   compact('profil', 'erreur'));
                }
            } else {
                $erreur = "login ou mot de passe inconnu";
                return view('Vues/formLogin', compact('erreur'));
            }
        } catch (MonException $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));

        } catch (Exception $e) {
            $erreur = $e->getMessage();
            return view('Vues/formLogin', compact('erreur'));
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



            return view('Vues/Admin/ListeVisiteurs', compact('mesVisiteurs','erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }


    public function getListeUserByName($type, $nom = '') {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            Session::forget('monErreur');
            $user = new ServiceVisiteur();
            $id_visiteur = Session::get('id');

            $mesVisiteurs = $user->getUserNomType($type, $nom);
            $vide = false;
            if ($mesVisiteurs->count() == 0)
                $vide = true;
            return view('api.listeVisiteurs', compact('mesVisiteurs', 'vide'));
        } catch (MonException $e) {
            //$erreur = $e->getMessage();
            $erreur = "Trop de demandes";
            return view('vues/error', compact('erreur'));
        }
    }



    public function getProfil()
    {
        try {
            $erreur = "";
            $monErreur = Session::get('monErreur');
            $id_visiteur = Session::get('id');
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

            return view('Vues/Admin/formModificationProfil', compact('profilVisiteur', 'mesLabo', 'mesSecteurs', 'disabled', 'selected', 'id_visiteur', 'mesActivitesVisiteur', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
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

            return view('Vues/Admin/formModificationVisiteur', compact('profilVisiteur', 'mesLabo', 'mesSecteurs', 'disabled', 'selected', 'id_visiteur', 'mesActivitesVisiteur', 'erreur'));
        } catch (MonException$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        } catch (Exception$e) {
            $erreur = $e->getMessage();
            return view('Vues/error', compact('erreur'));
        }
    }



    public function validateVisiteur($id_visiteur)
    {
        try {
            $erreur = "";

            //$id_visiteur = Request::input('id_visiteur');
            $prenom_visiteur = Request::input('prenom_visiteur');
            $nom_visiteur = Request::input('nom_visiteur');
            $adresse_visiteur = Request::input('adresse_visiteur');
            $cp_visiteur = Request::input('cp_visiteur');
            $id_secteur = Request::input('id_secteur');
            $id_laboratoire = Request::input('id_laboratoire');


            $unServiceVisiteur = new ServiceVisiteur();
            if ($id_visiteur > 0) {
                $unServiceVisiteur->updateVisiteur($id_visiteur, $prenom_visiteur, $adresse_visiteur, $cp_visiteur, $id_secteur, $id_laboratoire);
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
