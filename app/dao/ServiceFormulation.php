<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;

class ServiceFormulation
{
    public function getLesFormulations($id_medicament){
        try{
            $lesFormulations = DB::table('formuler')
                ->Select()
                ->join('medicament' , 'medicament.id_medicament','=','formuler.id_medicament')
                ->join('presentation' , 'presentation.id_presentation','=','formuler.id_presentation')
                ->where('medicament.id_medicament','=',$id_medicament)
                ->get();
            return $lesFormulations;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function getLaFormulation($id_medicament,$id_presentation){
        try{
            $lesFormulations = DB::table('formuler')
                ->Select()
                ->join('medicament' , 'medicament.id_medicament','=','formuler.id_medicament')
                ->join('presentation' , 'presentation.id_presentation','=','formuler.id_presentation')
                ->where('medicament.id_medicament','=',$id_medicament)
                ->where('presentation.id_presentation','=',$id_presentation)
                ->get();
            return $lesFormulations;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function suppFormulation($id_medicament,$id_presentation){
        try{
            $lesFormulations = DB::table('formuler')
                ->join('medicament' , 'medicament.id_medicament','=','formuler.id_medicament')
                ->join('presentation' , 'presentation.id_presentation','=','formuler.id_presentation')
                ->where('medicament.id_medicament','=',$id_medicament)
                ->where('presentation.id_presentation','=',$id_presentation)
                ->delete();
            return $lesFormulations;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function ajouterLaFormulation($id_medicament,$id_presentation,$qte_formuler){
        try{
            DB::table('formuler')->insert(
                [
                    'formuler.id_medicament' => $id_medicament,
                    'formuler.id_presentation' => $id_presentation,
                    'formuler.qte_formuler' => $qte_formuler]
            );
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function modifierLaFormulation($id_medicament,$id_presentation,$qte_formuler){
        try{
            DB::table('formuler')
                ->where('id_medicament', "=" ,$id_medicament)
                ->where('id_presentation', '=', $id_presentation)
                ->update([
                    'id_medicament' => $id_medicament,
                    'id_presentation' => $id_presentation,
                    'qte_formuler' => $qte_formuler]
                );
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }


}
