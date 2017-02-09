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
    $this->init();
	}
  
  public function init(){
     if (isset($this->session->userdata['usuario'])){
          //Verifico si tengo permiso para acceder al modulo
          $controlador = $this->router->fetch_class();
          $action = $this->router->fetch_method();

          $permisos = $this->MyModel->buscar_model('permisos',array('controller' => $controlador,'view' => $action));

          $permisos = explode(';',$permisos[0]['rangos']);
          $rango = $this->session->userdata['id_rango'];
                   
          if(!in_array($rango,$permisos)) {
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
    $this->session->userdata['id_rango']; 
    $this->db->from('usuarios');
    $this->db->join('rangos','rangos.id_rango = usuarios.id_rango');
    $query = $this->db->get();
    $usuarios = $query->result_array();

    $data['usuarios'] = $usuarios;

    if($this->session->userdata['id_rango']==1 || $this->session->userdata['id_rango']==2){
        $this->load->view('common/header');
        $this->load->view('usuarios/usuarios',$data);
        $this->load->view('common/footer');
    }else{
        redirect(base_url('index.php/usuarios/usuarios'),'refresh');
    }
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
  function update_usuario(){  
        // Cargamos la libreria Upload
        $this->load->library('upload');
        $id_usuario = $this->input->post('id_usuario');
        $password = md5($this->input->post('password'));
        $contrasena = $this->input->post('contrasena');

        //si son iguales actualizo la contraseña
        if($password!=$contrasena){
            $pass = $password;
        }

        /*
         * Revisamos si el archivo fue subido
         * Comprobamos si existen errores en el archivo subido
         */
       
       
       if (!empty($_FILES['archivo']['name'])){
            //solo extension
            $ext = end(explode(".", $_FILES['archivo']['name']));
            //Borrar archivo
            //unlink(APPPATH.'uploads/profile/'.$id_usuario.'.'.$ext);
            unlink(FCPATH.'assets/dist/img/profile/'.$id_usuario.'.'.strtolower($ext));

            // Configuración para el Archivo 1
            //$config['upload_path'] = APPPATH . 'uploads/profile/';
            $config['upload_path'] = FCPATH . 'assets/dist/img/profile/';
            //$this->upload_config['upload_path'] = APPPATH . 'uploads/working/';
            $config['allowed_types'] = 'JPG|JPEG|GIF|PNG|gif|jpg|png|jpeg';
            $config['max_size'] = '3000';
            $config['max_width']  = '3000';
            $config['max_height']  = '2500';
            $config['remove_spaces'] = TRUE;
            //cambiar nombre archivo, dos formas
            //$config['encrypt_name'] = TRUE;            
            //$new_name = $_FILES["archivo"]['name'];
            $config['file_name'] = $this->input->post('id_usuario');
            // Cargamos la configuración del Archivo 1
            $this->upload->initialize($config);
            // Subimos archivo 1
            if ($this->upload->do_upload('archivo')){
                $data = $this->upload->data();
            }else{
                echo $this->upload->display_errors();
            }
            //updeteo en tabla
            $subir = 'http://172.16.10.15/SoftSkills_People/assets/dist/img/profile/'.$id_usuario.'.'.strtolower($ext);

            $data = array(
                   'rut' => $this->input->post('rut'),
                   'usuario' => $this->input->post('usuario'),
                   'nombre' => $this->input->post('nombre'),
                   'mail' => $this->input->post('mail'),
                   'img' => $subir,
                   'anexo' => $this->input->post('anexo')
            );
            $this->db->where('id_usuario', $id_usuario);
            $this->db->update('usuarios', $data);          
        }else{
            //updeteo en tabla
            if(!empty($this->input->post('img'))){

                //borrar archivo existente
                $variable = explode('/', $this->input->post('imagen'));
                unlink(FCPATH.'assets/dist/img/profile/'.$variable[8]);

                $data = array(
                   'rut' => $this->input->post('rut'),
                   'usuario' => $this->input->post('usuario'),
                   'nombre' => $this->input->post('nombre'),
                   'mail' => $this->input->post('mail'),
                   'img' => $this->input->post('img'),
                   'anexo' => $this->input->post('anexo'),
                   'password' => $pass
                );
            }else{
                $data = array(
                   'rut' => $this->input->post('rut'),
                   'usuario' => $this->input->post('usuario'),
                   'nombre' => $this->input->post('nombre'),
                   'mail' => $this->input->post('mail'),
                   'anexo' => $this->input->post('anexo'),
                   'password' => $pass
                );
            }            
            $this->db->where('id_usuario', $id_usuario);
            $this->db->update('usuarios', $data);
        }
        redirect(base_url('/index.php/usuarios/usuarios/'.$id_usuario));
        
  }

}
?>