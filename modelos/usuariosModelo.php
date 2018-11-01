<?php

require_once "conexion.php";

class ModeloUsuarios
{

    /*=============================================
    MOSTRAR USUARIOS
    =============================================*/

    static public  function mdlMostrarUsuarios($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

            $stmt->close();

            $stmt = null;

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();

        }
    }

    /*=============================================
    REGISTRO DE USUARIO
    =============================================*/

    static public  function mdlIngresarUsuario($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(NumDocumentoUsuario, NombreUsuario, ContraseniaUsuario, RolUsuario, FotoUsuario, IdPrograma) VALUES (:NumDocumentoUsuario, :NombreUsuario, :ContraseniaUsuario, :RolUsuario, :FotoUsuario, :IdPrograma)");

        $stmt->bindParam(":NumDocumentoUsuario", $datos["NumDocumentoUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":NombreUsuario", $datos["NombreUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":ContraseniaUsuario", $datos["ContraseniaUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":RolUsuario", $datos["RolUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":FotoUsuario", $datos["FotoUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":IdPrograma", $datos["IdPrograma"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    //EDITAR USUARIO//

    static public function mdlEditarUsuario($tabla, $datos){

       $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET NombreUsuario = :NombreUsuario, ContraseniaUsuario = :ContraseniaUsuario, RolUsuario = :RolUsuario, FotoUsuario = :FotoUsuario, IdPrograma=:IdPrograma WHERE NumDocumentoUsuario = :NumDocumentoUsuario");
       
       $stmt -> bindParam(":NombreUsuario", $datos["NombreUsuario"], PDO::PARAM_STR); 
       $stmt -> bindParam(":ContraseniaUsuario", $datos["ContraseniaUsuario"], PDO::PARAM_STR); 
       $stmt -> bindParam(":RolUsuario", $datos["RolUsuario"], PDO::PARAM_STR); 
       $stmt -> bindParam(":NombreUsuario", $datos["NombreUsuario"], PDO::PARAM_STR); 
       $stmt -> bindParam(":FotoUsuario", $datos["FotoUsuario"], PDO::PARAM_STR); 
       $stmt -> bindParam(":IdPrograma", $datos["IdPrograma"], PDO::PARAM_STR); 
       $stmt -> bindParam(":NumDocumentoUsuario", $datos["NumDocumentoUsuario"], PDO::PARAM_INT); 

       if($stmt -> execute()){

            return "ok";

       }else{

            return "error";

       }

       $stmt -> close();

       $stmt = null;

    }
    //eliminar USUARIO//

    static public function mdlBorrarUsuario($tabla,$datos){

        $stmt = Conexion :: conectar()->prepare("DELETE FROM $tabla WHERE NumDocumentoUsuario= :NumDocumentoUsuario");
        $stmt -> bindParam(":NumDocumentoUsuario",$datos,PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        }else{
            return "error";
        }

        $stmt -> close();
        $stmt = null;
    }

      public function mdlBuscarUsuarioPrograma($tabla,$datos)
    {
        $stmt= Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE IdPrograma = :idPrograma");

        $stmt->bindParam(":idPrograma", $datos, PDO::PARAM_STR);

        $stmt->execute();

            return $stmt->fetchAll();
        
        $stmt->close();
        $stmt = null;
    }
}

