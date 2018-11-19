<?php 

class ControladorReportes{

	// MOSTRAR REPORTES
	static public function ctrMostrarReportes($item, $valor){

		$tabla = "articulonovedad";

		$respuesta = ModeloReportes::mdlMostrarReportes($tabla, $item,$valor);

		return $respuesta;
	}

	// RANGO DE FECHAS
	static public function ctrRangoFechasReportes($fechaInicial, $fechaFinal){

		$tabla = "novedad";

		$respuesta = ModeloReportes::mdlRangoFechasReportes($tabla, $fechaInicial, $fechaFinal);
		
		var_dump($respuesta);

		//return $respuesta;
		
	}
}