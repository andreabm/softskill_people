<script>
$(document).ready(function() {
$('.datepicker').datepicker({
       
        format: 'yyyy-mm-dd',
        startDate: '0d',
        language: "es",
        autoclose: true
    });
});
</script>
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Prueba 
        <small> Psicologica</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
    <?php echo form_open('Gestion/postulante_prueba');?>
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Postulante</h3>
              </div>
              <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                      <label>Fecha:</label>
      
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <?php 
                        if (!empty($postulante[0]['fecha_entrevista']) && $postulante[0]['fecha_entrevista'] != '0000-00-00') {
                          $date =  date_create($postulante[0]['fecha_entrevista']);
                          $fecha_entrevista = date_format($date, 'Y-m-d');
                        }
                        ?>
                        <input type="text" class="form-control pull-right datepicker" name="fecha" value="<?php echo $fecha_entrevista ?>" disabled="disabled">
                      </div>
                      <!-- /.input group -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Rut</label>
                        <input class="form-control" type="text" name="rut" id="rut" value="<?php echo $postulante[0]['rut']?>">
                      </div>
                    </div>
              </div>
                <div class="row">                                   
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $postulante[0]['nombre']?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Apellido</label>
                            <input class="form-control" type="text" name="apellido" id="apellido" value="<?php echo $postulante[0]['paterno']?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Edad</label>
                            <?php
                            $fecha = date($postulante[0]['fecha_nacimiento']);
                            $hoy = date('Y-m-d');
                            $edad = $hoy - $fecha;
                            ?>
                            <input class="form-control" type="text" name="edad" id="edad" value="<?php echo $edad?>">                           
                        </div>
                    </div>
              </div>
              <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Estado Civil</label>
                            <select class="form-control" style="width: 100%;" name="estado_civil">
                            <?php
                            $edo_civil = array(
                                'Soltero' => 'Soltero',
                                'Casado' => 'Casado',
                                'Viudo' => 'Viudo'
                            );
                            foreach ($edo_civil as $e) {
                                if ($e == $postulante[0]['edo_civil']) {
                                    echo '<option selected="selected" value="'.$e.'">'.$e.'</option>';
                                } else {
                                    echo '<option value="'.$e.'">'.$e.'</option>';
                                }
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="form-group">
                                <label>Numero de Hijos</label>
                                <select class="form-control" style="width: 100%;" name="hijos">
                                <?php
                                $hijos = array(
                                   0 => 0,
                                   1 => 1,
                                   2 => 2,
                                   3 => 3,
                                   4 => 4,
                                   5 => 5,
                                   6 => 6,
                                   7 => 7
                                );
                                foreach ($hijos as $e) {
                                    if ($e == $postulante[0]['num_hijos']) {
                                        echo '<option selected="selected" value="'.$e.'">'.$e.'</option>';
                                    } else {
                                        echo '<option value="'.$e.'">'.$e.'</option>';
                                    }
                                }
                                ?>
                                </select>
                            </div>
                    </div>
                       <div class="col-md-3">
                        <div class="form-group">
                            <label>Edades</label>
                            <input class="form-control" type="text" name="edades_hijos" id="edades_hijos" value="<?php echo $postulante[0]['edad_hijos']?>">                           
                        </div>
                    </div>
              </div>

          </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
       <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Entrevistador</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Evaluador</label>
                                <?php
                                echo form_dropdown('evaluador',$evaluadores,'',array('class' => 'form-control'));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Tipo Ejecutivo</label>
                                <div class="form-group">
                                  <div class="radio">
                                    <label>
                                      <input type="radio" name="cargo" id="optionsRadios1" value="1" checked>
                                     CALL
                                    </label>
                                    <label>
                                      <input type="radio" name="cargo" id="optionsRadios1" value="2" checked>
                                     ESPECIALISTA
                                    </label>
                                  </div>
                                </div>
                            </div>                      
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Test</label>
                                <select class="form-control select2" name="pruebas[]" multiple="multiple" data-placeholder="Seleccione Test">
                                  <option value="entrevista">Entrevista</option>
                                  <option value="htp">HTP</option>
                                  <option value="script">Script</option>
                                  <option value="copc">COPC</option>
                                  <option value="otro">Otro</option>
                                </select>
                            </div>
                        </div>             
              </div>
            </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
          <div class="row">
              <?php 
              $total_cat = 0;          
              foreach ($competencias as $comp) {?>
              <div class="col-xs-12">
                <div class="box box-info">
                  <div class="box-header">
                      <h3 class="box-title">ASSESSMENT CENTER (Simulación de Gestión de Cobranza Telefónica)</h3>
                  </div>
              <div class="box-body">  
              <?php
                echo '<table class="table" style="width:50%">';
                echo '<tr>';
                echo '<th>'.$comp['competencia'].': '.$comp['ponderacion'].'%<th>';
                echo '<th><input type="hidden" class="form-control" name="ponderacion_categoria'.$comp['id_competencia'].'" id="ponderacion_categoria'.$comp['id_competencia'].'" value="'.$comp['ponderacion'].'" readonly disabled/><th>';
                echo '</tr>'; 
                
                $valor_ponderacion = 0;
                $vponderacion = 0;
                $resultado_test = 0;
                $otro_result = 0;
                
                $color = '';  
                if($comp['peso_prioridad']==1){
                   $color = 'style="background-color: #ffffcc; max-width:100px;"';  
                }
                
                foreach($competencias_item as $c){

                    if ($c['id_competencia'] == $comp['id_competencia']) {
                        echo '<tr>';
                        echo '<td>';
                            echo $c['descripcion'];
                        echo '</td>';
                        if (empty($resultado_competencia[$c['id_competencias_item']])) {
                            $resultado_competencia[$c['id_competencias_item']] = '';
                        }
                        
                        $var_1 = trim('calificacion['.$c['id_competencias_item'].']');
                        $var_2 = 'ponderacion['.$c['id_competencias_item'].']';
                                                             
                        ?>
                        <td>
                        <input class="form-control" <?php echo $color;?> autocomplete='off' onkeyup="calcula('<?php echo 'calificacion['.$c['id_competencias_item'].']'?>','<?php echo 'ponderacion['.$c['id_competencias_item'].']'?>','<?php echo 'total'.$comp['id_competencia'].''?>','<?php echo 'ritem'.$c['id_competencias_item'].'';?>','<?php echo 'grupo'.$comp['id_competencia']?>','<?php echo 'total_cat'.$comp['id_competencia'].''?>','<?php echo 'ponderacion_categoria'.$comp['id_competencia'].''?>'),prioridad('<?php echo 'total'.$comp['id_competencia'].''?>','prioridad_a<?php echo $comp['id_competencia']?>','<?php echo $comp['peso_prioridad'];?>','prioridad_b<?php echo $comp['id_competencia']?>');" name="<?php echo 'calificacion['.$c['id_competencias_item'].']'?>" id="<?php echo 'calificacion['.$c['id_competencias_item'].']'?>" placeholder="calificación" style="width:100px" value="<?php echo $resultado_competencia[$c['id_competencias_item']]?>" />
                        <td>
                        <?php
                        echo '<td><input type="hidden" class="form-control" name="ponderacion['.$c['id_competencias_item'].']" id="ponderacion['.$c['id_competencias_item'].']" placeholder="ponderación" style="width:100px" value="'.$c['ponderacion'].'" disabled><td>';
                        $resultado_test = $resultado_competencia[$c['id_competencias_item']]*$c['ponderacion'];                        
                        ?>
                        <td>
                        <input type="hidden" class="form-control grupo<?=$comp['id_competencia']?>" name="<?php echo 'ritem'.$c['id_competencias_item'].'';?>" id="<?php echo 'ritem'.$c['id_competencias_item'].'';?>" placeholder="<?php echo 'ritem'.$c['id_competencias_item'].'';?>" value="<?php echo $resultado_test?>" style="width:100px" disabled/>
                        <td>
                        <?php
                        echo '</tr>';                        
                        $vponderacion = $vponderacion + $c['ponderacion'];
                        $otro_result = $otro_result + $resultado_test;                     
                    }
                }
                $valor_ponderacion = $vponderacion*100;

                //$resultado_final = $otro_result/100;
                $resultado_final = number_format((float)$otro_result/100, 1, '.', '');                
                $por_cat = number_format((float)$resultado_final*$comp['ponderacion'], 1, '.', '');                
                $total_cat = $total_cat + $por_cat/100;
                $total_cat = number_format((float)$total_cat, 1, '.', '');                

                echo '<tr>';
                echo '<th>Resultado</th>';
                echo '<th>
                <input class="form-control" name="total'.$comp['id_competencia'].'" id="total'.$comp['id_competencia'].'" placeholder="total'.$comp['id_competencia'].'" value="'.$resultado_final.'" style="width:100px" disabled>
                <input class="form-control" type="hidden" name="grupo" id="grupo" value="grupo'.$comp['id_competencia'].'" style="width:70px;" disabled/>
                <input type="hidden" class="form-control" name="resultado'.$comp['id_competencia'].'" id="resultado'.$comp['id_competencia'].'" placeholder="Resultado" style="width:100px" value="" disabled>
                
                </th>';
                echo '<th>
                <input type="hidden" class="form-control agrupado" name="total_cat'.$comp['id_competencia'].'" id="total_cat'.$comp['id_competencia'].'" placeholder="total_cat'.$comp['id_competencia'].'" value="'.$por_cat.'" style="width:100px" disabled>
                </tr>';         

                echo '<tr>';
                echo '<th colspan="7">';
                ?>
                <div class="alert alert-danger alert-dismissible" id="prioridad_a<?php echo $comp['id_competencia']?>" style="display:none;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>No Califica</strong> No Logra obtener 5.0.
                </div>
                <div class="alert alert-success alert-dismissible" id="prioridad_b<?php echo $comp['id_competencia']?>" style="display:none;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Califica</strong> Logra obtener 5.0 o superior.
                </div>

                <?php
                echo '</th>';
                echo '</tr>';
                echo '</table>';
                ?>
                </div></div></div>
              <?php }
              
              
              ?>
            
        <!-- /.col -->
      </div>
      
    <div class="alert alert-success alert-dismissible" id="califica">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Califica como EJECUTIVO ESPECIALISTA</strong> Logra obtener 5.5 o superior.
    </div>
    <div class="alert alert-warning alert-dismissible" id="aprueba">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Aprueba como EJECUTIVO CALL</strong> Tiene aprobacion igual o superior a 5.0.
    </div>  
    
    <div class="alert alert-danger alert-dismissible" id="noaprueba">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>No Aprueba</strong> No alcanza a tener aprobación 5.
    </div>
    

      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title" name="resultado_psicologica">COMENTARIOS DE LA EVALUACIÓN PSICOLOGICA Y RESULTADO FINAL</h3>
              </div>
              <div class="box-body">
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Nota Final</label>
                      <input class="form-control" name="aprobacion" id="aprobacion" value="<?=$total_cat?>" readonly /> 
                  </div>
                </div><br/><br/>

                <div class="col-md-12">
                <textarea class="form-control" name="comentario" id="comentario">Nota final <?=$total_cat?>, </textarea>
                </div>

              </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Otros</h3>
              </div>
        <div class="box-body">
          <div class="col-md-12">
            <textarea class="form-control" name="otro" id="otro"></textarea>
          </div>   

          </div>
        
              
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div> 
      <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                    <?php echo form_hidden('id_postulante',$id_postulante);?>
                        <button type="submit" class="btn btn-info pull-right" id="guardar">Guardar</button>
                    </div>
                         
                  </div>
      <!-- /.row -->
      </div>
      </div>
    </section>

<script>
$(document).ready(function(){  
$('.datepicker').datepicker({
        todayBtn: true,
        language: "es",
        autoclose: true
    });
$(".timepicker").timepicker({
      showInputs: false,

    });
}); 

$('#califica').hide();
$('#aprueba').hide(); 
$('#noaprueba').hide();    
       
var vcalificacion = document.getElementById('#calificacion').value;    

$("."+grupo).each(
		function(index, value) {
			cantidad = cantidad + eval($(this).val());
		}
);
function prioridad(val,valert,vprioridad,valert2){
  var valor_to = document.getElementById(val).value;
    if(vprioridad==1){
        if(valor_to < 5){
          $('#'+valert).fadeIn();
          $('#'+valert2).hide();
          //setTimeout(function(){$('#'+valert).fadeOut();},10000);
        }else{
          $('#'+valert2).fadeIn();
          $('#'+valert).hide();
          //setTimeout(function(){$('#'+valert2).fadeOut();},10000);
        }
    }
}   
   
function calcula(calificacion,ponderacion,resultado_final,ritem,grupo,total_cat,ponderacion_cat){
    var vponcat = document.getElementById(ponderacion_cat).value;    
    var vcalificacion = document.getElementById(calificacion).value;
    var vponderacion = document.getElementById(ponderacion).value;
    var resultadoi = Number(vcalificacion)*Number(vponderacion);
    
    $("#"+ritem).val(resultadoi.toFixed(1));    
    var resultadoj = Number(ritem);
    //$("#"+resultado_final).val(resultadoi.toFixed(1));
    calcula_grupo(grupo,resultado_final,total_cat,vponcat);
}
function calcula_grupo(grupo,resultado_final,total_cat,vponcat){
    //alert(vponcat);
    cantidad = 0;
	$("."+grupo).each(
		function(index, value) {
			cantidad = cantidad + eval($(this).val());
		}
	);
    valor_final = cantidad/100;
	$("#"+resultado_final).val(valor_final.toFixed(1));
    
    //alert(valor_final);
    valor_aprobacion = valor_final*vponcat;
    $("#"+total_cat).val(valor_aprobacion.toFixed(1));

    totalizar = 0;
	$(".agrupado").each(
		function(index, value) {
			totalizar = totalizar + eval($(this).val());
		}
	);
    total_aprobacion = totalizar/100;
    
    if(total_aprobacion>5.5){
        $('#califica').fadeIn();
        $('#aprueba').hide(); 
        $('#noaprueba').hide();
        setTimeout(function(){$('#califica').fadeOut();},20000);
        $('#guardar').prop("disabled", false);
    }else if(total_aprobacion<5.5 && total_aprobacion>=5){
        $('#aprueba').fadeIn();
        $('#califica').hide(); 
        $('#noaprueba').hide();
        setTimeout(function(){$('#aprueba').fadeOut();},20000);
        $('#guardar').prop("disabled", false);
    }else{
        $('#noaprueba').fadeIn();
        $('#califica').hide(); 
        $('#aprueba').hide();
        setTimeout(function(){$('#noaprueba').fadeOut();},20000);
        $('#guardar').prop("disabled", true);
    }    
        $("#aprobacion").val(total_aprobacion.toFixed(1));
        $("#comentario").val('Nota final '+total_aprobacion.toFixed(1)+', ');
}
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>