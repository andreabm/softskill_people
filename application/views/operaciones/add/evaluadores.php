 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Evaluador 
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
  echo form_open('Operaciones/agregar_evaluador');
  ?>
  
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Datos Evaluador</h3>
              </div>
              <div class="box-body">
              
              <div class="row">                
                <div class="col-md-3">
                    <div class="form-group"><input class="form-control" type="text" name="nombre_evaluador" id="nombre_evaluador" placeholder="Nombre Evaluador"></div>
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