<?php
class ControladorEquipos
{
    static public function ctrCrearEquipos()
    {
        if (isset($_POST["nuevoEquipo"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoEquipo"])) {
                $tabla            = "equipo";
                $nuevoEquipo      = strtoupper($_POST["nuevoEquipo"]);
                $nuevoEstado      = strtoupper($_POST["nuevoEstado"]);
                $nuevaObservacion = strtoupper($_POST["nuevaObservacion"]);

                $datos = array("NuevoEquipo"           => $nuevoEquipo,
                    "NuevoEstado"           => $nuevoEstado,
                    "NuevaObservacion"      => $nuevaObservacion,
                    "NumArticulosEquipo"    => $_POST["nuevaCantidad"],
                    "idambiente"            => $_POST["nuevoAmbienteEquipo"],
                    "NumArticulosAgregados" => 0
                );

                $respuesta = ModeloEquipos::mdlCrearEquipo($tabla, $datos);

                // var_dump($respuesta);

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
    static public function ctrMostrarEquipos($item, $valor)
    {

        $tabla = "equipo";

        $respuesta = ModeloEquipos::mdlMostrarEquipos($tabla, $item, $valor);

        return $respuesta;

    }

    // MOSTRAR EQUIPOS ALL
    static public function ctrMostrarEquipos1($item, $valor)
    {

        $tabla = "equipo";

        $respuesta = ModeloEquipos::mdlMostrarEquipos1($tabla, $item, $valor);

        return $respuesta;

    }

    // BORRAR EQUIPO
    static public function ctrBorrarEquipo(){   
      // var_dump($_GET["idEquipo"]);

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

            $actaResponsabilidadEquipo = ControladorActas::ctrEliminarActaResponsabilidadEquipo($datos);

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
      

        static public function ctrEditarEquipos()
        {

            if (isset($_POST["editarEquipo"])) {

                if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarEquipo"])) {

                    $tabla            = "equipo";
                    $nuevoEquipo      = strtoupper($_POST["editarEquipo"]);
                    $nuevoEstado      = strtoupper($_POST["editarEstado"]);
                    $nuevaObservacion = strtoupper($_POST["editarObservacion"]);

                    $datos = array("IdEquipo"   => $_POST["idEquipo"],
                        "NuevoEquipo"           => $nuevoEquipo,
                        "NuevoEstado"           => $nuevoEstado,
                        "NuevaObservacion"      => $nuevaObservacion,
                        "NumArticulosEquipo"    => $_POST["editarCantidad"],
                        "NumArticulosAgregados" => $_POST["agregados"],
                        "idambiente"            => $_POST["editarAmbienteEquipo"]
                    );


                    if ($datos["NumArticulosEquipo"] < $datos["NumArticulosAgregados"]) {
                      echo '<script>

                        swal({
                            type: "error",
                            title: "Error",
                            text: "La cantidad de artículos del equipo debe ser mayor a la cantidad de artículos agregados actualmente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if (result.value) {

                                window.location = "equipos";

                                }
                              })

                        </script>';
                    }else{

                      $respuesta = ModeloEquipos::mdlEditarEquipo($tabla, $datos);

                    }


                    if ($respuesta == "ok") {

                      echo '<script>

                        swal({
                            type: "success",
                            title: "El equipo ha sido editado correctamente",
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


  // BORRAR EQUIPO AMBIENTE
  static public function ctrBorrarEquipoAmbiente($tabla10, $itemEquipo10, $datos10){   

        $tabla = $tabla10;
        $datos = $datos10;

        $tablaArticulo = "articulo";
        $item          = $itemEquipo10;
        $valor         = $datos10;

        $respuestaArticulo = ModeloArticulos::mdlMostrarArticulosEquipo($tablaArticulo, $item, $valor);
        var_dump($respuestaArticulo);
        if ($respuestaArticulo != null) {
            foreach ($respuestaArticulo as $key => $value) {
                if ($value[2] == $datos10) {
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
    }
}
