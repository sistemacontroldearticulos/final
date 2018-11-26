<?php

class ControladorAmbientes
{

    static public function ctrCrearAmbientes()
    {

    	/*=============================================
    	=           	CREAR AMBIENTES               =
    	=============================================*/

    	if(isset($_POST["nuevoAmbiente"])){

    		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoAmbiente"])) {

    			$tabla="ambiente";
    			$NombreAmbiente = strtoupper($_POST["nuevoAmbiente"]);
    			$nuevaUbicacion= strtoupper($_POST["nuevaUbicacion"]);

    			$datos=array("IdPrograma"=>$_POST["idPrograma"],
    				"NombreAmbiente"=>$NombreAmbiente,
    				"UbicacionAmbiente"=>$nuevaUbicacion
    			);

                // var_dump($datos);

    			$respuesta=ModeloAmbientes::mdlCrearAmbientes($tabla, $datos);
                

    				if($respuesta=="ok"){
    					echo '<script>

					swal({
						  type: "success",
						  title: "El ambiente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "ambientes";

									}
								})

					</script>';
    				}

    				else{

    					echo '<script>

					swal({
						  type: "error",
						  title: "El ambiente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {

							window.location = "ambientes";
							}
						})

			  	</script>';

    				}
    			}
    	}

    }

    /*=============================================
    =               EDITAR AMBIENTES              =
    =============================================*/
	static public function ctrEditarAmbientes(){

    	if(isset($_POST["editarAmbiente"])){

    		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarAmbiente"])) {

    			$tabla="ambiente";
    			$NombreAmbiente = strtoupper($_POST["editarAmbiente"]);
    			$editarUbicacion = strtoupper($_POST["editarUbicacion"]);

                $editarUbicacion = $_POST["editarUbicacion"];
                if ($_POST["editarUbicacion"] == "") {
                    $editarUbicacion = null;
                }

                $programa = $_POST["idPrograma"];
                if ($_POST["idPrograma"] == "") {
                    $programa = null;
                }

    			$datos=array("IdPrograma"=>$programa,
    				"NombreAmbiente"=>$NombreAmbiente,
    				"UbicacionAmbiente"=>$editarUbicacion,
                    "IdAmbiente"=>$_POST["idAmbiente"]
    			);

                // var_dump($datos);
                
    			$respuesta=ModeloAmbientes::mdlEditarAmbientes($tabla, $datos);

    				if($respuesta=="ok"){
    					echo '<script>

					swal({
						  type: "success",
						  title: "El ambiente ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "ambientes";

									}
								})

					</script>';
    				}

    				
    			}

                else{

                        echo '<script>

                    swal({
                          type: "error",
                          title: "El ambiente no puede ir vacío o llevar caracteres especiales!",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                          closeOnConfirm: false
                          }).then((result) => {
                            if (result.value) {

                            window.location = "ambientes";
                            }
                        })

                </script>';

                    }
    	}

    }
    /*=============================================
    	=          	MOSTRAR AMBIENTES              =
    	=============================================*/

    static public function ctrMostrarAmbientes($item,$valor)
    {

    	$tabla="ambiente";

    	$respuesta = ModeloAmbientes::mdlMostrarAmbientes($tabla, $item, $valor);

    	return $respuesta;
    }


    static public function ctrEliminarAmbientes()
    {
        if (isset($_GET["idAmbiente"])) {

            $tabla1 = "ficha";
            $item1 = "idambiente";
            $valor1 = $_GET["idAmbiente"];
            $respuesta = ModeloFichas::mdlMostrarFichaAmbiente($tabla1 ,$item1, $valor1);

            if ($respuesta != null) {
                foreach ($respuesta as $key => $value) {
                    if ($value[2] == $_GET["idAmbiente"]) {
                        $datoFicha = array("NumeroFicha" => $value[0],
                            "IdPrograma"                     => $value[1],
                            "IdAmbiente"                     => null,
                            "FechaInicio"                    => $value[3],
                            "FechaFin"                       => $value[4],
                            "JornadaFicha"                   => $value[5]);
                        // var_dump($datoFicha);
                        $tablaFicha     = "ficha";
                        $respuestaFicha = ModeloFichas::mdlEditarFichas($tablaFicha, $datoFicha);

                    }
                }
            }

            $tabla2 = "articulo";
            $item2 = "idambiente";
            $valor2 = $_GET["idAmbiente"];
            $respuesta1 = ModeloArticulos::mdlMostrarArticulosEquipo($tabla2 ,$item2, $valor2);
            // var_dump($respuesta1[0]);
            if ($respuesta1 != null) {
                foreach ($respuesta1 as $key => $value) {
                    if ($value[1] == $_GET["idAmbiente"]) {
                        $datos = array("TipoArticulo" => $value[4],
                            "IdArticulo"              => $value[0],
                            "MarcaArticulo"           => $value[6],
                            "ModeloArticulo"          => $value[5],
                            "NumInventarioSena"       => $value[9],
                            "SerialArticulo"          => $value[10],
                            "EstadoArticulo"          => $value[8],
                            "IdAmbiente"              => null,
                            "IdCategoria"             => $value[3],
                            "CaracteristicaArticulo"  => $value[7],
                            "IdEquipo"                => $value[2],
                        );
                        // var_dump($datoFicha);
                        $tabla2     = "articulo";
                        $respuesta2 = ModeloArticulos::mdlEditarArticulo($tabla2, $datos);

                    }
                }
            }

            $tabla     = "ambiente";
            $datos     = $_GET["idAmbiente"];
            $respuesta = ModeloAmbientes::mdlEliminarAmbiente($tabla, $datos);
            // var_dump($respuesta);
            if ($respuesta == "ok") {
                echo '<script>

                    swal({
                          type: "success",
                          title: "El ambiente ha sido borrado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "ambientes";

                                    }
                                })

                    </script>';
            }
        }
    }

    static public function ctrMostrarArticulos1($item, $valor){

        // var_dump(isset($_POST["nuevoAmbiente"]));
        $tabla = "articulo";

        $respuesta = ModeloAmbientes::mdlMostrarArticulos1($tabla, $item, $valor);

        return $respuesta;
    
    }

}
