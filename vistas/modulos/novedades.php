

<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Novedades

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar novedades</li>

    </ol>

  </section>



  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="crear-novedad">

          <button class="btn btn-primary btn-circle btn-xl" title="Agregar novedad">

            <i class="fa fa-plus"></i>

          </button>

        </a>

      </div>

      <div class="box-body">


       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>
           <th>Detalles</th>
           <th style="width:10px">ID</th>
           <th>Nombre Usuario</th>
           <th>Ficha</th>
           <th>Fecha</th>

           <!-- <th>Ambiente</th> -->

         </tr>

        </thead>

        <tbody>

          <?php

$item  = "numdocumentousuario";
$valor = $_SESSION["NumDocumentoUsuario"];
$rol   = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
// var_dump($rol["rolusuario"]);

if ($rol["rolusuario"] == "ADMINISTRADOR") {

    $item      = null;
    $valor     = null;
    $respuesta = ControladorNovedades::ctrMostrarNovedades($item, $valor);
} else {

    $item      = "numdocumentousuario";
    $valor     = $_SESSION["NumDocumentoUsuario"];
    $respuesta = ControladorNovedades::ctrMostrarNovedades($item, $valor);
}

// $item = null;
// $valor = null;

// var_dump($respuesta);
foreach ($respuesta as $key => $value) {
    echo '<tr>

                    <td>

                        <div class="btn-group">

                          <button title="Ver Novedad" class="btn btn-circle btn-lg btn-success btnVerNovedades btnBuscar2" data-toggle="modal" data-target="#modalVerNovedades" idNovedad="' . $value["idnovedad"] . '"><i class="fa fa-eye"></i></button>

                        </div>

                      </td>

                      <td>' . $value["idnovedad"] . '</td>';

    $item  = "numdocumentousuario";
    $valor = $value["numdocumentousuario"];

    $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

    echo '<td>' . $usuario["nombreusuario"] . '</td>

                      <td>' . $value["numeroficha"] . '</td>

                      <td>' . $value["fechanovedad"] . '</td>

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
<div id="modalVerNovedades" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header cabeza-modal">

          <button type="button" onclick=" location.href='novedades' " class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Novedad</h4>

        </div>


        <div class="modal-body">

          <!-- CUERPO DEL MODAL -->
          <div class="box-body">

            <table class="table table-bordered table-striped table-hover tablaModalArticulos">
              <!-- <thead> -->
                  <tr>
                    <th>ID Articulo</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Observacion</th>
                    <th>Foto</th>
                  </tr>

              <!-- </thead> -->
              <!-- <tbody> -->



                  <!-- // $item = null;
                  // $valor = null;

                  // $respuesta = ControladorArticulos::ctrMostrarArticuloNovedad($item, $valor);

                  // foreach ($respuesta as $key => $value) {

                  //   echo '<tr>

                  //           <td style="width:10px">'.$value["idnovedad"].'</td>

                  //           <td style="width:10px">'.$value["idarticulo"].'</td>';

                  //           $item1 = "IdArticulo";
                  //           $valor1 = $value["idarticulo"];
                  //           $respuesta1 = ControladorArticulos::ctrMostrarArticulos($item1, $valor1);

                  //     echo '<td style="width:70px">'.$respuesta1["tipoarticulo"].'</td>

                  //           <td style="width:50px">'.$value["tiponovedad"].'</td>

                  //           <td style="width:150px">'.$value["observacionnovedad"].'</td>
                  //         </tr>';
                  // } -->


              <!-- </tbody>  -->

            </table>

          </div>

        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">
          <a href="inicio">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
        </a>
        </div>

      </form>
    </div>
  </div>
</div>

<div id="popUp" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

 <?php

$programa = ControladorNotificaciones::ctrActualizarNotificaciones();
echo '<input type="hidden" id="instructor" value="' . $programa . '">';

?>


