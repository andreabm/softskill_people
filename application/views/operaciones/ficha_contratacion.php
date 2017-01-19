<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Ficha<small> de Contratacion</small></h1>
    </section>
   
    <?php 
    /*
    echo '<pre>';
        print_r($ejecutivo);
    echo '</pre>';
    */
    ?>

    <section class="content">
          <div class="row">
            <div class="col-xs-8">
                <div class="alert alert-danger alert-dismissible" id="alerta" style="display: none;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Atenci&oacute;n!</strong> El Rut ya se encuentra ingresado anteriormente.
                </div>
            </div><br />


            <div class="col-xs-8">
                <div class="alert alert-danger alert-dismissible" id="alerta_rut" style="display: none;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Atenci&oacute;n!</strong> El Rut es Incorrecto. Favor validar.
                </div>
            </div>            
          </div>
          <?php
          if(!empty($contratado)){
                $btn_bloqueo = 'disabled';
                $btn_label = 'Imprime';
                $formulario = 'Operaciones/imprime_ficha';
                $tarjet = array('target' =>'_blank');
                ?>
                <div id="alerta_sesion" class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Atenci&oacute;n,</strong> El Ejecutivo ya se encuentra contratado.
                </div>
                <?php
            }else{
                $btn_bloqueu = 'disabled';
                $btn_label = 'Guarda';
                $formulario = 'Operaciones/ficha_contratacion';
                $tarjet = '';
          }?>
        <?php
            echo form_open($formulario,$tarjet);
            echo form_hidden('id_ejecutivo', $id_ejecutivo);
            echo form_hidden('id_persona', $ejecutivo[0]['id_persona']);
            ?>  
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
                                    <input class="form-control" type="text" name="razon_social" id="razon_social" value="<?php echo $ejecutivo[0]['razon_social'] ?>" required/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nombres</label>                                   
                                    <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $ejecutivo[0]['nombre'] ?>" required/>                           
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Apellido Paterno</label>                                   
                                    <input class="form-control" type="text" name="paterno" id="paterno" value="<?php echo $ejecutivo[0]['paterno'] ?>" required/>                           
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Apellido Materno</label>                                   
                                    <input class="form-control" type="text" name="materno" id="materno" value="<?php echo $ejecutivo[0]['materno'] ?>" required/>                           
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cargo a Postular</label>                                   
                                    <input class="form-control" type="text" name="cargo" id="cargo" value="<?php echo $ejecutivo[0]['cargo'] ?>" required/>                           
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>R.U.T</label>
                                    <input class="form-control" type="text" name="rut" id="rut" value="<?php echo $ejecutivo[0]['rut'] ?>" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fecha de nacimiento</label>
                                    <input class="form-control datepicker" type="text" name="fecha_nacimiento" id="fecha_nacimiento" value="<?php echo $ejecutivo[0]['fecha_nacimiento'] ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Direcci&oacute;n</label>
                                    <input class="form-control" type="text" name="direccion" id="direccion" value="<?php echo $ejecutivo[0]['direccion'] ?>" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Comuna</label>
                                    <input class="form-control" type="text" name="comuna" id="comuna" value="<?php echo $ejecutivo[0]['comuna'] ?>" required/>
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
                                    <input class="form-control" type="text" name="movil" id="movil" value="<?php echo $ejecutivo[0]['fono_movil'] ?>" required/>
                                </div>
                            </div>  
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fijo</label>
                                    <input class="form-control" type="text" name="fijo" id="fijo" value="<?php echo $ejecutivo[0]['fono_fijo'] ?>" required/>
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
                                    <input class="form-control" type="text" name="soltero" id="soltero" value="<?php if($ejecutivo[0]['edo_civil']== 'Soltero'){  echo "X";}else{ echo " ";} ?>" required/>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Casado</label>
                                    <input class="form-control" type="text" name="casado" id="casado" value="<?php if($ejecutivo[0]['edo_civil']== 'Casado'){  echo "X";}else{ echo " ";} ?>" required/>
                                </div>
                            </div> 
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Con Hijos</label>
                                    <input class="form-control" type="text" name="con_hijos" id="con_hijos" value="<?php if($ejecutivo[0]['num_hijos']>0){echo "X";}else{ echo "0";} ?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>AFP</label>
                                    <input class="form-control" type="text" name="afp" id="afp" value="<?php echo $ejecutivo[0]['afp'] ?>" required/>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sistema de Salud</label>
                                    <input class="form-control" type="text" name="salud" id="salud" value="<?php echo $ejecutivo[0]['salud'] ?>" required/>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha de Contrato</label>
                                    <input class="form-control datepicker" type="text" name="fecha_contrato" id="fecha_contrato" value="<?php echo $ejecutivo[0]['fecha_ingreso'] ?>" required/>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PM/ROL</label>
                                    <input class="form-control" type="text" name="pm" id="pm" disabled value="<?php echo $ejecutivo[0]['nombre_pm'] ?>" required/>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Industria</label>
                                    <input class="form-control" type="text" name="centro_costo" disabled id="centro_costo" value="<?php echo $ejecutivo[0]['area'] ?>" required/>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>C&oacute;digo de Proyecto (COD SAP)</label>
                                    <input class="form-control" type="text" name="sap" id="sap" value="<?php echo $ejecutivo[0]['cod_sap'] ?>" required/>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Direcci&oacute;n Sucursal</label>
                                    <input class="form-control" type="text" name="sucursal" id="sucursal" disabled value="<?php echo $ejecutivo[0]['sucursal'] ?>" required/>
                                </div>
                            </div> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Departamento (&Aacute;rea de Apoyo)</label>
                                    <input class="form-control" type="text" name="apoyo" id="apoyo" value="<?php if(!empty($ejecutivo[0]['gerencia'])){echo $ejecutivo[0]['gerencia'];}else{echo '&nbsp';}?>" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Horario de Trabajo</label>
                                    <?php
                                    echo form_dropdown('turno_id',$turnos,$ejecutivo[0]['id_sucursal'],array('class' => 'form-control','required' => 'required'));
                                    ?>
        
                                </div>
                            </div>
                        </div>
                        <?php
                        if (!empty($ejecutivo[0]['motivo_contrato'])){
                            $motivo_contrato1 = explode(' ',$ejecutivo[0]['motivo_contrato'],2);
                            $motivo_contrato = $motivo_contrato1[0];
                            $obs = $motivo_contrato1[1];
                        } else {
                            $motivo_contrato = ''; 
                            $obs = '';
                        }
                        ?>
                        <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Sueldo Líquido</label>
                                <input class="form-control" type="text" name="sueldo_liquido" id="sueldo_liquido" value="<?php echo $ejecutivo[0]['sueldo_liquido'] ?>" required/>
                            </div>
                        </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3"> <h4>Motivo de la Contrataci&oacute;n:</h4></div>
                            <div class="col-md-8">
                              <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" name="motivo_contrato" value="renuncia" <?php if ($motivo_contrato == 'renuncia') { echo 'checked' ;} ?> required> Renuncia de:
                                    </span>
                                <input type="text" class="form-control" name="renuncia" <?php if ($motivo_contrato == 'renuncia') { echo 'value = "'.$obs.'"' ;} ?>>
                              </div><br />
                              <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" name="motivo_contrato" value="despido" <?php if ($motivo_contrato == 'despido') { echo 'checked' ;} ?> required> Despido de:
                                    </span>
                                <input type="text" class="form-control" name="despido" <?php if ($motivo_contrato == 'despido') { echo 'value = "'.$obs.'"' ;} ?>>
                              </div><br />
                              <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio"  name="motivo_contrato"  value="licencia" <?php if ($motivo_contrato == 'licencia') { echo 'checked' ;} ?> required> Licencia de:
                                    </span>
                                <input type="text" class="form-control" name="licencia" <?php if ($motivo_contrato == 'licencia') { echo 'value = "'.$obs.'"' ;} ?>>
                              </div><br />
                              <div class="input-group">
                                    <span class="input-group-addon" >
                                      <input type="radio" name="motivo_contrato" value="aumento" <?php if ($motivo_contrato == 'aumento') { echo 'checked' ;} ?> required> Aumento de Dotaci&oacute;n:
                                    </span>
                                <input type="text" class="form-control" name="aumento" <?php if ($motivo_contrato == 'aumento') { echo 'value = "'.$obs.'"' ;} ?>>
                              </div><br />
                              <div class="input-group">
                                    <span class="input-group-addon">
                                      <input type="radio" name="motivo_contrato" value="reemplazo" <?php if ($motivo_contrato == 'reemplazo') { echo 'checked' ;} ?> required> Por reemplazo:
                                    </span>
                                <input type="text" class="form-control" name="reemplazo" <?php if ($motivo_contrato == 'reemplazo') { echo 'value = "'.$obs.'"' ;} ?>>
                              </div><br />
                              <div class="input-group">
                                <span class="input-group-addon">
                                      <input type="radio" name="motivo_contrato" value="cargo_nuevo" <?php if ($motivo_contrato == 'cargo_nuevo') { echo 'checked' ;} ?> required> Cargo nuevo (especif&iacute;que):
                                    </span>
                                <input type="text" class="form-control" name="cargo_nuevo" <?php if($motivo_contrato=='cargo_nuevo') { echo 'value = "'.$obs.'"';} ?>>
                              </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                        
                       
                    
                    <div class="row">
                    <div class="col-md-3"> <h4>Nivel de aprobacion</h4></div>
                    </div>
                    <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Jefe directo</label>
                            <input class="form-control" type="text" name="jefe_directo" id="jefe_directo" value="<?php echo $ejecutivo[0]['jefe_directo'] ?>" required/>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form-group">
                            <label>Encargado area</label>
                            <input class="form-control" type="text" name="encargado_area" id="encargado_area" value="<?php echo $ejecutivo[0]['encargado_area'] ?>" required/>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="form-group">
                            <label>Coordinadora operativa / Otro</label>
                            <input class="form-control" type="text" name="coordinadora_operativa" id="coordinadora_operativa" value="<?php echo $ejecutivo[0]['coordinadora_operativa'] ?>" required/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Gerente ADM</label>
                            <input class="form-control" type="text" name="gerente_adm" id="gerente_adm" value="<?php echo $ejecutivo[0]['gerente_adm'] ?>" required/>
                        </div>
                    </div>
                    </div>
                
                <div class="row">
                <div class="col-md-10"></div>

                    <div class="col-md-2">                    
                        <button type="submit" class="btn btn-info pull-right"><?=$btn_label?></button>
                    </div>

                </div>

            </div>
        </div>
        <?php echo form_close();?>
    </section>

</div>


<script>
$(document).ready(function(){ 
$('.datepicker').datepicker({
        language: 'es',
        todayBtn: true,        
        autoclose: true,
        weekStart: 1,
        startDate: '01/01/1960',
        endDate: '01/01/2099',
    });
$(".timepicker").timepicker({
      showInputs: false,

    });    
});

$('#rut').Rut({
  on_error: function(){ 
    $('#alerta_rut').fadeIn();
    $('.verificar').fadeOut();
    setTimeout(function(){
        $("#alerta_rut").fadeOut(2000);},3000);
    },
  format_on: 'keyup'
});
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });

  function validar_rut(event){
    event.preventDefault();
    var edValue = document.getElementById("rut");
    var rut = edValue.value;    
    
    var muestra = document.getElementById("muestra");
    //muestra.innerText = "Campo rut ingresado: "+rut;
        
    var respuesta = document.getElementById("respuesta");
    $.ajax({
          url:"<?php echo base_url('index.php/gestion/valida_rut')?>",
          type: 'POST',
          data: {rut:rut},
          success: function(data){
            
            console.debug(data);
            data  = JSON.parse(data);          
            
            if (data.existe=='SI'){
                $('.verificar').hide();
                $('#alerta').fadeIn();
                setTimeout(function(){$("#alerta").fadeOut(2000);},3000);
                return false;
            } else {                
                $('.verificar').fadeIn();
                //respuesta.innerText = "Exito";
            }            
            
          },
          error: function(e) {
            alert('error');
            //$('#respuesta').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
          }
    });
}
</script>