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

                if ($_POST["editarUbicacion"] == "") {
                    $editarUbicacion = null;
                }

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
    	=           	MOSTRAR AMBIENTES               =
    	=============================================*/

    static public function ctrMostrarAmbientes($item,$valor)
    {

    	$tabla="ambiente";

    	$respuesta=ModeloAmbientes::mdlMostrarAmbientes($tabla, $item, $valor);

    	return $respuesta;
    }


    public function ctrEliminarAmbientes()
    {
        if (isset($_GET["idAmbiente"])) {
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
            }else{
                echo '<script>

                    swal({
                          type: "error",
                          title: "No se puede eliminar el ambiente",
                          text: "El ambiente tiene una ficha asignada",
                          showConfirmButton: true,
                          confirmButtonText: "Entendido"
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
