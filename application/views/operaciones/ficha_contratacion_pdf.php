 <div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <center><h1>Ficha<small> de Contratacion</small></h1></center>
    </section>
   <h3 class="box-title">Solicitud de Contrataci&oacute;n</h3>

   <table style="width:400px;">  
    <tr>
        <th align="left">RAZ&Oacute;N SOCIAL</th>
        <td align="left">Servicios de control de creditos S.A</td>        
    </tr>
   </table>
	<br>
   <table style="width:100%;" class="table">  
    <tr>
        <th align="left">Apellido Paterno</th>
        <th align="left">Apellido Materno</th>
        <th align="left">Nombres</th>
    </tr>
    <tr>
        <td align="left"><?php if(!empty($ejecutivo[0]['paterno'])){echo $ejecutivo[0]['paterno'];} ?></td>
        <td align="left"><?php if(!empty($ejecutivo[0]['materno'])){echo $ejecutivo[0]['materno'];} ?></td>
        <td align="left"><?php if(!empty($ejecutivo[0]['nombre'])){echo $ejecutivo[0]['nombre'];} ?></td>
    </tr>
    <tr>
        <th align="left">Rut</th>
        
        <th align="left" >Fecha nacimiento</th>
       <th></th>
    </tr>
	<tr>
       <td align="left" ><?php if(!empty($ejecutivo[0]['rut'])){echo $ejecutivo[0]['rut'];}?></td>
         <td align="left"><?php if(!empty($ejecutivo[0]['fecha_nacimiento'])){echo $ejecutivo[0]['fecha_nacimiento'];}?></td>
        <td align="left"></td>
    </tr>
    <tr>
        <th align="left">Direcci&oacute;n</th>
        <th align="left">Comuna/Ciudad</th>
		<th></th>
    </tr>
    <tr>
        <td align="left"><?php if(!empty($ejecutivo[0]['direccion'])){echo $ejecutivo[0]['direccion'];}?></td>
        <td align="left"><?php if(!empty($ejecutivo[0]['comuna'])){echo $ejecutivo[0]['comuna'];}?></td>
		<td></td>
    </tr>

	<tr>
        <th align="left">Telefono casa</th>
        <th align="left">Celular</th>
		<th></th>
    </tr>
    <tr>
        <td align="left"><?php if(!empty($ejecutivo[0]['fono_fijo'])){echo $ejecutivo[0]['fono_fijo'];}else{echo '&nbsp;';}?></td>
        <td align="left" ><?php if(!empty($ejecutivo[0]['fono_movil'])){echo $ejecutivo[0]['fono_movil'];}else{echo '&nbsp;';}?></td>
		<td></td>
	</tr>

    <tr>
        <th align="left">Estado Civil</th>
        <th align="left">Con Hijos</th>
        <th></th>
    </tr>
    <tr>
        <td align="left"><?php if(!empty($ejecutivo[0]['edo_civil'])){echo $ejecutivo[0]['edo_civil'];}else{echo '&nbsp;';}?></td>
        <td align="left" ><?php if(!empty($ejecutivo[0]['num_hijos'])){echo $ejecutivo[0]['num_hijos'];}else{echo 'No';}?></td>
        <td></td>
    </tr>

    </table>
	<br>
   <table style="width:100%;">     
    <tr>    
        <th align="left">Afp</th>
        <td align="left"><?php echo $afps[0]['nombre_entidad'] ?></td>
        <th  align="left">Salud</th>
        <td  align="left"><?php echo $salud[0]['nombre_entidad'] ?></td>
        <th  align="left">F. contrato</th>
        <td  align="left"><?php echo $ejecutivo[0]['fecha_ingreso'] ?></td>
    </tr>
    </table>
	<br>
   <table style="width:100%;">     
    <tr>    
        <th align="left">Cargo Postulado</th>
        <td align="left"><?php echo $ejecutivo[0]['cargo'];?></td>
        <th align="left">Plazo de Contrato</th>
        <td align="left"></td>
    </tr>

    <tr>    
        <th align="left">Pm/Rol</th>
        <td align="left"><?php if(!empty($ejecutivo[0]['nombre_pm'])){echo $ejecutivo[0]['nombre_pm'];}else{echo '&nbsp;';}?></td>
        <th align="left">Industria</th>
        <td align="left"><?php if(!empty($ejecutivo[0]['area'])){echo $ejecutivo[0]['area'];}else{echo '&nbsp;';}?></td>
    </tr>


    <tr>    
        <th align="left">Cod. Proyecto</th>
        <td align="left"><?php echo $ejecutivo[0]['cod_sap'];?></td>
        <th align="left">Direcci&oacute;n sucursal</th>
        <td align="left"><?php echo $ejecutivo[0]['sucursal'];?></td>
    </tr>
    <tr>
        <th align="left" colspan="2">Departamento (<span style="font-size: 12pt;"><i>Solo area de apoyo</i></span>)</th>
        <td  align="left" colspan="2"><?php if(!empty($ejecutivo[0]['gerencia'])){echo $ejecutivo[0]['gerencia'];}else{echo '&nbsp;';}?></td>
    </tr>

    <tr>    
        <th align="left">Horario de trabajo</th>
        <td align="left"><?php echo $ejecutivo[0]['turno'];?></td>
        <th align="left">S&aacute;bado</th>
        <td align="left"></td>
    </tr>

    </table>

    <?php
        if (!empty($ejecutivo[0]['motivo_contrato'])){
            $motivo_contrato1 = explode(' ',$ejecutivo[0]['motivo_contrato'],2);
            //print_r($motivo_contrato1);
            $motivo_contrato = $motivo_contrato1[0];
            $obs = $motivo_contrato1[1];
        }else{
            $motivo_contrato = ''; 
            $obs = '';
        }?>

    <table style="width:100%;"> 
        <tr>    
        <td width="40" colspan="6">Motivo de la contrataci&oacute;</td>
        </tr>
    <tr>    
        <td width="20"><input type="checkbox" value="renuncia" <?php if ($motivo_contrato == 'renuncia') { echo 'checked' ;} ?>></td>
        <td width="60">Renuncia de</td>
        <td width="190"><input style="width:190px;" class="form-control" type="text" name="renuncia" value="<?php if ($motivo_contrato == 'renuncia') { echo 'value = "'.$obs.'"' ;} ?>" /></td>
        <td width="20"><input type="checkbox" value="despido" <?php if ($motivo_contrato == 'despido') { echo 'checked' ;} ?>></td>
        <td width="60">Despido de</td>
        <td width="176"><input style="width:176px;" class="form-control" type="text" name="despido" id="odespido" value="<?php if ($motivo_contrato == 'despido') { echo $obs ;} ?>" /></td>
    </tr>
    <tr>    
        <td width="20"><input type="checkbox" value="licencia" <?php if ($motivo_contrato == 'licencia') { echo 'checked' ;} ?>></td>
        <td width="60">Licencia de</td>
        <td width="190"><input style="width:190px;" class="form-control" type="text" name="licencia" <?php if ($motivo_contrato == 'licencia') { echo 'value = "'.$obs.'"' ;} ?> /></td>
        <td width="20"><input type="checkbox" value="aumento" <?php if ($motivo_contrato == 'aumento') { echo 'checked' ;} ?>></td>
        <td width="60">Aumento dotaci&oacute;n</td>
        <td width="176"><input style="width:176px;" class="form-control" type="text" name="aumento" id="aumento" <?php if ($motivo_contrato == 'aumento') { echo 'value = "'.$obs.'"' ;} ?>/></td>
    </tr>
    <tr>    
        <td width="20"><input type="checkbox" <?php if ($motivo_contrato == 'reemplazo') { echo 'checked' ;} ?>></td>
        <td width="60">Por remplazo</td>
        <td width="190"><input style="width:190px;" class="form-control" type="text" name="reemplazo" <?php if ($motivo_contrato == 'reemplazo') { echo 'value = "'.$obs.'"' ;} ?> /></td>
        <td width="20"><input type="checkbox" <?php if ($motivo_contrato == 'cargo_nuevo') { echo 'checked' ;} ?>></td>
        <td width="60">Cargo nuevo</td>
        <td width="176"><input style="width:176px;" class="form-control" type="text" name="cargo_nuevo" id="cargo_nuevo" <?php if($motivo_contrato == 'cargo_nuevo') { echo 'value = "'.$obs.'"' ;} ?> /></td>
    </tr>
    <tr>
           <td colspan="2">&nbsp;</td>     
        </tr>
    </table>

    <table style="width:674px" cellspacing="0">
        <tr >
           <td style="border: 1px solid black;">Bonos (Adjunta tabla de bono)</td> 
           <td style="border: 1px solid black;">111</td>
        </tr>
        <tr>
           <td style="border: 1px solid black;">Remuneracion base</td> 
           <td style="border: 1px solid black;">22</td>
        </tr>
        <tr>
           <td colspan="2">&nbsp;</td>     
        </tr>
    </table>

    <table style="width:100%;">
    <tr>    
        <td width="230"><span style="font-size: 12pt;">Para remuneraciones fijas indicar sueldo liquido</span></td>
        <td width="200">
            <input style="width:300px;" class="form-control" type="text" name="afp" id="afp" value="$ <?php echo number_format($ejecutivo[0]['sueldo_liquido'], 0, '', '.');?>" /></td>
    </tr>
    <tr>    
        <td width="230"><span style="font-size: 12pt;">El sueldo base ser&aacute; calculado por recursos humanos</span></td>
        <td width="200"><input style="width:300px;" class="form-control" type="text" name="salud" id="salud" value="$"/></td>
    </tr>
      <tr>
        <td colspan="2">&nbsp;</td>     
      </tr>
    </table>

   <table style="width:100%; margin-top:110px;" cellspacing="0">
    <tr>    
        <td width="100" style="border: 1px solid black;" align="center"><span style="font-size: 12pt;">Jefe Directo</span></td>
        <td width="100" style="border: 1px solid black;" align="center"><span style="font-size: 12pt;">Encargado del Area</span></td>
        <td width="100" style="border: 1px solid black;" align="center"><span style="font-size: 12pt;">Coordinadora Operativa</span></td>
        <td width="100" style="border: 1px solid black;" align="center"><span style="font-size: 12pt;">Gerente Adm.</span></td>
        
    </tr>
    <tr>
        <td style="border: 1px solid black; font-size: 10pt;">Nombre: <?php echo $ejecutivo[0]['jefe_directo'];?></td>
        <td style="border: 1px solid black; font-size: 10pt;">Nombre: <?php echo $ejecutivo[0]['encargado_area'];?></td>
        <td style="border: 1px solid black; font-size: 10pt;">Nombre: <?php echo $ejecutivo[0]['coordinadora_operativa'];?></td>
        <td style="border: 1px solid black; font-size: 10pt;">Nombre: <?php echo $ejecutivo[0]['gerente_adm'];?></td>
    </tr>
    <tr>
        <td style="border: 1px solid black; font-size: 10pt;">Fecha:</td>
        <td style="border: 1px solid black; font-size: 10pt;">Fecha:</td>
        <td style="border: 1px solid black; font-size: 10pt;">Fecha:</td>
        <td style="border: 1px solid black; font-size: 10pt;">Fecha:</td>
    </tr>
    <tr>
        <td style="border: 1px solid black; font-size: 10pt;">Firma:<br/><br/><br/></td>
        <td style="border: 1px solid black; font-size: 10pt;">Firma:<br/><br/><br/></td>
        <td style="border: 1px solid black; font-size: 10pt;">Firma:<br/><br/><br/></td>
        <td style="border: 1px solid black; font-size: 10pt;">Firma:<br/><br/><br/></td>
    </tr>
      <tr>
        <td colspan="4">&nbsp;</td>     
      </tr>
    </table>

    <table style="width:100%; border: 1px solid black;" cellspacing="0">
        <tr>    
            <td width="100" align="left"><span style="font-size: 12pt;">USO EXCLUSIVO RRHH</span></td>
            <td width="100">&nbsp;</td>
            <td width="100">&nbsp;</td>
        </tr>
        <tr>
            <td><br>Timbre y recepci&oacute;n</td>
            <td style="border: 1px solid black; width:80px; height:80px;">&nbsp;</td>
            <td></td>    
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>    
        </tr>
      <tr>
        <td colspan="3">&nbsp;</td>     
      </tr>
    </table>
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