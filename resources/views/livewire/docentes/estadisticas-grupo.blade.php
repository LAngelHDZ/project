<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="grid grid-cols-2 gap-4 mt-5 mb-5">
        <div class="shadow rounded-lg bg-white">
            <figure class="highcharts-figure">
                <div id="container"></div>
            </figure>
        </div> 
        <div class="shadow rounded-lg bg-white">
            <div id="containerOther" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('highcharts/code/highcharts.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/exporting.js') }} "></script>
<script src="{{ asset('highcharts/code/modules/export-data.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/accessibility.js') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        graficaUnidades(@this.unidades, @this.aprobados, @this.reprobados);
        graficaCurso(@this.cursoAprobados,@this.cursoReprobados);
    });

    function graficaUnidades(unidades, aprobados, reprobados){
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Alumnos aprobados y reprobados por unidad'
            },
            xAxis: {
                categories: unidades
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total de alumnos'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: ( // theme
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -30,
                verticalAlign: 'top',
                y: 25,
                floating: true,
                backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [{
                name: 'Aprobados',
                data: aprobados,
                color: '#aaff99'
            }, {
                name: 'Reprobados',
                data: reprobados
            }]
        });
    }
    
    function graficaCurso(aprobados, reprobados){
        // Radialize the colors
        Highcharts.setOptions({
            colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
                return {
                    radialGradient: {
                        cx: 0.5,
                        cy: 0.3,
                        r: 0.7
                    },
                    stops: [
                        [0, color],
                        [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
                    ]
                };
            })
        });
        
        // Build the chart
        Highcharts.chart('containerOther', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Alumnos aprobados y reprobados del curso'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        connectorColor: 'silver'
                    }
                }
            },
            series: [{
                name: 'Alumnos',
                data: [
                    { name: 'Aprobados', y: aprobados },
                    { name: 'Reprobados', y: reprobados },
                ]
            }]
        });
    }
</script>
@endpush
