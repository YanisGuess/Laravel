@extends('layouts.master')
@section('content')
    {{--  Verification de si il s'agit d'un ajout ou une modif    --}}
    @if(empty($laPresentation))
        {{--  Début form Ajout      --}}
    <h1>Ajout d'une Formulation pour le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
    {{ Form::open(array('url' => 'medicament/ajouterLaFormulation')) }}
    <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
        <input type="hidden" value="{{$mesFormulations[0]->id_presentation}}" name="Oldid_presentation">
    <label>Présentation</label>
    <select name="id_presentation">
        @foreach($mesPresentation as $ligne)
            <?php $disabled = ''?>
            @foreach($mesFormulations as $formule)
                @if(($ligne->id_presentation) == ($formule->id_presentation))
                    <?php $disabled = 'disabled'?>
                @endif
            @endforeach
            <option value="{{$ligne->id_presentation}}" <?php echo $disabled?>>{{$ligne->lib_presentation}}</option>
        @endforeach
    </select>
    <label>Quantité Formuler</label>
    <input type="number" name="qte_formuler">
    <button type="submit">Ajouter</button>
    <button><a href="{{url('medicament/getFormulation')}}/{{$leMedicament[0]->id_medicament}}">Retour</a></button>

    {{ Form::close() }}

        {{--  Fin form Ajout      --}}
    @else


        {{--  Début form Modif      --}}
    <h1>Modification d'une Formulation pour le médicament : {{$mesFormulations[0]->nom_commercial}}</h1>
    {{ Form::open(array('url' => 'medicament/modifierLaFormulation')) }}
    <input type="hidden" value="{{$mesFormulations[0]->id_medicament}}" name="id_medicament">
        <input type="hidden" value="{{$mesFormulations[0]->id_presentation}}" name="Oldid_presentation">
    <label>Présentation</label>
    <select name="id_presentation">
        @foreach($mesPresentation as $ligne)
            <?php $disabled = ''?>
            <?php $selected = ''?>
            @if(($ligne->id_presentation) == ($laPresentation[0]->id_presentation) )
            <?php $selected = 'selected'?>
            @endif
            @foreach($mesFormulations as $formule)
                @if(($ligne->id_presentation) == ($formule->id_presentation))
                    <?php $disabled = 'disabled'?>
                @endif
            @endforeach
            <option value="{{$ligne->id_presentation}}" <?php echo $selected ?><?php echo $disabled?>>{{$ligne->lib_presentation}}</option>
        @endforeach
    </select>
    <label>Quantité Formuler</label>
    <input type="number" name="qte_formuler" value="{{$laFormulation[0]->qte_formuler}}">
    <button type="submit">Modifier</button>
    <button><a href="{{url('medicament/getFormulation')}}/{{$mesFormulations[0]->id_medicament}}">Retour</a></button>
    {{ Form::close() }}
    @endif
    {{--  Fin form Modif      --}}

@stop

