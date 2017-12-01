<template>

    <div class="well">
        <h3>Presión Barométrica</h3>
        <div >
            <canvas id="presionChart" height="100"></canvas>
        </div>
    </div>

</template>

<script>
    export default {
        data: function () {
            return {
                presionActual: {},
            }
        },
        methods: {
            getPresion: function () {

                axios.get('presion/getPresionActual').then(res => {
                    this.presionActual = res.data;
                    this.chart();
                });

            },
            chart: function () {
                var presion =this.presionActual.presion;
                var label = this.presionActual.label_chart;

                var ctx = document.getElementById("presionChart").getContext('2d');

                var myBarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Actual"],
                        datasets: [
                            {
                                label: "Population (millions)",
                                backgroundColor: ["#596d8c"],
                                data: [presion]
                            }
                        ]
                    },
                    options: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'Presión Barométrica actual (' +  presion + ' hPa)'
                        }
                    }
                });
            }
        }
        ,
        mounted() {
            this.getPresion();
        }
    }
</script>
