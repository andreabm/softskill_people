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
      echo form_open('Operaciones/ver_asistencia');
      ?>
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Ejecutivos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Area</label>
                        <?php
                        echo form_dropdown('area_id',$areas,$id_area,array('class' => 'form-control','id' => 'select_area'));
                        ?>
                      </div>
                    </div>  
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Cartera</label>
                        <?php
                        echo form_dropdown('cartera_id',$carteras,$id_cartera,array('class' => 'form-control','id' => 'select_area'));
                        ?>
                      </div>
                    </div>  
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Desde</label>
                        <?php
                        echo form_input('fecha_desde',$desde,array('class' => 'form-control datepicker'));
                        ?>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Hasta</label>
                        <?php
                        echo form_input('fecha_hasta',$hasta,array('class' => 'form-control datepicker'));
                        ?>
                      </div>
                    </div>
                    <div class="col-md-2" style="margin-top: 25px;">
                         <div class="form-group">
                            <button type="submit" class="btn btn-info">Buscar</button>
                         </div>
                    </div>
                </div>
                <br /><br />
              <table id="ejecutivo" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Cargo</th>
                  <th>Area</th>
                  <th>Cartera</th>
                  <th>Rut</th>
                  <th>Nombre</th>
                  <th>Fecha</th>
                  <th>Asistencia</th>
                  <td>Observación</td>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($contratados)) {
                    foreach($contratados as $p) {
                        ?>
                        <tr>
                          <td><?php echo $p['cargo'];?></td>
                          <td><?php echo $p['area'];?></td>
                          <td><?php echo $p['cartera'];?></td>
                          <td><?php echo $p['rut'];?></td>
                          <td><?php echo $p['nombre']; ?></td>
                          <td> <?php echo $p['fecha']; ?></td>
                          <td><?php echo $asistencia[$p['asistencia_supervisor']]; ?></td>
                          <td><?php echo $p['ultima_observacion_asistencia'] ?></td>
                          
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