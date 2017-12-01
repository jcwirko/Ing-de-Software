<template>

    <div class="well">
        <h3>Humedad</h3>
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
                    {{this.humedadActual.humedad}} %
                </td>
                <td>
                    {{this.humedadMax.humedad}} %
                </td>
                <td>
                    {{this.humedadMin.humedad}} %
                </td>
                <td>
                    {{this.humedadMax.fecha}}
                </td>
                <td>
                    {{this.humedadMin.fecha}}
                </td>
                <td>
                    {{this.humedadMaxMonthly}} %
                </td>
                <td>
                    {{this.humedadMinMonthly}} %
                </td>
            </tr>
            </tbody>
        </table>
        <div class="grafico">
            <canvas id="humedadChart" height="100"></canvas>
        </div>
    </div>

</template>

<script>
    export default {
        data: function () {
            return {
                humedadMax: {},
                humedadMin: {},
                humedadActual: {},
                humedadMaxMonthly: {},
                humedadMinMonthly: {},
                labels: {},
                data:{}
            }
        },
        methods: {
            getHumedad: function () {
                axios.get('humedad/getHumedadMax').then(res => {
                    this.humedadMax = res.data;
                });

                axios.get('humedad/getHumedadMin').then(res => {
                    this.humedadMin = res.data;
                });

                axios.get('humedad/getHumedadActual').then(res => {
                    this.humedadActual = res.data;
                });

                axios.get('humedad/getHumedadMaxMonthly').then(res => {
                    this.humedadMaxMonthly = res.data;
                });

                axios.get('humedad/getHumedadMinMonthly').then(res => {
                    this.humedadMinMonthly = res.data;
                });
            },
            getDataChart: function(){
                axios.get('humedad/getDataChart').then(res => {
                   this.data = res.data;
                    this.chart();
                });
            },
            getLabels: function () {
                axios.get('humedad/getLabels').then(res => {
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


                var ctx = document.getElementById("humedadChart").getContext('2d');
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
            this.getHumedad();
            this.getLabels();
        }
    }
</script>
