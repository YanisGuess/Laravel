<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;
use App\metier\Visiteur;
use App\dao\ServiceVisiteur;
Use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class VisiteurController extends Controller
{
    public function getLogin(){
        try {
            $erreur = "";
            return view('vues/formLogin' , compact('erreur'));
        }catch(MonException $e){
            $erreur = $e->getMessage();
            return view('vues/formLogin' , compact('erreur'));
        }catch(\Exception $e){
            $erreur = $e->getMessage();
            return view('vues/formLogin' , compact('erreur'));
        }
    }

    public function signIn(){
        try{
            $login = Request::input('login');
            $pwd = Request::input('pwd');
            $unVisiteur = new ServiceVisiteur();
            $connected = $unVisiteur->login($login,$pwd);

            if($connected){
                if (Session::get('type') === 'P') {
                    return view('vues/homePracticien');
                }else{
                    return view('home');
                }
            }else{
                $erreur = "Login ou mot de passe inconnu";
                return view('vues/formLogin',compact('erreur'));
            }
        }catch (MonException $e){
            $erreur = $e->getMessage();
            return view('vues/formLogin',compact('erreur'));
        }

    }

    public function signOut()
    {
        $unVisiteur = new ServiceVisiteur();
        $unVisiteur->logout();
        return view('home');
    }

    public function ListerLaboratoire()
    {
        if (Session::get('id') > 0) {
            $unServiceVisiteur = new ServiceVisiteur();
            $mesLabs = $unServiceVisiteur->getLab();
            return view('vues/formLaboAjax', compact('mesLabs'));
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('vues/formLogin', compact('erreur'));
        }
    }

    public function postAfficherVisi()
    {
        try {
            $unServiceVisi = new ServiceVisiteur();
            $id = Request::input('cbLabs');
            $DateDeb = Request::input('dateDeb');
            $DateFin = Request::input('dateFin');
            $montant = Request::input('montant');
            $mesVisi = $unServiceVisi->getListerVisiLabo($id, $DateDeb, $DateFin, $montant);
            return view('vues/ListeVisiteur', compact('mesVisi'));
        } catch (MonException $e) {
            $monErreur = $e->getMessage();
            return view('vues/pageErreur', compact('monErreur'));
        } catch (\Exception $e) {
            $monErreur = $e->getMessage();
            return view('vues/pageErreur', compact('monErreur'));
        }
    }


    public function listerVisiLaboAjax($id,$DateDeb,$DateFin,$montant)
    {
        if (Session::get('id') > 0) {
            try {
                $unServiceVisi = new ServiceVisiteur();
                $rep = $unServiceVisi->getListeVisiLaboAjax($id, $DateDeb, $DateFin, $montant);
                return $rep;
            } catch (MonException $e) {
                $monErreur = $e->getMessage();
                return view('vues/pageErreur', compact('monErreur'));
            } catch (\Exception $e) {
                $monErreur = $e->getMessage();
                return view('vues/pageErreur', compact('monErreur'));
            }
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('vues/formLogin', compact('erreur'));
        }

    }
    public function listerVisiteur (){
        if (Session::get('id') > 0) {
            try {
                $unServiceVisi = new ServiceVisiteur();
                $mesVisi = $unServiceVisi->getListerVisi();
                return view('vues.ListeVisiteur', compact('mesVisi'));
            } catch (MonException $e) {
                $monErreur = $e->getMessage();
                return view('vues.pageErreur', compact('monErreur'));
            } catch (\Exception $e) {
                $monErreur = $e->getMessage();
                return view('vues.pageErreur', compact('monErreur'));
            }
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('vues/formLogin', compact('erreur'));
        }
    }

    public function updatePassword($pwd)
    {
        $newpwd = Hash::make($pwd);
        try {
            $unLogin = new ServiceVisiteur();
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
