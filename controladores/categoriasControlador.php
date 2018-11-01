<?php 

class ControladorCategorias{

	// CREAR CATEGORIA
	static public function ctrCrearCategoria(){

		if(isset($_POST["nuevaCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])){

				$tabla = "categoria";
				$categoria= strtoupper($_POST["nuevaCategoria"]);

				$datos = $categoria;

				$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}

	}

	// MOSTRAR CATEGORIAS
	static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categoria";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

		return $respuesta;
	
	}

	// EDITAR CATEGORIA
	static public function ctrEditarCategoria(){

		if(isset($_POST["editarCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

				$tabla = "categoria";
				$categoria= strtoupper($_POST["editarCategoria"]);

				$datos = array("NombreCategoria"=>$categoria,
							   "IdCategoria"=>$_POST["idCategoria"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}

	}

	// BORRAR CATEGORIA
	static public function ctrBorrarCategoria(){

		if(isset($_GET["idCategoria"])){

			$item = "idcategoria";
			$valor = $_GET["idCategoria"];

			$respuesta1 = ControladorArticulos::ctrMostrarArticulos($item, $valor);
			// var_dump($respuesta1);

			if ($respuesta1 != null) {
               
				// foreach ($respuesta1 as $key => $value) {
                    if ($respuesta1[3] ==$_GET["idCategoria"]) {

		                $datos = array("TipoArticulo" => $respuesta1[4],
		                    "MarcaArticulo"               => $respuesta1[6],
		                    "ModeloArticulo"              => $respuesta1[5],
		                    "NumInventarioSena"           => $respuesta1[9],
		                    "SerialArticulo"              => $respuesta1[10],
		                    "EstadoArticulo"              => $respuesta1[8],
		                    "IdAmbiente"                  => $respuesta1[1],
		                    "IdCategoria"                 => null,
		                    "CaracteristicaArticulo"      => $respuesta1[7],
		                    "IdEquipo"                    => $respuesta1[2],
		                    "IdArticulo"                  => $respuesta1[0]
		                );

                        $tabla = "articulo";
                        // var_dump($datos);
                        $respuestaArticulo2 = ModeloArticulos::mdlEditarArticulo($tabla, $datos);

                    }
                
            }

			$tabla ="categoria";
			$datos = $_GET["idCategoria"];

			$tablaArticulo="articulo";
			$item="idcategoria";
			$respuestaArticulo=ModeloCategorias::mdlBuscarArticuloCategoria($tablaArticulo, $item, $datos);
			if ($respuestaArticulo != null) {
                foreach ($respuestaArticulo as $key => $value) {
                    if ($value[3] == $_GET["idCategoria"]) {
                        $datosArticulo = array("IdArticulo"=> $value[0],
                          "TipoArticulo" => $value[4],
                          "MarcaArticulo"           => $value[6],
                          "ModeloArticulo"          => $value[5],
                          "NumInventarioSena"       => $value[9],
                          "SerialArticulo"          =>  $value[10],
                          "EstadoArticulo"          => $value[8],
                          "IdAmbiente"              => $value[1],
                          "IdCategoria"             => null,
                          "CaracteristicaArticulo"  => $value[7],
                          "IdEquipo"                => $value[2],
                        );
                        
                        $respuestaUsuario2 = ModeloArticulos::mdlEditarArticulo($tablaArticulo, $datosArticulo);

                    }
                }
              }


			$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}
		}
	}
}
