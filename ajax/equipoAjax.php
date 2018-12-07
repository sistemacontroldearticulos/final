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
        $valor = $this->idEquipos;

        $respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor);

		echo json_encode($respuesta);
    }
    // VALIDAR EQUIPO
    public $nombreequipo;
	public function ajaxValidarEquipo()
	{
		$item = "nombreequipo";
		$valor = $this->nombreequipo;

		$respuesta = ControladorEquipos::ctrMostrarEquipos($item, $valor);

		echo json_encode($respuesta);
	}

	// VALIDAR EQUIPO
    public $idAmbiente;
	public function ajaxMostrarEquiposAmbiente()
	{
		$item = "idAmbiente";
		$valor = $this->idAmbiente;

		$respuesta = ControladorEquipos::ctrMostrarEquipos1($item, $valor);

		echo json_encode($respuesta);
	}
}
// VALIDAR EQUIPO
if(isset($_POST["nombreEquipo"])){

	$equipo = new AjaxEquipo();
	$equipo -> nombreequipo = strtoupper($_POST["nombreEquipo"]);
	$equipo -> ajaxValidarEquipo();
}

if(isset($_POST["sel"])){

    $equipo = new AjaxEquipo();
    $equipo -> idEquipos = $_POST["sel"];
    $equipo -> ajaxEquipoArticulo();
}

if(isset($_POST["idEquipo"])){

    $equipo = new AjaxEquipo();
    $equipo -> idEquipo = $_POST["idEquipo"];
    $equipo -> ajaxEditarEquipo();
}

if(isset($_POST["idAmbiente"])){

    $equipo = new AjaxEquipo();
    $equipo -> idAmbiente = $_POST["idAmbiente"];
    $equipo -> ajaxMostrarEquiposAmbiente();
}
