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

// //TRAEMOS LA INFORMACIÓN DE LA VENTA

$item = "idacta";
$valor= $this->codigo;

$respuesta = ControladorActas::ctrMostrarActas($item, $valor);

// $fecha = substr($respuesta["fechaacta"],0,-8);
// $hora = substr($respuesta["fechaacta"],-10,0);

$dato = $respuesta["fechaacta"];
$fecha = date('Y-m-d',strtotime($dato));
$hora = date('H:i:s',strtotime($dato)); 

$equipo = $respuesta["idequipo"];
$codigo1 = $respuesta["idacta"];
$documentoAprendiz = $respuesta["numdocumentoaprendiz"];
$documentoInstructor = $respuesta["numdocumentoinstructor"];

// NOMBRE APRENDIZ
$item2 = "numdocumentoaprendiz";
$valor2 =  $respuesta["numdocumentoaprendiz"];
$mostrarAprendiz= ControladorAprendiz::ctrMostrarAprendiz($item2, $valor2);
$nombreaprendiz = $mostrarAprendiz[0]["nombreaprendiz"];

// NUMERO FICHA APRENDIZ
$fichaAprendiz = $mostrarAprendiz[0]["numeroficha"];

// CONSULTAR EQUIPO
$item1 ="idequipo";
$valor1 = $respuesta["idequipo"];
$mostrarEquipo = ControladorEquipos::ctrMostrarEquipos($item1, $valor1);
$nombreEquipo = $mostrarEquipo["nombreequipo"];

// NOMBRE USUARIO
$item3 ="numdocumentousuario";
$valor3 = $respuesta["numdocumentoinstructor"];
$usuario = ControladorUsuarios::ctrMostrarUsuarios($item3, $valor3);
$nombreusaurio = $usuario["nombreusuario"];

// CONSULTAR ARTICULOS EN EQUIPO
$item4 ="idequipo";
$valor4 = "14";
$tabla = "articulo";
$articulosEquipo = ModeloArticulos::mdlMostrarArticulosEquipo($tabla, $item4, $valor4);

// CANTIDAD ARTICULOS EQUIPO
$cantidadArticulosEquipo = 0;
foreach ($articulosEquipo as $key => $value) {
	$cantidadArticulosEquipo = $cantidadArticulosEquipo + 1; 
}


// CONSULTAR FICHA
$item5 ="numeroficha";
$valor5 = $fichaAprendiz;
$tabla1 = "ficha";
$mostrarFicha = ModeloFichas::mdlMostrarFichas($tabla1, $item5, $valor5);
$jornadaFicha = ucwords(strtolower($mostrarFicha["jornadaficha"]));

// CONSULTAR AMBIENTE
$item6 ="idambiente";
$valor6 = $mostrarFicha["idambiente"];
// $tabla1 = "ficha";
$mostrarAmbiente = ControladorAmbientes::ctrMostrarAmbientes( $item6, $valor6);
$nombreAmbiente = $mostrarAmbiente["nombreambiente"];

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
					<h5><strong>ACTA RESPONSABILIDAD No 2018 - $codigo1</strong></h5>

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
				$jornadaFicha

			</td>

		</tr>

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:270px">

				<strong>LUGAR:</strong> $nombreAmbiente

			</td>

			<td style="border: 1px solid #000; background-color:white; width:270px">

				<strong>FICHA:</strong> $fichaAprendiz

			</td>

		</tr>

		<tr>	
			<td style="border: 1px solid #000; background-color:white; width:540px">

				<strong>TEMA:</strong>  Acta de responsabilidad

			</td>
		</tr>

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:540px">
				
				<strong>OBJETIVO:</strong> Se le otorgará al aprendiz  $nombreaprendiz identificado con número el documento No.  $documentoAprendiz , el equipo  $nombreEquipo que consta de $cantidadArticulosEquipo implementos necesarios para realizar la función que le corresponde.
				<br>
				<br>
				Si llegase a presentarse un inconveniente, ya sea pérdida o daño de alguno de los implementos entregados, deberá ser reportado al instructor que esté acargo del ambiente en su momento, de lo contrario se tomará como responsable al aprendiz acargo del equipo.

			</td>
		</tr>	

		<tr>
		
		<td style="border-bottom: 1px solid #000; background-color:white; width:540px"></td>

		</tr>
	

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:540px; height:50px; ">

				<strong>OBSERVACIONES: </strong>

			</td>
		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #000; background-color:white; width:540px"></td>

		</tr>

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:80px; ">

				<strong>EQUIPO</strong>
				
			</td>
	
			<td style="border: 1px solid #000; background-color:white; width:460px; ">
				$nombreEquipo
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

$pdf->writeHTML($bloque2, false, false, false, false, '');

// --------------------------------------------------------------------------

foreach ($articulosEquipo as $key => $item) {

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">



		<tr>
			
			<td style="border: 1px solid #000; background-color:white; width:80px; ">
				$item[idarticulo]
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				$item[tipoarticulo]
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				$item[serialarticulo]
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				$item[modeloarticulo]
			</td>

			<td style="border: 1px solid #000; background-color:white; width:115px; ">
				$item[marcaarticulo]
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');
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
		
			<td style="border-bottom: 1px solid #000; background-color:white; width:200px; height:80px "></td>
		</tr>

		<tr>
			<td style=" background-color:white; width:200px; text-align: center;">

				<strong>FIRMA INSTRUCTOR</strong>

			</td>

			<td style=" background-color:white; width:140px"></td>

			<td style=" background-color:white; width:200px; text-align: center;">

				<strong>FIRMA APRENDIZ</strong>

			</td>
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