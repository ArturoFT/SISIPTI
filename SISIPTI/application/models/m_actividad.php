<?php 

class M_actividad extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	function traerTrabajadoresxAct($idAct){
		$this->db->select('t_persona.*,t_cargo.nombCargo');
		$this->db->from('t_actividad');		
		$this->db->join('t_ambiente_actividad','t_actividad.idActividad = t_ambiente_actividad.fk_idActividad');
		$this->db->join('t_ambiente_actividad_trabajador','t_ambiente_actividad.idAmbiente_actividad = t_ambiente_actividad_trabajador.fk_idAmbiente_actividad');
	    $this->db->join('t_trabajador','t_ambiente_actividad_trabajador.fk_idTrabajador = t_trabajador.idTrabajador');
	    $this->db->join('t_persona','t_trabajador.fk_idPersona = t_persona.idPersona');
	    $this->db->join('t_cargo','t_trabajador.fk_idCargo = t_cargo.idCargo');

		$this->db->where('t_actividad.idActividad', $idAct);
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	function traerActividad($id){
		$this->db->select('*');
		$this->db->from('t_actividad');	
		$this->db->where('idActividad',$id);
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->row_array();
	    }
	}

	function insertar($data){
		$this->db->insert('t_actividad', $data); 
		return $this->db->insert_id();
	}

	function eliminar($idActs){
		$this->db->where_in('idActividad', $idActs);
		$this->db->delete('t_actividad');			
	}

	function actualizar($data,$id){
		$this->db->where('idActividad', $id);
		$this->db->update('t_actividad', $data); 			
	}

	function actividad_noModificable_mat($idAmbAct){
		$this->db->select('*');
		$this->db->from('t_ambiente_actividad');		
		$this->db->join('t_ambiente_actividad_material','t_ambiente_actividad.idAmbiente_actividad = t_ambiente_actividad_material.fk_idAmbienteActividad');

		$this->db->where('idAmbiente_actividad', $idAmbAct);
		$this->db->where('fk_idActividad !=',1);
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
	function actividad_noModificable_tra($idAmbAct){
		$this->db->select('*');
		$this->db->from('t_ambiente_actividad');		
		$this->db->join('t_ambiente_actividad_trabajador','t_ambiente_actividad.idAmbiente_actividad = t_ambiente_actividad_trabajador.fk_idAmbiente_actividad');

		$this->db->where('idAmbiente_actividad', $idAmbAct);
		$this->db->where('fk_idActividad !=',1);
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function traer_actividadesxAmb($idAmd){
		$this->db->select('*');
		$this->db->from('t_actividad');		
		$this->db->join('t_ambiente_actividad','t_actividad.idActividad = t_ambiente_actividad.fk_idActividad');
		$this->db->where('fk_idAmbiente', $idAmd);
		$this->db->where('fk_idActividad !=',1);
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function traer_actividadesxAmb2($idAmd){
		$this->db->select('*');
		$this->db->from('t_actividad');		
		$this->db->join('t_ambiente_actividad','t_actividad.idActividad = t_ambiente_actividad.fk_idActividad');
		$this->db->where('fk_idAmbiente', $idAmd);
		$this->db->where('fk_idActividad !=',1);
		$this->db->where('agregado',1);
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function insertarActividad($data){
		$this->db->insert('t_actividad', $data); 
		return $this->db->insert_id();
	}
	public function getActividadAmbientes($idProyecto,$idAmbiente){
		$query = $this->db->query('select idActividad,nombreActividad from t_actividad,t_proyecto,t_ambiente,t_ambiente_actividad where t_ambiente.fk_idProyecto=t_proyecto.idProyecto and t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad and t_actividad.idActividad !=1 and t_ambiente.idAmbiente!=2 and t_proyecto.idProyecto= '.$idProyecto.' and t_ambiente.idAmbiente='.$idAmbiente);
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
}

?>