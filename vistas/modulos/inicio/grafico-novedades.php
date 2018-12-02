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
      { y: '2011 Q1', item1: 12 },
      { y: '2011 Q2', item1: 12 },
      { y: '2011 Q3', item1: 12 },
      { y: '2011 Q4', item1: 12 },
      { y: '2011 Q1', item1: 12 },
      { y: '2011 Q2', item1: 12 },
      { y: '2011 Q3', item1: 12 },
      { y: '2011 Q4', item1: 12 },
      { y: '2011 Q1', item1: 12 },
      { y: '2011 Q2', item1: 12 }
    ],
    xkey             : 'y',
    ykeys            : ['item1'],
    labels           : ['Item 1'],
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