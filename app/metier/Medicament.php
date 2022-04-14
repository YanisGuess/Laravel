<?php


namespace App\metier;

use Illuminate\SupportFacades\Session;
use Illuminate\Database\Eloquent\Model;
use DB;

class Medicament extends Model
{
    protected $table = 'medicament';
    public $timestamps = false ;
    protected $fillable = [
        'id_medicament',
        'id_famille',
        'depot_legal',
        'nom_commercial',
        'effets',
        'contre_indication',
        'prix_echantillon',
    ];

    public function __construct()
    {
        $this->id_medicament = 0 ;
        $this->id_famille = 0 ;
        $this->id_famille = null ;
        $this->id_famille = null ;
        $this->id_famille = null ;
        $this->id_famille = null ;
        $this->id_famille = 0 ;
    }
}
