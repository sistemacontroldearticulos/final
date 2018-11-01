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
}


if(isset($_POST["idCategoria"])){

	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}
