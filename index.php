<?php

require_once "controladores/actasControlador.php";
require_once "controladores/ambientesControlador.php";
require_once "controladores/articulosControlador.php";
require_once "controladores/categoriasControlador.php";
require_once "controladores/fichasControlador.php";
require_once "controladores/novedadesControlador.php";
require_once "controladores/programasControlador.php";
require_once "controladores/reportesControlador.php";
require_once "controladores/usuariosControlador.php";
require_once "controladores/equipoControlador.php";
require_once "controladores/notificacionesControlador.php";

require_once "controladores/aprendizControlador.php";

require_once "modelos/notificacionesModelo.php";
require_once "modelos/actasModelo.php";
require_once "modelos/equipoModelo.php";
require_once "modelos/ambientesModelo.php";
require_once "modelos/articulosModelo.php";
require_once "modelos/categoriasModelo.php";
require_once "modelos/fichasModelo.php";
require_once "modelos/novedadesModelo.php";
require_once "modelos/programasModelo.php";
require_once "modelos/reportesModelo.php";
require_once "modelos/usuariosModelo.php";
require_once "modelos/aprendizModelo.php";

require_once "controladores/plantillaControlador.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
