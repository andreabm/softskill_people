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
    <br />
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Inducci&oacute;n</h3>
              </div>
              <div class="box-body">
                <div class="row">
                  <?php echo form_open('operaciones/guardar_induccion');?>
                    <div class="col-md-7">
                    <div class="form-group">
                        <input class="form-control" type="text" name="evaluacion" id="evaluacion" placeholder="Nueva Inducción" required>
                      </div>
                    </div>
                    
                    <div class="col-md-7">
                    <div class="form-group">
                        <input class="form-control" type="text" name="peso" id="peso" placeholder="Peso Inducción" required>
                      </div>
                    </div>

                    <div class="clearfix"></div>

                    
                    <div class="col-md-4">
                        <select name="activo" id="activo" class="form-control pull-left">
                          <option value="1">Activo</option>
                          <option value="0">Inactivo</option>
                        </select>
                    </div>                    
                    <div class="col-md-2 pull-left">
                        <button type="submit" class="btn btn-info pull-left">Guardar</button>
                    </div>
                    
                    <?php echo form_close();?>

              </div>
          </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>



      </div>
    </section>