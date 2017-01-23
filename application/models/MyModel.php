<?php
class MyModel extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function agregar_model($tabla,$data,$campo_id = null,$id = null) {
        if (!empty($id)) {
            $this->db->where($campo_id, $id);
            $this->db->update($tabla, $data); 
        } else {
            $this->db->insert($tabla, $data);
        }
        return $this->db->insert_id();
    }

    public function buscar_model($tabla,$conditions=null){
        $this->db->from($tabla);
        if (!empty($conditions)) {
            $this->db->where($conditions);
        }  
       
        //$this->db->limit(2000);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function buscar_select($tabla,$id_tabla,$campo,$conditions = null,$id = true){
        if (!empty($conditions)) {
            $this->db->where($conditions);
            //print_r($conditions);
        }
        $this->db->order_by($campo); 
        $query = $this->db->get($tabla);
        $result = array();
        foreach ($query->result_array() as $value) {
            if ($id) {
                    $result[$value[$id_tabla]] = $value[$campo];
                } else {
                     $result[$value[$campo]] = $value[$campo];
                }  
        }
        return $result;
    }
    
    public function select($tabla, $campo,$conditions = null){
        if (!empty($conditions)) {
            $this->db->where(array('id <>' => 1));
        }
        $query = $this->db->get($tabla);
        $result = array();
        foreach ($query->result_array() as $value) {
          $result[$value['id']] = $value[$campo];
        }
        return $result;
    }
    
    public function buscar_permisos(){
        $this->db->from('permisos');
        $this->db->where('es_menu = 1');
        $this->db->order_by('area','orden');
        $query = $this->db->get();
        $permisos_q = $query->result_array();
        $permisos = array();
        foreach ($permisos_q as $p) {
			if ($p['es_submodulo'] == 1) {
				if (empty($permisos[$p['area']][$p['nombre']])){
					$permisos[$p['area']][$p['nombre']] = array(); 
				}
				
			} else {
				if ($p['es_subarea'] == 1) {
					//print_r($p);
					$permisos[$p['area']][$p['subarea']][] = $p; 
					//print_r($permisos);
				} else {
					$permisos[$p['area']][] = $p; 
				}
			}
            
        }
		
        return $permisos;
    }
}
?>