 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Turnos 
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
    <?php
      echo form_open('Gestion/agregar_turno');
      ?>
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Turnos</h3>
              </div>
              <div class="box-body">
                <div class="row">

                    <div class="col-md-5">
                    <div class="form-group">
                        <input class="form-control" type="text" name="turno" id="turno" placeholder="Nuevo Turno">
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