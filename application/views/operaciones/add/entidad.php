 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Entidad 
        <small> de Serbanc</small>
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
  echo form_open('Operaciones/agregar_entidad');
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
                    <label>Nombre</label>
                    <div class="form-group">
                        <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre Sucursal" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Tipo</label>
                    <div class="form-group">
                        <select name="tipo" id="tipo" class="form-control" required>
                          <option value="">--Seleccione--</option>
                          <option value="A">Afp</option>
                          <option value="S">Salud</option>
                        </select>
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