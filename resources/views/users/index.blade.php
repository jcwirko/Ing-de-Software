<!DOCTYPE>
<html lang="es">
    <head>
        <title>Ing. Software</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{asset('font-awesome-4.7.0/css/font-awesome.min.css')}}"/>
        <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    </head>
    <body>

        <h1 class="text-center title" >
            Estación Meteorológica

            @if(auth()->user())
            <a href="/smn/dashboard/index" class="btn btn-success pull-right">
                Panel de administración
            </a>
            @endif
        </h1>
        <div class="content container-fluid" id="app">

            <div class="buttons-i">
                <i style="text-align: center; font-size: 22px;" id="temperatura" data-toggle="modal" data-target="#mdlTemperatura" class="fa fa-thermometer-empty fa-3x fa-pull-left fa-border" title="temperatura" aria-hidden="true">
                    <br>  Temperatura</i>
            </div>
            <div class="buttons-i">
                <i style="text-align: center; font-size: 22px;" id="humedad" data-toggle="modal" data-target="#mdlHumedad" class="fa fa-tint fa-3x fa-pull-left fa-border" title="temperatura" aria-hidden="true">
                    <br>  Humedad</i>
            </div>
            <div class="buttons-i">
                <i style="text-align: center; font-size: 22px;" id="presion" data-toggle="modal" data-target="#mdlPresion" class="fa fa-sort-numeric-asc fa-3x fa-pull-left fa-border" title="temperatura" aria-hidden="true">
                    <br>  Presión Barométrica</i>
            </div>

            @include('partials.temperatura')
            @include('partials.humedad')
            @include('partials.presion')
        </div>

        <script type="text/javascript" src="{{asset('js/jquery-3.2.1.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/chart.js/dist/Chart.js')}}"></script>

        <script src="https://codepen.io/anon/pen/aWapBE.js"></script>
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </body>
</html>
