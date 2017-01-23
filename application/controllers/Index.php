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
        $this->load->view('common/header');
        $this->load->view('index/dashboard');
        $this->load->view('common/footer');
    }
    
    public function cargar_carteras(){
        $area = $this->input->post('area');
        $carteras = $this->MyModel->buscar_model('carteras','id_area ='.$area);
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