<?php 

require_once "../controladores/actasControlador.php";
require_once "../modelos/actasModelo.php";

class AjaxActas{
	// VALIDAR APRENDIZ ACTA
	public $aprendiz;

	public function ajaxMostrarAprendizActa(){

		$item = "numdocumentoaprendiz";
		$valor = $this->aprendiz;

		$respuesta = ControladorActas::ctrMostrarActas($item, $valor);
		echo json_encode($respuesta);
	}

	// VALIDAR EQUIPO ACTA
	public $equipo;

	public function ajaxMostrarEquipoActa(){

		$item = "idequipo";
		$valor = $this->equipo;

		$respuesta = ControladorActas::ctrMostrarActas($item, $valor);
		echo json_encode($respuesta);
	}
}


if (isset($_POST["equipo"])) {

	$mostrarAprendiz = new AjaxActas();
	$mostrarAprendiz -> equipo = $_POST["equipo"];
	$mostrarAprendiz -> ajaxMostrarEquipoActa();
}