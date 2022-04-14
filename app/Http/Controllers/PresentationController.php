<?php

namespace App\Http\Controllers;

use App\dao\ServicePresentation;

class PresentationController
{
    public function getPresentation(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServicePrescription = new ServicePresentation();
                $mesPresentation = $unServicePrescription->getLesPresentation();
                return view('vues.listeMedicament', compact('mesPresentation', 'erreur'));
            } catch (MonException $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            } catch (\Exception $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            }
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('vues/formLogin', compact('erreur'));
        }
    }
}
