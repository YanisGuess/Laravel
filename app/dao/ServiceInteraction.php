<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;

class ServiceInteraction
{
    public function getLesInteractions($id_medicament){
        try{
            $lesInteractions = DB::table('interagir')
                ->Select()
                ->join('medicament' , 'medicament.id_medicament','=','interagir.med_id_medicament')
                ->where('interagir.id_medicament','=',$id_medicament)
                ->get();
            return $lesInteractions;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function ajouterLainteraction($id_medicament,$id_med_medicament){
        try{
            DB::table('interagir')->insert(
                [
                    'interagir.id_medicament' => $id_medicament,
                    'interagir.med_id_medicament' => $id_med_medicament]
            );
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }
    public function supprInteraction($id_medicament,$id_med_medicament){
        try{
            $lesInteractions = DB::table('interagir')
                ->where('interagir.id_medicament','=',$id_medicament)
                ->where('interagir.med_id_medicament','=',$id_med_medicament)
                ->delete();
            return $lesInteractions;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

//    public function getLesMedocsAvec($id_medicament){
//        try{
//            $lesInteractions = DB::table('inte  ragir')
//                ->where('interagir.id_medicament','=',$id_medicament)
//                ->where('interagir.med_id_medicament','=',$id_med_medicament)
//                ->delete();
//            return $lesInteractions;
//        }catch (QueryException $e){
//            throw new Exception($e->getMessage(),5);
//        }
//    }
    public function getLaIntercation($med_id_medicament){
        try{
            $lesInteractions = DB::table('interagir')
                ->Select()
                ->join('medicament' , 'medicament.id_medicament','=','interagir.med_id_medicament')
                ->where('interagir.med_id_medicament','=',$med_id_medicament)
                ->get();
            return $lesInteractions;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function modiferLaInteraction($id_medicament,$ancien_med_id_medicament,$new_med_id_medicament){
        try{
            DB::table('interagir')
                ->where('id_medicament', "=" ,$id_medicament)
                ->where('med_id_medicament', '=', $ancien_med_id_medicament)
                ->update([
                        'med_id_medicament' => $new_med_id_medicament,]
                );
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }
    public function GetTestInteractions($id_medicament,$med_id_medicament)
    {
        try{
            $lesPrescriptions = DB::table('interagir')
                ->Select()
                    ->join('medicament' , 'medicament.id_medicament','=','interagir.med_id_medicament')
                    ->where('interagir.med_id_medicament','=',$med_id_medicament)
                    ->where('interagir.id_medicament','=',$id_medicament)
                ->get();
            return $lesPrescriptions;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }
}

