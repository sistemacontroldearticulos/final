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
                "articulo"                           => null,
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

                $item1  = "fechanovedad";
                $valor1 = $fechaActual;
                $tabla1 = "novedad";

                $respuesta1 = ModeloNovedades::mdlMostrarNovedades($tabla1, $item1, $valor1);

                // var_dump($respuesta1[0]["idnovedad"]);

                $arreglo = $_POST["listaArticulos"];

                $array = json_decode($arreglo);

                $final = explode(" ", $arreglo);
                // print_r($array);
                foreach ($array as $key) {
                    $id          = $key->id;
                    $tipo        = $key->tipo;
                    $descripcion = $key->descripcion;

                    $tabla5      = "articulonovedad";

                    $datos5       = array('IdArticulo' => $id,
                        'TipoNovedad'                     => $tipo,
                        'ObservacionNovedad'              => $descripcion,
                        'IdNovedad'                       => $respuesta1[0]["idnovedad"],

                    );


                    // $respuesta2 = ModeloNovedades::mdlCrearNovedadArticulo($tabla5, $datos5);

                    // var_dump($respuesta2);
                    $tabla3 = "articulonovedad";
                    $item3 = "idarticulo";
                    $valor3 = $id;
 
                    $respuesta3 = ModeloArticulos::mdlMostrarArticulos($tabla3, $item3, $valor3);
                    // var_dump($respuesta3);

                    if ($respuesta3 != "") {


                        $tabla8 = "novedad";
                        $datos8 = ModeloNovedades::idnovedad(); 

                        $a = $datos8["max"];
                        
                        $respuesta7 = ModeloNovedades::mdlBorrarNovedad($tabla8, $a);

                        // var_dump($respuesta7);

                         echo '<script>

                             swal({

                                    type: "error",
                                    title: "¡El artículo ya se encuentra registrado en una novedad!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"

                                }).then(function(result){

                                    if(result.value){

                                        window.location = "crear-novedad";

                                    }

                                });

                            </script>';
                    }else{
                        $respuesta2 = ModeloNovedades::mdlCrearNovedadArticulo($tabla5, $datos5);

                        // var_dump($respuesta2);

                        if ($respuesta2 == "ok") {
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
                }
            }
        }
    }

    public function ctrMostrarNovedades($item, $valor)
    {

        $tabla = "novedad";

        $respuesta = ModeloNovedades::mdlMostrarNovedades($tabla, $item, $valor);

        return $respuesta;

    }

}
