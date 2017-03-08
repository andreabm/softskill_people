 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Supervisores 
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
      <?php echo form_open('Operaciones/accion_supervisor');

      ?> 
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Datos Cartera</h3>
              </div>
              <div class="box-body">
              
              <div class="row">                
                <div class="col-md-3">
                  <label>Cartera</label>
                    <div class="form-group">
                        <input type="hidden" name="accion" value="u" class="form-control" />
                        <input type="hidden" value="<?php if(isset($supervisor[0]['id_cartera'])){echo $supervisor[0]['id_cartera'];}?>" name="id_cartera" id="id_cartera" class="form-control" />
                        <input class="form-control" type="text" name="cartera" id="cartera" value="<?php if(isset($supervisor[0]['cartera'])){echo $supervisor[0]['cartera'];}?>" placeholder="Nombre Cartera" readonly>
                      </div>
                </div>
                <div class="col-md-3">
                  <label>Supervisor</label>
                    <div class="form-group">
                      <select name="supervisores" id="supervisores" class="form-control">
                          <option>--Seleccione--</option>
                          <?php foreach($supervisores as $a){?> 
                          <option value="<?=$a?>" <?php if($supervisor[0]['nombre_supervisor']==$a){echo 'selected';}?>><?=$a?></option>
                          <?php }?>  
                      </select>
                    </div>
                </div>

                <div class="col-md-2">
                  <br/>
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