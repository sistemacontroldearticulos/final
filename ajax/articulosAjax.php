<?php
require_once "../controladores/articuloscontrolador.php";
require_once "../modelos/articulosModelo.php";

class AjaxArticulos{

    // EDITAR ARTICULOS
    public $idArticulo;


    public function ajaxEditarArticulos(){

        $item = "IdArticulo";
        $valor = $this->idArticulo;

        $respuesta = ControladorArticulos::ctrMostrarArticulos($item, $valor);

        echo json_encode($respuesta);

    }

}

// EDITAR ARTICULOS
if(isset($_POST["idArticulo"])){

    $articulo = new AjaxArticulos();
    $articulo -> idArticulo = $_POST["idArticulo"];
    $articulo -> ajaxEditarArticulos();
}

