<?php 

class M_actividad extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	public function insertarActividad($data){
		$this->db->insert('t_actividad', $data); 
		return $this->db->insert_id();
	}
	public function getActividadAmbientes($idProyecto,$idAmbiente,$ambienteFantasma){
		$query = $this->db->query('select idActividad,nombActividad from t_actividad,t_proyecto,t_ambiente,t_ambiente_actividad where t_ambiente.fk_idProyecto=t_proyecto.idProyecto and t_ambiente_actividad.fk_idAmbiente=t_ambiente.idAmbiente and t_ambiente_actividad.fk_idActividad=t_actividad.idActividad and t_actividad.idActividad !=1 and t_ambiente.idAmbiente!='.$ambienteFantasma.' and t_proyecto.idProyecto= '.$idProyecto.' and t_ambiente.idAmbiente='.$idAmbiente);
	    echo $this->db->last_query();
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}


}

?>