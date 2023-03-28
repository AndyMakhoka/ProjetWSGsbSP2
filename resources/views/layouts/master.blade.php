
<!doctype html>
<html lang="fr">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {!! Html::style('assets/css/bootstrap.css') !!}
        {!! Html::style('assets/css/bootstrap.css') !!}
        {!! Html::style('assets/css/monStyle.css') !!}

        {!! Html::style('assets/css/style.css') !!}

        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="{{asset('js/popper.min.js')}}"></script>
        <script src="{{asset('js/bootstrap.js')}}"></script>


        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet'
              type='text/css'>

    </head>
    <body class="body">
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-target">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar+ bvn"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">GSB</a>
                </div>

                @if(Session::get('id') == 0)
                <div class="collapse navbar-collapse" id="navbar-collapse-target">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a data-toggle="collapse" data-toggle="modal" data-target="#exampleModal">Se connecter</a></li>
                    </ul>
                </div>
                @endif

                @if (Session::get('id') > 0)
                <div class="collapse navbar-collapse" id="navbar-collapse-target">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/lister') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Visiteurs</a></li>
                        <li><a href="{{ url('/lister') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Praticiens</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{ url('/seDeconnecter') }}" data-toggle="collapse" data-target=".navbar-collapse.in">Se déconnecter</a></li>
                    </ul>
                </div>
                @endif

            </div><!--/.container-fluid -->
        </nav>
    </div>
    <div class="container">




        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">


                        {!! Form::open(['url'=> 'login']) !!}
                        <div class="col-md-12 well well-md">
                            <center><h1>se connecter</h1></center>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Identifiant : </label>
                                    <div class="col-md-6  col-md-3">
                                        <input type="text" name="login" class="form-control" placeholder="Votre identifiant" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Mot de passe : </label>
                                    <div class="col-md-6 col-md-3">
                                        <input type="password" name="pwd" class="form-control" placeholder="Votre mot de passe" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-default btn-primary"><span
                                                class="glyphicon glyphicon-log-in"></span> Valider
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


        @yield('content')
    </div>
    {!! Html::script('assets/js/bootstrap.min.js') !!}
    {!! Html::script('assets/js/jquery-3.1.1.js') !!}
    {!! Html::script('assets/js/jquery-3.3.1.min.js') !!}
    {!! Html::script('assets/js/jquery-ui.min.js') !!}
    {!! Html::script('assets/js/npm.js') !!}

    {!! Html::script('assets/js/ui-bootstrap-tpls.0.11.js') !!}
    {!! Html::script('assets/js/ui-bootstrap-tpls.js') !!}
    {!! Html::script('assets/js/bootstrap.js') !!}
    </body>
</html>

