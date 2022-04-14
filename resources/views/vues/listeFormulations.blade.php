@extends('layouts.master')
@section('content')
    <h1>Formulation(s) du médicament : {{$leMedicament[0]->nom_commercial}}</h1>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>Présentation</th>
            <th>Quantité Formuler</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        @foreach ($mesFormulations as $ligne)
            <tr>
                <td>{{$ligne->lib_presentation}}</td>
                <td>{{$ligne->qte_formuler}}</td>
                <td><a class="glyphicon glyphicon-pencil" href="{{url('/medicament/modifFormulation')}}/{{$ligne->id_medicament}}/{{$ligne->id_presentation}}">MODIFIER</a></td>
                <td>
                    <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                       onclick="javascript:if (confirm('Suppression confirmée ?'))
                           { window.location= '{{url('/medicament/supprimerFormulation')}}/{{$ligne->id_medicament}}/{{$ligne->id_presentation}}'; }">SUPPRIMER
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
    <a href="{{url('/medicament/ajoutFormulation')}}/{{$leMedicament[0]->id_medicament}}">AJOUTER FORMULATION</a>
@stop

