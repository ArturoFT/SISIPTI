<?php 

class M_cliente extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	public function traer_clienteProyecto(){
		$this->db->select('*');
		$this->db->from('t_cliente');
		$this->db->join('t_persona', 't_cliente.fk_idPersona = t_persona.idPersona');
	    $query = $this->db->get();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
}

?>