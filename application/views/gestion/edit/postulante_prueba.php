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
    <?php
  echo form_open('Gestion/postulante_prueba');
  ?>
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Postulante</h3>
              </div>
              <div class="box-body">
                <div class="row">
                <div class="col-md-3">
                      <div class="form-group">
                        <label>Fecha:</label>
        
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <?php 
                          if (!empty($postulante[0]['fecha_entrevista']) && $postulante[0]['fecha_entrevista'] != '0000-00-00') {
                            $date =  date_create($postulante[0]['fecha_entrevista']);
                            $fecha_entrevista = date_format($date, 'd-m-Y');
                          }
                          ?>
                          <input type="text" class="form-control pull-right" class="datepicker" name="fecha" value="<?php echo $fecha_entrevista ?>" disabled="disabled">
                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label>Rut</label>
                        <input class="form-control" type="text" name="rut" id="rut" value="<?php echo $postulante[0]['rut']?>">
                      </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input class="form-control" type="text" name="nombre" id="rut" value="<?php echo $postulante[0]['nombre']?>">
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
                                echo form_dropdown('evaluador',$usuarios,'',array('class' => 'form-control'));
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
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">ASSESSMENT CENTER (Simulación de Gestión de Cobranza Telefónica)</h3>
              </div>
              <div class="box-body">
              <label>COMPETENCIAS DE EVALUACIÓN FORMAL PARA EJECUTIVO DE CALL CENTER</label>
              <?php 
              echo '<table class="table" style="width:50%">';
              
                  
              foreach ($competencias as $comp) {
                echo '<tr>';
                echo '<th colspan="2">'.$comp['competencia'].'<th>';
                echo '</tr>'; 
                
                $valor_ponderacion = 0;
                $vponderacion = 0;
                $resultado_test = 0;
                $otro_result = 0;
                
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
                        <input class="form-control" onkeyup="calcula('<?php echo 'calificacion['.$c['id_competencias_item'].']'?>','<?php echo 'ponderacion['.$c['id_competencias_item'].']'?>','<?php echo 'total'.$comp['id_competencia'].''?>','<?php echo 'ritem'.$c['id_competencias_item'].'';?>','<?php echo 'grupo'.$comp['id_competencia']?>');" name="<?php echo 'calificacion['.$c['id_competencias_item'].']'?>" id="<?php echo 'calificacion['.$c['id_competencias_item'].']'?>" placeholder="calificación" style="width:100px" value="<?php echo $resultado_competencia[$c['id_competencias_item']]?>" />
                        <td>
                        <?php
                        echo '<td><input class="form-control" name="ponderacion['.$c['id_competencias_item'].']" id="ponderacion['.$c['id_competencias_item'].']" placeholder="ponderación" style="width:100px" value="'.$c['ponderacion'].'" disabled><td>';
                        
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
                
                
                echo '<tr>';
                echo '<th>Resultado<th>';
                echo '<th>
                <input class="form-control" type="hidden" name="grupo" id="grupo" value="grupo'.$comp['id_competencia'].'" style="width:70px;" disabled/>
                <input type="hidden" class="form-control" name="resultado'.$comp['id_competencia'].'" id="resultado'.$comp['id_competencia'].'" placeholder="Resultado" style="width:100px" value="" disabled>
                </th>';
                echo '<th>
                <input class="form-control" name="total'.$comp['id_competencia'].'" id="total'.$comp['id_competencia'].'" placeholder="total'.$comp['id_competencia'].'" value="'.$otro_result.'" style="width:100px" disabled>
                </tr>';         
              }
              
              
              echo '</table>';
              ?>
            </div>
          </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title" name="resultado_psicologica">COMENTARIOS DE LA EVALUACIÓN PSICOLOGICA Y RESULTADO FINAL</h3>
              </div>
              <div class="box-body">
                <textarea class="form-control" ></textarea>
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
        <textarea class="form-control"></textarea>
              
          </div>
        
              
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div> 
      <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                    <?php echo form_hidden('id_postulante',$id_postulante);?>
                        <button type="submit" class="btn btn-info pull-right">Guardar</button>
                    </div>
                         
                  </div>
      <!-- /.row -->
      </div>
      </div>
    </section>

<script>
$('.datepicker').datepicker({
      autoclose: true
});
$(".timepicker").timepicker({
      showInputs: false,
      showMeridian: false
    });
       
var vcalificacion = document.getElementById('#calificacion').value;
//var vponderacion = document.getElementById(ponderacion).value;     

$("."+grupo).each(
		function(index, value) {
			cantidad = cantidad + eval($(this).val());
		}
);
     
   
function calcula(calificacion,ponderacion,resultado_final,ritem,grupo){
    var vcalificacion = document.getElementById(calificacion).value;
    var vponderacion = document.getElementById(ponderacion).value;
    var resultadoi = Number(vcalificacion)*Number(vponderacion);
    
    $("#"+ritem).val(resultadoi.toFixed(1));    
    var resultadoj = Number(ritem);
    //$("#"+resultado_final).val(resultadoi.toFixed(1));
    calcula_grupo(grupo,resultado_final);
}
function calcula_grupo(grupo,resultado_final){    
    cantidad = 0
	$("."+grupo).each(
		function(index, value) {
			cantidad = cantidad + eval($(this).val());
		}
	);
    valor_final = cantidad/100;
	$("#"+resultado_final).val(valor_final.toFixed(2));    
}

</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>