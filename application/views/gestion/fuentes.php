 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fuentes 
        <small> de Empleo</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-9"></div>
        <form action="<?php echo base_url("/index.php/gestion/agregar_fuente"); ?>">
        <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-info" >Agregar Fuente</button>
        </div>
        </form>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Fuentes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Fuente</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                foreach ($fuentes as $f) {
                    ?>
                    <tr>
                      <td><?php echo $f['id_fuente'] ?></td>
                      <td><?php echo $f['fuente'] ?></td>
                      <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-warning" >Editar</button>
                          </div>                    
                      </td>
                    </tr>
                    <?php
                }
                ?>
                    
                </tbody>
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