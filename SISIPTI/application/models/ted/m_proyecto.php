<?php 

class M_proyecto extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function modificarProyecto($data,$id){
		$this->db->where('idProyecto', $id);
		$this->db->update('t_proyecto', $data); 
	}

	public function traer_proyecto_table($id){
		$this->db->select('*');
		$this->db->where('idProyecto', $id);
		$this->db->from('t_proyecto');
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->row_array();
	    }
	}

	public function traer_proyectos(){
		$this->db->select('t_proyecto.idProyecto,t_proyecto.fk_idEstado,t_proyecto.nombProyecto,t_persona.nombPersona,t_proyecto.dirProyecto,t_estado.nombEstado');
		$this->db->from('t_proyecto');
		$this->db->join('t_cliente', 't_proyecto.fk_idCliente = t_cliente.idCliente');
		$this->db->join('t_persona', 't_cliente.fk_idPersona = t_persona.idPersona');
		$this->db->join('t_estado', 't_proyecto.fk_idEstado = t_estado.idEstado');
	    $query = $this->db->get();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
	public function insertarProyecto($data){
		$this->db->insert('t_proyecto', $data); 
		return $this->db->insert_id();
	}
	public function suspender_proyecto($id){
		$this->db->where('idProyecto', $id);
		$this->db->update('t_proyecto', array('fk_idEstado' =>2 )); 
	}
	public function reanudar_proyecto($id){
		$this->db->where('idProyecto', $id);
		$this->db->update('t_proyecto', array('fk_idEstado' =>1 )); 
	}
}

?>