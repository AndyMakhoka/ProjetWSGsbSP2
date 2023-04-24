@extends('layouts.master')
@section('content')

    {!! Form::open(['url' => "validerVisiteur/$profilVisiteur->id_visiteur"])!!}

<div id="contenu" class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right"  style="background-color: #FAFAFA">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold"></span><span class="text-black-50"><br>{{$profilVisiteur->login_visiteur}}</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4 class="text-right" style="float: left">Informations de profil</h4>

                </div>

                <button type="button" id="Edit"  value="" style="width: 100%; background: #FAFAFA; border: none; text-align: right;"><span
                        class="glyphicon glyphicon-pencil" data-toggle="tootltip" data-olacement="top"
                        title=""></span></button>

                <button type="button" id="NoEdit"  value="" style="width: 100%; background: #FAFAFA; border: none; text-align: right;" hidden><span
                        class="glyphicon glyphicon-remove" data-toggle="tootltip" data-olacement="top"
                        title=""></span></button>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Prenom</label><input type="text" name="prenom_visiteur" class="form-control" placeholder="{{$profilVisiteur->prenom_visiteur}}" value="{{$profilVisiteur->prenom_visiteur}}" disabled></div>
                    <div class="col-md-6"><label class="labels">Nom</label><input type="text" name="nom_visiteur" class="form-control" value="{{$profilVisiteur->nom_visiteur}}" placeholder="{{$profilVisiteur->nom_visiteur}}" disabled></div>
                    <div class="col-md-6"><label class="labels">Date d'embauche :  </label>{{$profilVisiteur->date_embauche}}</div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" name="adresse_visiteur" class="form-control" placeholder="{{$profilVisiteur->adresse_visiteur}}" value="{{$profilVisiteur->adresse_visiteur}}" disabled></div>
                    <div class="col-md-12"><label class="labels">Postcode</label><input type="text" name="cp_visiteur" class="form-control" placeholder="{{$profilVisiteur->cp_visiteur}}" value="{{$profilVisiteur->cp_visiteur}}" required disabled></div>
                    <div class="col-md-12"><label class="labels">Secteur</label>

                    <select class="form-control" name="id_secteur" required disabled>
                        <OPTION VALUE="0" >Sélectionner un Secteur</OPTION>
                        @foreach ($mesSecteurs as $unS)
                            {
                                @if($profilVisiteur->id_secteur == $unS->id_secteur){
                            <OPTION VALUE =" {{ $unS->id_secteur }}" selected> {{ $unS->lib_secteur }}</OPTION>
                            }
                            @else{
                            <OPTION VALUE =" {{ $unS->id_secteur }}" > {{ $unS->lib_secteur }}</OPTION>
                            }

                            @endif


                            }
                        @endforeach
                    </select></div>

                    <div class="col-md-12"><label class="labels">Laboratoire</label>
                    <select class="form-control" name="id_laboratoire" required disabled>
                        <OPTION VALUE="0" >Sélectionner un Secteur</OPTION>
                        @foreach ($mesLabo as $unB)
                            {
                            @if($profilVisiteur->id_laboratoire == $unB->id_laboratoire){
                            <OPTION VALUE =" {{ $unB->id_laboratoire }}" selected> {{ $unB->nom_laboratoire }}</OPTION>
                            }
                            @else{
                            <OPTION VALUE =" {{ $unB->id_laboratoire }}"> {{ $unB->nom_laboratoire }}</OPTION>
                            }

                            @endif


                            }
                        @endforeach
                    </select></div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value="" disabled></div>
                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state" disabled></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" disabled><span class="glyphicon glyphicon-save"></span> Save Profile</button>
                    <button id="reset" class="btn btn-primary profile-button" type="button" disabled><span class="glyphicon glyphicon-refresh"></span></button>
                <a class="btn btn-primary profile-button" type="button" href=" {{ url('/listeVisiteurs')}}">
                        <span class="glyphicon glyphicon-remove"></span></a>
                </div>
            </div>

        </div>
        {{ Form::close() }}

        <div class="col-md-4">
            <div class="p-3 py-5" style="padding: 10px;">



                <br> <br>
                <div class="col-md-12"><label class="labels" style="display: inline">Les activité complémentaire</label></div>
                @if(isset($mesActivitesVisiteur))
                @foreach($mesActivitesVisiteur as $uneActivitevisiteur)
            <br><div style="display: inline"><div>{{$uneActivitevisiteur->id_activite_compl}} {{$uneActivitevisiteur->theme_activite}} {{$uneActivitevisiteur->motif_activite}} {{$uneActivitevisiteur->lieu_activite}} {{$uneActivitevisiteur->date_activite}}<div>

                            <button type="button" id="EditActivite"  value="" style="width: 100%; background: #FAFAFA; border: none; text-align: right;"  data-toggle="collapse" data-toggle="modal"  data-target="#ModalEditActivite{{$uneActivitevisiteur->id_activite_compl}}">
                            <span  class="glyphicon glyphicon-pencil" data-toggle="tootltip" data-olacement="top"
                                    title=""></span></button>

                        </div>


                            </div>


                                <!-- Modal Ajouter Activite -->
                                <div class="modal fade exempleModal" data-toggle="collapse" data-toggle="modal" id="ModalAddActivite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">


                                            {!! Form::open(['url'=> "realiserActivite/.$profilVisiteur->id_visiteur"]) !!}
                                            <div class="col-md-12 well well-md">
                                                <center><h3>Modifier l'activité N°{{$uneActivitevisiteur->id_activite_compl}}</h3></center>
                                                <div class="form-horizontal">
                                                    <div class="form-group" style="display: inline">
                                                        <div class="col-md-12"><label class="labels">Ajouter activité complémentaire :</label>
                                                            <input name="motif" type="text" class="form-control" placeholder="Motif" value="" required>
                                                            <input name="date" type="date" class="form-control" placeholder="date" value="" required>
                                                            <input name="lieu" type="text" class="form-control" placeholder="Lieu" value="" required>
                                                            <input name="theme" type="text" class="form-control" placeholder="Thème" value="" required>
                                                            <input name="montant_ac" type="number" class="form-control" placeholder="Montant" value="" required></div> <br>
                                                        <div class="mt-5 text-center">
                                                            <button class="btn btn-primary profile-button" type="submit"><span class="glyphicon glyphicon-ok"></span></button>
                                                            <button type="button" class="btn btn-default btn-primary"
                                                                    onclick="javascript: window.location = '';">
                                                                <span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Modifier Activite -->
                                <div class="modal fade exempleModal" data-toggle="collapse" data-toggle="modal" id="ModalEditActivite{{$uneActivitevisiteur->id_activite_compl}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">


                                            {!! Form::open(['url'=> 'modifierActiviter/'.$profilVisiteur->id_visiteur .$uneActivitevisiteur->id_activite_compl]) !!}
                                            <div class="col-md-12 well well-md">
                                                <center><h3>Modifier l'activité N°{{$uneActivitevisiteur->id_activite_compl}}</h3></center>
                                                <div class="form-horizontal">
                                                    <div class="form-group" style="display: inline">
                                                        <div class="col-md-12"><label class="labels">Ajouter activité complémentaire :</label>
                                                            <input name="motif" type="text" class="form-control" placeholder="Motif" value="{{$uneActivitevisiteur->motif_activite}}" required>
                                                            <input name="date" type="date" class="form-control" placeholder="date" value="{{$uneActivitevisiteur->date_activite}}" required>
                                                            <input name="lieu" type="text" class="form-control" placeholder="Lieu" value="{{$uneActivitevisiteur->lieu_activite}}" required>
                                                            <input name="theme" type="text" class="form-control" placeholder="Thème" value="{{$uneActivitevisiteur->theme_activite}}" required>
                                                            <input name="montant_ac" type="number" class="form-control" placeholder="Montant" value="{{$uneActivitevisiteur->montant_ac}}" required></div> <br>
                                                        <div class="mt-5 text-center">
                                                            <button class="btn btn-primary profile-button" type="submit"><span class="glyphicon glyphicon-ok"></span></button>
                                                            <button type="button" class="btn btn-default btn-primary"
                                                                    onclick="javascript: window.location = '';">
                                                                <span class="glyphicon glyphicon-remove"></span> Annuler</button>
                                                        </div>


                                                    </div>

                                                </div>
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                    </div>
                                </div>


                @endforeach
                            <br>
                            <button id="add" class="btn btn-primary profile-button" type="button" data-toggle="collapse" data-toggle="modal"  data-target="#ModalAddActivite" >Ajouter<span class="glyphicon"></span></button>
                            @endif
            </div>

            {{ Form::close() }}

        </div>


    </div>
</div>


@endsection
@section('script')
    <script type="text/javascript">

        $(document).ready(function() {
            console.log("OK")

            $("#Edit").click(function (){

                $('.form-control').prop('disabled', false);
                $('.profile-button').prop('disabled', false);


                $("#Edit").hide();
                $("#NoEdit").show();


                /*
                if ($('#Edit').prop('checked')) {
                    $("#NoEditS").hide();
                    $("#EditS").show();
                } else {
                    $("#NoEditS").show();
                    $("#EditS").hide();
                }

                 */

                //document.getElementById('NoEditS').hidden= true;
            });

            $("#NoEdit").click(function (){

                $('.form-control').prop('disabled', true);
                $("#NoEdit").hide();
                $("#Edit").show();




                /*
                if ($('#Edit').prop('checked')) {
                    $("#NoEditS").hide();
                    $("#EditS").show();
                } else {
                    $("#NoEditS").show();
                    $("#EditS").hide();
                }

                 */

                //document.getElementById('NoEditS').hidden= true;
            });




            /*
            $("#reset").click(function (){
                $('#contenu').load('$id_visiteur');
            });
            */

        });

    </script>
@endsection
