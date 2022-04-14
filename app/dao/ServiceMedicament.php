<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;

class ServiceMedicament
{
    public function getlesMedicaments(){
        try{
            $lesMedicaments = DB::table('medicament')
                ->Select()
                ->join('famille' , 'famille.id_famille','=','medicament.id_famille')
                ->get();
            return $lesMedicaments;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function getleMedoc($id_medicament){
        try{
            $lesMedicaments = DB::table('medicament')
                ->Select()
                ->where("id_medicament","=",$id_medicament)
                ->get();
            return $lesMedicaments;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }
}
