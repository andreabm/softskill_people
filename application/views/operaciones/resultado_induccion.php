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
                            <input class="form-control" type="text" name="nombre" id="nombre"/>
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apellido Paterno</label>
                                <input class="form-control" type="text" name="paterno" id="paterno"/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Apellido Materno</label>
                                <input class="form-control" type="text" name="materno" id="materno"/>                           
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
                              <input type="text" class="form-control pull-right" class="" name="fecha_evaluacion" value="<?php echo date('d-m-Y') ?>" disabled="disabled">
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
                              <input type="text" class="form-control pull-right" class="datepicker" name="fecha_audio" value="<?php echo date('d-m-Y') ?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Evaluador</label>
                                <input class="form-control" type="evaluador" name="evaluador" id="evaluador">                           
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Rut del Audio</label>
                                <input class="form-control" type="rut_audio" name="rut_audio" id="rut_audio">                           
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
                  <h3 class="box-title"><?= $a->evaluacion;?></h3>
                </div>
                <div class="box-body">
                    
                    <input type="hidden" name="peso_grupo" id="peso_grupo" value="<?= $a->peso;?>" /> 

                    <table class="table table-condensed">
                    <tr>
                        <th>Item</th>
                        <th></th>
                        <th>Opcion</th>
                    </tr>
                    <?php
                    foreach($evaluacion_items as $i){
                            if($i->id_evaluacion_induccion == $a->id_evaluacion_induccion){ ?>                            
                            <tr>
                              <td width="10%"><input type="radio" name="opcion<?=$a->id_evaluacion_induccion;?>" id="opcion" value="<?php if($i->correcto==1){echo $a->peso;}else{echo '0';}?>"></td>
                              <td width="10%"><input type="hidden" class="form-control" name="correcto<?= $i->id_evaluacion_induccion_item;?>" id="correcto<?= $i->id_evaluacion_induccion_item;?>" value="<?= $i->correcto;?>" readonly/></td>
                              <td width="80%"><?= $i->opcion;?></td>
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
                      <input type="text" class="form-control" id="resultado" name="resultado" />
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
                      <textarea class="form-control" rows="3" ></textarea>
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
</script>


<script>
$(document).ready(function() {
    cargar_datos();

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
});

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
        });
        $("#nombre").val(p_nombre);
        $("#paterno").val(p_paterno);
        $("#materno").val(p_materno);
      },
      error: function(e) {
        console.debug('error');
      }
   });
}
 $( "#select_area" ).change(function() {
    //alert($('#producto').val());
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