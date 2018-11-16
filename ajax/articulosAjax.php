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

    // VALIDAR SERIAL ARTICULO
    public $serialarticulo;

    public function ajaxValidarSerial(){

        $item = "serialarticulo";
        $valor = $this->serialarticulo;

        $respuesta = ControladorArticulos::ctrMostrarArticulos($item, $valor);

        echo json_encode($respuesta);

    }

    // VALIDAR NUMERO INVENTARIO ARTICULO
    public $numinventario;

    public function ajaxValidarInventario(){

        $item = "numinventariosena";
        $valor = $this->numinventario;

        $respuesta = ControladorArticulos::ctrMostrarArticulos($item, $valor);

        echo json_encode($respuesta);

    }

    // MOSTRAR ARTICULOS AMBIENTES
    public $idambiente;
    public function ajaxMostrarArticulosAmbiente(){

        $item = "idambiente";
        $valor = $this->idambiente;
        $tabla = "articulo";

        $respuesta = ModeloArticulos::mdlMostrarArticuloNovedad($tabla, $item, $valor);

        echo json_encode($respuesta);

    }

}

// EDITAR ARTICULOS
if(isset($_POST["idArticulo"])){

    $articulo = new AjaxArticulos();
    $articulo -> idArticulo = $_POST["idArticulo"];
    $articulo -> ajaxEditarArticulos();
}

// VALIDAR SERIAL ARTICULO
if(isset($_POST["serialArticulo"])){

    $articulo = new AjaxArticulos();
    $articulo -> serialarticulo = strtoupper($_POST["serialArticulo"]);
    $articulo -> ajaxValidarSerial();
}

// VALIDAR NUMERO INVENTARIO ARTICULO
if(isset($_POST["numInventario"])){

    $articulo = new AjaxArticulos();
    $articulo -> numinventario = strtoupper($_POST["numInventario"]);
    $articulo -> ajaxValidarInventario();
}

// MOSTRAR ARTICULOS AMBIENTE
if(isset($_POST["idAmbiente"])){

    $articulo = new AjaxArticulos();
    $articulo -> idambiente = strtoupper($_POST["idAmbiente"]);
    $articulo -> ajaxMostrarArticulosAmbiente();
}