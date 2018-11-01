<?php
require_once "../controladores/fichasControlador.php";
require_once "../modelos/fichasModelo.php";

class AjaxFichas{

    // EDITAR FICHA
    public $idFicha;

    public function ajaxEditarFicha(){

        $item = "NumeroFicha";
        $valor = $this->idFicha;

        $respuesta = ControladorFichas::ctrMostrarFichas($item, $valor);
        
        echo json_encode($respuesta);

    }

    // VALIDAR NO REPETIR USUARIO
    public $validarFicha;
    public function ajaxValidarFicha(){

        $item = "NumeroFicha";
        $valor = $this->validarFicha;

        $respuesta = ControladorFichas::ctrMostrarFichas($item, $valor);

        echo json_encode($respuesta);

    }

    // BUSCRA FICHA
    public $idFicha1;

    public function ajaxBuscarFicha(){

        $item = "NumeroFicha";
        $valor = $this->idFicha1;

        $respuesta = ControladorFichas::ctrMostrarFichas($item, $valor);

        echo json_encode($respuesta);

    }
}
// EDITAR FICHA
if(isset($_POST["idFicha"])){

    $ambiente = new AjaxFichas();
    $ambiente -> idFicha = $_POST["idFicha"];
    $ambiente -> ajaxEditarFicha();
}

// BUSCAR FICHA
if(isset($_POST["sel"])){
    
    $ficha1 = new AjaxFichas();
    $ficha1 -> idFicha1 = $_POST["sel"];
    $ficha1 -> ajaxBuscarFicha();
}

// VALIDAR FICHA
if(isset($_POST["validarFicha"])){

    $valFicha = new AjaxFichas();
    $valFicha -> validarFicha = $_POST["validarFicha"];
    $valFicha -> ajaxValidarFicha();
}

