<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Inicio

    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Inicio</li>
    
    </ol>
   </section>
   <section class="content">

    <div class="row">
      
      <?php 

        include "inicio/cajas-superiores.php";

      ?>

    </div>

    <div class="row">
      <div class="col-lg-12">
      
        <?php 

          include "inicio/grafico-novedades.php";

        ?>
      </div>
    </div>

  </section>


  <?php

    $perdidos = ModeloArticulos::perdidos();
    $activos = ModeloArticulos::activos();
    $daniados = ModeloArticulos::daniado();
    
  ?>

  <section class="content">

      <div class="box">

        <div class="box-header with-border">

          <h3 class="box-title">Articulos</h3>

          <div class="box-tools pull-right">

            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">

              <i class="fa fa-minus"></i>
            </button>

            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">

              <i class="fa fa-times"></i>
            </button>

          </div>

        </div>

        <div class="box-body">
          
          <div class="row">

            <div class="col-lg-4 col-xs-6">
              <div class="info-box bg-green">
                <span class="info-box-icon" onclick="location.href='articulos'"><i class="fa fa-thumbs-o-up"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Activos</span>
                  <span class="info-box-number"><?php echo $activos[0]?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>

                </div>
              </div>
            </div>

           <div class="col-lg-4 col-xs-6">
              <div class="info-box bg-yellow">
                <span class="info-box-icon" onclick="location.href='articulos'"><i class="fa fa-bolt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Dañados</span>
                  <span class="info-box-number"><?php echo $daniados[0]?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
  
                </div>
              </div>
            </div>

           <div class="col-lg-4 col-xs-6">
              <div class="info-box bg-red">
                <span class="info-box-icon" onclick="location.href='articulos'"><i class="fa fa-thumbs-o-down"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Perdidos</span>
                  <span class="info-box-number"><?php echo $perdidos[0]?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
  
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-lg-12">
      
        <?php 

          include "inicio/reportes-ambientes.php";

        ?>
      </div>

    </div>

  </section>
</div>


