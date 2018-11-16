<?php 

require_once "conexion.php";

class ModeloActas{

	static public function mdlCrearActa($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(numdocumentoaprendiz, idequipo, fechaacta) VALUES (:numdocumentoaprendiz, :idequipo, :fechaacta)");

        $stmt->bindParam(":numdocumentoaprendiz", $datos["numdocumentoaprendiz"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaacta", $datos["fechaacta"], PDO::PARAM_STR);
        $stmt->bindParam(":idequipo", $datos["idequipo"], PDO::PARAM_STR);
        $stmt->execute();
        
        if ($stmt == true) {
            return "ok";

        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlMostrarActas($tabla, $item, $valor){

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
}