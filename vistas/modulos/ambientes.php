<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Ambientes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Ambientes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btn-circle btn-xl" data-toggle="modal" data-target="#modalAgregarAmbiente" title="Agregar ambiente">
          <i class="fa fa-plus"></i>
        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>
           <th style="width:30px">Acciones</th>   
           <th style="width:15px">#</th>
           <th>ID Ambiente</th>
           <th>Nombre</th>
           <th>Ubicación</th>
           <th>Programa</th>


         </tr>

        </thead>

        <tbody>
          <?php 
            $item=null;
            $valor= null;

            $mostrarAmbientes= ControladorAmbientes::ctrMostrarAmbientes($item, $valor);

            foreach ($mostrarAmbientes as $key => $value) {

                      echo '<tr>
                      <td>

                      <div class="btn-group">

                        <button title="Editar" class="btn btn-warning btn-circle btn-lg btnEditarAmbiente" data-toggle="modal" data-target="#modalEditarAmbiente" idAmbiente="'.$value["idambiente"].'"><i class="fa fa-pencil"></i></button>

                        <button title="Eliminar" class="btn btn-circle btn-lg btn-danger btnEliminarAmbiente" idAmbiente="'.$value["idambiente"].'"><i class="fa fa-times"></i></button>

                      </div>

                    </td>
                      <td>'.($key+1).'</td>
                    <td>'.$value["idambiente"].'</td>
                    <td>'.$value["nombreambiente"].'</td>
                    <td>'.$value["ubicacionambiente"].'</td>';
                    


          $item="IdPrograma";
          $valor= $value["idprograma"];

          $mostrarProgramas= ControladorProgramas::ctrMostrarProgramas($item, $valor);




                   echo '<td>'.$mostrarProgramas["nombreprograma"].'</td>

                  </tr>';
              
            }

           ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!-- MODAL AGREGAR AMBIENTE -->
<div id="modalAgregarAmbiente" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Ambiente</h4>

        </div>


        <div class="modal-body">

          <!-- CUERPO DEL MODAL -->
          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ambientes.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="nuevoAmbiente" id="nuevoAmbiente" placeholder="Ingrese Nombre de Ambiente" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA UBICACION -->
             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ubi.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="nuevaUbicacion"  id="nuevaUbicacion" placeholder="Ingrese Ubicacion de Ambiente">

              </div>

            </div>
          
        

        <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/programas.png" width="15px">
                </span>

                <select class="form-control select2 input-lg" name="idPrograma" id="idPrograma" style="width: 100%" required>
                  <option value="">Seleccionar Programa</option>
                    <?php
                    $item  = null;
                    $valor = null;

                    $programas = ControladorProgramas::ctrMostrarProgramas($item, $valor);

                    foreach ($programas as $key => $value) {
                        echo '<option value="' . $value["idprograma"] . '">' . $value["nombreprograma"] . '</option>';
                    }

                    ?>
                    </select>

              </div>

            </div>
</div>
</div>
        <!-- PIE DEL MODAL -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Ambiente</button>

        </div>
        <?php 
              $crearAmbiente= new ControladorAmbientes();
              $crearAmbiente->ctrCrearAmbientes();


         ?>

      </form>

    </div>

  </div>

</div>


<!-- MODAL EDITAR AMBIENTE -->
<div id="modalEditarAmbiente" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Ambiente</h4>

        </div>


        <div class="modal-body">

          <!-- CUERPO DEL MODAL -->
          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ambientes.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="editarAmbiente" id="editarAmbiente"required>

                <input type="hidden" name="idAmbiente" id="idAmbiente">

              </div>

            </div>

            <!-- ENTRADA PARA LA UBICACION -->
             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ubi.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="editarUbicacion"  id="editarUbicacion" placeholder="Ingrese Ubicacion de Ambiente">

              </div>

            </div>
          
        

        <div class="form-group" style="background: #f39c12">

              <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/programas.png" width="15px">
                </span>

                <select  class="form-control select2 input-lg" name="idPrograma"  id="idPrograma"style="width: 100%" required>
                
                  <option value="" >Sin Programa</option>
                  

                    <?php

                    $item  = null;
                    $valor = null;

                    $programas = ControladorProgramas::ctrMostrarProgramas($item, $valor);

                    foreach ($programas as $key => $value) {
                        echo '<option value="' . $value["idprograma"] . '">' . $value["nombreprograma"] . '</option>';
                    }

                    ?>
                    </select>

              </div>

            </div>
</div>
</div>
        <!-- PIE DEL MODAL -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>
        <?php 
          $editarAmbiente= new ControladorAmbientes();
          $editarAmbiente->ctrEditarAmbientes();
        ?>

      </form>

    </div>

  </div>

</div>

<!-- </div> -->
<?php 
  $eliminarAmbiente = new ControladorAmbientes();
  $eliminarAmbiente -> ctrEliminarAmbientes();
?>
