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
                            <td><?php echo $t['nombre'] ?></td>
                            <td align="center"><?php echo $t['resultado_final'];?></td>
                            <td>
                              <a class="btn btn-xs btn-success" href="<?php echo base_url('index.php/operaciones/evaluacion_escuchas/'.$t['id_postulante'])?>">Evaluar</a>
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

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

</div>

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
</script>