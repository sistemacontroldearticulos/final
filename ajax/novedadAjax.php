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


	public $idNovedad1;
	public function ajaxMostrarNovedad1(){

		$item = "idnovedad";
		$valor = $this->idNovedad1;
		$tabla="novedad";
		$respuesta = ControladorNovedades::ctrMostrarNovedades1($tabla,$item, $valor);

		echo json_encode($respuesta);

	}

}
if(isset($_POST["id"])){
	
	$novedad = new AjaxNovedad();
	$novedad -> idNovedad = $_POST["id"];
	$novedad -> ajaxMostrarNovedad();
}

if(isset($_POST["idNovedad"])){
	
	$novedad = new AjaxNovedad();
	$novedad -> idNovedad1 = $_POST["idNovedad"];
	$novedad -> ajaxMostrarNovedad1();
}