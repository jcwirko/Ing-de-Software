<template>

    <div class="well">
        <h3>Temperatura</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th rowspan="2" class="text-center">Actual</th>
                <th colspan="2" class="text-center">Diaria</th>
                <th colspan="2" class="text-center">A las</th>
                <th colspan="2" class="text-center">Últimos <br> 30 días</th>
            </tr>
            <tr>
                <!--Diaria-->
                <th class="text-center">Máx.</th>
                <th class="text-center">Min.</th>
                <!--A las-->
                <th class="text-center">Máx.</th>
                <th class="text-center">Min.</th>
                <!--Ult 30 dias-->
                <th class="text-center">Máx.</th>
                <th class="text-center">Min.</th>
            </tr>
            </thead>
            <tbody>
            <tr class="text-center">
                <td>
                    {{this.temperaturaActual.temperatura}} ºC
                </td>
                <td>
                    {{this.temperaturaMax.temperatura}} ºC
                </td>
                <td>
                    {{this.temperaturaMin.temperatura}} ºC
                </td>
                <td>
                    {{this.temperaturaMax.fecha}}
                </td>
                <td>
                    {{this.temperaturaMin.fecha}}
                </td>
                <td>
                    {{this.temperaturaMaxMonthly}} ºC
                </td>
                <td>
                    {{this.temperaturaMinMonthly}} ºC
                </td>
            </tr>
            </tbody>
        </table>
        <div class="grafico">
            <canvas id="temperatureChart" height="100"></canvas>
        </div>
    </div>

</template>

<script>
    export default {
        data: function () {
            return {
                temperaturaMax: {},
                temperaturaMin: {},
                temperaturaActual: {},
                temperaturaMaxMonthly: {},
                temperaturaMinMonthly: {},
                labels: {},
                data:{}
            }
        },
        methods: {
            getTemperatura: function () {
                axios.get('temperatura/getTemperaturaMax').then(res => {
                    this.temperaturaMax = res.data;
                });

                axios.get('temperatura/getTemperaturaMin').then(res => {
                    this.temperaturaMin = res.data;
                });

                axios.get('temperatura/getTemperaturaActual').then(res => {
                    this.temperaturaActual = res.data;
                });

                axios.get('temperatura/getTemperaturaMaxMonthly').then(res => {
                    this.temperaturaMaxMonthly = res.data;
                });

                axios.get('temperatura/getTemperaturaMinMonthly').then(res => {
                    this.temperaturaMinMonthly = res.data;
                });
            },
            getDataChart: function(){
                axios.get('temperatura/getDataChart').then(res => {
                   this.data = res.data;
                    this.chart();
                });
            },
            getLabels: function () {
                axios.get('temperatura/getLabels').then(res => {
                    this.labels = res.data;
                    this.getDataChart();
                });
            },
            chart: function () {
                var labels = [];
                var dataMax=[];
                var dataMin=[];
                var dataAVG=[];

                for (var i = 0; i < (this.labels).length; i++) {
                    labels.push(this.labels[i].label_chart);
                }

                for (var i = 0; i < (this.data).length; i++) {
                   dataMax.push(this.data[i].max);
                   dataMin.push(this.data[i].min);
                   dataAVG.push(this.data[i].avg);
                 //   labels.push(this.labels[i].label_chart);
                }


                var ctx = document.getElementById("temperatureChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Máximo',
                                data: dataMax,
                                backgroundColor: 'transparent',
                                borderColor: 'red',
                            },
                            {
                                label: 'Mínimo',
                                data: dataMin,
                                backgroundColor: 'transparent',
                                borderColor: 'blue',
                            },
                            {
                                label: 'Promedio',
                                data: dataAVG,
                                backgroundColor: 'transparent',
                                borderColor: 'green',
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        },
        mounted() {
            this.getTemperatura();
            this.getLabels();
        }
    }
</script>
