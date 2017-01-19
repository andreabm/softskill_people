 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Inducciones
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-9"></div>
        <form action="<?php echo base_url("/index.php/operaciones/agregar_inducciones"); ?>">
        <div class="col-md-3">
          <?php
                foreach ($promedio->result() as $row){
                  if($row->promedio >= 7){
                    $disabled = 'disabled title="Lo siento el promedio ya que se ha cumplido"';
                  }
              }?>
            <button type="submit" class="btn btn-block btn-info" <?php echo $disabled;?>>Agregar Pregunta</button>
        </div>
        </form>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Inducciones</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Competencia</th>
                  <th>Peso</th>
                  <th>Cargo</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                foreach($inducciones as $c) {
                    ?>
                    <tr>
                      <td><?php echo $c->id_evaluacion_induccion?></td>
                      <td><?php echo $c->evaluacion?></td>
                      <td><?php echo $c->peso?></td>
                      <td><?php echo $c->activo?></td>
                      <td>
                           <!--<a class="btn btn-xs btn-success">Ver</a>-->
                           <a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/operaciones/editar_inducciones/'.$c->id_evaluacion_induccion)?>">Editar</a>
      
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