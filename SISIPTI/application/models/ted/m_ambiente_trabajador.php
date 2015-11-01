<?php 

class M_ambiente_trabajador extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function getAmbienteTrabajador($idProyecto,$ambienteFantasma){
			$query = $this->db->query('select * from t_cargo,t_persona,t_proyecto,t_ambiente,t_actividad,t_ambiente_actividad,t_ambiente_actividad_trabajador,t_trabajador where t_trabajador.idTrabajador=t_ambiente_actividad_trabajador.fk_idTrabajador
				and t_cargo.idCargo=t_trabajador.fk_IdCargo and t_persona.idPersona=t_trabajador.fk_idPersona and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad and t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente
				and t_ambiente_actividad_trabajador.fk_idAmbiente_actividad=t_ambiente_actividad.idAmbiente_Actividad
				and t_proyecto.idProyecto=t_ambiente.fk_idProyecto and t_proyecto.idProyecto ='.$idProyecto.' and t_ambiente.idAmbiente != '.$ambienteFantasma.' and t_actividad.idActividad != 1');
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

	public function retornaIdAmbienteActividad($data){
		$query = $this->db->query('select idAmbiente_Actividad from t_ambiente_actividad where fk_idAmbiente='.$data['idAmbiente'].' and fk_idActividad = '.$data['idActividad'] );
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }	
	}
	// AMBIENTE FANTASMA ACTUAL
	public function retornaAmbienteFantasmaActual($data){
		$query = $this->db->query('select fk_idAmbiente_Actividad from t_ambiente_actividad_trabajador where fk_idTrabajador='.$data['idTrabajador'] );
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }	
	}

	public function asignaTrabajador($dataUp){
		$this->db->where('fk_idAmbiente_actividad', $dataUp['AmbienteFantasmaActual']);
		$this->db->where('fk_idTrabajador', $dataUp['idTrabajador']);
		$this->db->update('t_ambiente_actividad_trabajador',array('fk_idAmbiente_actividad'=> $dataUp['idAmbiente_Actividad'] ));
	}

	public function separaTrabajadorDelProyecto($dataUp,$fantasma){
		$this->db->where('fk_idAmbiente_actividad', $dataUp['AmbienteFantasmaActual']);
		$this->db->where('fk_idTrabajador', $dataUp['idTrabajador']);
		$this->db->update('t_ambiente_actividad_trabajador',array('fk_idAmbiente_actividad'=> $dataUp['idAmbiente_Actividad'] ));
	}

	public function getPozoProyecto($data,$ambienteFantasma){
		$query = $this->db->query("select idAmbiente_actividad from	t_proyecto,t_ambiente,t_actividad,t_ambiente_actividad where t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente 
									and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad
									and t_proyecto.idProyecto= t_ambiente.fk_idProyecto 	
									and t_ambiente_actividad.fk_idActividad = 1 and t_proyecto.idProyecto= ".$data." and t_ambiente.idAmbiente = ".$ambienteFantasma);
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }	
	}
//
	public function eliminaTrabajadorDeLaEmpresa($data){
		$this->db->query("delete from t_ambiente_actividad_trabajador WHERE t_ambiente_actividad_trabajador.fk_idTrabajador = ".$data);
	}

	public function agregaTrabajadorAlPozoDelProyecto($data){
		$this->db->query("insert into t_ambiente_actividad_trabajador (`fk_idTrabajador`, `fk_idAmbiente_actividad`) VALUES ('".$data['idTrabajador']."', '".$data['idAmbiente_actividad']."')");
	}
	
}

?>