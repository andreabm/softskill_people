 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Competencias
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-9"></div>
        <form action="<?php echo base_url("/index.php/gestion/agregar_competencia"); ?>">
        <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-info" >Agregar Competencia</button>
        </div>
        </form>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Competencias</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Competencia</th>
                  <th>Peso</th>
                  <th>Ponderaci&oacute;n</th>
                  <th>Cargo</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                foreach($competencias as $c) {
                    ?>
                    <tr>
                      <td><?php echo $c['id_competencia']?></td>
                      <td><?php echo $c['competencia']?></td>
                      <td><?php echo $c['peso']?></td>
                      <td><?php echo $c['ponderacion']?>%</td>
                      <td><?php echo $c['cargo']?></td>
                      <td>
                            <a class="btn btn-xs btn-success">Ver</a>
                            <a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/gestion/editar_competencia/'.$c['id_competencia'])?>">Editar</a>
      
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