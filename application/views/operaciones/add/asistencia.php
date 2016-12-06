 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Asistencia
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <?php
      echo form_open('Operaciones/pasar_asistencia');
      ?>
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Ejecutivos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="ejecutivo" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Cargo</th>
                  <th>Area</th>
                  <th>Cartera</th>
                  <th>Rut</th>
                  <th>Nombre</th>
                  <th>Fecha <?php echo date('d-m')?></th>
                  <td>Observación</td>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($contratados)) {
                    foreach($contratados as $p) {
                        ?>
                        <tr>
                          <td><?php echo $p['cargo'];
                          echo form_hidden('id_cargo['.$p['rut'].']',$p['id_cargo']);
                          ?></td>
                          <td><?php echo $p['area'];
                           echo form_hidden('area['.$p['rut'].']',$p['id_area']);?></td>
                          <td><?php echo $p['cartera'];
                           echo form_hidden('cartera['.$p['rut'].']',$p['id_cartera']); ?></td>
                          <td><?php echo $p['rut'];?></td>
                          <td><?php echo $p['nombre'] ?></td>
                          <td> <?php
                            echo form_dropdown('id_motivo_ausencia['.$p['rut'].']',$asistencia,'P',array('class' => 'form-control'));
                            ?></td>
                          <td><input type="text" class="form-control" placeholder="Observacion" name="observacion[<?php echo $p['rut'] ?>]"></td>
                          
                        </tr>
                        <?php
                    }
                }
                
                ?>
                </tbody>
                
              </table>
              <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-info pull-right">Guardar</button>
                </div>
                     
              </div>
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
            
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
 </div>
 <script>
$(document).ready(function(){
    $('#ejecutivo').DataTable({
       "language": {
                "url": '<?php echo base_url("/js/bootstrap-dataTables-Spanish.json") ?>',
                "decimal": ",",
                "thousands": "."
            },
    });
});
</script>