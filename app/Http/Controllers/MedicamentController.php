<?php

namespace App\Http\Controllers;

use App\dao\ServiceFormulation;
use App\dao\ServiceMedicament;
use Illuminate\Support\Facades\Input;
use Request;
Use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;
use Exception;

class MedicamentController
{
    public function getMedicament(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceMedicament = new ServiceMedicament();
                $unServiceFormulation  = new ServiceFormulation();
                $mesMedicaments = $unServiceMedicament->getlesMedicaments();
                //$mesFormulations = $unServiceFormulation->countMedicamentParFormulation(1,7);
                return view('vues.listeMedicament', compact('mesMedicaments', 'erreur'));
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
