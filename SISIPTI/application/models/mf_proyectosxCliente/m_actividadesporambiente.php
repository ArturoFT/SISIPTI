<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_actividadesporambiente extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	function traer_actividadesxAmbiente($idAmbiente){
	
		$this->db->select('t_actividad.*');
		$this->db->from('t_actividad');
		$this->db->join('t_ambiente_actividad','t_actividad.idActividad=t_ambiente_actividad.fk_idActividad');
		$this->db->join('t_ambiente','t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente');
		$this->db->where('t_ambiente.idAmbiente',$idAmbiente);
		$this->db->where('t_actividad.idActividad !=',1);
		$query=$this->db->get();
		if(empty($query)){
			return false;
		}else{
			return $query->result_array();
		}
	}


}
?>