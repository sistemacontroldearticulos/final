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
                "NumeroFicha"                        => $_POST["nuevaFicha1"],
                "articulo"                           => null,
                "FechaNovedad"                       => $fechaActual,
                "Estado"                             => "1");

            $respuesta = ModeloNovedades::mdlCrearNovedad($tabla, $datos);
            // var_dump($respuesta);
            if ($respuesta == "ok") {
                if ($_SESSION["RolUsuario"] != "ADMINISTRADOR") {
                    $tabla = "notificaciones";

                    $datos6 = array('numdocumentousuario' => $_SESSION["NumDocumentoUsuario"],
                        'fechaActual'                         => $fechaActual,
                        'leido'                               => 0,
                        'tipo'                                => "CREADO UNA NUEVA NOVEDAD",
                    );

                    $respuesta3 = ModeloNotificaciones::mdlCrearNotificacion($tabla, $datos6);
                } else {
                    $respuesta3 = $respuesta;
                }

                if ($respuesta3 == "ok") {

                    $tabla = "articulonovedad";

                    $observacion = $_POST["nuevaDescripcion"];
                    if ($observacion == "") {
                        $observacion = null;
                    }

                    $item1  = "fechanovedad";
                    $valor1 = $fechaActual;
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

                        $tabla10    = "articulo";
                        $item10     = "idarticulo";
                        $valor10    = $id;
                        $articulo10 = ControladorArticulos::ctrMostrarArticulos($item10, $valor10);

                        $datos10 = array("IdArticulo" => $articulo10[0],
                            "TipoArticulo"                => $articulo10[4],
                            "MarcaArticulo"               => $articulo10[6],
                            "ModeloArticulo"              => $articulo10[5],
                            "NumInventarioSena"           => $articulo10[9],
                            "SerialArticulo"              => $articulo10[10],
                            "EstadoArticulo"              => $tipo,
                            "IdAmbiente"                  => $articulo10[1],
                            "IdCategoria"                 => $articulo10[3],
                            "CaracteristicaArticulo"      => $articulo10[7],
                            "IdEquipo"                    => $articulo10[2]);

                        $update = ModeloArticulos::mdlEditarArticulo($tabla10, $datos10);

                        $tabla5 = "articulonovedad";

                        $datos5 = array('IdArticulo' => $id,
                            'TipoNovedad'                => $tipo,
                            'ObservacionNovedad'         => $descripcion,
                            'IdNovedad'                  => $respuesta1[0]["idnovedad"],
                            'fotonovedad'                => null,
                        );

                        // $respuesta2 = ModeloNovedades::mdlCrearNovedadArticulo($tabla5, $datos5);

                        // var_dump($respuesta2);
                        $tabla3 = "articulonovedad";
                        $item3  = "idarticulo";
                        $valor3 = $id;

                        $respuesta3 = ModeloArticulos::mdlMostrarArticulos($tabla3, $item3, $valor3);
                        // var_dump($respuesta3);

                        if ($respuesta3 != "") {

                            $tabla8 = "novedad";
                            $datos8 = ModeloNovedades::idnovedad();

                            $a = $datos8["MAX(idnovedad)"];


                       
                        $respuesta8 = ModeloNovedades::mdlBorrarArticuloNovedad($tabla3, $a);
                        // echo '<pre>'; print_r($respuesta8); echo '</pre>';

                            $respuesta7 = ModeloNovedades::mdlBorrarNovedad($tabla8, $a);
                            if ($respuesta7 == "ok") {

                                if ($_SESSION["RolUsuario"] != "ADMINISTRADOR") {
                                    $tablaNotif = "notificaciones";


                                    $datosNoti = ModeloNotificaciones::idNotificacion();

                                    $b = $datosNoti["MAX(idnotificacion)"];

                                    $respuestaEliminarNotif = ModeloNotificaciones::mdlBorrarNotificacion($tablaNotif, $b);
                                } else {
                                    $respuestaEliminarNotif = $respuesta7;
                                }

                                if ($respuestaEliminarNotif == "ok") {
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
                                }

                            }

                            // var_dump($respuesta7);

                        } else {
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

                                             window.location = "novedades";

                                         }

                                     });

                                 </script>';

                            }
                        }
                    }
                }

            }
        }
    }

    public static function ctrMostrarNovedades($item, $valor)
    {

        $tabla = "novedad";

        $respuesta = ModeloNovedades::mdlMostrarNovedades($tabla, $item, $valor);

        return $respuesta;

    }

}
