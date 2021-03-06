 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Evaluci&oacute;n
        <small> de Inducci&oacute;n</small>
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
        echo form_open('operaciones/guardar_einduccion', $attributes);
        ?><br />
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
                        <?php echo form_dropdown('rut',$rut,'',array('class' => 'form-control','id' => 'rut'));?>                           
                        </div>
                    </div>
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" readonly/>
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apellido Paterno</label>
                                <input class="form-control" type="text" name="paterno" id="paterno" readonly/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apellido Materno</label>
                                <input class="form-control" type="text" name="materno" id="materno" readonly/>                           
                            </div>
                        </div>
                    </div>
                  <div class="row">
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Area</label>
                        <?php
                        echo form_dropdown('area_id',$areas,'',array('class' => 'form-control','id' => 'select_area'));
                        ?>
                      </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cartera</label>
                            <?php
                            echo form_dropdown('cartera_id',$carteras,'',array('class' => 'form-control', 'id' => 'select_cartera'));
                            ?>
                        </div>
                    </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Supervisor</label>
                                <?php
                                echo form_dropdown('supervisor',$supervisores,'',array('class' => 'form-control','id' => 'supervisor'));
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
                              <input type="text" class="form-control pull-right" class="datepicker" name="fecha_evaluacion" value="<?php echo date('d-m-Y') ?>" disabled="disabled">
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
                              <input type="text" class="form-control pull-right" class="datepicker" name="fecha_audio" value="<?php echo date('d-m-Y');?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Evaluador</label>
                                <input class="form-control" type="evaluador" name="evaluador" id="evaluador" required>                           
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Rut del Audio</label>
                                <input class="form-control" type="rut_audio" name="rut_audio" id="rut_audio" required>                           
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cargo a Postular</label>
                                <input class="form-control" type="text" name="cargo" id="cargo" readonly>
                                <input class="form-control" type="hidden" name="id_cargo" id="id_cargo" readonly>                                                           
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
      foreach($evaluacion as $a){
        ?>
       <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?= $a->evaluacion;?> / id: <?= $a->id_evaluacion_induccion;?></h3>
                </div>
                <div class="box-body">
                    <input type="text" name="id_evaluacion" id="id_evaluacion" value="<?php echo $a->id_evaluacion_induccion;?>" />
                    <input type="text" name="peso_grupo" id="peso_grupo" value="<?= $a->peso;?>" /> 
                    <input type="text" style="width:100px;" class="form-control" name="item_sel<?=$a->id_evaluacion_induccion;?>" id="item_sel<?=$a->id_evaluacion_induccion;?>" value="" readonly/>    
                    
                    <table class="table table-condensed">
                    <tr>
                        <th>Item</th>
                        <th></th>
                        <th>Opcion</th>
                    </tr>
                    <?php
                    foreach($evaluacion_items as $i){

                            if($i->id_evaluacion_induccion == $a->id_evaluacion_induccion){?>                            
                            <tr>
                              <?php if($i->tipo=='T'){?>
                              <td width="5%"><input type="radio" name="opcion<?=$a->id_evaluacion_induccion;?>" id="opcion" onclick="seleccionado('item_sel<?=$a->id_evaluacion_induccion;?>','<?= $i->id_evaluacion_induccion_item;?>');" value="<?php if($i->correcto==1){echo $a->peso;}else{echo '0';}?>" required>Si</td>
                              <td width="5%"><input type="radio" name="opcion<?=$a->id_evaluacion_induccion;?>" id="opcion" onclick="seleccionado('item_sel<?=$a->id_evaluacion_induccion;?>','<?= $i->id_evaluacion_induccion_item;?>');"value="0">No</td>
                              <?php }else{?>
                              <td width="10%">
                                <input type="radio" name="opcion<?=$a->id_evaluacion_induccion;?>" id="opcion" onclick="seleccionado('item_sel<?=$a->id_evaluacion_induccion;?>','<?= $i->id_evaluacion_induccion_item;?>');" value="<?php if($i->correcto==1){echo $a->peso;}else{echo '0';}?>" required>
                              </td>
                              <?php }?>
                              <td width="10%">
                                <input type="hidden" style="width:100px;" class="form-control" name="correcto<?= $i->id_evaluacion_induccion_item;?>" id="correcto<?= $i->id_evaluacion_induccion_item;?>" value="<?= $i->correcto;?>" readonly/>
                                <input type="hidden" class="form-control" name="tipo<?= $i->id_evaluacion_induccion;?>" id="tipo<?= $i->id_evaluacion_induccion;?>" value="<?= $i->tipo;?>" />
                              </td>
                              <td width="80%">
                              <?php if($i->tipo=='T'){?>
                              <textarea class="form-control" name="observacion<?= $i->id_evaluacion_induccion;?>" row="5" id="observacion<?= $i->id_evaluacion_induccion;?>" required>&nbsp;</textarea>
                              <?php }else{
                                echo $i->opcion;
                              }?>
                              </td>
                            </tr>                                
                           <?php  }
                           }?>
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
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Total Evaluacion</h3>
                </div>
                <div class="box-body">
                    
                    <div class="form-group has-warning">
                      <label class="control-label" for="inputWarning"></i> Suma de Puntos</label>
                      <input type="text" class="form-control" id="resultado" name="resultado" readonly required/>
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
            <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Observaciones Generales</h3>
                </div>
                <div class="box-body">
                     <div class="form-group has-error">
                      <label class="control-label" for="inputError"></i> Observaciones</label>
                      <textarea class="form-control" rows="3" id="observacion_general" name="observacion_general" required></textarea>
                    </div> 
                </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
             <div class="row">
                    <div class="col-md-10"></div>
                        <div class="col-md-2">
                             <button type="submit" class="btn btn-info pull-right">Guardar</button>
                        </div>
                   </div>
            </div>
    <?php echo form_close();?>
    </section>

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

$(document).ready(function() {
    cargar_datos();
    setTimeout(function(){ $("#alertita").fadeOut(4000);}, 5000);

    //calculo de correctos
    var $inRadio = $("#form1").find("input[type='radio']");
    var $inResultado = $("#form1").find("#resultado");
    var $valores = {};
    
    $inRadio.on("change", function(){
        
        var $valor = +$(this).val();
        var $nombre = $(this).attr("name");
        
        $valores[""+ $nombre+ ""] = $valor;
        
        var $suma = 0;
        
        $.each($valores, function(indice, $valorArray){
           $suma =+ $suma + $valorArray; 
        });

        $inResultado.val($suma);
    });
});
</script>
<script>
 $( "#rut" ).change(function() {
    cargar_datos();
    prueba();
});
function seleccionado(id,valor){
  var valor = $('#'+id).val(valor);
}
function cargar_datos(){    
    $.ajax({
      url:"<?php echo base_url('/index.php/index/test')?>",
      type:'POST',
      data: {rut:$('#rut').val()},
      success: function(data){
        data = JSON.parse(data);
        $.each(data.persona,function(i,v){
             p_nombre = v.nombre;
             p_paterno = v.paterno;
             p_materno = v.materno;
             //p_cargo = v.id_cargo;
        });
        $.each(data.postulante,function(i,w){
             p_id_cargo = w.id_cargo;
             p_cargo = w.cargo;
        });
        $("#nombre").val(p_nombre);
        $("#paterno").val(p_paterno);
        $("#materno").val(p_materno);
        $("#cargo").val(p_cargo);
        $("#id_cargo").val(p_id_cargo);

        $("#select_cartera").html(options_p);

      },
      error: function(e) {
        console.debug('error');
      }
   });
}
$("#select_area" ).change(function(){
    cargar_carteras();
});
function cargar_carteras(){    
    $.ajax({
      url:"<?php echo base_url('/index.php/index/cargar_carteras')?>",
      type:'POST',
      data: {area:$('#select_area').val()},
      success: function(data) {        
      options_p = "<option selected>Seleccione area</option>";
        data = JSON.parse(data);
        //console.debug(data);
        $.each(data.carteras,function(i,v){
             options_p +="<option value='"+v.id_cartera+"'>"+v.cartera+"</option>";
            
        });
        $("#select_cartera").html(options_p);
      },
      error: function(e) {
        console.debug('error');
      }
   }); 
}

</script>