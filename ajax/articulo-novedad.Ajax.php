<?php 
require_once "../controladores/ambientesControlador.php";
require_once "../modelos/ambientesModelo.php";

require_once "../controladores/programasControlador.php";
require_once "../modelos/programasModelo.php";

require_once "../controladores/articulosControlador.php";
require_once "../modelos/articulosModelo.php";

class TablaArticulosNovedad{

  /*=============================================
  MOSTRAR LA TABLA DE ARTICULOS
  =============================================*/ 
  // public $idambiente = $_POST["idambiente1"];
  public $idnovedad;

  public function mostrarTablaArticulosNovedad(){

   
    // $item = "idambiente";
    // $valor = "7";

    // $item = "idnovedad";
    // $valor = "17";

    $respuesta = ControladorArticulos::ctrMostrarArticuloNovedad($item, $valor);
    // echo json_encode($respuesta);
    // var_dump($respuesta);
    echo '{
            "data": [';

            for($i = 0; $i < count($respuesta)-1; $i++){

                // $item = "idequipo";
                // $valor = $respuesta[$i]["idequipo"];

                // $equipo = ControladorEquipos::ctrMostrarEquipos($item, $valor);

                // $item1 = "idambiente";        
                // $valor1 = $respuesta[$i]["idambiente"];

                // $ambientes = ControladorAmbientes::ctrMostrarAmbientes($item1, $valor1);

                $item1 = "idarticulo";
                $valor1 = $respuesta[$i]["idarticulo"];
                $respuesta1 = ControladorArticulos::ctrMostrarArticulos($item1, $valor1);

                 echo '[
                  "'.$respuesta[$i]["idnovedad"].'",
                  "'.$respuesta[$i]["idarticulo"].'",
                  "'.$respuesta1["tipoarticulo"].'",
                  "'.$respuesta[$i]["tiponovedad"].'",
                  "'.$respuesta[$i]["observacionnovedad"].'"
                ],';

            }

            $item1 = "idarticulo";
            $valor1 = $respuesta[count($respuesta)-1]["idarticulo"];
            $respuesta1 = ControladorArticulos::ctrMostrarArticulos($item1, $valor1);

           echo'[
                  "'.$respuesta[$i]["idnovedad"].'",
                  "'.$respuesta[count($respuesta)-1]["idarticulo"].'",
                  "'.$respuesta1["tipoarticulo"].'",
                  "'.$respuesta[count($respuesta)-1]["tiponovedad"].'",
                  "'.$respuesta[count($respuesta)-1]["observacionnovedad"].'"
                ]
            ]
        }';

   }

}

/*=============================================
ACTIVAR TABLA DE ARTICULOS
=============================================*/
$activar = new TablaArticulos();
$activar -> mostrarTablaArticulosNovedad();

// if(isset($_POST["idnovedad"])){

//     $novedad = new TablaArticulosNovedad();
//     $novedad -> idnovedad = $_POST["idnovedad"];
//     $novedad -> mostrarTablaArticulosNovedad();
// }
