<?php

class ControladorNovedades
{

    // CREAR NOVEDAD
    public static function ctrCrearNovedad()
    {
        if (isset($_POST["usuarioNovedad"])) {

            $tabla = "novedad";

            date_default_timezone_set('America/Bogota');

            $fecha = date('Y-m-d');
            $hora  = date('H:i:s');

            $fechaActual = $fecha . ' ' . $hora;

            $datos = array("NumDocumentoUsuario" => $_POST["numUsuario"],
                "UsuarioNovedad"                     => $_POST["usuarioNovedad"],
                "NumeroFicha"                        => $_POST["nuevaFicha1"],
                "articulo"                           => $_POST["articulo"],
                "FechaNovedad"                       => $fechaActual,
                "Estado"                       => "1");

            $respuesta = ModeloNovedades::mdlCrearNovedad($tabla, $datos);
            // var_dump($respuesta);
            if ($respuesta == "ok") {

                $tabla = "articulonovedad";

                $observacion = $_POST["nuevaDescripcion"];
                if ($observacion == "") {
                    $observacion = null;
                }

                $item1  = "Articulo";
                $valor1 = $_POST["articulo"];
                $tabla1 = "novedad";

                $respuesta1 = ModeloNovedades::mdlMostrarNovedades($tabla1, $item1, $valor1);

                $arreglo = $_POST["listaArticulos"];

                $array = json_decode($arreglo);

                $final = explode(" ", $arreglo);
                // print_r($array);
                foreach ($array as $key) {
                    $id          = $key->id;
                    $tipo        = $key->tipo;
                    $descripcion = $key->descripcion;
                    $tabla       = "articulonovedad";
                    $datos       = array('IdArticulo' => $id,
                        'TipoNovedad'                     => $tipo,
                        'ObservacionNovedad'              => $descripcion,
                        'IdNovedad'                       => $respuesta1["idnovedad"],
                    );

                    $respuesta = ModeloNovedades::mdlCrearNovedadArticulo($tabla, $datos);

                }
                // var_dump($respuesta);

                if ($respuesta == "error") {
                    echo '<script>

                        swal({

                            type: "error",
                            title: "¡El artículo ya se encuentra registrado en esta novedad!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){

                                window.location = "crear-novedad";

                            }

                        });

                    </script>';
                } else {
                    echo '<script>

                        swal({

                            type: "success",
                            title: "¡La novedad ha sido registrada correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){

                                window.location = "crear-novedad";

                            }

                        });

                    </script>';

                }

            }
            /*=============================================
        =ARRIBA DE ESTO AGREGA NOVEDAD (RESPUESTA OK)=
        =============================================*/

        }
    }

    public function ctrMostrarNovedades($item, $valor)
    {

        $tabla = "novedad";

        $respuesta = ModeloNovedades::mdlMostrarNovedades($tabla, $item, $valor);

        return $respuesta;

    }

}
