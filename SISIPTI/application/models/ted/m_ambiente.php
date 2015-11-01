<?php 

class M_ambiente extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	public function insertarAmbiente($data){
		$this->db->insert('t_ambiente', $data); 
		return $this->db->insert_id();
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
		$this->db->select('t_tipo_ambiente.nombTipoAmbiente,t_ambiente.idAmbiente');
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
	public function getAmbientesProyecto($idProyecto,$idAmbienteFantasma){
		//PENDIENTE CAMBIAR DESC AMBIENTE POR NOMBRE AMBIENTE
		$query = $this->db->query('select * from t_ambiente, t_proyecto where t_ambiente.fk_idProyecto=t_proyecto.idProyecto and  idAmbiente != '.$idAmbienteFantasma.' and t_proyecto.idProyecto='.$idProyecto);
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}	

	public function getIdAmbienteFantasmaPorTipo($idProyecto){
		//CAMBIAR ID 2 POR 1
		$query = $this->db->query('select idAmbiente from t_ambiente inner join t_proyecto on t_proyecto.idProyecto = t_ambiente.fk_idProyecto inner join t_tipo_ambiente on t_tipo_ambiente.idTipoAmbiente=t_ambiente.fk_idTipoAmbiente
								where t_tipo_ambiente.idTipoAmbiente= 1 and t_proyecto.idProyecto = '.$idProyecto);
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
}

?>