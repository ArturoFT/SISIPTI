<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_adusuario extends CI_Model{
	function __construct(){
		parent:: __construct();
		$this->load->database();
	}

	function getTabla(){
	
	$select = "select idUsuario,nombUsuario,claveUsuario,estadoUsuario,fk_idRol,nombRol from t_usuario inner join t_rol  where t_usuario.fk_idRol = t_rol.idRol ORDER BY idUsuario desc ";
	$result = $this->db->query($select);
	return $result->result();
	}

	function registrarUsuario($dataP){
		$this->db->insert('t_usuario',$dataP);
	    return $this->db->insert_id();
		
	}

	function buscarNombre(){
	$select = "select idPersona,idProveedor,nombPersona from  t_proveedor inner join t_persona  where  t_persona.idPersona = t_proveedor.fk_idPersona ";
	$result = $this->db->query($select);
	return $result->result();
	}


}?>