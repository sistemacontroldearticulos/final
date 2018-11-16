<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Equipos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Equipos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btn-circle btn-xl" data-toggle="modal" data-target="#modalAgregarEquipo" title="Agregar Equipo">

          <i class="fa fa-plus"></i>

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>

           <th style="width:30px">Acciones</th>   
           <th style="width:15px">#</th>
           <th>Nombre</th>
           <th>Estado</th>
           <th>Numero Articulos</th>
           <th>Numero Articulos Agregados</th>
           <th>Observaciones</th>

         </tr>

        </thead>

        <tbody>
           <?php

            $item = null;
            $valor = null;  

            $equipos = ControladorEquipos::ctrMostrarEquipos($item, $valor);

            foreach ($equipos as $key => $value) {


              echo '<tr>

                <td>

                    <div class="btn-group">

                      <button class="btn btn-circle btn-lg btn-warning btnEditarEquipo" idEquipo="'.$value["idequipo"].'" data-toggle="modal" data-target="#modalEditarEquipo"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-circle btn-lg btn-danger btnEliminarEquipo" idEquipo="'.$value["idequipo"].'"><i class="fa fa-times"></i></button>

                    </div>

                  </td>

                  <td>'.$value["idequipo"].'</td>

                  <td>'.$value["nombreequipo"].'</td>';

                  if($value["estadoequipo"]=="ACTIVADO")
                    {
                      echo '<td><button class="btn btn-success btn-sm">Activado</button></td>';
                    }
                    else if($value["estadoequipo"]=="DESACTIVADO")
                    {
                      echo '<td><button class="btn btn-danger btn-sm">Desactivado</button></td>';
                    }

                  echo '

                  <td>'.$value["numarticulosequipo"].'</td>
                  <td>'.$value["numarticulosagregados"].'</td>


                  <td>'.$value["observacionequipo"].'</td>

                  

                </tr>';
            }

          ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR EQUIPO
======================================-->

<div id="modalAgregarEquipo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/equipos.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="nuevoEquipo" id="nuevoEquipo" placeholder="Ingrese Nombre de Equipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA CANTIDAD ARTICULOS -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/cantidad.png" width="15px">
                </span>

                <input type="number" class="form-control input-lg" name="nuevaCantidad" placeholder="Ingrese Cantidad Articulos" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/estado.png" width="15px">
                </span>

                  <select class="form-control input-lg" name="nuevoEstado" required>

                    <option value="">Seleccionar Estado</option>
                    <option value="ACTIVADO">Activado</option>
                    <option value="DESACTIVADO">Desactivado</option>

                  </select>

              </div>

            </div>

            <!-- OBSERVACION EQUIPO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/observaciones.png" width="15px">
                </span>

                 <textarea class="form-control rounded-5" name="nuevaObservacion" rows="3" placeholder="INGRESE OBSERVACIONES DEL EQUIPO"></textarea>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Equipo</button>

        </div>

        <?php

          $crearCategoria = new ControladorEquipos();
          $crearCategoria -> ctrCrearEquipos();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR EQUIPO
======================================-->
<div id="modalEditarEquipo" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Equipo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/equipos.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="editarEquipo" id="editarEquipo" placeholder="Ingrese Nombre del Equipo" required>

                <input type="hidden" name="idEquipo" id="idEquipo">

                <input type=hidden name="agregados" id="agregados">

              </div>

            </div>

            <!-- ENTRADA PARA CANTIDAD ARTICULOS -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/cantidad.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="editarCantidad" id="editarCantidad" placeholder="Ingrese Cantidad Articulos" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/estado.png" width="15px">
                </span>

                  <select class="form-control input-lg" name="editarEstado"id="editarEstado" required>

                    <option value="ACTIVADO">Activado</option>
                    <option value="DESACTIVADO">Desactivado</option>

                  </select>

              </div>

            </div>

            <!-- OBSERVACION EQUIPO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/observaciones.png" width="15px">
                </span>

                 <textarea class="form-control rounded-5" name="editarObservacion" id="editarObservacion" rows="3" placeholder="INGRESE OBSERVACIONES DEL EQUIPO"></textarea>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>
        <?php

          $editarEquipos = new ControladorEquipos();
          $editarEquipos -> ctrEditarEquipos();

        ?>

      </form>

    </div>

  </div>

</div>

 <?php

  $eliminarEquipo = new ControladorEquipos();
  $eliminarEquipo -> ctrBorrarEquipo();

?>


