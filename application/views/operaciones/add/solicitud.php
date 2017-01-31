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
                        //array_unshift($areas,'--Seleccione--');
                        echo form_dropdown('area_id',$areas,'',array('class' => 'form-control','id' => 'select_area'));
                        ?>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Cartera</label>
                            <?php
                            //array_unshift($carteras,'--Seleccione--');
                            echo form_dropdown('cartera_id','--Seleccione--','',array('class' => 'form-control', 'id' => 'select_cartera'));
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
                                <select class="form-control" style="width: 100%;" name="cantidad_solicitada" id="cantidad_solicitada">
                                  <option selected="selected" value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="0">Otro</option>
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

                  <div class="row" id="ocantidad">
                  <div class="col-md-4">
                            <div class="form-group">
                                <label>Otra Cantidad</label>
                                  <input type="text" name="otra_cantidad" id="otra_cantidad" class="form-control">
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
                    
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Motivo</label>
                        <?php
                        echo form_dropdown('id_motivo',$motivo_solicitud,'',array('class' => 'form-control','id' => 'id_motivo'));
                        ?>
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

 $(document).ready(function() {
      cargar_carteras();
      $('#ocantidad').hide();
  }); 
//area
 $( "#select_area" ).change(function(){
    cargar_carteras(this.value);
});
//otro
$( "#cantidad_solicitada" ).change(function(){
    //alert(this.value);
    if(this.value==0){
        $('#ocantidad').fadeIn();
    }else{
        $('#otra_cantidad').val('');
        $('#ocantidad').fadeOut();
    }
});

function cargar_carteras(valor_area){
    var v_area = valor_area;
    //alert(v_area);
    $.ajax({
      url:"<?php echo base_url('/index.php/index/cargar_carteras')?>",
      type:'POST',
      data: {area:v_area},
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