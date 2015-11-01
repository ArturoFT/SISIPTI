<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_adtrabajador extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	function getTabla(){
	
	$select = "select idTrabajador,sexoTrabajador,nombCargo,fk_idCargo,nacionalidadTrabajador,sueldoTrabajador,fk_idPersona,nroDocPersona,telefPersona,tipoDocPersona,idPersona,nombPersona,dirPersona,emailPersona  from t_trabajador inner join t_persona inner join t_cargo where t_trabajador.fk_idPersona = t_persona.idPersona and t_cargo.idCargo = t_trabajador.fk_idCargo ORDER BY idTrabajador desc";
	$result = $this->db->query($select);
	return $result->result();
	}

	function registrarTrabajador($dataT){
		$this->db->insert('t_trabajador',$dataT);

}
	function registrarPersona($dataP){
		$this->db->insert('t_persona',$dataP);
	    return $this->db->insert_id();
		
	}



	function getTrabajador($id){
	
	$select = "select idTrabajador,sexoTrabajador,idCargo,nacionalidadTrabajador,nombCargo,fk_idCargo,sueldoTrabajador,fk_idPersona,nroDocPersona,telefPersona,tipoDocPersona,idPersona,nombPersona,dirPersona,emailPersona  from t_trabajador inner join t_persona inner join t_cargo where fk_idPersona=".$id." and t_trabajador.fk_idPersona = t_persona.idPersona and  t_cargo.idCargo = t_trabajador.fk_idCargo ORDER BY idTrabajador desc";
	$result = $this->db->query($select);
	return $result->row();
	}


	function actualizarT($data,$id){

	$this->db->where('fk_idPersona',$id);
	$this->db->update('t_trabajador',$data);

	}


	function actualizarP($data,$id){
	

	$this->db->where('idPersona',$id);
	$this->db->update('t_persona',$data);

	}

	function eliminarT($id){
	
	$this->db->where('fk_idPersona',$id);
	$this->db->delete('t_trabajador');


	}
	function eliminarC($idc){
	
	$this->db->where('idCargo',$idc);
	$this->db->delete('t_cargo');


	}

	function eliminarP($id){
	
	$this->db->where('idPersona',$id);
	$this->db->delete('t_persona');


	}

	function buscarNombre(){
	$select = "select idPersona,nombPersona from t_persona ";
	$result = $this->db->query($select);
	return $result->result();
	}

	function buscarCargo(){
	$select = "select idCargo,nombCargo,descCargo from t_cargo ";
	$result = $this->db->query($select);
	return $result->result();
	}

	function buscarCargo2(){
	$select = "select idCargo,nombCargo,descCargo from t_cargo ";
	$result = $this->db->query($select);
	return $result->row();
	}


}
?>