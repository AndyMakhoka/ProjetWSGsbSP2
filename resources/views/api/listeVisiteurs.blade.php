
@if ($vide)
    <tr class="tr-1">
        <td colspan="7">Il n'y a pas de visiteur avec ces informations</td>
    </tr>

@else
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

@endif

