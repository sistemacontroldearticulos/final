<?php

require_once "conexion.php";

class ModeloActas
{

    // ACTA RESPONSABILIDAD
    static public function mdlCrearActa($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(numdocumentoaprendiz, idequipo, fechaacta, numdocumentoinstructor) VALUES (:numdocumentoaprendiz, :idequipo, :fechaacta, :numdocumentoinstructor)");
        // var_dump($stmt);
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


    // ACTA COMPPROMISO
    static public function mdlCrearActaCompromiso($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idacta_responsabilidad, fechacreacion, fechalimite, idarticulo) VALUES (:idacta_responsabilidad, :fechacreacion, :fechalimite, :idarticulo)");
        
        $stmt->bindParam(":idacta_responsabilidad", $datos["idacta_responsabilidad"], PDO::PARAM_STR);
        $stmt->bindParam(":fechalimite", $datos["fechalimite"], PDO::PARAM_STR);
        $stmt->bindParam(":fechacreacion", $datos["fechacreacion"], PDO::PARAM_STR);
        $stmt->bindParam(":idarticulo", $datos["idarticulo"], PDO::PARAM_STR);

        // var_dump($stmt);

        if ($stmt->execute()) {
            return "ok";

        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    // MOSTRAR ACTA RESPONSABILIDAD
    static public function mdlMostrarActas($tabla, $item, $valor){

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

    // MOSTRAR ACTA COMPROMISO
    public static function mdlMostrarActasCompromiso($tabla, $item, $valor)
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

    //ELIMINAR ACTA RESPONSABILIDAD
    static public function mdlEliminarActaResponsabilidad($tabla, $datos){
        
        $stmt = Conexion :: conectar()->prepare("DELETE FROM $tabla WHERE numdocumentoaprendiz= :numdocumentoaprendiz");

        $stmt -> bindParam(":numdocumentoaprendiz",$datos,PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        }else{
            return "error";
        }

        $stmt -> close();
        $stmt = null;

    }   

    //ELIMINAR ACTA RESPONSABILIDAD EQUIPO
    static public function mdlEliminarActaResponsabilidadEquipo($tabla, $datos){
        
        $stmt = Conexion :: conectar()->prepare("DELETE FROM $tabla WHERE idequipo= :idequipo");

        $stmt -> bindParam(":idequipo",$datos,PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        }else{
            return "error";
        }

        $stmt -> close();
        $stmt = null;

    }

    //ELIMINAR ACTA RESPONSABILIDAD
    static public function mdlEliminarActaCompromiso($tabla, $datos){
        
        $stmt = Conexion :: conectar()->prepare("DELETE FROM $tabla WHERE idacta_responsabilidad= :idacta_responsabilidad");

        $stmt -> bindParam(":idacta_responsabilidad",$datos,PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        }else{
            return "error";
        }

        $stmt -> close();
        $stmt = null;

    }
}
