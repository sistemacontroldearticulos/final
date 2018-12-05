<?php 
require_once "conexion.php";

class ModeloFichas{ 

	static public function mdlAgregarFichas($tabla, $datos){
        // echo '<pre>'; print_r($datos); echo '</pre>';

        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (NumeroFicha, IdPrograma, IdAmbiente, FechaInicio, FechaFin, JornadaFicha) VALUES (:NumeroFicha, :IdPrograma, :IdAmbiente, :FechaInicio, :FechaFin, :JornadaFicha)");

        $stmt->bindParam(":NumeroFicha", $datos["NumeroFicha"], PDO::PARAM_STR);
        $stmt->bindParam(":IdPrograma", $datos["IdPrograma"], PDO::PARAM_STR);
        $stmt->bindParam(":IdAmbiente", $datos["IdAmbiente"], PDO::PARAM_STR);
        $stmt->bindParam(":FechaInicio", $datos["FechaInicio"], PDO::PARAM_STR);
        $stmt->bindParam(":FechaFin", $datos["FechaFin"], PDO::PARAM_STR);
        $stmt->bindParam(":JornadaFicha", $datos["JornadaFicha"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;
	}

    // MOSTRAR FICHAS
    static public function mdlMostrarFichas($tabla, $item, $valor){
            
            if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();

        $stmt->null();
    }

    // EDITAR FICHA
    static public function mdlEditarFichas($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(" UPDATE $tabla SET IdPrograma =:IdPrograma, IdAmbiente =:IdAmbiente, FechaInicio =:FechaInicio, FechaFin =:FechaFin, JornadaFicha =:JornadaFicha WHERE NumeroFicha=:NumeroFicha ");

            $stmt->bindParam(":NumeroFicha", $datos["NumeroFicha"], PDO::PARAM_STR);
            $stmt->bindParam(":IdPrograma", $datos["IdPrograma"], PDO::PARAM_STR);
            $stmt->bindParam(":IdAmbiente", $datos["IdAmbiente"], PDO::PARAM_STR);
            $stmt->bindParam(":FechaInicio", $datos["FechaInicio"], PDO::PARAM_STR);
            $stmt->bindParam(":FechaFin", $datos["FechaFin"], PDO::PARAM_STR);
            $stmt->bindParam(":JornadaFicha", $datos["JornadaFicha"], PDO::PARAM_STR);
            
        
        if ($stmt->execute()) {
            return "ok";

        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    // BORRAR FICHA
    static public function mdlEliminarFicha($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE NumeroFicha = :NumeroFicha");

        $stmt -> bindParam(":NumeroFicha", $datos, PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";
        
        }else{

            return "error"; 

        }

        $stmt -> close();

        $stmt = null;

    }

    static public function mdlBuscarFichaPrograma($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE IdPrograma = :idPrograma");

        $stmt->bindParam(":idPrograma", $datos, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();
        $stmt = null;
    }

    static public function mdlMostrarFichaAmbiente($tabla, $item, $valor){
            
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        }
    }

    static public function mdlMostrarFichaAprendiz($tabla, $item, $valor){
            
        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        }
    }
}