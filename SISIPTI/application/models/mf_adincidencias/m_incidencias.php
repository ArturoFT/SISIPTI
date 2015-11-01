<?php 

class M_incidencias extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function insertarIncidencias($data){
		$this->db->insert('t_incidencia_cambio', $data); 
		

	}
	public function getTabla(){
	
	$select = "select idIncidencia_cambio,tituloIncidencia,Descripcion,actividadInvolucrada,planRespuesta,detallesAdicional,fk_idAmbiente,nombAmbiente,idAmbiente from t_incidencia_cambio inner join t_ambiente where t_incidencia_cambio.fk_idAmbiente = t_ambiente.idAmbiente";
	$result = $this->db->query($select);
	return $result->result();
	}

	public function buscarIncidencias($id){
	$select = "select idIncidencia_cambio,tituloIncidencia,Descripcion,actividadInvolucrada,planRespuesta,detallesAdicional,fk_idAmbiente,nombAmbiente,idAmbiente from t_incidencia_cambio inner join t_ambiente where t_incidencia_cambio.idIncidencia_cambio=".$id." and t_incidencia_cambio.fk_idAmbiente = t_ambiente.idAmbiente  ";
	$result = $this->db->query($select);
	return $result->row();
	}
}
?>