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
            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $postulante[0]['nombre'].' '.$postulante[0]['paterno'].' '.$postulante[0]['materno'] ?>"/>
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
                echo form_dropdown('id_cargo',$cargos,$postulante[0]['id_cargo'],array('id' => 'id_cargo','class' => 'form-control','readonly' => 'readonly','required' => 'required'));
             ?>
            <!--<input class="form-control" type="text" name="rut" id="rut" value="<?php //echo $postulante[0]['id_cargo'] ?>" readonly="readonly"/>-->
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="text" name="email" id="email" value="<?php echo $postulante[0]['email'] ?>" readonly="readonly" required/>
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
        <select class="form-control" name="area" id="area" required>
            <option value="">--Seleccione--</option>
        <?php foreach($areas as $a){?>         
            <option value="<?php echo $a['id_area'];?>"><?php echo $a['area'] ?></option>
        <?php }?>
        </select> 
    </div>
    <div class="col-md-4">
        <label>Cartera</label>

        <input type="hidden" name="nsucursal" id="nsucursal" class="form-control">
        
        <select class="form-control" name="cartera" id="cartera" required>
        <?php foreach($carteras as $a){?>         
            <option value="<?php echo $a['id_cartera'] ?>"><?php echo $a['cartera'] ?></option>
        <?php }?>
        </select> 
    </div>

    <div class="col-md-4">
        <label>Califica</label>
        <span id="suc"></span>
        <select class="form-control" name="califica" id="califica" required>   
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

$( "#area" ).change(function(){
    //alert(this.value);
    cargar_carteras(this.value);
});
$("#cartera").change(function(){
    //alert(this.value);
    cargar_supervisor(this.value);
});



function cargar_carteras(valor_area){
    var v_area = valor_area;
    var cargo_postular = $('#id_cargo').val();

    $.ajax({
      url:"<?php echo base_url('/index.php/index/cargar_solicitudes')?>",
      type:'POST',

      data: {area:v_area},

      success: function(data){  

      options_p = "<option value=''>--Seleccione--</option>";
      options_s = "";
      options_sol = "";

        //carteras
        data = JSON.parse(data);
        $.each(data.carteras,function(i,v){
             options_p +="<option value='"+v.id_cartera+"'>"+v.cartera+"</option>";           
        });
        $("#cartera").html(options_p);
        
        //cargo debe coincidir con puesto            
        $( "#cartera" ).change(function(){
            verificar_cartera(this.value)
        }); 

        //sucursales
        $.each(data.sucursales,function(i,v){
            $('#nsucursal').val(v.id_sucursal);
             options_s +="<input type='hidden' name='id_sucursal' id='id_sucursal' value='"+v.id_sucursal+"' >";  
        });
        $("#nsucursal").html(options_s);

        //mensaje
        $.each(data.solicitudes,function(i,v){
          $('#nsucursal').val(v.id_solicitud);
        });

      },
      error: function(e) {
        console.debug('error');
      }
   }); 
}

function cargar_supervisor(valor_area){
    var v_area = valor_area;
    $.ajax({
      url:"<?php echo base_url('/index.php/index/cargar_supervisor')?>",
      type:'POST',
      data: {area:v_area},
      success: function(data){
        options_w = "";
        options_y = "";
        //carteras
        data = JSON.parse(data);
        $.each(data.supervisores,function(i,w){
             options_y +="<input type='hidden' name='id_supervisor' id='id_supervisor' value='"+w.id_supervisor+"' class='form-control' readonly>"; 
             options_w +="<input type='text' name='supervisor' id='supervisor' value='"+w.nombre_supervisor+"' class='form-control' readonly>"; 
        });
        $("#supervisor_falso").hide();
        $("#supervisor").html(options_w);
        $("#id_supervisor").html(options_y);
      },
      error: function(e) {
        console.debug('error');
      }
   }); 
}

function verificar_cartera(selCartera){
     var sel_area = $('#area').val();
     var sel_cartera = selCartera;
     var cargo_postular = $('#id_cargo').val(); 

     $.ajax({
      url:"<?php echo base_url('/index.php/index/cargar_solicitudes_b')?>",
      type:'POST',

      data: {cartera:sel_cartera,area:sel_area},
      success: function(data){
      options_sol = "";
        //carteras
        data = JSON.parse(data);
        //mensaje
        $.each(data.solicitud,function(i,v){
          $('#nsucursal').val(v.id_solicitud);
               
             options_sol +="<input type='hidden' name='id_solicitud' id='id_solicitud' value='"+v.id_cargo+"' >";
             $("#suc").html(options_sol);

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