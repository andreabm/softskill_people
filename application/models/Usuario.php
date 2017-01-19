<?php
class Usuario extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getUsuarios($conditions = null){
        $this->db->from('usuarios');
        //$this->db->where('activo',1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function agregar($usuario,$id = null) {
        //si el id no es null entonces actualizo
        if (!empty($id)) {
            $this->db->where('id', $id);
            $this->db->update('usuarios', $usuario); 
        } else {
            $this->db->insert('usuarios', $usuario);
        }
        return true;
    }
    
    public function eliminar($id) {
        $this->db->delete('usuarios',array('id'=>$id));
        return true;
    }

    
  function login($user, $password){
     $this -> db -> select('id_usuario,rut, usuario,nombre ,password, id_rango, mail, img');
     $this -> db -> from('usuarios');
     $this -> db -> where('usuario', $user);
     $this -> db -> where('password', MD5($password));
     $this -> db -> limit(1);
 
     $query = $this -> db -> get();
   //  print_r($this->db->last_query());
     $query = $query->result_array();
     return $query;
    }
}
?>