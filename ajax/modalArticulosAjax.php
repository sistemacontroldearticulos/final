<?php

require_once "../controladores/articulosControlador.php";
require_once "../controladores/novedadesControlador.php";
require_once "../modelos/articulosModelo.php";
require_once "../modelos/novedadesModelo.php";

class ModalArticulos
{

    public $idnovedad;

    public function mostrarTabla()
    {

        $item  = "idnovedad";
        $valor = $this->idnovedad;

        $respuesta = ControladorArticulos::ctrMostrarArticuloNovedad($item, $valor);

        echo json_encode($respuesta);

    }
}

if (isset($_POST["id"])) {

    $activar            = new ModalArticulos();
    $activar->idnovedad = $_POST["id"];
    $activar->mostrarTabla();
}
