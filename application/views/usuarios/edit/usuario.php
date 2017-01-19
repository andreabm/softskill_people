 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Usuario 
        <small> del sistema</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Usuario</h3>
              </div>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>Rut</label>
                        <input class="form-control" type="text" name="usuario" id="usuario" value="<?= $usuario[0]['rut']?>" />
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" name="usuario" id="usuario" value="<?= $usuario[0]['nombre']?>" />
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>Usuario</label>
                        <input class="form-control" type="text" name="usuario" id="usuario" value="<?= $usuario[0]['usuario']?>" />
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="text" name="usuario" id="usuario" value="<?= $usuario[0]['password']?>" />
                        </div>
                    </div>
              </div>
              <div class="row">
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>Rango</label>
                        <input class="form-control" type="text" name="usuario" id="usuario" value="<?= $usuario[0]['rango']?>" />
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" name="usuario" id="usuario" value="<?= $usuario[0]['mail']?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>Avatar</label>
                        <input class="form-control" type="text" name="usuario" id="usuario" />
                        </div>
                    </div>
              </div>
              <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info pull-right">Guardar</button>
                    </div>
                         
                  </div>
              <br>
          </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
    </div>
  </section>