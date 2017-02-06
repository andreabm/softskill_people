 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard Calidad
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

           <?php 
              $msje_comentario = $this->session->flashdata('msje_comentario');
              if(!empty($msje_comentario)){
              ?>
              <div id="alertita" class="alert alert-<?php if($msje_comentario[0]==1){echo 'success';}else{echo 'danger';}?> alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong><?php if($msje_comentario[0]==1){echo 'Exito';}else{echo 'Fracaso';}?></strong> <?php if($msje_comentario[0]==1){echo 'Las personas presentadas fueron actualizadas.';}else{echo 'No se ha podido actualizar la lista de postulantes presentes.';}?>
              </div>        
              <?php }?>
                 
          </div>
      </div>
    
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
    
    <br />
      <div class="row"><div class="col-xs-12">

      	<section class="content">

      <div class="row">
        <div class="col-md-4">
            <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-user-times" aria-hidden="true"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pendientes de Entrevista</span>
              <span class="info-box-number"><?=count($entrevistap);?></span>

              <div class="progress">
                <div class="progress-bar" style="width:100%"></div>
              </div>
                  <span class="progress-description">Detalles <i class="fa fa-arrow-down" aria-hidden="true"></i></span>                  
            </div>
          </div>
        </div>
        <!--amarillo-->
        <div class="col-md-4">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Entrevistas para Hoy</span>
              <span class="info-box-number"><?=count($entrevistah);?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">Detalles <i class="fa fa-arrow-down" aria-hidden="true"></i></span>
            </div>
            <!-- /.info-box-content -->
          </div>   
        </div>
        <!--amarillo-->
        <div class="col-md-4">

            <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-user" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Entrevistados</span>
              <span class="info-box-number"><?=count($entrevistado);?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">Detalles <i class="fa fa-arrow-down" aria-hidden="true"></i></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
      </div>

      <div class="row">
          <div class="col-md-4" id="pendientes">
            <!--radio ini-->
            <ul class="todo-list ui-sortable">
              <?php 
              foreach($entrevistap as $p){?>
                <li>
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>                  
                  <input value="" type="checkbox">
                  <span class="text"><?=$p['nombre'];?></span>
                </li>
               <?php }?> 

              </ul>
            <!--radio fin-->
          </div>
          <div class="col-md-4" id="hoy">
            <?php echo form_open('gestion/dashboard');?>
            <!--radio ini-->
            <ul class="todo-list ui-sortable">
              <?php 
              foreach($entrevistah as $s){?>
                <li>
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>                  
                  <input value="1" type="checkbox" name="postulante[<?=$s['id_postulante'];?>]" <?php if($s['entrevistap']==1){echo 'checked';}else{echo '';}?>>
                  <span class="text" data-toggle="tooltip" data-placement="top" title="<?=$s['rut']?>"><?=$s['nombre'].' '.$s['paterno'].' '.$s['materno'];?></span>
                  <div class="tools">
                    <?php if(isset($s['observacion'])){?>
                    <i class="fa fa-comment" data-toggle="tooltip" data-placement="top" title="<?=$s['observacion']?>" style="color:#f39c12;"></i>
                    <?php }?>
                    <a data-toggle="modal" data-target="#comentarioPostulante" data-id="<?=$s['id_postulante'];?>" style="color:#f39c12;" href="#" onclick="datos(<?=$s['id_postulante'];?>,'<?=$s['observacion'];?>');"><i class="fa fa-edit"></i></a>
                  </div>
                </li>
               <?php }?>
              </ul>
            <!--radio fin-->            
            <div ><button type="submit" class="btn btn-block btn-warning" style="margin-top:10px;">Se presentaron</button></div>
            <?php echo form_hidden('guardar','1');
                  echo form_close();?>
          </div>
          <div class="col-md-4" id="listos">
            <!--radio ini-->
            <ul class="todo-list ui-sortable">
                <?php 
              foreach($entrevistado as $w){?>
                <li>
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>

                  <input value="" type="checkbox">

                  <span class="text"><?=$w['nombre'];?></span>
                </li>
               <?php }?>

              </ul>
            <!--radio fin-->
          </div>
          

      </div>

      <div class="clearfix">&nbsp;</div>

      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    <div style="padding: 10px 0px; text-align: center;"><script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><div class="visible-xs visible-sm"><!-- AdminLTE --><ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-4495360934352473" data-ad-slot="5866534244"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div><div class="hidden-xs hidden-sm"><!-- Home large leaderboard --><ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-4495360934352473" data-ad-slot="1170479443"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div></div></section>

     </div></div>
    </section>


	<!--MODAL VER POSTULANTE-->
  <?php echo form_open('Gestion/postulante_comentario');?>
	<div class="modal modal-warning fade" id="comentarioPostulante">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">¿Que sucedió?</h4>
      </div>

      <div class="modal-body" id="verPostulanteBody">
          <label>¿Agregar comentarios?</label>
          <input type="hidden" class="form-control" name="id_postulante" id="id_postulante" value="" />
           <textarea rows="4" class="form-control" name="observacion" id="observacion"></textarea>                           
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cerrar</button>         
        <button type="submit" class="btn btn-outline" id="asignar">Guardar</button>     
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php echo form_close();?>
<!--MODAL VER POSTULANTE-->
<script>
  $(function () {
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
        lang: 'es',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week: 'Semana',
        day: 'Dia'
      },
	  
      events: <?php echo json_encode($array_entrevistas)?>,
      editable: false,
      droppable: false, 
	  eventClick: function(calEvent, jsEvent, view) {
		$.ajax({
          url:"<?php echo base_url('index.php/operaciones/ver_ejecutivo')?>",
          type: 'POST',
          data: {id_postulante:calEvent.id},
          success: function(data) {
			$('#verPostulanteBody').html(data);
          },
          error: function(e) {
            $('#verPostulanteBody').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
          }
		});
        $("#verPostulante").modal('show'); 
    }
    });
    setTimeout(function(){ $("#alertita").fadeOut(4000);}, 5000);
  });
 function datos(id_postulante,observacion){
  $('.modal-body #id_postulante').val(id_postulante);
  $('.modal-body #observacion').val(observacion);
 }


</script>