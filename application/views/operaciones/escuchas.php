 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escuchas
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-9"></div>
        <form action="<?php echo base_url("/index.php/operaciones/agregar_escucha"); ?>">
        <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-info" >Agregar Escuchas</button>
        </div>
        </form>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Escuchas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Aspecto</th>
                  <th>Ponderaci&oacute;n</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                $tot = 0;
                foreach($escuchas as $c) {
                    ?>
                    <tr>
                      <td><?php echo $c['id_aspecto']?></td>
                      <td><?php echo $c['aspecto']?></td>
                      <td><?php echo $c['ponderacion']?>%</td>
                      <td>
                         <!--<a class="btn btn-xs btn-success">Ver</a>-->
                         <a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/operaciones/editar_escucha/'.$c['id_aspecto'])?>">Editar</a>      
                      </td>
                    </tr>
                    <?php
                    $tot = $tot + $c['ponderacion'];
                }?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Totales</th>
                  <th></th>
                  <th><?=$tot?> %</th>
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