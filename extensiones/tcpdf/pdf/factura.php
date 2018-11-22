<?php

require_once "../../../controladores/actasControlador.php";
// require_once "../../../controladores/ambientesControlador.php";
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
// require_once "../../../modelos/ambientesModelo.php";
// require_once "../../../modelos/articulosModelo.php";
// require_once "../../../modelos/categoriasModelo.php";
// require_once "../../../modelos/fichasModelo.php";
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

$fecha = substr($respuesta["fechaacta"],0,-8);
$equipo = $respuesta["idequipo"];
$codigo1 = $respuesta["idacta"];
$documentoAprendiz = $respuesta["numdocumentoaprendiz"];
$documentoInstructor = $respuesta["numdocumentoinstructor"];

$item2 = "numdocumentoaprendiz";
$valor2 =  $respuesta["numdocumentoaprendiz"];
$mostrarAprendiz= ControladorAprendiz::ctrMostrarAprendiz($item2, $valor2);
$nombreaprendiz = $mostrarAprendiz[0]["nombreaprendiz"];


$item1 ="idequipo";
$valor1 = $respuesta["idequipo"];
$mostrarEquipo= ControladorEquipos::ctrMostrarEquipos($item1, $valor1);

$item3 ="numdocumentousuario";
$valor3 = $respuesta["numdocumentoinstructor"];
$usuario = ControladorUsuarios::ctrMostrarUsuarios($item3, $valor3);
$nombreusaurio = $usuario["nombreusuario"];


// //TRAEMOS LA INFORMACIÓN DEL CLIENTE

// $itemCliente = "id";
// $valorCliente = $respuestaVenta["id_cliente"];

// $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

// //TRAEMOS LA INFORMACIÓN DEL VENDEDOR

// $itemVendedor = "id";
// $valorVendedor = $respuestaVenta["id_vendedor"];

// $respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->startPageGroup();

$pdf->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

			<td style="background-color:white; width:140px">
				
				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					NIT: 899.999.034-1

					<br>
					Dirección: Kra 9 No. 71N-60 Sede Alto Cauca Popayán.

				</div>

			</td>

			<td style="background-color:white; width:140px">

				<div style="font-size:8.5px; text-align:right; line-height:15px;">
					
					<br>
					Teléfono: 824 4372.
					
					<br>
					gpservicioalcliente@sena.edu.co

				</div>
				
			</td>

			<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>ID ACTA.<br>$codigo1</td>
			
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF

	<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
	
		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Aprendiz: $nombreaprendiz

			</td>

			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
			
				Fecha: $fecha

			</td>

		</tr>

		<tr>
		
			<td style="border: 1px solid #666; background-color:white; width:540px">Usuario: $nombreusaurio</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

// $bloque3 = <<<EOF

// 	<table style="font-size:10px; padding:5px 10px;">

// 		<tr>
		
// 		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Producto</td>
// 		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Cantidad</td>
// 		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Unit.</td>
// 		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Valor Total</td>

// 		</tr>

// 	</table>

// EOF;

// $pdf->writeHTML($bloque3, false, false, false, false, '');

// // ---------------------------------------------------------

// foreach ($productos as $key => $item) {

// $itemProducto = "descripcion";
// $valorProducto = $item["descripcion"];
// $orden = null;

// $respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

// $valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

// $precioTotal = number_format($item["total"], 2);

// $bloque4 = <<<EOF

// 	<table style="font-size:10px; padding:5px 10px;">

// 		<tr>
			
// 			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
// 				$item[descripcion]
// 			</td>

// 			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
// 				$item[cantidad]
// 			</td>

// 			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
// 				$valorUnitario
// 			</td>

// 			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
// 				$precioTotal
// 			</td>


// 		</tr>

// 	</table>


// EOF;

// $pdf->writeHTML($bloque4, false, false, false, false, '');

// }

// // ---------------------------------------------------------

// $bloque5 = <<<EOF

// 	<table style="font-size:10px; padding:5px 10px;">

// 		<tr>

// 			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

// 			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

// 			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

// 		</tr>
		
// 		<tr>
		
// 			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

// 			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
// 				Neto:
// 			</td>

// 			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
// 				$ $neto
// 			</td>

// 		</tr>

// 		<tr>

// 			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

// 			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
// 				Impuesto:
// 			</td>
		
// 			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
// 				$ $impuesto
// 			</td>

// 		</tr>

// 		<tr>
		
// 			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

// 			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
// 				Total:
// 			</td>
			
// 			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
// 				$ $total
// 			</td>

// 		</tr>


// 	</table>

// EOF;

// $pdf->writeHTML($bloque5, false, false, false, false, '');



// // ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>