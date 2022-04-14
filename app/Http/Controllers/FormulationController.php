<?php

namespace App\Http\Controllers;

use App\dao\ServiceFormulation;
use App\dao\ServiceMedicament;
use App\dao\ServicePresentation;
use Illuminate\Support\Facades\Input;
use Request;
Use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;
use Exception;


class FormulationController
{
    public function getFormulations($id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceFormulation = new ServiceFormulation();
                $unServicemedicament = new ServiceMedicament();
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $leMedicament = $unServicemedicament->getleMedoc($id_medicament);
                return view('vues.listeFormulations', compact('leMedicament','mesFormulations','erreur'));
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

    public function supprimerFormulation($id_medicament,$id_presentation){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceFormulation = new ServiceFormulation();
                $unServiceMedicament = new ServiceMedicament();
                $suppFormulation = $unServiceFormulation->suppFormulation($id_medicament,$id_presentation);
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listeFormulations', compact('leMedicament','mesFormulations','erreur'));
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

    public function ajoutFormulation($id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceFormulation = new ServiceFormulation();
                $unServicePresentation = new ServicePresentation();
                $unServiceMedicament = new ServiceMedicament();
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $mesPresentation = $unServicePresentation->getLesPresentation();
                $leMedicament = $unServiceMedicament->getLeMedoc($id_medicament);
                return view('vues.FormFormulation', compact('leMedicament','mesPresentation','mesFormulations','erreur'));
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

    public function ajouterLaFormulation(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_medicament = Request::input('id_medicament');
                $id_presentation = Request::input('id_presentation');
                $Oldid_presentation = Request::input('Oldid_presentation');
                $qte_formuler = Request::input('qte_formuler');
                $unServiceFormulation = new ServiceFormulation();
                $unServiceMedicament = new ServiceMedicament();
                $Impossible = null;
                if ($id_presentation != $Oldid_presentation){
                    $ajoutFormulation = $unServiceFormulation->ajouterLaFormulation($id_medicament,$id_presentation,$qte_formuler);
                }else {
                    $Impossible = "Ajout impossible , car la présentation est déja utilisée";
                }
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listeFormulations', compact('leMedicament','mesFormulations','Impossible','erreur'));
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

    public function modifFormulation($id_medicament,$id_presentation){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceFormulation = new ServiceFormulation();
                $unServicePresentation = new ServicePresentation();
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $laFormulation = $unServiceFormulation->getLaFormulation($id_medicament,$id_presentation);
                $mesPresentation = $unServicePresentation->getLesPresentation();
                $laPresentation = $unServicePresentation->getLaPresentation($id_presentation);
                return view('vues.FormFormulation', compact('mesPresentation','mesFormulations','laPresentation','laFormulation','erreur'));
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

    public function modifierLaFormulation(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_medicament = Request::input('id_medicament');
                $id_presentation = Request::input('id_presentation');
                $Oldid_presentation = Request::input('Oldid_presentation');
                $qte_formuler = Request::input('qte_formuler');
                $unServiceFormulation = new ServiceFormulation();
                $unServiceMedicament = new ServiceMedicament();
                $Impossible = null;
                if (empty($VerifFormulation) or ($Oldid_presentation == $id_medicament)){
                    $ModifierFormulation = $unServiceFormulation->modifierLaFormulation($id_medicament,$id_presentation,$qte_formuler);
                }else {
                    $Impossible = "Modification impossible , car la présentation est déja utilisée";
                }
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listeFormulations', compact('leMedicament','mesFormulations','Impossible','VerifFormulation','erreur'));
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
