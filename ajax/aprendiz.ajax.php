<?php  

require_once "../controladores/aprendizControlador.php";
require_once '../modelos/aprendizModelo.php';


class AjaxAprendiz{

    // EDITAR APRENDIZ
    public $idAprendiz;
    public $ficha;

    public function ajaxEditarAprendiz(){

        $item = "NumDocumentoAprendiz";
        $valor = $this->idAprendiz;

        $respuesta = ControladorAprendiz::ctrMostrarAprendiz($item, $valor);
        echo json_encode($respuesta);

    }

    public function ajaxActasAprendiz(){

        $item = "numeroficha";
        $valor = $this->ficha;

        $respuesta = ControladorAprendiz::ctrMostrarAprendiz($item, $valor);
        echo json_encode($respuesta);


    }

}

// EDITAR APRENDIZ
if(isset($_POST["idAprendiz"])){

    $aprendiz = new AjaxAprendiz();
    $aprendiz -> idAprendiz = $_POST["idAprendiz"];
    $aprendiz -> ajaxEditarAprendiz();
}


//ACTAS APRENDIZ

if(isset($_POST["ficha"])){

    $aprendiz = new AjaxAprendiz();
    $aprendiz -> ficha = $_POST["ficha"];
    $aprendiz -> ajaxActasAprendiz();
}


