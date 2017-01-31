<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Area</label>
            <input class="form-control" type="text" name="area" id="area" value="<?php echo $solicitud[0]['area'] ?>" readonly />
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cartera</label>
            <input class="form-control" type="text" name="cartera" id="cartera" value="<?php echo $solicitud[0]['cartera'] ?>" readonly/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cargo</label>
            <input class="form-control" type="text" name="cargo" id="cargo" value="<?php echo $solicitud[0]['cargo'] ?>" readonly/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cantidad Solicitada</label>
            <input class="form-control" type="text" name="cant_solicitada" id="cant_solicitada" value="<?php echo $solicitud[0]['cantidad_solicitada'];?>" readonly/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Prioridad</label>
            <input class="form-control" type="text" name="prioridad" id="prioridad" value="<?php echo $solicitud[0]['prioridad'] ?>" />
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Observacion</label>
            <input class="form-control" type="text" name="observacion" id="observacion" value="<?php echo $solicitud[0]['observacion'] ?>" readonly/>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cantidad Aprobada</label>

            <input class="form-control" type="number" name="cantidad_aprobada" id="cantidad_aprobada" min="1" max="<?php echo $solicitud[0]['cantidad_solicitada'];?>" value="1">


        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label>Observaci&oacute;n Aprobada</label>
            <input class="form-control" type="text" name="observacion_aprobada" id="observacion_aprobada" value="<?php echo $solicitud[0]['observacion_aprobada'] ?>" />
        </div>
    </div>
    <?php echo form_hidden('id_cargo',$solicitud[0]['id_cargo']);?>
    <?php echo form_hidden('id_solicitud',$solicitud[0]['id_solicitud']);?>
</div>