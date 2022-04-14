@extends('layouts.master')
@section('content')
    {{--  Verification de si il s'agit d'un ajout ou une modif    --}}
    @if(empty($laPrescription))
        {{--  Début form Ajout      --}}
        <h1>Ajout d'une Prescription avec le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        {{ Form::open(array('url' => 'medicament/ajouterLaPrescription')) }}
        <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
        <label>Dosage</label>
        <select name="id_dosage">
            @foreach($mesDosages as $ligne)
                <option value="{{$ligne->id_dosage}}">{{$ligne->qte_dosage}} PAR {{$ligne->unite_dosage}}</option>
            @endforeach
        </select>
        <label>Type d'individu</label>
        <select name="id_type_individu">
            @foreach($mesIndividus as $ligne)
                <option value="{{$ligne->id_type_individu}}">{{$ligne->lib_type_individu}}</option>
            @endforeach
        </select>
        <label>Posologie</label>
        <input type="text" name="posologie">
        <button type="submit">Ajouter</button>
        <button><a href="{{url('medicament/getPrescription')}}/{{$leMedicament[0]->id_medicament}}">Retour</a></button>

        {{ Form::close() }}
        {{--  Fin form Ajout      --}}


    @else

        {{--  Début form Modif      --}}
        <h1>Modification d'une Prescription pour le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        {{ Form::open(array('url' => 'medicament/modifierLaPrescription')) }}
        <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
        <input type="hidden" value="{{$laPrescription[0]->id_dosage}}" name="Oldid_dosage">
        <input type="hidden" value="{{$laPrescription[0]->id_type_individu}}" name="Oldid_individu">
        <input type="hidden" value="{{$laPrescription[0]->posologie}}" name="Oldposologie">
        <label>Dosage</label>
        <select name="id_dosage">
            @foreach($mesDosages as $ligne)
                <?php $selected = ''?>
                @if(($ligne->id_dosage) == ($laPrescription[0]->id_dosage) )
                    <?php $selected = 'selected'?>
                @endif
                <option value="{{$ligne->id_dosage}}" <?php echo $selected?>>{{$ligne->qte_dosage}} PAR {{$ligne->unite_dosage}}</option>
            @endforeach
        </select>
        <label>Type d'individu</label>
        <select name="id_individu">
            @foreach($mesIndividus as $ligne)
                <?php $selected = ''?>
                @if(($ligne->id_type_individu) == ($laPrescription[0]->id_type_individu) )
                    <?php $selected = 'selected'?>
                @endif
                <option value="{{$ligne->id_type_individu}}" <?php echo $selected?>>{{$ligne->lib_type_individu}}</option>
            @endforeach
        </select>

        <label>Posologie</label>
        <input type="text" name="posologie" value="{{$laPrescription[0]->posologie}}">
        <button type="submit">Modifier</button>
        <button><a href="{{url('medicament/getPrescription')}}/{{$leMedicament[0]->id_medicament}}">Retour</a></button>
        {{ Form::close() }}
    @endif
    {{--  Fin form Modif      --}}
@stop

