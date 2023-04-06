
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

@endif

