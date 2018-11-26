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

	//MOSTRAR ACTA
	public $idActa;

	public function ajaxMostrarActa(){

		$item = "idActa";
		$valor = $this->idActa;

		$respuesta = ControladorActas::ctrMostrarActas($item, $valor);
		echo json_encode($respuesta);
	}
}


if (isset($_POST["equipo"])) {

	$equipo = new AjaxActas();
	$equipo -> equipo = $_POST["equipo"];
	$equipo -> ajaxMostrarEquipoActa();
}

if (isset($_POST["numdocumentoaprendiz"])) {

	$aprendiz = new AjaxActas();
	$aprendiz -> aprendiz = $_POST["numdocumentoaprendiz"];
	$aprendiz -> ajaxMostrarAprendizActa();
}

if (isset($_POST["idActa"])) {

	$acta = new AjaxActas();
	$acta -> idActa = $_POST["idActa"];
	$acta -> ajaxMostrarActa();
}