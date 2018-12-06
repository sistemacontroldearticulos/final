<div class="content-wrapper">
    <section class="content-header">

        <h1>
            Administrar Programas
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
                Administrar Programas
            </li>
        </ol>
        
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary btn-circle btn-xl" data-target="#modalAgregarPrograma" data-toggle="modal" title="Agregar Programa">
                    <i class="fa fa-plus"></i>
                    
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>

                            <th style="width:30px">Acciones</th>   
                            <th style="width:15px">#</th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Tipo de Programa
                            </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $item      = null;
                            $valor     = null;
                            $respuesta = ControladorProgramas::ctrMostrarProgramas($item, $valor);


                            foreach ($respuesta as $key => $value) {
                                echo '<tr>

                                        <td>
                                            <div class="btn-group">
                                                <button title="Editar" class="btn btn-warning btn-circle btn-lg btnEditarPrograma" idPrograma="' . $value["idprograma"] . '"  data-toggle="modal" data-target="#modalEditarPrograma">
                                                    <i class="fa fa-pencil">
                                                    </i>
                                                </button>
                                                <button title="Eliminar" class="btn btn-danger btn-circle btn-lg btnEliminarPrograma" idPrograma="' . $value["idprograma"] . '">
                                                    <i class="fa fa-times">
                                                    </i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            ' . ($key + 1) . '
                                        </td>
                                        <td>' . $value["nombreprograma"] . '
                                        </td>
                                        <td>
                                            ' . $value["tipoprograma"] . '
                                        </td>
                                     
                                        
                                    </tr>';
                            }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- MODAL AGREGAR PROGRAMA -->
<div class="modal fade" id="modalAgregarPrograma" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" role="form">
                <!-- CABEZA DEL MODAL -->
                <div class="modal-header cabeza-modal">
                    <button class="close" data-dismiss="modal" type="button">
                        x
                    </button>
                    <h4 class="modal-title">
                        Agregar Programa
                    </h4>
                </div>
                <div class="modal-body">
                    <!-- CUERPO DEL MODAL -->
                    <div class="box-body">
                        <!-- ENTRADA PARA EL PROGRAMA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <img src="vistas/img/plantilla/iconos/programas.png" width="15px">
                                    </i>
                                </span>
                                <input class="form-control input-lg" name="NuevoPrograma" id="NuevoPrograma"
                                placeholder="Nombre del Programa" required type="text">
                                </input>
                            </div>
                        </div>
                        <!-- ENTRADA PARA SELECCIONAR TIPO DE PROGRAMAL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                  <img src="vistas/img/plantilla/modal/programa.png" width="15px">
                                </span>
                                <select class="form-control input-lg" name="TipoPrograma" id="TipoPrograma" required onchange="duracion(this.value)">
                                    <option value="">
                                        Seleccione Tipo de Programa
                                    </option>
                                    <option value="TÉCNICO">
                                        Técnico
                                    </option>
                                    <option value="TECNÓLOGO">
                                        Tecnólogo
                                    </option>
                                    <option value="COMPLEMENTARIO">
                                        Complementario
                                    </option>
                                    <option value="ESPECIALIZACIÓN">
                                        Especialización
                                    </option>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/calendario.png" width="15px">
                </span>
                                <input class="form-control input-lg" name="nuevaDuracion"  id="nuevaDuracion" placeholder="Duración del Programa" type="text" required>
                                </input>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- PIE DEL MODAL -->
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Salir
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Guardar Programa
                    </button>
                </div>
<?php
$crearPrograma = new ControladorProgramas();
$crearPrograma->ctrCrearProgramas();

?>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalEditarPrograma" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" role="form">
                <!-- CABEZA DEL MODAL -->
                <div class="modal-header cabeza-modal">
                    <button class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                    <h4 class="modal-title">
                        Editar Programa
                    </h4>
                </div>
                <div class="modal-body">
                    <!-- CUERPO DEL MODAL -->
                    <div class="box-body">
                        <!-- ENTRADA PARA EL PROGRAMA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                  <img src="vistas/img/plantilla/modal/programas.png" width="15px">
                                </span>
                                <input class="form-control input-lg" name="EditarPrograma" id="EditarPrograma" required="" type="text" onclick="capturar(this.value)">
                                </input>
                                <input class="form-control input-lg" name="idPrograma" id="idPrograma" type="hidden">
                                </input>
                            </div>
                        </div>
                        <!-- ENTRADA PARA SELECCIONAR TIPO DE PROGRAMAL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                  <img src="vistas/img/plantilla/modal/programa.png" width="15px">
                                </span>
                                <select class="form-control input-lg" name="EditarTipoPrograma" id="EditarTipoPrograma" required onchange="duracion(this.value)" >
                                    <!-- <option value="" id="EditarTipoPrograma2">
                                        Selecionar Tipo de Programa
                                    </option> -->
                                    <option value="TÉCNICO">
                                        Técnico
                                    </option>
                                    <option value="TECNÓLOGO">
                                        Tecnólogo
                                    </option>
                                    <option value="COMPLEMENTARIO">
                                        Complementario
                                    </option>
                                    <option value="ESPECIALIZACIÓN">
                                        Especialización
                                    </option>
                                </select>
                            </div>
                        </div>
                       <!--  <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/calendario.png" width="15px">
                </span>
                                <input class="form-control input-lg" name="EditarDuracion" id="EditarDuracion" required="" type="text">
                                </input>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- PIE DEL MODAL -->
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Salir
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Guardar Cambios
                    </button>
                </div>
<?php
$editarPrograma = new ControladorProgramas();
$editarPrograma->ctrEditarPrograma();

?>
            </form>
        </div>
    </div>
</div>

<?php
$borrarPrograma = new ControladorProgramas();
$borrarPrograma->ctrBorrarPrograma();

?>


