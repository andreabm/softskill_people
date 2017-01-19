<?php
class Usuarios extends CI_Controller {
    
  public function __construct(){	
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
    $this->load->library('email');
    $this->load->library('form_validation');
    $this->load->library('javascript');
    $this->load->library('session');
		$this->load->library('parser');
    $this->load->model('Usuario');
		//$this->load->model('Rango');
    $this->load->model('MyModel');		
	}

  function login(){    
     //###############################################
     //veriricamos si el usuario se encuentra inactivo usando los datos ingresados desde form
     $user = $this->input->post('usuario');
     $pass = $this->input->post('password');
     $data = array();
     if (isset($this->session->userdata['usuario'])) {
        redirect(base_url().'index.php/Operaciones/solicitudes');
     }else {
        if ($this->input->post('usuario')) {
            $username = $this->input->post('usuario');
            $password = $this->input->post('password');
            $valido = $this->Usuario->login($username,$password);
            if (!empty($valido)) {
                $sessiondata = array(
                  'usuario' => $username,
                  'nombre' => $valido[0]['nombre'],
                  'id_usuario' => $valido[0]['id_usuario'], 
                  'id_rango' => $valido[0]['id_rango'],
                  'mail' => $valido[0]['mail'],
                  'img' => $valido[0]['img']
                );
                $this->session->set_userdata($sessiondata);
                redirect(base_url().'index.php/index/dashboard');
            } else {
                $data['msg'] = '<div class="alert alert-danger text-center">Datos de sesión invalidos o Usuario inactivo</div>';     
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Nombre de usuario o contraseña inválido</div>');
            }           
        }
       $this->load->view('usuarios/login',$data);        
     }
  }
  function logout($mensaje = null){
    $this->session->unset_userdata('usuario');
    $this->session->sess_destroy();
    redirect(base_url().'index.php/usuarios/login','refresh');
  }

  function usuarios(){
    $this->db->from('usuarios');
    $this->db->join('rangos','rangos.id_rango = usuarios.id_rango');
    $query = $this->db->get();
    $usuarios = $query->result_array();

    $data['usuarios'] = $usuarios;
    $this->load->view('common/header');
    $this->load->view('usuarios/usuarios',$data);
    $this->load->view('common/footer');
  }

  function editar_usuario($id_usuario){
    if(empty($id_usuario)){
      $id_usuario = $this->input->post('id_usuario');
    }
    $this->db->from('usuarios');
    $this->db->join('rangos','rangos.id_rango = usuarios.id_rango');
    $this->db->where('usuarios.id_usuario='.$id_usuario);
    $query = $this->db->get();
    $usuario = $query->result_array();
    $data['usuario'] = $usuario;

    $this->load->view('common/header');
    $this->load->view('usuarios/edit/usuario',$data);
    $this->load->view('common/footer');
  }

}
?>