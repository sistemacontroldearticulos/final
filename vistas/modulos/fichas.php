<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Fichas

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Fichas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btn-circle btn-xl" data-toggle="modal" data-target="#modalAgregarFicha" title="Agregar Ficha">

          <i class="fa fa-plus"></i>
        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>

           <th style="width:70px">Acciones</th>   
           <th style="width:15px">#</th>
           <th>Numero Ficha</th>
           <th>Programa</th>
           <th>Ambiente</th>
           <th>Fecha Inicio</th>
           <th>Fecha Fin</th>
           <th>Jornada</th>

         </tr>

        </thead>

        <tbody>

          <?php

            $item  = null;
            $valor = null;

            $mostrarFichas = ControladorFichas::ctrMostrarFichas($item, $valor);

            foreach ($mostrarFichas as $key => $value) {


                echo '<tr>

                        <td>

                          <div class="btn-group">

                            <button title="Editar" class="btn btn-circle btn-lg btn-warning btnEditarFicha" idFicha="' . $value["numeroficha"] . '" data-toggle="modal" data-target="#modalEditarFicha"><i class="fa fa-pencil"></i></button>

                            <button title="Eliminar" class="btn btn-circle btn-lg btn-danger btnEliminarFicha" idFicha="' . $value["numeroficha"] . '"><i class="fa fa-times"></i></button>
                            
                            <button title="Ver Aprendices" class="btn btn-circle btn-lg btn-success btnVerAprendiz" id="' . $value["numeroficha"] . '" 
                             ><i class="fa fa-eye"></i></button>

                          </div>

                        </td>
                        <td>' . ($key + 1) . '</td>
                        <td>' . $value["numeroficha"] . '</td>';
                     
                        $item  = "IdPrograma";
                        $valor = $value["idprograma"];


                        $mostrarProgramas = ControladorProgramas::ctrMostrarProgramas($item, $valor);

                        echo ' <td>' . $mostrarProgramas["nombreprograma"] . '</td>';

                        $item  = "IdAmbiente";
                        $valor = $value["idambiente"];

                        $ambiente = ControladorAmbientes::ctrMostrarAmbientes($item, $valor);

                        echo '<td>' . $ambiente["nombreambiente"] . '</td>
                                 <td>' . $value["fechainicio"] . '</td>
                                 <td>' . $value["fechafin"] . '</td>
                                 <td>' . $value["jornadaficha"] . '</td>

                        

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
MODAL AGREGAR FICHA
======================================-->

<div id="modalAgregarFicha" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Ficha</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NUMERO DE FICHA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="number" class="form-control input-lg" name="nuevaFicha" id="nuevaFicha" placeholder="Ingrese Numero de Ficha" required>

                <input type="hidden" id="nficha">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR PROGRAMA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control select2 input-lg" name="nuevoPrograma" id="nuevoPrograma" style="width: 100%" required onchange="activarFechas()">


                  <option value="">Seleccionar Programa</option>

                  <?php

$item  = null;
$valor = null;

$programa = ControladorProgramas::ctrMostrarProgramas($item, $valor);

foreach ($programa as $key => $value) {

    echo '<option value="' . $value["idprograma"] . '">' . $value["nombreprograma"] . '</option>';
}

?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR AMBIENTE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control select2 input-lg" name="nuevoAmbiente" style="width: 100%" required >

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

            <!-- ENTRADA PARA JORNADA -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                    <select class="form-control input-lg" name="nuevaJornada" required>

                  <option value="">Seleccionar Jornada</option>
                  <option value="MAÑANA">Mañana</option>
                  <option value="TARDE">Tarde</option>
                  <option value="NOCHE">Noche</option>

                    </select>

              </div>

            </div>

            <div class="form-group row">

            <!-- ENTRADA PARA LA FECHA DE INICIO -->
            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" id="nuevaFechaInicio" name="nuevaFechaInicio" placeholder="Ingrese Fecha Inicio" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask  disabled required onchange="tiempo(this.value)">

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE FIN -->

            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" id="nuevaFechaFin" name="nuevaFechaFin" placeholder="Ingrese Fecha Fin" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask disabled>

              </div>

            </div>
            </div>

            <div class="form-group">

              <div class="panel">SUBIR ARCHIVO DE APRENDICES</div>

              <input type="file" class="nuevoExcel" name="nuevoExcel" id="nuevoExcel" required>
            </div>
</div>
</div>



        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Ficha</button>

        </div>
        <?php
$crearFicha = new ControladorFichas();
$crearFicha->ctrAgregarFichas();
?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR FICHA
======================================-->

<div id="modalEditarFicha" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Ficha</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NUMERO DE FICHA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="number" class="form-control input-lg" name="editarFicha" id="editarFicha" placeholder="Ingrese Numero de Ficha" readonly>

                <input type="hidden" id="idFicha">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR PROGRAMA -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control select2 input-lg" name="idPrograma" id="editarPrograma" style="width: 100%" onchange="activarFechas1()">


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

            <!-- ENTRADA PARA SELECCIONAR AMBIENTE -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control select2 input-lg" name="idAmbiente" id="editarAmbiente" style="width: 100%">

                  <?php

$item  = null;
$valor = null;

$mostrarAmbientes = ControladorAmbientes::ctrMostrarAmbientes($item, $valor);

foreach ($mostrarAmbientes as $key => $value) {
    echo '<option value="' . $value["idambiente"] . '">' . $value["nombreambiente"] . '</option>';
}

?>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA JORNADA -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                    <select class="form-control input-lg" name="editarJornada" required>

                  <option value="" id="editarJornada" >Seleccionar Jornada</option>
                  <option value="Mañana">Mañana</option>
                  <option value="Tarde">Tarde</option>
                  <option value="Noche">Noche</option>

                    </select>

              </div>

            </div>
            <div class="form-group row">

            <!-- ENTRADA PARA LA FECHA DE INICIO -->
            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" name="editarFechaInicio"  id="editarFechaInicio" placeholder="Ingrese Fecha Inicio" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask required disabled onchange="tiempo1(this.value)">

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA DE FIN -->

            <div class="col-xs-6">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control input-lg" id="editarFechaFin" name="editarFechaFin" disabled placeholder="Ingrese Fecha Fin" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask required>

              </div>

            </div>
            </div>


            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

        <?php
$editarFicha = new ControladorFichas();
$editarFicha->ctrEditarFichas();
?>

      </form>

    </div>

  </div>

</div>
<?php
$eliminarFicha = new ControladorFichas();
$eliminarFicha->ctrEliminarFicha();
?>

<?php
// echo '<input type="text" name="documento" id="documento"> ';

  $eliminarAprendiz = new ControladorFichas();
  $eliminarAprendiz -> ctrBorrarAprendiz();
?>

