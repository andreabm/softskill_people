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

        //$lsucursales = $this->MyModel->buscar_select('sucursales','sucursales','sucursales');
        //$data['lsucursales'] = $lsucursales;
        //print_r($this->db->last_query());
        $data['carteras'] = $carteras;
        $data['sucursales'] = $sucursales;
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
}
?>