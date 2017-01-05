 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Calendario
        <small> de Entrevistas</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-9"></div>
        <form action="<?php echo base_url("/index.php/gestion/agregar_postulante"); ?>" target="_blank">
        <div class="col-md-3">
            <button type="submit" class="btn btn-block btn-info">Agregar Postulante</button>
        </div>
        </form>
    </div>
    <br />
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Calendario </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="col-md-9">
                  <div class="box box-primary">
                    <div class="box-body no-padding">
                      <!-- THE CALENDAR -->
                      <div id="calendar"></div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /. box -->
                </div>
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
</script>

      