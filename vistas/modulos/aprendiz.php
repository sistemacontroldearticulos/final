<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar aprendices
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar aprendices</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary btn-circle btn-xl" data-toggle="modal" data-target="#modalAgregarAprendiz" title="Agregar Aprendiz">
          
          <i class="fa fa-plus"></i>

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           <th style="width:30px">Acciones</th>   
           <th style="width:15px">#</th>
           <th>Documento</th>
           <th>Ficha</th>
           <th>Nombre</th>
           <th>Telefono</th>
           <th>Email</th>

         </tr> 

        </thead>

        <tbody>
            
           <?php

           $ficha = ControladorAprendiz::Aprendiz(); 

            $item  = "NumeroFicha";
            $valor = $ficha;

            $mostrarAprendiz = ControladorAprendiz::ctrMostrarAprendiz($item, $valor);
            // var_dump($mostrarAprendiz);

            foreach ($mostrarAprendiz as $key => $value) {

                echo '<tr>
                       <td>

                          <div class="btn-group">

                            <button class="btn btn-warning btn-circle btn-lg btnEditarAprendiz" data-toggle="modal" data-target="#modalEditarAprendiz" Documento="'.$value["numdocumentoaprendiz"].'" ><i class="fa fa-pencil"></i></button>

                            <button class="btn btn-circle btn-lg btn-danger btnEliminarAprendiz" Documento="'.$value["numdocumentoaprendiz"].'" ><i class="fa fa-times"></i></button>

                          </div>

                        </td>
                       <td>' . ($key + 1) . '</td>
                       <td>' . $value["numdocumentoaprendiz"] . '</td>
                       <td>' . $value["numeroficha"] . '</td>
                       <td>' . strtoupper($value["nombreaprendiz"]) . '</td>
                       <td>' . $value["telefonoaprendiz"] . '</td>
                       <td>' . $value["emailaprendiz"] . '</td>

                      </tr>';
                }
            ?>
          
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!-- MODAL AGREGAR APRENDIZ -->
<div id="modalAgregarAprendiz" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar aprendiz</h4>

        </div>

       
        <div class="modal-body">
          
          <!-- CUERPO DEL MODAL -->
          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/usuarios.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="nuevoAprendiz" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO -->
             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ndocumentos.png" width="15px">
                </span>

                <input type="number" class="form-control input-lg" name="nuevoDocumentoAprendiz" min="0" placeholder="Numero de documento" required>



              </div>

            </div>

            <!-- ENTRADA PARA LA FICHA -->
             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ficha.png" width="15px">
                </span>

                <?php  

                  
                
                  echo '<input type="number" class="form-control input-lg" name="nuevaFichaAprendiz" id="nuevaFichaAprendiz" value="'.$ficha.'" required readonly>';

                ?>
          
              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/telefono.png" width="15px">
                </span>

                <input type="number" class="form-control input-lg" name="nuevoTelefonoAprendiz" min="0" placeholder="Numero de telefono" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/email.png" width="15px">
                </span> 

                <input type="email" class="form-control input-lg" name="nuevoEmailAprendiz" placeholder="Ingresar email" required>

              </div>

            </div>

          </div>

        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        <?php 
          $crearAprendiz = new ControladorAprendiz();
          $crearAprendiz -> ctrCrearAprendiz();
         ?>

      </form>
    </div>
  </div>
</div>


<!-- MODAL EDITAR APRENDIZ -->
<div id="modalEditarAprendiz" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar aprendiz</h4>

        </div>

       
        <div class="modal-body">
          
          <!-- CUERPO DEL MODAL -->
          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/usurios.png" width="15px">
                </span> 

                <input type="text" class="form-control input-lg" name="editarAprendiz" id="editarAprendiz" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO -->
             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ndocumentos.png" width="15px">
                </span> 

                <input type="number" class="form-control input-lg" name="editarDocumentoAprendiz" id="editarDocumentoAprendiz" min="0" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA FICHA -->
             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ficha.png" width="15px">
                </span> 

                <input type="number" class="form-control input-lg" name="editarFichaAprendiz" id="editarFichaAprendiz" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELEFONO -->
             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/telefono.png" width="15px">
                </span> 

                <input type="number" class="form-control input-lg" name="editarTelefonoAprendiz" id="editarTelefonoAprendiz" min="0" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/email.png" width="15px">
                </span> 

                <input type="email" class="form-control input-lg" name="editarEmailAprendiz" id="editarEmailAprendiz" required>

              </div>

            </div>

          </div>

        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>

        <?php 
          $editarAprendiz= new ControladorAprendiz();
          $editarAprendiz->ctrEditarAprendiz();
        ?>

      </form>
    </div>
  </div>
</div>

<?php
// echo '<input type="text" name="documento" id="documento"> ';

  $eliminarAprendiz = new ControladorAprendiz();
  $eliminarAprendiz -> ctrBorrarAprendiz();
?>
