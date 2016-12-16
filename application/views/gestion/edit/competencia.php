 <?php
 echo $contador  = 2;
 ?>
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Competencias 
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
    <?php
      echo form_open('Gestion/editar_competencia');
      ?>
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Competencia</h3>
              </div>
              <div class="box-body">
                <div class="row">
                    <?php echo form_hidden('id_competencia',$id);?>
                    <div class="col-md-5">  
                        <div class="form-group">
                            <input class="form-control" type="text" name="competencia" id="competencia" value="<?php echo $competencias[0]['competencia'] ?>" />
                            <br /><input class="form-control" type="text" name="ponderacion_competencia" id="ponderacion_competencia" value="<?php echo $competencias[0]['c_ponderacion'] ?>" >
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
                  <h3 class="box-title">Item Competencia</h3>
              </div>
              <div class="box-body div_items">
              <?php
              $i = 1;
              if(!empty($competencias)) { 
                foreach ($competencias as $c) {
                ?>
                <div class="row">

                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Item<?php echo $i?></label>
                        <input class="form-control" type="text" name="item_competencia[]" class="item_competencia" value="<?php echo $c['descripcion'] ?>"><br />
                    </div>
                    </div>  
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Peso<?php echo $i?></label>
                        <input class="form-control" type="text" name="peso_item[]" class="peso_item" value="<?php echo $c['peso'] ?>"><br/>
                    </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Ponderacion<?php echo $i?></label>
                        <input class="form-control" type="text" name="ponderacion_item[]" class="ponderacion_item" value="<?php echo $c['ponderacion'] ?>"><br/>
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
        contador = <?php echo count($competencias) ?>;
    });
    function agregar_item(){
        contador++;
        form = '<div class="row">';
        form += '<div class="col-md-3">';
        form += '<div class="form-group">';
        form+= '<label>Item'+(contador)+'</label><input class="form-control" type="text" name="item_competencia[]" class="item_competencia"><br />';
        form += '</div></div>';
        form += '<div class="col-md-3">';
        form += '<div class="form-group">';
        form+= '<label>Peso'+(contador)+'</label><input class="form-control" type="text" name="peso_item[]" class="peso_item"><b><br/>';
        form += '</div></div>';
        form += '<div class="col-md-3">';
        form += '<div class="form-group">';
        form += '<label>Ponderacion'+(contador)+'</label><input class="form-control" type="text" name="ponderacion_item[]" class="ponderacion_item"><b><br/>'
        form += '</div></div></div>';    
        $('.div_items').append(form);
        <?php $contador++;?>
    }
    </script>