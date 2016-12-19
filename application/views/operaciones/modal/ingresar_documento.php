<div class="row">
    
    <div class="col-md-8">    
    <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" />
        </div>
    </div>
    
    <div class="clearfix"></div>
    
    <div class="col-md-8">    
    <div class="form-group">
            <label>Archivo</label>
            <input type="file" name="archivo" id="archivo" class="form-control" />
        </div>
    </div>
    
    <div class="clearfix"></div>    
      
    <div class="col-md-4">
        <div class="form-group">
            <label>Estado</label>
            <select class="form-control" style="width: 100%;" name="estado" id="estado">
              <option selected="selected" value="0">Inactivo</option>
              <option value="1">Activo</option>
            </select>
        </div>
    </div>    
    <?php $id_ejecutivo = $this->input->post('id_ejecutivo');?>    
    <?php echo form_hidden('id_ejecutivo',$id_ejecutivo) ?>
</div>