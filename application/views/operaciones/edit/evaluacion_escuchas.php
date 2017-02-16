 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Evaluci&oacute;n
        <small> de Operaciones Serbanc </small>
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
    <script type="text/javascript">
      $(document).ready(function(){
          $("form").keypress(function(e) {
              if (e.which == 13) {
                  return false;
              }
          });
      });
    </script>
    <?php 
        $attributes = array('id' => 'form1');
        echo form_open('', $attributes);
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
                        echo form_dropdown('area_id',$areas,$respondido_r[0]['id_area'],array('class' => 'form-control','id' => 'select_area','disabled'=>'disabled'));
                        ?>
                      </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cartera</label>
                            <?php
                            echo form_dropdown('cartera_id',$carteras,$respondido_r[0]['id_cartera'],array('class' => 'form-control', 'id' => 'select_cartera','disabled'=>'disabled'));
                            ?>
                        </div>
                    </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Supervisor</label>
                                <?php
                                echo form_dropdown('supervisor',$supervisores,$respondido_r[0]['id_supervisor'],array('class' => 'form-control','id' => 'supervisor','disabled'=>'disabled'));
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
                              <input type="text" class="form-control pull-right" class="datepicker" name="fecha_evaluacion" value="<?php echo $respondido_r[0]['fecha_evaluacion'];?>" disables readonly>
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
                              <input type="text" class="form-control pull-right" class="datepicker" name="fecha_audio" value="<?=$respondido_r[0]['fecha_audio'];?>" disables readonly>
                            </div>
                            <!-- /.input group -->
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Evaluador</label>
                                <?php
                                echo form_dropdown('evaluador',$supervisores,$respondido_r[0]['evaluador'],array('class' => 'form-control','id' => 'evaluador','disabled' => 'disabled'));
                                ?>
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Rut del Audio</label>
                                <input class="form-control" type="rut_audio" name="rut_audio" id="rut_audio" value="<?php echo $respondido_r[0]['rut_audio'];?>" autocomplete="off" onkeyup="texto_rut(event);" readonly>                           
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cargo a Postular</label>
                                <input class="form-control" type="text" name="cargo" id="cargo" value="<?php echo $cargo[0]['cargo'];?>" disables readonly>
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
    foreach($aspectos_escuchas as $a){ ?>
       <div class="row">
        <div class="col-xs-12">
          
          <input type="hidden" name="id_aspecto<?=$a['id_aspecto'];?>" id="id_aspecto<?=$a['id_aspecto'];?>" value="<?=$a['id_aspecto'];?>" style="width:70px;" readonly/>
          <input type="hidden" name="ponderacion<?=$a['id_aspecto'];?>" id="ponderacion<?=$a['id_aspecto'];?>" value="<?=$a['ponderacion'];?>" style="width:70px;" readonly/>

            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?= $a['aspecto'].'&nbsp;&nbsp;&nbsp;'. round($a['ponderacion']) ?>%</h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed">
                    <tr>
                        <th width="50%">Item</th>
                        <th width="10%">Cumple</th>
                        <th width="40%">Observacion</th>
                    </tr>
                    <?php 
                    $color = "";
                                       
                    foreach($aspectos_escuchas_items as $i){

                            if($i['id_aspecto_escucha'] == $a['id_aspecto']){?>
                            <?php 
                                  if($respondido_q[$i['id_item_aspecto']]['id_aspecto_items']==$i['id_item_aspecto']){

                                      if($respondido_q[$i['id_item_aspecto']]['respondido']=='1'){
                                          $checked_si = 'selected';
                                          $checked_no = '';
                                          $color = '';
                                      }elseif($respondido_q[$i['id_item_aspecto']]['respondido']=='0'){
                                        $checked_no = 'selected';
                                        $checked_si = '';
                                        $color = 'bgcolor="#ff6666"';
                                      }else{
                                        $checked_si = '';
                                        $checked_no = '';
                                      }

                                      $nota = $respondido_q[$i['id_item_aspecto']]['nota_grupo'];                                      
                                      //observacion, $respondido_q[$i['id_item_aspecto']]['observacion']
                                  }?>                        
                            <tr <?=$color;?>>
                              <td>
                                <?php echo $i['item_aspecto'];?>
                                
                              </td>
                              <td>
                                <input type="hidden" class="form-control" style="width:50px;" name="item_aspecto<?=$i['id_item_aspecto'];?>" id="item_aspecto<?=$i['id_item_aspecto'];?>" value="<?=$i['id_item_aspecto'];?>"  />
                                  <select name="cumple<?=$i['id_item_aspecto'];?>" id="cumple<?=$i['id_item_aspecto'];?>" class="form-control" onchange="test(this,'multiplicar<?=$i['id_item_aspecto'];?>','resultado_grupo<?=$i['id_item_aspecto'];?>','pondera<?=$i['id_item_aspecto'];?>','grupo<?=$a['id_aspecto'];?>','nparcial<?=$a['id_aspecto'];?>','ponderacion<?=$a['id_aspecto'];?>','ntotal<?=$a['id_aspecto'];?>'),suma();" disabled>
                                    <option value="">Seleccione</option>
                                    <option value="1" <?php echo $checked_si;?>>SI</option>
                                    <option value="0" <?php echo $checked_no;?>>NO</option>
                                  </select>
                                  <?php // $respondido_q[$i['id_item_aspecto']]['respondido'];?>
                              </td>
                              <td>
                                <input type="hidden" name="multiplicar<?=$i['id_item_aspecto'];?>" id="multiplicar<?=$i['id_item_aspecto'];?>" value="<?=$i['multiplicar'];?>" style="width:50px;" readonly/>
                                <input type="hidden" name="pondera<?=$i['id_item_aspecto'];?>" id="pondera<?=$i['id_item_aspecto'];?>" value="<?=$i['ponderacion'];?>" style="width:50px;" readonly/>
                                <input type="hidden" id="resultado_grupo<?=$i['id_item_aspecto'];?>" name="resultado_grupo<?=$i['id_item_aspecto'];?>" value="0" style="width:60px;" class="form-control grupo<?=$a['id_aspecto'];?>" readonly/>
                                <input type="text" id="observacion<?=$i['id_item_aspecto'];?>" name="observacion<?=$i['id_item_aspecto'];?>" class="form-control" value="<?=$respondido_q[$i['id_item_aspecto']]['observacion']?>" disabled/>
                              </td>
                            </tr>                                
                           <?php  }?>
                         <?php }?>
                         <tr>
                              <td></td>
                              <td></td>
                              <td>
                                  <input type="hidden" name="nparcial<?=$a['id_aspecto'];?>" id="nparcial<?=$a['id_aspecto'];?>" value="" readonly>
                                  <input type="hidden" name="ntotal<?=$a['id_aspecto'];?>" id="ntotal<?=$a['id_aspecto'];?>" class="form-control importe_linea" value="" readonly>
                              </td>
                            </tr>
                         
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
            <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">TOTAL EVALUACI&Oacute;N</h3>
                </div>
                <div class="box-body">
                     <div class="form-group has-error">
                      <input type="text" id="total_general" name="total_general" class="form-control" value="<?php echo $respondido_r[0]['resultado_final_operaciones'];?>" readonly>
                    </div> 
                </div>
            </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">OBSERVACIONES GENERALES</h3>
                </div>
                <div class="box-body">
                     <div class="form-group has-error">
                      <textarea class="form-control" name="observacion_general" id="observacion_general" rows="3"><?php echo $respondido_r[0]['observacion_general'];?></textarea>
                    </div> 
                </div>
            </div>
        </div>
      </div>



<div class="row">
  <div class="col-md-10"></div>
      <div class="col-md-1 pull-right">
           <button type="submit" class="btn btn-info" disabled>Guardar</button>           
      </div>
      <div class="col-md-1 pull-right">
           <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo base_url('index.php/operaciones/escuchas_ejecutivos');?>'">Volver</button>           
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

function test(sel,multiplicar,resultado_grupo,pondera,grupo,nparcial,ponderacion,ntotal) {
    var sel = sel.value; 
    var multi = document.getElementById(multiplicar).value;
    var ponde = document.getElementById(pondera).value;
    var val_ponderacion = document.getElementById(ponderacion).value;
    var modificable = 1;

    if(sel==1){
       $('#'+multiplicar).val(1);
       modificable = 1;
    }else{
      $('#'+multiplicar).val(0);
      modificable = 0;
    }
    calcula_simple(modificable,ponde,resultado_grupo,grupo,nparcial,val_ponderacion,ntotal);
}
function calcula_simple(modi,pondera,resultado_grupo,grupo,nparcial,val_ponderacion,ntotal){
  valor_aprobacion = modi*pondera;
  $("#"+resultado_grupo).val(valor_aprobacion.toFixed(1));
  calcula_grupo(grupo,nparcial,val_ponderacion,ntotal);
}
function calcula_grupo(grupo,nparcial,val_ponderacion,ntotal){
  cantidad = 0;
  $("."+grupo).each(
    function(index, value) {
      cantidad = cantidad + eval($(this).val());
    }
  );
  valor = cantidad/100*7;
  $("#"+nparcial).val(valor.toFixed(2));
  valor_test = val_ponderacion*valor;
  $('#'+ntotal).val(valor_test.toFixed(1));
  suma_total();
  }

  function suma_total(){
      importe_total = 0
      $(".importe_linea").each(
        function(index, value) {
          importe_total = importe_total + eval($(this).val());
        }
      );
      valor_test = importe_total/100;
      $("#total_general").val(valor_test.toFixed(1));
  }
</script>
