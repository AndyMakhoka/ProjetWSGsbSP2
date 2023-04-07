@extends('layouts.master')
@section('content')



    {!! Html::style('assets/css/style1.css') !!}
    {!! Html::style('assets/css/styleper.css') !!}



    <div class="container">

        @if(Session::get('id') == 0)
            <h3 style="color: white;" >Application GSB</h3>
            <br><br><br><br><br><br>
        @else

            <h3 style="color: white;" >Application GSB</h3>
            <br><br><br><br><br><br>
            <div class="grid">
                <a href="{{ url('/listeVisiteurs') }}">
                    <div class="card">

                        <h4>Visiteurs</h4>
                        <p> - - -  - -
                            - - - - - -
                        </p>
                        <div class="shine"></div>
                        <div class="background">
                            <div class="tiles">
                                <div class="tile tile-1"></div>
                                <div class="tile tile-2"></div>
                                <div class="tile tile-3"></div>
                                <div class="tile tile-4"></div>

                                <div class="tile tile-5"></div>
                                <div class="tile tile-6"></div>
                                <div class="tile tile-7"></div>
                                <div class="tile tile-8"></div>

                                <div class="tile tile-9"></div>
                                <div class="tile tile-10"></div>
                            </div>

                            <div class="line line-1"></div>
                            <div class="line line-2"></div>
                            <div class="line line-3"></div>
                        </div>
                    </div>

                </a>

                <a href="{{ url('/listePraticiens') }}">
                    <div class="card">

                        <h4>Praticiens</h4>
                        <p>
                            - - - -
                            - - - -
                        </p>
                        <div class="shine"></div>
                        <div class="background">
                            <div class="tiles">
                                <div class="tile tile-1"></div>
                                <div class="tile tile-2"></div>
                                <div class="tile tile-3"></div>
                                <div class="tile tile-4"></div>

                                <div class="tile tile-5"></div>
                                <div class="tile tile-6"></div>
                                <div class="tile tile-7"></div>
                                <div class="tile tile-8"></div>

                                <div class="tile tile-9"></div>
                                <div class="tile tile-10"></div>
                            </div>

                            <div class="line line-1"></div>
                            <div class="line line-2"></div>
                            <div class="line line-3"></div>
                        </div>
                    </div>

                </a>


                @endif


    </div>


@endsection
