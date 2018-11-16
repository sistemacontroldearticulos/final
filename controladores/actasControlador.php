<?php 

class ControladorActas{

	static public function ctrCrearActa(){

		if (isset($_POST["ficha"])) {

            $tabla = "acta_responsabilidad";

            date_default_timezone_set('America/Bogota');

            $fecha = date('Y-m-d');
            $hora  = date('H:i:s');

            $fechaActual = $fecha . ' ' . $hora;

            $datos = array("numdocumentoaprendiz" => $_POST["documentoAprendiz"],
                "idequipo"                     => $_POST["equipos"],
                "fechaacta"                       => $fechaActual);

            $respuesta = ModeloActas::mdlCrearActa($tabla, $datos);

            var_dump($respuesta);

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

    static public function ctrMostrarActas($item, $valor)
    {

        $tabla = "acta_responsabilidad";

        $respuesta = ModeloActas::mdlMostrarActas($tabla, $item, $valor);

        return $respuesta;

    }
}
