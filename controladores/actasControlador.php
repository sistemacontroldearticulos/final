<?php

class ControladorActas
{

    static public function ctrCrearActa()
    {

        if (isset($_POST["ficha"])) {

            $tabla = "acta_responsabilidad";

            date_default_timezone_set('America/Bogota');

            $fecha = date('Y-m-d');
            $hora  = date('H:i:s');

            $fechaActual = $fecha . ' ' . $hora;

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
                        title: "El acta ha sido guardada correctamente!",
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

    static public function ctrCrearActaCompromiso(){

        if (isset($_POST["aprendizActa"])) {
            
            $tabla = "actacompromiso";

            date_default_timezone_set('America/Bogota');

            $fecha1 = date('Y-m-d');
            $hora  = date('H:i:s');
            $fecha = $fecha1 . ' ' . $hora;
            
            $datos = array("idacta_responsabilidad" => $_POST["idActaResponsabilidad"],
                            "fechacreacion" => $fecha,
                            "fechalimite" => $_POST["fechaActa"],
                            "idarticulo" => $_POST["articulos"]);

            
            $respuesta = ModeloActas::mdlCrearActaCompromiso($tabla, $datos);
            
            if ($respuesta == "ok") {
                echo '<script>

                    swal({

                        type: "success",
                        title: "El acta ha sido guardada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "acta-compromiso";

                        }

                    });

                    </script>';
            }
        }
    }

    // MOSTRAR ACTA COMPROMISO
    public static function ctrMostrarActasCompromiso($item, $valor){

        $tabla = "actacompromiso";

        $respuesta = ModeloActas::mdlMostrarActasCompromiso($tabla, $item, $valor);

        return $respuesta;

    }

    static public function ctrExportarActasFicha(){

        if (isset($_POST["ficha1"]) && ($_POST["ficha1"] != "")) {


            $tabla = "ficha";
            $item = "numeroficha";
            $valor = $_POST["ficha1"];
            $respuestaFicha = Modelofichas::mdlMostrarFichas($tabla, $item, $valor);

            $tabla1 = "ambiente";
            $item1 = "idambiente";
            $valor1 = $respuestaFicha["idambiente"]; 
            $respuestaAmbiente = ModeloAmbientes::mdlMostrarAmbientes($tabla1, $item1, $valor1);

            $tabla2 = "equipo";
            $respuestaEquipo = ModeloEquipos::mdlMostrarEquipos1($tabla2, $item1, $valor1);
            

            $positivos = array();
            foreach ($respuestaEquipo as $key => $value) {

                $tabla3 = "acta_responsabilidad";
                $item3 = "idequipo";
                $valor3 = $respuestaEquipo[$key]["idequipo"]; 
                $respuestaActas = ModeloActas::mdlMostrarActas($tabla3, $item3, $valor3);


                if ($respuestaActas != false) {
                    
                    array_push($positivos, "true");

                }

                
            }


            if (empty($positivos)) {


                echo '<script>

                    swal({

                        type: "error",
                        title: "Esta ficha no tiene actas",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){

                        if(result.value){

                            window.location = "actas";

                        }

                    });

                    </script>';
                
            }else{

                echo '<script>

                         window.open("extensiones/tcpdf/pdf/actaFicha.php?codigo='.$_POST["ficha1"].', _blank");
                    </script>';


                echo '<script>

                        window.location = "actas";

                </script>';
            } 
        }
    }

    static public function ctrEliminarActaResponsabilidad($datos){

        $tabla = "acta_responsabilidad";

        $respuesta = ModeloActas::mdlEliminarActaResponsabilidad($tabla, $datos);

        if ($respuesta == "ok") {
            
            return $respuesta;

        }elseif ($respuesta == "error") {
        
            $item = "numdocumentoaprendiz";
            
            $mostrarActaResponsabilidad = ModeloActas::mdlMostrarActas($tabla, $item, $datos);

            $tabla1 = "actacompromiso";
            $datos1 = $mostrarActaResponsabilidad["idacta"];
            
            $eliminarActaCompromiso = ModeloActas::mdlEliminarActaCompromiso($tabla1, $datos1);
            
            if ($eliminarActaCompromiso == "ok") {
                
                $respuesta2 = ModeloActas::mdlEliminarActaResponsabilidad($tabla, $datos);

                if ($respuesta2 == "ok") {
                    
                    return $respuesta2;
                }
            }
        }
    }

    static public function ctrEliminarActaResponsabilidadEquipo($datos){

        $tabla = "acta_responsabilidad";

        $respuesta = ModeloActas::mdlEliminarActaResponsabilidadEquipo($tabla, $datos);

        if ($respuesta == "ok") {
            
            return $respuesta;

        }elseif ($respuesta == "error") {
        
            $item = "idequipo";
            
            $mostrarActaResponsabilidad = ModeloActas::mdlMostrarActas($tabla, $item, $datos);

            $tabla1 = "actacompromiso";
            $datos1 = $mostrarActaResponsabilidad["idacta"];
            
            $eliminarActaCompromiso = ModeloActas::mdlEliminarActaCompromiso($tabla1, $datos1);
            
            if ($eliminarActaCompromiso == "ok") {
                
                $respuesta2 = ModeloActas::mdlEliminarActaResponsabilidadEquipo($tabla, $datos);

                if ($respuesta2 == "ok") {
                    
                    return $respuesta2;
                }
            }
        }
    }
}
