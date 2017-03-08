<?php
class Operaciones extends CI_Controller {
    
	public function __construct(){	
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
    $this->load->library('email');
    $this->load->library('form_validation');
    $this->load->library('javascript');
    $this->load->library('session');
	$this->load->library('parser');
    $this->load->library('html2pdf');
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
	 // print_r($this->menu_lista);
	  $this->rango = $this->session->userdata['id_rango'];
      $this->action = $action;
      $this->controlador = $controlador;
	  $this->permisos = $permisos;
	  
	  return true;
  	}
	
    public function solicitudes(){
		$this->db->from('solicitudes');
        $this->db->join('areas','areas.id_area = solicitudes.id_area');
        $this->db->join('carteras','carteras.id_cartera = solicitudes.id_cartera');
        //$this->db->join('usuarios','usuarios.id_usuario = solicitudes.id_usuario_solicitante');
        $this->db->join('cargos','cargos.id_cargo = solicitudes.id_cargo');
        $this->db->where('solicitudes.cantidad_entregada < solicitudes.cantidad_solicitada');
        $query = $this->db->get();
        $solicitudes = $query->result_array();
        $data['solicitudes'] = $solicitudes;
        $this->load->view('common/header');
        $this->load->view('operaciones/solicitudes',$data);
        $this->load->view('common/footer');
    }
    
    public function agregar_solicitud(){
		if ($this->input->post('area_id')) {

            $cant_solicitada = '';
            if($this->input->post('cantidad_solicitada')==0){
                 $cant_solicitada = $this->input->post('otra_cantidad');   
            }else{
                 $cant_solicitada = $this->input->post('cantidad_solicitada');    
            }
            $nueva_solicitud = array(
                'id_area' => $this->input->post('area_id'),
                'id_cartera' => $this->input->post('cartera_id'),
                'fecha_solicitud' => date('Y-m-d H:i:s'),
                'id_cargo' => $this->input->post('cargo_id'),
                'cantidad_solicitada' => $cant_solicitada,
                'prioridad' => $this->input->post('prioridad'),
                'observacion' => $this->input->post('observacion'),
                'id_usuario_solicitante' => $this->session->userdata['id_usuario'],
                'motivo_solicitud' => $this->input->post('id_motivo')
            );
            $this->MyModel->agregar_model('solicitudes',$nueva_solicitud);
            redirect('operaciones/solicitudes');
        }
        
        $this->load->view('common/header');
        $areas = $this->MyModel->buscar_select('areas','id_area','area');
        $data['areas'] = $areas;

        $cargos = $this->MyModel->buscar_select('cargos','id_cargo','cargo');
        $data['cargos'] = $cargos;
        
        $motivo_solicitud = $this->MyModel->buscar_select('motivo_solicitud','id_motivo','motivo');
        $data['motivo_solicitud'] = $motivo_solicitud;
        
        $this->load->view('operaciones/add/solicitud',$data);
        $this->load->view('common/footer');
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
        $this->load->view('operaciones/ejecutivos',$data);
        $this->load->view('common/footer');
    }
    public function documentacion($id_ejecutivo){
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0');
        $this->db->select('personas.nombre as nombre_ejecutivo, documentacion_ejecutivo.archivo, documentacion_ejecutivo.estado,documentacion_ejecutivo.nombre,id_documentacion');
        $this->db->from('personas');
        $this->db->join('documentacion_ejecutivo','personas.id_persona=id_ejecutivo');
        $this->db->where('personas.id_persona ='.$id_ejecutivo);
        $query = $this->db->get();
        $documentos = $query->result_array();
        $data['documentos'] = $documentos;        
        $data['id_ejecutivo'] = $id_ejecutivo;
        $this->load->view('common/header');
        $this->load->view('operaciones/documentacion',$data);
        $this->load->view('common/footer');
    }
    public function ingresar_documento(){
		$data['id_solicitud'] = $this->input->post('id_solicitud');
        $this->load->view('operaciones/modal/ingresar_documento',$data);
    }
    
    public function editar_documento(){
		$documento = $this->input->post('id_documento');
        //SELECT * from documentacion_ejecutivo where id_documentacion=20
        $this->db->from('documentacion_ejecutivo');
        $this->db->where('id_documentacion='.$documento);
        $query = $this->db->get();
        $documento = $query->result_array();
        $data['documento'] = $documento;
        $data['prueba'] = 'test';
        $this->load->view('operaciones/modal/editar_documento',$data);
    }
    
    public function insert_documento(){ 
		$id_ejecutivo = $this->input->post('id_ejecutivo');
        //guardo en tabla
        $data = array(
           'nombre' => $this->input->post('nombre'), 
           'estado' => $this->input->post('estado'),
           'id_ejecutivo' => $id_ejecutivo
        );        
        $this->db->insert('documentacion_ejecutivo', $data);
        $ultima_id = $this->db->insert_id();
        // Cargamos la libreria Upload
        $this->load->library('upload');
        /*
         * Revisamos si el archivo fue subido
         * Comprobamos si existen errores en el archivo subido
         */
        if (!empty($_FILES['archivo']['name'])){
            // Configuración para el Archivo 1
            $config['upload_path'] = APPPATH . 'uploads/documentacion/';
            //$this->upload_config['upload_path'] = APPPATH . 'uploads/working/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size'] = '3000';
            $config['max_width']  = '3000';
            $config['max_height']  = '2500';
            
            $ext = end(explode(".", $_FILES['archivo']['name']));
            //update
            $data = array('archivo' => $ultima_id.'.'.$ext);
            $this->db->where('id_documentacion', $ultima_id);
            $this->db->update('documentacion_ejecutivo', $data);
            
            //cambiar nombre archivo, dos formas
            //$config['encrypt_name'] = TRUE;            
            //$new_name = $_FILES["archivo"]['name'];
            $config['file_name'] = $ultima_id;      

            // Cargamos la configuración del Archivo 1
            $this->upload->initialize($config);
            // Subimos archivo 1
            if ($this->upload->do_upload('archivo')){
                $data = $this->upload->data();
            }else{
                echo $this->upload->display_errors();
            }
            redirect(base_url('/index.php/operaciones/documentacion/'.$id_ejecutivo));            
        }
    }
    
    public function update_documento(){
		// Cargamos la libreria Upload
        $this->load->library('upload');
        $id_documentacion = $this->input->post('id_documento');
        $id_ejecutivo = $this->input->post('id_ejecutivo');
                
        //echo base_url().'assets/uploads/documentacion/';        
                                                        
        $data = array(
               'estado' => $this->input->post('estado'),
               'nombre' => $this->input->post('nombre')
            );
        $this->db->where('id_documentacion', $id_documentacion);
        $this->db->update('documentacion_ejecutivo', $data);
        
        //editar archivo
        /*
         * Revisamos si el archivo fue subido
         * Comprobamos si existen errores en el archivo subido
         */
        if (!empty($_FILES['archivo']['name'])){
            //elimino el documento
            $row = $this->db->where('id_documentacion',$id_documentacion)->get('documentacion_ejecutivo')->row();
            unlink(APPPATH.'uploads/documentacion/'.$row->archivo); 
            //$this->db->delete('documentacion_ejecutivo', array('id_documentacion' => $id_documentacion));            
            
            // Configuración para el Archivo 1
            $config['upload_path'] = APPPATH . 'uploads/documentacion/';
            //$this->upload_config['upload_path'] = APPPATH . 'uploads/working/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
            $config['max_size'] = '2048000';
            $config['max_width']  = '3000';
            $config['max_height']  = '2500';
            $ext = end(explode(".", $_FILES['archivo']['name']));
            //update
            $data = array('archivo' => $id_documentacion.'.'.$ext);
            $this->db->where('id_documentacion', $id_documentacion);
            $this->db->update('documentacion_ejecutivo', $data);            
            //cambiar nombre archivo, dos formas
            //$config['encrypt_name'] = TRUE;            
            //$new_name = $_FILES["archivo"]['name'];
            $config['file_name'] = $id_documentacion;
            // Cargamos la configuración del Archivo 1
            $this->upload->initialize($config);
            // Subimos archivo 1
            if ($this->upload->do_upload('archivo')){
                $data = $this->upload->data();
            }else{
                echo $this->upload->display_errors();
            }
            redirect(base_url('/index.php/operaciones/documentacion/'.$id_ejecutivo));                      
        }                
    }
    
    public function eliminar_documento($id_documentacion){
    $row = $this->db->where('id_documentacion',$id_documentacion)->get('documentacion_ejecutivo')->row();
        unlink(APPPATH.'uploads/documentacion/'.$row->archivo); 
        $this->db->delete('documentacion_ejecutivo', array('id_documentacion' => $id_documentacion));
        redirect(base_url('/index.php/operaciones/documentacion/'.$row->id_ejecutivo));        
    }
    
    public function ficha_contratacion($id_ejecutivo = null){
		if (empty($id_ejecutivo)){
            $id_ejecutivo = $this->input->post('id_ejecutivo');
        }
        $data['id_ejecutivo'] = $id_ejecutivo;
        
        $this->db->select('postulantes.id_postulante,postulantes.rut,postulantes.id_fuente,postulantes.referencia_empresa,postulantes.nombre_referencia,postulantes.contacto_referencia,postulantes.manejo_pc,postulantes.acepta_condicion,postulantes.pretension_renta,postulantes.fecha_entrevista,postulantes.prefiltro,postulantes.evaluador_id,postulantes.sucursal_id,postulantes.id_solicitud,personas.id_persona,personas.nombre,personas.fecha_nacimiento,personas.sexo,personas.edo_civil,personas.direccion,personas.comuna,personas.fono_movil,personas.fono_fijo,personas.nacionalidad,personas.num_hijos,personas.edad_hijos,personas.discapacidad,personas.enfermedad,personas.nombre_familiar,personas.contacto_familiar,personas.clasificado,personas.afp,personas.salud,personas.email,personas.edad,personas.paterno,personas.materno,personas.razon_social,areas.area,areas.gerencia,areas.id_sucursal,pms.id_pm,pms.nombre_pm,pms.id_area,sucursales.id_sucursal,sucursales.sucursal,turnos_postulantes.id_postulante,turnos_postulantes.id_turno,turnos.id_turno,turnos.turno,contratados.id_contratado,contratados.fecha_ingreso,contratados.fecha_retiro,contratados.id_area,contratados.id_cartera,contratados.activo,contratados.cod_sap,contratados.id_turno,contratados.motivo_contrato,contratados.jefe_directo,contratados.encargado_area,contratados.coordinadora_operativa,contratados.gerente_adm,contratados.sueldo_liquido,postulantes.id_cargo,cargos.cargo,contratados.ultima_asistencia,contratados.ultima_observacion_asistencia');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');        
        $this->db->join('areas','areas.id_area= postulantes.id_area','left');
        $this->db->join('pms','pms.id_area= areas.id_area','left');
        $this->db->join('sucursales','sucursales.id_sucursal = postulantes.sucursal_id','left');
        $this->db->join('turnos_postulantes','turnos_postulantes.id_postulante = postulantes.id_postulante','left');
        $this->db->join('turnos','turnos.id_turno = turnos_postulantes.id_turno','left');
        $this->db->join('contratados','contratados.rut = postulantes.rut','left');
        $this->db->join('cargos','cargos.id_cargo = postulantes.id_cargo');
        $this->db->where('postulantes.id_postulante = '.$id_ejecutivo);
        $query = $this->db->get();
        $ejecutivo = $query->result_array();

        //mostrar query      
        //echo $this->db->last_query();
        $data['ejecutivo'] = $ejecutivo;
        
        $turnos = $this->MyModel->buscar_select('turnos','id_turno','turno');
        $data['turnos'] = $turnos;

        $sucursales = $this->MyModel->buscar_select('sucursales','id_sucursal','sucursal');
        $data['sucursales'] = $sucursales;

        $this->db->from("entidad");
        $this->db->where("tipo = 'A'");
        $query = $this->db->get();
        $data['afps'] = $query->result_array();

        $this->db->from("entidad");
        $this->db->where("tipo = 'S'");
        $query = $this->db->get();
        $data['salud'] = $query->result_array();

        //contratados ini
        $this->db->from('contratados');
        $this->db->where('contratados.rut ="'.$ejecutivo[0]['rut'].'"');
        $query = $this->db->get();
        $contratado = $query->result();
        $data['contratado'] = $contratado;
        //contratados fin96078        
        
        if ($this->input->post('nombre')) {
            $ecivil = $this->input->post('ecivil');
            if ($ecivil=='S') {
                $edo_civil = 'Soltero';
            }elseif($ecivil=='C'){
                $edo_civil = 'Casado';
            }elseif($ecivil=='D'){
                $edo_civil = 'Divorciado';
            }else{
                $edo_civil = 'Viudo';
            }

            $fecha_nacimiento = date("Y-m-d", strtotime($this->input->post('fecha_nacimiento')));
            $update_persona = array(
                'nombre' => $this->input->post('nombre'),
                'paterno' => $this->input->post('paterno'),
                'materno' => $this->input->post('materno'),
                'rut' => $this->input->post('rut'),
                'fecha_nacimiento' => $fecha_nacimiento,
                'direccion' => $this->input->post('direccion'),
                'comuna' => $this->input->post('comuna'),
                'fono_movil' => $this->input->post('movil'),
                'fono_fijo' => $this->input->post('fijo'),
                'edo_civil' => $edo_civil,
                'afp' => $this->input->post('afp'),
                'salud' => $this->input->post('salud'),
            );
            $this->MyModel->agregar_model('personas',$update_persona,'id_persona',$this->input->post('id_persona'));
            $motivo = $this->input->post('motivo_contrato');
           
            $motivo_contrato = $this->input->post('motivo_contrato').' '.$this->input->post($motivo);
            $fecha_ingreso = date("Y-m-d", strtotime($this->input->post('fecha_contrato')));
            $nuevo_contratado = array(
                'rut' => $this->input->post('rut'),
                'fecha_ingreso' => $fecha_ingreso,
                'id_area' =>$ejecutivo[0]['id_area'],
                'id_cartera' =>$ejecutivo[0]['id_area'],
                'cod_sap' => $this->input->post('sap'),
                'id_turno' => $this->input->post('turno_id'),
                'motivo_contrato' => $motivo_contrato,
                'sueldo_liquido' => $this->input->post('sueldo_liquido'),
                'jefe_directo' => $this->input->post('jefe_directo'),
                'encargado_area' => $this->input->post('encargado_area'),
                'coordinadora_operativa' => $this->input->post('coordinadora_operativa'),
                'gerente_adm' => $this->input->post('gerente_adm')
            );
          
            $existe_contrato = $this->MyModel->buscar_model('contratados',array('rut'=>$this->input->post('rut')));
            if (!empty($existe_contrato)) {
                  //print_r($existe_contrato);
                 $this->MyModel->agregar_model('contratados',$nuevo_contratado,'id_contratado',$existe_contrato[0]['id_contratado']);
                //print_r($this->db->last_query());
            } else {
                $this->MyModel->agregar_model('contratados',$nuevo_contratado);
            }
            redirect(base_url().'index.php/operaciones/imprimir_ficha/'.$id_ejecutivo);
        }
        $this->load->view('common/header');
        $this->load->view('operaciones/ficha_contratacion',$data);
        $this->load->view('common/footer');
    }

    function imprimir_ficha($id_ejecutivo){
		if (empty($id_ejecutivo)){
            $id_ejecutivo = $this->input->post('id_ejecutivo');
        }
        $data['id_ejecutivo'] = $id_ejecutivo;
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut','left');
        $this->db->join('areas','areas.id_area= postulantes.id_area','left');
        $this->db->join('pms','pms.id_area= areas.id_area','left');
        $this->db->join('sucursales','sucursales.id_sucursal = postulantes.sucursal_id','left');
        $this->db->join('turnos_postulantes','turnos_postulantes.id_postulante = postulantes.id_postulante','left');
        $this->db->join('turnos','turnos.id_turno = turnos_postulantes.id_turno','left');
        $this->db->join('cargos','cargos.id_cargo = postulantes.id_cargo','left');
        $this->db->join('contratados','contratados.rut = postulantes.rut','left');
        $this->db->where('postulantes.id_postulante = '.$id_ejecutivo);
        $query = $this->db->get();
        //imprime query
        //$this->db->last_query();
        $ejecutivo = $query->result_array();  

        
        $this->db->from("entidad");
        $this->db->where("id_entidad = ".$ejecutivo[0]['afp']);
        $query = $this->db->get();
        $data['afps'] = $query->result_array();

        $this->db->from("entidad");
        $this->db->where("id_entidad = ".$ejecutivo[0]['salud']);
        $query = $this->db->get();
        $data['salud'] = $query->result_array();
        

        $data['ejecutivo'] = $ejecutivo;
        $turnos = $this->MyModel->buscar_select('turnos','id_turno','turno');
        $data['turnos'] = $turnos;
		//$this->load->view('operaciones/ficha_contratacion_pdf', $data);
        //importante el slash del final o no funcionará correctamente
        $this->html2pdf->folder('./files/pdfs/');
        $this->html2pdf->paper('a4', 'portrait');
        //establecemos el nombre del archivo
        $this->html2pdf->filename('test.pdf');
        $this->html2pdf->html(utf8_decode($this->load->view('operaciones/ficha_contratacion_pdf', $data, true)));
             if($this->html2pdf->create('save')){
                $this->show();
            }
        
    }
     public function show()
    {
        if(is_dir("./files/pdfs"))
        {
            $filename = "test.pdf"; 
            $route = base_url("files/pdfs/test.pdf"); 
            if(file_exists("./files/pdfs/".$filename))
            {
                header('Content-type: application/pdf'); 
                readfile($route);
            }
        }
    }

    public function imprime_ficha($id_ejecutivo){
		if (empty($id_ejecutivo)){
            $id_ejecutivo = $this->input->post('id_ejecutivo');
        }
            $data['id_ejecutivo'] = $id_ejecutivo;
            $this->db->from('postulantes');
            $this->db->join('personas','personas.rut = postulantes.rut');
            $this->db->join('areas','areas.id_area= postulantes.id_area');
            $this->db->join('pms','pms.id_area= areas.id_area');
            $this->db->join('sucursales','sucursales.id_sucursal = postulantes.sucursal_id');
            $this->db->join('turnos_postulantes','turnos_postulantes.id_postulante = postulantes.id_postulante');
            $this->db->join('turnos','turnos.id_turno = turnos_postulantes.id_turno');   
            $this->db->join('contratados','contratados.rut = postulantes.rut','left');
            $this->db->where('postulantes.id_postulante = '.$id_ejecutivo);
            $query = $this->db->get();

            if ($this->input->post('nombre')) {
                $es_soltero = $this->input->post('soltero');
                if ($es_soltero == 'X') {
                    $edo_civil = 'Soltero';
                } else{
                    $edo_civil = 'Casado';
                }
                $fecha_nacimiento = date("Y-m-d", strtotime($this->input->post('fecha_nacimiento')));
                
                $motivo = $this->input->post('motivo_contrato');
               
                $motivo_contrato = $this->input->post('motivo_contrato').' '.$this->input->post($motivo);
                $fecha_ingreso = date("Y-m-d", strtotime($this->input->post('fecha_contrato')));
                          
                $existe_contrato = $this->MyModel->buscar_model('contratados',array('rut'=>$this->input->post('rut')));
                
                redirect(base_url().'index.php/operaciones/imprimir_ficha/'.$id_ejecutivo);
        }
        $this->load->view('common/header');
        $this->load->view('operaciones/ficha_contratacion',$data);
        $this->load->view('common/footer');
    }
    
    public function pasar_asistencia(){
		$this->db->from('contratados');
        $this->db->join('personas','personas.rut = contratados.rut');
        $this->db->join('cargos','cargos.id_cargo = personas.id_cargo','left');
        $this->db->join('carteras','carteras.id_cartera = contratados.id_cartera','left');
        $this->db->join('areas','areas.id_area = contratados.id_area','left');
        //$this->db->join('asistencia','asistencia.rut = contratados.rut','left');
        //$this->db->order_by('asistencia.fecha','desc');
        $this->db->group_by('personas.rut');
        $query = $this->db->get();
        //print_r($this->db->last_query());
        $contratados = $query->result_array();
        //print_r($contratados);
        $data['asistencia'] = $this->MyModel->buscar_select('motivos_ausencias','codigo','motivo');
        $data['contratados'] = $contratados;
        if ($this->input->post()) {
            $asitencia = $this->input->post('id_motivo_ausencia');
            foreach ($asitencia as $rut => $a) {
                $cargos = $this->input->post('id_cargo');
                $areas = $this->input->post('area');
                $carteras = $this->input->post('cartera');
                $observaciones = $this->input->post('observacion');
               $existe_asistencia = $this->MyModel->buscar_model('asistencia',array('rut' => $rut,'fecha' => date('Y-m-d')));
               $nueva_asistencia = array(
                    'rut' => $rut,
                    'id_cargo' => $cargos[$rut],
                    'fecha' => date('Y-m-d'),
                    'asistencia_supervisor' => $a,
                    'id_cartera' => $carteras[$rut],
                    'id_area' => $areas[$rut],
                    'observacion' => $observaciones[$rut]      
               );
               if (!empty($existe_asistencia)) {
                    $this->MyModel->agregar_model('asistencia',$nueva_asistencia,'id_asistencia',$existe_asistencia[0]['id_asistencia']);
               } else {
                    $this->MyModel->agregar_model('asistencia',$nueva_asistencia);
               }
            }
        }
        $this->load->view('common/header');
        $this->load->view('operaciones/add/asistencia',$data);
        $this->load->view('common/footer');
    }
    
    public function ver_asistencia(){
       
        if ($this->input->post()) {
            $id_area = $this->input->post('area_id');
            $id_cartera = $this->input->post('cartera_id');
            $desde = $this->input->post('fecha_desde');
            $hasta = $this->input->post('fecha_hasta');
            
        } else {
            
            //$conditions = 'fecha = '.date('Y-m-d').' and asistencia.id_area = 5 and asistencia.id_cartera = 400';
            $id_area = 5;
            $id_cartera = 400;
            $desde = date('Y-m-d');
            $hasta = date('Y-m-d');
        }
        $data['id_area'] = $id_area;
        $data['id_cartera'] = $id_cartera;
        $data['desde'] = $desde;
        $data['hasta'] = $hasta;
        $conditions = 'fecha between "'.$desde.'" and "'.$hasta.'" and asistencia.id_area = '.$id_area.' and asistencia.id_cartera = '.$id_cartera;
        $this->db->from('contratados');
        $this->db->join('personas','personas.rut = contratados.rut');
        $this->db->join('cargos','cargos.id_cargo = personas.id_cargo','left');
        $this->db->join('carteras','carteras.id_cartera = contratados.id_cartera','left');
        $this->db->join('areas','areas.id_area = contratados.id_area','left');
        $this->db->join('asistencia','asistencia.rut = contratados.rut','left');
        $this->db->where($conditions);
        //$this->db->group_by('asistencia.rut');
        $query = $this->db->get();
        $contratados = $query->result_array();
        //print_r($contratados);
        $data['asistencia'] = $this->MyModel->buscar_select('motivos_ausencias','codigo','motivo');
        $data['contratados'] = $contratados;
        $data['areas'] = $this->MyModel->buscar_select('areas','id_area','area');
        $data['carteras'] = $this->MyModel->buscar_select('carteras','id_cartera','cartera');
        $this->load->view('common/header');
        $this->load->view('operaciones/asistencia',$data);
        $this->load->view('common/footer');
    }
    
    function validar_asistencia(){
        $this->db->from('contratados');
        $this->db->join('personas','personas.rut = contratados.rut');
        $this->db->join('cargos','cargos.id_cargo = personas.id_cargo','left');
        $this->db->join('carteras','carteras.id_cartera = contratados.id_cartera','left');
        $this->db->join('areas','areas.id_area = contratados.id_area','left');
        
        $query = $this->db->get();
        //print_r($this->db->last_query());
        $contratados = $query->result_array();
        //print_r($contratados);
        $data['asistencia'] = $this->MyModel->buscar_select('motivos_ausencias','codigo','motivo');
        $data['contratados'] = $contratados;
        if ($this->input->post()) {
            $asitencia = $this->input->post('id_motivo_ausencia');
            foreach ($asitencia as $rut => $a) {
                $cargos = $this->input->post('id_cargo');
                $areas = $this->input->post('area');
                $carteras = $this->input->post('cartera');
                $observaciones = $this->input->post('observacion');
               $existe_asistencia = $this->MyModel->buscar_model('asistencia',array('rut' => $rut,'fecha' => date('Y-m-d')));
               $nueva_asistencia = array(
                    'asistencia' => $a    
               );
               $this->MyModel->agregar_model('asistencia',$nueva_asistencia,'id_asistencia',$existe_asistencia[0]['id_asistencia']);
            }
        }
        $this->load->view('common/header');
        $this->load->view('operaciones/add/validar_asistencia',$data);
        $this->load->view('common/footer');
    }
    //desde aqui, escuchas
    public function escuchas(){
        $this->db->from('aspectos_escucha');
        $this->db->where("controlador = 'O'");
        $query = $this->db->get();
        $escuchas = $query->result_array();
        $data['escuchas'] = $escuchas;
        $this->load->view('common/header');
        $this->load->view('operaciones/escuchas',$data);
        $this->load->view('common/footer');
    }
    public function agregar_escucha(){
        $escucha = $this->input->post('escucha');
        $ponderacion = $this ->input->post('ponderacion');

          if(!empty($escucha)){
              $nuevo_escucha = array('aspecto' =>  $escucha,'ponderacion' => $ponderacion,'controlador' => 'O','multiplica' =>'7');
              $this->db->insert('aspectos_escucha',$nuevo_escucha);
              redirect(base_url("index.php/operaciones/escuchas"));
          }

        $this->load->view('common/header');
        $this->load->view('operaciones/add/escucha');
        $this->load->view('common/footer');
    }
    public function editar_escucha($id = null){

        if ($this->input->post('escucha')) {

            $update_escucha = array(
                'aspecto' => $this->input->post('escucha'),
                'ponderacion' => $this->input->post('ponderacion_escucha')
            );

            $this->db->where('id_aspecto',$this->input->post('id_escucha'));
            $this->db->update('aspectos_escucha', $update_escucha); 
            
            //Elimino los items para volverlos a agregar
            $this->db->delete('aspecto_escucha_items', array('id_aspecto_escucha' => $this->input->post('id_escucha')));
           
            $items = $this->input->post('item_aspectos');
            $ponderaciones = $this->input->post('ponderacion_item[]');

            foreach ($items as $key => $i){
                if (!empty($i)){
                    $nuevo_item_escucha = array(
                        'id_aspecto_escucha' =>  $this->input->post('id_escucha'),
                        'item_aspecto' => $i,
                        'ponderacion' => $ponderaciones[$key],
                        'multiplicar' => '1',
                        'controlador' => 'O'
                    );
                    $this->db->insert('aspecto_escucha_items', $nuevo_item_escucha);
                }
            }
            redirect(base_url("index.php/Operaciones/escuchas"));
        }
        
        $this->db->select('aspectos_escucha.id_aspecto, aspectos_escucha.aspecto,aspectos_escucha.ponderacion, aspecto_escucha_items.item_aspecto,
aspecto_escucha_items.ponderacion as i_ponderacion');
        $this->db->from('aspectos_escucha');
        $this->db->join('aspecto_escucha_items','aspectos_escucha.id_aspecto = aspecto_escucha_items.id_aspecto_escucha','left');
        $this->db->where("aspectos_escucha.id_aspecto = ".$id."");
        $query = $this->db->get();
        //echo $this->db->last_query();
        $escucha = $query->result_array();
        $data['escucha'] = $escucha;
        $data['id'] = $id;
        $this->load->view('common/header');
        $this->load->view('operaciones/edit/escucha',$data);
        $this->load->view('common/footer');
    }
    //hasta aqui escuchas
    
    public function escuchas_cargar_datos(){
        $rut = $this->input->post('rut');
        $this->db->select('personas.nombre,areas.area,carteras.cartera,supervisores.nombre_supervisor');
        $this->db->from('personas');
        $this->db->join('postulantes','personas.rut=postulantes.rut');
        $this->db->join('areas','areas.id_area= postulantes.id_area');
        $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
        $this->db->join('supervisores','supervisores.id_cartera = carteras.id_cartera');
        $this->db->where('personas.rut',$rut);        
        $query = $this->db->get();
        $datos = $query->result_array();        
        $data['datos'] = $datos;
        print_r(json_encode($data));
        return json_encode($data);    
    }
    
    public function ver_ejecutivo(){
        $id_postulante = $this->input->post('id_postulante');
		$this->db->select('postulantes.rut,personas.nombre,personas.fecha_nacimiento,personas.edo_civil,personas.fono_movil,personas.fono_fijo,
		personas.discapacidad,fuentes.fuente,postulantes.pretension_renta,postulantes.fecha_entrevista,personas.clasificado,postulantes.id_motivo_no_califica,
		postulantes.id_cargo,personas.direccion,cargos.cargo');
        $this->db->from('postulantes');
        $this->db->join('personas','personas.rut = postulantes.rut');
        $this->db->join('fuentes','postulantes.id_fuente = fuentes.id_fuente');
        $this->db->join('cargos','postulantes.id_cargo = cargos.id_cargo');
		$this->db->join('contratados','postulantes.rut = contratados.rut','left');
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
        $this->load->view('operaciones/modal/ver_ejecutivo',$data);
    }
    
    public function validar_solicitud(){
        $id_solicitud = $this->input->post('id_solicitud');
        $this->db->from('solicitudes');
        $this->db->join('areas','areas.id_area = solicitudes.id_area');
        $this->db->join('carteras','carteras.id_cartera = solicitudes.id_cartera');
        //$this->db->join('usuarios','usuarios.id_usuario = solicitudes.id_usuario_solicitante');
        $this->db->join('cargos','cargos.id_cargo = solicitudes.id_cargo');
        $this->db->where('solicitudes.id_solicitud', $id_solicitud);
        $query = $this->db->get();
        $solicitudes = $query->result_array();
        $data['solicitud'] = $solicitudes;
        
        $this->load->view('operaciones/modal/validar_solicitud',$data);
    }
    public function solicitud_validada(){
        $id_solicitud = $this->input->post('id_solicitud');
        $cant_solicitada = $this->input->post('cant_solicitada');
        $prioridad = $this->input->post('prioridad');        
        $rechazado = $this->input->post('rechazado');
        $observacion = $this->input->post('observacion');
        $observacion_aprobada = $this->input->post('observacion_aprobada');
        $cant_aprobada = $this->input->post('cantidad_aprobada');

        $data = array(
               'cantidad_aprobada' => $cant_aprobada,
               'prioridad' => $prioridad,
               'validado' => $rechazado,
               'observacion_aprobada' => $observacion_aprobada
            );
          /*  
        $config = array(
         'protocol' => 'smtp',
         'smtp_host' => 'smtp.googlemail.com',
         'smtp_user' => 'serbanc.desarrollo@gmail.com', //Su Correo de Gmail Aqui
         'smtp_pass' => 'serbanc1', // Su Password de Gmail aqui
         'smtp_port' => '587',
         'smtp_crypto' => 'tls',
         'mailtype' => 'html',
         'wordwrap' => TRUE,
         'charset' => 'utf-8'
         );
         $this->load->library('email', $config);
         $this->email->set_newline("\r\n");
         $this->email->from('archivos@serbanc.cl','Serbanc');
         $this->email->subject('Asunto del correo');
         $this->email->message('Se ha validado una nueva solicitud Numero :'.$id_solicitud);
         $this->email->to('g.moya.monsalve@gmail.com');
         $this->email->send(FALSE);    
         */                       
        $this->db->where('id_solicitud', $id_solicitud);
        $this->db->update('solicitudes', $data);
        $ins_solicitud = $this->db->affected_rows();

        echo $rechazado;

        
        if($ins_solicitud==1){

            if($rechazado==0){
                $this->session->set_flashdata('msje_solicitud', '4');
                redirect(base_url().'/index.php/operaciones/solicitudes');
            }elseif($cant_aprobada<$cant_solicitada){
                $this->session->set_flashdata('msje_solicitud', '3');
                redirect(base_url().'/index.php/operaciones/solicitudes');
            }elseif($cant_aprobada==$cant_solicitada){
                $this->session->set_flashdata('msje_solicitud', '1');
                redirect(base_url().'/index.php/operaciones/solicitudes');                    
            }else{
                $this->session->set_flashdata('msje_solicitud', '1');
                redirect(base_url().'/index.php/operaciones/solicitudes');
            }
        }else{
           $this->session->set_flashdata('msje_solicitud', '2');
            redirect(base_url().'/index.php/operaciones/solicitudes');
        } 
         
                    
    }

    public function pms(){        
        $this->db->from('pms');
        $this->db->join('areas','areas.id_area = pms.id_area');      
        $query = $this->db->get();
        $pms = $query->result_array();
        $data['pms'] = $pms;
        $this->load->view('common/header');
        $this->load->view('operaciones/pms',$data);
        $this->load->view('common/footer');
    }
       
	   public function agregar_pms(){
            $areas = $this->MyModel->buscar_select('areas','id_area','area');      
            $data['areas'] = $areas;

            if($this->input->post('nombre_pm')) {
                $nombre = $this->input->post('nombre_pm');
                $id_area = $this->input->post('id_area');

                 $nuevo_pm = array(
                        'nombre_pm' => $nombre,
                        'id_area' => $id_area
                    );   

                $this->db->insert('pms', $nuevo_pm);
                redirect(base_url("index.php/Operaciones/pms"));
            }
            $this->load->view('common/header');
            $this->load->view('operaciones/add/pms',$data);
            $this->load->view('common/footer');
        }
        public function editar_pm($id_pms){ 
            if(empty($id_pms)){
               $id_pms = $this->input->post('id_postulante');
            }
            $areas = $this->MyModel->buscar_select('areas','id_area','area');      
            $data['areas'] = $areas;
            //consulto por pm
            $this->db->from('pms');
            $this->db->where('pms.id_pm = '.$id_pms);
        
            $query = $this->db->get();
            $pm = $query->result_array();
            $data['pm'] = $pm;

            if($this->input->post('nombre_pm')) {
                $nombre = $this->input->post('nombre_pm');
                $id_area = $this->input->post('id_area');
                 $actualiza_pm = array(
                        'nombre_pm' => $nombre,
                        'id_area' => $id_area
                    );
                print_r($actualiza_pm);
                $this->MyModel->agregar_model('pms',$actualiza_pm,'id_pm',$this->input->post('id_pm'));
                
                redirect(base_url("index.php/Operaciones/pms"));
            }

            $this->load->view('common/header');
            $this->load->view('operaciones/edit/pms',$data);
            $this->load->view('common/footer');
        }
        public function sucursales(){        
        $this->db->from('sucursales');      
        $query = $this->db->get();
        $sucursales = $query->result_array();
        $data['sucursales'] = $sucursales;
        $this->load->view('common/header');
        $this->load->view('operaciones/sucursales',$data);
        $this->load->view('common/footer');
    }
        public function agregar_sucursal(){
            if($this->input->post('nombre')) {
                $nombre = $this->input->post('nombre');
                $nuevo_sucursal = array('sucursal' => $nombre);   
                $this->db->insert('sucursales', $nuevo_sucursal);
                redirect(base_url("index.php/Operaciones/sucursales"));
            }
            $this->load->view('common/header');
            $this->load->view('operaciones/add/sucursales');
            $this->load->view('common/footer');
        }
        public function editar_sucursal($id_sucursal){ 
            if(empty($id_sucursal)){
               $id_sucursal = $this->input->post('id_sucursal');
            }
            //consulto por pm
            $this->db->from('sucursales');
            $this->db->where('sucursales.id_sucursal = '.$id_sucursal);        
            $query = $this->db->get();
            $sucursales = $query->result_array();
            $data['sucursales'] = $sucursales;

            if($this->input->post('nombre')) {
                 $nombre = $this->input->post('nombre');
                 $actualiza_sucursales = array('sucursal' => $nombre);
                 $this->MyModel->agregar_model('sucursales',$actualiza_sucursales,'id_sucursal',$this->input->post('id_sucursal'));                
                redirect(base_url("index.php/Operaciones/sucursales"));
            }
            $this->load->view('common/header');
            $this->load->view('operaciones/edit/sucursales',$data);
            $this->load->view('common/footer');
        }
        //ENTIDADES
        public function entidades(){        
        //afps
        $this->db->from('entidad');
        $this->db->where("activo='1'");
        $this->db->where("tipo='A'");
        $query = $this->db->get();
        $afps = $query->result_array();
        $data['afps'] = $afps;

        //salud
        $this->db->from('entidad');
        $this->db->where("activo='1'");
        $this->db->where("tipo='S'");
        $query = $this->db->get();
        $salud = $query->result_array();
        $data['salud'] = $salud;

        $this->load->view('common/header');
        $this->load->view('operaciones/entidades',$data);
        $this->load->view('common/footer');
    }
        public function agregar_entidad(){
            if($this->input->post('nombre')) {
                $nombre = $this->input->post('nombre');
                $tipo = $this->input->post('tipo');
                $nueva_entidad = array('nombre_entidad' => $nombre,'tipo' => $tipo,'activo' =>'1');   
                $this->db->insert('entidad', $nueva_entidad);
                redirect(base_url("index.php/Operaciones/entidades"));
            }
            $this->load->view('common/header');
            $this->load->view('operaciones/add/entidad');
            $this->load->view('common/footer');
        }
        public function editar_entidad($id_entidad){ 
            if(empty($id_entidad)){
               $id_entidad = $this->input->post('id_sucursal');
            }
            //consulto por pm
            $this->db->from('entidad');
            $this->db->where('entidad.id_entidad = '.$id_entidad);
            $query = $this->db->get();
            $entidad = $query->result_array();
            $data['entidad'] = $entidad;

            if($this->input->post('nombre')) {
                 $nombre = $this->input->post('nombre');
                 $actualiza_entidad = array('nombre_entidad' => $nombre);
                 $this->MyModel->agregar_model('entidad',$actualiza_entidad,'id_entidad',$this->input->post('id_entidad'));                
                redirect(base_url("index.php/Operaciones/entidades"));
            }
            $this->load->view('common/header');
            $this->load->view('operaciones/edit/entidad',$data);
            $this->load->view('common/footer');
        }
        //ENTIDADES FIN

        //CARTERAS INI
        public function carteras(){
        //carteras
        $this->db->from('carteras');
        $this->db->join('areas','areas.id_area = carteras.id_area');      
        $query = $this->db->get();
        $carteras = $query->result_array();
        $data['carteras'] = $carteras;

        $this->load->view('common/header');
        $this->load->view('operaciones/carteras',$data);
        $this->load->view('common/footer');
    }
        public function agregar_cartera(){

            //
            //area
            $areas = $this->MyModel->buscar_select('areas','id_area','area');
            $data['areas'] = $areas;

            if($this->input->post('nombre')) {

                $nombre = $this->input->post('nombre');
                $area = $this->input->post('area');

                $nueva_cartera = array('cartera' => $nombre, 'id_area' => $area);   
                $this->db->insert('carteras', $nueva_cartera);
                redirect(base_url("index.php/Operaciones/carteras"));
            }
            $this->load->view('common/header');
            $this->load->view('operaciones/add/cartera',$data);
            $this->load->view('common/footer');
        }
        public function editar_cartera($id_cartera){ 

            if(empty($id_cartera)){
               $id_cartera = $this->input->post('id_cartera');
            }
            //consulto por cartera
            $this->db->from('carteras');
            $this->db->where('carteras.id_cartera = '.$id_cartera);
            $query = $this->db->get();
            $cartera = $query->result_array();
            $data['cartera'] = $cartera;
            //area
            $areas = $this->MyModel->buscar_select('areas','id_area','area');
            $data['areas'] = $areas;

            if($this->input->post('nombre')) {
                 $nombre = $this->input->post('nombre');
                 $area = $this->input->post('area');

                 $actualiza_cartera = array('cartera' => $nombre, 'id_area' =>$area);
                 $this->MyModel->agregar_model('carteras',$actualiza_cartera,'id_cartera',$this->input->post('id_cartera'));                
                redirect(base_url("index.php/Operaciones/carteras"));
            }
            $this->load->view('common/header');
            $this->load->view('operaciones/edit/cartera',$data);
            $this->load->view('common/footer');
        }
        //CARTERAS FIN

        public function inducciones(){
        $this->db->from('evaluacion_induccion');
        $query = $this->db->get();
        $inducciones = $query->result();
        $data['inducciones'] = $inducciones;
        $data['promedio'] = $this->db->query("SELECT SUM(peso) as promedio from evaluacion_induccion where activo='1'");

        $this->load->view('common/header');
        $this->load->view('operaciones/inducciones',$data);
        $this->load->view('common/footer');
        }
        public function agregar_inducciones(){
            $this->load->view('common/header');
            $this->load->view('operaciones/add/inducciones');
            $this->load->view('common/footer');
        }
        public function guardar_induccion(){
            $evaluacion = $this->input->post('evaluacion');
            $peso = $this->input->post('peso');
            $activo = $this->input->post('activo');
            $data = array('evaluacion' => $evaluacion, 'peso' => $peso,'activo' => $activo);        
            $this->db->insert('evaluacion_induccion', $data);
            redirect(base_url("index.php/operaciones/inducciones"));

        }
        public function editar_inducciones($id = null){

        if ($this->input->post('inducciones')) {
            $update_competencia = array(
                'evaluacion' => $this->input->post('inducciones'),
                'peso' => $this->input->post('peso_inducciones')
            );
            //actualizo evaluacion
            $this->db->where('id_evaluacion_induccion',$this->input->post('id_inducciones'));
            $this->db->update('evaluacion_induccion', $update_competencia); 
            
            //Elimino los items para volverlos a agregar
            $this->db->delete('evaluacion_induccion_item', array('id_evaluacion_induccion' => $this->input->post('id_inducciones')));
                   
            $items = $this->input->post('item_opcion');
            $activo = $this->input->post('activo');
            $correcto = $this->input->post('correcto');
            $id_item = $this->input->post('id_item');
            $id_item = $this->input->post('id_item');
            $tipo = $this->input->post('tipo');

            $i_compara = 1;
            foreach ($items as $key => $i){

                if (!empty($i)){
                    if($tipo =='T'){
                        echo $radio_activo = '1';    
                    }elseif($correcto == $i_compara){
                        echo $radio_activo = '1';
                    }else{
                        echo $radio_activo = '0';
                    }
                    $nuevo_item_competencia = array(                        
                        'id_evaluacion_induccion' => $this->input->post('id_inducciones'),
                        'activo' => $activo[$key],
                        'opcion' => $i,                        
                        'correcto' => $radio_activo,
                        'tipo' => $tipo
                    );  
                    $this->db->insert('evaluacion_induccion_item', $nuevo_item_competencia);                    
                } 
                
                $i_compara = $i_compara + 1;
            }
            //$this->db->where('id_evaluacion_induccion_item', $id_item);
            //$this->db->update('evaluacion_induccion_item', $nuevo_item_competencia);

            //actualizo la que corresponde
            $this->db->where('id_evaluacion_induccion',$this->input->post('id_inducciones'));        
            $this->db->where('opcion',$correcto);
            $update_correcto = array('correcto' => '1');
            $this->db->update('evaluacion_induccion_item', $update_correcto);            
                        
            redirect(base_url("index.php/operaciones/inducciones"));
        }
        $this->db->select('evaluacion_induccion_item.id_evaluacion_induccion_item,evaluacion_induccion.id_evaluacion_induccion,evaluacion_induccion.evaluacion,evaluacion_induccion.peso,evaluacion_induccion.activo,evaluacion_induccion_item.opcion,evaluacion_induccion_item.correcto,evaluacion_induccion_item.activo,evaluacion_induccion_item.tipo');
        $this->db->from('evaluacion_induccion');
        $this->db->join('evaluacion_induccion_item','evaluacion_induccion.id_evaluacion_induccion = evaluacion_induccion_item.id_evaluacion_induccion','left');
        $this->db->where('evaluacion_induccion.id_evaluacion_induccion = '.$id);
        $query = $this->db->get();
        $inducciones_item = $query->result_array();
        $data['inducciones_item'] = $inducciones_item;

        $data['id'] = $id;
        $this->load->view('common/header');
        $this->load->view('operaciones/edit/inducciones',$data);
        $this->load->view('common/footer');
    }

        public function induccion(){
            $areas = $this->MyModel->buscar_select('areas','id_area','area');
            $data['areas'] = $areas;
            $carteras = $this->MyModel->buscar_select('carteras','id_cartera','cartera',array('id_area = 5'));
            $data['carteras'] = $carteras;
            $supervisores = $this->MyModel->buscar_select('supervisores','id_supervisor','nombre_supervisor');
            $data['supervisores'] = $supervisores;

            $this->db->from('evaluacion_induccion');        
            $query = $this->db->get();
            $evaluacion = $query->result();
            $data['evaluacion'] = $evaluacion;

            $this->db->from('evaluacion_induccion_item');
            $query = $this->db->get();
            $data['evaluacion_items'] = $query->result();

            $rut = $this->MyModel->buscar_select('postulantes','id_postulante','rut');
            
            $data['rut'] = $rut;
            
            $this->load->view('common/header');
            $this->load->view('operaciones/induccion',$data);
            $this->load->view('common/footer');
    }
    public function guardar_einduccion(){
            $rut = $this->input->post('rut');            
            $resultado = $this->input->post('resultado');
            $observacion_general = $this->input->post('observacion_general');     
            $area_id = $this->input->post('area_id');          
            $cartera_id = $this->input->post('cartera_id');            
            $supervisor_id = $this->input->post('supervisor');
            $id_cargo = $this->input->post('id_cargo');
            $rut_audio = $this->input->post('rut_audio');
            $evaluador = $this->input->post('evaluador');

            $fecha_evaluacion = $this->input->post('fecha_evaluacion');
            $fecha_audio = $this->input->post('fecha_audio');

            $persona = $this->MyModel->buscar_model('personas','id_persona ="'.$rut.'"');

            $nueva_evaluacion = array(
                    'rut' => $rut,
                    'observacion_general' => $observacion_general,
                    'resultado_final' => $resultado,
                    'id_area' => $area_id,
                    'id_cartera' => $cartera_id,
                    'id_supervisor' => $supervisor_id,
                    'resultado_final' => $resultado,
                    'id_cargo' => $id_cargo,
                    'rut_audio' => $rut_audio,
                    'fecha_evaluacion' => $fecha_evaluacion,
                    'fecha_audio' => $fecha_audio,
                    'estado' => '1',
                    'evaluador' => $evaluador
                );
            $this->db->insert('evaluacion_induccion_resultados', $nueva_evaluacion);

            //inicio
            $this->db->from('evaluacion_induccion');        
            $query = $this->db->get();
            $evaluacion = $query->result();
            $data['evaluacion'] = $evaluacion;

            $contador = 1;
            foreach($data['evaluacion'] as $row){
                $opcion = $this->input->post('opcion'.$row->id_evaluacion_induccion);                
                $id_evaluacion = $this->input->post('id_evaluacion'.$contador);
                $opt = $this->input->post('item_sel'.$row->id_evaluacion_induccion);
                $tipo = $this->input->post('tipo'.$row->id_evaluacion_induccion);

                $observacion = '';
                if($tipo=='T'){
                    $opt = '';
                    $observacion = $this->input->post('observacion'.$row->id_evaluacion_induccion);   
                }
                $opcion_escogida = array(
                        'rut' => $rut,
                        'id_evaluacion' => $id_evaluacion,                        
                        'id_evaluacion_item' => $opt,
                        'observacion' => $observacion
                    );

                $this->db->insert('evaluacion_induccion_respondido', $opcion_escogida);
                $contador = $contador + 1;
            }
            $this->session->set_flashdata('msje_evaluacion', '1');
                redirect('operaciones/induccion_ejecutivos');
            //fin 

            //muestra ini
            $this->db->from('evaluacion_induccion_respondido');
            $this->db->where('evaluacion_induccion_respondido.id_evaluacion ='.$id_evaluacion);                    
            $query = $this->db->get();
            $respondido = $query->result();
            $data['respondido'] = $respondido;

            $this->db->from('evaluacion_induccion_resultados');        
            $query = $this->db->get();
            $resultado = $query->result();
            $data['resultado'] = $resultado;
            //muestra fin

            $this->load->view('common/header');
            $this->load->view('operaciones/resultado_induccion',$data);
            $this->load->view('common/footer');
    }     
    //EVALUACION INDUCCION 2 INI
    public function escuchas_ejecutivos(){
        //todos
        $this->db->select('DISTINCT(postulantes.id_postulante),personas.rut,personas.nombre,areas.area,carteras.cartera,tipos_ejecutivos.tipo_ejecutivo');
        $this->db->from('personas');
        $this->db->join('postulantes','personas.rut = postulantes.rut');
        $this->db->join('areas','areas.id_area = postulantes.id_area');
        $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
        $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo', 'left');
        $this->db->where("personas.clasificado = 1");
        $this->db->order_by("postulantes.id_postulante", "desc");
        $query = $this->db->get();
        $data['ejecutivos_a'] = $query->result_array();

                foreach ($data['ejecutivos_a'] as $e) {
                    $query = $this->db->query("select * from aspecto_escucha_resultado where controlador = 'O' and rut = '".$e['rut']."'");
                    $row = $query->row();
                    $resultado = '';
                    if (isset($row)){
                        $resultado = $row->resultado_final_operaciones;
                    }
                    $array_test[] = array(
                        "id_postulante" => $e['id_postulante'],
                        "rut" => $e['rut'],
                        "calificacion" => $resultado,
                        "area" => $e['area'],
                        "cartera" => $e['cartera'],
                        "tipo_ejecutivo" => $e['tipo_ejecutivo'],
                        "nombre" => $e['nombre']
                        );                                                  
                }
                $data['ejecutivos'] = $array_test;


        $this->load->view('common/header');
        $this->load->view('operaciones/escuchas_ejecutivos',$data);
        $this->load->view('common/footer');
    }   
    
            public function evaluacion_escuchas($id=null){
            //postulante
            $data['id'] = $id;
            $postulante = $this->MyModel->buscar_model('postulantes','id_postulante ='.$id);


            $data['postulante'] = $postulante;
            //datos persona
            $persona = $this->MyModel->buscar_model('personas','rut ="'.$postulante[0]['rut'].'"');
            $data['persona'] = $persona;
            //desde aqui
            $cargos = $this->MyModel->buscar_model('cargos','id_cargo ='.$postulante[0]['id_cargo']);
            $data['cargo'] = $cargos;
            $areas = $this->MyModel->buscar_select('areas','id_area','area');
            $data['areas'] = $areas;
            $carteras = $this->MyModel->buscar_select('carteras','id_cartera','cartera',array('id_area = 5'));
            $data['carteras'] = $carteras;
            $supervisores = $this->MyModel->buscar_select('supervisores','id_supervisor','nombre_supervisor');
            $data['supervisores'] = $supervisores;
            $evaluadores = $this->MyModel->buscar_select('evaluadores','id_evaluador','nombre_evaluador');
            $data['evaluadores'] = $evaluadores;
            
            //hasta aqui            
            //evaluacion_items ini
            //$nota = $this->MyModel->buscar_model('evaluacion_induccion_resultados','rut ="'.$postulante[0]['rut'].'"');
            //$data['nota'] = $nota;
            //lo que respondio
            //$respondido_q= $this->MyModel->buscar_model('evaluacion_induccion_respondido','rut ="'.$postulante[0]['rut'].'"');
            $respondido= $this->MyModel->buscar_model('evaluacion_induccion_respondido','rut ="'.$postulante[0]['rut'].'"');
            //print_r($respondido);
            $data['respondido'] = $respondido;

            $this->db->from('evaluacion_induccion');        
            $query = $this->db->get();
            $evaluacion = $query->result();
            $data['evaluacion'] = $evaluacion;

            $this->db->from('evaluacion_induccion_item');            
            $query = $this->db->get();
            $data['evaluacion_items'] = $query->result();
            //evaluacion_items fin

            $this->db->from('aspectos_escucha');
            $this->db->where("controlador = 'O'");
            $query = $this->db->get();
            $data['aspectos_escuchas'] = $query->result_array();
            
            $this->db->from('aspecto_escucha_items');
            $this->db->where("controlador = 'O'");
            $query = $this->db->get();
            $data['aspectos_escuchas_items'] = $query->result_array();


        $this->load->view('common/header');
        $this->load->view('operaciones/add/evaluacion_escuchas',$data);
        $this->load->view('common/footer');
    }

        public function ver_evaluacion_escuchas($id){
        //postulante
            $data['id'] = $id;
            $postulante = $this->MyModel->buscar_model('postulantes','id_postulante ='.$id);
            $data['postulante'] = $postulante;
            //datos persona
            $persona = $this->MyModel->buscar_model('personas','rut ="'.$postulante[0]['rut'].'"');
            $data['persona'] = $persona;
            //desde aqui
            $cargos = $this->MyModel->buscar_model('cargos','id_cargo ='.$postulante[0]['id_cargo']);
            $data['cargo'] = $cargos;
            $areas = $this->MyModel->buscar_select('areas','id_area','area');
            $data['areas'] = $areas;
            $carteras = $this->MyModel->buscar_select('carteras','id_cartera','cartera',array('id_area = 5'));
            $data['carteras'] = $carteras;
            $supervisores = $this->MyModel->buscar_select('supervisores','id_supervisor','nombre_supervisor');
            $data['supervisores'] = $supervisores;

            $evaluadores = $this->MyModel->buscar_select('evaluadores','id_evaluador','nombre_evaluador');
            $data['evaluadores'] = $evaluadores;

            //hasta aqui            
            //evaluacion_items ini
            /*
            $nota = $this->MyModel->buscar_model('evaluacion_induccion_resultados','rut ="'.$postulante[0]['rut'].'"');
            $data['nota'] = $nota;
            */
            //lo que respondio
            //$respondido_q= $this->MyModel->buscar_model('evaluacion_induccion_respondido','rut ="'.$postulante[0]['rut'].'"');
            //$respondido= $this->MyModel->buscar_model('evaluacion_induccion_respondido','rut ="'.$postulante[0]['rut'].'"');


            $this->db->from('aspectos_escucha');
            $this->db->where("controlador = 'O'");
            $query = $this->db->get();
            $data['aspectos_escuchas'] = $query->result_array();
            
            $this->db->from('aspecto_escucha_items');
            $this->db->where("controlador = 'O'");
            $query = $this->db->get();
            $data['aspectos_escuchas_items'] = $query->result_array();

            //ver
            $this->db->select('id_aspecto,id_aspecto_items,respondido,observacion,nota_grupo');
            $this->db->from('aspecto_escucha_respondido');
            $this->db->where("controlador = 'O' and rut = '".$postulante[0]['rut']."'");
            //$this->db->where('rut = "'.$postulante[0]['rut'].'"');
            $query = $this->db->get();
            $respondido_qq = $query->result_array();
            foreach($respondido_qq as $w){
                //$respondido_q[$w['id_aspecto_items']] = array('id_aspecto' => $respondido_qq['id_aspecto'], 'id_aspecto_items' => $respondido_qq['id_aspecto_items'], 'respondido' => 'd');
                $respondido_q[$w['id_aspecto_items']]= array("id_aspecto" => $w['id_aspecto'],"id_aspecto_items" => $w['id_aspecto_items'],"respondido" => $w['respondido'],"observacion" =>$w['observacion'],"nota_grupo" => $w['nota_grupo']);
            }            
            $data['respondido_q'] = $respondido_q;


            $this->db->from('aspecto_escucha_resultado');
            $this->db->where("controlador = 'O' and rut = '".$postulante[0]['rut']."'");
            //$this->db->where('rut = "'.$postulante[0]['rut'].'"');
            $query = $this->db->get();
            $respondido_r = $query->result_array();
            $data['respondido_r'] = $respondido_r;
            //ver
        $this->load->view('common/header');
        $this->load->view('operaciones/edit/evaluacion_escuchas',$data);
        $this->load->view('common/footer');
    }

        public function evaluadores(){        
        $this->db->from('evaluadores');
        $query = $this->db->get();
        $evaluadores = $query->result_array();
        $data['evaluadores'] = $evaluadores;
        $this->load->view('common/header');
        $this->load->view('operaciones/evaluadores',$data);
        $this->load->view('common/footer');
    }
        public function agregar_evaluador(){
            if($this->input->post('nombre_evaluador')) {
                $nombre = $this->input->post('nombre_evaluador');
                 $nuevo_evaluador = array('nombre' => $nombre);   

                 $this->db->insert('evaluadores', $nuevo_evaluador);
                 redirect(base_url("index.php/operaciones/evaluadores"));
            }
            $this->load->view('common/header');
            $this->load->view('operaciones/add/evaluadores');
            $this->load->view('common/footer');
        }
        public function editar_evaluador($id_evaluador){
            //consulto por pm
            $this->db->from('evaluadores');
            $this->db->where('evaluadores.id_evaluador = '.$id_evaluador);        
            $query = $this->db->get();
            $evaluador = $query->result_array();
            $data['evaluador'] = $evaluador;

            if($this->input->post('nombre_evaluador')) {
                $nombre = $this->input->post('nombre_evaluador');
                 $actualiza_evaluador = array('nombre_evaluador' => $nombre);
                $this->MyModel->agregar_model('evaluadores',$actualiza_evaluador,'id_evaluador',$this->input->post('id_evaluador'));                
                redirect(base_url("index.php/operaciones/evaluadores"));
            }

            $this->load->view('common/header');
            $this->load->view('operaciones/edit/evaluadores',$data);
            $this->load->view('common/footer');
        }

         public function insert_escuchas(){

            //inicio
            $this->db->from('aspectos_escucha');
            $this->db->where("controlador = 'O' ");
            $query = $this->db->get();
            $aspectos = $query->result();
            $data['aspectos'] = $aspectos;

            $contador = 1;
            foreach($data['aspectos'] as $row){
                echo 'input de aspecto: '.$id_aspecto = $this->input->post('id_aspecto'.$row->id_aspecto);
                echo '<br/>';
                echo 'nota parcial: '.$n_parcial = $this->input->post('nparcial'.$row->id_aspecto);
                echo '<br/>';
                //echo 'input de item aspecto: '.$item_aspecto = $this->input->post('item_aspecto'.$row->id_aspecto);
                //echo '<br/>';

                //foreach item ini
                $this->db->from('aspectos_escucha');
                $this->db->join('aspecto_escucha_items','aspecto_escucha_items.id_aspecto_escucha = aspectos_escucha.id_aspecto');
                $this->db->where("aspectos_escucha.controlador = 'O'");
                //$this->db->where('aspecto_escucha_items.id_aspecto_escucha = aspectos_escucha.id_aspecto');        
                $query = $this->db->get();
                $as_item = $query->result();
                $data['aspectos_item'] = $as_item;

                    //recorro
                    foreach($data['aspectos_item'] as $rows){
                        //comparo id para asignar al input
                        if($rows->id_aspecto_escucha==$row->id_aspecto){   
                            //echo $rows->item_aspecto.'<br/>';
                            echo 'input de item aspecto: '.$item_aspecto = $this->input->post('item_aspecto'.$rows->id_item_aspecto);
                            echo '<br>';
                            echo 'select cumple: '.$cumple = $this->input->post('cumple'.$rows->id_item_aspecto);
                            echo '<br>';
                            echo 'observacion: '.$observacion = $this->input->post('observacion'.$rows->id_item_aspecto);
                            echo '<br>';

                        $nuevo_item = array(     
                            'rut' => $this->input->post('rut'),
                            'id_aspecto' => $id_aspecto,
                            'id_aspecto_items' => $item_aspecto,                        
                            'respondido' => $cumple,
                            'observacion' => $observacion,
                            'nota_grupo' => $n_parcial,
                            'controlador' => 'O'
                        );  
                        $this->db->insert('aspecto_escucha_respondido', $nuevo_item);

                        }
                    }
                    echo '<br>';
                //foreach item fin
            echo '<br/><br/>';
            $contador = $contador + 1;
            }   
            //guarda resultado
            $resultado = array(     
                'rut' => $this->input->post('rut'),
                'observacion_general' => $this->input->post('observacion_general'),
                'resultado_final_operaciones' => $this->input->post('total_general'),                        
                'id_area' => $this->input->post('area_id'),
                'id_cartera' => $this->input->post('cartera_id'),
                'id_supervisor' => $this->input->post('supervisor'),
                'fecha_evaluacion' => $this->input->post('fecha_evaluacion'),
                'fecha_audio' => $this->input->post('fecha_audio'),
                'rut_audio' => $this->input->post('rut_audio'),
                'id_cargo' => $this->input->post('id_cargo'),
                'estado' => '1',
                'evaluador' => $this->input->post('evaluador'),
                'controlador' => 'O'
            );
            $this->db->insert('aspecto_escucha_resultado', $resultado);
            
            $this->session->set_flashdata('msje_solicitud', '1');
            redirect(base_url().'/index.php/operaciones/escuchas_ejecutivos');
            
        }

        public function fuentes(){        
            $this->db->from('fuentes');      
            $query = $this->db->get();
            $fuentes = $query->result_array();
            $data['fuentes'] = $fuentes;
            $this->load->view('common/header');
            $this->load->view('operaciones/fuentes',$data);
            $this->load->view('common/footer');
        }
        public function editar_fuente($id_fuente){            
            if(empty($id_fuente)){
               $id_fuente = $this->input->post('id_postulante');
            }
            //consulto por fuente
            $this->db->from('fuentes');
            $this->db->where('fuentes.id_fuente = '.$id_fuente);        
            $query = $this->db->get();
            $fuente = $query->result_array();
            $data['fuente'] = $fuente;            
            if($this->input->post('nombre_fuente')){
                $nombre = $this->input->post('nombre_fuente');
                $id_fuente = $this->input->post('id_fuente');
                 $actualiza_fuente = array(
                        'fuente' => $nombre,
                        'id_fuente' => $id_fuente
                    );
                print_r($actualiza_fuente);
                $this->MyModel->agregar_model('fuentes',$actualiza_fuente,'id_fuente',$this->input->post('id_fuente'));                
                redirect(base_url("index.php/Operaciones/fuentes"));
            }            

            $this->load->view('common/header');
            $this->load->view('operaciones/edit/fuentes',$data);
            $this->load->view('common/footer');
        }
        public function agregar_fuente(){
            if($this->input->post('nombre_fuente')) {
                $nombre = $this->input->post('nombre_fuente');
                $nuevo_fuente = array('fuente' => $nombre);   

                $this->db->insert('fuentes', $nuevo_fuente);
                redirect(base_url("index.php/Operaciones/fuentes"));
            }
            $this->load->view('common/header');
            $this->load->view('operaciones/add/fuentes');
            $this->load->view('common/footer');
        }
        
        public function postulante_comentario(){
            $id_postulante = $this->input->post('id_postulante');
            $observacion = $this->input->post('observacion');        
            $data = array('observacion_induccion' => $observacion);
            $this->db->where('id_postulante', $id_postulante);
            $this->db->update('postulantes', $data);
            $ins_comentario = $this->db->affected_rows();
                      
            if($ins_comentario==1){
                $this->session->set_flashdata('msje_comentario', '1');
                redirect(base_url().'/index.php/operaciones/dashboard','refresh');
            }else{
                $this->session->set_flashdata('msje_comentario', '2');
                redirect(base_url().'/index.php/operaciones/dashboard','refresh');
            } 
        }

        public function dashboard_operaciones(){
            $guardar = $this->input->post('guardar');
            //inducciones restantes
            $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno');
            $this->db->from('postulantes');
            $this->db->join('personas','personas.rut = postulantes.rut');
            $this->db->where('postulantes.id_solicitud is null and postulantes.induccionp=1');        
            $query = $this->db->get();
            $pendiente_entrevista = $query->result_array();
            $data['induccionp'] = $pendiente_entrevista;

            //inducciones restantes
            $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno,postulantes.ingresop');
            $this->db->join('postulantes','personas.rut = postulantes.rut');
            $this->db->join('areas','areas.id_area = postulantes.id_area');
            $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
            $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo','left');
            $this->db->join('evaluacion_induccion_resultados','evaluacion_induccion_resultados.rut = postulantes.rut','left');
            $this->db->where('personas.clasificado = 1 and postulantes.fecha_ilaboral > NOW() and evaluacion_induccion_resultados.resultado_final is not null and postulantes.ingresop=0 or postulantes.ingresop is NULL');
            $consulta = $this->db->get('personas');
            $cant = $consulta->result_array();
            //echo $this->db->last_query();
            $data['induccion_restante'] = $cant;

            //inducciones para hoy
            $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno,postulantes.ingresop,postulantes.observacion_induccion');
            $this->db->join('postulantes','personas.rut = postulantes.rut');
            $this->db->join('areas','areas.id_area = postulantes.id_area');
            $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
            $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo','left');
            $this->db->join('evaluacion_induccion_resultados','evaluacion_induccion_resultados.rut = postulantes.rut','left');
            $this->db->where("personas.clasificado = 1 and DATE_FORMAT(postulantes.fecha_ilaboral,'%Y-%m-%d') = curdate()");
            $para_hoy = $this->db->get('personas');
            $hoy = $para_hoy->result_array();
            $data['hoy'] = $hoy;
            if($guardar==1){
            $postulantes = $this->input->post('postulante');
                
                    foreach($data['hoy'] as $i){
                        //borro los actuales
                        $borrar = array('ingresop' =>NULL);
                        $this->db->where('id_postulante', $i['id_postulante']);
                        $this->db->update('postulantes', $borrar);
                    }
                    //agrego los que corresponden
                    if(!empty($postulantes)){
                        foreach($postulantes as $k=>$a){                  
                            $test = array('ingresop' =>'1');
                            $this->db->where('id_postulante', $k);
                            $this->db->update('postulantes', $test);
                        }                        
                    }
            }
            //inducciones para hoy
            $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno,,postulantes.ingresop,postulantes.observacion_induccion');
            $this->db->join('postulantes','personas.rut = postulantes.rut');
            $this->db->join('areas','areas.id_area = postulantes.id_area');
            $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
            $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo','left');
            $this->db->join('evaluacion_induccion_resultados','evaluacion_induccion_resultados.rut = postulantes.rut','left');
            $this->db->where("personas.clasificado = 1 and DATE_FORMAT(postulantes.fecha_ilaboral,'%Y-%m-%d') = curdate()");
            $para_hoy = $this->db->get('personas');
            $hoy = $para_hoy->result_array();
            $data['hoy'] = $hoy;

            //postulantes inducidos
            $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno,postulantes.ingresop');
            $this->db->join('postulantes','personas.rut = postulantes.rut');
            $this->db->join('areas','areas.id_area = postulantes.id_area');
            $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
            $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo','left');
            $this->db->join('evaluacion_induccion_resultados','evaluacion_induccion_resultados.rut = postulantes.rut','left');
            $this->db->where('personas.clasificado = 1 and evaluacion_induccion_resultados.resultado_final is not null');
            $inducidos = $this->db->get('personas');
            $cant_inducidos = $inducidos->result_array();
            $data['cant_inducidos'] = $cant_inducidos;               

            $this->db->select('postulantes.id_postulante, personas.rut ,DATE(postulantes.fecha_ilaboral) as fecha, TIME(postulantes.fecha_ilaboral) as hora, personas.nombre');
            $this->db->from('postulantes');
            $this->db->join('personas','personas.rut = postulantes.rut');
            $this->db->where('date(fecha_ilaboral) is not null');
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
            $this->load->view('operaciones/dashboard_operaciones',$data);
            $this->load->view('common/footer');
        }
        public function postulante_comentario_operaciones(){
            $id_postulante = $this->input->post('id_postulante');
            $observacion = $this->input->post('observacion');        
            $data = array('observacion_ilaboral' => $observacion);
            $this->db->where('id_postulante', $id_postulante);
            $this->db->update('postulantes', $data);
            $ins_comentario = $this->db->affected_rows();
                      
            if($ins_comentario==1){
                $this->session->set_flashdata('msje_comentario', '1');
                redirect(base_url().'/index.php/operaciones/dashboard_operaciones','refresh');
            }else{
                $this->session->set_flashdata('msje_comentario', '2');
                redirect(base_url().'/index.php/operaciones/dashboard_operaciones','refresh');
            } 
        }
        public function supervisores(){
            $this->db->select('carteras.id_cartera, carteras.cartera, supervisores.id_supervisor, supervisores.nombre_supervisor');
            $this->db->from('carteras');
            $this->db->join('supervisores','supervisores.id_cartera = carteras.id_cartera','left');
            //$this->db->where('date(fecha_ilaboral) is not null');
            $query = $this->db->get();
            $supervisores = $query->result_array();
            $data['supervisores'] = $supervisores;
            $this->load->view('common/header');
            $this->load->view('operaciones/supervisores',$data);
            $this->load->view('common/footer');
        }

        public function editar_supervisores($id_cartera){ 

            if(empty($id_cartera)){
               $id_cartera = $this->input->post('id_cartera');
            }    
            //CONSULTO SI LA CARTERA TIENE SUPERVISOR ASIGNADO
            $this->db->select('carteras.id_cartera, carteras.cartera, supervisores.id_supervisor, supervisores.nombre_supervisor');
            $this->db->from('carteras');
            $this->db->join('supervisores','supervisores.id_cartera = carteras.id_cartera','left');
            $this->db->where('carteras.id_cartera ='.$id_cartera);
            $query = $this->db->get();            
            $supervisor = $query->result_array();
            /*
            if($query->num_rows()>0){//SI LO TIENE$existe = 1;
            }else{//NO TIENE$existe = 0;
            }
            */
            $query = $this->db->query("SELECT nombre from usuarios where id_rango = 3");
            //$supervisores = $query->result_array();
            //$data['supervisores'] = $supervisores;            
            $super = array();
            foreach ($query->result() as $w) {
                $super[]=$w->nombre;
            }
            $data['supervisores'] = $super;
            $data['supervisor'] = $supervisor;
            $this->load->view('common/header');
            $this->load->view('operaciones/edit/supervisores',$data);
            $this->load->view('common/footer');
        }
        public function ingresar_supervisores($id_cartera){ 

            if(empty($id_cartera)){
               $id_cartera = $this->input->post('id_cartera');
            }    
            //CONSULTO SI LA CARTERA TIENE SUPERVISOR ASIGNADO
            $this->db->select('carteras.id_cartera, carteras.cartera, supervisores.id_supervisor, supervisores.nombre_supervisor');
            $this->db->from('carteras');
            $this->db->join('supervisores','supervisores.id_cartera = carteras.id_cartera','left');
            $this->db->where('carteras.id_cartera ='.$id_cartera);
            $query = $this->db->get();            
            $supervisor = $query->result_array();
            /*
            if($query->num_rows()>0){//SI LO TIENE$existe = 1;
            }else{//NO TIENE$existe = 0;
            }
            */
            $query = $this->db->query("SELECT nombre from usuarios where id_rango = 3");
            //$supervisores = $query->result_array();
            //$data['supervisores'] = $supervisores;            
            $super = array();
            foreach ($query->result() as $w) {
                $super[]=$w->nombre;
            }
            $data['supervisores'] = $super;
            $data['supervisor'] = $supervisor;
            $this->load->view('common/header');
            $this->load->view('operaciones/add/supervisores',$data);
            $this->load->view('common/footer');
        }

        public function accion_supervisor(){
            echo $accion = $this->input->post('accion');
        }

}
?>