 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Evaluci&oacute;n
        <small> de Escuchas</small>
      </h1>
    </section>


    <!-- Main content -->
    <section class="content">

    <div class="row">
        <div class="col-xs-12">        
        <?php 
        $msje_solicitud = $this->session->flashdata('msje_evaluacion');
            if(!empty($msje_solicitud)){
            ?>
            <div id="alertita" class="alert alert-<?php if($msje_solicitud[0]==1){echo 'success';}else{echo 'danger';}?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?php if($msje_solicitud[0]==1){echo 'Exito';}else{echo 'Fracaso';}?></strong> <?php if($msje_solicitud[0]==1){echo 'Se ha registrado con exito';}else{echo 'La solicitud no se ha modificado';}?>
            </div>        
            <?php }?>
        </div>
    </div>

    <?php 
        $attributes = array('id' => 'form1');
        echo form_open('operaciones/insert_escuchas', $attributes);
        ?>
        <input class="form-control" type="hidden" name="id" id="id" value="<?php echo $id;?>" readonly/><br />
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Evaluacion General de Inducci&oacute;n Ejecutivos</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                        <label>RUT</label>                            
                        <input class="form-control" type="text" name="rut" id="rut" value="<?php echo $persona[0]['rut'];?>" readonly/>                           
                        </div>
                    </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $persona[0]['nombre'];?>" readonly/>
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apellido Paterno</label>
                                <input class="form-control" type="text" name="paterno" id="paterno" value="<?php echo $persona[0]['paterno'];?>" readonly/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apellido Materno</label>
                                <input class="form-control" type="text" name="materno" id="materno" value="<?php echo $persona[0]['materno'];?>" readonly/>                           
                            </div>
                        </div>
                    </div>
                  <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Area</label>
                        <?php
                        echo form_dropdown('area_id',$areas,$nota[0]['id_area'],array('class' => 'form-control','id' => 'select_area'));
                        ?>
                      </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cartera</label>
                            <?php
                            echo form_dropdown('cartera_id',$carteras,$nota[0]['id_cartera'],array('class' => 'form-control', 'id' => 'select_cartera'));
                            ?>
                        </div>
                    </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Supervisor</label>
                                <?php
                                echo form_dropdown('supervisor',$supervisores,$nota[0]['id_supervisor'],array('class' => 'form-control','id' => 'supervisor'));
                                ?>                           
                            </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Fecha Evaluaci&oacute;n</label>        
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" class="datepicker" name="fecha_evaluacion" value="<?=$nota[0]['fecha_evaluacion'];?>" disabled="disabled">
                            </div>
                            <!-- /.input group -->
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Fecha Audio</label>        
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control pull-right" class="datepicker" name="fecha_audio" value="<?=$nota[0]['fecha_audio'];?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Evaluador</label>
                                <input class="form-control" type="evaluador" name="evaluador" id="evaluador" value="<?=$nota[0]['evaluador']?>" required>                           
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Rut del Audio</label>
                                <input class="form-control" type="rut_audio" name="rut_audio" id="rut_audio" value="<?php echo $nota[0]['rut_audio'];?>" required>                           
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cargo a Postular</label>
                                <input class="form-control" type="text" name="cargo" id="cargo" value="<?php echo $cargo[0]['cargo'];?>" readonly>
                                <input class="form-control" type="hidden" name="id_cargo" id="id_cargo" value="<?php echo $cargo[0]['id_cargo'];?>" readonly>                                                           
                            </div>
                        </div>
                  </div>
                </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
        </div>
      <!-- /.row -->
    </div>


    <?php 
    /*
    echo '<pre>';
      print_r($aspectos_escuchas);
    echo '</pre>'  ;

    echo '<pre>';
      print_r($aspectos_escuchas_items);
    echo '</pre>'  ;
    */

    foreach($aspectos_escuchas as $a){ ?>
       <div class="row">
        <div class="col-xs-12">
          
          <input type="text" name="" id="" value="<?=$a['id_aspecto'];?>" style="width:70px;" />

            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?= $a['aspecto'].'&nbsp;&nbsp;&nbsp;'. round($a['ponderacion']) ?>%</h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed">
                    <tr>
                        <th>Item</th>
                        <th>Cumple</th>
                        <th>Nota Parcial</th>
                        <th>Observacion</th>
                    </tr>
                    <?php foreach($aspectos_escuchas_items as $i){
                            if($i['id_aspecto_escucha'] == $a['id_aspecto']){ ?>                            
                            <tr>
                              <td>
                                <?=$i['item_aspecto'];?></td>
                              <td>
                                <select>
                                  <option>SI</option>
                                  <option>NO</option>
                                </select>
                              </td>
                              <td><input type="text" /></td>
                              <td><input type="text" /></td>
                            </tr>                                
                           <?php  }} ?>
                  </table>            
                </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
      <?php } ?>



<div class="row">
  <div class="col-md-10"></div>
      <div class="col-md-2">
           <button type="submit" class="btn btn-info pull-right">Guardar</button>
      </div>
 </div>

    <?php echo form_close();?>
    </section> </div>

<script>
$('.datepicker').datepicker({
      autoclose: true
    });
$(".timepicker").timepicker({
      showInputs: false,
      showMeridian: false
});

$('#rut_audio').Rut({
  on_error: function(){ 
    $('#alerta_rut').fadeIn();
    $('.verificar').fadeOut();
    setTimeout(function(){
        $("#alerta_rut").fadeOut(2000);},3000);
    },
  format_on: 'keyup'
});
</script>
