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


        
              <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon">
                    <img src="vistas/img/plantilla/modal/ambientes.png" width="15px">
                  </span>

                  <select class="form-control select2" style="width: 100%; border-radius: 0px">
                    <option selected="selected">Seleccionar Ambiente</option>
                      <?php

                        $item  = null;
                        $valor = null;

                        $ambiente = ControladorAmbientes::ctrMostrarAmbientes($item, $valor);

                        foreach ($ambiente as $key => $value) {

                          echo '<option value="' . $value["idambiente"] . '">' . $value["nombreambiente"] . '</option>';
                        }

                      ?>
                  </select>
                
                </div>

              </div>


  </section>

</div>

 


