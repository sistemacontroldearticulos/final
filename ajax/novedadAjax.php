<?php 

require_once "../controladores/articulosControlador.php";
require_once "../modelos/articulosModelo.php";

require_once "../controladores/novedadesControlador.php";
require_once "../modelos/novedadesModelo.php";

class AjaxNovedad{

	public $idNovedad;

	public function ajaxMostrarNovedad(){

		$item = "idnovedad";
		$valor = $this->idNovedad;

		$respuesta = ControladorNovedades::ctrMostrarNovedades($item, $valor);

		echo json_encode($respuesta);

	}

}

if ($_POST["id"]) {
	
	$novedad = new AjaxNovedad();
	$novedad -> idNovedad = $_POST["id"];
	$novedad -> ajaxMostrarNovedad();
}