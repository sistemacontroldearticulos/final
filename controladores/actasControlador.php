<?php

class ControladorActas
{

    public static function ctrCrearActa()
    {

        if (isset($_POST["ficha"])) {

            $tabla = "acta_responsabilidad";

            date_default_timezone_set('America/Bogota');

            $fecha = date('Y-m-d');
            $hora  = date('H:i:s');

            $fechaActual = $fecha . ' ' . $hora;
            var_dump($fechaActual);
            var_dump($_POST["aprendices"]);
            var_dump($_POST["equipos"]);
            $numdocumentoinstructor = $_SESSION["NumDocumentoUsuario"];

            $datos = array("numdocumentoaprendiz" => $_POST["aprendices"],
                "idequipo"                            => $_POST["equipos"],
                "fechaacta"                           => $fechaActual,
                "numdocumentoinstructor"              => $numdocumentoinstructor);

            $respuesta = ModeloActas::mdlCrearActa($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>

                    swal({

                        type: "success",
                        title: "¡La acta ha sido guardada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "actas";

                        }

                    });

                    </script>';
            }
        }
    }

    public static function ctrMostrarActas($item, $valor)
    {

        $tabla = "acta_responsabilidad";

        $respuesta = ModeloActas::mdlMostrarActas($tabla, $item, $valor);

        return $respuesta;

    }
}
