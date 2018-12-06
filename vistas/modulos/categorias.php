<div class="content-wrapper" >

  <section class="content-header">
    
    <h1>
      
      Administrar Categorías

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Categorías</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary btn-circle btn-xl" data-toggle="modal" data-target="#modalAgregarCategoria" title="Agregar categoría">
          
          <i class="fa fa-plus"></i>

        </button>

      </div>

      <!-- <button type="button" class="btn btn-default btn-circle"><i class="glyphicon glyphicon-ok"></i></button> -->

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           <th style="width:30px">Acciones</th>   
           <th style="width:15px">#</th>
           <th>Categoría</th>

         </tr> 

        </thead>

        <tbody>

          <?php

            $item = null;
            $valor = null;  

            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

            foreach ($categorias as $key => $value) {
           
            echo ' <tr>
            <td>

                      <div class="btn-group">
                          
                        <button title="Editar" class="btn btn-warning btn-circle btn-lg btnEditarCategoria" idCategoria="'.$value["idcategoria"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>


                        <button title="Eliminar" class="btn btn-circle btn-lg btn-danger btnEliminarCategoria" idCategoria="'.$value["idcategoria"].'"><i class="fa fa-times"></i></button>

                      </div>  

                    </td>

                    <td>'.($key+1).'</td>

                    <td class="text-uppercase">'.$value["nombrecategoria"].'</td>

                    

                  </tr>';
              }

          ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!-- MODAL AGREGAR CATEGORIA -->
<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">
      <form role="form" method="post">

       <!-- CABEZA DEL MODAL -->
        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Categoría</h4>

        </div>

       <!-- CUERPO DEL MODAL -->
        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CATEGORIA -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/categoria.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" placeholder="Ingrese Nombre de Categoría" required>

              </div>

            </div>
  
          </div>

        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Categoría</button>

        </div>

        <?php

          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoría</h4>

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
                  <img src="vistas/img/plantilla/modal/categoria.png" width="15px">
                </span>

                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required onclick="capturar2(this.value)">

                 <input type="hidden"  name="idCategoria" id="idCategoria" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default " data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        </div>

        <?php

          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();

?>
