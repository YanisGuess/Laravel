<?php


namespace App\metier;

use Illuminate\SupportFacades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Dosage extends Model
{
    protected $table = 'dosage';
    public $timestamps = false ;
    protected $fillable = [
        'id_dosage',
        'qte_dosage',
        'unite_dosage',

    ];

    public function __construct()
    {
        $this->id_dosage = 0 ;
        $this->qte_dosage = 0;
        $this->unite_dosage = null;
    }
}
