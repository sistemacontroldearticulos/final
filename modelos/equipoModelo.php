<?php 

	require_once "conexion.php";

class ModeloEquipos
{
	static public function mdlCrearEquipo($tabla, $datos)
	{
		var_dump($datos);
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (NombreEquipo, EstadoEquipo, NumArticulosEquipo, ObservacionEquipo, NumArticulosAgregados) VALUES (:NombreEquipo, :EstadoEquipo, :NumArticulosEquipo, :ObservacionEquipo, :NumArticulosAgregados)");

        $stmt->bindParam(":NombreEquipo", $datos["NuevoEquipo"], PDO::PARAM_STR);
        $stmt->bindParam(":EstadoEquipo", $datos["NuevoEstado"], PDO::PARAM_STR);
        $stmt->bindParam(":NumArticulosEquipo", $datos["NumArticulosEquipo"], PDO::PARAM_STR);
        $stmt->bindParam(":ObservacionEquipo", $datos["NuevaObservacion"], PDO::PARAM_STR);
        $stmt->bindParam(":NumArticulosAgregados", $datos["NumArticulosAgregados"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;
	}

    // MOSTRAR EQUIPOS
    static public function mdlMostrarEquipos($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();

        $stmt = null;

    }

    // BORRAR EQUIPO
    static public function mdlBorrarEquipo($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE IdEquipo = :IdEquipo");

        $stmt -> bindParam(":IdEquipo", $datos, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";
        
        }else{

            return "error"; 

        }

        $stmt -> close();

        $stmt = null;

    }

    static public function mdlEditarEquipo($tabla, $datos){
        // var_dump($datos);

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET NombreEquipo=:NombreEquipo,EstadoEquipo=:EstadoEquipo,NumArticulosEquipo=:NumArticulosEquipo,ObservacionEquipo=:ObservacionEquipo,NumArticulosAgregados=:NumArticulosAgregados WHERE IdEquipo=:IdEquipo");

        $stmt->bindParam(":NombreEquipo", $datos["NuevoEquipo"], PDO::PARAM_STR);
        $stmt->bindParam(":EstadoEquipo", $datos["NuevoEstado"], PDO::PARAM_STR);
        $stmt->bindParam(":NumArticulosEquipo", $datos["NumArticulosEquipo"], PDO::PARAM_STR);
        $stmt->bindParam(":ObservacionEquipo", $datos["NuevaObservacion"], PDO::PARAM_STR);
        $stmt->bindParam(":NumArticulosAgregados", $datos["NumArticulosAgregados"], PDO::PARAM_STR);
        $stmt->bindParam(":IdEquipo", $datos["IdEquipo"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        
        }

        $stmt->close();
        $stmt = null;

    }

    
}