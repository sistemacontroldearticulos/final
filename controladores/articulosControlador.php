<?php

class ControladorArticulos
{
    // CREAR ARTICULO
    static public function ctrCrearArticulos()
    {
        if (isset($_POST["nuevoTipo"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTipo"])) {

                $nuevoTipo           = strtoupper($_POST["nuevoTipo"]);
                $nuevaMarca          = strtoupper($_POST["nuevaMarca"]);
                $nuevoModelo         = strtoupper($_POST["nuevoModelo"]);
                $nuevoSerial         = strtoupper($_POST["nuevoSerial"]);
                $nuevaCaracteristica = strtoupper($_POST["nuevaCaracteristica"]);
                $idEquipo            = $_POST["nuevoEquipo"];

                if ($idEquipo == "") {
                    $idEquipo = null;
                }

                if ($nuevaMarca == "") {
                    $nuevaMarca = null;
                }

                if ($nuevoModelo == "") {
                    $nuevoModelo = null;
                }

                if ($nuevaCaracteristica == "") {
                    $nuevaCaracteristica = null;
                }


                $tabla = "articulo";
                $datos = array("TipoArticulo" => $nuevoTipo,
                    "MarcaArticulo"               => $nuevaMarca,
                    "ModeloArticulo"              => $nuevoModelo,
                    "NumInventarioSena"           => $_POST["nuevoInventario"],
                    "SerialArticulo"              => $_POST["nuevoSerial"],
                    "EstadoArticulo"              => $_POST["nuevoEstado"],
                    "IdAmbiente"                  => $_POST["nuevoAmbiente"],
                    "IdCategoria"                 => $_POST["nuevaCategoria"],
                    "CaracteristicaArticulo"      => $nuevaCaracteristica,
                    "IdEquipo"                    => $idEquipo,
                );

                $tablaEquipo = "equipo";
                $valorEquipo = $_POST["equipo"];
                $itemEquipo  = "IdEquipo";

                $equipo    = ModeloEquipos::mdlMostrarEquipos($tablaEquipo, $itemEquipo, $valorEquipo);
                $agregados = $equipo["numarticulosagregados"] + 1;

                $datosEquipo = array("IdEquipo"              => $equipo["idequipo"],
                    "NuevoEquipo"           => $equipo["nombreequipo"],
                    "NuevoEstado"           => $equipo["estadoequipo"],
                    "NuevaObservacion"      => $equipo["observacionequipo"],
                    "NumArticulosEquipo"    => $equipo["numarticulosequipo"],
                    "NumArticulosAgregados" => $agregados,
                );

                $respuestaAmbiente2 = ModeloEquipos::mdlEditarEquipo($tablaEquipo, $datosEquipo);

                $respuesta = ModeloArticulos::mdlCrearArticulo($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>

                    swal({

                        type: "success",
                        title: "¡El articulo ha sido guardado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "articulos";

                        }

                    });

                    </script>';
                }
            } else {
                echo '<script>

                    swal({

                        type: "error",
                        title: "¡El articulo no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "articulos";

                        }

                    });


                </script>';
            }
        }
    }


    static public function ctrMostrarArticulos($item, $valor)
    {

        $tabla = "articulo";

        $respuesta = ModeloArticulos::mdlMostrarArticulos($tabla, $item, $valor);

        return $respuesta;

    }

    static public function ctrBorrarArticulo(){

        if (isset($_GET["idArticulo"])) {

            $valor = $_GET["idArticulo"];
            $tabla = "articulonovedad";
            $item = "idarticulo";

            $respuesta = ModeloArticulos::mdlMostrarArticulos($tabla, $item, $valor);
            // var_dump($respuesta);


            if ($respuesta == false) {
                $tabla = "articulo";
                $datos = $_GET["idArticulo"];
                $item  = "IdArticulo";

                $articulo = ModeloArticulos::mdlMostrarArticulos($tabla, $item, $datos);

                $tablaEquipo = "equipo";
                $valorEquipo = $articulo["idequipo"];
                $itemEquipo  = "IdEquipo";

                $equipo    = ModeloEquipos::mdlMostrarEquipos($tablaEquipo, $itemEquipo, $valorEquipo);


                $agregados = $equipo["numarticulosagregados"] - 1;

                $datosEquipo = array
                    (
                    "IdEquipo"              => $equipo["idequipo"],
                    "NuevoEquipo"           => $equipo["nombreequipo"],
                    "NuevoEstado"           => $equipo["estadoequipo"],
                    "NuevaObservacion"      => $equipo["observacionequipo"],
                    "NumArticulosEquipo"    => $equipo["numarticulosequipo"],
                    "NumArticulosAgregados" => $agregados,
                );

                $respuestaAmbiente2 = ModeloEquipos::mdlEditarEquipo($tablaEquipo, $datosEquipo);

                $respuesta = ModeloArticulos::mdlBorrarArticulos($tabla, $datos);
    // var_dump($respuesta);            
                if ($respuesta == "ok") {

                    echo '<script>

                     swal({
                           type: "success",
                           title: "El articulo ha sido borrado correctamente",
                           showConfirmButton: true,
                           confirmButtonText: "Cerrar"
                           }).then(function(result){
                                     if (result.value) {

                                     window.location = "articulos";

                                     }
                                 })

                     </script>';
                }
            }else{
                echo '<script>

                     swal({
                           type: "error",
                           title: "Error",
                           text: "El articulo se encuentra registrado en una novedad",
                           showConfirmButton: true,
                           confirmButtonText: "Cerrar"
                           }).then(function(result){
                                     if (result.value) {

                                     window.location = "articulos";

                                     }
                                 })

                     </script>';
            }           
        }
    }

    // EDITAR ARTICULO
    static public function ctrEditarArticulos()
    {
        if (isset($_POST["editarTipo"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTipo"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])) {
                $editarTipo           = strtoupper($_POST["editarTipo"]);
                $editarMarca          = strtoupper($_POST["editarMarca"]);
                $editarModelo         = strtoupper($_POST["editarModelo"]);
                $editarSerial         = strtoupper($_POST["editarSerial"]);
                $editarCaracteristica = strtoupper($_POST["editarCaracteristica"]);

                $idEquipo = $_POST["idEquipo"];
                if ($idEquipo == "") {
                    $idEquipo = null;
                }

                $idCategoria = $_POST["idCategoria"];
                if ($idCategoria == "") {
                    $idCategoria = null;
                }

                $idAmbiente = $_POST["idAmbiente"];
                if ($idAmbiente == "") {
                    $idAmbiente = null;
                }

                $tabla = "articulo";
                $datos = array("IdArticulo" => $_POST["idArticulo"],
                    "TipoArticulo"              => $editarTipo,
                    "MarcaArticulo"             => $editarMarca,
                    "ModeloArticulo"            => $editarModelo,
                    "NumInventarioSena"         => $_POST["editarInventario"],
                    "SerialArticulo"            => $_POST["editarSerial"],
                    "EstadoArticulo"            => $_POST["editarEstado"],
                    "IdAmbiente"                => $idAmbiente,
                    "IdCategoria"               => $idCategoria,
                    "CaracteristicaArticulo"    => $editarCaracteristica,
                    "IdEquipo"                  => $idEquipo);

                $item             = "IdArticulo";
                $valor            = $_POST["idArticulo"];
                $registroArticulo = ModeloArticulos::mdlMostrarArticulos($tabla, $item, $valor);

                $itemEquipo          = "IdEquipo";
                $tablaEquipo         = "equipo";
                $idEquipoValidar     = $registroArticulo["idequipo"];
                $registroEquipoViejo = ModeloEquipos::mdlMostrarEquipos($tablaEquipo, $itemEquipo, $idEquipoValidar);

                if ($registroEquipoViejo["idequipo"] != $idEquipo) {

                    // var_dump($idEquipoValidar);
                    // var_dump($idEquipo);

                    $agregados1 = $registroEquipoViejo["numarticulosagregados"] - 1;

                    $datosEquipo1 = array
                        (
                        "IdEquipo"              => $registroEquipoViejo["idequipo"],
                        "NuevoEquipo"           => $registroEquipoViejo["nombreequipo"],
                        "NuevoEstado"           => $registroEquipoViejo["estadoequipo"],
                        "NuevaObservacion"      => $registroEquipoViejo["observacionequipo"],
                        "NumArticulosEquipo"    => $registroEquipoViejo["numarticulosequipo"],
                        "NumArticulosAgregados" => $agregados1,
                    );
                    $respuestaEquipo1 = ModeloEquipos::mdlEditarEquipo($tablaEquipo, $datosEquipo1);

                    $idEquipoValidar2    = $idEquipo;
                    $registroEquipoNuevo = ModeloEquipos::mdlMostrarEquipos($tablaEquipo, $itemEquipo, $idEquipoValidar2);

                    $agregados2 = $registroEquipoNuevo["numarticulosagregados"] + 1;

                    $datosEquipo2 = array
                        (
                        "IdEquipo"              => $registroEquipoNuevo["idequipo"],
                        "NuevoEquipo"           => $registroEquipoNuevo["nombreequipo"],
                        "NuevoEstado"           => $registroEquipoNuevo["estadoequipo"],
                        "NuevaObservacion"      => $registroEquipoNuevo["observacionequipo"],
                        "NumArticulosEquipo"    => $registroEquipoNuevo["numarticulosequipo"],
                        "NumArticulosAgregados" => $agregados2,
                    );

                    $respuestaEquipo2 = ModeloEquipos::mdlEditarEquipo($tablaEquipo, $datosEquipo2);

                }

                $respuesta = ModeloArticulos::mdlEditarArticulo($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>

                    swal({

                        type: "success",
                        title: "¡El articulo ha sido editado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "articulos";

                        }

                    });

                    </script>';
                }
            } else {
                echo '<script>

                    swal({

                        type: "error",
                        title: "¡El articulo no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "articulos";

                        }

                    });

                </script>';
            }
        }
    }

    static public function ctrMostrarArticuloNovedad($item, $valor)
    {

        $tabla = "articulonovedad";

        $respuesta = ModeloArticulos::mdlMostrarArticuloNovedad($tabla, $item, $valor);

        return $respuesta;

    }

}
