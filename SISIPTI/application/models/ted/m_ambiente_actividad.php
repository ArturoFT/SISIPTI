<?php 

class M_ambiente_actividad extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	public function insertarAmbienteActividad($data){
		$this->db->insert('t_ambiente_actividad', $data); 
		return $this->db->insert_id();
	}
}

?>