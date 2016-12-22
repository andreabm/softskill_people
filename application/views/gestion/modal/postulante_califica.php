<div class="row">

    <?php 
    /*
    echo '<pre>';
        print_r($areas);
    echo '</pre>';
    */
    ?>

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
    <div class="col-md-12">
        <div class="form-group">
            <label>RUT</label>
            <input class="form-control" type="text" name="rut" id="rut" value="<?php echo $postulante[0]['rut'] ?>" readonly="readonly"/>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="text" name="email" id="email" value="<?php echo $postulante[0]['email'] ?>" readonly="readonly"/>
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
        <select class="form-control" name="cartera" id="cartera">
        <?php foreach($carteras as $a){?>         
            <option value="<?php echo $a['id_cartera'] ?>"><?php echo $a['cartera'] ?></option>
        <?php }?>
        </select> 
    </div>
    <div class="col-md-4">
        <label>Califica</label>
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

 $( "#area" ).change(function() {
    //alert($('#producto').val());
    cargar_carteras();
});
function cargar_carteras(){    
    $.ajax({
      url:"<?php echo base_url('/index.php/index/cargar_carteras')?>",
      type:'POST',
      data: {area:$('#area').val()},
      success: function(data) {        
      options_p = "<option selected>Seleccione area</option>";
        data = JSON.parse(data);
        //console.debug(data);
        $.each(data.carteras,function(i,v){
             options_p +="<option value='"+v.id_cartera+"'>"+v.cartera+"</option>";
            
        });
        $("#cartera").html(options_p);
      },
      error: function(e) {
        console.debug('error');
      }
   }); 
}

$('#califica').change(function(){
   if ($(this).val() == '1') {
        $('#div_motivo_no_califica').hide();
    } else {
        $('#div_motivo_no_califica').show();
    }
});
</script>