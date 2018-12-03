<?php

require_once "../../../controladores/actasControlador.php";
require_once "../../../controladores/ambientesControlador.php";
// require_once "../../../controladores/articulosControlador.php";
// require_once "../../../controladores/categoriasControlador.php";
// require_once "../../../controladores/fichasControlador.php";
// require_once "../../../controladores/novedadesControlador.php";
// require_once "../../../controladores/programasControlador.php";
// require_once "../../../controladores/reportesControlador.php";
require_once "../../../controladores/usuariosControlador.php";
require_once "../../../controladores/equipoControlador.php";
require_once "../../../controladores/aprendizControlador.php";

require_once "../../../modelos/actasModelo.php";
require_once "../../../modelos/equipoModelo.php";
require_once "../../../modelos/ambientesModelo.php";
require_once "../../../modelos/articulosModelo.php";
// require_once "../../../modelos/categoriasModelo.php";
require_once "../../../modelos/fichasModelo.php";
// require_once "../../../modelos/novedadesModelo.php";
// require_once "../../../modelos/programasModelo.php";
// require_once "../../../modelos/reportesModelo.php";
require_once "../../../modelos/usuariosModelo.php";
require_once "../../../modelos/aprendizModelo.php";

class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA FICHA
$item5 ="numeroficha";
$valor5 = $this->codigo;
$tabla1 = "ficha";
$mostrarFicha = ModeloFichas::mdlMostrarFichas($tabla1, $item5, $valor5);
$ficha = $mostrarFicha["numeroficha"];
$jornada = $mostrarFicha["jornadaficha"];

// CONSULTAR ARTICULOS EN EQUIPO
$item4 ="idambiente";
$valor4 = $mostrarFicha["idambiente"];
$tabla = "articulo";
$articulosEquipo = ModeloArticulos::mdlMostrarArticulosEquipo1($tabla, $item4, $valor4);

// CONSULTAR AMBIENTE
$item9 ="idambiente";
$valor9 = $mostrarFicha["idambiente"];
$mostrarAmbiente = ControladorAmbientes::ctrMostrarAmbientes( $item9, $valor9);
$nombreAmbiente = $mostrarAmbiente["nombreambiente"];

date_default_timezone_set('America/Bogota');

$fecha = date('Y-m-d');
$hora  = date('H:i:s');
$anio = substr($fecha,0,-6);

// $fechaActual = $fecha . ' ' . $hora;

// foreach ($articulosEquipo as $key => $value) {
	
// 	$item8 = "idequipo";
// 	$valor8 = $articulosEquipo[$key]["idequipo"];

// 	$respuesta8 = ControladorActas::ctrMostrarActas($item8, $valor8);

// }


// $item = "numeroficha";
// $valor= $this->codigo;

// $respuesta = ControladorActas::ctrMostrarActas($item, $valor);

// $anio = substr($respuesta["fechaacta"],0,-15);

// // $hora = substr($respuesta["fechaacta"],-10,0);

// $dato = $respuesta["fechaacta"];
// $fecha = date('Y-m-d',strtotime($dato));
// $hora = date('H:i:s',strtotime($dato)); 

// $equipo = $respuesta["idequipo"];
// $codigo1 = $respuesta["idacta"];
// $documentoAprendiz = $respuesta["numdocumentoaprendiz"];
// $documentoInstructor = $respuesta["numdocumentoinstructor"];

// // NOMBRE APRENDIZ
// $item2 = "numdocumentoaprendiz";
// $valor2 =  $respuesta["numdocumentoaprendiz"];
// $mostrarAprendiz= ControladorAprendiz::ctrMostrarAprendiz($item2, $valor2);
// $nombreaprendiz = $mostrarAprendiz[0]["nombreaprendiz"];

// // NUMERO FICHA APRENDIZ
// $fichaAprendiz = $mostrarAprendiz[0]["numeroficha"];

// // CONSULTAR EQUIPO
// $item1 ="idequipo";
// $valor1 = $respuesta["idequipo"];
// $mostrarEquipo = ControladorEquipos::ctrMostrarEquipos($item1, $valor1);
// $nombreEquipo = $mostrarEquipo["nombreequipo"];

// // NOMBRE USUARIO
// $item3 ="numdocumentousuario";
// $valor3 = $respuesta["numdocumentoinstructor"];
// $usuario = ControladorUsuarios::ctrMostrarUsuarios($item3, $valor3);
// $nombreusaurio = $usuario["nombreusuario"];

// // CONSULTAR ARTICULOS EN EQUIPO
// $item4 ="idequipo";
// $valor4 = $mostrarEquipo["idequipo"];
// $tabla = "articulo";
// $articulosEquipo = ModeloArticulos::mdlMostrarArticulosEquipo($tabla, $item4, $valor4);
// // var_dump($articulosEquipo);

// // CANTIDAD ARTICULOS EQUIPO
// $cantidadArticulosEquipo = 0;
// foreach ($articulosEquipo as $key => $value) {
// 	$cantidadArticulosEquipo = $cantidadArticulosEquipo + 1; 
// }


// // CONSULTAR FICHA
// $item5 ="numeroficha";
// $valor5 = $fichaAprendiz;
// $tabla1 = "ficha";
// $mostrarFicha = ModeloFichas::mdlMostrarFichas($tabla1, $item5, $valor5);

// // CONSULTAR AMBIENTE
// $item6 ="idambiente";
// $valor6 = $mostrarFicha["idambiente"];
// // $tabla1 = "ficha";
// $mostrarAmbiente = ControladorAmbientes::ctrMostrarAmbientes( $item6, $valor6);
// $nombreAmbiente = $mostrarAmbiente["nombreambiente"];

//REQUERIMOS LA CLASE TCPDF
require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table style="">
		
		<tr>
			
			<td style="border: 1px solid #000; width:100px; height:90px; text-align: center;">

				<img src="images/logo_sena_negro.png" style="height:85px; ">

			</td>

			<td style="border: 1px solid #000; width:440px">
				
				<div style=" text-align:center;">
					
					
					<h5><strong>SISTEMA INTEGRADO DE GESTIÓN</strong></h5>
					
					<br>
					<h5><strong>ACTA RESPONSABILIDAD No $anio - </strong></h5>

				</div>

			</td>
			
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
		
		<td style="border-bottom: 1px solid #000; background-color:white; width:540px"></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #000; background-color:white; width:540px">

				<strong>ACTA</strong>

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #000; background-color:white; width:180px">

				<strong>CIUDAD Y FECHA</strong>
				<br>
				Popayán $fecha 

			</td>

			<td style="border: 1px solid #000; background-color:white; width:180px">

				<strong>HORA</strong>
				<br>
				$hora

			</td>

			<td style="border: 1px solid #000; background-color:white; width:180px">

				<strong>JORNADA</strong>
				<br>
				$jornada

			</td>

		</tr>

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:270px">

				<strong>LUGAR:</strong> $nombreAmbiente


			</td>

			<td style="border: 1px solid #000; background-color:white; width:270px">

				<strong>FICHA:</strong> $ficha

			</td>

		</tr>

		<tr>	
			<td style="border: 1px solid #000; background-color:white; width:540px">

				<strong>TEMA:</strong>  Acta de responsabilidad

			</td>
		</tr>

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:540px">
				
				<strong>COMPROMISO:</strong> Los aprendices pertenecientes a la ficha ($ficha) se comprometen a responder por los artículos asignados al ambiente ($nombreAmbiente) firmando un acta de responsabilidad, de no cumplir con ello se les informará que deberán firmar un acta de compromiso.

			</td>
		</tr>

		<tr>	
			<td style="border: 1px solid #000; background-color:white; width:540px">

				<strong>DESARROLLO DE REUNION</strong> 

			</td>
		</tr>
		<tr>
			<td style="border: 1px solid #000; background-color:white; width:540px">
				
				Se reúnen con los aprendices de la ficha anteriormente mencionada siendo las ($hora) del ($fecha) donde se hará entrega de los artículos del ambiente ($nombreAmbiente) y se les informa que quedan bajo responsabilidad de estos.

			</td>
		</tr>	

		<tr>
		
		<td style="border-bottom: 1px solid #000; background-color:white; width:540px"></td>

		</tr>
	

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:540px; height:70px; ">

				<strong>NOTA: </strong>

			</td>
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// --------------------------------------------------------------------------

$pila = array();
foreach ($articulosEquipo as $k => $item) {

	$a = $articulosEquipo[$k]["idequipo"];
	array_push($pila, $a);
}
$resultado1 = array_unique($pila);
// echo '<pre>'; print_r($resultado1); echo '</pre>';
$resultado = array_unique($pila);



// foreach ($resultado1 as $key => $value) {

// 	$item = "idequipo";
// 	$valor= $resultado1[$key];

// 	$respuesta = ControladorActas::ctrMostrarActas($item, $valor);
// 	var_dump($valor);
// 	echo '<pre>'; print_r($respuesta); echo '</pre>';
// }





foreach ($resultado as $key => $value) {
	
$item = "idequipo";
$valor= $resultado[$key];

$respuesta = ControladorActas::ctrMostrarActas($item, $valor);

if ($respuesta) {
	
// CONSULTAR EQUIPO
$item1 ="idequipo";
$valor1 = $respuesta[2];
$mostrarEquipo = ControladorEquipos::ctrMostrarEquipos($item1, $valor1);
$nombreEquipo = $mostrarEquipo["nombreequipo"];

// var_dump($mostrarEquipo["idequipo"]);

// NOMBRE APRENDIZ
$item2 = "numdocumentoaprendiz";
$valor2 =  $respuesta["numdocumentoaprendiz"];
$mostrarAprendiz= ControladorAprendiz::ctrMostrarAprendiz($item2, $valor2);
$nombreaprendiz = $mostrarAprendiz[0]["nombreaprendiz"];

// CONSULTAR ARTICULOS EN EQUIPO
$item6 ="idequipo";
$valor6 = $mostrarEquipo["idequipo"];
$tabla = "articulo";
$articulosEquipos1 = ModeloArticulos::mdlMostrarArticulosEquipo1($tabla, $item6, $valor6);

$bloque9 = <<<EOF

<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border-bottom: 1px solid #000; background-color:white; width:540px"></td>

		</tr>	

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:80px; ">

				<strong>EQUIPO</strong> 
				
			</td>
	
			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				$nombreEquipo
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				<strong>APRENDIZ</strong> 
			</td>

			<td style="border: 1px solid #000; background-color:white; width:230px; ">
				$nombreaprendiz
			</td>
		
		</tr>

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:80px; ">
				<strong>ID</strong>
			</td>
	
			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				<strong>TIPO ARTICULO</strong>
			</td>
		
			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				<strong>SERIAL</strong>
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				<strong>MODELO</strong>
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				<strong>MARCA</strong>
			</td>
		</tr>
	</table>
EOF;

$pdf->writeHTML($bloque9, false, false, false, false, '');



foreach ($articulosEquipos1 as $key => $value) {
	// echo '<pre>'; print_r($articulosEquipos1[$key]["idarticulo"]); echo '</pre>';

// echo '<pre>'; print_r($articulosEquipos1); echo '</pre>';

$id = $articulosEquipos1[$key]["idarticulo"];
$serial = $articulosEquipos1[$key]["serialarticulo"];
$tipoarticulo = $articulosEquipos1[$key]["tipoarticulo"];
$marca = $articulosEquipos1[$key]["marcaarticulo"];
$modelo = $articulosEquipos1[$key]["modeloarticulo"];

$bloque4 = <<<EOF

	


	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #000; background-color:white; width:80px; ">
				$id
				
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				$tipoarticulo
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				$serial
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				$modelo
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				$marca
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');
}
}
}

// --------------------------------------------------------------------------

$bloque5 = <<<EOF

	<table>
		
		<tr>
		
		<td style=" background-color:white; width:540px"></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">

		

		<tr>
			<td style="border-bottom: 1px solid #000; background-color:white; width:200px; height:80px "></td>
	
			<td style=" background-color:white; width:140px"></td>
		
			
		</tr>

		<tr>
			<td style=" background-color:white; width:200px; text-align: center;">

				<strong>FIRMA INSTRUCTOR</strong>

			</td>

			<td style=" background-color:white; width:140px"></td>

		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

$pdf->Output('ActaResponsabilidad.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>