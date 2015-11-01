<?php 

class M_cargo extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function getNombreCargo(){
		$query = $this->db->query('select * from t_cargo');
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

}
?>