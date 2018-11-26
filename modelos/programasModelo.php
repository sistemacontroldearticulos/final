<?php
require_once "conexion.php";

class ModelosProgramas
{
    static public function mdlCrearPrograma($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(NombrePrograma, TipoPrograma) VALUES (:NombrePrograma,  :TipoPrograma)");

        $stmt->bindParam(":NombrePrograma", $datos["NuevoPrograma"], PDO::PARAM_STR);
        $stmt->bindParam(":TipoPrograma", $datos["TipoPrograma"], PDO::PARAM_STR);
        // $stmt->bindParam(":DuracionPrograma", $datos["DuracionPrograma"], PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt == true) {
            return "ok";

        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    static public function mdlMostrarProgramas($tabla, $item, $valor)
    {

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item= :$item");

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

    static public function mdlEditarPrograma($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(" UPDATE $tabla SET NombrePrograma= :NombrePrograma, TipoPrograma = :TipoPrograma where IdPrograma=:idPrograma");

        $stmt->bindParam(":NombrePrograma", $datos["EditarPrograma"], PDO::PARAM_STR);
        $stmt->bindParam(":TipoPrograma", $datos["TipoPrograma"], PDO::PARAM_STR);
        // $stmt->bindParam(":DuracionPrograma", $datos["DuracionPrograma"], PDO::PARAM_STR);
        $stmt->bindParam(":idPrograma", $datos["idPrograma"], PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt == true) {
            return "ok";

        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    public static function mdlBorrarPrograma($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE IdPrograma=:idPrograma");

        $stmt->bindParam(":idPrograma", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }
}
