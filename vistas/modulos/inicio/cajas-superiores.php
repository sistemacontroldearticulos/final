<?php

$item = null;
$valor = null;
$orden = "id";

$novedades = ControladorNovedades::ctrMostrarNovedades($item, $valor);
$totalNovedades = count($novedades);

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
$totalUsuarios = count($usuarios);

$Categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor, $orden);
$totalCategorias = count($Categorias);

$Actas = ControladorActas::ctrMostrarActas($item, $valor, $orden);
$totalActas = count($Actas);

?>



<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-aqua">
    
    <div class="inner">
      
      <h3 style="font-size: 30px">Novedades</h3>
      <p style="font-size: 20px"><?php echo $totalNovedades; ?></p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-stats-bars"></i>
    
    </div>
    
    <a href="novedades" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-green">
    
    <div class="inner">
    
      <h3 style="font-size: 30px">Categorias</h3>
      <p style="font-size: 20px"><?php echo $totalCategorias; ?></p>
    
    </div>
    
    <div class="icon">
    
      <i class="ion ion-clipboard"></i>
    
    </div>
    
    <a href="categorias" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    
    <div class="inner">
    
      <h3 style="font-size: 30px">Usuarios</h3>
      <p style="font-size: 20px"><?php echo $totalUsuarios; ?></p>
  
    </div>
    
    <div class="icon">
    
      <i class="ion ion-person-add"></i>
    
    </div>
    
    <a href="usuarios" class="small-box-footer">

      Más info <i class="fa fa-arrow-circle-right"></i>

    </a>

  </div>

</div>

<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-red">
  
    <div class="inner" >
    
      <h3 style="font-size: 30px">Actas</h3>
      <p style="font-size: 20px"><?php echo $totalActas; ?></p>

    
    </div>
    
    <div class="icon">
      
      <i class="fa fa-book"></i>
    
    </div>
    
    <a href="actas" class="small-box-footer">
      
      Más info <i class="fa fa-arrow-circle-right"></i>
    
    </a>

  </div>

</div>
