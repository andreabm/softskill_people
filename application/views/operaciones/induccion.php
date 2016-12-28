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
    <br />
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Evaluacion General Escuchas Ejecutivos</h3>
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
                            <?php
                            echo form_dropdown('select_cartera','','',array('class' => 'form-control', 'id' => 'select_cartera'));
                            ?>
                          </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Cartera</label>
                                <input class="form-control" type="text" name="cartera" id="cartera">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>&Aacute;rea</label>
                                <input class="form-control" type="text" name="area" id="area">                           
                            </div>
                        </div>
                    </div>
                  <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Supervisor</label>
                                <input class="form-control" type="supervisor" name="supervisor" id="supervisor" >                           
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
      foreach($evaluacion as $a){ ?>
       <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title"><?= $a->evaluacion;?></h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed">
                    <tr>
                        <th>Item</th>
                        <th>Opcion</th>
                    </tr>
                    <?php foreach($evaluacion_items as $i){
                            if($i->id_evaluacion_induccion == $a->id_evaluacion_induccion){ ?>                            
                            <tr>
                              <td width="10%"><input type="radio" name="opcion" id="opcion"></td>
                              <td width="90%"><?= $i->opcion;?></td>
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
                      <label class="control-label" for="inputWarning"></i> Promedio Evaluacion</label>
                      <input type="text" class="form-control" id="inputWarning"/>
                    </div>    
                    <div class="form-group has-warning">
                      <label class="control-label" for="inputWarning"></i> Promedio Evaluacion Sin Faltas Graves</label>
                      <input type="text" class="form-control" id="inputWarning"/>
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
$( document ).ready(function() {
    cargar_datos();
});
 $( "#rut" ).change(function() {
    cargar_datos();
});
function cargar_datos(){
    //alert($('#cartera').val());
    $.ajax({
      url:"<?php echo base_url('/index.php/operaciones/escuchas_cargar_datos')?>",
      type:'POST',
      data: {rut:$('#rut').val()},
      success: function(data) {
        data = JSON.parse(data);
        console.debug(data);
        $('#nombre').val(data.datos[0].nombre);
        $('#cartera').val(data.datos[0].cartera);
        $('#area').val(data.datos[0].area);
        $('#supervisor').val(data.datos[0].nombre_supervisor);
        
      },
      error: function(e) {
        console.debug('error');
      }
   });
}
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
      options_p = "<option selected>Seleccione area</option>";
        data = JSON.parse(data);
        $.each(data.postulante,function(i,v){
             options_p +="<option value='"+v.nombre+"'>"+v.nombre+"</option>";
            
        });
        $("#select_cartera").html(options_p);
      },
      error: function(e) {
        console.debug('error');
      }
   }); 
}
</script>