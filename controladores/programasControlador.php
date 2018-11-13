<?php
class ControladorProgramas
{
    public function ctrCrearProgramas()
    {

        if (isset($_POST["NuevoPrograma"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["NuevoPrograma"])) {

                $tabla            = "programa";
                $nombrePrograma   = strtoupper($_POST['NuevoPrograma']);
                $tipoPrograma     = strtoupper($_POST["TipoPrograma"]);
                $duracionPrograma = strtoupper($_POST["nuevaDuracion"]);

                $datos = array("NuevoPrograma" => $nombrePrograma,
                    "TipoPrograma"                 => $tipoPrograma,
                    "DuracionPrograma"             => $duracionPrograma);

                //var_dump($datos);exit();

                $respuesta = ModelosProgramas::mdlCrearPrograma($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
                          type: "success",
                          title: "El programa ha sido guardado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                          closeOnConfirm: false
                          }).then((result) => {
                                    if (result.value) {

                                    window.location = "programas";

                                    }
                                })

                    </script>';

                }
            } else {
                echo '<script>

                    swal({
                          type: "error",
                          title: "El programa no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                          closeOnConfirm: false
                          }).then((result) => {
                            if (result.value) {

                            window.location = "programas";

                            }
                        })

                </script>';
            }
        }
    }

    public function ctrMostrarProgramas($item, $valor)
    {
        $tabla = "programa";

        $respuesta = ModelosProgramas::mdlMostrarProgramas($tabla, $item, $valor);
        return $respuesta;
    }

    public function ctrEditarPrograma()
    {

        if (isset($_POST["EditarPrograma"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditarPrograma"])) {

                $tabla            = "programa";
                $nombrePrograma   = strtoupper($_POST['EditarPrograma']);
                $tipoPrograma     = strtoupper($_POST["EditarTipoPrograma"]);
                $duracionPrograma = strtoupper($_POST["EditarDuracion"]);

                $datos = array("EditarPrograma" => $nombrePrograma,
                    "TipoPrograma"                  => $tipoPrograma,
                    "DuracionPrograma"              => $duracionPrograma,
                    "idPrograma"                    => $_POST["idPrograma"]);

                $respuesta = ModelosProgramas::mdlEditarPrograma($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                    swal({
                          type: "success",
                          title: "El programa ha sido editado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                          closeOnConfirm: false
                          }).then((result) => {
                                    if (result.value) {

                                    window.location = "programas";

                                    }
                                })

                    </script>';

                }
            } else {
                echo '<script>

                    swal({
                          type: "error",
                          title: "El programa no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                          closeOnConfirm: false
                          }).then((result) => {
                            if (result.value) {

                            window.location = "programas";

                            }
                        })

                </script>';
            }
        }
    }

    public function ctrBorrarPrograma()
    {
        if (isset($_GET["idPrograma"])) {

            $tabla1 = "ambiente";
            $dato1  = $_GET["idPrograma"];

            $respuestaAmbiente = ModeloAmbientes::mdlBuscarAmbientePrograma($tabla1, $dato1);
            // var_dump($respuestaAmbiente[0][1]);
            if ($respuestaAmbiente != null) {
                // var_dump($_GET["idPrograma"]);
                foreach ($respuestaAmbiente as $key => $value) {

                    if ($value[1] == $_GET["idPrograma"]) {
                        $datosAmbiente = array("IdPrograma" => null,
                            "NombreAmbiente"                    => $value[2],
                            "UbicacionAmbiente"                 => $value[3],
                            "IdAmbiente"                        => $value[0],
                        );
                        $tablaAmbiente      = "ambiente";
                        // var_dump($datosAmbiente);
                        $respuestaAmbiente2 = ModeloAmbientes::mdlEditarAmbientes($tablaAmbiente, $datosAmbiente);

                    }
                }
            }

            /*=============================================
            =           ARRIBA DE ESTO FUNCIONA            =
            =============================================*/

            $tabla3 = "usuario";
            $dato4  = $_GET["idPrograma"];

            $respuestaUsuarios = ModeloUsuarios::mdlBuscarUsuarioPrograma($tabla3, $dato4);

            if ($respuestaUsuarios != null) {
                foreach ($respuestaUsuarios as $key => $value) {
                    if ($value[1] == $_GET["idPrograma"]) {
                        $datoUsuario = array("NumDocumentoUsuario" => $value[0],
                            "NombreUsuario"                            => $value[2],
                            "ContraseniaUsuario"                       => $value[3],
                            "RolUsuario"                               => $value[4],
                            "FotoUsuario"                              => $value[5],
                            "IdPrograma"                               => null);

                        $tablaUsuario      = "usuario";
                        $respuestaUsuario2 = ModeloUsuarios::mdlEditarUsuario($tablaUsuario, $datoUsuario);

                    }
                }
            }

            $tabla5 = "ficha";
            $dato6  = $_GET["idPrograma"];

            $respuestaFicha = ModeloFichas::mdlBuscarFichaPrograma($tabla5, $dato6);

            if ($respuestaFicha != null) {
                foreach ($respuestaFicha as $key => $value) {
                    if ($value[1] == $_GET["idPrograma"]) {
                        $datoFicha = array("NumeroFicha" => $value[0],
                            "IdPrograma"                     => null,
                            "IdAmbiente"                     => $value[2],
                            "FechaInicio"                    => $value[3],
                            "FechaFin"                       => $value[4],
                            "JornadaFicha"                   => $value[5]);

                        $tablaFicha     = "ficha";
                        $respuestaFicha = ModeloFichas::mdlEditarFichas($tablaFicha, $datoFicha);

                    }
                }
            }

            $tabla = "programa";
            $datos = $_GET["idPrograma"];

            $respuesta = ModelosProgramas::mdlBorrarPrograma($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>

                       swal({
                          type: "success",
                          title: "El programa ha sido borrado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "programas";

                                    }
                                })

                    </script>';
            }

        }

    }
}
