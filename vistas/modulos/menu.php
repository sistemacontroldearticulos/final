<aside class="main-sidebar" >

	 <section class="sidebar">

		<ul class="sidebar-menu">
			<br>

			<?php 

				if($_SESSION["RolUsuario"] == "ADMINISTRADOR"){

					echo '

			<li class="active">

				<a href="inicio">

					<img src="vistas/img/plantilla/iconos/inicio.png" width="15px">
					<span>inicio</span>

				</a>

			</li>


			<li>

				<a href="programas">

					<img src="vistas/img/plantilla/iconos/programas.png" width="15px">
					<span>Programas</span>

				</a>

			</li>
			<li>

				<a href="ambientes">

					<img src="vistas/img/plantilla/iconos/ambientes.png" width="15px">
					<span>Ambientes</span>

				</a>

			</li>

			<li>

				<a href="categorias">

					<img src="vistas/img/plantilla/iconos/categorias.png" width="15px">
					<span>Categorias</span>

				</a>

			</li>

			<li>

				<a href="equipos">
					
					<img src="vistas/img/plantilla/iconos/equipos.png" width="15px">
					<span>Equipos</span>

				</a>

			</li>

			<li>

				<a href="articulos">

					<img src="vistas/img/plantilla/iconos/articulos.png" width="15px">
					<span>Articulos</span>

				</a>

			</li>


			<li>

				<a href="usuarios">

					<img src="vistas/img/plantilla/iconos/usuarios.png" width="15px">
					<span>Usuarios</span>

				</a>

			</li>

			<li>

				<a href="fichas">
					
					<img src="vistas/img/plantilla/iconos/fichas.png" width="15px">
					<span>Fichas</span>

				</a>

			</li>';
			}

				if($_SESSION["RolUsuario"] == "INSTRUCTOR" || $_SESSION["RolUsuario"] == "ADMINISTRADOR" || $_SESSION["RolUsuario"] == "ESPECIAL"){

					echo '

			<li class="treeview">

				<a href="#">

					<img src="vistas/img/plantilla/iconos/novedad.png" width="15px">
					
					<span>Novedades</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-down pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="novedades">
							
							<img src="vistas/img/plantilla/iconos/novedades.png" width="15px">
							<span>Novedades</span>

						</a>

					</li>

					<li>

						<a href="crear-novedad">
									
							<img src="vistas/img/plantilla/iconos/crearnovedad.png" width="15px">
							<span>Crear novedad</span>

						</a>

					</li>

				</ul>

			</li>';
			
			}
			

			if($_SESSION["RolUsuario"] == "INSTRUCTOR" || $_SESSION["RolUsuario"] == "ADMINISTRADOR" || $_SESSION["RolUsuario"] == "ESPECIAL"){

					echo '

			<li>

				<a href="reportes">
					<img src="vistas/img/plantilla/iconos/reportes.png" width="15px">
					<span>Reportes</span>

				</a>

			</li>

			<li>

				<a href="actas">
					
					
					<img src="vistas/img/plantilla/iconos/actaresponsabilidad.png" width="15px">
					<span>Actas de responsabilidad</span>

				</a>

			</li>';
			}
			?>

		</ul>

	 </section>

</aside>