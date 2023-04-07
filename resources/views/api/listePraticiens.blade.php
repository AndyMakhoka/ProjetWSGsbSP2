
@if ($vide)
    <tr class="tr-1">
        <td colspan="7">Il n'y a pas de praticien avec ces informations</td>
    </tr>

@else
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
                <button class="glyphicon glyphicon-send" data-toggle="collapse" data-toggle="modal" data-target="#ModalInviter" style="border: none; background: none; margin: 10px"></button>

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
        <div class="modal fade" id="ModalInviter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">


                    {!! Form::open(['url'=> 'login']) !!}
                    <div class="col-md-12 well well-md">
                        <center><h3>Inviter le praticien {{$unPraticien->nom_praticien}} {{$unPraticien->prenom_praticien}}</h3></center>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <div class="col-md-12"><label class="labels">Activité</label>

                                    <select class="form-control" name="id_secteur" required>
                                        <OPTION VALUE="0" > Selectionner une activité </OPTION>
                                        @foreach ($mesActivites as $uneA)

                                            <OPTION VALUE =" {{ $uneA->id_activite_compl }}" > {{ $unS->theme_activite }}</OPTION>

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
            {{ Form::close() }}
        </div>


    @endforeach

@endif

