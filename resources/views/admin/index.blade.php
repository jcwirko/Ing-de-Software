@extends('layouts.admin')

@section('content-header')

    <a href="/smn/dashboard/encenderTodo" class="btn btn-primary" id="encenderTodo">

        <i class="fa fa-power-off" aria-hidden="true" ></i>
        Encender Sensores
    </a>

    <a href="/smn/dashboard/apagarTodo" class="btn btn-primary" id="apagarTodo">
        <i class="fa fa-power-off fa-fw" aria-hidden="true"></i>
        Apagar Sensores
    </a>

    <a href="#" id="calibrar" class="btn btn-primary">
        <i class="fa fa-briefcase fa-fw" aria-hidden="true"></i>
        Calibrar Sensores
    </a>

    <a href="/smn/dashboard/testearTodo"  class="btn btn-primary">
        <i class="fa fa-file-text-o" aria-hidden="true"></i>
       Testear Sensores
    </a>

@endsection

@section('content')

    @foreach ($sensores->chunk(3) as $chunk)
        <div class="row ">
            @foreach ($chunk as $sensor)
                <div class="col-xs-4">
                    <div class="well">
                        <h3>
                            {{ $sensor->sensor }}

                            @if($sensor->estado == 1)
                                <a href="/smn/dashboard/apagarEncenderSensor/{{$sensor->id}}"
                                   class="btn btn-sm btn-success">
                                    <i class="fa fa-power-off fa-fw" aria-hidden="true"></i>
                                    Apagar
                                </a>
                            @elseif($sensor->estado == 0)
                                <a href="/smn/dashboard/apagarEncenderSensor/{{$sensor->id}}"
                                   class="btn btn-sm btn-primary">
                                    <i class="fa fa-power-off fa-fw" aria-hidden="true"></i>
                                    Encender
                                </a>
                            @else
                                <a href="/smn/dashboard/calibrarSensor/{{$sensor->id}}"
                                   class="btn btn-sm btn-danger">
                                    <i class="fa fa-briefcase fa-fw" aria-hidden="true"></i>
                                   Calibrar
                                </a>
                            @endif

                        </h3>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Modelo</th>
                                <th class="text-center">Número de Serie</th>
                                <th class="text-center">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td>
                                    {{$sensor->modelo}}
                                </td>
                                <td>
                                    {{$sensor->numero_serie}}
                                </td>
                                <td>
                                    @if($sensor->estado == 0)
                                        <i class="fa fa-circle" style="color: black;" aria-hidden="true"></i>
                                    @elseif($sensor->estado == 1)
                                        <i class="fa fa-circle" style="color: green;" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-circle fail" style="color: red;" aria-hidden="true"></i>
                                        <br>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            @endforeach
        </div>
    @endforeach

    <script>
        var i = 0;

        function change() {
            var color = ["red", '#f31f1f', '#f31f1f', "black"];
            $(".fail").css('color', color[i]);
            i = (i + 1) % color.length;
        }

        setInterval(change, 100);
//
//        setInterval(ocultar, 2000);
//
//        function ocultar(){
//            if (!$('.ocultar').is(':visible'))
//                $('.ocultar').show('slow');
//            else
//                $('.ocultar').hide('slow');
//        }

    </script>

@endsection

