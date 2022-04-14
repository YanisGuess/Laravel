@extends('layouts.master')
@section('content')
    <h1>Prescription(s) du médicament : {{$leMedicament[0]->nom_commercial}}</h1>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>Quantité de dosage</th>
            <th>Type d'individu</th>
            <th>Posologie</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        @foreach ($mesPrescriptions as $ligne)
            <tr>
                <td>{{$ligne->qte_dosage}} PAR {{$ligne->unite_dosage}}</td>
                <td>{{$ligne->lib_type_individu}}</td>
                <td>{{$ligne->posologie}}</td>
                <td><a class="glyphicon glyphicon-pencil" href="{{url('/medicament/modifPrescription')}}/{{$ligne->id_medicament}}/{{$ligne->id_dosage}}/{{$ligne->id_type_individu}}">MODIFIER</a></td>
                <td>
                    <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                       onclick="javascript:if (confirm('Suppression confirmée ?'))
                           { window.location= '{{url('/medicament/supprimerPrescription')}}/{{$ligne->id_medicament}}/{{$ligne->id_dosage}}/{{$ligne->id_type_individu}}'; }">SUPPRIMER
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    @if(isset($Impossible))
        <div class="alert alert-danger" role="alert">
            {{$Impossible}}
        </div>
    @endif
    <a href="{{url('/medicament/ajoutPrescription')}}/{{$leMedicament[0]->id_medicament}}">AJOUTER PRESCRIPTION</a>
@stop
