<?php 

class M_proyecto_trabajador extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function getTrabajadorProyecto($idProyecto){
		$query = $this->db->query('select * from t_cargo,t_persona,t_proyecto,t_ambiente,t_actividad,t_ambiente_actividad,t_ambiente_actividad_trabajador,t_trabajador where t_trabajador.idTrabajador=t_ambiente_actividad_trabajador.fk_idTrabajador
				and t_cargo.idCargo=t_trabajador.fk_IdCargo and t_persona.idPersona=t_trabajador.fk_idPersona and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad and t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente
				and t_ambiente_actividad_trabajador.fk_idAmbiente_actividad=t_ambiente_actividad.idAmbiente_Actividad
				and t_proyecto.idProyecto=t_ambiente.fk_idProyecto and t_proyecto.idProyecto ='.$idProyecto.' and t_ambiente.idAmbiente = 2 and t_actividad.idActividad = 1');
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

}
?>