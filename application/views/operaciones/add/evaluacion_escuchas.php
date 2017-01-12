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
/*
        echo '<pre>';
          print_r($nota);
        echo '</pre>';
        */

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
                        echo form_dropdown('area_id',$areas,$postulante[0]['id_area'],array('class' => 'form-control','id' => 'select_area'));
                        ?>
                      </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cartera</label>
                            <?php
                            echo form_dropdown('cartera_id',$carteras,$postulante[0]['id_cartera'],array('class' => 'form-control', 'id' => 'select_cartera'));
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
                              <input type="text" class="form-control pull-right datepicker"  name="fecha_evaluacion" value="<?=date('Y-m-d');?>" disabled="disabled">
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
                              <input type="text" class="form-control pull-right datepicker" name="fecha_audio" value="">
                            </div>
                            <!-- /.input group -->
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Evaluador</label>
                                <?php
                                echo form_dropdown('evaluador',$supervisores,'',array('class' => 'form-control','id' => 'evaluador'));
                                ?>
                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Rut del Audio</label>
                                <input class="form-control" type="rut_audio" name="rut_audio" id="rut_audio" value="" required>                           
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
                    foreach($aspectos_escuchas_items as $i){
                            if($i['id_aspecto_escucha'] == $a['id_aspecto']){?>                            
                            <tr>
                              <td>
                                <?=$i['item_aspecto'];?></td>
                              <td>
                                <input type="hidden" class="form-control" style="width:50px;" name="item_aspecto<?=$i['id_item_aspecto'];?>" id="item_aspecto<?=$i['id_item_aspecto'];?>" value="<?=$i['id_item_aspecto'];?>"  />
                                  <select name="cumple<?=$i['id_item_aspecto'];?>" id="cumple<?=$i['id_item_aspecto'];?>" class="form-control" onchange="test(this,'multiplicar<?=$i['id_item_aspecto'];?>','resultado_grupo<?=$i['id_item_aspecto'];?>','pondera<?=$i['id_item_aspecto'];?>','grupo<?=$a['id_aspecto'];?>','nparcial<?=$a['id_aspecto'];?>','ponderacion<?=$a['id_aspecto'];?>','ntotal<?=$a['id_aspecto'];?>'),suma();">
                                    <option value="">Seleccione</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                  </select>
                              </td>
                              <td>
                                <input type="hidden" name="multiplicar<?=$i['id_item_aspecto'];?>" id="multiplicar<?=$i['id_item_aspecto'];?>" value="<?=$i['multiplicar'];?>" style="width:50px;" readonly/>
                                <input type="hidden" name="pondera<?=$i['id_item_aspecto'];?>" id="pondera<?=$i['id_item_aspecto'];?>" value="<?=$i['ponderacion'];?>" style="width:50px;" readonly/>
                                <input type="hidden" id="resultado_grupo<?=$i['id_item_aspecto'];?>" name="resultado_grupo<?=$i['id_item_aspecto'];?>" value="0" style="width:60px;" class="form-control grupo<?=$a['id_aspecto'];?>" readonly/>
                                <input type="text" id="observacion<?=$i['id_item_aspecto'];?>" name="observacion<?=$i['id_item_aspecto'];?>" class="form-control"/>
                              </td>
                            </tr>                                
                           <?php  }
                         }?>
                             <tr>
                              <td>Nota Parcial</td>
                              <td></td>
                              <td>
                                  <input type="hidden" name="nparcial<?=$a['id_aspecto'];?>" id="nparcial<?=$a['id_aspecto'];?>" value="" readonly>
                                  <input type="text" name="ntotal<?=$a['id_aspecto'];?>" id="ntotal<?=$a['id_aspecto'];?>" class="form-control importe_linea" value="0" readonly>
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
                      <input type="text" id="total_general" name="total_general" class="form-control" readonly>
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
                      <textarea class="form-control" name="observacion_general" id="observacion_general" rows="3" ></textarea>
                    </div> 
                </div>
            </div>
        </div>
      </div>



<div class="row">
  <div class="col-md-10"></div>
      <div class="col-md-2">
           <button type="submit" class="btn btn-info pull-right">Guardar</button>
      </div>
 </div>

  <?php echo form_close();?>
</section> </div>

<script>
test();
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
  /*
  cantidad_total = 0;
  $("."+grupo).each(
    function(index, value) {
      cantidad_total = cantidad_total + eval($(this).val());
    }
  );
  valor_total = cantidad_total;
  $("#total_general").val(valor_total.toFixed(2));
  */
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
