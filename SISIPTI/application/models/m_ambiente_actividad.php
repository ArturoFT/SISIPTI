<?php 

class M_ambiente_actividad extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	function eliminar($idAct,$idAmb){
		$this->db->where('fk_idActividad', $idAct);
		$this->db->where('fk_idAmbiente', $idAmb);
		$this->db->delete('t_ambiente_actividad');	
	}

	public function traerIdsActs($idAmb){
		$this->db->select('t_actividad.idActividad');
		$this->db->from('t_actividad');
		$this->db->join('t_ambiente_actividad','t_actividad.idActividad = t_ambiente_actividad.fk_idActividad');
		$this->db->where('t_ambiente_actividad.fk_idAmbiente', $idAmb);
		$this->db->where('idActividad !=',1);
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function insertarAmbienteActividad($data){
		$this->db->insert('t_ambiente_actividad', $data); 
		return $this->db->insert_id();
	}

	public function update_agregado($idAmb,$idAct,$agregado){
		$this->db->update('t_ambiente_actividad', array('agregado' => (int)$agregado), array('fk_idAmbiente' => (int)$idAmb, 'fk_idActividad' => (int)$idAct));
		//echo $this->db->last_query();
	}
}

?>