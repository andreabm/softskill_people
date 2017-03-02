<?php
class Index extends CI_Controller {
    
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
    
    public function dashboard(){
            //usuarios        
            $usuarios = $this->MyModel->buscar_model('usuarios','id_rango = 5');
            $data['usuarios'] = $usuarios;
            //postulantes
            $postulantes = $this->MyModel->buscar_model('postulantes');
            $data['postulantes'] = $postulantes;
            //
            //AREA CHARTS INI
            $this->db->select("COUNT(postulantes.id_postulante) as postulantes, DATE(postulantes.fecha_entrevista) AS fecha,WEEK (postulantes.fecha_entrevista) AS semana,date_format(postulantes.fecha_entrevista,'%Y-%m'),date_format(curdate(), '%Y-%m') as mes");
            $this->db->from('postulantes');
            $this->db->join('personas','personas.rut = postulantes.rut');
            #$this->db->where("date_format(postulantes.fecha_entrevista, '%Y-%m') = date_format(curdate(), '%Y-%m')");
            $this->db->group_by("mes");
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

            $data['founder'] = $this->MyModel->buscar_model('usuarios','id_rango = 1');
            
        //autocomplete ini
        $this->db->select("postulantes.id_postulante,postulantes.rut,date_format(postulantes.fecha_entrevista, '%d-%m-%Y') as fecha_entrevista,date_format(postulantes.fecha_asignacion, '%d-%m-%Y') as fecha_asignacion,personas.nombre,personas.paterno,areas.area,carteras.cartera,tipos_ejecutivos.tipo_ejecutivo,resultado_evaluacion_psicologica.resultado_final");
        $this->db->from('personas');
        $this->db->join('postulantes','personas.rut = postulantes.rut');
        $this->db->join('areas','areas.id_area = postulantes.id_area','left');
        $this->db->join('carteras','carteras.id_cartera = postulantes.id_cartera','left');
        $this->db->join('resultado_evaluacion_psicologica','resultado_evaluacion_psicologica.rut = postulantes.rut','left');
        $this->db->join('tipos_ejecutivos','tipos_ejecutivos.id_tipo_ejecutivo = postulantes.id_cargo', 'left');
        //$this->db->where('personas.clasificado = 1');
        $query = $this->db->get();
        $ejecutivos = $query->result_array();
        $data['ejecutivos'] = $ejecutivos;
        //autocomplete fin

        $this->load->view('common/header');
        $this->load->view('index/dashboard',$data);
        $this->load->view('common/footer');
    }
    
    public function cargar_carteras(){
        $area = $this->input->post('area');

        //$carteras = $this->MyModel->buscar_model('carteras','id_area ='.$area);

        $query = $this->db->query("
        SELECT carteras.id_cartera,carteras.cartera
        FROM carteras
        INNER JOIN areas on (areas.id_area = carteras.id_area)
        WHERE carteras.id_area = ".$area." and carteras.id_cartera not in (SELECT id_cartera FROM solicitudes where activo = 1) ");
        $carteras = $query->result_array();


        $sucursales = $this->MyModel->buscar_model('areas','id_area ='.$area);
        $solicitudes = $this->MyModel->buscar_model('solicitudes','id_area ='.$area);

        //$lsucursales = $this->MyModel->buscar_select('sucursales','sucursales','sucursales');
        //$data['lsucursales'] = $lsucursales;
        //print_r($this->db->last_query());
        $data['carteras'] = $carteras;
        $data['sucursales'] = $sucursales;
        $data['solicitudes'] = $solicitudes;
        print_r(json_encode($data));
    }
    public function cargar_solicitudes(){
        $area = $this->input->post('area');        
        //$carteras = $this->MyModel->buscar_model('carteras','id_area ='.$area);
        $query = $this->db->query("SELECT carteras.id_cartera, carteras.cartera FROM carteras 
                                    INNER JOIN solicitudes ON solicitudes.id_cartera = carteras.id_cartera WHERE carteras.id_area = ".$area);
        $carteras = $query->result_array();

        $sucursales = $this->MyModel->buscar_model('areas','id_area ='.$area);
        $solicitudes = $this->MyModel->buscar_model('solicitudes','id_area ='.$area);

        //$lsucursales = $this->MyModel->buscar_select('sucursales','sucursales','sucursales');
        //$data['lsucursales'] = $lsucursales;
        //print_r($this->db->last_query());
        $data['carteras'] = $carteras;
        $data['sucursales'] = $sucursales;
        $data['solicitudes'] = $solicitudes;
        print_r(json_encode($data));

    }
    
    public function cargar_supervisor(){
        $area = $this->input->post('area');        
        //$carteras = $this->MyModel->buscar_model('carteras','id_area ='.$area);
        $query = $this->db->query("SELECT supervisores.id_supervisor, supervisores.nombre_supervisor FROM carteras 
                                    INNER JOIN supervisores ON supervisores.id_cartera = carteras.id_cartera WHERE supervisores.id_cartera = ".$area);
        $supervisores = $query->result_array();
        $data['supervisores'] = $supervisores;
        print_r(json_encode($data));
    }

    public function cargar_solicitudes_b(){
        $cartera = $this->input->post('cartera');
        $area = $this->input->post('area');
        $solicitud = $this->MyModel->buscar_model('solicitudes','id_cartera ='.$cartera,'id_area ='.$area);

        $data['solicitud'] = $solicitud;
        print_r(json_encode($data));
    }

    public function test(){
        $rut = $this->input->post('rut');
        $persona = $this->MyModel->buscar_model('personas','id_persona ='.$rut);
        $data['persona'] = $persona;
        $postulante = $this->MyModel->buscar_model('postulantes','id_postulante ='.$rut);        
        $cargos = $this->MyModel->buscar_model('cargos','id_cargo ='.$postulante[0]['id_cargo']);
        $data['postulante'] = $cargos;
        print_r(json_encode($data));
    }
    public function new_login(){
        $this->load->view('common/header_nlogin');
        $this->load->view('index/new_login');
        //$this->load->view('common/footer');
    }
}
?>