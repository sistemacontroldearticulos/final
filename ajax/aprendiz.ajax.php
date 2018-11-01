<?php  

require_once "../controladores/aprendizControlador.php";
require_once '../modelos/aprendizModelo.php';


class AjaxAprendiz{

    // EDITAR APRENDIZ
    public $idAprendiz;

    public function ajaxEditarAprendiz(){

        $item = "NumDocumentoAprendiz";
        $valor = $this->idAprendiz;

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


