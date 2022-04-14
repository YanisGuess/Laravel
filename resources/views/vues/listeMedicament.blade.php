@extends('layouts.master')
@section('content')
    <input class="awsome_input" id='myInput' onkeyup='searchTable()' type='text' placeholder="Recherche d'un médicament">
    <table  id="myTable" class="table table-bordered table-responsive table-striped">
        <tr id="tableHeader">
            <th>Nom commercial</th>
            <th>Famille</th>
            <th>Effets</th>
            <th>Dépôt légal</th>
            <th>Contre indication</th>
            <th>Prix</th>
            <th>Formulation(s)</th>
            <th>Interaction(s)</th>
            <th>Prescription(s)</th>
        </tr>
        <?php $i = 0; $class = '';?>
        @foreach ($mesMedicaments as $ligne)
        <?php
        $i++;
        $r = fmod($i, 2);
        ?>
        <tr>
            <td class="search">{{$ligne->nom_commercial}}</td>
            <td>{{$ligne->lib_famille}}</td>
            <td>{{$ligne->effets}}</td>
            <td>{{$ligne->depot_legal}}</td>
            <td>{{$ligne->contre_indication}}</td>
            <td>{{$ligne->prix_echantillon}}</td>
            <td>
                <a href="{{url('medicament/getFormulation')}}/{{$ligne->id_medicament}}">FORMULATION</a>
            </td>
            <td>
                <a href="{{url('medicament/getInteraction')}}/{{$ligne->id_medicament}}">INTERACTION</a>
            </td>
            <td>
                <a href="{{url('medicament/getPrescription')}}/{{$ligne->id_medicament}}">PRESCRIPTION</a>
            </td>
        </tr>
        @endforeach
    </table>
    <script>
        function searchTable() {
            var input, filter, found, table, tr, td, i, j;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByClassName("search");
                for (j = 0; j < td.length; j++) {
                    if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                    found = false;
                } else {
                    if (tr[i].id !== 'tableHeader') {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
@stop

