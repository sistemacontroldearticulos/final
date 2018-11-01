<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Usuarios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Usuarios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary btn-circle btn-xl" data-toggle="modal" data-target="#modalAgregarUsuario" title="Agregar Usuario">

          <i class="fa fa-plus"></i>

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas">

        <thead>

         <tr>

           <th style="width:30px">Acciones</th>   
           <th style="width:15px">#</th>
           <th>Numero de Documento</th>
           <th>Nombre de Usuario</th>
           <th>Foto</th>
           <th>Rol</th>
           <th>Programa</th>

         </tr>

        </thead>

        <tbody>

          <?php
$item  = null;
$valor = null;

$usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
// var_dump($usuario);

foreach ($usuario as $key => $value) {
    echo ' <tr>
                <td>

                    <div class="btn-group">

                      <button class="btn btn-circle btn-lg btn-warning btnEditarUsuario" NumDocumentoUsuario="' . $value["numdocumentousuario"] . '" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-circle btn-lg btn-danger btnEliminarUsuario" NumDocumentoUsuario="' . $value["numdocumentousuario"] . '" FotoUsuario="' . $value["fotousuario"] . '" NombreUsuario="' . $value["nombreusuario"] . '"><i class="fa fa-times"></i></button>

                    </div>

                  </td>
                  <td>' . ($key + 1) . '</td>
                  <td>' . $value["numdocumentousuario"] . '</td>
                  <td>' . $value["nombreusuario"] . '</td>';

    if ($value["fotousuario"] != "") {

        echo '<td><img src="' . $value["fotousuario"] . '" class="img-thumbnail" width="40px"></td>';

    } else {

        echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

    }

    echo '<td>' . $value["rolusuario"] . '</td>';
    $item  = "idprograma";
    $valor = $value["idprograma"];

    $programa = ControladorProgramas::ctrMostrarProgramas($item, $valor);
    
    echo '<td>' . $programa["nombreprograma"] . '</td>


                  

                </tr>';
}

?>


        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!-- MODAL AGREGAR USUARIO -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>


        <div class="modal-body">

          <!-- CUERPO DEL MODAL -->
          <div class="box-body">

            <!-- ENTRADA PARA EL USUARIO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO -->
             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="number" class="form-control input-lg" name="nuevoDocumento" id="nuevoDocumento" min="0" placeholder="Numero de documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->
             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" name="nuevaContrasenia" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoPerfil" onchange="rolUsuario(this.value)" required>

                  <option value="">Selecionar perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Instructor">Instructor</option>
                  <option value="Especial">Especial</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR PROGRAMA -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <select class="form-control input-lg" name="nuevoPrograma" id="nuevoPrograma">

                  <option value="">Selecionar Programa</option>
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

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2 MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>
        </div>

        <?php

$crearUsuario = new ControladorUsuarios();
$crearUsuario->ctrCrearUsuario();

?>

      </form>
    </div>
  </div>
</div>

<!-- MODAL EDITAR USUARIO -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!-- CABEZA DEL MODAL -->
        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

          <!-- CUERPO DEL MODAL -->
          <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EL USUARIO -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO -->
             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="numer" class="form-control input-lg" id="editarDocumento" name="editarDocumento" min="0" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->
             <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password" class="form-control input-lg" id="editarContrasenia" name="editarContrasenia" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="editarPerfil" onchange="rolUsuario2(this.value)">

                  <option id="editarPerfil"></option>
                  <option value="ADMINISTRADOR">Administrador</option>
                  <option value="INSTRUCTOR">Instructor</option>
                  <option value="ESPECIAL">Especial</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR PROGRAMA -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <select class="form-control input-lg"  name="editarPrograma">


                   <option id="editarPrograma" value=""></option>
                   <option value="">Seleccione Programa</option>

                    <?php
                    $item  = null;
                    $valor = null;

                    $programas = ControladorProgramas::ctrMostrarProgramas($item, $valor);

                    foreach ($programas as $key => $value) {
                        echo '<option value="' . $value["idprograma"] . '">' . $value["nombreprograma"] . '</option>';
                    }

                    ?>
                    </select>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">

              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" id="editarFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2 MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!-- PIE DEL MODAL -->
        <div class="modal-footer">

          <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

        <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario->ctrEditarUsuario();

        ?>

      </form>
    </div>
  </div>
</div>

<?php
   $borrarUsuario = new ControladorUsuarios();
   $borrarUsuario -> ctrBorrarUsuario();

  ?>
