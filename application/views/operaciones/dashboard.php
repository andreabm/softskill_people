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
            if(!empty($msje_eliminar)){?>
            <div id="alertita" class="alert alert-<?php if($msje_eliminar[0]==1){echo 'success';}else{echo 'danger';}?> alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><?php if($msje_eliminar[0]==1){echo 'Exito';}else{echo 'Fracaso';}?></strong> <?php if($msje_eliminar[0]==1){echo 'El postulante se ha eliminado.';}else{echo 'No se ha podido eliminar el postulante.';}?>
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
        <!--colores ini-->
        <div class="col-md-3">
          <!--red ini-->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-user-times" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pendientes de Inducci&oacute;n</span>
              <span class="info-box-number"><?=count($induccion_restante);?></span>

              <div class="progress">
                <div class="progress-bar" style="width:100%"></div>
              </div>
                  <span class="progress-description">Detalles <i class="fa fa-arrow-down" aria-hidden="true"></i></span>                  
            </div>
          </div>
          <!--red fin-->	
        </div>  

          <!-- Info Boxes Style 2 -->
        <div class="col-md-3">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-user" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Inducci&oacute;n para Hoy</span>
              <span class="info-box-number"><?=count($hoy);?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">Detalles <i class="fa fa-arrow-down" aria-hidden="true"></i></span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
        
        <div class="col-md-3">  
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-user" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Inducidos</span>
              <span class="info-box-number"><?=count($cant_inducidos)?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">Detalles <i class="fa fa-arrow-down" aria-hidden="true"></i></span>
            </div>

          </div>
        </div>
        
        <div class="col-md-3">            
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-briefcase" aria-hidden="true"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pendientes de Entrevista</span>
              <span class="info-box-number"><?=count($entrevistap);?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">Detalles <i class="fa fa-arrow-down" aria-hidden="true"></i></span>
            </div>
          </div>
         </div>
    
         </div>

         <div class="row">
          <div class="col-md-3 pre-scrollable" id="pendientes">
            <!--radio ini-->
            <ul class="todo-list ui-sortable">
              <?php 
              foreach($induccion_restante as $p){?>
                <li>
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>                  
                  <input value="" type="checkbox" disabled>
                  <span class="text"><?=$p['nombre'];?></span>
                </li>
               <?php }?> 

              </ul>
            <!--radio fin-->
          </div>
          <div class="col-md-3 pre-scrollable" id="hoy">
            <?php echo form_open('operaciones/dashboard');?>
            <!--radio ini-->
            <ul class="todo-list ui-sortable">
                <?php 
              foreach($hoy as $s){?>
                <li>
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>                  
                  <input value="1" type="checkbox" name="postulante[<?=$s['id_postulante'];?>]" <?php if($s['induccionp']==1){echo 'checked';}else{echo '';}?>>
                  <span class="text" data-toggle="tooltip" data-placement="top" title="<?=$s['rut']?>"><?=$s['nombre'].' '.$s['paterno'].' '.$s['materno'];?></span>
                  <div class="tools">
                    <?php if(isset($s['observacion_induccion'])){?>
                    <i class="fa fa-comment" data-toggle="tooltip" data-placement="top" title="<?=$s['observacion_induccion']?>" style="color:#f39c12;"></i>
                    <?php }?>
                    <a data-toggle="modal" data-target="#comentarioPostulante" data-id="<?=$s['id_postulante'];?>" style="color:#f39c12;" href="#" onclick="datos(<?=$s['id_postulante'];?>,'<?=$s['observacion_induccion'];?>');"><i class="fa fa-edit"></i></a>
                  </div>
                </li>
               <?php }?>
              </ul>
            <!--radio fin-->            
            <div ><button type="submit" class="btn btn-block btn-warning" style="margin-top:10px;">Se presentaron</button></div>
            <?php echo form_hidden('guardar','1');
                  echo form_close();?>
          </div>
          <div class="col-md-3 pre-scrollable" id="listos">
            <!--radio ini-->
            <ul class="todo-list ui-sortable">
                <?php 
              foreach($cant_inducidos as $w){?>
                <li>
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>

                  <input value="" type="checkbox" checked disabled>
                  <span class="text"><?=$w['nombre'];?></span>
                </li>
               <?php }?>

              </ul>
            <!--radio fin-->
          </div>
          <div class="col-md-3 pre-scrollable" id="pendientes">
            <!--radio ini-->
            <ul class="todo-list ui-sortable">
              <?php 
              foreach($entrevistap as $p){?>
                <li>
                  <i class="fa fa-ellipsis-v"></i>
                  <i class="fa fa-ellipsis-v"></i>                  
                  <input value="" type="checkbox" disabled>
                  <span class="text"><?=$p['nombre'];?></span>            
                </li>
               <?php }?> 

              </ul>
            <!--radio fin-->
          </div>
      </div>

      <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Recap Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="display: block;">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" style="height: 0px; width: 0px;" height="0" width="0"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Goal Completion</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Add Products to Cart</span>
                    <span class="progress-number"><b>160</b>/200</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Complete Purchase</span>
                    <span class="progress-number"><b>310</b>/400</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Visit Premium Page</span>
                    <span class="progress-number"><b>480</b>/800</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Send Inquiries</span>
                    <span class="progress-number"><b>250</b>/500</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            <div class="box-footer" style="display: block;">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>

      <div class="clearfix">&nbsp;</div>

        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <div id="calendar"></div>
            </div>
          </div>
          <!-- /. box -->
        </div>



        </div>
        <!--colores fin-->
        <!-- /.col -->
      </div>
      <!-- /.row -->
    <div style="padding: 10px 0px; text-align: center;"><script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><div class="visible-xs visible-sm"><!-- AdminLTE --><ins class="adsbygoogle" style="display:inline-block;width:300px;height:250px" data-ad-client="ca-pub-4495360934352473" data-ad-slot="5866534244"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div><div class="hidden-xs hidden-sm"><!-- Home large leaderboard --><ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-4495360934352473" data-ad-slot="1170479443"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script></div></div></section>

     </div></div>
    </section>
	<!--MODAL VER POSTULANTE-->
<!--MODAL VER POSTULANTE-->
  <?php echo form_open('operaciones/postulante_comentario');?>
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
  });
  function datos(id_postulante,observacion){
  $('.modal-body #id_postulante').val(id_postulante);
  $('.modal-body #observacion').val(observacion);
 }
</script>