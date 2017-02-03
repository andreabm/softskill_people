 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Motivos No Califica
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-9"></div>
        <form action="<?php echo base_url("/index.php/gestion/agregar_motivo"); ?>">
        <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-info" >Agregar Motivo</button>
        </div>
        </form>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Motivos no Califica</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Motivo No Califica</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                 <?php
                foreach ($motivos as $m) {
                    ?>
                    <tr>
                      <td><?php echo $m['id_motivo_no_califica'] ?></td>
                      <td><?php echo $m['motivo'] ?></td>
                      <td>
                          <div class="btn-group">
                            <a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/gestion/editar_motivo/'.$m['id_motivo_no_califica'])?>">Editar</a>
                          </div>                    
                      </td>
                    </tr>
                    <?php
                }
                ?>
        
                </tbody>
                <tfoot>
                <tr>
                  <th>Totales</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
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