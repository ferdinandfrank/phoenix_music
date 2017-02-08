<template>
    <canvas ref="chart" width="400" height="400"></canvas>
</template>

<script>
    import Chart from 'chart.js';

    export default {
        props: {
            /**
             * The type of the chart.
             * Valid values: 'bar', 'line'
             */
            type: {
                type: String,
                default: 'bar',
                required: true
            },
            labels: {
                type: Array,
                required: true
            },
            title: {
                type: String
            },
            data: {
                type: Array,
                required: true
            },
            bgColors: {
                type: Array|String,
                default: "rgba(240,130,10,0.7)"
            },
            borderColors: {
                type: Array
            },
            borderWidth: {
                type: Number,
                default: 1
            }
        },
        mounted () {
            new Chart(this.$refs.chart, {
                type: this.type,
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: this.title,
                        data: this.data,
                        backgroundColor: this.bgColors,
                        borderColor: this.borderColors,
                        borderWidth: this.borderWidth
                    }]
                },
                options: {

                }
            });
        }
    }
</script>
