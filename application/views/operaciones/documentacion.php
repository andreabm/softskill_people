 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Documentaci&oacute;n
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
        <!--<form action="<?php //echo base_url("/index.php/gestion/agregar_documento"); ?>">-->
        <div class="col-md-3 col-xs-5">
            <a class="btn  btn-block btn-info" href="#" data-toggle="modal" data-target="#ingresarDocumento" onclick = "ingresarDocumento(<?php echo $id_ejecutivo;?>)">Agregar Documento</a>
            <!--<button type="submit" class="btn btn-block btn-info" >Agregar Documento</button>-->
        </div>
        <!--</form>-->
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Documentos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="postulantes" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Archivo</th>
                  <th>Img Archivo</th>
                  <th>Estado</th>
                  <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php
                /*
                echo '<pre>';
                print_r($documentos);
                echo '</pre>';
                */
                
                if(!empty($documentos)) {
                    foreach($documentos as $p){?>
                    <tr>
                      <td><?php echo $p['nombre'] ?></td>
                      <td><?php echo $p['archivo'] ?></td>
                      <td><?php echo $p['estado'] ?></td>
                      <td>
                          <a class="btn btn-xs btn-warning" href="<?php echo base_url('index.php/gestion/editar_postulante/'.$p['id_documentacion'])?>">Editar</a>
                          <a class="btn btn-xs btn-danger"  href="<?php echo base_url('index.php/operaciones/eliminar_documento/'.$p['id_documentacion']);?>">Eliminar</a>
                      </td>
                    </tr>
                    <?php
                    }
                }?>
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


<!--MODAL VER EJECUTIVO-->
<div class="modal modal-success fade" id="ingresarDocumento">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Validar Solicitud</h4>
              </div>
      <?php echo form_open_multipart('Operaciones/insert_documento');?>        
      <div class="modal-body" id="ingresaDocumentoBody">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>     
        <button type="submit" class="btn btn-outline">Guardar</button>
        
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--MODAL VER EJECUTIVO FIN-->

</div>

<script>
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
function ingresarDocumento(id_solicitud){
    $.ajax({
          url:"<?php echo base_url('index.php/operaciones/ingresar_documento')?>",
          type: 'POST',
          data: {id_ejecutivo:id_solicitud},
          success: function(data) {
          $('#ingresaDocumentoBody').html(data);
          },
          error: function(e) {
            $('#ingresarDocumentoBody').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
          }
    });
}

</script>