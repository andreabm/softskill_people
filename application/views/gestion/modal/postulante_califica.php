<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Nombre</label>
            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $postulante[0]['nombre'] ?>"/>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>RUT</label>
            <input class="form-control" type="text" name="rut" id="rut" value="<?php echo $postulante[0]['rut'] ?>"/>
        </div>
    </div>
    <div class="col-md-4">
        <label>Area</label>
        <select class="form-control" name="area" id="area">
        <?php foreach($areas as $a){?>         
            <option value="<?php echo $a['id_area'] ?>"><?php echo $a['area'] ?></option>
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
$('#califica').change(function(){
   if ($(this).val() == '1') {
        $('#div_motivo_no_califica').hide();
    } else {
        $('#div_motivo_no_califica').show();
    }
});
</script>