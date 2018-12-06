<?php

require_once "conexion.php";

class ModeloEquipos
{
    public static function mdlCrearEquipo($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (NombreEquipo, EstadoEquipo, NumArticulosEquipo, ObservacionEquipo, NumArticulosAgregados, idambiente) VALUES (:NombreEquipo, :EstadoEquipo, :NumArticulosEquipo, :ObservacionEquipo, :NumArticulosAgregados, :idambiente )");

        $stmt->bindParam(":NombreEquipo", $datos["NuevoEquipo"], PDO::PARAM_STR);
        $stmt->bindParam(":idambiente", $datos["idambiente"], PDO::PARAM_STR);
        $stmt->bindParam(":EstadoEquipo", $datos["NuevoEstado"], PDO::PARAM_STR);
        $stmt->bindParam(":NumArticulosEquipo", $datos["NumArticulosEquipo"], PDO::PARAM_STR);
        $stmt->bindParam(":ObservacionEquipo", $datos["NuevaObservacion"], PDO::PARAM_STR);
        $stmt->bindParam(":NumArticulosAgregados", $datos["NumArticulosAgregados"], PDO::PARAM_STR);

        // var_dump($stmt->execute());

        if ($stmt->execute()) {

            return "ok";

        } else {
            var_dump($stmt);
            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    // MOSTRAR EQUIPOS
    public static function mdlMostrarEquipos($tabla, $item, $valor)
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

    // MOSTRAR EQUIPOS ALL
    public static function mdlMostrarEquipos1($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;

    }

    // BORRAR EQUIPO
    public static function mdlBorrarEquipo($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE IdEquipo = :IdEquipo");

        $stmt->bindParam(":IdEquipo", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    public static function mdlEditarEquipo($tabla, $datos)
    {


        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET NombreEquipo=:NombreEquipo,EstadoEquipo=:EstadoEquipo,NumArticulosEquipo=:NumArticulosEquipo,ObservacionEquipo=:ObservacionEquipo,NumArticulosAgregados=:NumArticulosAgregados, idambiente=:idambiente WHERE IdEquipo=:IdEquipo");
        var_dump($stmt);
        $stmt->bindParam(":NombreEquipo", $datos["NuevoEquipo"], PDO::PARAM_STR);
        $stmt->bindParam(":EstadoEquipo", $datos["NuevoEstado"], PDO::PARAM_STR);
        $stmt->bindParam(":NumArticulosEquipo", $datos["NumArticulosEquipo"], PDO::PARAM_STR);
        $stmt->bindParam(":ObservacionEquipo", $datos["NuevaObservacion"], PDO::PARAM_STR);
        $stmt->bindParam(":NumArticulosAgregados", $datos["NumArticulosAgregados"], PDO::PARAM_STR);
        $stmt->bindParam(":IdEquipo", $datos["IdEquipo"], PDO::PARAM_STR);
        $stmt->bindParam(":idambiente", $datos["idambiente"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

}
