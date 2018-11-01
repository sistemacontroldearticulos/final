<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Inicio

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Inicio</li>
    
    </ol>

   <section class="content">

     <div class="row">

         <div class="col-lg-12">
           
          <?php

          if($_SESSION["RolUsuario"] == "INSTRUCTOR" || $_SESSION["RolUsuario"] == "ADMINISTRADOR" || $_SESSION["RolUsuario"] == "ESPECIAL"){

             echo '<div class="box box-success">

             <div class="box-header">

             <h1>Bienvenid@ ' .$_SESSION["NombreUsuario"].'</h1>

             </div>

             </div>';

          }

          ?>

         </div>

     </div>

  </section>

</div>


