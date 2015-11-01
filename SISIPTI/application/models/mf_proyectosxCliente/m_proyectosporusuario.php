<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_proyectosporusuario extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

function traer_proyectosxUsuario($idUsuario){
	$this->db->select('t_proyecto.*');
	$this->db->from('t_proyecto');
	$this->db->join('t_cliente','t_proyecto.fk_idCliente=t_cliente.idCliente');
	$this->db->join('t_persona','t_cliente.fk_idPersona=t_persona.idPersona');
	$this->db->join('t_usuario','t_persona.fk_idUsuario=t_usuario.idUsuario');
	$this->db->where('t_usuario.idUsuario',$idUsuario);
	$query=$this->db->get();
	if(empty($query)){
		return false;
	}
	else{
		return $query->result_array();
	}
//	$select = "select idProyecto,nombProyecto,dirProyecto,fechaIniProyecto,alcanceProyecto,exclusionesProyecto,fechaRegistroProyecto,presupuestoIniProyecto,fk_idEstado,fk_idCliente,fk_idTipoProyecto from t_proyecto";
	//$result = $this->db->query($select);
	//return $result->result();
	}

	function traer_proyectosxUsuario2($idUsuario){
	
	$this->db->select('t_proyecto.*');
	$this->db->from('t_proyecto');
	$this->db->join('t_ambiente','t_proyecto.idProyecto = t_ambiente.fk_idProyecto');
	$this->db->join('t_ambiente_actividad','t_ambiente.idAmbiente = t_ambiente_actividad.fk_idAmbiente');
	$this->db->join('t_ambiente_actividad_trabajador','t_ambiente_actividad.idAmbiente_actividad = t_ambiente_actividad_trabajador.fk_idAmbiente_actividad');
	$this->db->join('t_trabajador','t_ambiente_actividad_trabajador.fk_idTrabajador= t_trabajador.idTrabajador');
	$this->db->join('t_persona','t_trabajador.fk_idPersona= t_persona.idPersona');
	$this->db->join('t_usuario','t_persona.fk_idUsuario= t_usuario.idUsuario');
	$this->db->where('t_usuario.idUsuario',$idUsuario);
	$query=$this->db->get();
	if(empty($query)){
		return false;
	}
	else{
		return $query->result_array();
	}
//	$select = "select idProyecto,nombProyecto,dirProyecto,fechaIniProyecto,alcanceProyecto,exclusionesProyecto,fechaRegistroProyecto,presupuestoIniProyecto,fk_idEstado,fk_idCliente,fk_idTipoProyecto from t_proyecto";
	//$result = $this->db->query($select);
	//return $result->result();
	}

}
?>