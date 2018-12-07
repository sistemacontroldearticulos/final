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


                  <select class="form-control select2 input-sm" name="ambienteFiltro" id="ambienteFiltro" style="width: 30%;" >
                    <option value="">Seleccionar Ambiente</option>
                    <?php

                        $item  = null;
                        $valor = null;

                        $ambiente = ControladorAmbientes::ctrMostrarAmbientes($item, $valor);

                        foreach ($ambiente as $key => $value) {

                            echo '<option value="' . $value["idambiente"] . '">' . $value["nombreambiente"] . '</option>';
                        }

                        ?>
                  </select>

	                <?php 

	                if (isset($_GET["fechaInicial"])) {

	                	echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'&ambiente='.$_GET["ambiente"].'">';

	                }
                  else{

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
                        	<th style="width:50px">Detalles</th>
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
              $idAmbiente =$_GET["ambiente"];

						} else {


							$fechaInicial = null;
							$fechaFinal   = null;
              $idAmbiente =null;

						}

                        $respuesta = ControladorReportes::ctrRangoFechasReportes($fechaInicial, $fechaFinal, $idAmbiente);
						
						
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
									   <td>
											
											<div class="btn-group">

					                          <button title="Ver Detalles" class="btn btn-circle btn-lg btn-success btnVerDetalles btnBuscar2" data-toggle="modal" data-target="#modalVerDetalles" idNovedad="' . $value["idnovedad"] . '"><i class="fa fa-eye"></i></button>

					                        </div>

									   </td>
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


<!-- MODAL AGREGAR ARTICULO -->
<div id="modalVerDetalles" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header cabeza-modal" >

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalles Reporte</h4>

        </div>


        <div class="modal-body">

          <!-- CUERPO DEL MODAL -->
          <div class="box-body">

            <div class="form-group row">

            	<!-- ENTRADA PARA EL INVENTARIO SENA -->
              <div class="col-xs-6 ">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/articulos.png" width="15px">
                </span>

                  <input type="text" class="form-control input-lg" id="ReporteFecha" readonly>

                </div>

              </div>

              <!-- ENTRADA PARA EL MODELO ARTICULO -->
              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/modelos1.png" width="15px">
                </span>

                  <input type="text" class="form-control input-lg" id="ReporteAmbiente" readonly >

                </div>

              </div>

              <br>
              <br>
              <br>


              <!-- ENTRADA PARA EL TIPO ARTICULO -->
              <div class="col-xs-6 ">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/articulos.png" width="15px">
                </span>

                  <input type="text" class="form-control input-lg" id="ReporteArticulo" readonly>

                </div>

              </div>

              <!-- ENTRADA PARA EL MODELO ARTICULO -->
              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/modelos1.png" width="15px">
                </span>

                  <input type="text" class="form-control input-lg" id="ReporteTipo" readonly >

                </div>

              </div>
              <br>
              <br>
              <br>

              <!-- ENTRADA PARA LA MARCA -->
              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/marca.png" width="15px">
                </span>

                  <input type="text" class="form-control input-lg" id="ReporteFicha" readonly>

                </div>

              </div>

              <!-- ENTRADA PARA EL SERIAL ARTICULO -->
              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/serial1.png" width="15px">
                </span>

                  <input type="text" class="form-control input-lg" id="ReporteUsuario" readonly>

                </div>

              </div>

            </div>
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/observaciones.png" width="15px">
                </span>

                 <textarea class="form-control rounded-5" name="nuevaCaracteristica" id="ReporteCaracteristica"
                 readonly rows="3" placeholder="INGRESE CARACTERÍSTICAS DEL ARTICULO"></textarea>
                 <!-- <input type="text" class="form-control input-lg" name="nuevaCaracteristica" min="0" placeholder="Ingrese la característica del artículo"> -->

              </div>

            </div>

             <div class="form-group">


              <img src="vistas/img/usuarios/default/anonymous.png" id="ReporteImagen"class="img-thumbnail previsualizar" width="150px">


        </div>




             
          </div>
        </div>

      </form>

    </div>

  </div>

</div>

<div id="popUp" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>
