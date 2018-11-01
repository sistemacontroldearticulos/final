<?php 
require_once "conexion.php";
class ModeloArticulos
{
	static public function mdlCrearArticulo($tabla, $datos)
	{

		$stmt= Conexion::conectar()->prepare("INSERT INTO $tabla (IdAmbiente, IdEquipo, IdCategoria, TipoArticulo, ModeloArticulo, MarcaArticulo, CaracteristicaArticulo, EstadoArticulo, NumInventarioSena, SerialArticulo) VALUES (:IdAmbiente, :IdEquipo, :IdCategoria, :TipoArticulo, :ModeloArticulo, :MarcaArticulo, :CaracteristicaArticulo, :EstadoArticulo, :NumInventarioSena, :SerialArticulo)");

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
		if($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
		$stmt->close();
		$stmt=null;
	}

	static public function mdlMostrarArticulos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;
	}

static public function mdlBorrarArticulos($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idarticulo = :idarticulo");

		$stmt -> bindParam(":idarticulo", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	// EDITAR ARTICULO
    static public function mdlEditarArticulo($tabla, $datos)
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


static public function mdlMostrarArticulosEquipo($tabla, $item, $valor){

	if($item != null){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

	}

	$stmt -> close();

	$stmt = null;
}
	
	// MOSTRAR ARTICULOS NOVEDAD
	static public function mdlMostrarArticuloNovedad($tabla, $item, $valor){

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
