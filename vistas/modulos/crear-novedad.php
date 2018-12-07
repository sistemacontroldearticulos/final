
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear Novedad

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear Novedad</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      el formulario
      ======================================-->
      <input type="hidden" id="numeroProgramaValidacion" value="<?php echo $_SESSION["NumDocumentoUsuario"]; ?>">

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioNovedad">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                entrada usuario
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/usuarios.png" width="15px">
                </span>

                    <input type="text" class="form-control" name="usuarioNovedad" value="<?php echo $_SESSION["NombreUsuario"]; ?>" readonly>

                    <input type="hidden" name="numUsuario" value="<?php echo $_SESSION["NumDocumentoUsuario"]; ?>">

                  </div>

                </div>

                <!-- ENTRADA PARA LA FICHA  -->
                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ficha.png" width="15px">
                </span>

                    <input type="number" class="form-control input-lg" id="nuevaFicha1" name="nuevaFicha1" placeholder="Ingrese numero de ficha"  required>

                     <span  class="input-group-addon btnBuscar btnBuscar1"><button title="Buscar Ficha" type="button" class="btn btn-primary btn-sm" x="<?php echo $_SESSION["IdPrograma"]; ?>"onclick="ficha(nuevaFicha1.value)"><i class="fa fa-search"></i></button></span>

                  </div>

                </div>

                <!-- ENTRADA PARA EL AMBIENTE -->
                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon">
                  <img src="vistas/img/plantilla/modal/ambientes.png" width="15px">
                </span>

                      <input type="text" class="form-control input-lg" id="nuevoAmbiente1" name="nuevoAmbiente1" readonly placeholder="Ambiente">

                  </div>

                </div>

                <!-- AGREGAR ARTICULO A LA NOVEDADA -->
                <div class="form-group row nuevoArticulo">





                </div>

                <!-- LISTA ARTICULOS -->
                <input type="hidden" name="listaArticulos" id="listaArticulos">

              </div>

          </div>

          <div class="box-footer">

            <button disabled id="btnCrearNovedad"type="submit" class="btn btn-primary pull-right">Crear Novedad</button>

          </div>



          <?php

$crearNovedad = new ControladorNovedades();
$crearNovedad->ctrCrearNovedad();

?>

        </form>

        </div>

      </div>

      <!--=====================================
      tabla de articulos
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive  tablaArticulos" id="tablaArticulos">

               <thead>

                 <tr>
                  <th style="width: 10px">ID</th>
                  <th style="width: 10px">Tipo Articulo</th>
                  <th style="width: 10px">Numero Inventario Sena</th>
                  <!-- <th style="width: 10px">Modelo</th> -->
                  <!-- <th style="width: 10px">Serial</th> -->
                  <th style="width: 10px">Equipo</th>
                  <th style="width: 10px">Ambiente</th>
                  <th style="width: 10px">acciones</th>
                </tr>

              </thead>


            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>



<div id="modalAgregarArticulo1" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">


  <div class="modal-dialog">

    <div class="modal-content">
      <form role="form" method="post">

       <!-- CABEZA DEL MODAL -->
        <div class="modal-header cabeza-modal">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Descripción articulo</h4>

        </div>

       <!-- CUERPO DEL MODAL -->
        <div class="modal-body">

          <div class="box-body">

            <div class=" form-group row">

                     <div class="col-xs-6" >

                         <div class="input-group">

                          <!--  <span class="input-group-addon"><button type="button" class="btn btn-danger quitarNovedad btn-xs" idArticulo="idArticulo"><i class="fa fa-times"></i></button></span> -->

                           <input type="text" class="form-control input-lg agregarArticulo" idArticulo="idArticulo" name="agregarArticulo" id="agregarArticulo" required readonly>
                           <input type="hidden" id="idArticulo" >

                         </div>

                     </div>


                     <div class="col-xs-6" >

                         <div class="input-group">

                           <span class="input-group-addon "><i class="fa fa-th"></i></span>

                           <select class="form-control tipoNovedadArticulo input-lg" id="tipoNovedadArticulo">

                             <option id="tipoNovedadArticulo" value="">Tipo</option>

                             <option value="DAÑADO">DAÑADO</option>

                             <option value="PERDIDO">PERDIDO</option>

                           </select>

                         </div>

                     </div>

                     </div>

                     <div class="form-group" >

                         <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>


                             <textarea class="form-control nuevaDescripcion rounded-5" name="nuevaDescripcion" row="3" placeholder="Descripción" required></textarea>

                             <input type="hidden" id="articulo" name="articulo" value="">

                         </div>

                     </div>

                    <!--  <div class="form-group">

                        <div class="panel">SUBIR FOTO</div>

                        <input type="file" class="nuevaFotoArticulo" name="nuevaFotoArticulo">

                        <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

                        

                      </div> -->

 <!-- PIE DEL MODAL -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default " onclick="quitarNovedad()" data-dismiss="modal">Salir</button>

          <button type="button"  class="btn btn-primary" onclick="agregar()">Guardar Artículo</button>

        </div>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>

