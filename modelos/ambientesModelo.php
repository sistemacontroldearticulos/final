<?php
require_once "conexion.php";

class ModeloAmbientes
{

    static public function mdlCrearAmbientes($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(NombreAmbiente, UbicacionAmbiente, IdPrograma) VALUES(:NombreAmbiente, :UbicacionAmbiente, :IdPrograma)");

        $stmt->bindParam(":NombreAmbiente", $datos["NombreAmbiente"], PDO::PARAM_STR);
        $stmt->bindParam(":UbicacionAmbiente", $datos["UbicacionAmbiente"], PDO::PARAM_STR);
        $stmt->bindParam(":IdPrograma", $datos["IdPrograma"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    static public function mdlMostrarAmbientes($tabla, $item, $valor)
    {

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

    // EDITAR AMBIENTE
    static public function mdlEditarAmbientes($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET IdPrograma=:IdPrograma, NombreAmbiente =:NombreAmbiente, UbicacionAmbiente =:UbicacionAmbiente WHERE IdAmbiente=:IdAmbiente");

        $stmt->bindParam(":NombreAmbiente", $datos["NombreAmbiente"], PDO::PARAM_STR);
        $stmt->bindParam(":UbicacionAmbiente", $datos["UbicacionAmbiente"], PDO::PARAM_STR);
        $stmt->bindParam(":IdPrograma", $datos["IdPrograma"], PDO::PARAM_STR);
        $stmt->bindParam(":IdAmbiente", $datos["IdAmbiente"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";

        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    // ELIMINAR AMBIENTE
    public function mdlEliminarAmbiente($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idambiente=:idambiente");

        $stmt->bindParam(":idambiente", $datos, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    public function mdlBuscarAmbientePrograma($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE IdPrograma = :idPrograma");

        $stmt->bindParam(":idPrograma", $datos, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();
        $stmt = null;
    }

    static public function mdlMostrarArticulos1($tabla, $item, $valor){

    if($item != null){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

    }else{

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt -> execute();

        return $stmt -> fetchAll();

    }

    $stmt -> close();

    $stmt = null;
    }

    
}
