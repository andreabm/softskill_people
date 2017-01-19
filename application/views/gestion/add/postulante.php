 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Postulaci&oacute;n 
        <small> de Empleo</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
    <script type="text/javascript">
$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});
    </script>
 <?php echo form_open('Gestion/agregar_postulante');?>  
  <div class="row">
    <div class="col-xs-8">
        <div class="alert alert-danger alert-dismissible" id="alerta" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Atenci&oacute;n!</strong> El Rut ya se encuentra ingresado anteriormente. <a class= "btn btn-xs primary" href="#"data-toggle="modal" data-target="#verPostulante" onclick = "verPostulante()">VER PERSONA</a>
        </div>
    </div><br />
    <div class="col-xs-8">
        <div class="alert alert-danger alert-dismissible" id="alerta_rut" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Atenci&oacute;n!</strong> El Rut es Incorrecto. Favor validar.
        </div>
    </div>
    
  </div>
  
      <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Antecedentes Personales</h3>
              </div>
              <div class="box-body">
              
              <div class="row">                
                <div class="col-md-3">
                    <div class="form-group">
                        <span id="respuesta"></span>
                        <span id="muestra"></span>
                
                    <label>Rut:</label>
                    <div class="input-group">
                      <input type="hidden" id="prueba" name="prueba" value="0" />

                      <input type="text" id="rut" name="rut" class="form-control" placeholder="Rut" autocomplete="off" onkeyup="texto_rut(event);" />

					            <input type="hidden" id="id_postulante">
                      <span class="input-group-addon" id="basic-addon2"><a href="#" onclick="validar_rut(event),texto_rut(event);">Validar</a></span>
                    </div>
                </div>
              </div>
              </div>  
              
                <div class="row verificar">                
                  <div class="col-md-4 ">
                        <div class="form-group">
                            <label>Nombres</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombres" />
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>Apellido Paterno</label>
                            <input class="form-control" type="text" name="paterno" id="paterno" placeholder="Apellido Paterno" />
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>Apellido Materno</label>
                            <input class="form-control" type="text" name="materno" id="materno" placeholder="Apellido Materno" />
                        </div>
                    </div>
                </div>
                    
                <div class="row verificar">                
                
                <div class="col-md-4">
                      <div class="form-group">
                        <label>Fecha:</label>
        
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" class="datepicker" name="fecha" value="<?php echo date('d-m-Y') ?>" disabled="disabled" />
                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                                        
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>Edad</label>
                            <input class="form-control" type="text" name="edad" id="edad" placeholder="Edad" />                           
                        </div>
                    </div>                    
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" name="email" id="email" placeholder="Email" />
                        </div>
                    </div>
              </div>              
              <div class="row verificar">

                <div class="col-md-4">
                      <div class="form-group">
                        <label>Fecha de Nacimiento:</label>
                    
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right datepicker" name="fecha_nac" />
                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Sexo</label>
                            <select class="form-control" style="width: 100%;" name="sexo">
                                  <option selected="selected">Femenino</option>
                                  <option>Masculino</option>
                            </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Estado Civil</label>
                            <select class="form-control" style="width: 100%;" name="estado_civil">
                                  <option selected="selected">Soltero</option>
                                  <option>Casado</option>
                                  <option>Viudo</option>
                            </select>
                        </div>
                    </div>
              </div>
                  
              <div class="row verificar">
                <div class="col-md-3">
                        <div class="form-group">
                            <label>Nacionalidad</label>
                            <input class="form-control" type="text" name="nacionalidad" id="nacionalidad" placeholder="Nacionalidad">                           
                        </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Direcci&oacute;n</label>
                      <input type="text" class="form-control" placeholder="Direccion" name="direccion">
                    </div>
                 </div>
                 <div class="col-md-3">
                    <label>Comuna</label>
                    <?php
                    echo form_dropdown('comuna',$comunas,'',array('class' => 'form-control','id' => 'comuna'));
                    ?>
                 </div>
              </div>
              <div class="row verificar">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Celular</label>
                            <input class="form-control" type="text" name="celular" id="celular" placeholder="Celular">                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fono Fijo</label>
                            <input class="form-control" type="text" name="fono" id="fono" placeholder="Fono">                           
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="form-group">
                                <label>Numero de Hijos</label>
                                <select class="form-control" style="width: 100%;" name="hijos">
                                <option value="0" selected="selected">0</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                </select>
                            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Edades</label>
                            <input class="form-control" type="text" name="edades_hijos" id="edades_hijos" placeholder="Edades">                           
                        </div>
                    </div>
              </div>
              <div class="row verificar">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>¿Tiene Alguna Discapacidad?</label>
                            <input class="form-control" type="text" name="discapacidad" id="discapacidad" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>¿Tiene Alguna Enfermedad Importante?</label>
                            <input class="form-control" type="text" name="enfermedad" id="enfermedad" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Indique Nombre y Contacto Familiar</label>
                            <input class="form-control" type="text" name="familiar" id="familiar" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cargo que Postula</label>
                            <?php
                                echo form_dropdown('id_cargo',$cargos,'',array('class' => 'form-control','id' => 'comuna'));
                            ?>                         
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
      
      <!--hobbies-->
      <div class="row verificar">
      
            <div class="col-xs-8">
        <div class="alert alert-danger alert-dismissible" id="alerta_hobbies" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Atenci&oacute;n!</strong> El Hobbie esta vacio. Favor validar.
        </div>
    </div>
    <div class="col-xs-8">
        <div class="alert alert-danger alert-dismissible" id="alerta_hobbies_r" style="display: none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Atenci&oacute;n!</strong> El Hobbie ya se encuentra registrado o no cumple con requisitos. Favor validar
        </div>
    </div>
      
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Hobbies</h3>
              </div>
              <div class="box-body">
                <div class="row" id="muestra_hobbies">
                        <?php
                            foreach($hobbies as $k=>$a){
                                $app = array(
                                'name' => 'hobbies['.$k.']',
                                'value' => ''.$a.''
                                );
                                echo "<div class='col-md-1'>";
                                echo form_checkbox($app);
                                echo $a."</div>";
                            }
                         ?>
                    </div>
                 <div class="row"><br />
                    <div class="col-xs-4">
                        <div class="input-group">
                          <input type="text" id="otro_hobbie" name="otro_hobbie" class="form-control" placeholder="Otro Hobbie" autocomplete="off"/>
                          <span class="input-group-addon" id="basic-addon2"><a href="#" onclick="agregar_hobbie(event)">Agregar Otro Hobbie</a></span>
                        </div>
                    </div>
                 </div>   
                    
                    
              </div>
          </div>
            <!-- /.box-body -->
      <!--hobbies_fin-->
      </div>
      
      <!--expectativas-->
      <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Expectativas</h3>
              </div>
              <div class="box-body">
                
                <div class="row">
                    
                <div class="col-xs-8">
                    <div class="alert alert-danger alert-dismissible" id="alerta_factor" style="display: none;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Atenci&oacute;n!</strong> El Hobbie esta vacio. Favor validar.
                    </div>
                </div>
                <div class="col-xs-8">
                    <div class="alert alert-danger alert-dismissible" id="alerta_factor_r" style="display: none;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Atenci&oacute;n!</strong> El Hobbie ya se encuentra registrado o no cumple con requisitos. Favor validar
                    </div>
                </div>
                    
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>¿Qué espera de su trabajo?</label>
                            <input class="form-control" type="text" name="espera" id="espera" />                           
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>¿Qué condiciones valora en su lugar de trabajo?</label>
                            <input class="form-control" type="text" name="valora" id="valora" />                         
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>¿Qué condiciones hace que usted no decía irse de su trabajo ?</label>
                            <input class="form-control" type="text" name="condiciones" id="condiciones" />                         
                        </div>
                    </div>
                    
                </div>
                              
                <div class="row" id="muestra_factor">
                
                        <?php
                        $check = array();
                        $factor_seleccionadas = array();
                        foreach($factor_seleccionadas as $b){
                            $check[] = $b['id_factor'];        
                        }                               
                 
                        foreach($factor as $k=>$a){              
                        if (in_array($k,$check)) {
                            $checked = 'checked';
                        } else {
                            $checked = '';
                        }
                        $app = array(      
                            'name' => 'factor['.$k.']',
                            'value' => ''.$a.'',
                            'checked' => ''.$checked.''
                        );
                        echo "<div class='col-md-1'>";
                        echo form_checkbox($app);
                        echo $a."</div>";
                    
                        }
                        ?>  
                    </div>
                 <div class="row"><br />
                    <div class="col-xs-4">
                        <div class="input-group">
                          <input type="text" id="otro_factor" name="otro_factor" class="form-control" placeholder="Otro Factor" autocomplete="off"/>
                          <span class="input-group-addon" id="basic-addon2"><a href="#" onclick="agregar_factor(event)">Agregar Otro Factor</a></span>
                        </div>
                    </div>
                 </div>   
                    
                    
              </div>
          </div>
      <!--expectativas_fin-->
      
       <div class="row verificar">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Antecedentes Academicos</h3>
              </div>
              <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Educaci&oacute;n Media</label>
                            <select class="form-control" style="width: 100%;" name="educacion_media">
                              <option value="INCOMPLETA" selected="selected">Incompleta</option>
                              <option value="COMPLETA">Completa</option>
                              <option value="EN CURSO">En Curso</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Media T&eacute;cnica</label>
                            <input class="form-control" type="text" name="media_tecnica" id="media_tecnica" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Educaci&oacute;n Superior</label>
                            <select class="form-control" style="width: 100%;" name="educacion_superior">
                              <option value="INCOMPLETA" selected="selected">Incompleta</option>
                              <option value="COMPLETA">Completa</option>
                              <option value="EN CURSO">En Curso</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Carrera</label>
                            <input class="form-control" type="text" name="carrera" id="carrera" >                           
                        </div>
                    </div>
              </div>
              <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Otro (Indicar)</label>
                            <input class="form-control" type="text" name="otro" id="otro" >                           
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
      <div class="row verificar">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Antecedentes Laborales</h3>
              </div>
              <div class="box-body">
                <label>Indique sus dos últimos trabajos</label>
                <div class="row">
                <br />
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Empresa 1</label>
                            <input class="form-control" type="text" name="empresa_1" id="empresa_1" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo_e1" id="cargao_e1" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Duraci&oacute;n</label>
                            <input class="form-control" type="text" name="duracion_e1" id="duracion_e1" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Motivo Salida</label>
                            <input class="form-control" type="text" name="motivo_e1" id="motivo_e1" >                           
                        </div>
                    </div>
              </div>
              <div class="row">
                <br />
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Empresa 2</label>
                            <input class="form-control" type="text" name="empresa_2" id="empresa_2" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo_e2" id="cargao_e2" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Duraci&oacute;n</label>
                            <input class="form-control" type="text" name="duracion_e2" id="duracion_e2" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Motivo Salida</label>
                            <input class="form-control" type="text" name="motivo_e2" id="motivo_e2" >                           
                        </div>
                    </div>
                    <br />
              </div>
              <label>Indique Referencias Laborales</label>
              <div class="row">
                <br />
                <div class="col-md-9">
                        <div class="form-group">
                            <label>Nombre Empresa</label>
                            <input class="form-control" type="text" name="empresa_referencia" id="empresa_referencia" >                           
                        </div>
                    </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                        <div class="form-group">
                            <label>Nombre Jefe y Cargo</label>
                            <input class="form-control" type="text" name="jefe_referencia" id="jefe_referencia" >                           
                        </div>
                    </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                        <div class="form-group">
                            <label>Telefonos o E-mail</label>
                            <input class="form-control" type="text" name="contacto_referencia" id="contacto_referencia" >                           
                        </div>
                    </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                    <div class="form-group">
                        <label>¿Ha trabajado anteriormente en Serbanc?</label>
                        <div class="form-group">
                          <div class="radio">
                            <label>
                              <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>
                             SI
                            </label>
                            <label>
                              <input type="radio" name="optionsRadios" id="optionsRadios1" value="2" checked>
                             NO
                            </label>
                          </div>
                        </div>
                    </div>                      
                </div>
              </div>
            </div>
          </div>
            <!-- /.box-body -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row verificar">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title">Horario de Postulaci&oacute;n</h3>
              </div>
              <div class="box-body">
              <label>Marcar horario solo en los que posee disponibilidad</label>
                <div class="row">
                <br />
                    <div class="col-md-9">
                        <div class="form-group">
                            <?php 
                
                            foreach($turnos as $id => $t) {
                                ?>
                                <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="<?php echo $id ?>"><?php echo $t?>
                                 </label>
                                </div>
                                <?php
                            } ?>
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
      <div class="row verificar">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Otros</h3>
              </div>
        <div class="box-body">
              <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Manejo de PC (manejo Office)</label>
                            <select class="form-control" style="width: 100%;" name="manejo_pc">
                              <option selected="selected" value="bajo">Bajo</option>
                              <option value="medio">Medio</option>
                              <option value="avanzado">Avanzado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Señale Expectativas de Renta</label>
                            <input class="form-control" type="text" name="renta" id="renta" >                           
                        </div>
                    </div>                    
              </div>
              <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Acepta Condiciones Informadas</label>
                            <select class="form-control" style="width: 100%;" name="condiciones">
                              <option value="SI" selected="selected" value="">SI</option>
                              <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Participante Firmo</label>
                            <select class="form-control" style="width: 100%;" name="firmo">
                              <option value="SI" selected="selected">SI</option>
                              <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Fuente</label>
                            <?php
                                echo form_dropdown('id_fuente',$fuentes,'',array('class' => 'form-control','id' => 'fuente'));
                            ?>  
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Prefiltro</label>
                            <select class="form-control" style="width: 100%;" name="prefiltro">
                              <option selected="selected" value="SI">CALIFICA</option>
                              <option value="NO">NO CALIFICA</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Fecha de Entrevista:</label>
        
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right datepicker" name="fecha_entrevista">
                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                    <div class="col-md-5">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                          <label>Hora de la Entrevista:</label>        
                          <div class="input-group">
                            <input type="text" class="form-control timepicker" name="hora_entrevista">        
                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                </div>                                       
              </div>
              <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-info pull-right">Guardar</button>
                    </div>                         
              </div>
              <br><br><br>
          </div>          
            <!-- /.box-body -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>
      </div>
    </section>

<div class="modal modal-success fade" id="verPostulante">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Postulante</h4>
              </div>
      <div class="modal-body" id="verPostulanteBody">        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
  $(document).ready(function(){
    var date_input=$('input[name="fecha"]'); //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    date_input.datepicker({
      format: 'yyyy-mm-dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    })
  })
</script>
<script>
function verPostulante(){
    $.ajax({
          url:"<?php echo base_url('index.php/operaciones/ver_ejecutivo')?>",
          type: 'POST',
          data: {id_postulante:$('#id_postulante').val()},
          success: function(data) {
          $('#verPostulanteBody').html(data);
          },
          error: function(e) {
            $('#verPostulanteBody').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
          }
    });
}
$('.verificar').hide();
texto_rut();

function texto_rut(event){
event.preventDefault();
$('#rut').Rut({
  on_error: function(){ 
    $('#alerta_rut').fadeIn();
    $('.verificar').fadeOut();
    $('#prueba').val('1');
    setTimeout(function(){
        $("#alerta_rut").fadeOut(2000);},3000);
    },
  format_on: 'keyup'
});
</script>

<script>
  function verPostulante(){
      $.ajax({
            url:"<?php echo base_url('index.php/gestion/ver_postulante')?>",
            type: 'POST',
            data: {id_postulante:$('#id_postulante').val()},
            success: function(data) {
            $('#verPostulanteBody').html(data);
            },
            error: function(e) {
              $('#verPostulanteBody').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
            }
      });
  }

  $('.verificar').hide();
  texto_rut();

  function texto_rut(event){
    event.preventDefault();
    $('#rut').Rut({
      on_error: function(){ 
        $('#alerta_rut').fadeIn();
        $('.verificar').fadeOut();
        $('#prueba').val('1');
        setTimeout(function(){
            $("#alerta_rut").fadeOut(2000);},3000);
        },
      format_on: 'keyup'
    });
  }

  setTimeout(function(){$("#alerta").fadeOut(2000);},3000);
  setTimeout(function(){$("#alerta_rut").fadeOut(2000);},3000);

  function agregar_factor(event){    
      event.preventDefault();
      var ofactor = document.getElementById("otro_factor");
      var vfactor = ofactor.value;
          if(vfactor!=''){
          $.ajax({
            url:"<?php echo base_url('index.php/gestion/agregar_factor')?>",
            type: 'POST',
            data: {factor:vfactor},
            success: function(data){
              
              console.debug(data);
              data  = JSON.parse(data);          
              
              if (data.guardo=='SI'){
                  $("#otro_factor").val("");
                  $('#muestra_factor').load('<?php echo base_url('index.php/gestion/mostrar_factor');?>');

              }else{               
                  $('#alerta_factor_r').fadeIn();
                  setTimeout(function(){$("#alerta_factor_r").fadeOut(2000);},3000);        
              }            
              
            },
            error: function(e) {
              alert('error');
              //$('#respuesta').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
            }
      });
      }else{
          $('#alerta_factor').fadeIn();
          setTimeout(function(){$("#alerta_factor").fadeOut(2000);},3000);
      }

  } 

  function agregar_hobbie(event){
      event.preventDefault();
      var ohobbie = document.getElementById("otro_hobbie");
      var vhobbie = ohobbie.value;
          if(vhobbie!=''){
          $.ajax({
            url:"<?php echo base_url('index.php/gestion/agregar_hobbie')?>",
            type: 'POST',
            data: {hobbie:vhobbie},
            success: function(data){
              
              console.debug(data);
              data  = JSON.parse(data);          
              
              if (data.guardo=='SI'){
                  $("#otro_hobbie").val("");
                  $('#muestra_hobbies').load('<?php echo base_url('index.php/gestion/mostrar_hobbies');?>');

              }else{               
                  $('#alerta_hobbies_r').fadeIn();
                  setTimeout(function(){$("#alerta_hobbies_r").fadeOut(2000);},3000);        
              }            
              
            },
            error: function(e) {
              alert('error');
              //$('#respuesta').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
            }
      });
      }else{
          $('#alerta_hobbies').fadeIn();
          setTimeout(function(){$("#alerta_hobbies").fadeOut(2000);},3000);
      }

  }      
        
  function validar_rut(event){
      event.preventDefault();
      var edValue = document.getElementById("rut");
      var rut = edValue.value;    
      var muestra = document.getElementById("muestra");        
      var respuesta = document.getElementById("respuesta");

      var prueba = document.getElementById("prueba");

      $.ajax({
            url:"<?php echo base_url('index.php/gestion/valida_rut')?>",
            type: 'POST',
            data: {rut:rut},
            success: function(data){
              
              console.debug(data);
              data  = JSON.parse(data);
              //datepicker ini
              $('.datepicker').datepicker({
                      todayBtn: true,
                      language: "es",
                      autoclose: true
                  });
              $(".timepicker").timepicker({
                    showInputs: false,

              });
              //datepicker fin

              if (data.existe=='SI'){
                  //alert(validado);
  				        $('#id_postulante').val(data.id);
                  $('.verificar').hide();
                  $('#alerta').fadeIn();
                  setTimeout(function(){$("#alerta").fadeOut(2000);},3000);
                  return false;
              }else if(data.existe=='NO' && prueba==1){
                  //alert('test');
                  $('#id_postulante').val(data.id);
                  $('.verificar').hide();
                  $('#alerta').fadeIn();
                  setTimeout(function(){$("#alerta").fadeOut(2000);},3000);
                  return false;
              }else {                
                  $('.verificar').fadeIn();
              }            
              
            },
            error: function(e) {
              alert('error');
              //$('#respuesta').html('<div class="alert alert-danger">Error: NO se puede cargar la vista</div>');
            }
      });
  }
</script>