 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Evaluci&oacute;n
        <small> de Inducci&oacute;n</small>
      </h1>
    </section>

    <script>
    //paso a paso ini
$(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});
//paso a paso fin
    </script>

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
                              <input type="text" class="form-control pull-right" class="datepicker" name="fecha_evaluacion" value="<?php echo date('Y-m-d') ?>" disabled="disabled">
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
                              <input type="text" class="form-control pull-right" class="datepicker" name="fecha_audio" value="<?php echo date('Y-m-d');?>">
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

  <div class="row">
  <div class="col-xs-12">

  <div class="box box-success">
      <div class="box-body">

<div class="stepwizard col-md-offset-3">
    <div class="stepwizard-row setup-panel">
        <?php 
        $contador = 1;
        foreach($evaluacion as $a){?>
        <div class="stepwizard-step">
          <a href="#step-<?=$contador?>" type="button" class="btn btn-<?php if($contador==1){echo 'primary';}else{echo 'default';}?> btn-circle" <?php if($contador != 1){echo 'disabled="disabled"';}?>><?=$contador?></a>
        </div>
        <?php 
        $contador = $contador + 1;
      }?>
    </div>
  </div>
      <?php 
      $contador = 1;
      $cantidad_elementos = count($evaluacion);

      foreach($evaluacion as $a){?>

      
    <div class="row setup-content" id="step-<?=$contador?>">
      <div class="col-md-6 col-md-offset-3">
          
          <div class="col-md-12">
            <h3><?=$a->evaluacion?></h3>

            <input type="hidden" name="id_evaluacion" id="id_evaluacion" value="<?php echo $a->id_evaluacion_induccion;?>" readonly/>
            <input type="hidden" name="peso_grupo" id="peso_grupo" value="<?= $a->peso;?>" readonly/> 
            <input type="hidden" style="width:100px;" class="form-control" name="item_sel<?=$a->id_evaluacion_induccion;?>" id="item_sel<?=$a->id_evaluacion_induccion;?>" value="" readonly/>    
            
            <table class="table table-condensed">
                    <tr>
                        <th>Item</th>
                        <th></th>
                        <th>Opcion</th>
                    </tr>
                    <?php
                    foreach($evaluacion_items as $i){?>
                    <?php
                            if($i->id_evaluacion_induccion == $a->id_evaluacion_induccion){?>                            
                            <tr>
                              <?php if($i->tipo=='T'){?>
                              <td width="8%"><input type="radio" name="opcion<?=$a->id_evaluacion_induccion;?>" id="opcion" onclick="seleccionado('item_sel<?=$a->id_evaluacion_induccion;?>','<?= $i->id_evaluacion_induccion_item;?>','continuar<?php echo $a->id_evaluacion_induccion;?>');" value="<?php if($i->correcto==1){echo $a->peso;}else{echo '0';}?>" required="required">Si</td>
                              <td width="8%"><input type="radio" name="opcion<?=$a->id_evaluacion_induccion;?>" id="opcion" onclick="seleccionado('item_sel<?=$a->id_evaluacion_induccion;?>','<?= $i->id_evaluacion_induccion_item;?>','continuar<?php echo $a->id_evaluacion_induccion;?>');"value="0">No</td>
                              <?php }else{?>
                              <td width="16%">
                                <input type="radio" name="opcion<?=$a->id_evaluacion_induccion;?>" id="opcion" onclick="seleccionado('item_sel<?=$a->id_evaluacion_induccion;?>','<?= $i->id_evaluacion_induccion_item;?>','continuar<?php echo $a->id_evaluacion_induccion;?>');" value="<?php if($i->correcto==1){echo $a->peso;}else{echo '0';}?>" required="required">
                              </td>
                              <?php }?>
                              <td width="9%">
                                <input type="hidden" style="width:100px;" class="form-control" name="correcto<?= $i->id_evaluacion_induccion_item;?>" id="correcto<?= $i->id_evaluacion_induccion_item;?>" value="<?= $i->correcto;?>" readonly/>
                                <input type="hidden" class="form-control" name="tipo<?= $i->id_evaluacion_induccion;?>" id="tipo<?= $i->id_evaluacion_induccion;?>" value="<?= $i->tipo;?>" />
                              </td>
                              <td width="75%">

                              <?php if($i->tipo=='T'){?>
                              <textarea class="form-control pull left" name="observacion<?= $i->id_evaluacion_induccion;?>" row="5" id="observacion<?= $i->id_evaluacion_induccion;?>" required="required">&nbsp;</textarea>
                              <?php }else{
                                echo $i->opcion;
                              }?>

                              </td>
                            </tr>                                
                           <?php  }
                           }?>
                  </table>            
            <?php 
            /*
            if($contador >1){      
            <button class="btn btn-primary prevBtn btn-md pull-left" type="button" id="volver<?php echo $a->id_evaluacion_induccion;?>" >Volver</button> 
            }
            */?>
            <?php if($contador == $cantidad_elementos){?>
            <button type="submit" class="btn btn-info pull-right">Guardar</button>
            <?php }else{?>
            
            <button class="btn btn-primary nextBtn btn-md pull-right" type="button" id="continuar<?php echo $a->id_evaluacion_induccion;?>" disabled>Continuar</button>
            <?php }?>

          </div>
      </div>
    </div>    
    <?php 
      $contador = $contador + 1;
    }?>  
</div></div> 
</div></div> 

<div class="row" id="suma_de_puntos">
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

    <?php echo form_close();?>
    </section> </div>

<script>
$(document).ready(function(){  
$('.datepicker').datepicker({
        startDate: 'today',
        format: 'yyyy/mm/dd',
        todayBtn: true,
        language: "es",
        autoclose: true
    });
$(".timepicker").timepicker({
      showInputs: false,

    });
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



$(document).ready(function(){
    $('#suma_de_puntos').hide();
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
function seleccionado(id,valor,btn){
  var valor = $('#'+id).val(valor);
  //alert(btn);
  $('#'+btn).prop('disabled', false);
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