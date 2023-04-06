@extends('layouts.master')
@section('content')


            <div class="container main" style="height: 250px; text-align: left;">
                <h2>
                    Visiteurs
                </h2>
                <div class="recherche" style="text-align: left; display: inline-block; margin-bottom: 20px">

                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary active" style="padding:  10px 20px 10px 20px">
                            <input class="type" type="radio" name="type"  value="nom_visiteur" autocomplete="off" checked > Nom
                        </label>
                        <label class="btn btn-secondary" style="padding:  10px 20px 10px 20px">
                            <input class="type" type="radio" name="type"  value="lib_secteur" autocomplete="off"> Secteur
                        </label>
                        <label class="btn btn-secondary" style="padding:  10px 20px 10px 20px">
                            <input class="type" type="radio" name="type"  value="nom_laboratoire" autocomplete="off"> Laboratoire
                        </label>
                    </div>
                    <input type="text" id="rech" placeholder="Recherche d'un visiteur" style="width: 300px; margin-top: 5px; padding:  10px 20px 10px 20px" class="form-control rech"/>
                </div>

            <table class="table table-bordered table-striped table-responsive" style="text-align: center; border: none !important; border: 0;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Labo</th>
                    <th>Secteur</th>
                    <th>Commune</th>
                    <th>Adresse</th>

                    <th>Modifier</th>
                    <th>Supprimer</th>
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
        $(".type").change(function() {
            var type = $('input[name=type]:checked').val()
            var valeur = $("#rech").val();
            $('#contenu').load('api/searchUser/' + type + '/' + valeur);
        });
        });

    </script>
@endsection
