<?php

class ControladorFichas
{

/*=============================================
=                    CREAR FICHA                 =
=============================================*/

    public static function ctrAgregarFichas()
    {

        if (isset($_POST["nuevaFicha"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaFicha"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaJornada"])) {

                $tabla = "ficha";

                $jornada = strtoupper($_POST["nuevaJornada"]);
                // $fechaInicio=($_POST["nuevaFechaInicio"],$formato);

                $excel = $_FILES["nuevoExcel"]["tmp_name"];

                include_once 'extensiones\PHPExcel-1.8\Classes\PHPExcel\IOFactory.php';
                $inputFileName = $excel;
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader     = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel   = $objReader->load($inputFileName);

                $data = array($objPHPExcel->getActiveSheet()->toArray(null, true, true, true));

                if (count($data[0]) < 10) {

                    echo '<script>

                    swal({
                          type: "error",
                          title: "Número mínimo de aprendices: 30",
                          text: "El número de aprendices que se quiere ingresar es: ' . count($data[0]) . '",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar",
                          closeOnConfirm: false
                          }).then((result) => {
                            if (result.value) {

                            window.location = "fichas";
                            }
                        })

                </script>';
                    # code...
                } else {
                    $datos = array("NumeroFicha" => $_POST["nuevaFicha"],
                        "IdAmbiente"                 => $_POST["nuevoAmbiente"],
                        "IdPrograma"                 => $_POST["nuevoPrograma"],
                        "FechaInicio"                => $_POST["nuevaFechaInicio"],
                        "FechaFin"                   => $_POST["nuevaFechaFin"],
                        "JornadaFicha"               => $jornada);

                    $respuesta = ModeloFichas::mdlAgregarFichas($tabla, $datos);
                    if ($respuesta == "ok") {

                        $letras = array('A' => "A",
                            'B'                 => "B",
                            'C'                 => "C",
                            'D'                 => "D",
                            'E'                 => "E");
                        $errores = 0;
                        for ($i = 2; $i <= count($data[0]); $i++) {
                            $tablaConsulta     = "aprendiz";
                            $itemConsulta      = "NumDocumentoAprendiz";
                            $valorConsulta     = $data[0][$i][$letras['A']];
                            $respuestaConsulta = ModeloAprendiz::mdlConsultarAprendizFicha($tablaConsulta, $itemConsulta, $valorConsulta);

                            if ($respuestaConsulta == null) {

                                $tabla = "aprendiz";

                                for ($i = 2; $i <= count($data[0]); $i++) {
                                    $datos1 = array("NumeroFicha" => $_POST["nuevaFicha"],
                                        "NumDocumentoAprendiz"        => $data[0][$i][$letras['A']],
                                        "NombreAprendiz"              => $data[0][$i][$letras['C']],
                                        "TelefonoAprendiz"            => $data[0][$i][$letras['D']],
                                        "EmailAprendiz"               => $data[0][$i][$letras['E']]);

                                    // var_dump($datos1);

                                    $respuesta2 = ModeloAprendiz::MdlIngresarAprendiz($tabla, $datos1);
                                    // var_dump($respuesta2);

                                }
                                if ($respuesta2 == "ok") {
                                    echo '<script>

                        swal({
                              type: "success",
                              title: "La ficha ha sido guardada correctamente",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar",
                              closeOnConfirm: false
                              }).then((result) => {
                                        if (result.value) {

                                        window.location = "fichas";

                                        }
                                    })

                        </script>';
                                } else {

                                    echo '<script>

                        swal({
                              type: "error",
                              title: "La ficha no puede ir vacía o llevar caracteres especiales!",
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
                                $i                 = 5000;
                                $tablaEliminar     = "ficha";
                                $datosEliminar     = $_POST["nuevaFicha"];
                                $respuestaEliminar = ModeloFichas::mdlEliminarFicha($tablaEliminar, $datosEliminar);
                                if ($respuestaEliminar == "ok") {
                                    echo '<script>
                                    swal({
                                          type: "error",
                                          title: "Usuario ya registrado",
                                          text: "Hay usuarios que ya se encuentran registrados en otra ficha revise el archivo!",
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

                }
            }
        }
    }

// MOSTRAR fICHAS
    public function ctrMostrarFichas($item, $valor)
    {

        $tabla = "ficha";

        $respuesta = ModeloFichas::mdlMostrarFichas($tabla, $item, $valor);

        return $respuesta;
    }

/*=============================================
=                    CREAR FICHA                 =
=============================================*/

    public function ctrEditarFichas()
    {

        if (isset($_POST["editarFicha"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarFicha"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarJornada"])) {

                $tabla = "ficha";

                $jornada = strtoupper($_POST["editarJornada"]);
                // $fechaInicio=($_POST["editarFechaInicio"],$formato);

                $datos = array("NumeroFicha" => $_POST["editarFicha"],
                    "IdAmbiente"                 => $_POST["idAmbiente"],
                    "IdPrograma"                 => $_POST["idPrograma"],
                    "FechaInicio"                => $_POST["editarFechaInicio"],
                    "FechaFin"                   => $_POST["editarFechaFin"],
                    "JornadaFicha"               => $jornada);

                $respuesta = ModeloFichas::mdlEditarFichas($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>

                    swal({
                          type: "success",
                          title: "La ficha ha sido editada correctamente",
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
                          title: "La ficha no puede ir vacía o llevar caracteres especiales!",
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

// ELIMINAR FICHA
    public function ctrEliminarFicha()
    {
        if (isset($_GET["idFicha"])) {
            $tabla     = "ficha";
            $datos     = $_GET["idFicha"];

            $tabla2="aprendiz";
            $respuestaAprendices=ModeloAprendiz::mdlBorrarAprendiz($tabla2, $_GET["idFicha"]);
            if($respuestaAprendices=="ok")
            {
              $respuesta = ModeloFichas::mdlEliminarFicha($tabla, $datos);

              if ($respuesta == "ok") {
                  echo '<script>

                      swal({
                            type: "success",
                            title: "La ficha ha sido borrada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result){
                                      if (result.value) {

                                      window.location = "fichas";

                                      }
                                  })

                      </script>';
            }
          }
      }
    }
}
