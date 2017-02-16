<?php
class Calidad extends CI_Controller {
    
	public function __construct(){	
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
    $this->load->library('email');
    $this->load->library('form_validation');
    $this->load->library('javascript');
    $this->load->library('session');
	$this->load->library('parser');
    //$this->load->library('html2pdf');
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
       public function induccion_ejecutivos(){
        $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,areas.area,carteras.cartera,tipos_ejecutivos.tipo_ejecutivo,evaluacion_induccion_resultados.resultado_final');
        $this->db->from('personas');
        $this->db->join('postulantes','personas.rut = postulantes.rut');
        $this->db->join('areas','areas.id_area = postulantes.id_area');
        $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
        $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo');
        $this->db->join('evaluacion_induccion_resultados','evaluacion_induccion_resultados.rut = postulantes.rut','left');
        $this->db->where('personas.clasificado = 1');
        //and evaluacion_induccion_resultados.resultado_final is not null
        //$this->db->group_by('postulantes.rut'); 
        $query = $this->db->get();
        $ejecutivos = $query->result_array();
        $data['ejecutivos'] = $ejecutivos;

        $this->load->view('common/header');
        $this->load->view('calidad/induccion_ejecutivos',$data);
        $this->load->view('common/footer');
    }
        public function escuchas_ejecutivos(){

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
                    $query = $this->db->query("select * from aspecto_escucha_resultado where controlador = 'C' and rut = '".$e['rut']."'");
                    $row = $query->row();
                    $resultado = '';
                    if (isset($row)){
                        $resultado = $row->resultado_final_calidad;
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
        $this->load->view('calidad/escuchas_ejecutivos',$data);
        $this->load->view('common/footer');
    }
    public function evaluacion_induccion($id=null){
            //postulante
            $postulante = $this->MyModel->buscar_model('postulantes','id_postulante ='.$id);
            $data['postulante'] = $postulante;
            //datos persona
            $persona = $this->MyModel->buscar_model('personas','rut ="'.$postulante[0]['rut'].'"');
            $data['persona'] = $persona;
            
            //busca si ya respondio la encuesta
            $evaluacion_resp = $this->MyModel->buscar_model('evaluacion_induccion_resultados','rut ="'.$postulante[0]['rut'].'"');
            $data['evaluacion_resp'] = $evaluacion_resp;

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
            $this->load->view('calidad/add/evaluacion_induccion',$data);
            $this->load->view('common/footer');
    }
    public function evaluacion_induccion_calidad($id=null){
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
            $nota = $this->MyModel->buscar_model('evaluacion_induccion_resultados','rut ="'.$postulante[0]['rut'].'"');
            $data['nota'] = $nota;
            
            //lo que respondio            

            //$respondido_q= $this->MyModel->buscar_model('evaluacion_induccion_respondido','rut ="'.$postulante[0]['rut'].'"');
            $this->db->select('id_evaluacion,id_evaluacion_item');
            $this->db->from('evaluacion_induccion_respondido');
            $this->db->where('rut = "'.$postulante[0]['rut'].'"');
            $query = $this->db->get();
            $respondido_q = $query->result_array();
            $data['respondido_q'] = $respondido_q;

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

        $this->load->view('common/header');
        $this->load->view('calidad/edit/evaluacion_induccion_calidad',$data);
        $this->load->view('common/footer');
    }
    
    public function update_einduccion(){
        $id = $this->input->post('evaluador');
        $rut = $this->input->post('rut');
        $resultado = $this->input->post('resultado');
        $resultado2 = $this->input->post('resultado2');
        $resultado_final = $resultado + $resultado2;

        $inducido = $this->input->post('inducido');

        //UPDATE
        $fecha_ingreso = $this->input->post('fecha_ingreso');
        $hora_ingreso = $this->input->post('hora_ingreso');

        $hora_separada = explode(" ", $hora_ingreso);
        $hora_separada[0]; //hora
        $hora_separada[1]; //am o pm
        $datos_postulantes = array(
            'fecha_ilaboral' => $fecha_ingreso.' '.$hora_separada[0].':00',
            'induccionp' => $inducido,
            'inducido' => $inducido
            );

        $this->db->where('rut', $rut);
        $this->db->update('postulantes', $datos_postulantes);
        //UPDATE

        //borro info
        if(!empty($resultado_final)){
        //updeteo resultado
        $data = array('resultado_final' => $resultado_final,'calidad' => '1');
        $this->db->where('rut', $rut);
        $this->db->update('evaluacion_induccion_resultados', $data);

        $this->session->set_flashdata('msje_evaluacion', '1');
        redirect('operaciones/induccion_ejecutivos');
        }

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
            $this->db->where("controlador = 'C'");
            $query = $this->db->get();
            $data['aspectos_escuchas'] = $query->result_array();
            
            $this->db->from('aspecto_escucha_items');
            $this->db->where("controlador = 'C'");
            $query = $this->db->get();
            $data['aspectos_escuchas_items'] = $query->result_array();


        $this->load->view('common/header');
        $this->load->view('calidad/add/evaluacion_escuchas',$data);
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


            //print_r($respondido);
            //$data['respondido'] = $respondido;

            $this->db->from('evaluacion_induccion');        
            $query = $this->db->get();
            $evaluacion = $query->result();
            $data['evaluacion'] = $evaluacion;

            $this->db->from('evaluacion_induccion_item');
            $query = $this->db->get();
            $data['evaluacion_items'] = $query->result();
            //evaluacion_items fin

            $this->db->from('aspectos_escucha');
            $this->db->where("controlador = 'C'");
            $query = $this->db->get();
            $data['aspectos_escuchas'] = $query->result_array();
            
            $this->db->from('aspecto_escucha_items');
            $this->db->where("controlador = 'C'");
            $query = $this->db->get();
            $data['aspectos_escuchas_items'] = $query->result_array();

            //ver
            $this->db->select('id_aspecto,id_aspecto_items,respondido,observacion,nota_grupo');
            $this->db->from('aspecto_escucha_respondido');
            $this->db->where("controlador = 'C' and rut = '".$postulante[0]['rut']."'");
            //$this->db->where('rut = "'.$postulante[0]['rut'].'"');
            $query = $this->db->get();
            $respondido_q = $query->result_array();
            $data['respondido_q'] = $respondido_q;

            $this->db->from('aspecto_escucha_resultado');
            $this->db->where("controlador = 'C' and rut = '".$postulante[0]['rut']."'");
            //$this->db->where('rut = "'.$postulante[0]['rut'].'"');
            $query = $this->db->get();
            $respondido_r = $query->result_array();
            $data['respondido_r'] = $respondido_r;
            //ver
        $this->load->view('common/header');
        $this->load->view('calidad/edit/evaluacion_escuchas',$data);
        $this->load->view('common/footer');
    }

            public function insert_escuchas(){

            //inicio
            $this->db->from('aspectos_escucha');
            $this->db->where("controlador = 'C' ");
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
                $this->db->where("aspectos_escucha.controlador = 'C'");
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
                            'controlador' => 'C'
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
                'resultado_final_calidad' => $this->input->post('total_general'),                        
                'id_area' => $this->input->post('area_id'),
                'id_cartera' => $this->input->post('cartera_id'),
                'id_supervisor' => $this->input->post('supervisor'),
                'fecha_evaluacion' => $this->input->post('fecha_evaluacion'),
                'fecha_audio' => $this->input->post('fecha_audio'),
                'rut_audio' => $this->input->post('rut_audio'),
                'id_cargo' => $this->input->post('id_cargo'),
                'estado' => '1',
                'evaluador' => $this->input->post('evaluador'),
                'controlador' => 'C'
            );
            $this->db->insert('aspecto_escucha_resultado', $resultado);
            
            $this->session->set_flashdata('msje_solicitud', '1');
            redirect(base_url().'/index.php/calidad/escuchas_ejecutivos');
            
        }

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

            //inducciones restantes
            $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno');
            $this->db->join('postulantes','personas.rut = postulantes.rut');
            $this->db->join('areas','areas.id_area = postulantes.id_area');
            $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
            $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo','left');
            $this->db->join('evaluacion_induccion_resultados','evaluacion_induccion_resultados.rut = postulantes.rut','left');
            $this->db->where('personas.clasificado = 1 and evaluacion_induccion_resultados.resultado_final is null');
            $consulta = $this->db->get('personas');
            $cant = $consulta->result_array();
            //echo $this->db->last_query();
            $data['induccion_restante'] = $cant;

            //inducciones para hoy
            $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno,postulantes.induccionp,postulantes.observacion_induccion');
            $this->db->join('postulantes','personas.rut = postulantes.rut');
            $this->db->join('areas','areas.id_area = postulantes.id_area');
            $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
            $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo','left');
            $this->db->join('evaluacion_induccion_resultados','evaluacion_induccion_resultados.rut = postulantes.rut','left');
            $this->db->where("personas.clasificado = 1 and DATE_FORMAT(postulantes.fecha_asignacion,'%Y-%m-%d') = curdate()");
            $para_hoy = $this->db->get('personas');
            $hoy = $para_hoy->result_array();
            $data['hoy'] = $hoy;
            if($guardar==1){
            $postulantes = $this->input->post('postulante');
                
                    foreach($data['hoy'] as $i){
                        //borro los actuales
                        $borrar = array('induccionp' =>NULL);
                        $this->db->where('id_postulante', $i['id_postulante']);
                        $this->db->update('postulantes', $borrar);
                    }
                    //agrego los que corresponden
                    if(!empty($postulantes)){
                        foreach($postulantes as $k=>$a){
                            //echo $k;                    
                            $test = array('induccionp' =>'1');
                            $this->db->where('id_postulante', $k);
                            $this->db->update('postulantes', $test);
                            
                        }                        
                    }
            }
            //inducciones para hoy
            $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno,,postulantes.induccionp,postulantes.observacion_induccion');
            $this->db->join('postulantes','personas.rut = postulantes.rut');
            $this->db->join('areas','areas.id_area = postulantes.id_area');
            $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
            $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo','left');
            $this->db->join('evaluacion_induccion_resultados','evaluacion_induccion_resultados.rut = postulantes.rut','left');
            $this->db->where("personas.clasificado = 1 and DATE_FORMAT(postulantes.fecha_asignacion,'%Y-%m-%d') = curdate()");
            $para_hoy = $this->db->get('personas');
            $hoy = $para_hoy->result_array();
            $data['hoy'] = $hoy;

            //postulantes inducidos
            $this->db->select('postulantes.id_postulante,postulantes.rut,personas.nombre,personas.paterno,personas.materno');
            $this->db->join('postulantes','personas.rut = postulantes.rut');
            $this->db->join('areas','areas.id_area = postulantes.id_area');
            $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera');
            $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo','left');
            $this->db->join('evaluacion_induccion_resultados','evaluacion_induccion_resultados.rut = postulantes.rut','left');
            $this->db->where('personas.clasificado = 1 and evaluacion_induccion_resultados.resultado_final is not null');
            $inducidos = $this->db->get('personas');
            $cant_inducidos = $inducidos->result_array();
            $data['cant_inducidos'] = $cant_inducidos;               

            $this->db->select('postulantes.id_postulante, personas.rut ,DATE(postulantes.fecha_asignacion) as fecha, TIME(postulantes.fecha_asignacion) as hora, personas.nombre');
            $this->db->from('postulantes');
            $this->db->join('personas','personas.rut = postulantes.rut');
            $this->db->where('date(fecha_asignacion) is not null');
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
            $this->db->select("count(id_postulante) as postulantes, DATE(postulantes.fecha_asignacion) as fecha, week(postulantes.fecha_asignacion) as semana,date_format(postulantes.fecha_asignacion, '%Y-%m'), date_format(curdate(), '%Y-%m')");
            $this->db->from('postulantes');
            $this->db->join('personas','personas.rut = postulantes.rut');
            $this->db->where("date_format(postulantes.fecha_asignacion, '%Y-%m') = date_format(curdate(), '%Y-%m')");
            $this->db->group_by("date_format(postulantes.fecha_asignacion, '%Y-%m')");
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
            $this->db->select("postulantes.id_postulante, DATE(postulantes.fecha_asignacion) as fecha, week(postulantes.fecha_asignacion) as semana,
            date_format(postulantes.fecha_asignacion, '%Y-%m'), date_format(curdate(), '%Y-%m'),postulantes.inducido");
            $this->db->from('postulantes');
            $this->db->join('personas','personas.rut = postulantes.rut');
                if($i==1){
                    $this->db->where("(date_format(postulantes.fecha_asignacion, '%Y-%m') = date_format(curdate(), '%Y-%m') and postulantes.inducido=0) or postulantes.entrevistap is null");
                }else{
                    $this->db->where("date_format(postulantes.fecha_asignacion, '%Y-%m') = date_format(curdate(), '%Y-%m') and postulantes.inducido=1");
                }
            $query = $this->db->get();
            if($i==1){
                $tot_entrevista_no = $query->result_array();
            }else{
                $tot_entrevista_si = $query->result_array();
            }
            $data['tot_asignado_no'] = count($tot_entrevista_no);
            $data['tot_asignado_si'] = count($tot_entrevista_si);
            }
            //DONUT FIN


            $this->load->view('common/header');
            $this->load->view('calidad/dashboard',$data);
            $this->load->view('common/footer');
        }

            //desde aqui, escuchas
    public function escuchas(){
        $this->db->from('aspectos_escucha');
        $this->db->where("controlador = 'C'");
        $query = $this->db->get();
        $escuchas = $query->result_array();
        $data['escuchas'] = $escuchas;
        $this->load->view('common/header');
        $this->load->view('calidad/escuchas',$data);
        $this->load->view('common/footer');
    }
    public function agregar_escucha(){
        $escucha = $this->input->post('escucha');
        $ponderacion = $this ->input->post('ponderacion');

          if(!empty($escucha)){
              $nuevo_escucha = array('aspecto' =>  $escucha,'ponderacion' => $ponderacion,'controlador' =>'C','multiplica' =>'7');
              $this->db->insert('aspectos_escucha',$nuevo_escucha);
              redirect(base_url("index.php/Gestion/escuchas"));
          }

        $this->load->view('common/header');
        $this->load->view('calidad/add/escucha');
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
                        'controlador' => 'C'
                    );
                    $this->db->insert('aspecto_escucha_items', $nuevo_item_escucha);
                }
            }
            redirect(base_url("index.php/Calidad/escuchas"));
        }
        
        $this->db->select('aspectos_escucha.id_aspecto, aspectos_escucha.aspecto,aspectos_escucha.ponderacion, aspecto_escucha_items.item_aspecto,
aspecto_escucha_items.ponderacion as i_ponderacion');
        $this->db->from('aspectos_escucha');
        $this->db->join('aspecto_escucha_items','aspectos_escucha.id_aspecto = aspecto_escucha_items.id_aspecto_escucha','left');
        $this->db->where("aspectos_escucha.id_aspecto = ".$id." and aspecto_escucha_items.controlador ='C'");
        $query = $this->db->get();
        $escucha = $query->result_array();
        $data['escucha'] = $escucha;
        $data['id'] = $id;
        $this->load->view('common/header');
        $this->load->view('calidad/edit/escucha',$data);
        $this->load->view('common/footer');
    }
    //hasta aqui escuchas
}
?>