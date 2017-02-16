 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Postulantes
        <small> Serbanc</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    


    <div class="row">
        <div class="col-xs-12">        
        <?php 
        $msje_eliminar = $this->session->flashdata('msje_eliminar');
            if(!empty($msje_eliminar)){
            ?>
            <div id="alertita" class="alert alert-<?php if($msje_eliminar[0]==1){echo 'success';}else{echo 'danger';}?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?php if($msje_eliminar[0]==1){echo 'Exito';}else{echo 'Fracaso';}?></strong> <?php if($msje_eliminar[0]==1){echo 'El postulante se ha eliminado.';}else{echo 'No se ha podido eliminar el postulante.';}?>
            </div>        
            <?php }?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-9"></div>
        <form action="<?php echo base_url("/index.php/gestion/agregar_postulante"); ?>">
        <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-info" >Agregar Postulante</button>
        </div>
        </form>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Postulantes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="postulantes" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Rut</th>
                  <th>Nombre</th>
                  <th>F. Nacimiento</th>
                  <th>Celular</th>
                  <th>Nacionalidad</th>
                  <th>Discapacidad</th>
                  <th>Fecha Entrevista</th>
                  <th>Califica</th>
                  <th>Entrevistado</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($postulantes)) {

                      
                    

                    foreach($postulantes as $p) {

                      

                      $newDate = date("d-m-Y", strtotime($p['fecha_nacimiento']));
                        ?>
                        <tr>
                          <td><?php echo $p['rut'] ?></td>
                          <td><?php echo $p['nombre'].' '.$p['paterno'] ?></td>
                          <td><?php echo $newDate;?></td>
                          <td><?php echo $p['fono_movil'] ?></td>
                          <td><?php echo $p['nacionalidad'] ?></td>
                          <td><?php echo $p['discapacidad'] ?></td>
                          <td><?php echo $p['fecha_entrevista'] ?></td>
                          <?php 
                          if ($p['clasificado']==1){
                            $val = 'Si';
                          } elseif (!empty($p['id_motivo_no_califica'])) {
                            $val = 'No';
                          } elseif ($p['prefiltro']=='NO') {
                            $val = 'Prefiltro';  
                          } else {
                            $val = 'No reportado';
                          }
                          if($p['entrevistado']==1){
                            $entrevistado = "<i class='fa fa-check fa-lg' aria-hidden='true' style='color:green;'></i>";
                          }else{
                            $entrevistado = "<i class='fa fa-gtimes fa-lg' aria-hidden='true' style='color:red;'></i>";
                          }?>
                          <td><?php echo $val ?></td>
                          <td><?=$entrevistado?></td>
                          <td>
                              <a class="btn btn-xs btn-success" data-toggle="modal" data-target="#verPostulante" onclick = "verPostulante(<?php echo $p['id_postulante'];  ?>)">Ver</a>
                              <a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/gestion/editar_postulante/'.$p['id_postulante'])?>">Editar</a>
                              <a class="btn btn-xs btn-primary" href="<?php echo base_url('index.php/gestion/postulante_prueba/'.$p['id_postulante'])?>">Evaluaci&oacute;n</a>
                              
                              <?php 
                              $rut = '';
                              foreach ($induccion as $a) {
                                  if($a['rut']==$p['rut']){
                                      ?>
<a class="btn btn-xs btn-info" data-toggle="modal" data-target="#postulanteCalifica" onclick="postulanteCalifica(<?php echo $p['id_postulante'];  ?>)">Califica</a>
                                      <?php
                                  }
                              }
                              ?>
                                                
                              
                              <!--<a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#eliminarPostulante" onclick = "eliminarPostulante(<?php //echo $p['id_postulante'];  ?>)">Eliminar</a>-->
                          </td>
                        </tr>
                        <?php
                    }
                }
                
                ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

<!--MODAL VER POSTULANTE-->
<div class="modal modal-success fade" id="verPostulante">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Postulante</h4>
              </div>
      <div class="modal-body" id="verPostulanteBody">
        
      </div>
      <div class="modal-footer">      
       <!-- <form action="<?php echo base_url("/index.php/gestion/agregar_postulante"); ?>">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Editar</button> 
        </form>-->
        <button type="button" class="btn btn-outline " data-dismiss="modal">Cerrar</button>     
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--MODAL POSTULANTE CALIFICA-->
<div class="modal modal-info fade" id="postulanteCalifica">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Postulante Califica</h4>
              </div>
      <?php 
      echo form_open('Gestion/postulante_califica_guardar');?>

      <div class="modal-body" id="postulanteCalificaBody"></div>
      <div class="modal-body" style="color:#333;">
        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label>Supervisor</label>
                    <span id="id_supervisor"></span>
                    <span id="supervisor"></span>
                    <input type="text" class="form-control" name="supervisor_falso" id="supervisor_falso" readonly/>
                    <!--<select class="form-control" name="supervisor" id="supervisor">
                      <?php //foreach($evaluadores as $w){?>
                      <option value="<?php //echo $w['id_supervisor']?>"><?php //echo //$w['nombre_supervisor']?></option>
                      <?php //}?>
                    </select>-->

                    <?php
                    //echo form_dropdown('evaluador',$evaluadores,'',array('class' => 'form-control','id' => 'evaluador'));
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <label>Fecha de Presentaci&oacute;n</label>
  
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right datepicker" name="fecha_presentacion">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
              <div class="col-md-4">
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                      <label>Hora de Presentaci&oacute;n:</label>        
                      <div class="input-group">
                        <input type="text" class="form-control timepicker" name="hora_presentacion">        
                        <div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
            </div>

        </div>
      </div>

      <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>         
            <button type="submit" class="btn btn-outline" id="asignar">Asignar</button>
        </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

<script>
$(document).ready(function(){ 
  $('.datepicker').datepicker({
          starDate: 'today',
          language: "es",
          format: 'yyyy-mm-dd',
          autoclose: true
  });
  $(".timepicker").timepicker({
      showMeridian:false,
                    showInputs: false
  });
});

$(document).ready(function(){
    setTimeout(function(){ $("#alertita").fadeOut(4000);}, 5000);
    $('#postulantes').DataTable({
       "language": {
                "url": '<?php echo base_url("/js/bootstrap-dataTables-Spanish.json") ?>',
                "decimal": ",",
                "thousands": "."
            },
    });
});

function verPostulante(id_postulante){  
    $.ajax({
          url:"<?php echo base_url('index.php/gestion/ver_postulante')?>",
          type: 'POST',
          data: {id_postulante:id_postulante},
          success: function(data) {
          $('#verPostulanteBody').html(data);
          },
          error: function(e) {
            $('#verPostulanteBody').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
          }
    });
}
function eliminarPostulante(id_postulante){
    $.ajax({
          url:"<?php echo base_url('index.php/gestion/eliminar_postulante')?>",
          type: 'POST',
          data: {id_postulante:id_postulante},
          success: function(data) {
          $('#verPostulanteBody').html(data);
          $('#alertita').fadeIn();
          setTimeout(function(){ $("#alertita").fadeOut(4000);}, 5000);
          },
          error: function(e) {
            $('#verPostulanteBody').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
          }
    });
}

function postulanteCalifica(id_postulante){
    $.ajax({
          url:"<?php echo base_url('index.php/gestion/postulante_califica')?>",
          type: 'POST',
          data: {id_postulante:id_postulante},
          success: function(data) {  
          $('#postulanteCalificaBody').html(data);
          },
          error: function(e) {
            $('postulanteCalificaBody').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
          }
    });
}
</script>