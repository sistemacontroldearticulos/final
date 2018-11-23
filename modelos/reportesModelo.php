<?php

require_once "conexion.php";

class ModeloReportes
{

    // MOSTRAR REPORTES
    public static function mdlMostrarReportes($tabla, $item, $valor)
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
        $stmt->null();

    }

    // RANGO FECHAS
    public static function mdlRangoFechasReportes($tabla, $fechaInicial, $fechaFinal)
    {

        if ($fechaInicial == null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt -> fetchAll();

        } else if ($fechaInicial == $fechaFinal) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechanovedad like '%$fechaFinal%'");

            $stmt->execute();

            return $stmt->fetchAll();

        }  else {

            // $fecha = "2006/05/04"; 
            // list($anio, $mes, $dia) = explode("/",$fecha); 
            // echo "Año: $anio <br />"; 
            // echo "Mes: $mes <br />"; 
            // echo "Dia: $dia <br />"; 

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechanovedad BETWEEN '$fechaInicial' AND '$fechaFinal'");

            $stmt->execute();

            return $stmt->fetchAll();

        }

    }

}
