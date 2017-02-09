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
              $bloquea = '';
            if($nota[0]['calidad']==1){
              $bloquea = 'disabled';
            ?>
            <div id="alertita" class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Atenci&oacute;n</strong> El Ejecutivo ya fue evaluado por Calidad.
            </div>        
            <?php }?>
        </div>
    </div>
    <?php 
        $attributes = array('id' => 'form1');
        echo form_open('calidad/update_einduccion', $attributes);
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
                              <input type="text" class="form-control pull-right datepicker" name="fecha_evaluacion" value="<?=$nota[0]['fecha_evaluacion'];?>" disabled="disabled">
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
                              <input type="text" class="form-control pull-right datepicker" name="fecha_audio" value="<?=$nota[0]['fecha_audio'];?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Evaluador</label>
                                <?php
                                echo form_dropdown('evaluador',$evaluadores,$nota[0]['evaluador'],array('class' => 'form-control','id' => 'evaluador'));
                                ?>
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
                        <div class="col-md-3">
                          <div class="form-group">
                            <label>Fecha de Ingreso Laboral</label>        
                            <div class="input-group date">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <?php
                              $date = date_create($postulante[0]['fecha_ilaboral']);
                              $fecha_ingreso = date_format($date,"Y-m-d");
                              $hora_ingreso = date_format($date,"H:i");
                              ?>
                              <input type="text" class="form-control pull-right datepicker" name="fecha_ingreso" value="<?php echo $fecha_ingreso?>" style="background-color: #ffffcc;" required>
                            </div>
                            <!-- /.input group -->
                          </div>
                        </div>

                        <div class="col-md-3">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>Hora de la Entrevista:</label>        
                                  <div class="input-group">
                                    <input type="text" class="form-control timepicker" name="hora_ingreso" value="<?php echo $hora_ingreso;?>" style="background-color: #ffffcc;" required>     
                                    <div class="input-group-addon">
                                      <i class="fa fa-clock-o"></i>
                                    </div>
                                  </div>
                                  <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="bootstrap-timepicker">
                                <div class="form-group">
                                  <label>Ejecutivo Inducido:</label>        
                                    <select class="form-control" name="inducido" id="inducido" required>
                                      <option value="1">Si</option>
                                      <option value="0">No</option>
                                    </select>
                                  <!-- /.input group -->
                                </div>
                                <!-- /.form group -->
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
                <div class="box-header">
                  <h3 class="box-title">El resultado de su Evaluaci&oacute;n fue:</h3>
                </div>
                <div class="box-body">                    
                    <div class="form-group has-success">
                      <label class="control-label" for="inputWarning"></i> Nota Obtenida</label>
                      <input type="text" class="form-control" id="resultado" name="resultado" value="<?php echo $nota[0]['resultado_final']?>" readonly required/>
                    </div>
                    <div class="form-group has-success">
                      <label class="control-label" for="inputWarning"></i> Suma de Puntos</label>
                      <input type="text" class="form-control" id="resultado2" name="resultado2" value="" readonly required/>
                    </div>

                </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>

<?php 
      array_unshift($respondido_q,'');
      $contador = 0;
      foreach($evaluacion as $a){?>
       <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?= $a->evaluacion;?></h3>
                </div>
                <div class="box-body">
                    <input type="hidden" name="id_evaluacion<?=$contador?>" id="id_evaluacion<?php echo $a->id_evaluacion_induccion;?>" value="<?php echo $a->id_evaluacion_induccion;?>" />
                    <input type="hidden" name="peso_grupo" id="peso_grupo" value="<?= $a->peso;?>" /> 
                    <input type="hidden" style="width:100px;" class="form-control" name="item_sel<?=$a->id_evaluacion_induccion;?>" id="item_sel<?=$a->id_evaluacion_induccion;?>" value="" readonly/>    
                    
                    <table class="table table-condensed">
                    <tr>
                        <th>Item</th>
                        <th></th>
                        <th>Opcion</th>
                    </tr>                    
                    <?php 
                    foreach($evaluacion_items as $i){ 
                    ?>
                    <?php
                            if($i->id_evaluacion_induccion == $a->id_evaluacion_induccion){?>                            
                            <tr 
                            <?php 
                                if($i->tipo!='T'){
                                  if($i->correcto==1){
                                    echo 'bgcolor="#40bf40"';
                                  }
                                }  

                                $checked = 0;
                                $color = 0;
                                //pregunta correcta
                                if($respondido_q[$a->id_evaluacion_induccion]['id_evaluacion']==$a->id_evaluacion_induccion){
                                  //item de la pregunta  
                                  if($respondido_q[$a->id_evaluacion_induccion]['id_evaluacion_item']==$i->id_evaluacion_induccion_item){
                                         $checked = 'checked';
                                         $color = 'bgcolor="#ff6666"';
                                  } else {
                                     $checked = '';
                                     $color = '';
                                  }
                                }

                                echo $color;?> >
                              <?php if($i->tipo=='T'){?>

                              <td width="5%"><input type="radio" <?php if($respondido[$contador]['id_evaluacion_item']==$i->id_evaluacion_induccion_item){echo 'checked';}?> name="opcion<?=$a->id_evaluacion_induccion;?>" id="opcion" onclick="seleccionado('item_sel<?=$a->id_evaluacion_induccion;?>','<?= $i->id_evaluacion_induccion_item;?>');" value="<?php if($i->correcto==1){echo $a->peso;}else{echo '0';}?>" required>Si</td>
                              <td width="5%"><input type="radio" <?php if($respondido[$contador]['id_evaluacion_item']==$i->id_evaluacion_induccion_item){echo 'checked';}?> name="opcion<?=$a->id_evaluacion_induccion;?>" id="opcion" onclick="seleccionado('item_sel<?=$a->id_evaluacion_induccion;?>','<?= $i->id_evaluacion_induccion_item;?>');" value="0">No</td>
                              
                              <?php }else{?>

                              <td width="10%"><?php //echo $respondido[$a->id_evaluacion_induccion]['id_evaluacion'];?>
                                <input type="radio" disabled <?php echo $checked ?> name="opcion<?=$a->id_evaluacion_induccion;?>" id="opcion" onclick="seleccionado('item_sel<?=$a->id_evaluacion_induccion;?>','<?=$i->id_evaluacion_induccion_item;?>');" value="<?php if($i->correcto==1){echo $a->peso;}else{echo '0';}?>" required>
                              </td>

                              <?php }?>

                              <td width="10%">
                                <input type="hidden" style="width:100px;" class="form-control" name="correcto<?= $i->id_evaluacion_induccion_item;?>" id="correcto<?= $i->id_evaluacion_induccion_item;?>" value="<?= $i->correcto;?>" readonly/>
                                <input type="hidden" class="form-control" name="tipo<?= $i->id_evaluacion_induccion;?>" id="tipo<?= $i->id_evaluacion_induccion;?>" value="<?= $i->tipo;?>" />
                              </td>
                              <td width="80%">
                              <?php if($i->tipo=='T'){?>

                              <textarea class="form-control" name="observacion<?= $i->id_evaluacion_induccion;?>" row="5" id="observacion<?=$i->id_evaluacion_induccion;?>" required>&nbsp;<?php echo $respondido[$contador]['observacion'];?></textarea>
                              
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
      <?php 
      $contador = $contador + 1;
    } ?>


<div class="row">
  <div class="col-md-10"></div>
      <div class="col-md-2">
           <button type="submit" class="btn btn-info pull-right" <?=$bloquea;?>>Guardar</button>
      </div>
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
      showMeridian:false,
      showInputs: false
    });
});

$('#rut_audio').Rut({
  on_error: function(){ 
    $('#alerta_rut').fadeIn();
    $('.verificar').fadeOut();
    setTimeout(function(){
        $("#alerta_rut").fadeOut(4000);},5000);
    },
  format_on: 'keyup'
});



$(document).ready(function(){
    //$('#suma_de_puntos').hide();
    cargar_datos();
    setTimeout(function(){ $("#alertita").fadeOut(4000);}, 5000);

    //calculo de correctos
    var $inRadio = $("#form1").find("input[type='radio']");
    //var $inResultado = $("#form1").find("#resultado");
    var $inResultado = $("#form1").find("#resultado2");
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