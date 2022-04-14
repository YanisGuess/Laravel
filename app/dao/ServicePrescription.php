<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;

class ServicePrescription
{
    public function getListePrescriptions($id_medicament){
        try{
            $lesPrescriptions = DB::table('prescrire')
                ->Select()
                ->join('medicament' , 'medicament.id_medicament','=','prescrire.id_medicament')
                ->join('dosage' , 'dosage.id_dosage','=','prescrire.id_dosage')
                ->join('type_individu' , 'type_individu.id_type_individu','=','prescrire.id_type_individu')
                ->where('medicament.id_medicament','=', $id_medicament)
                ->get();
            return $lesPrescriptions;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }
    public function getLaPrescriptions($id_medicament,$id_dosage,$id_type_individu){
        try{
            $lesPrescriptions = DB::table('prescrire')
                ->Select()
                ->where('id_dosage' , '=',$id_dosage)
                ->where('id_medicament' , '=',$id_medicament)
                ->where('id_type_individu' , '=',$id_type_individu)
                ->get();
            return $lesPrescriptions;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }


    public function ajouterLaPrescription($id_dosage,$id_medicament,$id_type_individu,$posologie){
        try{
            DB::table('prescrire')->insert(
                [
                    'prescrire.id_dosage' => $id_dosage,
                    'prescrire.id_medicament' => $id_medicament,
                    'prescrire.id_type_individu' => $id_type_individu,
                    'prescrire.posologie' => $posologie]
            );
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }
    public function modifierLaPrescription($id_medicament,$id_dosage,$id_type_individu,$posologie,$Oldid_dosage,$Oldid_type_individu){
        try{
            DB::table('prescrire')
                ->where('prescrire.id_medicament', "=" ,$id_medicament)
                ->where('prescrire.id_dosage', "=" ,$Oldid_dosage)
                ->where('prescrire.id_type_individu', "=" ,$Oldid_type_individu)
                ->update([
                    'prescrire.id_dosage' => $id_dosage,
                    'prescrire.id_type_individu' => $id_type_individu,
                    'prescrire.posologie' => $posologie]
                );
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function suppPrescription($id_medicament,$id_dosage,$id_type_individu){
        try{
            $lesPrescriptions = DB::table('prescrire')
                ->where('prescrire.id_medicament','=',$id_medicament)
                ->where('prescrire.id_dosage','=',$id_dosage)
                ->where('prescrire.id_type_individu','=',$id_type_individu)
                ->delete();
            return $lesPrescriptions;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }
    public function GetTestPrescriptions($id_dosage,$id_type_individu)
    {
        try{
            $lesPrescriptions = DB::table('prescrire')
                ->Select()
                ->join('medicament' , 'medicament.id_medicament','=','prescrire.id_medicament')
                ->join('dosage' , 'dosage.id_dosage','=','prescrire.id_dosage')
                ->join('type_individu' , 'type_individu.id_type_individu','=','prescrire.id_type_individu')
                ->where('type_individu.id_type_individu','=', $id_type_individu)
                ->where('dosage.id_dosage','=', $id_dosage)
                ->get();
            return $lesPrescriptions;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }
}
