<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;

class ServiceIndividu
{
    public function getLesIndividus(){
        try{
            $lesIndividus = DB::table('type_individu')
                ->Select()
                ->get();
            return $lesIndividus;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

}
