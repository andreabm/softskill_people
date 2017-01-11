<div class="row">
    <div class="col-xs-8">
        <div class="alert alert-danger alert-dismissible" id="alerta_rut" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Atenci&oacute;n!</strong> El Rut es Incorrecto. Favor validar.
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Nombre</label>
            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $postulante[0]['nombre'] ?>"/>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>RUT</label>
            <input class="form-control" type="text" name="rut" id="rut" value="<?php echo $postulante[0]['rut'] ?>" readonly="readonly"/>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>CARGO A POSTULAR</label>
            <?php
                echo form_dropdown('id_cargo',$cargos,$postulante[0]['id_cargo'],array('id' => 'id_cargo','class' => 'form-control','disabled' => 'disabled'));
             ?>
            <!--<input class="form-control" type="text" name="rut" id="rut" value="<?php //echo $postulante[0]['id_cargo'] ?>" readonly="readonly"/>-->
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="text" name="email" id="email" value="<?php echo $postulante[0]['email'] ?>" readonly="readonly"/>
        </div>
    </div>

    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissible" id="alerta_cargo" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Atenci&oacute;n!</strong> El cargo a Postular no Coincide.
        </div>
    </div>

    <div class="col-md-4">
        <label>Area</label>
        <select class="form-control" name="area" id="area">
        <?php foreach($areas as $a){?>         
            <option value="<?php echo $a['id_area'];?>"><?php echo $a['area'] ?></option>
        <?php }?>
        </select> 
    </div>
    <div class="col-md-4">
        <label>Cartera</label>

        <input type="hidden" name="sucu" id="sucu" class="form-control">
        
        <select class="form-control" name="cartera" id="cartera">
        <?php foreach($carteras as $a){?>         
            <option value="<?php echo $a['id_cartera'] ?>"><?php echo $a['cartera'] ?></option>
        <?php }?>
        </select> 
    </div>

    <div class="col-md-4">
        <label>Califica</label>
        <span id="suc"></span>
        <select class="form-control" name="califica" id="califica">   
            <option value="1" selected >Califica</option>
             <option value="0">No Califica</option>        
        </select> 
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4" style="display: none;" id="div_motivo_no_califica">
        <label>Motivo</label>
        <?php echo form_dropdown('id_motivo_no_califica',$motivos_no_califica,'',array('class' => 'form-control','id' => 'motivo_no_califica')); ?>  
    </div>
    <?php echo form_hidden('id_cargo',$postulante[0]['id_cargo']) ?>
</div>
<script>
$('#califica').change(function(){
   if ($(this).val() == '1') {
        $('#div_motivo_no_califica').hide();
    } else {
        $('#div_motivo_no_califica').show();
    }
});

 $( "#area" ).change(function() {
    cargar_carteras();
});
function cargar_carteras(){
    var cargo_postular = $('#id_cargo').val();
    $.ajax({
      url:"<?php echo base_url('/index.php/index/cargar_solicitudes')?>",
      type:'POST',
      data: {area:$('#area').val()},
      success: function(data) {        
      options_p = "<option selected>Seleccione area</option>";
      options_s = "";
      options_sol = "";
        data = JSON.parse(data);
        $.each(data.carteras,function(i,v){
             options_p +="<option value='"+v.id_cartera+"'>"+v.cartera+"</option>";            
        });
        $("#cartera").html(options_p);
        $.each(data.sucursales,function(i,v){
            $('#sucu').val(v.id_sucursal);
             options_s +="<input type='hidden' name='id_sucursal' id='id_sucursal' value='"+v.id_sucursal+"' >";          
        });
        $("#suc").html(options_s);
        $.each(data.solicitudes,function(i,v){
            $('#sucu').val(v.id_solicitud);
             options_sol +="<input type='hidden' name='id_solicitud' id='id_solicitud' value='"+v.id_cargo+"' >";
             if(cargo_postular!=v.id_cargo){               
               $('#alerta_cargo').fadeIn();
                setTimeout(function(){$("#alerta_cargo").fadeOut(3000);},4000);
                $('#asignar').prop("disabled", true); 
             }else{
                $('#alerta_cargo').fadeOut();
                $('#asignar').prop("disabled", false); 
             }
        });
      },
      
      error: function(e) {
        console.debug('error');
      }
   }); 
}
</script>