<?php

require_once "conexion.php";

class ModeloActas
{

    public static function mdlCrearActa($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(numdocumentoaprendiz, idequipo, fechaacta, numdocumentoinstructor) VALUES (:numdocumentoaprendiz, :idequipo, :fechaacta, :numdocumentoinstructor)");
        var_dump($stmt);
        $stmt->bindParam(":numdocumentoaprendiz", $datos["numdocumentoaprendiz"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaacta", $datos["fechaacta"], PDO::PARAM_STR);
        $stmt->bindParam(":idequipo", $datos["idequipo"], PDO::PARAM_STR);
        $stmt->bindParam(":numdocumentoinstructor", $datos["numdocumentoinstructor"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";

        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    public static function mdlMostrarActas($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;
    }
}
