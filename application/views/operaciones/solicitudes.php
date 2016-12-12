 <div class="content-wrapper">
 
    <div class="row">
        <div class="col-xs-8">
        
<?php 
            if(!empty($msje_solicitud)){
            ?>
            <div id="alertita" class="alert alert-<?php if($msje_solicitud[0]==1){echo 'success';}else{echo 'danger';}?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?php if($msje_solicitud[0]==1){echo 'Exito';}else{echo 'Fracaso';}?></strong> <?php if($msje_solicitud[0]==1){echo 'La solicitud se ha modificado con exito';}else{echo 'La solicitud no se ha modificado';}?>
            </div>        
            <?php }?>
        
    </div>
    </div>
 
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Solicitudes
        <small> de Personal</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-9"></div>
        <form action="<?php echo base_url("/index.php/operaciones/agregar_solicitud"); ?>">
        <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-info" >Agregar Solicitud</button>
        </div>
        </form>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Personal Faltante</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="solicitudes" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Area</th>
                  <th>Cartera</th>
                  <th>Cargo</th>
                  <th>Cantidad Solicitada</th>
                  <th>Cantidad Entregada</th>
                  <th>Prioridad</th>
                  <th>Observacion</th>
                  <th>Opciones</th> <!-- Mostrar solo si es coordinador operativo -->
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($solicitudes)) {
                    foreach ($solicitudes as $s) {?>
                        <tr>
                            <td><?php echo $s['area']?></td>
                            <td><?php echo $s['cartera'] ?></td>
                            <td><?php echo $s['cargo'] ?></td>
                            <td><?php echo $s['cantidad_solicitada'] ?></td>
                            <?php if (empty($s['cantidad_entregada'])) {
                                $s['cantidad_entregada'] = 0;
                            }?>
                            <td><?php echo $s['cantidad_entregada']?></td>
                            <td><?php echo $s['prioridad']?></td>
                            <td><?php echo $s['observacion']?></td>
                            <td><a class="btn btn-xs btn-success" href="#" data-toggle="modal" data-target="#validarSolicitud" onclick = "validarSolicitud(<?php echo $s['id_solicitud'];  ?>)">Validar</a></td>
                        </tr>
                    <?php }
                }
                ?>
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
<div class="modal modal-success fade" id="validarSolicitud">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Validar Solicitud</h4>
              </div>
      <?php echo form_open('Operaciones/solicitud_validada');?>        
      <div class="modal-body" id="validarSolicitudBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-outline">Validar</button>
        
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
$(document).ready(function(){
    $('#solicitudes').DataTable({
       "language": {
                "url": '<?php echo base_url("/js/bootstrap-dataTables-Spanish.json") ?>',
                "decimal": ",",
                "thousands": "."
            },
    });
});
function validarSolicitud(id_solicitud){
    $.ajax({
          url:"<?php echo base_url('index.php/operaciones/validar_solicitud')?>",
          type: 'POST',
          data: {id_solicitud:id_solicitud},
          success: function(data) {
          $('#validarSolicitudBody').html(data);
          },
          error: function(e) {
            $('#validarSolicitudBody').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
          }
    });
}
</script>