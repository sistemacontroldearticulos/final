<?php 

require_once "conexion.php";

class ModeloReportes{

	// MOSTRAR REPORTES
	static public function mdlMostrarReportes($tabla, $item, $valor){

		if ($item != null) {
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt -> bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt -> execute();

			return $stmt->fetch();

		}else{

	        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
	        $stmt -> execute();

	        return $stmt -> fetchAll();

	    }

        $stmt->close();
        $stmt->null();
	    
	}

	// RANGO FECHAS
	static public function mdlRangoFechasReportes($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

}