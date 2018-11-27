<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Administrar Actas De Responsabilidad
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
                Administrar Actas De Responsabilidad
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
              <button class="btn btn-primary btn-circle btn-xl" data-toggle="modal" data-target="#modalAgregarActa" title="Agregar Acta">
                <i class="fa fa-plus"></i>
              </button>

              <button class="btn btn-primary btn-circle btn-xl " data-toggle="modal" data-target="#modalImprimirFicha" title="Exportar Actas Ficha">
                <i class="fa fa-download"></i>
              </button>

            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width:50px">Imprimir</th>
                            <th style="width:50px">ID Acta</th>
                            <th>Documento Aprendiz</th>
                            <th>Nombre Aprendiz</th>
                            <th>ID Equipo</th>
                            <th>Fecha</th>
                            <th>Instructor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $item=null;
                        $valor= null;

                        $mostrarActas = ControladorActas::ctrMostrarActas($item, $valor);

                        foreach ($mostrarActas as $key => $value) {

                        echo '<tr>

                            <td>

                              <div class="btn-group">

                                <button title="Imprimir" class="btn btn-primary btn-circle btn-lg btnImprimirActa" codigo="'.$value["idacta"].'">
                                    <i class="fa fa-print"></i>
                                </button>

                                 <button title="Crear Acta De Compromiso" class="btn btn-warning btn-circle btn-lg btnCompromiso" data-toggle="modal" data-target="#modalActaCompromiso" codigoActa="'.$value["idacta"].'">
                                    <i class="fa fa-plus"></i>
                                </button>

                              </div>

                            </td>

                            <td>'.$value["idacta"].'</td>
                            <td>'.$value["numdocumentoaprendiz"].'</td>';

                            $item="numdocumentoaprendiz";
                            $valor= $value["numdocumentoaprendiz"];
                            $mostrarAprendiz= ControladorAprendiz::ctrMostrarAprendiz($item, $valor);

                            echo '<td>'.$mostrarAprendiz[0]["nombreaprendiz"].'</td>';

                            $item1 ="idequipo";
                            $valor1 = $value["idequipo"];
                            $mostrarEquipo= ControladorEquipos::ctrMostrarEquipos($item1, $valor1);

                            $item3 ="numdocumentousuario";
                            $valor3 = $value["numdocumentoinstructor"];
                            $usuario = ControladorUsuarios::ctrMostrarUsuarios($item3, $valor3);

                            

                            echo '<td>'.$mostrarEquipo["nombreequipo"].'</td>
                            <td>'.$value["fechaacta"].'</td>
                            <td>'.$usuario["nombreusuario"].'</td>



                            
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
<div class="modal fade" id="modalAgregarActa" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" role="form">
                <!-- CABEZA DEL MODAL -->
                <div class="modal-header cabeza-modal">
                    <button class="close" data-dismiss="modal" type="button">
                        x
                    </button>
                    <h4 class="modal-title">
                        Agregar Acta Responsabilidad
                    </h4>
                </div>
                <div class="modal-body">
                    <!-- CUERPO DEL MODAL -->
                    <div class="box-body">
                        <!-- ENTRADA PARA FICHA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <img src="vistas/img/plantilla/iconos/fichas.png" width="15px">
                                </span>
                                <input class="form-control input-lg" name="ficha" id="ficha"
                                placeholder="Ingrese Ficha" required type="number" required>
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL DOCUMENTO APRENDIZ -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <img src="vistas/img/plantilla/modal/ndocumentos.png" width="15px">
                                    </i>
                                </span>
                                <select class="form-control input-lg" name="aprendices" id="aprendices" required>

                                <option value="">Seleccione el Aprendiz</option>
                 
                                </select> 
                            </div>
                        </div>
                       <div class="input-group">

                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/equipos.png" width="15px">
                </span>

                <select class="form-control input-lg" name="equipos" id="equipos" required>

                  <option id="opcionEquipo" value="">Seleccione El Equipo</option>
                 
                </select> 

              </div>
                       
                    </div>
                </div>
                <!-- PIE DEL MODAL -->
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Salir
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Guardar Acta
                    </button>
                </div>

                 <?php 
                  $crearActa = new ControladorActas();
                  $crearActa -> ctrCrearActa();
                 ?>
            </form>
        </div>
    </div>
</div>


<!-- MODAL AGREGAR ACTA COMPROMISO -->
<div class="modal fade modalActaCompromiso" id="modalActaCompromiso" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" role="form">
                <!-- CABEZA DEL MODAL -->
                <div class="modal-header cabeza-modal">
                    <button class="close" data-dismiss="modal" type="button">
                        x
                    </button>
                    <h4 class="modal-title">
                        Agregar Acta Compromiso
                    </h4>
                </div>
                <div class="modal-body">
                    <!-- CUERPO DEL MODAL -->
                    <div class="box-body">
                        <!-- ENTRADA PARA FICHA -->
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon">
                                    <img src="vistas/img/plantilla/iconos/fichas.png" width="15px">
                                </span>
                                <input class="form-control input-lg" name="aprendizActa" id="aprendizActa"
                                 type="text" readonly required>

                                <input id="idAprendiz" name="idAprendiz" type="hidden">
                            </div>
                        </div>
                        <!-- ENTRADA PARA EL DOCUMENTO APRENDIZ -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <img src="vistas/img/plantilla/modal/ndocumentos.png" width="15px">
                                    </i>
                                </span>
                                <input class="form-control input-lg" name="equipoActa" id="equipoActa"
                                 type="text" readonly required>
    
                                 <input id="idEquipo" name="idEquipo" type="hidden">
                                 <input id="idActaResponsabilidad" name="idActaResponsabilidad" type="hidden">
                            </div> 
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <img src="vistas/img/plantilla/modal/ndocumentos.png" width="15px">
                                    </i>
                                </span>
                                <select class="form-control input-lg" name="articulos" id="articulos" required>

                                <option value="">Seleccione el Articulo</option>
                 
                                </select> 
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                            <input type="text" class="form-control input-lg" name="fechaActa" placeholder="Ingrese Fecha Limite" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask  required">

                          </div>
                        </div>
                       
                    </div>
                </div>
                <!-- PIE DEL MODAL -->
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Salir
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Guardar Acta
                    </button>
                </div>

                 <?php 
                  $crearActaCompromiso = new ControladorActas();
                  $crearActaCompromiso -> ctrCrearActaCompromiso();
                 ?>
            </form>
        </div>
    </div>
</div>

<!-- MODAL AGREGAR PROGRAMA -->
<div class="modal fade" id="modalImprimirFicha" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" role="form">
                <!-- CABEZA DEL MODAL -->
                <div class="modal-header cabeza-modal">
                    <button class="close" data-dismiss="modal" type="button">
                        x
                    </button>
                    <h4 class="modal-title">
                        Descargar Actas Ficha
                    </h4>
                </div>
                <div class="modal-body">
                    <!-- CUERPO DEL MODAL -->
                    <div class="box-body">
                        <!-- ENTRADA PARA FICHA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <img src="vistas/img/plantilla/iconos/fichas.png" width="15px">
                                </span>
                                <input class="form-control input-lg" name="ficha" id="fi"
                                placeholder="Ingrese Ficha" required type="number">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PIE DEL MODAL -->
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Salir
                    </button>
                    <button class="btn btn-primary" class="ExportarActa" type="submit">
                        Exportar PDF
                    </button>
                </div> 

                <?php 

                $Exportar = New ControladorActas();
                $Exportar -> ctrExportarActasFicha();

                 ?>
            </form>
        </div>
    </div>
</div>