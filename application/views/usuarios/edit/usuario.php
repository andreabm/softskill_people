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
                <?php echo form_open_multipart('usuarios/update_usuario');?>
                <div class="row">
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>Rut</label>
                        <input class="form-control" type="hidden" name="id_usuario" id="id_usuario" value="<?= $usuario[0]['id_usuario']?>" />
                        <input class="form-control" type="text" name="rut" id="rut" value="<?= $usuario[0]['rut']?>" />
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" value="<?= $usuario[0]['nombre']?>" />
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
                        <input class="form-control" type="hidden" name="contrasena" id="contrasena" value="<?=$usuario[0]['password'];?>" />
                        <input class="form-control" type="password" name="password" id="password" value="<?= $usuario[0]['password']?>" />
                        </div>
                    </div>
              </div>
              <div class="row">
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>Rango</label>
                        <input class="form-control" type="text" name="rango" id="rango" value="<?= $usuario[0]['rango']?>" />
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="text" name="mail" id="mail" value="<?= $usuario[0]['mail']?>"/>
                        </div>
                    </div>
                    <div class="col-md-3">  
                        <div class="form-group">
                        <label>Anexo</label>
                        <input class="form-control" type="text" name="anexo" id="anexo" value="<?= $usuario[0]['anexo']?>"/>
                        </div>
                    </div>
              </div>

              <div class="row">
                <div class="col-md-3">  
                  <div class="form-group">
                  <label>Avatar</label>
                  <img src="<?= $usuario[0]['img']?>" class="img-circle" alt="User Image"  style="height: 100px; margin:10px;">
                  <input type="file" name="archivo" id="archivo" value="<?=$usuario[0]['img'];?>" class="form-control" />
                  </div>
                </div>
              </div>

              <div class="row">
                <!--http://172.16.10.15/SoftSkills_People/assets/dist/img/avatar5.png-->
                <div class="col-md-12">
                  <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <li>
                      <img src="http://172.16.10.15/SoftSkills_People/assets/dist/img/avatar.png" alt="User Image"><br/>
                      <input type="radio" name="img" value="http://172.16.10.15/SoftSkills_People/assets/dist/img/avatar.png">
                      <span class="users-list-date">Usuario 1</span>
                    </li>
                    <li>
                      <img src="http://172.16.10.15/SoftSkills_People/assets/dist/img/avatar2.png" alt="User Image"><br/>
                      <input type="radio" name="img" value="http://172.16.10.15/SoftSkills_People/assets/dist/img/avatar2.png">
                      <span class="users-list-date">Usuario 2</span>
                    </li>
                    <li>
                      <img src="http://172.16.10.15/SoftSkills_People/assets/dist/img/avatar5.png" alt="User Image"><br/>
                      <input type="radio" name="img" value="http://172.16.10.15/SoftSkills_People/assets/dist/img/avatar5.png">
                      <span class="users-list-date">Usuario 3</span>
                    </li>
                    <li>
                      <img src="http://172.16.10.15/SoftSkills_People/assets/dist/img/avatar3.png" alt="User Image"><br/>
                      <input type="radio" name="img" value="http://172.16.10.15/SoftSkills_People/assets/dist/img/avatar3.png">
                      <span class="users-list-date">Usuario 4</span>
                    </li>
                  </ul>
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
             <?php echo form_close();?> 
          </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
    </div>
  </section>