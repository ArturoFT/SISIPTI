<?php 

class M_ambiente extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	function actualizarTipo($data,$idAmb){
		$this->db->where('idAmbiente', $idAmb);
		$this->db->update('t_ambiente', $data); 
	}

	function actualizar_ambiente($data, $id){
		$this->db->where('idAmbiente', $id);
		$this->db->update('t_ambiente', $data); 
	}

	public function insertarAmbiente($data){
		$this->db->insert('t_ambiente', $data); 
		return $this->db->insert_id();
	}

	public function traer_ambiente($idA){
		$this->db->select('*');
		$this->db->from('t_ambiente');
		$this->db->where('idAmbiente', $idA);
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->row_array();
	    }
	}

	public function traer_ambientes($idP){
		$this->db->select('*');
		$this->db->from('t_ambiente');
		$this->db->where('fk_idProyecto', $idP);
		$this->db->where('fk_idTipoAmbiente !=',1);
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function idTipoAmbiente($id){
		$this->db->select('t_tipo_ambiente.idTipoAmbiente');
		$this->db->from('t_ambiente');
		$this->db->join('t_tipo_ambiente', 't_ambiente.fk_idTipoAmbiente = t_tipo_ambiente.idTipoAmbiente');
		$this->db->where('t_ambiente.idAmbiente', $id);
		$query = $this->db->get();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->row_array();
	    }
	}

	public function traer_ambientePrecargado(){
		$this->db->select('t_tipo_ambiente.nombTipoAmbiente,t_ambiente.idAmbiente,t_tipo_ambiente.idTipoAmbiente');
		$this->db->from('t_ambiente');
		$this->db->join('t_tipo_ambiente', 't_ambiente.fk_idTipoAmbiente = t_tipo_ambiente.idTipoAmbiente');
		$this->db->where('t_ambiente.fk_idProyecto', null);
		$query = $this->db->get();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function traer_actividadesPrecargadasAmbiente($idAmbiente){
		$this->db->select('*');
		$this->db->from('t_ambiente_actividad');
		$this->db->join('t_actividad','t_ambiente_actividad.fk_idActividad = t_actividad.idActividad');
		$this->db->where('t_ambiente_actividad.fk_idAmbiente', $idAmbiente);
		$query = $this->db->get();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}	

	public function traer_actividadesPrecargadasAmbienteClon($idAmbiente){
		$this->db->select('t_actividad.idActividad,t_actividad.nombActividad,t_actividad.descActividad,t_actividad.prioridadActividad,t_actividad.fechaRealizacionActividad,t_actividad.fechaIniActividad,t_actividad.fechaFinActividad,t_actividad.costoManoObraActividad,t_actividad.costoMaterialesActividad,');
		$this->db->from('t_ambiente_actividad');
		$this->db->join('t_actividad','t_ambiente_actividad.fk_idActividad = t_actividad.idActividad');
		$this->db->where('t_ambiente_actividad.fk_idAmbiente', $idAmbiente);
		$query = $this->db->get();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
	public function getAmbientesProyecto($idProyecto){
		//PENDIENTE CAMBIAR DESC AMBIENTE POR NOMBRE AMBIENTE
		$query = $this->db->query('select * from t_ambiente, t_proyecto where idAmbiente != 2 and t_proyecto.idProyecto='.$idProyecto);
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}	
}

?>