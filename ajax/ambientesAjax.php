<?php
require_once "../controladores/ambientesControlador.php";
require_once "../modelos/ambientesModelo.php";

require_once "../controladores/programasControlador.php";
require_once "../modelos/programasModelo.php";

require_once "../controladores/equipoControlador.php";
require_once "../modelos/equipoModelo.php";

class AjaxAmbientes{

    // EDITAR CATEGORÍA
    public $idAmbiente;

    public function ajaxEditarAmbientes(){

        $item = "IdAmbiente";
        $valor = $this->idAmbiente;

        $respuesta = ControladorAmbientes::ctrMostrarAmbientes($item, $valor);

        echo json_encode($respuesta);

    }
    // MOSTRAR TABLA
    public $idAmbiente1;

    public function ajaxVerArticulos(){

        $item = "IdAmbiente";
        $valor = $this->idAmbiente1;

        $respuesta = ControladorAmbientes::ctrMostrarArticulos1($item, $valor);
        echo json_encode($respuesta);

    }
}

// // EDITAR AMBIENTE
if(isset($_POST["idAmbiente"])){

    $ambiente = new AjaxAmbientes();
    $ambiente -> idAmbiente = $_POST["idAmbiente"];
    $ambiente -> ajaxEditarAmbientes();
}

// MOSTRAR TABLA
if(isset($_POST["idAmbiente1"])){

    $mostrar = new AjaxAmbientes();
    $mostrar -> idAmbiente1 = $_POST["idAmbiente1"];
    $mostrar -> ajaxVerArticulos();
}


