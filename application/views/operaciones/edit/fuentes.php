 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Fuentes 
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
  echo form_open('operaciones/editar_fuente');
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
                  <h3 class="box-title">Datos Fuentes</h3>
              </div>
              <div class="box-body">
              
              <div class="row">                
                <div class="col-md-3">
                    <div class="form-group">
                      <input type="hidden" value="<?php echo $fuente[0]['id_fuente'];?>" name="id_fuente" id="id_fuente" class="form-control" />
                        <input class="form-control" type="text" name="nombre_fuente" id="nombre_fuente" value="<?php echo $fuente[0]['fuente'];?>" placeholder="Nombre PM">
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