<?php 



class ControladorReportes{

	// MOSTRAR REPORTES
	static public function ctrMostrarReportes($item, $valor){

		$tabla = "articulonovedad";

		$respuesta = ModeloReportes::mdlMostrarReportes($tabla, $item,$valor);

		return $respuesta;
	}

	// RANGO DE FECHAS
	static public function ctrRangoFechasReportes($fechaInicial, $fechaFinal){

		

		$tabla = "novedad";

		$respuesta = ModeloReportes::mdlRangoFechasReportes($tabla, $fechaInicial, $fechaFinal);
		
		return $respuesta;
		
	}

	// DESCARGAR EXCEL
	static public function ctrDescargarReporte(){

		if (isset($_GET["reporte"])) {

			$tabla = "novedad";
			
			if (isset($_GET["fechaInicial"])) {

				$respuesta = ModeloReportes::mdlRangoFechasReportes($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
				
			}else{

				$item = null;
				$valor = null;

				$respuesta = ModeloNovedades::mdlMostrarNovedades($tabla, $item, $valor);
				
			}

			// ARCHIVO DE EXCEL

			$Name = $_GET["reporte"].'.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate"); 
			header('Content-Description: File Transfer');
			header('Last-Modified: '.date('D, d M Y H:i:s'));
			header("Pragma: public"); 
			header('Content-Disposition:; filename="'.$Name.'"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

				<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>ID NOVEDAD</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ARTICULO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TIPO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>AMBIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>FICHA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>USUARIO</td>		
				</tr>");

			foreach ($respuesta as $key => $value) {

				$item1 = "idnovedad";
			  	$valor1 = $value["idnovedad"];
			 	$novedad = ControladorArticulos::ctrMostrarArticuloNovedad($item1, $valor1); 
			  
			  	foreach($novedad as $key1 => $value1) {
				  
				  	$item2 = "idarticulo";
					$valor2 = $novedad[$key1]["idarticulo"];
					$articulo = ControladorArticulos::ctrMostrarArticulos($item2, $valor2);
				
				  	$item3 = "numdocumentousuario";
				  	$valor3 = $value["numdocumentousuario"];
				  	$usuario = ControladorUsuarios::ctrMostrarUsuarios($item3, $valor3); 

				  	$item4 = "idambiente";
				  	$valor4 = $articulo["idambiente"];
				  	$ambiente = ControladorAmbientes::ctrMostrarAmbientes($item4, $valor4);

				  	$item5 = "idambiente";
				  	$valor5 = $articulo["idambiente"];
				  	$ficha = ControladorFichas::ctrMostrarFichas($item5, $valor5);

					echo utf8_decode("<tr>
				 			<td style='border:1px solid #eee;'>".$value["idnovedad"]."</td> 
				 			<td style='border:1px solid #eee;'>".$value["fechanovedad"]."</td>
				 			<td style='border:1px solid #eee;'>".$articulo["tipoarticulo"]."</td> 
				 			<td style='border:1px solid #eee;'>".$novedad[0]["tiponovedad"]."</td>
				 			<td style='border:1px solid #eee;'>".$ambiente["nombreambiente"]."</td> 
				 			<td style='border:1px solid #eee;'>".$ficha["numeroficha"]."</td>
				 			<td style='border:1px solid #eee;'>".$usuario["nombreusuario"]."</td>");
			  
			  	}
			}

		  	echo "</table>";
		}
	}
}