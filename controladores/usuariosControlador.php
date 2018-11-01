<?php

class ControladorUsuarios
{

    /*=============================================
    INGRESO DE USUARIO
    =============================================*/

    public static function ctrIngresoUsuario()
    {

        if (isset($_POST["ingUsuario"])) {

            if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])) {

                $encriptar = hash('sha512', ($_POST["ingPassword"]));

                $tabla     = "usuario";
                $item      = "numdocumentousuario";
                $valor     = $_POST["ingUsuario"];
                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

                if ($respuesta["numdocumentousuario"] == $_POST["ingUsuario"] && $respuesta["contraseniausuario"] == $encriptar) {

                    $_SESSION["iniciarSesion"]       = "ok";
                    $_SESSION["NumDocumentoUsuario"] = $respuesta["numdocumentousuario"];
                    $_SESSION["IdPrograma"]          = $respuesta["idprograma"];
                    $_SESSION["NombreUsuario"]       = $respuesta["nombreusuario"];
                    $_SESSION["ContraseniaUsuario"]  = $respuesta["contraseniausuario"];
                    $_SESSION["RolUsuario"]          = $respuesta["rolusuario"];
                    $_SESSION["FotoUsuario"]         = $respuesta["fotousuario"];

                    // var_dump($_SESSION["NombreUsuario"] );

                    echo '<script>

                         window.location = "inicio";

                        </script>';

                } else {

                    echo '<br>
                    <div class="alert alert-danger">Error al ingresar usuario vuelve a intentarlo</div>';

                }

            }
        }
    }

    /*=============================================
    REGISTRO DE USUARIO
    =============================================*/

    public static function ctrCrearUsuario()
    {

        if (isset($_POST["nuevoNombre"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoDocumento"]) &&
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevaContrasenia"])) {

                /*======================================
                =          + VALIDAR IMAGEN            =
                ======================================*/
                $ruta = "";
                if (isset($_FILES["nuevaFoto"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto  = 500;

                    /*======================================
                    = CREAR DIRECTORIO PARA GUARDAR IMAGEN =
                    ======================================*/

                    $directorio = "vistas/img/usuarios/" . $_POST["nuevoDocumento"];
                    mkdir($directorio, 0755);

                    /*======================================
                    = VALIDAR TIPO DE IMAGEN =
                    ======================================*/

                    if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {

                        /*======================================
                        = GUARDAR IMAGEN EN EL DIRECTORIO (JPEG) =
                        ======================================*/
                        $aleatorio = mt_rand(100, 999);
                        $ruta      = "vistas/img/usuarios/" . $_POST["nuevoDocumento"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }
                    if ($_FILES["nuevaFoto"]["type"] == "image/png") {

                        /*======================================
                        = GUARDAR IMAGEN EN EL DIRECTORIO (PNG) =
                        ======================================*/
                        $aleatorio = mt_rand(100, 999);
                        $ruta      = "vistas/img/usuarios/" . $_POST["nuevoDocumento"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }
                }

                $tabla     = "usuario";
                $encriptar = hash('sha512', ($_POST["nuevaContrasenia"]));

                $nombreUsuario = strtoupper($_POST["nuevoNombre"]);
                $rolUsuario    = strtoupper($_POST["nuevoPerfil"]);

                $datos = array("NumDocumentoUsuario" => $_POST["nuevoDocumento"],
                    "NombreUsuario"                      => $nombreUsuario,
                    "ContraseniaUsuario"                 => $encriptar,
                    "RolUsuario"                         => $rolUsuario,
                    "FotoUsuario"                        => $ruta,
                    "IdPrograma"                         => $_POST["nuevoPrograma"]);

                $respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({

                        type: "success",
                        title: "¡El usuario ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "usuarios";

                        }

                    });

                    </script>';

                }

            } else {

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "usuarios";

                        }

                    });


                </script>';

            }

        }

    }
    /*=============================================
    MOSTRAR USUARIO
    =============================================*/

    public static function ctrMostrarUsuarios($item, $valor)
    {

        $tabla     = "usuario";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

    /*=============================================
    EDITAR USUARIO
    =============================================*/

    public static function ctrEditarUsuario()
    {

        if (isset($_POST["editarNombre"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

                //VALIDAR IMAGEN//

                $ruta = $_POST["fotoActual"];

                if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto  = 500;

                    /*======================================
                    = CREAR DIRECTORIO PARA GUARDAR IMAGEN =
                    ======================================*/

                    $directorio = "vistas/img/usuarios/" . $_POST["editarDocumento"];

                    //PREGUNTAMOS SI EXISTE UNA IMAGEN EN LA BD//

                    if (!empty($_POST["fotoActual"])) {

                        unlink($_POST["fotoActual"]);

                    } else {

                        mkdir($directorio, 0755);

                    }

                    /*======================================
                    = VALIDAR TIPO DE IMAGEN =
                    ======================================*/

                    if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

                        /*======================================
                        = GUARDAR IMAGEN EN EL DIRECTORIO (JPEG) =
                        ======================================*/
                        $aleatorio = mt_rand(100, 999);
                        $ruta      = "vistas/img/usuarios/" . $_POST["editarDocumento"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);

                    }
                    if ($_FILES["editarFoto"]["type"] == "image/png") {

                        /*======================================
                        = GUARDAR IMAGEN EN EL DIRECTORIO (PNG) =
                        ======================================*/
                        $aleatorio = mt_rand(100, 999);
                        $ruta      = "vistas/img/usuarios/" . $_POST["editarDocumento"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);

                    }
                }

                $tabla = "usuario";

                if ($_POST["editarContrasenia"] != "") {

                    if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarContrasenia"])) {

                        $encriptar =  hash('sha512', ($_POST["editarContrasenia"]));

                    } else {

                        echo '<script>

                                swal({

                                        type: "error",
                                        title: "¡la contraseña no puede ir vacía o llevar caracteres especiales!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"

                                        }).then(function(result){
                                            if(result.value){

                                            window.location = "usuarios";

                                            }

                                    })
                            </script>';

                    }

                } else {

                    $encriptar = $_POST["passwordActual"];

                }

                $editarNombre = strtoupper($_POST["editarNombre"]);
                $editarPerfil = strtoupper($_POST["editarPerfil"]);
                if ($_POST["editarPrograma"] == "") {
                    $programa = null;
                } else {
                    $programa = $_POST["editarPrograma"];
                }

                $datos = array("NumDocumentoUsuario" => $_POST["editarDocumento"],
                    "NombreUsuario"                      => $editarNombre,
                    "ContraseniaUsuario"                 => $encriptar,
                    "RolUsuario"                         => $editarPerfil,
                    "FotoUsuario"                        => $ruta,
                    "IdPrograma"                         => $programa);

                var_dump($datos);

                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                                swal({

                                    type: "success",
                                    title: "¡El usuario ha sido editado correctamente!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"

                                    }).then(function(result){
                                        if(result.value){
                                        window.location = "usuarios";
                                        }
                                })

                        </script>';

                }

            } else {

                echo '<script>

                    swal({

                        type: "error",
                        title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "usuarios";

                        }

                    });


                </script>';

            }

        }
    }
    /*=============================================
    ELIMINAR USUARIO
    =============================================*/

    public static function ctrBorrarUsuario()
    {

        if (isset($_GET["NumDocumentoUsuario"])) {

            $tabla = "usuario";
            $datos = $_GET["NumDocumentoUsuario"];

            if ($_GET["FotoUsuario"] != "") {

                unlink($_GET["FotoUsuario"]);
                rmdir('vistas/img/usuarios/' . $_GET["NumDocumentoUsuario"]);

            }
            $respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>
                            swal({
                                    type:"success",
                                    title:"El usuario ha sido borrado correctamente",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm:false
                                }).then((result)=>{
                                    if(result.value){
                                        window.location ="usuarios";
                                    }

                            })
                    </script>';
            }
        }
    }

}
