<?php


namespace App\metier;

use Illuminate\SupportFacades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Formuler extends Model
{
    protected $table = 'formuler';
    public $timestamps = false ;
    protected $fillable = [
        'id_medicament',
        'id_presentation',
        'qte_formuler',
    ];

    public function __construct()
    {
        $this->id_medicament = 0 ;
        $this->id_presentation = 0 ;
        $this->qte_formuler = null ;
    }
}
