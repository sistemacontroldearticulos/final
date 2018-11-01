<?php

class ControladorArticulos
{
    // CREAR ARTICULO
    public static function ctrCrearArticulos()
    {
        if (isset($_POST["nuevoTipo"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoTipo"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaMarca"])) {
                $nuevoTipo           = strtoupper($_POST["nuevoTipo"]);
                $nuevaMarca          = strtoupper($_POST["nuevaMarca"]);
                $nuevoModelo         = strtoupper($_POST["nuevoModelo"]);
                $nuevoSerial         = strtoupper($_POST["nuevoSerial"]);
                $nuevaCaracteristica = strtoupper($_POST["nuevaCaracteristica"]);
                $idEquipo            = $_POST["nuevoEquipo"];
                if ($idEquipo == "") {
                    $idEquipo = null;
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


    public static function ctrMostrarArticulos($item, $valor)
    {

        $tabla = "articulo";

        $respuesta = ModeloArticulos::mdlMostrarArticulos($tabla, $item, $valor);

        return $respuesta;

    }

    static public function ctrBorrarArticulo(){

        if (isset($_GET["idArticulo"])) {

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
        }
    }

    // EDITAR ARTICULO
    public static function ctrEditarArticulos()
    {
        if (isset($_POST["editarTipo"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarTipo"]) && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarMarca"])) {
                $editarTipo           = strtoupper($_POST["editarTipo"]);
                $editarMarca          = strtoupper($_POST["editarMarca"]);
                $editarModelo         = strtoupper($_POST["editarModelo"]);
                $editarSerial         = strtoupper($_POST["editarSerial"]);
                $editarCaracteristica = strtoupper($_POST["editarCaracteristica"]);
                $idEquipo             = $_POST["idEquipo"];
                if ($idEquipo == "") {
                    $idEquipo = null;
                }

                $tabla = "articulo";
                $datos = array("IdArticulo" => $_POST["idArticulo"],
                    "TipoArticulo"              => $editarTipo,
                    "MarcaArticulo"             => $editarMarca,
                    "ModeloArticulo"            => $editarModelo,
                    "NumInventarioSena"         => $_POST["editarInventario"],
                    "SerialArticulo"            => $_POST["editarSerial"],
                    "EstadoArticulo"            => $_POST["editarEstado"],
                    "IdAmbiente"                => $_POST["idAmbiente"],
                    "IdCategoria"               => $_POST["idCategoria"],
                    "CaracteristicaArticulo"    => $editarCaracteristica,
                    "IdEquipo"                  => $idEquipo);

                $item             = "IdArticulo";
                $valor            = $_POST["idArticulo"];
                $registroArticulo = ModeloArticulos::mdlMostrarArticulos($tabla, $item, $valor);

                $itemEquipo          = "IdEquipo";
                $tablaEquipo         = "equipo";
                $idEquipoValidar     = $registroArticulo["IdEquipo"];
                $registroEquipoViejo = ModeloEquipos::mdlMostrarEquipos($tablaEquipo, $itemEquipo, $idEquipoValidar);

                if ($registroEquipoViejo["IdEquipo"] != $idEquipo) {

                    // var_dump($idEquipoValidar);
                    // var_dump($idEquipo);

                    $agregados1 = $registroEquipoViejo["NumArticulosAgregados"] - 1;

                    $datosEquipo1 = array
                        (
                        "IdEquipo"              => $registroEquipoViejo["IdEquipo"],
                        "NuevoEquipo"           => $registroEquipoViejo["NombreEquipo"],
                        "NuevoEstado"           => $registroEquipoViejo["EstadoEquipo"],
                        "NuevaObservacion"      => $registroEquipoViejo["ObservacionEquipo"],
                        "NumArticulosEquipo"    => $registroEquipoViejo["NumArticulosEquipo"],
                        "NumArticulosAgregados" => $agregados1,
                    );
                    $respuestaEquipo1 = ModeloEquipos::mdlEditarEquipo($tablaEquipo, $datosEquipo1);

                    $idEquipoValidar2    = $idEquipo;
                    $registroEquipoNuevo = ModeloEquipos::mdlMostrarEquipos($tablaEquipo, $itemEquipo, $idEquipoValidar2);

                    $agregados2 = $registroEquipoNuevo["NumArticulosAgregados"] + 1;

                    $datosEquipo2 = array
                        (
                        "IdEquipo"              => $registroEquipoNuevo["IdEquipo"],
                        "NuevoEquipo"           => $registroEquipoNuevo["NombreEquipo"],
                        "NuevoEstado"           => $registroEquipoNuevo["EstadoEquipo"],
                        "NuevaObservacion"      => $registroEquipoNuevo["ObservacionEquipo"],
                        "NumArticulosEquipo"    => $registroEquipoNuevo["NumArticulosEquipo"],
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
