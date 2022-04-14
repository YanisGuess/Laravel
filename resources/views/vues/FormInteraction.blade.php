@extends('layouts.master')
@section('content')
    {{--  Vérification de si c'est un ajout ou une modif      --}}
    @if((empty($laInteraction)))

        {{--  Début form Ajout      --}}
        <h1>Ajout d'une Interaction avec le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        {{ Form::open(array('url' => 'medicament/ajouterLaInteraction')) }}
        <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
        <label>Médicament</label>
        <select name="id_med_medicament">
            @foreach($mesMedicaments as $ligne)
                <?php $disabled = ''?>
                @if(($ligne->id_medicament) == ($leMedicament[0]->id_medicament))
                    <?php $disabled = 'disabled'?>
                @endif
                    @foreach($lesInteractions as $Interaction)
                        @if(($ligne->id_medicament) == ($Interaction->id_medicament))
                            <?php $disabled = 'disabled'?>
                        @endif
                    @endforeach
                <option value="{{$ligne->id_medicament}}" <?php echo $disabled?>>{{$ligne->nom_commercial}}</option>
            @endforeach
        </select>
        <button type="submit">Ajouter</button>
        <button><a href="{{url('medicament/getInteraction')}}/{{$leMedicament[0]->id_medicament}}">Retour</a></button>

        {{ Form::close() }}
        {{--  Fin form Ajout      --}}
    @else

{{--  Début form modification      --}}
        <h1>Modification d'une Interaction pour le médicament : {{$leMedicament[0]->nom_commercial}}</h1>
        {{ Form::open(array('url' => 'medicament/modifierLaInteraction')) }}
        <input type="hidden" value="{{$leMedicament[0]->id_medicament}}" name="id_medicament">
        <input type="hidden" value="{{$laInteraction[0]->med_id_medicament}}" name="ancien_med_id_medicament">
        <label>Medicament</label>
        <select name="new_med_id_medicament">
            @foreach($mesMedicaments as $ligne)
                <?php $selected = ''?>
                <?php $disabled = ''?>
                @if(($ligne->id_medicament) == ($laInteraction[0]->id_medicament) )
                    <?php $selected = 'selected'?>
                @endif
                    @if(($ligne->id_medicament) == ($leMedicament[0]->id_medicament))
                        <?php $disabled = 'disabled'?>
                    @endif
                @foreach($lesInteractions as $Interaction)
                    @if(($ligne->id_medicament) == ($Interaction->id_medicament))
                        <?php $disabled = 'disabled'?>
                    @endif
                @endforeach
                <option value="{{$ligne->id_medicament}}" <?php echo $disabled?><?php echo " "?><?php echo $selected?>>{{$ligne->nom_commercial}}</option>
            @endforeach
        </select>
        <button type="submit">Modifier</button>
        <button><a href="{{url('medicament/getInteraction')}}/{{$leMedicament[0]->id_medicament}}">Retour</a></button>
        {{ Form::close() }}
    @endif
    {{--  Fin form modification      --}}
@stop

