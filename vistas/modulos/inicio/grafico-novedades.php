<?php 

  $item = null;
  $valor = null;
  $respuesta = ControladorNovedades::ctrMostrarNovedades($item, $valor);

  $arrayFechas = array();

  foreach ($respuesta as $key => $value) {

    $fecha = substr($value["fechanovedad"],0,-12);
    array_push($arrayFechas,$fecha);
    
  }

  $a = array_count_values($arrayFechas);

?>

<div class="box box-solid bg-teal-gradient">
	
	<div class="box-header">
		
 		<i class="fa fa-th"></i>

  		<h3 class="box-title">Gráfico de Novedades</h3>

	</div>

	<div class="box-body border-radius-none nuevoGraficoVentas">

		<div class="chart" id="line-chart" style="height: 250px;"></div>

  </div>

</div>

<script>
	var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [

    <?php foreach ($a as $key => $value){

      echo "{ y: '".$key."', novedades: '".$value."' },";
    }
    echo "{ y: '".$key."', novedades: '".$value."'}";

    ?>
    
    ],
    xkey             : 'y',
    ykeys            : ['novedades'],
    labels           : ['Novedades'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });
</script>