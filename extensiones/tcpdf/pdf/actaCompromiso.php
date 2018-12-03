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

// MOSTRAR ACTA COMPROMISO
$item = "idacta_compromiso";
$valor= $this->codigo;
$actaCompromiso = ControladorActas::ctrMostrarActasCompromiso($item, $valor);

// MOSTRAR ACTA RESPONSABILIDAD
$item1 = "idacta";
$valor1 = $actaCompromiso["idacta_responsabilidad"];
$actaResponsabilidad = ControladorActas::ctrMostrarActas($item1, $valor1);

// // $fecha = substr($respuesta["fechaacta"],0,-8);
// // $hora = substr($respuesta["fechaacta"],-10,0);
$dato = explode("/", $actaCompromiso["fechalimite"]); 
$anio = $dato[2];

// CODIGO ACTA COMPROMISO
$codigo1 = $actaCompromiso["idacta_compromiso"];

// FECHA Y HORA DE CREACION ACTA
$dato = $actaCompromiso["fechacreacion"];
$fecha = date('Y-m-d',strtotime($dato));
$hora = date('H:i:s',strtotime($dato));



// $equipo = $respuesta["idequipo"];
// $codigo1 = $respuesta["idacta"];
// $documentoAprendiz = $respuesta["numdocumentoaprendiz"];
// $documentoInstructor = $respuesta["numdocumentoinstructor"];

// NOMBRE APRENDIZ
$item2 = "numdocumentoaprendiz";
$valor2 =  $actaResponsabilidad["numdocumentoaprendiz"];
$mostrarAprendiz= ControladorAprendiz::ctrMostrarAprendiz($item2, $valor2);
$nombreaprendiz = $mostrarAprendiz[0]["nombreaprendiz"];

// NUMERO FICHA APRENDIZ
$fichaAprendiz = $mostrarAprendiz[0]["numeroficha"];

// CONSULTAR EQUIPO
$item1 ="idequipo";
$valor1 = $actaResponsabilidad["idequipo"];
$mostrarEquipo = ControladorEquipos::ctrMostrarEquipos($item1, $valor1);
$nombreEquipo = $mostrarEquipo["nombreequipo"];

// // NOMBRE USUARIO
// $item3 ="numdocumentousuario";
// $valor3 = $respuesta["numdocumentoinstructor"];
// $usuario = ControladorUsuarios::ctrMostrarUsuarios($item3, $valor3);
// $nombreusaurio = $usuario["nombreusuario"];

// CONSULTAR ARTICULOS EN EQUIPO
$item4 ="idarticulo";
$valor4 = $actaCompromiso["idarticulo"];
$tabla = "articulo";
$articulosEquipo = ModeloArticulos::mdlMostrarArticulosEquipo($tabla, $item4, $valor4);

$articulo = $articulosEquipo[0]["tipoarticulo"];
$idarticulo = $articulosEquipo[0]["idarticulo"];

// // CANTIDAD ARTICULOS EQUIPO
// $cantidadArticulosEquipo = 0;
// foreach ($articulosEquipo as $key => $value) {
// 	$cantidadArticulosEquipo = $cantidadArticulosEquipo + 1; 
// }


// CONSULTAR FICHA
$item5 ="numeroficha";
$valor5 = $fichaAprendiz;
$tabla1 = "ficha";
$mostrarFicha = ModeloFichas::mdlMostrarFichas($tabla1, $item5, $valor5);

// CONSULTAR AMBIENTE
$item6 ="idambiente";
$valor6 = $mostrarFicha[2];
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
					<h5><strong>ACTA COMPROMISO No $anio - $codigo1 </strong></h5>

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
				$mostrarFicha[5]
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

				<strong>TEMA:</strong>  Acta de compromiso

			</td>
		</tr>

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:540px">
				
				<strong>OBJETIVO:</strong> Responsabilizar al aprendiz $nombreaprendiz quien firma el acta No. $codigo1 de fecha $fecha donde se hace cargo del equipo $nombreEquipo por perdida o daño.

			</td>
		</tr>	

		<tr>
		
		<td style="border-bottom: 1px solid #000; background-color:white; width:540px"></td>

		</tr>
	

		<tr>
			<td style="border: 1px solid #000; background-color:white; width:540px; height:50px; ">

				<strong>OBSERVACIONES: </strong>El aprendiz debera responder por el articulo ($articulo) con identificador ($idarticulo) 

				 en un plazo maximo de 5 dias.
				<br>
				Si no cumple con el plazo establecido se enviara a comite y se le hara condicionamiento de matricula.

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

$pdf->Output('ActaCompromiso.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>