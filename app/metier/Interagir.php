<?php

namespace App\metier;

class Interagir
{
    protected $table = 'interagir';
    public $timestamps = false ;
    protected $fillable = [
        'id_medicament',
        'med_id_medicament',
    ];
}
