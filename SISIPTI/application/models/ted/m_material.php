<?php 

class M_material extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function getMateriales(){
		$this->db->select('nombMaterial,unidadMaterial');
	    $this->db->from('t_material');
	    $query = $this->db->get();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
	public function getDetalleMaterial($idMaterial){
		$this->db->select('*');
	    $this->db->from('t_material');
	    $this->db->join('t_tipo_material', 't_tipo_material.idTipoMaterial= t_material.fk_idTipoMaterial');
	    $this->db->join('t_proveedor', 't_proveedor.idProveedor= t_material.fk_idProveedor');
	    $this->db->join('t_persona', 't_persona.idPersona= t_proveedor.fk_idPersona');
		$this->db->where('t_material.idMaterial', $idMaterial);
		
	    $query = $this->db->get();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
	
	public function getMaterialesEmpresa(){
		$query = $this->db->query('select * from t_material');
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function getCantidadPorMaterial($idMaterial){
		$query = $this->db->query('select Cantidad from t_material where idMaterial = '.$idMaterial);
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function getMaterialesEmpresaId(){
		$query = $this->db->query('select idMaterial from t_material');
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function retiraRecursoMatDeLaEmpresa($data){
		$this->db->where('idMaterial',$data['idMaterial']);
		$this->db->update('t_material',array('Cantidad' => $data['Cantidad']));
		echo $this->db->last_query();
	}

	public function getMaterialesSinAgregar($idProyecto){
		$query = $this->db->query('select * from t_material left join t_ambiente_actividad_material on t_material.idMaterial=t_ambiente_actividad_material.fk_idMaterial
								 where  t_ambiente_actividad_material.fk_idMaterial is null ');
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function getMaterialesExistentesEnProyecto($idProyecto,$ambienteActividadPozo){
		$query = $this->db->query('select idMaterial FROM t_proyecto inner join t_ambiente on t_proyecto.idProyecto= t_ambiente.fk_idProyecto
							inner join t_ambiente_actividad on t_ambiente.idAmbiente = t_ambiente_actividad.fk_idAmbiente
                            inner join t_ambiente_actividad_material on t_ambiente_actividad.idAmbiente_actividad = t_ambiente_actividad_material.fk_idAmbienteActividad
                            inner join t_material on t_material.idMaterial = t_ambiente_actividad_material.fk_idMaterial where  t_proyecto.idProyecto = '.$idProyecto.'
                            and t_ambiente_actividad.idAmbiente_actividad = '.$ambienteActividadPozo);
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
	
/**/

}

?>
