<?php

namespace App\Http\Controllers;

use App\dao\ServiceDosage;
use App\dao\ServiceFormulation;
use App\dao\ServiceIndividu;
use App\dao\ServiceMedicament;
use App\dao\ServicePresentation;
use App\dao\ServicePrescription;
use Illuminate\Support\Facades\Input;
use Request;
Use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;
use Exception;

class PrescriptionController
{
    public function getPrescription($id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServicePrescription = new ServicePrescription();
                $unServiceMedicament = new ServiceMedicament();
                $mesPrescriptions = $unServicePrescription->getListePrescriptions($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listePrescription', compact('mesPrescriptions','leMedicament','erreur'));
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

    public function ajoutPrescription($id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceMedicament = new ServiceMedicament();
                $unServicePrescription = new ServicePrescription();
                $unServiceIndividu = new ServiceIndividu();
                $unServiceDosage= new ServiceDosage();
                $mesPrescriptions = $unServicePrescription->getListePrescriptions($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $mesDosages = $unServiceDosage->getLesDosages();
                $mesIndividus = $unServiceIndividu->getLesIndividus();
                return view('vues.formPrescription', compact('mesIndividus','mesDosages','leMedicament','mesPrescriptions','erreur'));
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

    public function ajouterLaPrescription(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_dosage = Request::input('id_dosage');
                $id_medicament = Request::input('id_medicament');
                $id_type_individu = Request::input('id_type_individu');
                $posologie = Request::input('posologie');
                $unServiceMedicament = new ServiceMedicament();
                $unServicePrescription = new ServicePrescription();
                $verifPrescriptions = $unServicePrescription->GetTestPrescriptionsPrescription($id_dosage,$id_type_individu);

                $Impossible = null;
                if (empty($verifPrescriptions)){
                    $ajouterlaPrescription = $unServicePrescription->ajouterLaPrescription($id_dosage,$id_medicament,$id_type_individu,$posologie);
                }else {
                    $Impossible = "Ajout impossible , car le dosage ainsi que l'individu sont déja utilisés";
                }

                $mesPrescriptions = $unServicePrescription->getListePrescriptions($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listePrescription', compact('leMedicament', 'mesPrescriptions', 'Impossible', 'erreur'));

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

    public function supprimerPrescription($id_medicament,$id_dosage,$id_type_individu){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServicePrescription = new ServicePrescription();
                $unServiceMedicament = new ServiceMedicament();
                $suppPrescription = $unServicePrescription->suppPrescription($id_medicament,$id_dosage,$id_type_individu);
                $mesPrescriptions = $unServicePrescription->getListePrescriptions($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listePrescription', compact('leMedicament','mesPrescriptions','erreur'));
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

    public function modifPrescription($id_medicament,$id_dosage,$id_type_individu){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceFormulation = new ServiceFormulation();
                $unServicePrescription = new ServicePrescription();
                $unServiceIndividu = new ServiceIndividu();
                $unServiceDosage= new ServiceDosage();
                $unServiceMedicament = new ServiceMedicament();
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $mesDosages = $unServiceDosage->getLesDosages();
                $mesIndividus = $unServiceIndividu->getLesIndividus();
                $mesPrescriptions = $unServicePrescription->getListePrescriptions($id_medicament);
                $laPrescription = $unServicePrescription->getLaPrescriptions($id_medicament,$id_dosage,$id_type_individu);
                return view('vues.FormPrescription', compact('mesPrescriptions','laPrescription','leMedicament','mesDosages','mesIndividus','erreur'));
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
    public function modifierLaPrescription(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');

                $id_medicament = Request::input('id_medicament');
                $id_dosage = Request::input('id_dosage');
                $id_type_individu = Request::input('id_individu');
                $posologie = Request::input('posologie');

                $Oldid_dosage = Request::input('Oldid_dosage');
                $Oldid_type_individu = Request::input('Oldid_individu');
                $Oldposologie = Request::input('Oldposologie');

                $unServicePrescription = new ServicePrescription();
                $unServiceMedicament = new ServiceMedicament();
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $verifPrescriptions = $unServicePrescription->GetTestPrescriptions($id_dosage,$id_type_individu);

                $Impossible = null;
                if (empty($verifPrescriptions)){
                    $modifPrescriptions = $unServicePrescription->modifierLaPrescription($id_medicament, $id_dosage, $id_type_individu, $posologie, $Oldid_dosage, $Oldid_type_individu);
                }else {
                    if($posologie != $Oldposologie) {
                        $modifPrescriptions = $unServicePrescription->modifierLaPrescription($id_medicament, $id_dosage, $id_type_individu, $posologie, $Oldid_dosage, $Oldid_type_individu);
                    }else
                    {
                        $Impossible = "Modification impossible , L'individu et le dosage sont déja utilisés";
                    }

                }
                $mesPrescriptions = $unServicePrescription->getListePrescriptions($id_medicament);

                return view('vues.listePrescription', compact('leMedicament','mesPrescriptions','Impossible','erreur'));
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
