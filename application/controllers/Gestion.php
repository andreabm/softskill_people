<?php
class Gestion extends CI_Controller {
    
	public function __construct(){	
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
    $this->load->library('email');
    $this->load->library('form_validation');
    $this->load->library('javascript');
    $this->load->library('session');
	$this->load->library('parser');
    //$this->load->model('Usuario');
	//$this->load->model('Rango');
    $this->load->model('MyModel');
	$this->init();
	}
	
    public function init(){
     
      //Verifico si tengo permiso para acceder al modulo
      $controlador = $this->router->fetch_class();
      $action = $this->router->fetch_method();
      $permisos = $this->MyModel->buscar_model('permisos',array(
            'controller' => $controlador,
            'view' => $action
      ));
      $permisos = explode(';',$permisos[0]['rangos']);
      $rango = $this->session->userdata['id_rango'];
	  if (!in_array($rango,$permisos)) {
        redirect(base_url().'index.php');
      }
      
      //Cargar menu
      $this->menu_lista = $this->MyModel->buscar_permisos(); 
	  $this->rango = $this->session->userdata['id_rango'];
      $this->action = $action;
      $this->controlador = $controlador;
	  
	  return true;
  	}
	
    public function ejecutivos(){
        $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,areas.area,carteras.cartera,tipos_ejecutivos.tipo_ejecutivo,resultado_evaluacion_psicologica.resultado_final');
        $this->db->from('personas');
        $this->db->join('postulantes','personas.rut = postulantes.rut');
        $this->db->join('areas','areas.id_area = postulantes.id_area');
        $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
        $this->db->join('resultado_evaluacion_psicologica','resultado_evaluacion_psicologica.rut = postulantes.rut');
        $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo', 'left');
        $this->db->where('personas.clasificado = 1');
        $query = $this->db->get();
        $ejecutivos = $query->result_array();
        $data['ejecutivos'] = $ejecutivos;
        $this->load->view('common/header');
        $this->load->view('gestion/ejecutivos',$data);
        $this->load->view('common/footer');
    }
    public function mover_ejecutivo(){
        $id_postulante = $this->input->post('id_postulante');
        
        $cargos = $this->MyModel->buscar_select('cargos','id_cargo','cargo');    
        $data['cargos'] = $cargos;

        $this->db->from('areas');
        $this->db->join('solicitudes','solicitudes.id_area=areas.id_area');
        $this->db->where('solicitudes.cantidad_entregada < solicitudes.cantidad_solicitada');
        $this->db->where('solicitudes.validado = 1');
        $this->db->group_by('areas.id_area');
        $query = $this->db->get();
        $areas = $query->result_array();   
        $data['areas'] = $areas;
                
        $motivos_no_califica = $this->MyModel->buscar_select('motivo_no_califica','id_motivo_no_califica','motivo');
        $data['motivos_no_califica'] = $motivos_no_califica;
        
        $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno, personas.materno,postulantes.id_cargo,personas.email,postulantes.id_cargo,postulantes.id_solicitud');
        $this->db->from('postulantes');
        $this->db->join('personas','postulantes.rut=personas.rut');
        $this->db->where('postulantes.id_postulante = '.$id_postulante);
        $query = $this->db->get();
        $postulante = $query->result_array();       
        $data['postulante']=$postulante;

        $this->db->from('sucursales');
        $query = $this->db->get();
        $sucu = $query->result_array();       
        $data['sucu']=$sucu;

        $this->load->view('gestion/modal/mover_ejecutivo',$data);
    }

    //UPDATE MOVER EJECUTIVO INI
        public function update_ejecutivo_mover(){
        $rut = $this->input->post('rut');
        $califica=$this->input->post('califica');
        $area = $this->input->post('area');
        $cartera = $this->input->post('cartera');
        $id_sol = $this->input->post('id_sol');
        $nombre = $this->input->post('nombre');
        $rut = $this->input->post('rut');
        $email = $this->input->post('email');
        $id_sucursal = $this->input->post('id_sucursal');
        $supervisor = $this->input->post('supervisor');
        $id_supervisor = $this->input->post('id_supervisor');
        
        $fecha_presentacion = $this->input->post('fecha_presentacion');
        $hora_presentacion = $this->input->post('hora_presentacion');

        $hora_separada = explode(" ", $hora_presentacion);
        $hora_separada[0]; //hora
        $hora_separada[1]; //am o pm

        $this->db->from('solicitudes');
        $this->db->where(array('id_solicitud' => $id_sol));
        $query = $this->db->get();
        $sol = $query->result_array();
        $nueva_cantidad = $sol[0]['cantidad_entregada'] - 1;

        //actualizo la nueva cantidad de la solicitud anterior
        $data_solicitud = array('cantidad_entregada' => $nueva_cantidad);
        $this->db->where('id_solicitud', $id_sol);
        $this->db->update('solicitudes', $data_solicitud);        
            
            //array para la actualizacion de postulante
            $update_postulante = array(
                    'id_cartera' => $cartera,
                    'id_area' => $area,
                    'sucursal_id' => $id_sucursal,
                    'fecha_asignacion' => $fecha_presentacion.' '.$hora_separada[0].':00',
                    'id_supervisor_califica' => $id_supervisor
            );

            //comparo datos de la solicitud
            $this->db->from('solicitudes');
            $this->db->where(array('id_cartera' => $cartera, 'id_area' => $area, 'id_cargo' => $this->input->post('id_cargo')));
            $this->db->order_by('solicitudes.id_solicitud');
            $this->db->limit(1);
            $query = $this->db->get();
            $solicitud = $query->result_array();

            $update_solicitud = array(
                'cantidad_entregada' => $solicitud[0]['cantidad_entregada']+1
            );
            if (($solicitud[0]['cantidad_entregada'] + 1) == $solicitud[0]['cantidad_solicitada']) { 
                $update_solicitud['activo'] = 0;
            }
            $this->db->where('id_solicitud',$solicitud[0]['id_solicitud']);
            $this->db->update('solicitudes', $update_solicitud);
            $id_solicitud = $solicitud[0]['id_solicitud'];
            $update_postulante['id_solicitud'] = $id_solicitud;            
               
        //actualizo los datos en postulantes       
        $this->db->where('rut',$rut);
        $this->db->update('postulantes', $update_postulante);        
        
        redirect(base_url().'index.php/gestion/ejecutivos');        
    }
    //UPDATE MOVER EJECUTIVO FIN

    public function postulantes(){
        $this->db->from('postulantes');
		$array = array();
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->where('postulantes.id_solicitud is null');
        $query = $this->db->get();
        $postulantes = $query->result_array();
        $data['postulantes'] = $postulantes;
        
        $evaluadores = $this->MyModel->buscar_select('evaluadores','id_evaluador','nombre_evaluador');
        $data['evaluadores'] = $evaluadores;
        
        $this->db->select('id_supervisor,nombre_supervisor');
        $this->db->from('supervisores');
        $this->db->group_by('nombre_supervisor');
        $query = $this->db->get();
        $evaluadores = $query->result_array();   
        $data['evaluadores'] = $evaluadores;        

        $this->db->from('resultado_competencias');
        $this->db->group_by('resultado_competencias.rut');
        $query = $this->db->get();
        $induccion = $query->result_array();   
        $data['induccion'] = $induccion;

        //$data['query'] = $this->db->last_query();
        $this->load->view('common/header');
        $this->load->view('gestion/postulantes',$data);
        $this->load->view('common/footer');
    }
    
    public function ver_postulante(){
        $id_postulante = $this->input->post('id_postulante');
        $this->db->select('personas.rut,personas.nombre,personas.paterno,personas.materno,personas.fecha_nacimiento,personas.sexo,personas.edo_civil,personas.nacionalidad,personas.discapacidad,personas.enfermedad,personas.direccion,personas.comuna,personas.fono_movil,personas.fono_fijo,personas.email,personas.clasificado,postulantes.pretension_renta,postulantes.fecha_entrevista,fuentes.fuente,cargos.cargo,evaluadores.nombre_evaluador');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->join('fuentes','postulantes.id_fuente = fuentes.id_fuente');
        $this->db->join('cargos','postulantes.id_cargo = cargos.id_cargo');
        $this->db->join('evaluadores','evaluadores.id_evaluador = postulantes.evaluador_id','left');
        $this->db->where('postulantes.id_postulante = '.$id_postulante);
        $query = $this->db->get();
        $postulante = $query->result_array();
        $data['postulante']=$postulante;
        $data['query'] = $this->db->last_query();
        
        $this->db->from('turnos_postulantes');
        $this->db->join('turnos','turnos.id_turno = turnos_postulantes.id_turno');
        $this->db->where('turnos_postulantes.id_postulante = '.$id_postulante);
        $query = $this->db->get();
        $turnos = $query->result_array();
        $data['turnos']=$turnos;
        
        $motivos_no_califica = $this->MyModel->buscar_select('motivo_no_califica','id_motivo_no_califica','motivo');
        $data['motivos_no_califica'] = $motivos_no_califica;
        $this->load->view('gestion/modal/ver_postulante',$data);
    }
    public function agregar_postulante(){
        $comunas = $this->MyModel->buscar_select('comunas','comuna','comuna');
        $cargos = $this->MyModel->buscar_select('cargos','id_cargo','cargo');
        $turnos = $this->MyModel->buscar_select('turnos','id_turno','turno');
        $fuentes = $this->MyModel->buscar_select('fuentes','id_fuente','fuente');
        $hobbies = $this->MyModel->buscar_select('hobbies','id_hobbies','hobbies');
      
        $factor = $this->MyModel->buscar_select('factor','id_factor','factor');
      
        $data['turnos'] = $turnos;
        $data['cargos'] = $cargos;
        $data['comunas'] = $comunas;
        $data['fuentes'] = $fuentes;
        $data['hobbies'] = $hobbies;
        $data['factor'] = $factor;
        if($this->input->post('rut')) {
            $rut = $this->input->post('rut');
            $nombre = $this->input->post('nombre');
            $sexo = $this->input->post('sexo');
            $fecha_nacimiento = $this->input->post('fecha_nac');
            $estado_civil = $this->input->post('estado_civil');
            $nacionalidad = $this->input->post('nacionalidad');
            $direccion = $this->input->post('direccion');
            $comuna = $this->input->post('comuna');
            $celular = $this->input->post('celular');
            $fono = $this->input->post('fono');
            $hijos = $this->input->post('hijos');
            $edad = $this->input->post('edad');
            $edades_hijos = $this->input->post('edades_hijos');
            $discapacidad = $this->input->post('discapacidad');
            $familiar = $this->input->post('familiar');
            $enfermedad = $this->input->post('enfermedad');
            $cargo_postula = $this->input->post('id_cargo');
            $educacion_media = $this->input->post('educacion_media');
            $media_tecnica = $this->input->post('media_tecnica');
            $educacion_superior = $this->input->post('educacion_superior');
            $carrera = $this->input->post('carrera');
            $otro_educacion = $this->input->post('otro');
            $empresa_1 = $this->input->post('empresa_1');
            $cargo_e1 = $this->input->post('cargo_e1');
            $duracion_e1 = $this->input->post('duracion_e1');
            $motivo_e1 = $this->input->post('motivo_e1');
            $duracion_e1 = $this->input->post('duracion_e2');
            $empresa_2 = $this->input->post('empresa_2');
            $cargo_e2 = $this->input->post('cargo_e2');
            $duracion_e2 = $this->input->post('duracion_e2');
            $motivo_e2 = $this->input->post('motivo_e2');
            $duracion_e2 = $this->input->post('duracion_e2');
            $empresa_referencia = $this->input->post('empresa_referencia');
            $jefe_referencia = $this->input->post('jefe_referencia');
            $contacto_referencia = $this->input->post('contacto_referencia');
            $trabajo_serbanc = $this->input->post('optionsRadios');
            $manejo_pc = $this->input->post('manejo_pc');
            $expectativas_renta = $this->input->post('renta');
            $acepta_condiciones = $this->input->post('condiciones');
            $firmo = $this->input->post('firmo');
            $prefiltro = $this->input->post('prefiltro');

            
            $fuente = $this->input->post('id_fuente');

            $fecha_entrevista = $this->input->post('fecha_entrevista');
            $hora_entrevista = $this->input->post('hora_entrevista');

            $hora_separada = explode(" ", $hora_entrevista);
            $hora_separada[0]; // hora
            $hora_separada[1]; // am o pm

            $fecha_entrevista = date("Y-m-d", strtotime($fecha_entrevista));
            $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
            $email = $this->input->post('email');
                        
            $paterno = $this->input->post('paterno');
            $materno = $this->input->post('materno');

            $espera = $this->input->post('espera');
            $valora = $this->input->post('valora');
            $condiciones = $this->input->post('condiciones');

            $r_social = $this->input->post('razon_social');
            $entrevistado = $this->input->post('entrevistado');

            
            $nueva_persona = array(
                'rut' => $rut,
                'nombre' => $nombre,
                'fecha_nacimiento' => $fecha_nacimiento,
                'sexo' => $sexo,
                'edo_civil' => $estado_civil,
                'direccion' => $direccion,
                'comuna' => $comuna,
                'fono_movil' => $celular,
                'fono_fijo' => $fono,
                'nacionalidad' => $nacionalidad,
                'num_hijos' => $hijos,
                'edad_hijos' => $edades_hijos,
                'discapacidad' => $discapacidad,
                'enfermedad' => $enfermedad,
                'contacto_familiar' => $familiar,
                'email' => $email,
                'edad' => $edad,
                'paterno' => $paterno,
                'materno' => $materno,
                'razon_social' => $r_social
            ); 
            $nuevo_postulante = array(
                'rut' => $rut,
                'referencia_empresa' => $empresa_referencia,
                'nombre_referencia' => $jefe_referencia,
                'contacto_referencia' => $contacto_referencia,
                'manejo_pc' => $manejo_pc,
                'acepta_condicion' => $acepta_condiciones,
                'pretension_renta' => $expectativas_renta,
                'id_cargo' => $cargo_postula,
                'prefiltro' => $prefiltro,
                'fecha_entrevista' => $fecha_entrevista.' '.$hora_separada[0].':00',
                'id_fuente' => $fuente,
                'firmo' => $firmo,
                'entrevistado' => $entrevistado
            );
            
            $nuevo_antecedente_academico = array(
                'educacion_media' => $educacion_media,
                'rut' => $rut,
                'educacion_media_tecnica' => $media_tecnica,
                'educacion_superior' => $educacion_superior,
                'carrera' => $carrera,
                'otro' => $otro_educacion
            );
            
            $nuevo_antecedente_laboral = array(
                'rut' => $rut, 
                'empresa1' => $empresa_1,
                'cargo1' => $cargo_e1,
                'duracion1' => $duracion_e1,
                'motivo_salida1' => $motivo_e1,
                'empresa2' => $empresa_2,
                'cargo2' => $cargo_e2,
                'duracion2' => $duracion_e2,
                'motivo_salida2' => $motivo_e2,
            );
            $encuesta_expectativas = array(
                'rut' => $rut,
                'espera' => $espera,
                'valora' => $valora,
                'condiciones' => $condiciones
            );
                   
            $this->MyModel->agregar_model('personas',$nueva_persona);
            $postulante_id = $this->MyModel->agregar_model('postulantes',$nuevo_postulante);
            foreach ($turnos as $id => $t) {
                if ($this->input->post($id)) {
                    $nuevo_turno_postulante = array(
                        'id_postulante' => $postulante_id,
                        'id_turno' => $id
                    );
                    $this->MyModel->agregar_model('turnos_postulantes',$nuevo_turno_postulante);
                }
            }
            
            $hobbies = $this->input->post('hobbies');
            foreach($hobbies as $k=>$a){
                $hobbie = array('id_postulantes' =>$postulante_id, 'id_hobbies'=>$k);
                $this->db->insert('hobbies_personas',$hobbie);
            }
            
            $factor = $this->input->post('factor');
            foreach($factor as $k=>$a){
                $factor = array('id_postulantes' =>$postulante_id, 'id_factor'=>$k);
                $this->db->insert('factor_personas',$factor);
            }           
            
            $this->MyModel->agregar_model('antecedentes_academicos',$nuevo_antecedente_academico);
            $this->MyModel->agregar_model('antecedentes_laborales',$nuevo_antecedente_laboral);
            $this->MyModel->agregar_model('expectativas',$encuesta_expectativas);
         redirect(base_url("index.php/Gestion/postulantes"));
        }
        $this->load->view('common/header');
        $this->load->view('gestion/add/postulante',$data);
        $this->load->view('common/footer');
        
    }
    
    public function editar_postulante($id_postulante){
    	if(empty($id_postulante)){
           $id_postulante = $this->input->post('id_postulante');
        }
        //$id_postulante = $this->input->post('id_postulante');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->join('cargos','postulantes.id_cargo = cargos.id_cargo', 'left');
        $this->db->join('comunas','personas.comuna = comunas.comuna', 'left');
        $this->db->join('antecedentes_academicos','antecedentes_academicos.rut = personas.rut','left');
        $this->db->join('antecedentes_laborales','antecedentes_laborales.rut = personas.rut','left');
        $this->db->join('expectativas','expectativas.rut = personas.rut','left');
        $this->db->where('postulantes.id_postulante = '.$id_postulante);
        
        $query = $this->db->get();
        $postulante = $query->result_array();
        $data['postulante'] = $postulante;
        
        $this->db->from('turnos_postulantes');
        $this->db->join('turnos','turnos_postulantes.id_turno = turnos.id_turno');
        $this->db->where('turnos_postulantes.id_postulante = '.$id_postulante);
        $query = $this->db->get();
        $turnos_seleccionados_q = $query->result_array();
        $turnos_seleccionados = array();
        foreach ($turnos_seleccionados_q as $t) {
            $turnos_seleccionados[] = $t['id_turno'];
        } 
        $data['turnos_seleccionados'] = $turnos_seleccionados;
        
        //hobbies
        $this->db->from('hobbies_personas');
        $this->db->join('hobbies','hobbies.id_hobbies = hobbies_personas.id_hobbies');
        $this->db->where('hobbies_personas.id_postulantes = '.$id_postulante);
        $query = $this->db->get();
        $hobbies_seleccionadas = $query->result_array();                
        $data['hobbies_seleccionadas'] = $hobbies_seleccionadas;
        //hobbies
        
        //factor
        $this->db->from('factor_personas');
        $this->db->join('factor','factor.id_factor = factor_personas.id_factor');
        $this->db->where('factor_personas.id_postulantes = '.$id_postulante);
        $query = $this->db->get();
        $factor_seleccionadas = $query->result_array();                
        $data['factor_seleccionadas'] = $factor_seleccionadas;
        //factor
        
        $comunas = $this->MyModel->buscar_select('comunas','comuna','comuna');
        $cargos = $this->MyModel->buscar_select('cargos','id_cargo','cargo');
        $turnos = $this->MyModel->buscar_select('turnos','id_turno','turno');
        $fuentes = $this->MyModel->buscar_select('fuentes','id_fuente','fuente');
        $hobbies = $this->MyModel->buscar_select('hobbies','id_hobbies','hobbies');
        $factor = $this->MyModel->buscar_select('factor','id_factor','factor');
        
        $data['turnos'] = $turnos;
        $data['cargos'] = $cargos;
        $data['comunas'] = $comunas;
        $data['fuentes'] = $fuentes;
        $data['hobbie'] = $hobbies;
        $data['factor'] = $factor;
        if ($this->input->post('rut')) {
            $rut = $this->input->post('rut');
            $nombre = $this->input->post('nombre');
            $sexo = $this->input->post('sexo');
            $fecha_nacimiento = $this->input->post('fecha_nac');
            $estado_civil = $this->input->post('estado_civil');
            $nacionalidad = $this->input->post('nacionalidad');
            $direccion = $this->input->post('direccion');
            $comuna = $this->input->post('comuna');
            $celular = $this->input->post('celular');
            $email = $this->input->post('email');
            $fono = $this->input->post('fono');
            $edad = $this->input->post('edad');
            $hijos = $this->input->post('hijos');
            $edades_hijos = $this->input->post('edades_hijos');
            $discapacidad = $this->input->post('discapacidad');
            $familiar = $this->input->post('familiar');
            $enfermedad = $this->input->post('enfermedad');
            $cargo_postula = $this->input->post('id_cargo');
            $educacion_media = $this->input->post('educacion_media');
            $media_tecnica = $this->input->post('media_tecnica');
            $educacion_superior = $this->input->post('educacion_superior');
            $carrera = $this->input->post('carrera');
            $otro_educacion = $this->input->post('otro');
            $empresa_1 = $this->input->post('empresa_1');
            $cargo_e1 = $this->input->post('cargo_e1');
            $duracion_e1 = $this->input->post('duracion_e1');
            $motivo_e1 = $this->input->post('motivo_e1');
            $duracion_e1 = $this->input->post('duracion_e2');
            $empresa_2 = $this->input->post('empresa_2');
            $cargo_e2 = $this->input->post('cargo_e2');
            $duracion_e2 = $this->input->post('duracion_e2');
            $motivo_e2 = $this->input->post('motivo_e2');
            $duracion_e2 = $this->input->post('duracion_e2');
            $empresa_referencia = $this->input->post('empresa_referencia');
            $jefe_referencia = $this->input->post('jefe_referencia');
            $contacto_referencia = $this->input->post('contacto_referencia');
            $trabajo_serbanc = $this->input->post('optionsRadios');
            $manejo_pc = $this->input->post('manejo_pc');
            $expectativas_renta = $this->input->post('renta');
            $acepta_condiciones = $this->input->post('condiciones');
            $firmo = $this->input->post('firmo');
            $prefiltro = $this->input->post('prefiltro');
            $fuente = $this->input->post('id_fuente');
            $fecha_entrevista = $this->input->post('fecha_entrevista');
            $hora_entrevista = $this->input->post('hora_entrevista');
			$hora_entrevista = explode(' ',$hora_entrevista);
			$hora_entrevista = $hora_entrevista[0];
            $fecha_entrevista = date("Y-m-d", strtotime($fecha_entrevista));
            $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
            
            $espera = $this->input->post('espera');
            $valora = $this->input->post('valora');
            $condiciones = $this->input->post('condiciones');

            $paterno = $this->input->post('paterno');
            $materno = $this->input->post('materno');
            $r_social = $this->input->post('razon_social');

            $entrevistado = $this->input->post('entrevistado');

            $hora_separada = explode(" ", $hora_entrevista);
            $hora_separada[0]; // hora
            $hora_separada[1]; // am o pm
                        
            $nueva_persona = array(
                'rut' => $rut,
                'nombre' => $nombre,
                'fecha_nacimiento' => $fecha_nacimiento,
                'sexo' => $sexo,
                'edo_civil' => $estado_civil,
                'direccion' => $direccion,
                'comuna' => $comuna,
                'fono_movil' => $celular,
                'fono_fijo' => $fono,
                'nacionalidad' => $nacionalidad,
                'num_hijos' => $hijos,
                'edad_hijos' => $edades_hijos,
                'discapacidad' => $discapacidad,
                'enfermedad' => $enfermedad,
                'contacto_familiar' => $familiar,
                'edad' => $edad,
                'email' => $email,
                'paterno' => $paterno,
                'materno' => $materno,
                'razon_social' => $r_social
            ); 
			//echo $fecha_entrevista.' '.$hora_entrevista.':00';
            $nuevo_postulante = array(
                'rut' => $rut,
                'referencia_empresa' => $empresa_referencia,
                'nombre_referencia' => $jefe_referencia,
                'contacto_referencia' => $contacto_referencia,
                'manejo_pc' => $manejo_pc,
                'acepta_condicion' => $acepta_condiciones,
                'pretension_renta' => $expectativas_renta,
                'id_cargo' => $cargo_postula,
                'prefiltro' => $prefiltro,
                'fecha_entrevista' => $fecha_entrevista.' '.$hora_separada[0].':00',
                'id_fuente' => $fuente,
                'entrevistado' => $entrevistado,
                'firmo' => $firmo
            );
            
            $nuevo_antecedente_academico = array(
                'educacion_media' => $educacion_media,
                'rut' => $rut,
                'educacion_media_tecnica' => $media_tecnica,
                'educacion_superior' => $educacion_superior,
                'carrera' => $carrera,
                'otro' => $otro_educacion
            );
            
            $encuesta_expectativas = array(
                'rut' => $rut,
                'espera' => $espera,
                'valora' => $valora,
                'condiciones' => $condiciones
            );
            
            $nuevo_antecedente_laboral = array(
                'rut' => $rut, 
                'empresa1' => $empresa_1,
                'cargo1' => $cargo_e1,
                'duracion1' => $duracion_e1,
                'motivo_salida1' => $motivo_e1,
                'empresa2' => $empresa_2,
                'cargo2' => $cargo_e2,
                'duracion2' => $duracion_e2,
                'motivo_salida2' => $motivo_e2,
            );
            $this->MyModel->agregar_model('personas',$nueva_persona,'id_persona',$this->input->post('id_persona'));
            $postulante_id = $this->MyModel->agregar_model('postulantes',$nuevo_postulante,'id_postulante',$this->input->post('id_postulante'));
            $this->db->delete('turnos_postulantes', array('id_postulante' => $this->input->post('id_postulante'))); 
            foreach ($turnos as $id => $t) {
                if ($this->input->post($id)) {
                    $nuevo_turno_postulante = array(
                        'id_postulante' => $this->input->post('id_postulante'),
                        'id_turno' => $id
                    );
                    $this->MyModel->agregar_model('turnos_postulantes',$nuevo_turno_postulante);
                }
            }
            
               //actualizar hobbies
                 $this->db->where('id_postulantes', $this->input->post('id_postulante'));
                 $this->db->delete('hobbies_personas');
               //inserto relaciones aplicaciones
                 $valores_hobbies = $this->input->post('hobbies');
                 foreach($valores_hobbies as $k=>$a){
                    $hobbie = array('id_postulantes' =>$this->input->post('id_postulante'), 'id_hobbies'=>$k);                     
                    $this->db->insert('hobbies_personas',$hobbie);
                 }
              //actualizar hobbies
              
              //actualizar factor
                 $this->db->where('id_postulantes', $this->input->post('id_postulante'));
                 $this->db->delete('factor_personas');
               //inserto relaciones aplicaciones
                 $valores_hobbies = $this->input->post('factor');
                 foreach($valores_hobbies as $k=>$a){
                    $factor = array('id_postulantes' =>$this->input->post('id_postulante'), 'id_factor'=>$k);                     
                    $this->db->insert('factor_personas',$factor);
                 }
              //actualizar factor
            
            $this->MyModel->agregar_model('expectativas',$encuesta_expectativas,'id_expectativa',$this->input->post('id_expectativa'));
                        
            $this->MyModel->agregar_model('antecedentes_academicos',$nuevo_antecedente_academico,'id_antecedente_academico',$this->input->post('id_antecedente_academico'));
            $this->MyModel->agregar_model('antecedentes_laborales',$nuevo_antecedente_laboral,'id_antecedente',$this->input->post('id_antecedente'));
            redirect(base_url("index.php/Gestion/postulantes"));
        }
        
        $this->load->view('common/header');
        $this->load->view('gestion/edit/postulante',$data);
        $this->load->view('common/footer');
        
    }
    
    public function postulante_prueba($id_postulante = null){
        $data['id_postulante'] = $id_postulante;
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->where('postulantes.id_postulante = '.$id_postulante);
        $query = $this->db->get();
        $postulante = $query->result_array();
        $resultado_competencia_array = $this->MyModel->buscar_model('resultado_competencias',array('rut' => $postulante[0]['rut']));
        $resultado_competencia = array();
        foreach ($resultado_competencia_array as $r) {
            $resultado_competencia[$r['id_competencia_item']] = $r['calificacion'];
        }
        $this->db->select('competencias_item.id_competencia, competencias_item.id_competencias_item, competencias_item.descripcion, competencias_item.ponderacion');
        $this->db->from('competencias_item');
        $this->db->join('competencias','competencias.id_competencia = competencias_item.id_competencia');
        $this->db->where('competencias_item.activo = 1 and competencias_item.id_cargo = 1');
        $query = $this->db->get();
        $competencias_item = $query->result_array();
        $data['competencias_item'] = $competencias_item;
        $competencias = $this->MyModel->buscar_model('competencias',array('id_cargo' => 1, 'activo' => 1));
        $data['competencias'] = $competencias;
        $data['postulante'] = $postulante;
        $data['resultado_competencia'] = $resultado_competencia;
        
        $usuarios = $this->MyModel->buscar_select('usuarios','id_usuario','nombre'); //FALTA FILTRAR POR PERFILES        
        $data['usuarios'] = $usuarios;

        $evaluadores = $this->MyModel->buscar_select('evaluadores','id_evaluador','nombre_evaluador'); //FALTA FILTRAR POR PERFILES        
        $data['evaluadores'] = $evaluadores;

        if ($this->input->post('rut')) {
           $rut = $this->input->post('rut');
           $nombre = $this->input->post('nombre');
           $edo_civil = $this->input->post('edo_civil');
           $hijos = $this->input->post('hijos');
           $edades_hijos = $this->input->post('edades_hijos');
           $cargo = $this->input->post('cargo');
           $resultado_psicologica = $this->input->post('resultado_psicologica');
           $aprobacion = $this->input->post('aprobacion');
           $comentario = $this->input->post('comentario');
           //$competencias = 
           //Actualizamos datos de la persona
           $update_persona = array(
             'nombre' => $nombre,
             'edo_civil' => $edo_civil,
             'num_hijos' => $hijos,
             'edad_hijos' => $edades_hijos,
             'id_cargo' => $cargo,
           );
            $this->db->where('rut',$this->input->post('rut'));
            $this->db->update('personas', $update_persona); 
            
            //Actualizamos datos del postulante
            $update_postulante = array(
                'evaluador_id' => $this->input->post('evaluador')
            );
            $this->db->where('rut',$this->input->post('rut'));
            $this->db->update('postulantes', $update_postulante); 
            
            //Competencias
            $calificacion = $this->input->post('calificacion');
            $this->db->delete('resultado_competencias', array('rut' => $this->input->post('rut')));
            foreach ($calificacion as $id => $c) {
               $nuevo_resultado = array(
                    'rut' => $this->input->post('rut'),
                    'id_competencia_item' => $id,
                    'calificacion' => $c,
                    'comentario' => $this->input->post('comentario'),
                    'otros' => $this->input->post('otro')
               );
               $this->db->insert('resultado_competencias', $nuevo_resultado);
            }
            
            $data_result = array(
                   'rut' => $rut,
                   'observacion' => $comentario ,
                   'resultado_final' => $aprobacion
            );
            $this->db->insert('resultado_evaluacion_psicologica', $data_result);

            redirect(base_url().'index.php/Gestion/postulantes');            
        }
        $this->load->view('common/header');
        $this->load->view('gestion/edit/postulante_prueba',$data);
        $this->load->view('common/footer');
    }
    public function postulante_califica(){
        $id_postulante = $this->input->post('id_postulante');
        
        $cargos = $this->MyModel->buscar_select('cargos','id_cargo','cargo');    
        $data['cargos'] = $cargos;

        $this->db->from('areas');
        $this->db->join('solicitudes','solicitudes.id_area=areas.id_area');
        $this->db->where('solicitudes.cantidad_entregada < solicitudes.cantidad_solicitada');
        $this->db->where('solicitudes.validado = 1');
        $this->db->group_by('areas.id_area');
        $query = $this->db->get();
        $areas = $query->result_array();   
        $data['areas'] = $areas;
        
        /*
        $this->db->from('carteras');
        $this->db->join('solicitudes','solicitudes.id_cartera=carteras.id_cartera');
        $this->db->group_by('carteras.id_cartera');
        $query = $this->db->get();
        $carteras = $query->result_array();
        $data['carteras'] = $carteras;
        */
        
        $motivos_no_califica = $this->MyModel->buscar_select('motivo_no_califica','id_motivo_no_califica','motivo');
        $data['motivos_no_califica'] = $motivos_no_califica;
        
        $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno, personas.materno,postulantes.id_cargo,personas.email,postulantes.id_cargo');
        $this->db->from('postulantes');
        $this->db->join('personas','postulantes.rut=personas.rut');
        $this->db->where('postulantes.id_postulante = '.$id_postulante);
        $query = $this->db->get();
        $postulante = $query->result_array();       
        $data['postulante']=$postulante;

        $this->db->from('sucursales');
        $query = $this->db->get();
        $sucu = $query->result_array();       
        $data['sucu']=$sucu;

        $this->load->view('gestion/modal/postulante_califica',$data);
    }
    public function eliminar_postulante(){
        $id_postulante =$this->input->post('id_postulante');
        //postulantes
        $this->db->where('id_postulante',$id_postulante);
        $this->db->delete('postulantes');
        $ins_solicitud = $this->db->affected_rows();        
        //factor
        $this->db->where('id_postulantes',$id_postulante);
        $this->db->delete('factor_personas');
        //hobbies
        $this->db->where('id_postulantes',$id_postulante);
        $this->db->delete('hobbies_personas');
                
        if($ins_solicitud==1){
            $this->session->set_flashdata('msje_eliminar', '1');
            redirect(base_url().'/index.php/gestion/postulantes','refresh');
        }else{
            $this->session->set_flashdata('msje_eliminar', '2');
            redirect(base_url().'/index.php/gestion/postulantes','refresh');
        }
         
    }
    
    public function postulante_califica_guardar(){
        $rut = $this->input->post('rut');
        $califica=$this->input->post('califica');
        $area = $this->input->post('area');
        $cartera = $this->input->post('cartera');
        
        $nombre = $this->input->post('nombre');
        $rut = $this->input->post('rut');
        $email = $this->input->post('email');
        $id_sucursal = $this->input->post('id_sucursal');
        $supervisor = $this->input->post('supervisor');
        $id_supervisor = $this->input->post('id_supervisor');
        
        $fecha_presentacion = $this->input->post('fecha_presentacion');
        $hora_presentacion = $this->input->post('hora_presentacion');

        $hora_separada = explode(" ", $hora_presentacion);
        $hora_separada[0]; //hora
        $hora_separada[1]; //am o pm

        $update_postulante = array(
                'id_cartera' => $cartera,
                'id_area' => $area,
                'sucursal_id' => $id_sucursal,
                'fecha_asignacion' => $fecha_presentacion.' '.$hora_separada[0].':00',
                'id_supervisor_califica' => $id_supervisor
        );

        if ($califica == 0) {
            $update_postulante['id_motivo_no_califica'] = $this->input->post('id_motivo_no_califica');
            //$id_solicitud = 0;
        } else {
            $this->db->from('solicitudes');
            $this->db->where(array('id_cartera' => $cartera, 'id_area' => $area, 'id_cargo' => $this->input->post('id_cargo')));
            $this->db->order_by('solicitudes.id_solicitud');
            $this->db->limit(1);
            $query = $this->db->get();
            $solicitud = $query->result_array();
            $update_solicitud = array(
                'cantidad_entregada' => $solicitud[0]['cantidad_entregada']+1
            );
            if (($solicitud[0]['cantidad_entregada'] + 1) == $solicitud[0]['cantidad_solicitada']) { 
                $update_solicitud['activo'] = 0;
            }
            $this->db->where('id_solicitud',$solicitud[0]['id_solicitud']);
            $this->db->update('solicitudes', $update_solicitud);
            $id_solicitud = $solicitud[0]['id_solicitud'];
            $update_postulante['id_solicitud'] = $id_solicitud;
            
            $password = substr ($rut, 0, -2);
            $password = str_ireplace(".","",$password);                        
            $passwordx = md5($password);
                        
            $data = array(
                'rut' => $rut ,
                'usuario' => $password,
                'nombre' => $nombre,
                'id_rango' => '1',
                'password' => $passwordx,
                'mail' => $email,
                'anexo' => '0000',
                'img' => 'http://172.16.10.15/SoftSkills_People/assets/dist/img/avatar5.png'
            );            
            $this->db->insert('usuarios', $data); 
            
        }
        $update_persona = array('clasificado' => $califica);
        
        $this->db->where('rut',$rut);
        $this->db->update('postulantes', $update_postulante);
        
        $this->db->where('rut',$rut);
        $this->db->update('personas', $update_persona);
        
        redirect(base_url().'index.php/gestion/postulantes');
    }
    public function turnos(){
        $turnos = $this->MyModel->buscar_model('turnos');
        $data['turnos'] = $turnos;
        $this->load->view('common/header');
        $this->load->view('gestion/turnos',$data);
        $this->load->view('common/footer');
    }
    public function agregar_turno(){
        $turno = $this->input->post('turno');
        if(!empty($turno)) {
            $this->MyModel->agregar_model('turnos',array('turno' => $turno));
            redirect(base_url("index.php/Gestion/turnos"));
        }
        $this->load->view('common/header');
        $this->load->view('gestion/add/turno');
        $this->load->view('common/footer');
    }
    public function competencias(){
        $this->db->from('competencias');
        $this->db->join('cargos','cargos.id_cargo = competencias.id_cargo');
        $query = $this->db->get();
        $competencias = $query->result_array();
        $data['competencias'] = $competencias;
        $this->load->view('common/header');
        $this->load->view('gestion/competencias',$data);
        $this->load->view('common/footer');
    }
    public function agregar_competencia(){

        $this->load->view('common/header');
        $this->load->view('gestion/add/competencia');
        $this->load->view('common/footer');
    }
    public function editar_competencia($id = null){
        if ($this->input->post('competencia')) {
            $update_competencia = array(
                'competencia' => $this->input->post('competencia'),
                'ponderacion' => $this->input->post('ponderacion_competencia')
            );
            $this->db->where('id_competencia',$this->input->post('id_competencia'));
            $this->db->update('competencias', $update_competencia); 
            
            //Elimino los items para volverlos a agregar
            $this->db->delete('competencias_item', array('id_competencia' => $this->input->post('id_competencia')));
            
            $items = $this->input->post('item_competencia');
            $pesos = $this->input->post('peso_item');
            $ponderaciones = $this->input->post('ponderacion_item[]');
            foreach ($items as $key => $i) {
                if (!empty($i)){
                    $nuevo_item_competencia = array(
                        'id_competencia' =>  $this->input->post('id_competencia'),
                        'descripcion' => $i,
                        'peso' => $pesos[$key],
                        'ponderacion' => $ponderaciones[$key]
                    );
                    $this->db->insert('competencias_item', $nuevo_item_competencia);
                }
            }
            redirect(base_url("index.php/Gestion/competencias"));
        }
        $this->db->select('competencias_item.descripcion,competencias_item.peso,competencias_item.ponderacion, competencias.competencia, competencias.ponderacion as c_ponderacion');
        $this->db->from('competencias');
        $this->db->join('competencias_item','competencias.id_competencia = competencias_item.id_competencia','left');
        $this->db->where('competencias.id_competencia = '.$id);
        $query = $this->db->get();
        $competencias = $query->result_array();
        $data['competencias'] = $competencias;
        $data['id'] = $id;
        $this->load->view('common/header');
        $this->load->view('gestion/edit/competencia',$data);
        $this->load->view('common/footer');
    }

    public function fuentes(){
        $fuentes = $this->MyModel->buscar_model('fuentes');
        $data['fuentes'] = $fuentes;
        $this->load->view('common/header');
        $this->load->view('gestion/fuentes',$data);
        $this->load->view('common/footer');
    }
    public function agregar_fuente(){
        $fuente = $this->input->post('fuente');
        if(!empty($fuente)) {
            $this->MyModel->agregar_model('fuentes',array('fuente' => $fuente));
            redirect(base_url("index.php/Gestion/fuentes"));
        }
        $this->load->view('common/header');
        $this->load->view('gestion/add/fuente');
        $this->load->view('common/footer');
    }
    public function motivo_no_califica(){
        $motivos = $this->MyModel->buscar_model('motivo_no_califica');
        $data['motivos'] = $motivos;
        $this->load->view('common/header');
        $this->load->view('gestion/motivo_no_califica',$data);
        $this->load->view('common/footer');
    }
    public function editar_motivo($id_motivo){ 
        if(empty($id_motivo)){
           $id_motivo = $this->input->post('id_sucursal');
        }
        //consulto por pm
        $this->db->from('motivo_no_califica');
        $this->db->where('motivo_no_califica.id_motivo_no_califica = '.$id_motivo);        
        $query = $this->db->get();
        $motivo = $query->result_array();
        $data['motivo'] = $motivo;

        if($this->input->post('nombre_motivo')) {
             $nombre = $this->input->post('nombre_motivo');
             $actualiza_motivo = array('motivo' => $nombre);
             $this->MyModel->agregar_model('motivo_no_califica',$actualiza_motivo,'id_motivo_no_califica',$this->input->post('id_motivo'));                
             
             redirect(base_url("index.php/Gestion/motivo_no_califica"));

        }
        $this->load->view('common/header');
        $this->load->view('gestion/edit/editar_motivo',$data);
        $this->load->view('common/footer');
    }
    public function agregar_motivo(){
        $motivo = $this->input->post('motivo');
        if(!empty($motivo)) {
            $this->MyModel->agregar_model('motivo_no_califica',array('motivo' => $motivo));
            redirect(base_url("index.php/Gestion/motivo_no_califica"));
        }
        $this->load->view('common/header');
        $this->load->view('gestion/add/motivo');
        $this->load->view('common/footer');
    }
    public function entrevistas(){
        $this->db->select('postulantes.id_postulante, personas.rut ,DATE(postulantes.fecha_entrevista) as fecha, TIME(postulantes.fecha_entrevista) as hora, personas.nombre');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        //$this->db->where('date(fecha_entrevista) >= curdate()');
        $query = $this->db->get();
        $entrevistas = $query->result_array();
        $array_entrevistas = array();
        $i = 0;
        foreach($entrevistas as $a){
            $array_entrevistas[$i]['title'] = $a['nombre'].'-'.$a['hora'];
            $array_entrevistas[$i]['start'] = $a['fecha'];
			$array_entrevistas[$i]['id'] = $a['id_postulante'];
            $array_entrevistas[$i]['url'] = '';
            $i++;
        }
        $data['array_entrevistas'] = $array_entrevistas;
        $this->load->view('common/header');
        $this->load->view('gestion/entrevistas',$data);
        $this->load->view('common/footer');
    }
    public function solicitudes(){
    $this->db->from('solicitudes');
        $this->db->join('areas','areas.id_area = solicitudes.id_area');
        $this->db->join('carteras','carteras.id_cartera = solicitudes.id_cartera');
        $this->db->join('usuarios','usuarios.id_usuario = solicitudes.id_usuario_solicitante');
        $this->db->join('cargos','cargos.id_cargo = solicitudes.id_cargo');
        $this->db->where('solicitudes.cantidad_entregada < solicitudes.cantidad_solicitada');
        $this->db->where('solicitudes.activo = 1');
        $query = $this->db->get();
        $solicitudes = $query->result_array();
        $data['solicitudes'] = $solicitudes;
        $this->load->view('common/header');
        $this->load->view('gestion/solicitudes',$data);
        $this->load->view('common/footer');
    }
    
      function valida_rut(){##Validar Rut##
        $id = $this->input->post('rut');                
        if(!empty($id)){        
            $this->db->select('*');        
            $this->db->from('postulantes');
            $this->db->where('rut="'.$id.'"');
            $query = $this->db->get();
            $postulante = $query->result_array();            
            if(!empty($postulante)){
                $data['existe'] = 'SI';
				$data['id'] = $postulante[0]['id_postulante'];
            }else{
                $data['existe'] = 'NO';
            }
        }
        echo json_encode($data);
    }
    function agregar_hobbie(){
        $hobbie = $this->input->post('hobbie');        
            $dato = array(
               'hobbies' => $hobbie
            );
            
            
            $this->db->select('*');        
            $this->db->from('hobbies');
            $this->db->where('hobbies="'.$hobbie.'"');
            $query = $this->db->get();
            $hobbies = $query->result_array();            
            if (!empty($hobbies)) {
            
                $data['guardo'] = 'NO';
            
            }else{
                
                $this->db->insert('hobbies', $dato); 
                $ins_hobbies = $this->db->affected_rows();                        
                if ($ins_hobbies==1) {
                    $data['guardo'] = 'SI';
                }else{
                    $data['guardo'] = 'NO';
                }
                
            }                  
        echo json_encode($data);       
    }
    function mostrar_hobbies($id_postulante=null){
        $hobbies = $this->MyModel->buscar_select('hobbies','id_hobbies','hobbies');
        $data['hobbies'] = $hobbies;
        
        //hobbies
        $this->db->from('hobbies_personas');
        $this->db->join('hobbies','hobbies.id_hobbies = hobbies_personas.id_hobbies');
        $this->db->where('hobbies_personas.id_postulantes = '.$id_postulante);
        $query = $this->db->get();
        $hobbies_seleccionadas = $query->result_array();                
        $data['hobbies_seleccionadas'] = $hobbies_seleccionadas;
        //hobbies        
        
        $this->load->view('gestion/modal/mostrar_hobbies',$data);
    }
    
    function agregar_factor(){
        $factor = $this->input->post('factor');        
            $dato = array(
               'factor' => $factor
            );            
            
            $this->db->select('*');        
            $this->db->from('factor');
            $this->db->where('factor="'.$factor.'"');
            $query = $this->db->get();
            $factor = $query->result_array();            
            if (!empty($factor)) {
            
                $data['guardo'] = 'NO';
            
            }else{
                
                $this->db->insert('factor', $dato); 
                $ins_factor = $this->db->affected_rows();                        
                if ($ins_factor==1) {
                    $data['guardo'] = 'SI';
                }else{
                    $data['guardo'] = 'NO';
                }
                
            }                  
        echo json_encode($data);       
    }
    function mostrar_factor($id_postulante=null){
        $factor = $this->MyModel->buscar_select('factor','id_factor','factor');
        $data['factor'] = $factor;
        
        //factor
        $this->db->from('factor_personas');
        $this->db->join('factor','factor.id_factor = factor_personas.id_factor');
        $this->db->where('factor_personas.id_postulantes = '.$id_postulante);
        $query = $this->db->get();
        $factor_seleccionadas = $query->result_array();                
        $data['factor_seleccionadas'] = $factor_seleccionadas;
        //factor      
        
        $this->load->view('gestion/modal/mostrar_factor',$data);
    }
    
        //dashboard
        public function dashboard(){
        $guardar = $this->input->post('guardar');
        //inducciones restantes
        $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->where('postulantes.id_solicitud is null and postulantes.entrevistado=0');        
        $query = $this->db->get();
        $pendiente_entrevista = $query->result_array();
        $data['entrevistap'] = $pendiente_entrevista;

        //inducciones para hoy
        $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno,postulantes.entrevistap,postulantes.observacion');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->where("postulantes.entrevistado=0 and DATE_FORMAT(postulantes.fecha_entrevista,'%Y-%m-%d') = curdate()");        
        $query_h = $this->db->get();
        //postulantes.id_solicitud is null and
        //muestra query
        //$this->db->last_query();
        $hoy_entrevista = $query_h->result_array();
        $data['entrevistah'] = $hoy_entrevista;

        if($guardar==1){
            $postulantes = $this->input->post('postulante');
             
                foreach($data['entrevistah'] as $i){
                    //borro los actuales
                    $borrar = array('entrevistap' =>NULL);
                    $this->db->where('id_postulante', $i['id_postulante']);
                    $this->db->update('postulantes', $borrar);
                }
                if(!empty($postulantes)){
                    //agrego los que corresponden                
                    foreach($postulantes as $k=>$a){
                        //echo $k;                    
                        $test = array('entrevistap' =>'1');
                        $this->db->where('id_postulante', $k);
                        $this->db->update('postulantes', $test);                    
                    }
                }
        }
        $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno,postulantes.entrevistap,postulantes.observacion');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->where("postulantes.entrevistado=0 and DATE_FORMAT(postulantes.fecha_entrevista,'%Y-%m-%d') = curdate()");        
        $query_h = $this->db->get();
        //postulantes.id_solicitud is null and
        //muestra query
        //$this->db->last_query();
        $hoy_entrevista = $query_h->result_array();
        $data['entrevistah'] = $hoy_entrevista;
        
        //postulantes inducidos
        $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->where('postulantes.entrevistado=1');        
        $query_e = $this->db->get();
        $entrevistado = $query_e->result_array();
        $data['entrevistado'] = $entrevistado;               

        $this->db->select('postulantes.id_postulante, personas.rut ,DATE(postulantes.fecha_entrevista) as fecha, TIME(postulantes.fecha_entrevista) as hora, personas.nombre');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        //$this->db->where('date(fecha_asignacion) >= curdate()');
        $query = $this->db->get();
        $entrevistas = $query->result_array();
        $array_entrevistas = array();
        $i = 0;
        foreach($entrevistas as $a){
            $array_entrevistas[$i]['title'] = $a['nombre'].'-'.$a['hora'];
            $array_entrevistas[$i]['start'] = $a['fecha'];
            $array_entrevistas[$i]['id'] = $a['id_postulante'];
            $array_entrevistas[$i]['url'] = '';
            $i++;
        }
        $data['array_entrevistas'] = $array_entrevistas;

        //AREA CHARTS INI
            $this->db->select("count(id_postulante) as postulantes, DATE(postulantes.fecha_entrevista) as fecha, week(postulantes.fecha_entrevista) as semana,date_format(postulantes.fecha_entrevista, '%Y-%m'), date_format(curdate(), '%Y-%m')");
            $this->db->from('postulantes');
            $this->db->join('personas','personas.rut = postulantes.rut');
            $this->db->where("date_format(postulantes.fecha_entrevista, '%Y-%m') = date_format(curdate(), '%Y-%m')");
            //$this->db->group_by("date_format(postulantes.fecha_entrevista, '%Y-%m')");
            $this->db->group_by("semana");
            $query = $this->db->get();
            $entrevis = $query->result_array();
            $array_entre = array();
            $g = 0;          
            foreach($entrevis as $a){
                //$array_entre[$g]['y'] = $a['fecha'].',item:'.$a['postulantes'];
                $array_entre[] = array('y' => $a['fecha'], 'item1' => $a['postulantes']);
                $g++;
            }
            $data['array_entre'] = json_encode($array_entre);
            //AREA CHARTS FIN            
            
            //DONUT INI
            $tot_entrevista_si = '';
            $tot_entrevista_no = '';
            for($i=1;$i<=2;$i++){
            $this->db->select("postulantes.id_postulante, DATE(postulantes.fecha_entrevista) as fecha, week(postulantes.fecha_entrevista) as semana,
            date_format(postulantes.fecha_entrevista, '%Y-%m'), date_format(curdate(), '%Y-%m'),postulantes.entrevistado");
            $this->db->from('postulantes');
            $this->db->join('personas','personas.rut = postulantes.rut');
                if($i==1){
                    $this->db->where("(date_format(postulantes.fecha_entrevista, '%Y-%m') = date_format(curdate(), '%Y-%m') and postulantes.entrevistado=0) or postulantes.entrevistado is null");
                }else{
                    $this->db->where("date_format(postulantes.fecha_entrevista, '%Y-%m') = date_format(curdate(), '%Y-%m') and postulantes.entrevistado=1");
                }
            $query = $this->db->get();
            if($i==1){
                $tot_entrevista_no = $query->result_array();
            }else{
                $tot_entrevista_si = $query->result_array();
            }
            }
            $data['tot_entrevista_no'] = count($tot_entrevista_no);
            $data['tot_entrevista_si'] = count($tot_entrevista_si);
            //DONUT FIN

        $this->load->view('common/header');
        $this->load->view('gestion/dashboard',$data);
        $this->load->view('common/footer');
    }
    
    public function postulante_comentario(){
            $id_postulante = $this->input->post('id_postulante');
            $observacion = $this->input->post('observacion');        
            $data = array('observacion' => $observacion);
            $this->db->where('id_postulante', $id_postulante);
            $this->db->update('postulantes', $data);
            $ins_comentario = $this->db->affected_rows();
                      
            if($ins_comentario==1){
                $this->session->set_flashdata('msje_comentario', '1');
                redirect(base_url().'/index.php/gestion/dashboard','refresh');
            }else{
                $this->session->set_flashdata('msje_comentario', '2');
                redirect(base_url().'/index.php/gestion/dashboard','refresh');
            } 
    }
}
?>