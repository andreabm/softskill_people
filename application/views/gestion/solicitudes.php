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
                  <th>Cant. Solicitada</th>
                  <th>Cant. Aprobada</th>
                  <th>Cant. Entregada</th>
                  <th>Cant. Restante</th>
                  <th>Prioridad</th>
                  <th>Observacion</th>
                  <!-- <th>Opciones</th> -->
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($solicitudes)) {
                    foreach ($solicitudes as $s) {?>
                        <tr>
                            <td><?php echo $s['area'] ?></td>
                            <td><?php echo $s['cartera'] ?></td>
                            <td><?= $s['cargo'] ?></td>
                            <td><?= $s['cantidad_solicitada'] ?></td>
                            <?php if (empty($s['cantidad_entregada'])) {
                                $s['cantidad_entregada'] = 0;
                            }?></td>
                            <td><?= $s['cantidad_aprobada']?></td>
                            <td><?= $s['cantidad_entregada']?></td>
                            <td><?php echo $s['cantidad_aprobada']-$s['cantidad_entregada']?></td>
                            <td><?= $s['prioridad']?></td>
                            <td><?= $s['observacion']?></td>
                            <!--<td>
                              <a class="btn btn-xs btn-success">Ver</a>
                              <a class="btn btn-xs btn-warning" href="#">Editar</a>                 
                          </td> -->
                        </tr>
                  <?php  }
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
</script>