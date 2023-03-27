@extends('layouts.master')
@section('content')

<div class="container">
    <div class="col-md-5">
        <div class="blanc">
            <h1>Liste des visiteurs</h1>
        </div>

        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th style="width:60%">ID</th>
                    <th style="width:60%">Nom</th>
                    <th style="width:60%">Prenom</th>
                    <th style="width:60%">Labo</th>
                    <th style="width:60%">Secteur</th>
                    <th style="width:60%">Commune</th>
                    <th style="width:60%">Adresse</th>

                    <th style="width:20%">Modifier</th>
                    <th style="width:20%">Supprimer</th>
                </tr>
            </thead>

            @foreach($mesVisiteurs as $unVisiteur)
            <tr>
                <td>  {{ $unVisiteur->id_visiteur }}</td>
                <td>  {{ $unVisiteur->nom_visiteur }}</td>
                <td>  {{ $unVisiteur->prenom_visiteur }}</td>
                <td>  {{ $unVisiteur->nom_laboratoire }}</td>
                <td>  {{ $unVisiteur->lib_secteur }}</td>
                <td>  {{ $unVisiteur->cp_visiteur }}</td>
                <td>  {{ $unVisiteur->adresse_visiteur }}</td>

                <td style="text-align: center;"><a href="{{ url('/modifierFrais') }}/{{ $unVisiteur->id_visiteur }}"><span class="glyphicon glyphicon-pencil" data-toggle="tootltip" data-olacement="top" title=""></span> </a> </td>
                <td style="text-align:center;">
                    <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"
                       onclick="javascript:if (confirm('Suppression confirmée ?')){window.location='{{ url('/supprimerFrais') }}/{{$unVisiteur->id_visiteur}}'; }">
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
