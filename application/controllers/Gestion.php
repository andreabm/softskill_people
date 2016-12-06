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
	}
    
    public function postulantes(){
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->where('postulantes.id_solicitud is null');
        $query = $this->db->get();
        $postulantes = $query->result_array();
        $data['postulantes'] = $postulantes;
        $this->load->view('common/header');
        $this->load->view('gestion/postulantes',$data);
        $this->load->view('common/footer');
    }
    
    public function ver_postulante(){
        $id_postulante = $this->input->post('id_postulante');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->join('fuentes','postulantes.id_fuente = fuentes.id_fuente');
        $this->db->join('cargos','postulantes.id_cargo = cargos.id_cargo');
        $this->db->where('postulantes.id_postulante = '.$id_postulante);
        $query = $this->db->get();
        $postulante = $query->result_array();
        $data['postulante']=$postulante;
        
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
        $data['turnos'] = $turnos;
        $data['cargos'] = $cargos;
        $data['comunas'] = $comunas;
        $data['fuentes'] = $fuentes;
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
            $fono = $this->input->post('estado_civil');
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
            $fecha_entrevista = date("Y-m-d", strtotime($fecha_entrevista));
            $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
            
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
                'fecha_entrevista' => $fecha_entrevista.' '.$hora_entrevista.':00',
                'id_fuente' => $fuente
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
            $this->MyModel->agregar_model('antecedentes_academicos',$nuevo_antecedente_academico);
            $this->MyModel->agregar_model('antecedentes_laborales',$nuevo_antecedente_laboral);
            redirect(base_url("index.php/Gestion/postulantes"));
        } 
        $this->load->view('common/header');
        $this->load->view('gestion/add/postulante',$data);
        $this->load->view('common/footer');
        
    }
    
    public function editar_postulante($id_postulante){
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->join('cargos','postulantes.id_cargo = cargos.id_cargo', 'left');
        $this->db->join('comunas','personas.comuna = comunas.comuna', 'left');
        $this->db->join('antecedentes_academicos','antecedentes_academicos.rut = personas.rut','left');
        $this->db->join('antecedentes_laborales','antecedentes_laborales.rut = personas.rut','left');
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
        
        $comunas = $this->MyModel->buscar_select('comunas','comuna','comuna');
        $cargos = $this->MyModel->buscar_select('cargos','id_cargo','cargo');
        $turnos = $this->MyModel->buscar_select('turnos','id_turno','turno');
        $fuentes = $this->MyModel->buscar_select('fuentes','id_fuente','fuente');
        $data['turnos'] = $turnos;
        $data['cargos'] = $cargos;
        $data['comunas'] = $comunas;
        $data['fuentes'] = $fuentes;
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
            $fono = $this->input->post('fono');
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
            $fecha_entrevista = date("Y-m-d", strtotime($fecha_entrevista));
            $fecha_nacimiento = date("Y-m-d", strtotime($fecha_nacimiento));
            
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
                'fecha_entrevista' => $fecha_entrevista.' '.$hora_entrevista.':00',
                'id_fuente' => $fuente
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
        if ($this->input->post('rut')) {
            $rut = $this->input->post('rut');
            $nombre = $this->input->post('nombre');
           $edo_civil = $this->input->post('edo_civil');
           $hijos = $this->input->post('hijos');
           $edades_hijos = $this->input->post('edades_hijos');
           $cargo = $this->input->post('cargo');
           $resultado_psicologica = $this->input->post('resultado_psicologica');
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
                    'calificacion' => $c
               );
               $this->db->insert('resultado_competencias', $nuevo_resultado);
            }
            redirect(base_url().'index.php/Gestion/postulantes');
            
        }
        $this->load->view('common/header');
        $this->load->view('gestion/edit/postulante_prueba',$data);
        $this->load->view('common/footer');
    }
    public function postulante_califica(){
        $id_postulante = $this->input->post('id_postulante');
        
        $this->db->from('areas');
        $this->db->join('solicitudes','solicitudes.id_area=areas.id_area');
        $this->db->group_by('areas.id_area');
        $query = $this->db->get();
        $areas = $query->result_array();   
        $data['areas'] = $areas;
        
        $this->db->from('carteras');
        $this->db->join('solicitudes','solicitudes.id_cartera=carteras.id_cartera');
        $this->db->group_by('carteras.id_cartera');
        $query = $this->db->get();
        $carteras = $query->result_array();   
        $data['carteras'] = $carteras;
        
        $motivos_no_califica = $this->MyModel->buscar_select('motivo_no_califica','id_motivo_no_califica','motivo');
        $data['motivos_no_califica'] = $motivos_no_califica;
        
        $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,postulantes.id_cargo');
        $this->db->from('postulantes');
        $this->db->join('personas','postulantes.rut=personas.rut');
        $this->db->where('postulantes.id_postulante = '.$id_postulante);
        $query = $this->db->get();
        $postulante = $query->result_array();       
        $data['postulante']=$postulante;
        
        $this->load->view('gestion/modal/postulante_califica',$data);
    }
    
    public function postulante_califica_guardar(){
        $rut = $this->input->post('rut');
        $califica=$this->input->post('califica');
        $area = $this->input->post('area');
        $cartera = $this->input->post('cartera');
        $update_postulante = array(
                'id_cartera' => $cartera,
                'id_area' => $area,
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
        }
        $update_persona = array(
            'clasificado' => $califica
        );
        
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
        $this->db->select('competencias_item.descripcion,competencias_item.peso,competencias_item.ponderacion, competencias.competencia, competencias.ponderacion');
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
        $this->db->where('date(fecha_entrevista) >= curdate()');
        $query = $this->db->get();
        $entrevistas = $query->result_array();
        $array_entrevistas = array();
        $i = 0;
        foreach($entrevistas as $a) {
            $array_entrevistas[$i]['title'] = $a['nombre'].'-'.$a['hora'];
            $array_entrevistas[$i]['start'] = $a['fecha'];
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

}
?>