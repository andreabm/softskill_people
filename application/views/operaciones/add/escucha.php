 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Escucha 
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
      <?php echo form_open('Operaciones/agregar_escucha');?>
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Escucha</h3>
              </div>
              <div class="box-body">
                <div class="row">

                    <div class="col-md-7">
                    <div class="form-group">
                        <input class="form-control" type="text" name="escucha" id="escucha" placeholder="Nueva Escucha">
                      </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info pull-right">Guardar</button>
                    </div>
                    <div class="col-md-7">
                    <div class="form-group">
                        <input class="form-control" type="text" name="ponderacion" id="ponderacion" placeholder="Ponderacion Escucha">
                      </div>
                    </div>

              </div>
          </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
      <?php echo form_close();?>


      </div>
    </section>