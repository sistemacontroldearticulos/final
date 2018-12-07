<?php 

require_once "../controladores/usuariosControlador.php";
require_once "../controladores/novedadesControlador.php";
require_once "../modelos/usuariosModelo.php";

class AjaxUsuarios{

    /*=============================================
    EDITAR USUARIO
    =============================================*/

    public $idUsuario;

    public function ajaxEditarUsuario(){

        $item = "NumDocumentoUsuario";
        $valor = $this->idUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }

    /*=============================================
    REVISAR SI EL USUARIO YA ESTÁ REGISTRADO
    =============================================*/

    public $ValidarDocumento;

    public function ajaxValidarDococumento(){

        $item = "NumDocumentoUsuario";
        $valor = $this->ValidarDocumento;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }

    public $NumDocumentoUsuario;

    public function ajaxValidaPrograma(){



        $item = "NumDocumentoUsuario";
        $valor = $this->NumDocumentoUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);

    }

}

/*=============================================
EDITAR USUARIO
=============================================*/
if(isset($_POST["idUsuario"])){

    $editar = new AjaxUsuarios();
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxEditarUsuario();

}

/*=============================================
REVISAR SI EL USUARIO YA ESTÁ REGISTRADO

=============================================*/
if(isset($_POST["ValidarDocumento"])){

    $valDocumento = new AjaxUsuarios();

    $valDocumento -> ValidarDocumento = $_POST["ValidarDocumento"];

    $valDocumento -> ajaxValidarDococumento();
}

if(isset($_POST["documento"])){

   $valDocumento = new AjaxUsuarios();

    $valDocumento -> NumDocumentoUsuario = $_POST["documento"];
    

    $valDocumento -> ajaxValidaPrograma();
}



