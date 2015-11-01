<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_ambienteporproyecto extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	function traer_ambientesxProyecto($idProyecto){


	$this->db->select('t_ambiente.*');
	$this->db->from('t_ambiente');
	$this->db->join('t_proyecto','t_ambiente.fk_idProyecto=t_proyecto.idProyecto');
	$this->db->where('t_proyecto.idProyecto',$idProyecto);
	$this->db->where('t_ambiente.fk_idTipoAmbiente !=',1);
	$query=$this->db->get();
		if(empty($query)){
			return false;
		}
	else{
		return $query->result_array();
		}


	}
}
?>