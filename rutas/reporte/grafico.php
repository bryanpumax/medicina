<?php include("data.php");?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Highcharts Example</title>
	
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
	<script type="text/javascript">
$(function () {

    $('#container3').highcharts({

        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: 'StroomVerbruik'
        },

        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 6000,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 2,
                rotation: 'auto'
            },
            title: {
                text: 'Watt'
            },
            plotBands: [{
                from: 0,
                to: 1500,
                color: '#55BF3B' // green
            }, {
                from: 1500,
                to: 3000,
                color: '#DDDF0D' // yellow
            }, {
                from: 3000,
                to: 6000,
                color: '#DF5353' // red
            }]
        },

        series: [{
            name: 'Huidig verbruik',
            data: [0],
            tooltip: {
                valueSuffix: ' Watt'
            }
        }]

    },
        // Add some life
        function (chart) {
			if (!chart.renderer.forExport) {
                setInterval(function () {
                    var point = chart.series[0].points[0],
					newVal,
					inc = <?php echo respuesta();?>;
				
				newVal = inc;
				
				point.update(newVal);
				
                }, 1000);
			}
        });
});
		</script>
    </head>
    <body>




<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/highcharts-more.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>
<div id="container4" style="min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto"></div>

    </body>
</html> 