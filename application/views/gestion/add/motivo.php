 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Motivo No Califica 
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
    <?php
      echo form_open('Gestion/agregar_motivo');
      ?>
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Motivo No Califica</h3>
              </div>
              <div class="box-body">
                <div class="row">

                    <div class="col-md-5">
                    <div class="form-group">
                        <input class="form-control" type="text" name="motivo" id="motivo" placeholder="Nuevo Motivo No Califica">
                      </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info pull-right">Guardar</button>
                    </div>

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