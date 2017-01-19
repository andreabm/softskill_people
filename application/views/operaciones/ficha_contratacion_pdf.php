 
 <?php 
 /*
 echo '<pre>';
 print_r($ejecutivo);
 echo '</pre>';
 */
 ?>

 <div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header">
      <center><h1>Ficha<small> de Contratacion</small></h1></center>
    </section>
   <h3 class="box-title">Solicitud de Contrataci&oacute;n</h3>

   <table style="width:500px;">  
    <tr>
        <th align="left">RAZ&Oacute;N SOCIAL</th>
        <td align="left">test</td>
        
    </tr>
   </table>

   <table style="width:100%;">  
    <tr>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Nombres</th>
    </tr>
    <tr>
        <td><?php if(!empty($ejecutivo[0]['paterno'])){echo $ejecutivo[0]['paterno'];} ?></td>
        <td><?php if(!empty($ejecutivo[0]['materno'])){echo $ejecutivo[0]['materno'];} ?></td>
        <td><?php if(!empty($ejecutivo[0]['nombre'])){echo $ejecutivo[0]['nombre'];} ?></td>
    </tr>
   </table>
    <table style="width:100%;">  
    <tr>
        <th>Rut</th>
        <td><?php if(!empty($ejecutivo[0]['rut'])){echo $ejecutivo[0]['rut'];}?></td>
        <th>Fecha nacimiento</th>
        <td><?php if(!empty($ejecutivo[0]['fecha_nacimiento'])){echo $ejecutivo[0]['fecha_nacimiento'];}?></td>
    </tr>
   </table>

   <table style="width:100%;">  
    <tr>
        <th>Direcci&oacute;n</th>
        <th>Comuna/Ciudad</th>
    </tr>
    <tr>
        <td><?php if(!empty($ejecutivo[0]['direccion'])){echo $ejecutivo[0]['direccion'];}?></td>
        <td><?php if(!empty($ejecutivo[0]['comuna'])){echo $ejecutivo[0]['comuna'];}?></td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
   </table>

    <table style="width:100%;">  
    <tr>
        <td>Tel&eacute;fonos</td>
        <td>Casa</td>
        <td><input class="form-control" type="text" name="tcasa" id="tcasa" value="<?php if(!empty($ejecutivo[0]['fono_fijo'])){echo $ejecutivo[0]['fono_fijo'];}?>"/></td>
        <td>Celular</td>
        <td><input class="form-control" type="text" name="tcelular" id="tcelular" value="<?php if(!empty($ejecutivo[0]['fono_movil'])){echo $ejecutivo[0]['fono_movil'];}?>"/></td>
    </tr>
    </table>

    <table style="width:100%;">  
    <tr>
        <td colspan="6">Estado civil</td>
    </tr>    
    <tr>    
        <td width="40">Soltero</td>
        <td width="110"><input style="width:120px;" class="form-control" type="text" name="tcasa" id="tcasa" value="<?php if($ejecutivo[0]['edo_civil']=='Soltero'){  echo "X";}else{ echo "&nbsp;";} ?>" /></td>
        <td width="40">Casado</td>
        <td width="110"><input style="width:120px;" class="form-control" type="text" name="tcelular" id="tcelular" value="<?php if($ejecutivo[0]['edo_civil']=='Casado'){  echo "X";}else{ echo "&nbsp;";} ?>"/></td>
        <td width="40">Con Hijos</td>
        <td width="110">
            

            <input style="width:120px;" class="form-control" type="text" name="chijos" id="chijos" value="<?php if($ejecutivo[0]['num_hijos']>0){  echo "X";}else{echo "0";} ?>"/></td>
    </tr>
    </table>

   <table style="width:100%;">     
    <tr>    
        <td width="40">Afp</td>
        <td width="110"><input style="width:120px;" class="form-control" type="text" name="afp" id="afp" value="<?php echo $ejecutivo[0]['afp'] ?>" /></td>
        <td width="40">Salud</td>
        <td width="110"><input style="width:120px;" class="form-control" type="text" name="salud" id="salud" value="<?php echo $ejecutivo[0]['salud'] ?>"/></td>
        <td width="40">F. contrato</td>
        <td width="110"><input style="width:120px;" class="form-control" type="text" name="fcontrato" id="fcontrato" value="<?php echo $ejecutivo[0]['fecha_ingreso'] ?>"/></td>
    </tr>
    </table>

   <table style="width:100%;">     
    <tr>    
        <td width="40">Cargo Postulado</td>
        <td width="110"><input style="width:230px;" class="form-control" type="text" name="afp" id="afp" value="<?php echo $ejecutivo[0]['cargo'];?>" /></td>
        <td width="40">Plazo de Contrato</td>
        <td width="110"><input style="width:230px;" class="form-control" type="text" name="salud" id="salud" value="&nbsp;"/></td>
    </tr>
    <tr>    
        <td width="40">Pm/Rol</td>
        <td width="110"><input style="width:230px;" class="form-control" type="text" name="afp" id="afp" value="<?php echo $ejecutivo[0]['nombre_pm'];?>" /></td>
        <td width="40">Industria</td>
        <td width="110"><input style="width:230px;" class="form-control" type="text" name="salud" id="salud" value="<?php echo $ejecutivo[0]['area'];?>"/></td>
    </tr>
    <tr>    
        <td width="40">Cod. Proyecto</td>
        <td width="110"><input style="width:230px;" class="form-control" type="text" name="afp" id="afp" value="<?php echo $ejecutivo[0]['cod_sap'];?>" /></td>
        <td width="40">Direcci&oacute;n sucursal</td>
        <td width="110"><input style="width:230px;" class="form-control" type="text" name="salud" id="salud" value="<?php echo $ejecutivo[0]['sucursal'];?>"/></td>
    </tr>
    <tr>
        <td colspan="2">Departamento (<span style="font-size: 12pt;"><i>Solo area de apoyo</i></span>)</td>
        <td colspan="2"><input style="width:312px;" class="form-control" type="text" name="salud" id="salud" value="<?php echo $ejecutivo[0]['gerencia'];?>"/></td>
    </tr>

    <tr>    
        <td width="40">Horario de trabajo</td>
        <td width="110"><input style="width:230px;" class="form-control" type="text" name="afp" id="afp" value="<?php echo $ejecutivo[0]['turno'];?>" /></td>
         <td width="40">S&aacute;bado</td>
        <td width="110"><input style="width:230px;" class="form-control" type="text" name="salud" id="salud" value="&nbsp;"/></td>
    </tr>

    </table>

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
        <td width="176"><input style="width:176px;" class="form-control" type="text" name="despido" id="odespido" value="<?php if ($motivo_contrato == 'despido') { echo 'value = "'.$obs.'"' ;} ?>" /></td>
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
    </table><br/><br/><br/>

   <table style="width:100%;" cellspacing="0">
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