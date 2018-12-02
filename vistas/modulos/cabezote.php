 <header class="main-header" >

	<!-- LOGOTIPO -->
	<a href="inicio" class="logo" >

		<!-- LOGO MINI -->
		<span class="logo-mini">

			<img src="vistas/img/plantilla/LOGO_PEQUENIO_INICIALES.png" class="img-responsive" style="padding:6px 0px 0px 0px;">

		</span>

		<!-- LOGO NORMAL -->
		<span class="logo-lg">

			<img src="vistas/img/plantilla/logo_bloque.png" class="img-responsive" style="padding:1px 0px 0px 0px">

		</span>

	</a>

	<!-- BARRA DE NAVEGACION -->
	<nav class="navbar navbar-static-top" role="navigation">

		<!-- BOTON DE NAVEGACION -->
	 	<a href="#" class="sidebar-toggle btn-lg" data-toggle="push-menu" role="button">

        	<span class="sr-only">Toggle navigation</span>

      	</a>

		<!-- PERFIL DE USUARIO -->
		<div class="navbar-custom-menu">

			<ul class="nav navbar-nav">

				<li class="dropdown user user-menu">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-bottom: 25px;" >
					<?php

					if($_SESSION["FotoUsuario"] != ""){

						echo '<img src="'.$_SESSION["FotoUsuario"].'" class="user-image">';

					}else{


						echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';

					}


					?>
						
						<span class="hidden-xs"><?php  echo $_SESSION["NombreUsuario"]; ?></span>

					</a>

					<!-- DROPDOWN-TOGGLE -->
					<ul class="dropdown-menu" style="width: 100%">

						<li class="user-body">

							<div class="pull-right" >

								<a href="salir" class="btn btn-default btn-flat" style="width: 120px">

									SALIR  <i class="fa fa-arrow-circle-right"></i>
								</a>


          

							</div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

 </header>
