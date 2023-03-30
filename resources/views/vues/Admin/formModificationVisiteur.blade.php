@extends('layouts.master')
@section('content')
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"><span class="font-weight-bold">Edogaru</span><span class="text-black-50">edogaru@mail.com.my</span><span> </span></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>

                <button type="button" id="Edit"  value="" style="width: 100%; background: white; border: none; text-align: right;"><span
                        class="glyphicon glyphicon-pencil" data-toggle="tootltip" data-olacement="top"
                        title=""></span></button>

                <button type="button" id="NoEdit"  value="" style="width: 100%; background: white; border: none; text-align: right;" hidden><span
                        class="glyphicon glyphicon-remove" data-toggle="tootltip" data-olacement="top"
                        title=""></span></button>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Prenom</label><input type="text" class="form-control" placeholder="{{$profilVisiteur->prenom_visiteur}}" value="" disabled></div>
                    <div class="col-md-6"><label class="labels">Nom</label><input type="text" class="form-control" value="" placeholder="{{$profilVisiteur->nom_visiteur}}" disabled></div>
                    <div class="col-md-6"><label class="labels">Date d'embauche :  </label>{{$profilVisiteur->date_embauche}}</div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Address Line 1</label><input type="text" class="form-control" placeholder="{{$profilVisiteur->nom_visiteur}}" value="" disabled></div>
                    <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="{{$profilVisiteur->cp_visiteur}}" value="" disabled></div>
                    <div class="col-md-12"><label class="labels">Secteur</label><input id="NoEditS" type="text" class="form-control" placeholder="{{$profilVisiteur->lib_secteur}}" value="" disabled>

                    <select class="form-control" name="Secteurs" required disabled>
                        <OPTION VALUE="0" >Sélectionner un Secteur</OPTION>
                        @foreach ($mesSecteurs as $unS)
                            {
                            <OPTION VALUE =" {{ $unS->id_secteur }}"> {{ $unS->lib_secteur }}</OPTION>
                            }
                        @endforeach
                    </select></div>

                    <div class="col-md-12"><label class="labels">Laboratoire</label><input type="text" class="form-control" placeholder="{{$profilVisiteur->nom_laboratoire}}" value="" disabled></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value="" disabled></div>
                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state" disabled></div>
                </div>
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" disabled><span class="glyphicon glyphicon-save"></span> Save Profile</button>
                <a class="btn btn-primary profile-button" type="button" href=" {{ url('/listeVisiteurs')}}">
                        <span class="glyphicon glyphicon-remove"></span></a></div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value="" disabled> </div> <br>
                <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value="" disabled></div>
            </div>
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

            $("#rech").keyup(function() {
                var type = $('input[name=type]:checked').val()
                var valeur = $("#rech").val();
                $('#contenu').load('api/searchUser/' + type + '/' + valeur);
            });
        });

    </script>
@endsection
