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
    public static function mdlRangoFechasReportes($tabla, $fechaInicial, $fechaFinal, $idAmbiente)
    
    {
        

        if ($fechaInicial == null) {
            if($idAmbiente=="")
            {
                $stmt = Conexion::conectar()->prepare("SELECT *  FROM $tabla");

            $stmt->execute();

            return $stmt -> fetchAll();
            }
            else
            {
                $stmt = Conexion::conectar()->prepare("SELECT novedad.*, ambiente.idambiente  FROM $tabla
                    join ficha on (novedad.numeroficha=ficha.numeroficha)
                    join ambiente on (ambiente.idambiente=ficha.idambiente)
                    where ambiente.idAmbiente=$idAmbiente");

            $stmt->execute();
            echo '<pre>'; print_r($stmt); echo '</pre>';

            return $stmt -> fetchAll();
            }

            


        } else if ($fechaInicial == $fechaFinal) {

           // FECHA INICIAL
            $fecha1 = $fechaInicial; 
            list($anio1, $mes1, $dia1) = explode("-",$fecha1); 
            $fechaini = $anio1 . '-' . $mes1 . '-' .$dia1;
            if ($dia1 < 10) {
                $day1 = (string)$dia1;
                $fechaini = $anio1 . '-' . $mes1 . '-' . '0'.$day1;
            }
            if($idAmbiente=="")
            {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechanovedad like '%$fechaini%'");

            $stmt->execute();

            return $stmt->fetchAll();
            }
            else
            {
                $stmt = Conexion::conectar()->prepare("SELECT novedad.*, ambiente.idambiente  FROM $tabla 
                    join ficha on (novedad.numeroficha=ficha.numeroficha)
                    join ambiente on (ambiente.idambiente=ficha.idambiente)
                    WHERE fechanovedad like '%$fechaini%' and ambiente.idAmbiente=$idAmbiente");

            $stmt->execute();

            return $stmt->fetchAll();
              
            }

            

        }  else {

            // FECHA INICIAL
            $fecha1 = $fechaInicial; 
            list($anio1, $mes1, $dia1) = explode("-",$fecha1); 
            $fechaini = $anio1 . '-' . $mes1 . '-' .$dia1;
            if ($dia1 < 10) {
                $day1 = (string)$dia1;
                $fechaini = $anio1 . '-' . $mes1 . '-' . '0'.$day1;
            }

            // FECHA FINAL
            $fecha2 = $fechaFinal; 
            list($anio2, $mes2, $dia2) = explode("-",$fecha2);        
            $fechafin = $anio2 . '-' . $mes2 . '-' .$dia2;
            if ($dia2 < 10) {
                $b1 = (int)$dia2+1;
                $day2 = (string)$b1;
                $fechafin = $anio2 . '-' . $mes2 . '-' . '0'.$day2;
            }

            if($idAmbiente=="")
            {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fechanovedad BETWEEN '$fechaini' AND '$fechafin'");

                $stmt->execute();

                return $stmt->fetchAll();
            }
            else

            {
                $stmt = Conexion::conectar()->prepare("SELECT novedad.*,ambiente.idambiente FROM $tabla
                    join ficha on (novedad.numeroficha=ficha.numeroficha)
                    join ambiente on (ambiente.idambiente=ficha.idambiente)
                    WHERE fechanovedad BETWEEN '$fechaini' AND '$fechafin'  and ambiente.idAmbiente=$idAmbiente");

                $stmt->execute();

                return $stmt->fetchAll();
            }

            

        }

    }

}
