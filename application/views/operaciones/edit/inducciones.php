 <?php
  $contador  = 2;
 ?>
 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inducciones 
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
    <?php
      echo form_open('Operaciones/editar_inducciones');
      ?>
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Inducciones</h3>
              </div>
              <div class="box-body">
                <div class="row">
                    <?php echo form_hidden('id_inducciones',$id);?>
                    <div class="col-md-5">  
                        <div class="form-group">
                            <input class="form-control" type="text" name="inducciones" id="inducciones" value="<?php if(!empty($inducciones_item[0]['evaluacion'])){echo $inducciones_item[0]['evaluacion'];}?>" /><br />
                            <input class="form-control" type="text" name="peso_inducciones" id="peso_induccionesx" value="<?php if(!empty($inducciones_item[0]['peso'])){echo $inducciones_item[0]['peso'];}?>" >
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button id="item" type="button" class="btn btn-info pull-right" onclick="agregar_item()" <?php if($inducciones_item[0]['tipo']=='T'){echo 'disabled';}?>>Agregar Item</button>
                        <input type="hidden" name="tipo" id="tipo" class="form-control" value="<?php if(!empty($inducciones_item[0]['tipo'])){echo $inducciones_item[0]['tipo'];}?>"/>
                    </div>
                    <div class="col-md-2">
                        <button id="area" type="button" class="btn btn-info pull-right" onclick="agregar_text()" <?php if($inducciones_item[0]['tipo']=='T'){echo 'disabled';}?>>Agregar TextArea</button>
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
                  <h3 class="box-title">Item Inducciones</h3>
              </div>
              <div class="box-body div_items">
              <?php
              $i = 1;              
              if(!empty($inducciones_item[0]['id_evaluacion_induccion_item'])) {
                $count_correcto = 1; 
                foreach ($inducciones_item as $c) {
                ?>
                <div class="row">

                    <div class="col-md-1">
                    <div class="form-group">
                        <label>&nbsp;</label><br/>
                      <input type="hidden" name="id_item" value="<?php if(!empty($c['id_evaluacion_induccion_item'])){echo $c['id_evaluacion_induccion_item'];}?>">  
                      <input type="radio" name="correcto" id="correcto" value="<?php echo $count_correcto;?>" <?php if($c['correcto']==1){echo 'checked';}?>   />
                    </div> 
                    </div>

                    <?php if($inducciones_item[0]['tipo']=='T'){?> 
                    <div class="col-md-8">
                    <div class="form-group">
                        <label>Item<?php echo $i?></label>                         
                         <textarea class="form-control" rows="5" id="item_opcion[]" name="item_opcion[]" disabled><?php if(!empty($c['opcion'])){echo $c['opcion'];}?>&nbsp;</textarea><br />
                         <input class="form-control" type="hidden" name="activo[]" value="1">
                    </div> 
                    </div>
                    <?php }else{?>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Item<?php echo $i?></label>                         
                         <input class="form-control" type="text" name="item_opcion[]" value="<?php if(!empty($c['opcion'])){echo $c['opcion'];}?>"><br />
                         <input class="form-control" type="hidden" name="activo[]" value="1">
                    </div> 
                    </div>
                    <?php }?>

                </div>
              <?php 
              $i++;
              $count_correcto = $count_correcto + 1;
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
        contador = <?php echo count($inducciones_item) ?>;
    });
    function agregar_item(){
      $("#area").prop( "disabled", true );
      $("#tipo").val('I');
        contador++;
        form = '<div class="row">';
        form += '<div class="col-md-1">';
        form += '<div class="form-group">';
        form += '<label>&nbsp;</label><br/><input type="radio" name="correcto" id="correcto" value="'+(contador-1)+'" checked /><br />';
        form += '</div></div>';
        form += '<div class="col-md-3">';
        form += '<div class="form-group">';
        form += '<label>Item</label><input class="form-control" type="text" name="item_opcion[]" class="item_opcion"><input class="form-control" type="hidden" name="activo[]" value="1"><b><br/>';
        form += '</div></div>';
        form += '</div>';    
        $('.div_items').append(form);
        <?php $contador++;?>
    }
    function agregar_text(){
        $( "#item,#area" ).prop( "disabled", true );
        $("#tipo").val('T');
        contador++;
        form = '<div class="row">';
        form += '<div class="col-md-1">';
        form += '<div class="form-group">';
        form += '<label>&nbsp;</label><br/><input type="radio" name="correcto" id="correcto" checked/><input class="form-control" type="hidden" name="activo[]" value="1"><br />';
        form += '</div></div>';
        form += '<div class="col-md-8">';
        form += '<div class="form-group">';
        form += '<label>&nbsp;</label><br/><textarea class="form-control" rows="5" id="item_opcion[]" name="item_opcion[]"></textarea><input class="form-control" type="hidden" name="activo[]" value="1"><br />';
        form += '</div></div>';
        form += '</div>';    
        $('.div_items').append(form);
        <?php $contador++;?>
    }
    </script>