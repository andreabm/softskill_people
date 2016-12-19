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
	}
    
    public function solicitudes(){
        $this->db->from('solicitudes');
        $this->db->join('areas','areas.id_area = solicitudes.id_area');
        $this->db->join('carteras','carteras.id_cartera = solicitudes.id_cartera');
        $this->db->join('usuarios','usuarios.id_usuario = solicitudes.id_usuario_solicitante');
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
            $nueva_solicitud = array(
                'id_area' => $this->input->post('area_id'),
                'id_cartera' => $this->input->post('cartera_id'),
                'fecha_solicitud' => date('Y-m-d H:i:s'),
                'id_cargo' => $this->input->post('cargo_id'),
                'cantidad_solicitada' => $this->input->post('cantidad_solicitada'),
                'prioridad' => $this->input->post('prioridad'),
                'observacion' => $this->input->post('observacion'),
                'id_usuario_solicitante' => $this->session->userdata['id_usuario'],
                'motivo_solicitud' => $this->input->post('id_motivo'),
                'cantidad_aprobada' => $this->input->post('cantidad_solicitada')
            );
            $this->MyModel->agregar_model('solicitudes',$nueva_solicitud);
            redirect('operaciones/solicitudes');
        }
        $this->load->view('common/header');
        $areas = $this->MyModel->buscar_select('areas','id_area','area');
        $data['areas'] = $areas;
        $carteras = $this->MyModel->buscar_select('carteras','id_cartera','cartera',array('id_area = 5'));
        $data['carteras'] = $carteras;
        $cargos = $this->MyModel->buscar_select('cargos','id_cargo','cargo');
        $data['cargos'] = $cargos;
        
        $motivo_solicitud = $this->MyModel->buscar_select('motivo_solicitud','id_motivo','motivo');
        $data['motivo_solicitud'] = $motivo_solicitud;
        
        $this->load->view('operaciones/add/solicitud',$data);
        $this->load->view('common/footer');
    }
     public function ejecutivos(){
        $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,areas.area,carteras.cartera,tipos_ejecutivos.tipo_ejecutivo');
        $this->db->from('personas');
        $this->db->join('postulantes','personas.rut = postulantes.rut');
        $this->db->join('areas','areas.id_area = postulantes.id_area');
        $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
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
            $config['allowed_types'] = 'gif|jpg|png';
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
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '3000';
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
        if (empty($id_ejecutivo)) {
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
        $this->db->join('contratados','contratados.rut = postulantes.rut','left');
        $this->db->where('postulantes.id_postulante = '.$id_ejecutivo);
        $query = $this->db->get();
        $ejecutivo = $query->result_array();
                
        $data['ejecutivo'] = $ejecutivo;
        
        $turnos = $this->MyModel->buscar_select('turnos','id_turno','turno');
        $data['turnos'] = $turnos;
        
        if ($this->input->post('nombre')) {
            $es_soltero = $this->input->post('soltero');
            if ($es_soltero == 'X') {
                $edo_civil = 'Soltero';
            } else{
                $edo_civil = 'Casado';
            }
            $fecha_nacimiento = date("Y-m-d", strtotime($this->input->post('fecha_nacimiento')));
            $update_persona = array(
                'nombre' => $this->input->post('nombre'),
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
        $ejecutivo = $query->result_array();
                
        $data['ejecutivo'] = $ejecutivo;
        
        $turnos = $this->MyModel->buscar_select('turnos','id_turno','turno');
        $data['turnos'] = $turnos;
        //importante el slash del final o no funcionará correctamente
        $this->html2pdf->folder('./files/pdfs/');
        $this->html2pdf->paper('a4', 'portrait');
        //establecemos el nombre del archivo
        $this->html2pdf->filename('test.pdf');
        $this->html2pdf->html(utf8_decode($this->load->view('operaciones/ficha_contratacion_pdf', $data, true)));
         if($this->html2pdf->create('save')) 
        {
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
    public function escuchas(){
        $this->db->select('personas.id_persona,personas.rut');
        $this->db->from('personas');
        $this->db->where('personas.clasificado=1');
        $query = $this->db->get();
        $ejecutivos = $query->result_array();
        $data['ejecutivos']=$ejecutivos;
        
        $this->db->from('aspectos_escucha');
        $query = $this->db->get();
        $data['aspectos_escuchas'] = $query->result_array();
        
        $this->db->from('aspecto_escucha_items');
        $query = $this->db->get();
        $data['aspectos_escuchas_items'] = $query->result_array();
        
        $this->load->view('common/header');
        $this->load->view('operaciones/escuchas',$data);
        $this->load->view('common/footer');
    }
    
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
        $this->load->view('operaciones/modal/ver_ejecutivo',$data);
    }
    
    public function validar_solicitud(){
        $id_solicitud = $this->input->post('id_solicitud');
        $this->db->from('solicitudes');
        $this->db->join('areas','areas.id_area = solicitudes.id_area');
        $this->db->join('carteras','carteras.id_cartera = solicitudes.id_cartera');
        $this->db->join('usuarios','usuarios.id_usuario = solicitudes.id_usuario_solicitante');
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
        
        $data = array(
               'cantidad_aprobada' => $cant_solicitada,
               'prioridad' => $prioridad,
               'validado' => $rechazado,
               //'observacion' => $observacion,
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
        
        if($ins_solicitud==1){
            $this->session->set_flashdata('msje_solicitud', '1');
            redirect(base_url().'/index.php/operaciones/solicitudes');
        }else{
            $this->session->set_flashdata('msje_solicitud', '2');
            redirect(base_url().'/index.php/operaciones/solicitudes');
        }      
                 
    }
    
    
}
?>