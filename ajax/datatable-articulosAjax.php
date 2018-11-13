<?php 
require_once "../controladores/ambientesControlador.php";
require_once "../modelos/ambientesModelo.php";

require_once "../controladores/programasControlador.php";
require_once "../modelos/programasModelo.php";

require_once "../controladores/equipoControlador.php";
require_once "../modelos/equipoModelo.php";

class TablaArticulos{

  /*=============================================
  MOSTRAR LA TABLA DE ARTICULOS
  =============================================*/ 
  // public $idambiente = $_POST["idambiente1"];

  public function mostrarTabla(){

   
    // $item = "idambiente";
    // $valor = "7";

    $item = null;
    $valor = null;

    $respuesta = ControladorAmbientes::ctrMostrarArticulos1($item, $valor);
    // echo '<pre>'; print_r(respuesta); echo '</pre>';
    // var_dump($respuesta);

    if ($respuesta != "data:[]") {
     echo '{
            "data": [';

            for($i = 0; $i < count($respuesta)-1; $i++){

                $item = "idequipo";
                $valor = $respuesta[$i]["idequipo"];

                $equipo = ControladorEquipos::ctrMostrarEquipos($item, $valor);

                $item1 = "idambiente";        
                $valor1 = $respuesta[$i]["idambiente"];

                $ambientes = ControladorAmbientes::ctrMostrarAmbientes($item1, $valor1);

                 echo '[
                  "'.$respuesta[$i]["idarticulo"].'",
                  "'.$respuesta[$i]["tipoarticulo"].'",
                  "'.$respuesta[$i]["numinventariosena"].'",
                  
                  "'.$equipo["nombreequipo"].' '.$equipo["idequipo"].'",
                  "'.$ambientes["nombreambiente"].'"
                ],';

            }
            echo']
        }';
      
    }else{

       echo '{
            "data": [';

            for($i = 0; $i < count($respuesta)-1; $i++){

                $item = "idequipo";
                $valor = $respuesta[$i]["idequipo"];

                $equipo = ControladorEquipos::ctrMostrarEquipos($item, $valor);

                $item1 = "idambiente";        
                $valor1 = $respuesta[$i]["idambiente"];

                $ambientes = ControladorAmbientes::ctrMostrarAmbientes($item1, $valor1);

                 echo '[
                  "'.$respuesta[$i]["idarticulo"].'",
                  "'.$respuesta[$i]["tipoarticulo"].'",
                  "'.$respuesta[$i]["numinventariosena"].'",
                  
                  "'.$equipo["nombreequipo"].' '.$equipo["idequipo"].'",
                  "'.$ambientes["nombreambiente"].'"
                ],';

            }

            $item = "idequipo";
            $valor = $respuesta[count($respuesta)-1]["idequipo"];

            $equipo = ControladorEquipos::ctrMostrarEquipos($item, $valor);

            $item1 = "idambiente";
            $valor1 = $respuesta[count($respuesta)-1]["idambiente"];

            $ambientes = ControladorAmbientes::ctrMostrarAmbientes($item1, $valor1);

           echo'[
                  "'.$respuesta[$i]["idarticulo"].'",
                  "'.$respuesta[count($respuesta)-1]["tipoarticulo"].'",
                  "'.$respuesta[count($respuesta)-1]["numinventariosena"].'",
                  
                  "'.$equipo["nombreequipo"].' '.$equipo["idequipo"].'",
                  "'.$ambientes["nombreambiente"].'"
                ]

            ]
        }';

    }
    
    // echo '{
    //         "data": [';

    //         for($i = 0; $i < count($respuesta)-1; $i++){

    //             $item = "idequipo";
    //             $valor = $respuesta[$i]["idequipo"];

    //             $equipo = ControladorEquipos::ctrMostrarEquipos($item, $valor);

    //             $item1 = "idambiente";        
    //             $valor1 = $respuesta[$i]["idambiente"];

    //             $ambientes = ControladorAmbientes::ctrMostrarAmbientes($item1, $valor1);

    //              echo '[
    //               "'.$respuesta[$i]["idarticulo"].'",
    //               "'.$respuesta[$i]["tipoarticulo"].'",
    //               "'.$respuesta[$i]["numinventariosena"].'",
                  
    //               "'.$equipo["nombreequipo"].' '.$equipo["idequipo"].'",
    //               "'.$ambientes["nombreambiente"].'"
    //             ],';

    //         }

    //         $item = "idequipo";
    //         $valor = $respuesta[count($respuesta)-1]["idequipo"];

    //         $equipo = ControladorEquipos::ctrMostrarEquipos($item, $valor);

    //         $item1 = "idambiente";
    //         $valor1 = $respuesta[count($respuesta)-1]["idambiente"];

    //         $ambientes = ControladorAmbientes::ctrMostrarAmbientes($item1, $valor1);

    //        echo'[
    //               "'.$respuesta[$i]["idarticulo"].'",
    //               "'.$respuesta[count($respuesta)-1]["tipoarticulo"].'",
    //               "'.$respuesta[count($respuesta)-1]["numinventariosena"].'",
                  
    //               "'.$equipo["nombreequipo"].' '.$equipo["idequipo"].'",
    //               "'.$ambientes["nombreambiente"].'"
    //             ]

    //         ]
    //     }';


  }


}

/*=============================================
ACTIVAR TABLA DE ARTICULOS
=============================================*/
$activar = new TablaArticulos();
$activar -> mostrarTabla();