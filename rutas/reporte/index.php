<?php
require_once("../include/conexion.php");         
require_once("../include/head1.php");         
?>
<?php include("data.php");?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
 
		</style>
		<script type="text/javascript">
 
		 

$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
            }
        ,
        title: {
            text: 'Productos'
        },
   
        xAxis: {
            categories: [
			<?php
$sql=mysqli_query(conectar(),'SELECT  *     from tbl_inventario  where contar_inventario>=1 order by contar_inventario Desc ');
while($res=mysqli_fetch_array($sql)){	?>					
			
			['<?php echo $res['nomp_producto']; ?>'],
<?php
 
}
?>
]},
        series: [{
            name: ' ',
            data: [
			
			<?php
$sql=mysqli_query(conectar(),'SELECT  *     from tbl_inventario  where contar_inventario>=1 order by contar_inventario Desc  ');
while($res=mysqli_fetch_array($sql)){			
?>			
			
			[<?php echo $res['contar_inventario'] ?>],
			
<?php
}
?>
			]
        }],
        yAxis: {
        min: 1,
        title: {
            text: 'Solicitados'
        }}
    });
});

        
   
  
$(function () {
    $('#container2').highcharts({
        chart: {
            type: 'bar'
            }
        ,
        title: {
            text: 'Empresas '
        },
   
        xAxis: {
            categories: [
			<?php
$sql=mysqli_query(conectar(),'SELECT *,count(*) as contar FROM `v_pedido` GROUP BY cru_clientes asc');
while($res=mysqli_fetch_array($sql)){	?>					
			
			['<?php echo $res['emp_clientes']; ?>'],
<?php
 
}
?>
]},
        series: [{
            name: ' ',
            data: [
			
			<?php
$sql=mysqli_query(conectar(),'SELECT *,count(*) as contar FROM `v_pedido` GROUP BY cru_clientes asc');
while($res=mysqli_fetch_array($sql)){			
?>			
			
			[<?php echo $res['contar'] ?>],
			
<?php
}
?>
			]
        }],
        yAxis: {
        min: 1,
        title: {
            text: 'Pedidos'
        }}
    });
});

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
        text: 'CUMPLIEMIENTO DE  CITAS DE <?php  $mes=date("n");echo mes($mes);?>'
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
        max: 60,

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
            text: ''
        },
        plotBands: [{
            from: 0,
            to: 30,
            color: '#DF5353' // RED
        }, {
            from: 30,
            to: 60,
            color: '#55BF3B' // GREEN
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
<script src="Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>
 
<!--  -->
 

<script src="Highcharts-4.1.5/js/highcharts-more.js"></script>

<div id="container"  class="col-xs-12 col-md-6  col-sm-6   col-lg-6 " ></div>
 
<div id="container2" class="col-xs-12 col-md-6  col-sm-6   col-lg-6 "></div>
<div id="container3" style="min-width: 310px; max-width: 400px; height: 300px; margin: 0 auto"></div>


	</body>
</html>
<!--  SELECT *,count(*) as contar FROM `v_pedido` GROUP BY cru_clientes asc limit 5;  -->

