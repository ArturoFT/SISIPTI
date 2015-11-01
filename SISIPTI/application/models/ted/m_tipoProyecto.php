<?php 

class M_tipoProyecto extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	public function traer_tipoProyecto(){
		$this->db->select('*');
		$this->db->from('t_tipo_proyecto');
	    $query = $this->db->get();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
}

?>