 <?php
 $contador  = 2;
 ?>
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escucha 
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php
      echo form_open('Gestion/editar_escucha');
      ?>
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Escucha</h3>
              </div>
              <div class="box-body">
                <div class="row">
                    <?php echo form_hidden('id_escucha',$id);

                    /*
                    echo '<pre>';
                      print_r($escucha);
                    echo '</pre>';
                    */

                    ?>
                    <div class="col-md-5">  
                        <div class="form-group">
                            <input type="hidden" name="id_escucha" id="id_escucha" value="<?php echo $id;?>" />                          
                            <input class="form-control" type="text" name="escucha" id="escucha" value="<?php echo $escucha[0]['aspecto'] ?>" /><br />
                            <input class="form-control" type="text" name="ponderacion_escucha" id="ponderacion_escucha" value="<?php echo $escucha[0]['ponderacion'];?>" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button  type="button" class="btn btn-info pull-right" onclick="agregar_item()">Agregar Item</button>
                    </div>
              </div>
          </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
      
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Item Escucha</h3>
              </div>
              <div class="box-body div_items">
              <?php

              /*
              echo '<pre>';
              print_r($escucha);
              echo '</pre>';
              */

              $i = 1;
              if(!empty($escucha)) { 
                foreach ($escucha as $c) {
                ?>
                <div class="row">

                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Item<?php echo $i?></label>
                        <input class="form-control" type="text" name="item_aspectos[]" class="item_aspectos" value="<?php echo $c['item_aspecto'] ?>"><br />
                    </div>
                    </div>  
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Peso<?php echo $i?></label>
                        <input class="form-control" type="text" name="peso_item[]" class="peso_item" value=""><br/>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Ponderacion<?php echo $i?></label>
                        <input class="form-control" type="text" name="ponderacion_item[]" class="ponderacion_item" value="<?php echo $c['i_ponderacion'] ?>"><br/>
                      </div>
                    </div>      
                </div>
              <?php 
              $i++; 
                }
              }
              ?>
                             
          </div>
          <div class="box-body">
          <div class="row">
              <div class="col-md-10"></div>
              <div class="col-md-2">
                        <button type="submit" class="btn btn-info pull-right">Guardar</button>
                    </div>
              </div>
          </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>


      </div>
    </section>
    <div></div>
    <script>
    $(document).ready(function(){
        contador = <?php echo count($escucha) ?>;
    });
    function agregar_item(){
        contador++;
        form = '<div class="row">';
        form += '<div class="col-md-3">';
        form += '<div class="form-group">';
        form+= '<label>Item'+(contador)+'</label><input class="form-control" type="text" name="item_aspectos[]"><br />';
        form += '</div></div>';
        form += '<div class="col-md-3">';
        form += '<div class="form-group">';
        form+= '<label>Peso'+(contador)+'</label><input class="form-control" type="text" name="peso_item[]"><b><br/>';
        form += '</div></div>';
        form += '<div class="col-md-3">';
        form += '<div class="form-group">';
        form += '<label>Ponderacion'+(contador)+'</label><input class="form-control" type="text" name="ponderacion_item[]"><b><br/>'
        form += '</div></div></div>';    
        $('.div_items').append(form);
        <?php $contador++;?>
    }
    </script>