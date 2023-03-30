@extends('layouts.master')
@section('content')


            <div class="container main" style="height: 250px; text-align: center;">
                <h1>
                    Recherche d'un visiteur
                </h1>
                <div class="recherche" style="align-text: center; display: inline-block;">

                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary active">
                            <input type="radio" name="type"  value="nom_visiteur" autocomplete="off" checked> Nom
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio" name="type"  value="prenom_visiteur" autocomplete="off"> Prénom
                        </label>
                    </div>
                    <input type="text" id="rech" style="width: 200px; margin-top: 5px;" class="form-control rech"/>
                </div>
            </div>



            <div class="container main" style="overflow-y : scroll; height: 1000px; width: 1200px">
            <table class="table table-bordered table-striped table-responsive" style="text-align: center">
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
                <tbody id="contenu">
                @foreach($mesVisiteurs as $unVisiteur)
                    <tr>
                        <td>  {{ $unVisiteur->id_visiteur }}</td>
                        <td>  {{ $unVisiteur->nom_visiteur }}</td>
                        <td>  {{ $unVisiteur->prenom_visiteur }}</td>
                        <td>  {{ $unVisiteur->nom_laboratoire }}</td>
                        <td>  {{ $unVisiteur->lib_secteur }}</td>
                        <td>  {{ $unVisiteur->cp_visiteur }}</td>
                        <td>  {{ $unVisiteur->adresse_visiteur }}</td>

                        <td style="text-align: center;"><a
                                href="{{ url('/profilVisiteur') }}/{{ $unVisiteur->id_visiteur }}"><span
                                    class="glyphicon glyphicon-pencil" data-toggle="tootltip" data-olacement="top"
                                    title=""></span> </a></td>
                        <td style="text-align:center;">
                            <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top"
                               title="Supprimer" href="#"
                               onclick="javascript:if (confirm('Suppression confirmée ?')){window.location='{{ url('/supprimerFrais') }}/{{$unVisiteur->id_visiteur}}'; }">
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>


            <div class="col-md-6 col-md-offset-3">
                @include('vues.error')
            </div>

            </div>




@endsection


@section('script')
    <script type="text/javascript">

    $(document).ready(function() {
        console.log("OK")
            $("#rech").keyup(function() {
                var type = $('input[name=type]:checked').val()
                var valeur = $("#rech").val();
                $('#contenu').load('api/searchUser/' + type + '/' + valeur);
            });
        });

    </script>
@endsection
