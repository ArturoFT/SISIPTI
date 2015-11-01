<?php 

class M_material_ambiente extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function getMaterialesAmbiente($idProyecto){
		// AMBIENTE FANTASMA E ACTIVIDAD FANTASMA
		//NECESARIO TENER AGREGADO POZO EN LA TABLA AMBIENTE_ACTIVIDAD_MATERIAL 1 actividad pozo por AMBIENTE
		$query = $this->db->query('select * from t_proyecto,t_ambiente,t_actividad,t_ambiente_actividad,t_ambiente_actividad_material,t_material where t_material.idMaterial=t_ambiente_actividad_material.fk_idMaterial
			and t_ambiente_actividad.idAmbiente_actividad=t_ambiente_actividad_material.fk_idAmbienteActividad and t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad
			and t_proyecto.idProyecto= t_ambiente.fk_idProyecto and t_proyecto.idProyecto ='.$idProyecto.' and t_ambiente.idAmbiente != 2 and t_actividad.idActividad = 1');
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function recuperaPozo($data){
		$query = $this->db->query('select idAmbiente_actividad from	t_proyecto,t_ambiente,t_actividad,t_ambiente_actividad where t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente 
									and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad
									and t_proyecto.idProyecto= t_ambiente.fk_idProyecto 	
									and t_ambiente_actividad.fk_idActividad = 1 and 
									t_ambiente_actividad.fk_idAmbiente = '. $data['idAmbiente'].'
									and t_proyecto.idProyecto= 1' );
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function cantMatAsignadaAmbiente($data){
		$query = $this->db->query('select cantDispActividad_material from  t_ambiente_actividad_material,t_material,t_proyecto,t_ambiente,t_actividad,t_ambiente_actividad 
									where  t_ambiente_actividad.idAmbiente_actividad =  t_ambiente_actividad_material.fk_idAmbienteActividad
									and t_material.idMaterial = t_ambiente_actividad_material.fk_idMaterial
									and t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente 
									and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad
									and t_proyecto.idProyecto= t_ambiente.fk_idProyecto 	
									and t_ambiente_actividad_material.fk_idMaterial = '. $data['idMaterial'].'
									and t_ambiente_actividad_material.fk_idAmbienteActividad = '. $data['fk_idAmbiente_Actividad'].'
									and t_proyecto.idProyecto= 1' );
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
	public function cantMatDispProy($data){
		$query = $this->db->query('select cantDispActividad_material from  t_ambiente_actividad_material,t_material,t_proyecto,t_ambiente,t_actividad,t_ambiente_actividad 
									where  t_ambiente_actividad.idAmbiente_actividad =  t_ambiente_actividad_material.fk_idAmbienteActividad
									and t_material.idMaterial = t_ambiente_actividad_material.fk_idMaterial
									and t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente 
									and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad
									and t_proyecto.idProyecto= t_ambiente.fk_idProyecto 	
									and t_ambiente_actividad_material.fk_idMaterial = '. $data['idMaterial'].'
									and t_ambiente_actividad_material.fk_idAmbienteActividad = 1
									and t_proyecto.idProyecto= 1' );
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function retiraRecursoParaAsignacion($data){
		$this->db->where('fk_idMaterial',$data['idMaterial']);
		$this->db->where('fk_idAmbienteActividad',$data['fk_idAmbienteActividad']);
		$this->db->update('t_ambiente_actividad_material',array('cantDispActividad_material' => $data['cantDispActividad_material']));

	}

	public function asiganaMaterialAmbiente($data){
		$this->db->where('fk_idMaterial',$data['idMaterial']);
		$this->db->where('fk_idAmbienteActividad',$data['fk_idAmbienteActividad']);
		$this->db->update('t_ambiente_actividad_material',array('cantDispActividad_material' => $data['cantDispActividad_material']));
	
	}
}

?>