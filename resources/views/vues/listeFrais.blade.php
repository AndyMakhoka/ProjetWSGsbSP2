@extends('layouts.master')
@section('content')

<div class="container">
    <div class="col-md-5">
        <div class="blanc">
            <h1>Liste des visiteur</h1>
        </div>

        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:60%">ID</th>
                    <th style="width:60%">Nom</th>
                    <th style="width:60%">Prenom</th>
                    <th style="width:60%">Labo</th>
                    <th style="width:60%">Secteur</th>
                    <th style="width:60%">Commun</th>
                    <th style="width:60%">Adresse</th>

                    <th style="width:20%">Modifier</th>
                    <th style="width:20%">Supprimer</th>
                </tr>
            </thead>

            @foreach($mesVisiteurs as $unVisiteur)
            <tr>
                <td>  {{ $unVisiteur->id_visiteur }}</td>
                <td>  {{ $unVisiteur->nom_visiteur }}</td>
                <td style="text-align: center;"><a href="{{ url('/modifierFrais') }}/{{ $unFrais->id_frais }}"><span class="glyphicon glyphicon-pencil" data-toggle="tootltip" data-olacement="top" title=""></span> </a> </td>
                <td style="text-align:center;">
                    <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                       onclick="javascript:if (confirm('Suppression confirmée ?')){window.location='{{ url('/supprimerFrais') }}/{{$unFrais->id_frais}}'; }">
                    </a>
                </td>
            </tr>

            @endforeach
        </table>

        <div class="col-md-6 col-md-offset-3">
            @include('Vues/error')
        </div>

    </div>
</div>
@stop
