<?php

class ControladorFichas
{

/*=============================================
=                    CREAR FICHA                 =
=============================================*/

    public static function ctrBorrarAprendiz()
    {

        if (isset($_GET["NumDocumentoAprendiz"])) {

            $tabla = "aprendiz";
            $datos = $_GET["NumDocumentoAprendiz"];

            $item                = "numdocumentoaprendiz";
            $actaResponsabilidad = ControladorActas::ctrEliminarActaResponsabilidad($datos);

            if ($actaResponsabilidad == "ok") {

                $respuesta = ModeloAprendiz::mdlBorrarAprendiz($tabla, $datos);

                if ($respuesta == "ok") {

                    echo '<script>
                        swal({
                                type:"success",
                                title:"El aprendiz ha sido borrado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm:false
                            }).then((result)=>{
                                if(result.value){
                                    window.location ="fichas";
                                }
                        })
                </script>';
                }
            }
        }
    }

    public static function ctrAgregarFichas()
    {

        if (isset($_POST["nuevaFicha"])) {

            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaFicha"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaJornada"])) {

                $tabla = "ficha";

                // $jornada = strtoupper($_POST["nuevaJornada"]);
                // $fechaInicio=($_POST["nuevaFechaInicio"],$formato);

                $excel = $_FILES["nuevoExcel"]["tmp_name"];

                include 'extensiones/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';
                $inputFileName = $excel;
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader     = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel   = $objReader->load($inputFileName);

                $data = array($objPHPExcel->getActiveSheet()->toArray("null", true, true, true));

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
                    $letras = array('A' => "A",
                        'B'                 => "B",
                        'C'                 => "C",
                        'D'                 => "D",
                        'E'                 => "E");
                    $validacion = false;

                    if ($data[0][1][$letras['A']] == "DOCUMENTO" and $data[0][1][$letras['B']] == "NOMBRE" and $data[0][1][$letras['C']] == "TELEFONO" and $data[0][1][$letras['D']] == "EMAIL") {
                        for ($i = 2; $i <= count($data[0]); $i++) {
                            if ($data[0][$i][$letras['A']] == "") {
                                $validacion = true;
                            }
                            if ($data[0][$i][$letras['B']] == "") {
                                $validacion = true;
                            }
                        }
                        if (!$validacion) {
                            $datos = array("NumeroFicha" => $_POST["nuevaFicha"],
                                "IdAmbiente"                 => $_POST["nuevoAmbiente"],
                                "IdPrograma"                 => $_POST["nuevoPrograma"],
                                "FechaInicio"                => $_POST["nuevaFechaInicio"],
                                "FechaFin"                   => $_POST["nuevaFechaFin"],
                                "JornadaFicha"               => $_POST["nuevaJornada"]);

                            $respuesta = ModeloFichas::mdlAgregarFichas($tabla, $datos);
                            if ($respuesta == "ok") {

                                $errores = 0;
                                $letras  = array('A' => "A",
                                    'B'                  => "B",
                                    'C'                  => "C",
                                    'D'                  => "D",
                                    'E'                  => "E");
                                // print_r($data);

                                for ($i = 2; $i <= count($data[0]); $i++) {
                                    $tablaConsulta     = "aprendiz";
                                    $itemConsulta      = "NumDocumentoAprendiz";
                                    $valorConsulta     = $data[0][$i][$letras['A']];
                                    $respuestaConsulta = ModeloAprendiz::mdlConsultarAprendizFicha($tablaConsulta, $itemConsulta, $valorConsulta);

                                    if ($respuestaConsulta == null) {

                                        $tabla = "aprendiz";

                                        for ($i = 2; $i <= count($data[0]); $i++) {
                                            $telefono = $data[0][$i][$letras['C']];
                                            $email    = $data[0][$i][$letras['D']];

                                            if ($telefono == "null") {
                                                $telefono = null;
                                            }
                                            if ($email == "null") {
                                                $email = null;
                                            }

                                            $datos1 = array("NumeroFicha" => $_POST["nuevaFicha"],
                                                "NumDocumentoAprendiz"        => $data[0][$i][$letras['A']],
                                                "NombreAprendiz"              => $data[0][$i][$letras['B']],
                                                "TelefonoAprendiz"            => $telefono,
                                                "EmailAprendiz"               => $email);

                                            $respuesta2 = ModeloAprendiz::MdlIngresarAprendiz($tabla, $datos1);

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

                                            $tabla = "ficha";
                                            $datos = $_POST["nuevaFicha"];

                                            // $respuesta = ModeloFichas::mdlEliminarFicha($tabla, $datos);

                                            echo '<script>

                                      swal({
                                          type: "error",
                                          title: "La ficha no puede ir vacía o llevar caracteres especiales!",
                                          showConfirmButton: true,
                                          confirmButtonText: "Cerrar",
                                          closeOnConfirm: false
                                          }).then((result) => {
                                            if (result.value) {


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
                        } else {

                            echo '<script>

                                        swal({
                                          type: "error",
                                          title: "FALTAN CAMPOS",
                                          text:"Hay aprendices con campos obligatiorios como número de documento o nombre vacíos, revise el archivo e intentelo nuevamente",
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
                                          title: "LA ESTRUCTURA DEL ARCHIVO EXCEL ES INCORRECTA",
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

// MOSTRAR fICHAS
    public static function ctrMostrarFichas($item, $valor)
    {

        $tabla = "ficha";

        $respuesta = ModeloFichas::mdlMostrarFichas($tabla, $item, $valor);

        return $respuesta;
    }

/*=============================================
=                    CREAR FICHA                 =
=============================================*/

    public static function ctrEditarFichas()
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
    public static function ctrEliminarFicha()
    {
        if (isset($_GET["idFicha"])) {

            $tabla3 = "ficha";
            $datos3 = $_GET["idFicha"];

            $tabla1 = "aprendiz";
            $item1 = "numeroficha";
            $mostrarAprendices = ModeloAprendiz::mdlMostrarAprendiz($tabla1, $item1, $datos3);
            $documentos = array();
            foreach ($mostrarAprendices as $key => $value) {
              $documento = array_push($documentos, $mostrarAprendices[$key]["numdocumentoaprendiz"]);
            }


            foreach ($documentos as $key => $value) {
              $tabla = "aprendiz";
              $datos = $documentos[$key];
              $item                = "numdocumentoaprendiz";
              $actaResponsabilidad = ControladorActas::ctrEliminarActaResponsabilidad($datos);

              if ($actaResponsabilidad == "ok") {
                  $respuesta = ModeloAprendiz::mdlBorrarAprendiz($tabla, $datos);
              }

            }

            $tablaNov = "novedad";
            $itemNov = "numeroficha";
            $novedad =  ModeloNovedades::mdlMostrarNovedades($tablaNov, $itemNov, $datos3);
            
            foreach ($novedad as $key => $value) {
              
              $tablaArticulo = "articulonovedad";
              $datosArticulo = $novedad[$key]["idnovedad"];
              $eliminarArticuloNov = ModeloNovedades::mdlBorrarArticuloNovedad($tablaArticulo, $datosArticulo);

            }

            $eliminarNov = ModeloNovedades::mdlBorrarNovedad($tablaNov, $novedad[0]["idnovedad"]);

            


            $respuesta2 = ModeloFichas::mdlEliminarFicha($tabla3, $datos3);
            if ($respuesta2 == "ok") {
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
