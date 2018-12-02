<?php
require_once "conexion.php";
class ModeloArticulos
{
    public static function mdlCrearArticulo($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (IdAmbiente, IdEquipo, IdCategoria, TipoArticulo, ModeloArticulo, MarcaArticulo, CaracteristicaArticulo, EstadoArticulo, NumInventarioSena, SerialArticulo) VALUES (:IdAmbiente, :IdEquipo, :IdCategoria, :TipoArticulo, :ModeloArticulo, :MarcaArticulo, :CaracteristicaArticulo, :EstadoArticulo, :NumInventarioSena, :SerialArticulo)");

        $stmt->bindParam(":IdAmbiente", $datos["IdAmbiente"], PDO::PARAM_STR);
        $stmt->bindParam(":IdEquipo", $datos["IdEquipo"], PDO::PARAM_STR);
        $stmt->bindParam(":IdCategoria", $datos["IdCategoria"], PDO::PARAM_STR);
        $stmt->bindParam(":TipoArticulo", $datos["TipoArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":ModeloArticulo", $datos["ModeloArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":MarcaArticulo", $datos["MarcaArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":CaracteristicaArticulo", $datos["CaracteristicaArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":EstadoArticulo", $datos["EstadoArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":NumInventarioSena", $datos["NumInventarioSena"], PDO::PARAM_STR);
        $stmt->bindParam(":SerialArticulo", $datos["SerialArticulo"], PDO::PARAM_STR);
        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    public static function mdlMostrarArticulos($tabla, $item, $valor)
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

    public static function mdlBorrarArticulos($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idarticulo = :idarticulo");

        $stmt->bindParam(":idarticulo", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    // EDITAR ARTICULO
    public static function mdlEditarArticulo($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(" UPDATE $tabla SET TipoArticulo = :TipoArticulo, MarcaArticulo = :MarcaArticulo, ModeloArticulo = :ModeloArticulo, NumInventarioSena = :NumInventarioSena, SerialArticulo =:SerialArticulo, EstadoArticulo = :EstadoArticulo, IdAmbiente = :IdAmbiente, IdCategoria = :IdCategoria, CaracteristicaArticulo = :CaracteristicaArticulo, IdEquipo = :IdEquipo WHERE IdArticulo=:IdArticulo ");

        $stmt->bindParam(":IdArticulo", $datos["IdArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":TipoArticulo", $datos["TipoArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":MarcaArticulo", $datos["MarcaArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":ModeloArticulo", $datos["ModeloArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":NumInventarioSena", $datos["NumInventarioSena"], PDO::PARAM_STR);
        $stmt->bindParam(":SerialArticulo", $datos["SerialArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":EstadoArticulo", $datos["EstadoArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":IdAmbiente", $datos["IdAmbiente"], PDO::PARAM_STR);
        $stmt->bindParam(":IdCategoria", $datos["IdCategoria"], PDO::PARAM_STR);
        $stmt->bindParam(":CaracteristicaArticulo", $datos["CaracteristicaArticulo"], PDO::PARAM_STR);
        $stmt->bindParam(":IdEquipo", $datos["IdEquipo"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";

        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    public static function mdlMostrarArticulosEquipo($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;
    }

    // MOSTRAR ARTICULOS NOVEDAD
    public static function mdlMostrarArticuloNovedad($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT articulonovedad.*, articulo.tipoarticulo FROM $tabla
			join articulo on (articulonovedad.idarticulo=articulo.idarticulo) WHERE $item = :$item");

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

    public static function mdlMostrarArticulosEquipo1($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;
    }

    // MOSTRAR PERDIDOS
    public static function perdidos()
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM articulo WHERE estadoarticulo like '%PERDIDO%'");
        $stmt->execute();
        return $stmt->fetch();

    }

    // MOSTRAR ACTIVOS
    public static function activos()
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM articulo WHERE estadoarticulo like '%ACTIVO%'");
        $stmt->execute();
        return $stmt->fetch();

    }

    // MOSTRAR DAÑADOS
    public static function daniado()
    {

        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM articulo WHERE estadoarticulo like '%DAÑADO%'");
        $stmt->execute();
        return $stmt->fetch();

    }

}
