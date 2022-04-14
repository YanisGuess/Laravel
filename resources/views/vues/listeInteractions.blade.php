@extends('layouts.master')
@section('content')
    <h1>Les médicament(s) qui intéragissent avec le : {{$leMedicament[0]->nom_commercial}}</h1>
    <table class="table table-bordered table-responsive table-striped">
        <tr>
            <th>Médicament</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
        @foreach ($mesInteractions as $ligne)
            <tr>
                <td>{{$ligne->nom_commercial}}</td>
                <td><a class="glyphicon glyphicon-pencil" href="{{url('/medicament/modifInteractions')}}/{{$leMedicament[0]->id_medicament}}/{{$ligne->med_id_medicament}}">MODIFIER</a></td>
                <td>
                    <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                       onclick="javascript:if (confirm('Suppression confirmée ?'))
                           { window.location= '{{url('/medicament/supprimerInteraction')}}/{{$leMedicament[0]->id_medicament}}/{{$ligne->med_id_medicament}}'; }">SUPPRIMER
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
    <a href="{{url('/medicament/ajoutinteraction')}}/{{$leMedicament[0]->id_medicament}}">AJOUTER INTERACTION</a>
@stop

