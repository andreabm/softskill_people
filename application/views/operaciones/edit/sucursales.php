 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sucursal 
        <small> de Empleo</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
    <script type="text/javascript">
$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});
    </script>
    <?php
  echo form_open('Operaciones/editar_sucursal');
  ?>
  <div class="row">
    <div class="col-xs-8">
        <div class="alert alert-danger alert-dismissible" id="alerta" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Atenci&oacute;n!</strong> El Rut ya se encuentra ingresado anteriormente.
        </div>
    </div><br />
    <div class="col-xs-8">
        <div class="alert alert-danger alert-dismissible" id="alerta_rut" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Atenci&oacute;n!</strong> El Rut es Incorrecto. Favor validar.
        </div>
    </div>
    
  </div>
  
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Datos Sucursal</h3>
              </div>
              <div class="box-body">
              
              <div class="row">                
                <div class="col-md-3">
                    <div class="form-group">
                        <input type="hidden" value="<?php echo $sucursales[0]['id_sucursal'];?>" name="id_sucursal" id="id_sucursal" class="form-control" />
                        <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $sucursales[0]['sucursal'];?>" placeholder="Nombre Sucursal">
                      </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-info pull-left">Guardar</button>
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
    </section>