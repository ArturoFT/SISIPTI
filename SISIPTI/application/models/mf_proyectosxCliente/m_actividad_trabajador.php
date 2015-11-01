<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_actividad_trabajador extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	function traer_trabajadoresxActividad($idActividad){
		
		$this->db->select('t_persona.*,t_cargo.nombCargo');
		$this->db->from('t_actividad');		
		$this->db->join('t_ambiente_actividad','t_actividad.idActividad = t_ambiente_actividad.fk_idActividad');
		$this->db->join('t_ambiente_actividad_trabajador','t_ambiente_actividad.idAmbiente_actividad = t_ambiente_actividad_trabajador.fk_idAmbiente_actividad');
	    $this->db->join('t_trabajador','t_ambiente_actividad_trabajador.fk_idTrabajador = t_trabajador.idTrabajador');
	    $this->db->join('t_persona','t_trabajador.fk_idPersona = t_persona.idPersona');
	    $this->db->join('t_cargo','t_trabajador.fk_idCargo = t_cargo.idCargo');

		$this->db->where('t_actividad.idActividad', $idActividad);
		$query = $this->db->get();
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }

	}
}