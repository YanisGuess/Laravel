<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;

class ServicePresentation
{
    public function getLesPresentation(){
        try{
            $lesPresentations = DB::table('presentation')
                ->Select()
                ->get();
            return $lesPresentations;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function getLaPresentation($id_presentation){
        try{
            $lesPresentations = DB::table('presentation')
                ->Select()
                ->where('id_presentation','=',$id_presentation)
                ->get();
            return $lesPresentations;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

}
