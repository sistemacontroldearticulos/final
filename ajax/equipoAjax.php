<?php 

require_once "../controladores/equipoControlador.php"; 
require_once "../modelos/equipoModelo.php";

/*=============================================
=     		   EDITAR EQUIPO          		=
=============================================*/

class AjaxEquipo
{
	public $idEquipo;

	public function ajaxEditarEquipo()
	{
		$item = "IdEquipo";
		$valor = $this->idEquipo;

		$respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor);

		echo json_encode($respuesta);
	}
	public function ajaxEquipoArticulo(){

        $item = "IdEquipo";
        $valor = $this->idEquipo;

        $respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor);

		echo json_encode($respuesta);

    }
}

if(isset($_POST["idEquipo"])){

	$equipo = new AjaxEquipo();
	$equipo -> idEquipo = $_POST["idEquipo"];
	$equipo -> ajaxEditarEquipo();
}

if(isset($_POST["sel"])){

    $equipo = new AjaxEquipo();
    $equipo -> idEquipo = $_POST["sel"];
    $equipo -> ajaxEquipoArticulo();
}

