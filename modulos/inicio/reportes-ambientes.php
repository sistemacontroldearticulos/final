<?php 

  $item1 = null;
  $valor1 = null;
  $novedad = ControladorArticulos::ctrMostrarArticuloNovedad($item1, $valor1);

  $articulos = array();

  foreach ($novedad as $key => $value) {

    array_push($articulos, $value["idarticulo"]);

  }
  
  $ambientes = array();
  foreach ($articulos as $key => $value) {
    
    $item2 = "idarticulo";
    $valor2 = $value;
    $articulo = ControladorArticulos::ctrMostrarArticulos($item2, $valor2);

    $item4 = "idambiente";
    $valor4 = $articulo["idambiente"];
    $ambiente = ControladorAmbientes::ctrMostrarAmbientes($item4, $valor4);

    array_push($ambientes, $ambiente["nombreambiente"]);
    
  }
  $a = array_count_values($ambientes);

?>

<div class="box box-primary">
	
	<div class="box-header with-border">
    
    	<h3 class="box-title">Reportes de Ambientes</h3>
  
  	</div>

  	<div class="box-body">
  		
		<div class="chart-responsive">
			
			<div class="chart" id="bar-chart1" style="height: 300px;"></div>

		</div>

  	</div>

</div>

<script>
	
//BAR CHART
var bar = new Morris.Bar({
  element: 'bar-chart1',
  resize: true,
  data: [

  <?php foreach ($a as $key => $value){

    echo "{y: '".$key."', a: '".$value."'},";

  } 
  
  ?>
  ],
  barColors: ['#0af'],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['reportes'],
  hideHover: 'auto'
});


</script>