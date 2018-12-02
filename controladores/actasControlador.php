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

            echo '<script>
                     window.open("extensiones/tcpdf/pdf/actaFicha.php?codigo='.$_POST["ficha1"].', _blank");
                </script>';

            // $item = "numeroficha";
            // $valor = $_POST["ficha"];
            // $ficha = ControladorFichas::ctrMostrarFichas($item, $valor);
            
            // $item1 = "idambiente";
            // $valor1 = $ficha["idambiente"];
            // $ambiente = ControladorAmbientes::ctrMostrarAmbientes($item1, $valor1);

            // $item2 = "idambiente";
            // $valor2 = $ficha["idambiente"];
            // $tabla = "articulo";
            // $articulo = ModeloArticulos::mdlMostrarArticuloNovedad($tabla, $item2, $valor2);

            // $a = 0;
            // $b = 0;

            // foreach ($articulo as $key => $value) {
                
            // $item3 = "idequipo";
            // $valor3 = $articulo[$key]["idequipo"];
            // $tabla1 = "equipo";
            // $equipo = ModeloArticulos::mdlMostrarArticulosEquipo1($tabla1, $item3, $valor3);
                
            //     $item4 = "idequipo";
            //     $valor4 = $articulo[$key]["idequipo"];

            //     $respuesta4 = ControladorActas::ctrMostrarActas($item4, $valor4);

            //     if ($respuesta4 != "") {
            //         $a = $a + 1;    
            //     }
            // }
            

            // if ($a == 0) {
            //     echo '<script>

            //     swal({
            //         type: "error",
            //         title: "No hay actas en esta ficha",
            //         showConfirmButton: true,
            //         confirmButtonText: "Cerrar"

            //     }).then(function(result){

            //         if(result.value){

            //             window.location = "actas";

            //         }

            //     });

            //     </script>';
            // }else{

            //     echo '<script>
            //              window.open("extensiones/tcpdf/pdf/actaFicha.php?codigo='.$_POST["ficha"].', _blank");
            //         </script>';

            //     echo '<script>

            //             window.location = "actas";

            //     </script>';
            // }
        }
    }
}
