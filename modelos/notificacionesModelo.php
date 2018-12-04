<?php

require_once "conexion.php";

class ModeloNotificaciones
{
    public static function mdlCrearNotificacion($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (numdocumentousuario, tipo, fecha, leido) VALUES (:numdocumentousuario, :tipo, :fecha, :leido)");

        $stmt->bindParam(":numdocumentousuario", $datos["numdocumentousuario"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fechaActual"], PDO::PARAM_STR);
        $stmt->bindParam(":leido", $datos["leido"], PDO::PARAM_STR);

        // var_dump($stmt->execute());

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    // MOSTRAR EQUIPOS
    public static function mdlConsultarNotificaciones($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE leido = '0' ORDER BY idnotificacion desc");

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();

        $stmt = null;

    }

    // MOSTRAR EQUIPOS ALL
    public static function idNotificacion()
    {

        $stmt = Conexion::conectar()->prepare("SELECT MAX(idnotificacion) FROM notificaciones");
        // var_dump($stmt);

        if ($stmt->execute()) {

            return $stmt->fetch();

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;
    }

    // BORRAR EQUIPO
    public static function mdlBorrarNotificacion($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idnotificacion = :idnotificacion");

        $stmt->bindParam(":idnotificacion", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    public static function mdlActualizarNtificacion($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET leido='1' WHERE numdocumentousuario = :numdocumentousuario");

        $stmt->bindParam(":numdocumentousuario", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    // BORRAR EQUIPO
    public static function mdlBorrarNotificacion1($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE numdocumentousuario = :numdocumentousuario");

        $stmt->bindParam(":numdocumentousuario", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }
}
