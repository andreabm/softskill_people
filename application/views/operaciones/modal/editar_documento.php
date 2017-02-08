<div class="row">
    <div class="col-md-8">    
    <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?=$documento[0]['nombre'];?>" class="form-control" />
        </div>
    </div>
        
    <div class="clearfix"></div>
    
    <div class="col-md-8">    
    <div class="form-group">
            <label>Archivo</label>
            <input type="file" name="archivo" id="archivo" value="<?=$documento[0]['archivo'];?>" class="form-control" />
        </div>
    </div>
    
    <div class="clearfix"></div>    
      
    <div class="col-md-4">
        <div class="form-group">
            <label>Estado</label>            
            <select class="form-control" style="width: 100%;" name="estado" id="estado">
              <option value="0" <?php if($documento[0]['estado']=='0'){echo 'selected="selected"';}?>>Inactivo</option>
              <option value="1" <?php if($documento[0]['estado']=='1'){echo 'selected="selected"';}?>>Activo</option>
            </select>
        </div>
    </div>    
    <?php $id_ejecutivo = $documento[0]['id_ejecutivo'];?>    
    <?php echo form_hidden('id_ejecutivo',$id_ejecutivo);?>
    <?php echo form_hidden('id_documento',$documento[0]['id_documentacion']);?>
</div>