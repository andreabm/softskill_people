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
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($postulantes)) {
                    foreach($postulantes as $p) {
                        ?>
                        <tr>
                          <td><?php echo $p['rut'] ?></td>
                          <td><?php echo $p['nombre'] ?></td>
                          <td><?php echo $p['fecha_nacimiento'] ?></td>
                          <td><?php echo $p['fono_movil'] ?></td>
                          <td><?php echo $p['nacionalidad'] ?></td>
                          <td><?php echo $p['discapacidad'] ?></td>
                          <td><?php echo $p['fecha_entrevista'] ?></td>
                          <?php 
                          if ($p['clasificado'] == 1){
                            $val = 'Si';
                          } elseif (!empty($p['id_motivo_no_califica'])) {
                            $val = 'No';
                          } else {
                            $val = 'No reportado';
                          }
                          ?>
                          <td><?php echo $val ?></td>
                          <td>
                              <a class="btn btn-xs btn-success" data-toggle="modal" data-target="#verPostulante" onclick = "verPostulante(<?php echo $p['id_postulante'];  ?>)">Ver</a>
                              <a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/gestion/editar_postulante/'.$p['id_postulante'])?>">Editar</a>
                              <a class="btn btn-xs btn-primary" href="<?php echo base_url('index.php/gestion/postulante_prueba/'.$p['id_postulante'])?>">Evaluacion</a>
                              <a class="btn btn-xs btn-info" data-toggle="modal" data-target="#postulanteCalifica" onclick = "postulanteCalifica(<?php echo $p['id_postulante'];  ?>)">Califica</a>                  
                          </td>
                        </tr>
                        <?php
                    }
                }
                
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Totales</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                </tfoot>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
     
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
      <?php echo form_open('Gestion/postulante_califica_guardar');?>
      <div class="modal-body" id="postulanteCalificaBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>
         
            <button type="submit" class="btn btn-outline">Asignar</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

<script>
$(document).ready(function(){
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