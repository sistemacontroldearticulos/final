<?php

require_once "conexion.php";

class ModeloAprendiz
{

    /*=============================================
    CREAR APRENDIZ
    =============================================*/

    public static function mdlIngresarAprendiz($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(NumDocumentoAprendiz, NumeroFicha, NombreAprendiz, TelefonoAprendiz, EmailAprendiz) VALUES (:NumDocumentoAprendiz, :NumeroFicha, :NombreAprendiz, :TelefonoAprendiz, :EmailAprendiz)");

        $stmt->bindParam(":NumDocumentoAprendiz", $datos["NumDocumentoAprendiz"], PDO::PARAM_STR);
        $stmt->bindParam(":NumeroFicha", $datos["NumeroFicha"], PDO::PARAM_STR);
        $stmt->bindParam(":NombreAprendiz", $datos["NombreAprendiz"], PDO::PARAM_STR);
        $stmt->bindParam(":TelefonoAprendiz", $datos["TelefonoAprendiz"], PDO::PARAM_STR);
        $stmt->bindParam(":EmailAprendiz", $datos["EmailAprendiz"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    // MOSTRAR APRENDIZ
    public static function mdlMostrarAprendiz($tabla, $item, $valor){

        if ($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();   

        } else{

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

        $stmt -> execute();

        return $stmt -> fetchAll();

    }

        $stmt->close();
        $stmt->null();
    }

    //ELIMINAR USUARIO
    static public function mdlBorrarAprendiz($tabla,$datos){

        $stmt = Conexion :: conectar()->prepare("DELETE FROM $tabla WHERE NumDocumentoAprendiz= :NumDocumentoAprendiz");
        $stmt -> bindParam(":NumDocumentoAprendiz",$datos,PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        }else{
            return "error";
        }

        $stmt -> close();
        $stmt = null;
    }


    public static function mdlConsultarAprendizFicha($tabla, $item, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
        $stmt = null;
    }

}

