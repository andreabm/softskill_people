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
        //print_r($this->db->last_query());
        $data['carteras'] = $carteras;
        print_r(json_encode($data));
    }
}
?>