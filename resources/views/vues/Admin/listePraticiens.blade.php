@extends('layouts.master')
@section('content')

    <div class="container main" style="text-align: left; border-radius: 30px; background: white; height: 100%">
        <h2 class="text-center">
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
                        <button class="glyphicon glyphicon-send" data-toggle="collapse" data-toggle="modal" data-target="#ModalInviter{{$unPraticien->nom_praticien}}{{$unPraticien->prenom_praticien}}" style="border: none; background: none; margin: 10px"></button>

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

                <!-- Modal -->
                <div class="modal fade exempleModal" id="ModalInviter{{$unPraticien->nom_praticien}}{{$unPraticien->prenom_praticien}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">


                            {!! Form::open(['url'=> 'inviterPraticien/'.$unPraticien->id_praticien]) !!}
                            <div class="col-md-12 well well-md">
                                <center><h3>Inviter le praticien {{$unPraticien->nom_praticien}} {{$unPraticien->prenom_praticien}}</h3></center>
                                <div class="form-horizontal">
                                    <div class="form-group" style="display: inline">
                                        <div class="col-md-12"><label class="labels">Activité</label>

                                            <select class="form-control" name="id_activite_compl"  required>
                                                <OPTION VALUE="0" > Selectionner une activité </OPTION>
                                                @foreach ($mesActivites as $uneA)

                                                    <OPTION VALUE ="{{$uneA->id_activite_compl}}" > {{ $uneA->theme_activite }}</OPTION>

                                                @endforeach
                                            </select></div>

                                        <div class="col-md-12"><label class="labels">Specialité</label>

                                            <select class="form-control" name="lib_specialite" required>
                                                <OPTION VALUE="0" > Selectionner un specialiste </OPTION>
                                                @foreach ($mesSpecialites as $unS)

                                                    <OPTION VALUE ="{{$unS->lib_specialite}}" > {{ $unS->lib_specialite }}</OPTION>

                                                @endforeach
                                            </select></div>

                                    </div>
                                    <div class="form-group">

                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-3">
                                            <button type="submit" class="btn btn-default btn-primary" style="margin: 10px; margin-right: 30px"><span
                                                    class="glyphicon glyphicon-log-in"></span> Inviter
                                            </button>

                                            <button type="button" class="btn btn-default btn-primary"
                                                    onclick="javascript: window.location = '';">
                                                <span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-md-offset-3">
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>

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
