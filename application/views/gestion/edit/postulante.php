 <div class="content-wrapper">
 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Postulaci&oacute;n 
        <small> de Empleo</small>
      </h1>

      <?php //var_dump($postulante) ?>
    </section>
    <!-- Main content -->
    <section class="content">
    <br />
   <?php echo form_open('Gestion/editar_postulante');?>
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
                        <label>Rut</label>
                        <input class="form-control" type="text" name="rut" id="rut" value="<?php echo $postulante[0]['rut'];?>" autocomplete="off" onkeyup="texto_rut(event);" />
                      </div>
                    </div>                    
              </div>
              
              <div class="row">
                  <div class="col-md-4 ">
                        <div class="form-group">
                            <label>Nombres</label>
                            <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombres" value="<?php echo $postulante[0]['nombre'];?>" />
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>Apellido Paterno</label>
                            <input class="form-control" type="text" name="paterno" id="paterno" placeholder="Apellido Paterno" value="<?php echo $postulante[0]['paterno'];?>"/>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>Apellido Materno</label>
                            <input class="form-control" type="text" name="materno" id="materno" placeholder="Apellido Materno" value="<?php echo $postulante[0]['materno'];?>"/>
                        </div>
                    </div>

                </div>      

                    
                <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Fecha:</label>
        
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right datepicker" name="fecha" value="<?php echo date('d-m-Y') ?>" disabled="disabled" />
                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                    
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>Edad</label>
                            <input class="form-control" type="text" name="edad" id="edad" placeholder="Edad" value="<?php if(isset($postulante[0]['edad'])){echo $postulante[0]['edad'];}?>" />                           
                        </div>
                    </div>                    
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" name="email" id="email" placeholder="Email" value="<?php echo $postulante[0]['email'] ?>" />
                        </div>
                    </div>                 
              </div>              
              
              <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Fecha de Nacimiento:</label>
                    
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <?php
                              if(!empty($postulante[0]['fecha_nacimiento'])){
                                $fecha_existe = $postulante[0]['fecha_nacimiento'];
                              }else{
                                $fecha_existe = '2017-01-26';
                              }
                          ?>
                          <input type="text" class="form-control pull-right datepicker" name="fecha_nac" value="<?php echo $fecha_existe;?>">
                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>
               
                    <div class="col-md-4">
                    <div class="form-group">
                        <label>Sexo</label>
                            <select class="form-control" style="width: 100%;" name="sexo">
                                <?php 
                                if ($postulante[0]['sexo'] == 'Fe') { ?>
                                  <option selected="selected" value="Fe">Femenino</option>
                                  <option value="Ma">Masculino</option>
                                  <?php 
                                } else {
                                    ?>
                                    <option value="Fe">Femenino</option>
                                    <option selected="selected"  value="Ma">Masculino</option>
                                    <?php 
                                }
                                  ?>
                            </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Estado Civil</label>
                            <select class="form-control" style="width: 100%;" name="estado_civil">
                                    <?php 
                                    if ($postulante[0]['edo_civil'] == 'Soltero') { ?>
                                         <option value="Soltero" selected="selected">Soltero</option>
                                          <option value="Casado" >Casado</option>
                                          <option value="viudo" >Viudo</option>
                                    <?php 
                                    } elseif ($postulante[0]['edo_civil'] == 'Casado') { ?>
                                         <option value="Soltero">Soltero</option>
                                          <option value="Casado"  selected="selected">Casado</option>
                                          <option value="viudo" >Viudo</option>
                                    <?php
                                    } else {
                                        ?>
                                        <option value="Soltero">Soltero</option>
                                          <option value="Casado">Casado</option>
                                          <option value="viudo" selected="selected">Viudo</option>
                                        <?php 
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>                    
              </div>
                  
              <div class="row">
              <div class="col-md-3">
                        <div class="form-group">
                            <label>Nacionalidad</label>
                            <input class="form-control" type="text" name="nacionalidad" id="nacionalidad" placeholder="Nacionalidad" value="<?php echo $postulante[0]['nacionalidad']?>">                           
                        </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Direcci&oacute;n</label>
                      <input type="text" class="form-control" placeholder="Direccion" name="direccion" value="<?php echo $postulante[0]['direccion'] ?>">
                    </div>
                 </div>
                 <div class="col-md-3">
                    <label>Comuna</label>
                    <?php
                    echo form_dropdown('comuna',$comunas,$postulante[0]['comuna'],array('class' => 'form-control','id' => 'comuna'));
                    ?>
                 </div>
              </div>
              <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Celular</label>
                            <input class="form-control" type="text" name="celular" id="celular" placeholder="Celular" value="<?php echo $postulante[0]['fono_movil'] ?>">                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Fono Fijo</label>
                            <input class="form-control" type="text" name="fono" id="fono" placeholder="Fono" value="<?php echo $postulante[0]['fono_fijo'] ?>">                           
                        </div>
                    </div>
                    <div class="col-md-3">
                            <div class="form-group">
                                <label>Numero de Hijos</label>
                                 <?php
                                    echo form_dropdown('hijos',array('0'=> '0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7'),$postulante[0]['num_hijos'],array('class' => 'form-control','id' => 'hijos'));
                                    ?>
                                
                            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Edades</label>
                            <input class="form-control" type="text" name="edades_hijos" id="edades_hijos" placeholder="Edades" value="<?php $postulante[0]['edad_hijos'] ?>">                           
                        </div>
                    </div>
              </div>
              <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>¿Tiene Alguna Discapacidad?</label>
                            <input class="form-control" type="text" name="discapacidad" id="discapacidad" value="<?php echo $postulante[0]['discapacidad']?>">                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>¿Tiene Alguna Enfermedad Importante?</label>
                            <input class="form-control" type="text" name="enfermedad" id="enfermedad" value="<?php echo $postulante[0]['enfermedad'] ?>">                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Indique Nombre y Contacto Familiar</label>
                            <input class="form-control" type="text" name="familiar" id="familiar" value="<?php echo $postulante[0]['contacto_familiar']?>">                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cargo que Postula</label>
                              <?php
                                echo form_dropdown('id_cargo',$cargos,$postulante[0]['id_cargo'],array('class' => 'form-control','id' => 'id_cargo'));
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
      <div class="row">
      
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
                        $check = array();
                        foreach($hobbies_seleccionadas as $b){
                            $check[] = $b['id_hobbies'];        
                        }
                               
                 
                        foreach($hobbie as $k=>$a){              
                        if (in_array($k,$check)) {
                            $checked = 'checked';
                        } else {
                            $checked = '';
                        }
                        $app = array(      
                            'name' => 'hobbies['.$k.']',
                            'value' => ''.$a.'',
                            'checked' => ''.$checked.''
                        );
                        echo "<div class='col-md-1'>";
                        echo form_checkbox($app);
                        echo $a."</div>";
                    
                        }
                        
                        ?>
                
                        <?php
                            /*
                            foreach($hobbies as $k=>$a){
                                $app = array(
                                'name' => 'hobbies['.$k.']',
                                'value' => ''.$a.''
                                );
                                echo "<div class='col-md-1'>";
                                echo form_checkbox($app);
                                echo $a."</div>";
                            }
                            */
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
                            <input class="form-control" type="text" name="espera" id="espera" value="<?php echo $postulante[0]['espera'] ?>">                           
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>¿Qué condiciones valora en su lugar de trabajo?</label>
                            <input class="form-control" type="text" name="valora" id="valora" value="<?php echo $postulante[0]['valora'] ?>">                           
                        </div>
                    </div>
                    
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>¿Qué condiciones hace que usted no decía irse de su trabajo ?</label>
                            <input class="form-control" type="text" name="condiciones" id="condiciones" value="<?php echo $postulante[0]['condiciones'] ?>">                           
                        </div>
                    </div>
                    
                </div>
                              
                <div class="row" id="muestra_factor">
                
                        <?php
                        $check = array();
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
            <!-- /.box-body -->
      <!--expectativas_fin-->
      
       <div class="row">
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
                             <?php
                                echo form_dropdown('educacion_media',array('INCOMPLETA' => 'INCOMPLETA','COMPLETA' => 'COMPLETA','EN CURSO' => 'EN CURSO'),$postulante[0]['educacion_media'],array('class' => 'form-control','id' => 'educacion_media'));
                                ?>
                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Media T&eacute;cnica</label>
                            <input class="form-control" type="text" name="media_tecnica" id="media_tecnica" value="<?php echo $postulante[0]['educacion_media_tecnica']?>">                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Educaci&oacute;n Superior</label>
                            <?php
                                echo form_dropdown('educacion_superior',array('INCOMPLETA' => 'INCOMPLETA','COMPLETA' => 'COMPLETA','EN CURSO' => 'EN CURSO'),$postulante[0]['educacion_superior'],array('class' => 'form-control','id' => 'educacion_superior'));
                                ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Carrera</label>
                            <input class="form-control" type="text" name="carrera" id="carrera" value="<?php echo $postulante[0]['carrera'] ?>">                           
                        </div>
                    </div>
              </div>
              <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Otro (Indicar)</label>
                            <input class="form-control" type="text" name="otro" id="otro" value="<?php echo $postulante[0]['otro'] ?>">                           
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
                  <h3 class="box-title">Antecedentes Laborales</h3>
              </div>
              <div class="box-body">
                <label>Indique sus dos últimos trabajos</label>
                <div class="row">
                <br />
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Empresa 1</label>
                            <input class="form-control" type="text" name="empresa_1" id="empresa_1" value="<?php echo $postulante[0]['empresa1']?>">                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo_e1" id="cargao_e1" value="<?php echo $postulante[0]['cargo1']?>" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Duraci&oacute;n</label>
                            <input class="form-control" type="text" name="duracion_e1" id="duracion_e1" value="<?php echo $postulante[0]['duracion1']?>"  >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Motivo Salida</label>
                            <input class="form-control" type="text" name="motivo_e1" id="motivo_e1"  value="<?php echo $postulante[0]['motivo_salida1']?>" >                           
                        </div>
                    </div>
              </div>
              <div class="row">
                <br />
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Empresa 2</label>
                            <input class="form-control" type="text" name="empresa_2" id="empresa_2"  value="<?php echo $postulante[0]['empresa2']?>" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Cargo</label>
                            <input class="form-control" type="text" name="cargo_e2" id="cargao_e2"  value="<?php echo $postulante[0]['cargo2']?>" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Duraci&oacute;n</label>
                            <input class="form-control" type="text" name="duracion_e2" id="duracion_e2"  value="<?php echo $postulante[0]['duracion2']?>" >                           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Motivo Salida</label>
                            <input class="form-control" type="text" name="motivo_e2" id="motivo_e2"  value="<?php echo $postulante[0]['motivo_salida2']?>" >                           
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
                            <input class="form-control" type="text" name="empresa_referencia" id="empresa_referencia"  value="<?php echo $postulante[0]['referencia_empresa']?>" >                           
                        </div>
                    </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                        <div class="form-group">
                            <label>Nombre Jefe y Cargo</label>
                            <input class="form-control" type="text" name="jefe_referencia" id="jefe_referencia"  value="<?php echo $postulante[0]['nombre_referencia']?>" >                           
                        </div>
                    </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                        <div class="form-group">
                            <label>Telefonos o E-mail</label>
                            <input class="form-control" type="text" name="contacto_referencia" id="contacto_referencia"  value="<?php echo $postulante[0]['contacto_referencia']?>" >                           
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
      <div class="row">
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
                                if (!empty($turnos_seleccionados) && in_array($id,$turnos_seleccionados)) {
                                    $checked = 'checked';
                                } else {
                                    $checked = '';
                                }
                                ?>
                                <div class="checkbox">
                                <label>
                                  <input type="checkbox" name="<?php echo $id ?>" <?php echo $checked ?>><?php echo $t?>
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
      <div class="row">
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
                            <?php echo form_dropdown('manejo_pc',array('bajo' => 'Bajo','medio' => 'Medio','Avanzado' => 'Avanzado'),$postulante[0]['manejo_pc'],array('class' => 'form-control','id' => 'manejo_pc'));
                                ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Señale Expectativas de Renta</label>
                            <input class="form-control" type="text" name="renta" id="renta" value="<?php echo $postulante[0]['pretension_renta']?>">                           
                        </div>
                    </div>                    
              </div>
              <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Acepta Condiciones Informadas</label>
                             <?php echo form_dropdown('acepta_condicion',array('si' => 'Si','no' => 'No'),$postulante[0]['acepta_condicion'],array('class' => 'form-control','id' => 'manejo_pc'));?>
                            
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Participante Firmo</label>
                            <?php echo form_dropdown('firmo',array('0' => 'No','1' => 'Si'),$postulante[0]['firmo'],array('class' => 'form-control','id' => 'firmo'));?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Fuente</label>
                            <?php
                                echo form_dropdown('id_fuente',$fuentes,$postulante[0]['id_fuente'],array('class' => 'form-control','id' => 'fuente'));
                            ?>  
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Prefiltro</label>
                            <?php
                                echo form_dropdown('prefiltro',array('SI' => 'Si','NO' => 'No'),$postulante[0]['prefiltro'],array('class' => 'form-control','id' => 'prefiltro'));
                              ?> 
                        </div>
                    </div>
                    <?php
                    $fecha_hora_entrevista = explode(' ',$postulante[0]['fecha_entrevista']);
        
                    ?>
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Fecha de Entrevista:</label>
        
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right datepicker" name="fecha_entrevista" value="<?php echo $fecha_hora_entrevista[0]?>">
                        </div>
                        <!-- /.input group -->
                      </div>
                    </div>
                    <div class="col-md-5">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                          <label>Hora de la Entrevista:</label>        
                          <div class="input-group">
                            <input type="text" class="form-control timepicker" name="hora_entrevista" value="<?php echo $fecha_hora_entrevista[1]?>">        
                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                </div> 

                <div class="col-md-5">
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                          <label>Entrevistado:</label>        
                          <div class="input-group">
                              <select class="form-control" name="entrevistado" id="entrevistado" required>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                              </select>
                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                </div>

              </div>
              <div class="row">
              <?php
              echo form_hidden('id_persona',$postulante[0]['id_persona']);
              echo form_hidden('id_postulante',$postulante[0]['id_postulante']);
              echo form_hidden('id_antecedente',$postulante[0]['id_antecedente']);
              echo form_hidden('id_antecedente_academico',$postulante[0]['id_antecedente_academico']);
              echo form_hidden('id_expectativa',$postulante[0]['id_expectativa']);
              ?>
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
<script>
$(document).ready(function(){ 
  $('.datepicker').datepicker({
          starDate: 'today',
          language: "es",
          format: 'yyyy-mm-dd',
          autoclose: true
  });
  $(".timepicker").timepicker({
        showInputs: false,
      });
  });

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

//agregar factor
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
                $('#muestra_factor').load('<?php echo base_url('index.php/gestion/mostrar_factor/'.$postulante[0]['id_postulante']);?>');
                

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
    
//agregar hobbies
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
                $('#muestra_hobbies').load('<?php echo base_url('index.php/gestion/mostrar_hobbies/'.$postulante[0]['id_postulante']);?>');

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
</script>