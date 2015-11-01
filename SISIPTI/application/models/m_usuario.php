<?php 

class M_usuario extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function usuarioExiste($nombre){
		$this->db->select('idUsuario');
	    $this->db->from('t_usuario');
	    $this->db->where('nombUsuario',$nombre);
	    $query = $this->db->get();
	    
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->row_array();
	    }
	}

	public function claveCorrecta($usuario, $clave){
		$this->db->select('idUsuario');
	    $this->db->from('t_usuario');
	    $this->db->where('nombUsuario',$usuario);
	    $this->db->where('claveUsuario',$clave);
	    $query = $this->db->get();
	    
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->row_array();
	    }
	}

	function getUsuario($usuario){
		$this->db->select('*');
	    $this->db->from('t_usuario');
	    $this->db->where('nombUsuario',$usuario);
	    $query = $this->db->get();
	    
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
	function getUsuariosPersonas(){
		$query = $this->db->query('select * from t_usuario,t_persona where t_usuario.idUsuario=t_persona.fk_idUsuario');
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
}

?>