 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Ejecutivos
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-9"></div>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Ejecutivos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="ejecutivos" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Area</th>
                  <th>Cartera</th>
                  <th>Cargo</th>
                  <th>RUT</th>
                  <th>Nombre</th>
                  <th>Nota Calificaci&oacute;n</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($ejecutivos)){
                        foreach($ejecutivos as $t){?>
                        <tr>
                            <td><?php echo $t['area'] ?></td>
                            <td><?php echo $t['cartera'] ?></td>
                            <td><?php echo $t['tipo_ejecutivo'] ?></td>
                            <td><?php echo $t['rut'] ?></td>
                            <td><?php echo $t['nombre'].' '.$t['paterno'] ?></td>
                            <td><?php echo $t['resultado_final'] ?></td>
                            <td>
                            <!--<a class="btn btn-xs btn-warning" href="<?php //echo base_url('/index.php/operaciones/documentacion/'.$t['id_postulante']);?>">Documentos</a>-->
                            <a class="btn btn-xs btn-danger" href="#" data-toggle="modal" data-target="#moverEjecutivo" onclick = "moverEjecutivo(<?php echo $t['id_postulante'];  ?>)">Mover</a>
                            <a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target="#verPostulante" onclick = "verPostulante(<?php echo $t['id_postulante'];  ?>)">Ver</a>
                            <!--<a class="btn btn-xs btn-warning" href="<?php //echo base_url('index.php/operaciones/ficha_contratacion/'.$t['id_postulante'])?>">Ficha </a>-->
                            </td>
                    </tr>  
                  <?php }
                } ?>                    
                </tbody>
                <tfoot>
               
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

</div>
<!--MODAL VER EJECUTIVO-->
<div class="modal modal-success fade" id="verPostulante">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Postulante</h4>
              </div>
      <div class="modal-body" id="verPostulanteBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
     
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--MODAL VER EJECUTIVO FIN-->
<!--MODAL MOVER EJECUTIVO-->
<div class="modal modal-success fade" id="moverEjecutivo">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <?php echo form_open('gestion/update_ejecutivo_mover');?>
      <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Postulante</h4>
              </div>
      <div class="modal-body" id="moverEjecutivoBody"></div>
      <div class="modal-body" style="color:#333;">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label>Supervisor</label>
                    <span id="id_supervisor"></span>
                    <span id="supervisor"></span>
                    <input type="text" class="form-control" name="supervisor_falso" id="supervisor_falso" readonly/>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <label>Fecha de Presentaci&oacute;n</label>
  
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker" name="fecha_presentacion">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-4">
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Hora de Presentaci&oacute;n:</label>        
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="hora_presentacion">        
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
            </div>

        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>         
          <button type="submit" class="btn btn-outline" id="asignar">Asignar</button>    
      </div>
      <?php echo form_close();?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!--MODAL MOVER EJECUTIVO FIN-->


<script>
$(document).ready(function(){ 
  $('.datepicker').datepicker({
          starDate: 'today',
          language: "es",
          format: 'yyyy-mm-dd',
          autoclose: true
  });
  $(".timepicker").timepicker({
      showMeridian:false,
                    showInputs: false
  });
});
$(document).ready(function(){
    $('#ejecutivos').DataTable({
        "lengthMenu": [[25, 50, -1], [10, 25, 50, "All"]],
       "language": {
                "url": '<?php echo base_url("/js/bootstrap-dataTables-Spanish.json") ?>',
                "decimal": ",",
                "thousands": "."
            },
    });
});
function verPostulante(id_postulante){
    $.ajax({
          url:"<?php echo base_url('index.php/operaciones/ver_ejecutivo')?>",
          type: 'POST',
          data: {id_postulante:id_postulante},
          success: function(data) {
          $('#verPostulanteBody').html(data);
          },
          error: function(e) {
            $('#verPostulanteBody').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
          }
    });
}
function moverEjecutivo(id_postulante){
    $.ajax({
          url:"<?php echo base_url('index.php/gestion/mover_ejecutivo')?>",
          type: 'POST',
          data: {id_postulante:id_postulante},
          success: function(data) {
          $('#moverEjecutivoBody').html(data);
          },
          error: function(e) {
            $('#moverEjecutivoBody').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
          }
    });
}
</script>