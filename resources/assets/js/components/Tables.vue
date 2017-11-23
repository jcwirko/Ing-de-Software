<template>
    <div>
     <!--<div class="loader">-->
            <!--<img src="#" alt="gif"/>-->
            <!--<span></span>-->
        <!--</div>-->

        <div class="row row-bottom">
            <div class="col-md-3 well">
                <h3>Temperatura</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Actual</th>
                        <th>Mínima</th>
                        <th>Máxima</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-3 well">
                <h3>Humedad</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Actual</th>
                        <th>Mínima</th>
                        <th>Máxima</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="col-md-3 well">
                <h3>Sensación Térmica</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            Temperatura y
                            <br> viento actual
                        </th>
                        <th>
                            Temperatura y
                            <br> humedad actual
                        </th>
                    </tr>
                    </thead>

                </table>
            </div>
            <div class="col-md-3 well">
                <h3>Viento</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                Velocidad
                            </th>
                            <th>
                                Sector
                            </th>      <th>
                                Máxima
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        mounted() {

            var data = [
                {
                    'hc-key': 'ar-tf',
                    'value': 19,
                    'sensor': 19
                },
                {
                    'hc-key': 'ar-ba',
                    'value': 15,
                    'sensor': 3
                },
                {
                    'hc-key': 'ar-sj',
                    'value': 4,
                    'sensor': 22
                },
                {
                    'hc-key': 'ar-mz',
                    'value': 8,
                    'sensor': 10
                },
            ];

            Highcharts.mapChart('maps', {
                chart: {
                    map: 'countries/ar/ar-all'
                },
                title: {
                    text: 'Estación Meteorológica'
                },
                subtitle: {
                    text: 'ARGENTINA'
                },
                mapNavigation: {
                    enabled: true,
                    buttonOptions: {
                        verticalAlign: 'bottom'
                    }
                },
                colorAxis: {
                    min: 0
                },
                plotOptions: {
                    series: {
                        events: {
                            click: function (event) {
                                console.log(event);
                                $("#tbl-arg").hide();
                                $(".loader").css('display', 'flex');
                                $(".loader span").text('Obteniendo datos de ' + event.point.name + ' ...');

                                setTimeout(function () {
                                    $(".loader span").text('Procesando...');

                                    setTimeout(function () {
                                        $("#tbl-arg #provincia").html(event.point.name);
                                        $("#tbl-arg #sensor").html(event.point.value);
                                        $("#tbl-arg #dato-random").html(Math.random());

                                        $("#tbl-arg").show();
                                        $(".loader").css('display', 'none');
                                    }, 2000);
                                }, 2000);


                            }
                        }
                    },
                },
                series: [{
                    data: data,
                    name: 'Provincia',
                    states: {
                        hover: {
                            color: '#BADA55'
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }]
            });

        }
    }
</script>
