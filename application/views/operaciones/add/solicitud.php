 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Solicitudes
        <small> de Personal</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Nueva Solicitud</h3>
              </div>
              <?php
              echo form_open('Operaciones/agregar_solicitud');
              ?>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Area</label>
                        <?php
                        echo form_dropdown('area_id',$areas,'',array('class' => 'form-control','id' => 'select_area'));
                        ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Cartera</label>
                            <?php
                            echo form_dropdown('cartera_id',$carteras,'',array('class' => 'form-control', 'id' => 'select_cartera'));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tipo de Ejecutivo</label>
                            <?php
                            echo form_dropdown('cargo_id',$cargos,'',array('class' => 'form-control', 'id' => 'select_tipo_ejecutivo'));
                            ?>
                        </div>
                    </div>
              </div>
                  <div class="row">
                  <div class="col-md-4">
                            <div class="form-group">
                                <label>Cantidad</label>
                                <select class="form-control" style="width: 100%;" name="cantidad_solicitada">
                                  <option selected="selected">1</option>
                                  <option>2</option>
                                  <option>3</option>
                                  <option>4</option>
                                  <option>5</option>
                                  <option>6</option>
                                  <option>7</option>
                                </select>
                            </div>
                  </div>
                     <div class="col-md-4">
                            <div class="form-group">
                                <label>Prioridad</label>
                                <select class="form-control" style="width: 100%;" name="prioridad">
                                  <option selected="selected">1&deg;</option>
                                  <option>2&deg;</option>
                                  <option>3&deg;</option>
                                </select>
                            </div>
                  </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Fecha:</label>
        
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker" name="fecha" value="<?php echo date('d/m/'); echo "20".date('y'); ?>" disabled="disabled">
                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                          <label>Observacion</label>
                          <input type="text" class="form-control" placeholder="Observacion" name="observacion">
                        </div>
                    </div>
                  </div>
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
    </section>

</div>
<script>
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
<script>
$('#datepicker').datepicker({
      autoclose: true
    });
</script>