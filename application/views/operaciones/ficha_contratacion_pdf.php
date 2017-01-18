 <div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Ficha<small> de Contratacion</small></h1>
    </section>
   <h3 class="box-title">Solicitud de Contrataci&oacute;n</h3>
   <table>
    <tr>
        <th style="width: 800px;">RAZ�N SOCIAL</th><td colspan="2">kjfkjdf</td>
        
    </tr>
    <tr>
        <th>RAZ�N SOCIAL2</th><td>kjfkjdf</td>
        <td>kjfkjdf</td>
    </tr>
   </table>
    
    
    <section class="content">
        <br />
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Solicitud de Contrataci&oacute;n</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>RAZ&Oacute;N SOCIAL</label>
                                    <input class="form-control" type="text" name="razon_social" id="razon_social"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre Completo</label>                                   
                                    <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $ejecutivo[0]['nombre'] ?>"/>                           
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>R.U.T</label>
                                    <input class="form-control" type="text" name="rut" id="rut" value="<?php echo $ejecutivo[0]['rut'] ?>" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha de nacimiento</label>
                                    <input class="form-control datepicker" type="text" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $ejecutivo[0]['fecha_nacimiento'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Direcci&oacute;n</label>
                                    <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo $ejecutivo[0]['direccion'] ?>"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Comuna</label>
                                    <input class="form-control" type="text" name="comuna" id="comuna" value="<?php echo $ejecutivo[0]['comuna'] ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Tel&eacute;fonos: </h4>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>M&oacute;vil</label>
                                    <input class="form-control" type="text" name="movil" id="movil" value="<?php echo $ejecutivo[0]['fono_movil'] ?>" />
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fijo</label>
                                    <input class="form-control" type="text" name="fijo" id="fijo" value="<?php echo $ejecutivo[0]['fono_fijo'] ?>" />
                                </div>
                            </div>                      
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>Estado Civil: </h4>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                              
                                    <label>Soltero</label>
                                    <input class="form-control" type="text" name="soltero" id="soltero" value="<?php if($ejecutivo[0]['edo_civil']== 'Soltero'){  echo "X";}else{ echo " ";} ?>" />
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Casado</label>
                                    <input class="form-control" type="text" name="casado" id="casado" value="<?php if($ejecutivo[0]['edo_civil']== 'Casado'){  echo "X";}else{ echo " ";} ?>" />
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Con Hijos</label>
                                    <input class="form-control" type="text" name="con_hijos" id="con_hijos" value="<?php if($ejecutivo[0]['num_hijos']>0){  echo "X";}else{ echo " ";} ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>AFP</label>
                                    <input class="form-control" type="text" name="afp" id="afp" value="<?php echo $ejecutivo[0]['afp'] ?>" />
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sistema de Salud</label>
                                    <input class="form-control" type="text" name="salud" id="salud" value="<?php echo $ejecutivo[0]['salud'] ?>" />
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha de Contrato</label>
                                    <input class="form-control datepicker" type="text" name="fecha_contrato" id="fecha_contrato" value="<?php echo $ejecutivo[0]['fecha_ingreso'] ?>" />
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PM/ROL</label>
                                    <input class="form-control" type="text" name="pm" id="pm" disabled value="<?php echo $ejecutivo[0]['nombre_pm'] ?>" />
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Industria</label>
                                    <input class="form-control" type="text" name="centro_costo" disabled id="centro_costo" value="<?php echo $ejecutivo[0]['area'] ?>" />
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>C&oacute;digo de Proyecto (COD SAP)</label>
                                    <input class="form-control" type="text" name="sap" id="sap" value="<?php echo $ejecutivo[0]['cod_sap'] ?>"/>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Direcci&oacute;n Sucursal</label>
                                    <input class="form-control" type="text" name="sucursal" id="sucursal" disabled value="<?php echo $ejecutivo[0]['sucursal'] ?>" />
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Departamento (&Aacute;rea de Apoyo)</label>
                                    <input class="form-control" type="text" name="apoyo" id="apoyo" value="<?php echo $ejecutivo[0]['gerencia'] ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Horario de Trabajo</label>
                                    <?php
                                    echo form_dropdown('turno_id',$turnos,$ejecutivo[0]['id_turno'],array('class' => 'form-control'));
                                    ?>
        
                                </div>
                            </div>
                        </div>
                        <?php
                        if (!empty($ejecutivo[0]['motivo_contrato'])){
                            $motivo_contrato1 = explode(' ',$ejecutivo[0]['motivo_contrato'],2);
                            //print_r($motivo_contrato1);
                            $motivo_contrato = $motivo_contrato1[0];
                            $obs = $motivo_contrato1[1];
                        } else {
                            $motivo_contrato = ''; 
                            $obs = '';
                        }
                        
                        
                        ?>
                        <div class="row">
                            <div class="col-md-3"> <h4>Motivo de la Contrataci&oacute;n:</h4></div>
                            <div class="col-md-8">
                              <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" name="motivo_contrato" value="renuncia" <?php if ($motivo_contrato == 'renuncia') { echo 'checked' ;} ?>/> Renuncia de:
                                    </span>
                                <input type="text" class="form-control" name="renuncia" <?php if ($motivo_contrato == 'renuncia') { echo 'value = "'.$obs.'"' ;} ?>>
                              </div><br />
                              <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" name="motivo_contrato" value="despido" <?php if ($motivo_contrato == 'despido') { echo 'checked' ;} ?>> Despido de:
                                    </span>
                                <input type="text" class="form-control" name="despido" <?php if ($motivo_contrato == 'despido') { echo 'value = "'.$obs.'"' ;} ?>>
                              </div><br />
                              <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio"  name="motivo_contrato"  value="licencia" <?php if ($motivo_contrato == 'licencia') { echo 'checked' ;} ?>> Licencia de:
                                    </span>
                                <input type="text" class="form-control" name="licencia" <?php if ($motivo_contrato == 'licencia') { echo 'value = "'.$obs.'"' ;} ?>>
                              </div><br />
                              <div class="input-group">
                                    <span class="input-group-addon" >
                                      <input type="radio" name="motivo_contrato"  value="aumento" <?php if ($motivo_contrato == 'aumento') { echo 'checked' ;} ?>> Aumento de Dotaci&oacute;n:
                                    </span>
                                <input type="text" class="form-control" name="aumento" <?php if ($motivo_contrato == 'aumento') { echo 'value = "'.$obs.'"' ;} ?>>
                              </div><br />
                              <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" name="motivo_contrato" value="reemplazo" <?php if ($motivo_contrato == 'reemplazo') { echo 'checked' ;} ?>> Por reemplazo:
                                    </span>
                                <input type="text" class="form-control" name="reemplazo" <?php if ($motivo_contrato == 'reemplazo') { echo 'value = "'.$obs.'"' ;} ?>>
                              </div><br />
                              <div class="input-group">
                                <span class="input-group-addon">
                                      <input type="radio" name="motivo_contrato" value="cargo_nuevo" <?php if ($motivo_contrato == 'cargo_nuevo') { echo 'checked' ;} ?>> Cargo nuevo (especif&iacute;que):
                                    </span>
                                <input type="text" class="form-control" name="cargo_nuevo" <?php if ($motivo_contrato == 'cargo_nuevo') { echo 'value = "'.$obs.'"' ;} ?>">
                              </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                       
                    </div>
                    
                </div>
                <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-info pull-right">Guardar</button>
                </div>       
                </div>
            </div>
        </div>
    </section>

</div>


<script>
$('.datepicker').datepicker({
      autoclose: true
    });
$(".timepicker").timepicker({
      showInputs: false,
      showMeridian: false
    });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>