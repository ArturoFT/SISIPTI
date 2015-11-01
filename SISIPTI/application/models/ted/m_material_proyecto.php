<?php 

class M_material_proyecto extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function getMaterialesProyecto($idProyecto,$idAmbiente_actividad){
			//select * from t_material,t_material_proyecto where t_material.idMaterial=t_material_proyecto.fk_idMaterial
		/*ANTIUGO SELECT SIN CAMBIO DE BD    select * from t_proyecto,t_ambiente,t_actividad,t_ambiente_actividad,t_actividad_material,t_material where t_material.idMaterial=t_actividad_material.fk_idMaterial
			and t_actividad.idActividad=t_actividad_material.fk_idActividad and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad and t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente
			and t_proyecto.idProyecto ='.$idProyecto.' and t_ambiente.idAmbiente = 2 and t_actividad.idActividad =ANTIUGO SELECT SIN CAMBIO DE BD     1
		*///CAMBIADO
		$query = $this->db->query('select * from t_proyecto,t_ambiente,t_actividad,t_ambiente_actividad,t_ambiente_actividad_material,t_material where t_material.idMaterial=t_ambiente_actividad_material.fk_idMaterial
			and t_ambiente_actividad.idAmbiente_actividad=t_ambiente_actividad_material.fk_idAmbienteActividad and t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad
			and t_proyecto.idProyecto= t_ambiente.fk_idProyecto and t_proyecto.idProyecto ='.$idProyecto.' and t_ambiente_actividad.idAmbiente_actividad='.$idAmbiente_actividad);
	    
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function recuperaProyectoPozo($idProyecto,$ambienteFantasma){
		$query = $this->db->query('select idAmbiente_actividad from	t_proyecto,t_ambiente,t_actividad,t_ambiente_actividad where t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente 
									and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad
									and t_proyecto.idProyecto= t_ambiente.fk_idProyecto 	
									and t_ambiente_actividad.fk_idActividad = 1 and 
									t_ambiente_actividad.fk_idAmbiente = '.$ambienteFantasma.'
									and t_proyecto.idProyecto= '.$idProyecto );
		if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	

}

?>


