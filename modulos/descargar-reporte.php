<?php 

require_once "../../controladores/reportesControlador.php";
require_once "../../modelos/reportesModelo.php";

require_once "../../controladores/novedadesControlador.php";
require_once "../../modelos/novedadesModelo.php";

require_once "../../controladores/articulosControlador.php";
require_once "../../modelos/articulosModelo.php";

require_once "../../controladores/usuariosControlador.php";
require_once "../../modelos/usuariosModelo.php";

require_once "../../controladores/ambientesControlador.php";
require_once "../../modelos/ambientesModelo.php";

require_once "../../controladores/fichasControlador.php";
require_once "../../modelos/fichasModelo.php";

$reporte = new ControladorReportes();
$reporte -> ctrDescargarReporte();