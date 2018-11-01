<?php
class ControladorEquipos
{
    public static function ctrCrearEquipos()
    {
        if (isset($_POST["nuevoEquipo"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoEquipo"])) {
                $tabla            = "equipo";
                $nuevoEquipo      = strtoupper($_POST["nuevoEquipo"]);
                $nuevoEstado      = strtoupper($_POST["nuevoEstado"]);
                $nuevaObservacion = strtoupper($_POST["nuevaObservacion"]);

                $datos = array
                    (
                    "NuevoEquipo"           => $nuevoEquipo,
                    "NuevoEstado"           => $nuevoEstado,
                    "NuevaObservacion"      => $nuevaObservacion,
                    "NumArticulosEquipo"    => $_POST["nuevaCantidad"],
                    "NumArticulosAgregados" => 0,
                );

                $respuesta = ModeloEquipos::mdlCrearEquipo($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                                  swal({
                                        type: "success",
                                        title: "El equipo ha sido agregado correctamente",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                        }).then((result) => {
                                                  if (result.value) {

                                                  window.location = "equipos";

                                                  }
                                              })

                                  </script>';

                }
            } else {
                echo '<script>

                                  swal({
                                        type: "error",
                                        title: "El equipo no puede ir vacío o llevar caracteres especiales!",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar",
                                        closeOnConfirm: false
                                        }).then((result) => {
                                          if (result.value) {

                                          window.location = "equipos";

                                          }
                                      })

                              </script>';
            }
        }
    }

    // MOSTRAR EQUIPOS
    public static function ctrMostrarEquipos($item, $valor)
    {

        $tabla = "equipo";

        $respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);

        return $respuesta;

    }

    // BORRAR EQUIPO
    public static function ctrBorrarEquipo()
    {

        if (isset($_GET["idEquipo"])) {

            $tabla = "equipo";
            $datos = $_GET["idEquipo"];

            $tablaArticulo = "articulo";
            $item          = "IdEquipo";
            $valor         = $_GET["idEquipo"];

            $respuestaArticulo = ModeloArticulos::mdlMostrarArticulosEquipo($tablaArticulo, $item, $valor);
            // var_dump($respuestaArticulo);
            if ($respuestaArticulo != null) {
                foreach ($respuestaArticulo as $key => $value) {
                    if ($value[2] == $_GET["idEquipo"]) {
                        $datosArticulo = array("IdArticulo"=> $value[0],
                          "TipoArticulo" => $value[4],
                          "MarcaArticulo"           => $value[6],
                          "ModeloArticulo"          => $value[5],
                          "NumInventarioSena"       => $value[9],
                          "SerialArticulo"          =>  $value[10],
                          "EstadoArticulo"          => $value[8],
                          "IdAmbiente"              => $value[1],
                          "IdCategoria"             => $value[3],
                          "CaracteristicaArticulo"  => $value[7],
                          "IdEquipo"                => null,
                        );
                        
                        $respuestaUsuario2 = ModeloArticulos::mdlEditarArticulo($tablaArticulo, $datosArticulo);

                    }
                }
              }

                $respuesta = ModeloEquipos::mdlBorrarEquipo($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

          swal({
              type: "success",
              title: "El equipo ha sido borrado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "equipos";

                  }
                })

          </script>';
                }
            }
        }
      

        public static function ctrEditarEquipos()
        {

            if (isset($_POST["editarEquipo"])) {

                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarEquipo"])) {

                    $tabla            = "equipo";
                    $nuevoEquipo      = strtoupper($_POST["editarEquipo"]);
                    $nuevoEstado      = strtoupper($_POST["editarEstado"]);
                    $nuevaObservacion = strtoupper($_POST["editarObservacion"]);

                    $datos = array
                        (
                        "IdEquipo"              => $_POST["idEquipo"],
                        "NuevoEquipo"           => $nuevoEquipo,
                        "NuevoEstado"           => $nuevoEstado,
                        "NuevaObservacion"      => $nuevaObservacion,
                        "NumArticulosEquipo"    => $_POST["editarCantidad"],
                        "NumArticulosAgregados" => 0,
                    );

                    $respuesta = ModeloEquipos::mdlEditarEquipo($tabla, $datos);

                    if ($respuesta == "ok") {

                        echo '<script>

          swal({
              type: "success",
              title: "El equipo ha sido cambiado correctamente",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "equipos";

                  }
                })

          </script>';

                    }

                } else {

                    echo '<script>

          swal({
              type: "error",
              title: "¡El equipo no puede ir vacío o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {

              window.location = "equipos";

              }
            })

          </script>';

                }

            }

        }

    }
