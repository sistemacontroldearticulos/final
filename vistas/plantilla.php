<?php

session_start();

?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Sistema Control De Articulos</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/logo_vacio.png">

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">

   <!-- Daterange picker -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.css">

  <!-- Morris chart -->
  <link rel="stylesheet" href="vistas/bower_components/morris.js/morris.css">

<!--   <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 -->
  <!-- MATERIALIZE -->
  <!--Import Google Icon Font-->
  <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  Import materialize.css
  <link type="text/css" rel="stylesheet" href="vistas/materialize/css/materialize.min.css"  media="screen,projection"/> -->

  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->
  
  <!-- MATERIALIZE -->
  <!--Import jQuery before materialize.js-->
   <!--  <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="vistas/materialize/js/materialize.min.js"></script>
 -->
  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>

  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
   <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="vistas/plugins/iCheck/icheck.min.js"></script>

  <!-- InputMask -->
  <script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>

  <!-- jQuery Number -->
  <script src="vistas/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!-- daterangepicker http://www.daterangepicker.com/-->
  <script src="vistas/bower_components/moment/min/moment.min.js"></script>
  <script src="vistas/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <!-- Morris.js charts http://morrisjs.github.io/morris.js/-->
  <script src="vistas/bower_components/raphael/raphael.min.js"></script>
  <script src="vistas/bower_components/morris.js/morris.min.js"></script>

  <!-- ChartJS http://www.chartjs.org/-->
  <script src="vistas/bower_components/Chart.js/Chart.js"></script>



</head>

<!-- CUERPO DOCUMENTO -->

<body class="hold-transition skin-blue  sidebar-mini login-page">
 <!-- Site wrapper -->



  <?php

if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

    echo '<div class="wrapper">';

    // CABEZOTE
    include "modulos/cabezote.php";

    // MENU
    include "modulos/menu.php";

    // CONTENIDO
    if (isset($_GET["ruta"])) {

        if ($_GET["ruta"] == "inicio" ||
            $_GET["ruta"] == "ambientes" ||
            $_GET["ruta"] == "categorias" ||
            $_GET["ruta"] == "articulos" ||
            $_GET["ruta"] == "programas" ||
            $_GET["ruta"] == "usuarios" ||
            $_GET["ruta"] == "fichas" ||
            $_GET["ruta"] == "novedades" ||
            $_GET["ruta"] == "reportes" ||
            $_GET["ruta"] == "salir" ||
            $_GET["ruta"] == "equipos" ||
            $_GET["ruta"] == "crear-novedad" ||
            $_GET["ruta"] == "aprendiz" ||
            $_GET["ruta"] == "actas" ||
            $_GET["ruta"] == "acta-compromiso") {

            include "modulos/" . $_GET["ruta"] . ".php";

        } else {

            include "modulos/404.php";

        }

    } else {

        include "modulos/inicio.php";

    }

    // FOOTER
    include "modulos/footer.php";

    echo '</div>';
} else {

    // LOGIN
    include "modulos/login.php";

}

?>

<script src="vistas/js/actas.js"></script>
<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/duracion.js"></script>
<script src="vistas/js/programas.js"></script>
<script src="vistas/js/ambientes.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/fichas.js"></script>
<script src="vistas/js/articulos.js"></script>
<script src="vistas/js/equipos.js"></script>
<script src="vistas/js/novedades.js"></script>
<script src="vistas/js/aprendiz.js"></script>
<script src="vistas/js/reportes.js"></script>
<script src="vistas/js/acta-compromiso.js"></script>

</body>
</html>
