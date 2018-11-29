<?php 

class ControladorAprendiz{

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/
	static public function ctrMostrarAprendiz($item, $valor){
    $tabla     = "aprendiz";
    $respuesta = ModeloAprendiz::mdlMostrarAprendiz($tabla, $item, $valor);

    return $respuesta;
	}

	/*=============================================
	OBTENER NUMERO FICHA
	=============================================*/
	static public function Aprendiz(){
		$ficha = $_GET["ficha"];
    	return $ficha;
      // var_dump($ficha);
  }

	/*=============================================
	CREAR APRENDIZ
	=============================================*/
	static public function ctrCrearAprendiz(){
    	// $ficha = $_GET["ficha"];
    	// var_dump($ficha);
        if (isset($_POST["nuevoAprendiz"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoAprendiz"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoDocumentoAprendiz"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoTelefonoAprendiz"])){

                $tabla = "aprendiz";
                $nombreAprendiz = strtoupper($_POST["nuevoAprendiz"]);
     
                $datos = array("numdocumentoaprendiz" => $_POST["nuevoDocumentoAprendiz"],
		                    "numeroficha"           => $_GET["ficha"],
		                    "nombreaprendiz"      => $nombreAprendiz,
		                    "telefonoaprendiz"    => $_POST["nuevoTelefonoAprendiz"],
		                    "emailaprendiz" => $_POST["nuevoEmailAprendiz"]);

                // var_dump($datos);

                $respuesta = ModeloAprendiz::mdlIngresarAprendiz($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>

                          swal({
                                type: "success",
                                title: "El Aprendiz ha sido agregado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                                }).then((result) => {
                                          if (result.value) {

                                          window.location = "fichas";

                                          }
                                      })

                          </script>';

                }
		    } else {
		            echo '<script>

                          swal({
                                type: "error",
                                title: "El aprendiz no puede ir vacío o llevar caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                                }).then((result) => {
                                  if (result.value) {

                                  window.location = "fichas";

                                  }
                              })

                      </script>';
		     }
        }
  }

  /*=============================================
  ELIMINAR APRENDIZ
  =============================================*/
  // static public function ctrBorrarAprendiz(){

  //   // $documento = $_POST["documento"];
  //   // var_dump($documento);

  //     if (isset($_GET["NumDocumentoAprendiz"])) {

  //         $tabla = "aprendiz";
  //         $datos = $_GET["NumDocumentoAprendiz"];

  //         $respuesta = ModeloAprendiz::mdlBorrarAprendiz($tabla, $datos);

  //         if ($respuesta == "ok") {

  //             echo '<script>
  //                         swal({
  //                                 type:"success",
  //                                 title:"El aprendiz ha sido borrado correctamente",
  //                                 showConfirmButton: true,
  //                                 confirmButtonText: "Cerrar",
  //                                 closeOnConfirm:false
  //                             }).then((result)=>{
  //                                 if(result.value){
  //                                     window.location ="fichas";
  //                                 }
  //                         })
  //                 </script>';
  //         }
  //     }
  // }

  /*=============================================
  EDITAR APRENDIZ
  =============================================*/
  static public function ctrEditarAprendiz(){

        if (isset($_POST["editarAprendiz"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarAprendiz"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarTelefonoAprendiz"])){

                $tabla = "aprendiz";
                $editarNombreAprendiz = strtoupper($_POST["editarAprendiz"]);
     
                $datos = array("NumDocumentoAprendiz" => $_POST["editarDocumentoAprendiz"],
                        "NumeroFicha"           => $_POST["editarFichaAprendiz"],
                        "NombreAprendiz"      => $editarNombreAprendiz,
                        "TelefonoAprendiz"    => $_POST["editarTelefonoAprendiz"],
                        "EmailAprendiz" => $_POST["editarEmailAprendiz"]);


                $respuesta = ModeloAprendiz::mdlEditarAprendiz($tabla, $datos);

                var_dump($respuesta);
                if ($respuesta == "ok") {

                    echo '<script>

                          swal({
                                type: "success",
                                title: "El Aprendiz ha sido editado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                                }).then((result) => {
                                          if (result.value) {

                                          window.location = "fichas";

                                          }
                                      })

                          </script>';

                }
        } else {
                echo '<script>

                          swal({
                                type: "error",
                                title: "El aprendiz no puede ir vacío o llevar caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                                }).then((result) => {
                                  if (result.value) {

                                  window.location = "fichas";

                                  }
                              })

                      </script>';
         }
        }
  }
}