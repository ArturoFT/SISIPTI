<?php 

class M_material extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function getMateriales(){
		$this->db->select('nombMaterial,unidadMaterial');
	    $this->db->from('t_material');
	    $query = $this->db->get();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
}

?>
