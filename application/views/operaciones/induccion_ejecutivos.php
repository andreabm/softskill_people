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
        <div class="col-xs-12">        
        <?php 
        $msje_solicitud = $this->session->flashdata('msje_evaluacion');
            if(!empty($msje_solicitud)){
            ?>
            <div id="alertita" class="alert alert-<?php if($msje_solicitud[0]==1){echo 'success';}else{echo 'danger';}?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?php if($msje_solicitud[0]==1){echo 'Exito';}else{echo 'Fracaso';}?></strong> <?php if($msje_solicitud[0]==1){echo 'Se ha evaluado con exito';}else{echo 'La solicitud no se ha modificado';}?>
            </div>        
            <?php }?>
        </div>
    </div>

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
                            <td align="center"><?php echo $t['resultado_final'];?></td>
                            <td>
                              
                              
                              <?php if(isset($t['resultado_final'])){
                                $activo_a = 'href="'.base_url('index.php/operaciones/evaluacion_induccion_calidad/'.$t['id_postulante']).'"';
                                $activo_b = 'disabled href="#"';

                              }else{
                                $activo_a = 'disabled href="#"';
                                $activo_b = 'href="'.base_url('index.php/operaciones/evaluacion_induccion/'.$t['id_postulante']).'"';
                              }?>
                              <a class="btn btn-xs btn-success" <?=$activo_a?>>Ev. de Inducci&oacute;n Calidad</a>
                              <a class="btn btn-xs btn-info" <?=$activo_b?> >Ev. de Inducci&oacute;n Ejecutivo</a>
                              

                            </td>
                    </tr>  
                  <?php }
                }?>                    
                </tbody>
                <tfoot>
               
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
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
</div><!-- /.modal -->
<script>
$(document).ready(function(){
    $('#ejecutivos').DataTable({
       "language": {
                "url": '<?php echo base_url("/js/bootstrap-dataTables-Spanish.json") ?>',
                "decimal": ",",
                "thousands": "."
            },
    });
});
</script>