<?php


namespace App\metier;

use Illuminate\SupportFacades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Type_individu extends Model
{
    protected $table = 'type_individu';
    public $timestamps = false ;
    protected $fillable = [
        'id_type_individu',
        'lib_type_individu',
    ];

    public function __construct()
    {
        $this->id_type_individu = 0 ;
        $this->lib_type_individu = null ;
    }
}
