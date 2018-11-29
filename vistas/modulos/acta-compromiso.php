<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Administrar Actas De Compromiso
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
                Administrar Actas De Compromiso
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
              <button class="btn btn-primary btn-circle btn-xl" onclick=" location.href='actas' " title="Agregar Acta">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width:50px">Imprimir</th>
                            <th style="width:50px">ID Acta Responsabilidad</th>
                            <th style="width:50px">ID Acta Compromiso</th>
                            <th>Ficha</th>
                            <th>Nombre Instructor</th>
                            <th>Nombre Aprendiz</th>
                            <th>Fecha Creacion</th>
                            <th>Fecha Limite</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $item=null;
                        $valor= null;

                        $mostrarActas = ControladorActas::ctrMostrarActasCompromiso($item, $valor);

                        foreach ($mostrarActas as $key => $value) {

                        echo '<tr>

                            <td>

                              <div class="btn-group">

                                <button class="btn btn-primary btn-circle btn-lg btnImprimirActaCompromiso" title="Imprimir" codigo="'.$value["idacta_compromiso"].'">
                                    <i class="fa fa-print"></i>
                                </button>

                                
                              </div>

                            </td>

                            <td>'.$value["idacta_responsabilidad"].'</td>
                            <td>'.$value["idacta_compromiso"].'</td>';

                            $item1 = "idacta";
                            $valor1 = $value["idacta_responsabilidad"];
                            $acta = ControladorActas::ctrMostrarActas($item1, $valor1);
                        
                            $item2 = "numdocumentoaprendiz";
                            $valor2 = $acta["numdocumentoaprendiz"];
                            $mostrarAprendiz= ControladorAprendiz::ctrMostrarAprendiz($item2, $valor2);
                            
                            echo '<td>'.$mostrarAprendiz[0]["numeroficha"].'</td>';

                            $item3 ="idequipo";
                            $valor3 = $acta["idequipo"];
                            $mostrarEquipo= ControladorEquipos::ctrMostrarEquipos($item3, $valor3);

                            $item4 ="numdocumentousuario";
                            $valor4 = $acta["numdocumentoinstructor"];
                            $usuario = ControladorUsuarios::ctrMostrarUsuarios($item4, $valor4);

                            echo '<td>'.$usuario["nombreusuario"].'</td>
                            <td>'.$mostrarAprendiz[0]["nombreaprendiz"].'</td>
                            <td>'.$value["fechacreacion"].'</td>
                            <td>'.$value["fechalimite"].'</td>
                            
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
                        Agregar Acta
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