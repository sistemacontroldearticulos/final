<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Administrar Reportes
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="inicio">
                    <i class="fa fa-dashboard">
                    </i>
                    Inicio
                </a>
            </li>
            <li class="active">
                Administrar Reportes
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
            	
	                <button type="button" class="btn btn-primary pull-left " id="daterange-btn">
	                    <span>
	                        <i class="fa fa-calendar"></i> Rango de Fechas
	                        <i class="fa fa-caret-down"></i>
	                    </span>
	                </button>

	                <?php 

	                if (isset($_GET["fechaInicial"])) {

	                	echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

	                }else{

	                	echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';
	                
	                }

	                ?>
	                
	                	<button class="btn btn-success pull-right">
		                    Descargar Reporte en Excel
		                </button>
	                </a>
                
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>ID Novedad</th>
                            <th>Fecha</th>
                            <th>Articulo</th>
                            <th>Tipo</th>
                            <th>Ambiente</th>
                            <th>Ficha</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

						if (isset($_GET["fechaInicial"])) {

							$fechaInicial = $_GET["fechaInicial"];
							$fechaFinal   = $_GET["fechaFinal"];

						} else {


							$fechaInicial = null;
							$fechaFinal   = null;

						}

// $item = null;
// $valor = null;

						// var_dump($fechaInicial);
						// var_dump($fechaFinal);
                        // $respuesta = ControladorReportes::ctrMostrarReportes($item, $valor);
                        $respuesta = ControladorReportes::ctrRangoFechasReportes($fechaInicial, $fechaFinal);
						
						
						if($respuesta != null){
						
						$a=0;
							foreach ($respuesta as $key => $value) {
								echo '<tr>';
										

							  $item1 = "idnovedad";
							  $valor1 = $value["idnovedad"];
							  $novedad = ControladorArticulos::ctrMostrarArticuloNovedad($item1, $valor1); 
							  
							  foreach($novedad as $key1 => $value1) {
								  
								  $item2 = "idarticulo";
								$valor2 = $novedad[$key1]["idarticulo"];
								$articulo = ControladorArticulos::ctrMostrarArticulos($item2, $valor2);
								
								  $item3 = "numdocumentousuario";
								  $valor3 = $value["numdocumentousuario"];
								  $usuario = ControladorUsuarios::ctrMostrarUsuarios($item3, $valor3); 
								  

								  $item4 = "idambiente";
								  $valor4 = $articulo["idambiente"];
								  $ambiente = ControladorAmbientes::ctrMostrarAmbientes($item4, $valor4);

								  $item5 = "idambiente";
								  $valor5 = $articulo["idambiente"];
								  $ficha = ControladorFichas::ctrMostrarFichas($item5, $valor5);

									   echo'
									   <td>'.($a= $a+1).'</td>
									   <td>'.$value["idnovedad"].'</td>
									   <td>'.$value["fechanovedad"].'</td>
											<td>'.$articulo["tipoarticulo"].'</td>
											<td>'.$novedad[0]["tiponovedad"].'</td>
											<td>'.$ambiente["nombreambiente"].'</td>
											<td>'.$ficha["numeroficha"].'</td>
											<td>'.$usuario["nombreusuario"].'</td>
									</tr>';
							  
							  }


							}
							
						}
						?>


                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
