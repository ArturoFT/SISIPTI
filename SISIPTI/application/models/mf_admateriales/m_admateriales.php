<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_admateriales extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	function getTabla(){
	
	$select = "select idMaterial,nombMaterial,idTipoMaterial,Cantidad,nombPersona,descTipoMaterial,descMaterial,unidadMaterial,idProveedor,precioMaterial,fk_idProveedor,fk_idTipoMaterial from t_material inner join t_proveedor inner join t_persona inner join t_tipo_material where t_proveedor.idProveedor = t_material.fk_idProveedor and t_persona.idPersona = t_proveedor.fk_idPersona and t_tipo_material.idTipoMaterial=t_material.fk_idTipoMaterial";
	$result = $this->db->query($select);
	return $result->result();
	}

	function registrar($data){
		$this->db->insert('t_material',array('nombreCurso'=>$data['nombre'],'videoCursos'=>$data['videos']));
		
	}

	function getMaterial($id){
	
	$select = "select idMaterial,nombMaterial,idTipoMaterial,Cantidad,descTipoMaterial,nombPersona,descMaterial,unidadMaterial,idProveedor,precioMaterial,fk_idProveedor,fk_idTipoMaterial from t_material inner join t_proveedor inner join t_persona inner join t_tipo_material where t_material.idMaterial=".$id." and t_proveedor.idProveedor = t_material.fk_idProveedor and t_persona.idPersona = t_proveedor.fk_idPersona and t_tipo_material.idTipoMaterial=t_material.fk_idTipoMaterial";
	$result = $this->db->query($select);
	return $result->row();
	}


	function actualizar($data,$id){
	

	$this->db->where('idMaterial',$id);
	$this->db->update('t_material',$data);
	}

	function actualizarT($data,$id){
	

	$this->db->where('idTipoMaterial',$id);
	$this->db->update('t_tipo_material',$data);
	}


	function registrarTipo($dataTi){
		$this->db->insert('t_tipo_material',$dataTi);
		return $this->db->insert_id();
}
	function registrarMaterial($dataM){
		$this->db->insert('t_material',$dataM);
		
}


	function eliminarMa($id){
	
	$this->db->where('idMaterial',$id);
	$this->db->delete('t_material');


	}

	function eliminar($idT){
	
	$this->db->where('idTipoMaterial',$idT);
	$this->db->delete('t_tipo_material');


	}

	function buscarNombre(){
	$select = "select idPersona,idProveedor,nombPersona from  t_proveedor inner join t_persona  where  t_persona.idPersona = t_proveedor.fk_idPersona ";
	$result = $this->db->query($select);
	return $result->result();
	}

	function buscarTipo(){
		
	$select = "select idTipoMaterial,descTipoMaterial from   t_tipo_material  ";
	$result = $this->db->query($select);
	return $result->result();
	}


	function buscarTipo2(){
		
	$select = "select idTipoMaterial,idMaterial,fk_idTipoMaterial,descTipoMaterial from  t_material inner join t_tipo_material  where  t_tipo_material.idTipoMaterial = t_material.fk_idTipoMaterial ";
	$result = $this->db->query($select);
	return $result->result();
	}


}
?>