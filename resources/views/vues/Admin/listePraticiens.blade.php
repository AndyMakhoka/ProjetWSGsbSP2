@extends('layouts.master')
@section('content')

    <div class="container main" style="height: 250px; text-align: left;">
        <h2>
            Praticiens
        </h2>
        <div class="recherche" style="text-align: left; display: inline-block; margin-bottom: 20px;">

            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active" style="padding:  10px 20px 10px 20px">
                    <input class="type" type="radio" name="type"  value="nom_praticien" autocomplete="off" checked > Nom
                </label>
                <label class="btn btn-secondary" style="padding:  10px 20px 10px 20px">
                    <input class="type" type="radio" name="type"  value="prenom_praticien" autocomplete="off"> Prenom
                </label>

            </div>
            <input type="text" id="rech" placeholder="Recherche d'un praticien" style="width: 300px; margin-top: 5px; padding:  10px 20px 10px 20px" class="form-control rech"/>
        </div>

        <table class="table table-bordered table-striped table-responsive" style="text-align: center; border: none !important; border: 0;">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Fonction</th>
                <th>Etablissment</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Adresse</th>
                <th>Coef de notoriete</th>

                <th>Inviter</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>

            <tbody id="contenu">
            @foreach($mesPraticiens as $unPraticien)
                <tr>
                    <td>  {{ $unPraticien->id_praticien }}</td>
                    <td>  {{ $unPraticien->nom_praticien }}</td>
                    <td>  {{ $unPraticien->prenom_praticien }}</td>
                    <td>  {{ $unPraticien->lib_type_praticien }}</td>
                    <td>  {{ $unPraticien->lieu_type_praticien }}</td>
                    <td>  {{ $unPraticien->cp_praticien }}</td>
                    <td>  {{ $unPraticien->ville_praticien }}</td>
                    <td>  {{ $unPraticien->adresse_praticien }}</td>
                    <td>  {{ $unPraticien->coef_notoriete }}</td>

                    <td style="text-align:center;">
                        <a class="glyphicon glyphicon-send" data-toggle="tooltip" data-placement="top"
                           title="Supprimer" href="#"
                           onclick="javascript:if (confirm('Suppression confirmée ?')){window.location='{{ url('/supprimerFrais') }}/{{$unPraticien->id_praticien}}'; }">
                        </a>
                    </td>
                    <td style="text-align: center;"><a
                            href="{{ url('/profilVisiteur') }}/{{ $unPraticien->id_praticien }}"><span
                                class="glyphicon glyphicon-pencil" data-toggle="tootltip" data-olacement="top"
                                title=""></span> </a></td>
                    <td style="text-align:center;">
                        <a class="glyphicon glyphicon-remove" data-toggle="tooltip" data-placement="top"
                           title="Supprimer" href="#"
                           onclick="javascript:if (confirm('Suppression confirmée ?')){window.location='{{ url('/supprimerFrais') }}/{{$unPraticien->id_praticien}}'; }">
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
                $('#contenu').load('api/searchPraticien/' + type + '/' + valeur);
            });

            $(".type").change(function() {
                var type = $('input[name=type]:checked').val()
                var valeur = $("#rech").val();
                $('#contenu').load('api/searchPraticien/' + type + '/' + valeur);
            });
        });

    </script>
@endsection
