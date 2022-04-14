<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;

class ServiceDosage
{
    public function getLesDosages(){
        try{
            $lesDosages = DB::table('dosage')
                ->Select()
                ->get();
            return $lesDosages;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }


}
