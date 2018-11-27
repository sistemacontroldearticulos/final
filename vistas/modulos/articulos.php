<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Articulos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Articulos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btn-circle btn-xl" data-toggle="modal" data-target="#modalAgregarArticulo" title="Agregar Articulo">

          <i class="fa fa-plus"></i>

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>

           <th style="width:100px">Acciones</th> 
           <th style="width:10px">ID</th>
           <th>Tipo Articulo</th>
           <th>Modelo Articulo</th>
           <th>Marca Articulo</th>
           <th>Estado</th>
           <th>Ambiente</th>
           <th>Categoría</th>
           <th>Equipo</th>
           <th>Numero Inventario Sena</th>
           <th>Serial Articulo</th>
           <th>Caracteristicas</th>

         </tr>

        </thead>

         <tbody>
           <?php

            $item      = null;
            $valor     = null;
            $respuesta = ControladorArticulos::ctrMostrarArticulos($item, $valor);
            // var_dump($respuesta);

            foreach ($respuesta as $key => $value) {

              $item    = "IdEquipo";
              $valor   = $value["idequipo"];
              
              $equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor);
              echo '<tr>
              <td>
                            <div class="btn-group">
                                <button title="Editar" class="btn btn-circle btn-lg btn-warning btnEditarArticulo" idArticulo="' . $value["idarticulo"] . '"  data-toggle="modal" data-target="#modalEditarArticulo">
                                    <i class="fa fa-pencil">
                                    </i>
                                </button>
                                <button title="Eliminar" class="btn btn-circle btn-lg btn-danger btnEliminarArticulo" idArticulo="' . $value["idarticulo"] . '"><i class="fa fa-times"></i></button>
                            </div>
                        </td>
                      <td>' . $value["idarticulo"] . '</td>
                      <td>' . $value["tipoarticulo"] . '</td>
                      <td>' . $value["modeloarticulo"] . '</td>
                      <td>' . $value["marcaarticulo"] . '</td>';

                if ($value["estadoarticulo"] == "ACTIVO") {
                    echo '<td><button class="btn btn-success btn-sm">ACTIVO</button></td>';
                } else if ($value["estadoarticulo"] == "DAÑADO") {
                    echo '<td><button class="btn btn-warning btn-sm">DAÑADO</button></td>';
                } else {
                    echo '<td><button class="btn btn-danger btn-sm">PERDIDO</button></td>';
                }

                $item  = "IdAmbiente";
                $valor = $value["idambiente"];

                $ambiente = ControladorAmbientes::ctrMostrarAmbientes($item, $valor);
                echo '<td>' . $ambiente["nombreambiente"] . '</td>';

                $item  = "IdCategoria";
                $valor = $value["idcategoria"];

                $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                echo '<td>' . $categoria["nombrecategoria"] . '</td>

                        <td>' . $equipos["nombreequipo"] . " " . $equipos["idequipo"] . '</td>

                        <td>' . $value["numinventariosena"] . '</td>

                         <td>' . $value["serialarticulo"] . '</td>

                        <td>' . $value["caracteristicaarticulo"] . '</td>

                        
                    </tr>';
                // var_dump($value["IdArticulo"]);
            }
            ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!-- MODAL AGREGAR ARTICULO -->
<div id="modalAgregarArticulo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header cabeza-modal" >

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Articulo</h4>

        </div>


        <div class="modal-body">

          <!-- CUERPO DEL MODAL -->
          <div class="box-body">


            <div class="form-group row">

              <!-- ENTRADA PARA EL TIPO ARTICULO -->
              <div class="col-xs-6 ">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/articulos.png" width="15px">
                </span>

                  <input type="text" class="form-control input-lg" name="nuevoTipo" placeholder="Tipo Articulo" required>

                </div>

              </div>

              <!-- ENTRADA PARA EL MODELO ARTICULO -->
              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/modelos1.png" width="15px">
                </span>

                  <input type="text" class="form-control input-lg" name="nuevoModelo"placeholder="Modelo Articulo" >

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

                  <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Marca Articulo" >

                </div>

              </div>

              <!-- ENTRADA PARA EL SERIAL ARTICULO -->
              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/serial1.png" width="15px">
                </span>

                  <input type="text" class="form-control input-lg" name="nuevoSerial" id="nuevoSerial" placeholder="Serial del Articulo">

                </div>

              </div>

            </div>
  
            <!-- ENTRADA PARA SELECCIONAR AMBIENTE -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ambientes.png" width="15px">
                </span>

                <select class="form-control input-lg" name="nuevoAmbiente" required>

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

              </div>

            </div>

             <!-- ENTRADA PARA SELECCIONAR EQUIPO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/equipos.png" width="15px">
                </span>

                <input type="hidden" name="equipo" id="equipo">

                <select class="form-control input-lg" name="nuevoEquipo" id="nuevoEquipo"onchange="equipoFuncion(this.value)">


                  <option value="">Seleccionar Equipo</option>
                  <?php

$item  = null;
$valor = null;

$equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor);

foreach ($equipos as $key => $value) {

    echo '<option value="' . $value["idequipo"] . '">' . $value["nombreequipo"] . '</option>';
}

?>

                </select>

              </div>

            </div>

             <!-- ENTRADA PARA SELECCIONAR CATEGORIAS -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/categorias.png" width="15px">
                </span>

                <select class="form-control input-lg" name="nuevaCategoria" required>

                  <option value="">Seleccionar Categoria</option>
                  <?php

$item  = null;
$valor = null;

$ambiente = ControladorCategorias::ctrMostrarCategorias($item, $valor);

foreach ($ambiente as $key => $value) {

    echo '<option value="' . $value["idcategoria"] . '">' . $value["nombrecategoria"] . '</option>';
}

?>

                </select>

              </div>


            </div>

            <div class="form-group row">

              <!-- ENTRADA PARA EL INVENTARIO SENA -->
              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/codigo.png" width="15px">
                </span>

                  <input type="text" class="form-control input-lg" name="nuevoInventario" id="nuevoInventario" min="0" placeholder="Numero Inventario SENA">

                </div>

              </div>

              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/estado.png" width="15px">
                </span>

                  <select class="form-control input-lg" name="nuevoEstado" required>

                    <option value="">Seleccionar Estado</option>
                    <option value="ACTIVO">Activo</option>
                    <option value="DAÑADO">Dañado</option>
                    <option value="PERDIDO">Perdido</option>

                  </select>

                </div>

              </div>
              
            </div>

            
             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/observaciones.png" width="15px">
                </span>

                 <textarea class="form-control rounded-5" name="nuevaCaracteristica" rows="3" placeholder="INGRESE CARACTERÍSTICAS DEL ARTICULO"></textarea>
                 <!-- <input type="text" class="form-control input-lg" name="nuevaCaracteristica" min="0" placeholder="Ingrese la característica del artículo"> -->

              </div>

            </div>
          </div>
        </div>
        <!-- PIE DEL MODAL -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Articulo</button>

        </div>

        <?php
$crearArticulo = new ControladorArticulos();
$crearArticulo->ctrCrearArticulos();
?>

      </form>

    </div>

  </div>

</div>


<!-- MODAL EDITAR ARTICULO -->
<div id="modalEditarArticulo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header cabeza-modal" >

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Articulo</h4>

        </div>


        <div class="modal-body">

          <!-- CUERPO DEL MODAL -->
          <div class="box-body">

            <div class="form-group row">
              
            <!-- ENTRADA PARA EL TIPO ARTICULO -->
            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/articulos.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="editarTipo" id="editarTipo" placeholder="Tipo Articulo" required>

                <input type="hidden" name="idArticulo" id="idArticulo">

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO ARTICULO -->
            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/modelo.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="editarModelo" id="editarModelo" min="0" placeholder="Modelo Articulo" required>

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

                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca" placeholder="Marca Articulo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL SERIAL ARTICULO -->
            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/serial1.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="editarSerial" id="editarSerial" min="0" placeholder="Serial del Articulo">

              </div>

            </div>

          </div>

            <!-- ENTRADA PARA SELECCIONAR AMBIENTE -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ambientes.png" width="15px">
                </span>

                <select class="form-control input-lg" name="idAmbiente" id="editarAmbiente">

                  <!-- <option id="editarAmbiente"></option> -->
                   <option value="">Sin Ambiente</option>
                  <?php

                    $item  = null;
                    $valor = null;

                    $ambiente = ControladorAmbientes::ctrMostrarAmbientes($item, $valor);

                    foreach ($ambiente as $key => $value) {

                        echo '<option value="' . $value["idambiente"] . '">' . $value["nombreambiente"] . '</option>';
                    }

                    ?>
                </select>

              </div>

            </div>

             <!-- ENTRADA PARA SELECCIONAR EQUIPO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/equipos.png" width="15px">
                </span>

                <input type="hidden" name="equipo" id="equipo">

                <select class="form-control input-lg" name="idEquipo" id="editarEquipo" onchange="equipoFuncion1(this.value)">

                  <!-- <option id="editarEquipo"></option> -->
                  <option value="">Sin Equipo</option>
                  <?php

$item  = null;
$valor = null;

$equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor);

foreach ($equipos as $key => $value) {

    echo '<option value="' . $value["idequipo"] . '">' . $value["nombreequipo"] . '</option>';
}

?>
                </select>



              </div>

            </div>

             <!-- ENTRADA PARA SELECCIONAR CATEGORIAS -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/categorias.png" width="15px">
                </span>

                <select class="form-control input-lg" name="idCategoria" id="editarCategoria">

                  <!-- <option id="editarCategoria"></option> -->
                  <option value="">Sin Categoria</option>
                  <?php

$item  = null;
$valor = null;

$ambiente = ControladorCategorias::ctrMostrarCategorias($item, $valor);

foreach ($ambiente as $key => $value) {

    echo '<option value="' . $value["idcategoria"] . '">' . $value["nombrecategoria"] . '</option>';
}

?>

                </select>

              </div>

            </div>

            <div class="form-group row">

            <!-- ENTRADA PARA EL INVENTARIO SENA -->
            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/codigo.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="editarInventario" id="editarInventario"  placeholder="Numero Inventario SENA">

              </div>

            </div>

            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/estado.png" width="15px">
                </span>

                <select class="form-control input-lg" name="editarEstado" id="editarEstado">

                  <!-- <option id="editarEstado">Selecionar Estado</option> -->
                  <option value="ACTIVO">Activo</option>
                  <option value="DAÑADO">Dañado</option>
                  <option value="PERDIDO">Perdido</option>

                </select>

              </div>

            </div>
          </div>

             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/observaciones.png" width="15px">
                </span>

                 <textarea class="form-control rounded-5" name="editarCaracteristica" id="editarCaracteristica" rows="3" placeholder="INGRESE CARACTERÍSTICAS DEL ARTICULO"></textarea>
                 <!-- <input type="text" class="form-control input-lg" name="nuevaCaracteristica" min="0" placeholder="Ingrese la característica del artículo"> -->

              </div>

            </div>
          </div>
        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="actualizarArticulo">Guardar Cambios</button>

        </div>
        <?php
          $editarArticulo = new ControladorArticulos();
          $editarArticulo->ctrEditarArticulos();
        ?>

      </form>

    </div>

  </div>

</div>

<?php
  $eliminarArticulo = new ControladorArticulos();
  $eliminarArticulo->ctrBorrarArticulo();
?>

