<?php


namespace App\dao;
use http\Env\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Exceptions\MonException;
use App\metier\Visiteur;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class ServiceVisiteur
{
    public function login($login,$pwd){
        $connected = false;
        try{
            $visiteur = DB::table('visiteur')
                ->select()
                ->where('login_visiteur',[$login])
                ->first();
            if ($visiteur != null){
                //if(Hash::check($pwd,$visiteur->pwd_visiteur)){
                    Session::put('id',$visiteur->id_visiteur);
                    Session::put('type',$visiteur->type_visiteur);
                    $connected = true;
                //}
            }
        }catch(QueryException $e){
            throw  new \Exception($e->getMessage(),5);
        }
        return $connected;
    }
    public function getLab (){
        try{
            $mesLab= DB::table('laboratoire')
                ->select()
                ->get();
            return $mesLab;
        }catch(QueryException $e){
            throw new \Exception($e->getMessage(),5);
        }
    }

    public function logout(){
        Session::put('id',0);
    }

    public function getListeVisiLaboAjax($id,$DateDeb,$DateFin,$montant){
        try {
            $mesVisi = $this->getListerVisiLabo($id,$DateDeb,$DateFin,$montant);
            $rep = "<h1>Liste des Visiteurs</h1>";
            $rep = $rep.'<table class="table table-bordered table-striped">';
            $rep = $rep.'<tr><th>Id</th><th>Id frais</th><th>Nom</th>
<th>Prénoms</th><th>Ville</th><th>Détail</th>';
            foreach ($mesVisi as $unVisi)
            {
                $rep = $rep.'<tr><td>'.$unVisi->id_visiteur.'</td><td>'.$unVisi->id_frais.'</td><td>'.$unVisi->nom_visiteur.
                    '</td><td>'.$unVisi->prenom_visiteur.'</td><td>'.$unVisi->ville_visiteur.'</td>
<td><a href="http://localhost/GuessoumYanis/ProjetGSBSecurisé/public/frais/getListeFraisHorsForfait/'.$unVisi->id_frais.'">
<span class="glyphicon glyphicon-pencil" data-toggle="tooltip" data-placement="top" title="Modifier"></span></a></tr>';

            }
            return $rep;
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function getListerVisiLabo ($id,$DateDeb,$DateFin,$montant){
        try{
            $mesVisi = DB::table('visiteur')
                ->select()
                ->join('laboratoire' , 'laboratoire.id_laboratoire','=','visiteur.id_laboratoire')
                ->join('frais','frais.id_visiteur','=','visiteur.id_visiteur')
                ->where('laboratoire.id_laboratoire','=',$id)
                ->where('anneemois','>=',$DateDeb)
                ->where('anneemois','<=',$DateFin)
                ->where('frais.montantvalide','>',$montant)
                ->get();
            return $mesVisi;
        }catch(QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }
    public function getListerVisi (){
        try{
            $mesVisiteurs = DB::table('visiteur')
                ->select()
                ->join('frais' , 'frais.id_visiteur','=','visiteur.id_visiteur')
                ->join('laboratoire','laboratoire.id_laboratoire','=','visiteur.id_laboratoire')
                ->get();
            return $mesVisiteurs;
        }catch(QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }


    public function miseAjourMotPasse($pwd){
        try {
            DB::table('visiteur')
                ->update([
                    'pwd_visiteur' => $pwd,
                ]);
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }


}
