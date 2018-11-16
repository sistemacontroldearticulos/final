<?php 

require_once "../controladores/categoriasControlador.php";
require_once "../modelos/categoriasModelo.php";

class AjaxCategorias{

	public $idCategoria;

	public function ajaxEditarCategoria(){

		$item = "IdCategoria";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}

	// VALIDAR CATEGORIA
	public $nombrecategoria;

	public function ajaxValidarCategoria(){

		$item = "nombrecategoria";
		$valor = $this->nombrecategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}
}


if(isset($_POST["idCategoria"])){

	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}

//VALIDAR CATEGORIA
if(isset($_POST["nombreCategoria"])){

	$categoria = new AjaxCategorias();
	$categoria -> nombrecategoria = strtoupper($_POST["nombreCategoria"]);
	$categoria -> ajaxValidarCategoria();
}
