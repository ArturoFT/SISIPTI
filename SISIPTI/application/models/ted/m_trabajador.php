<?php 

class M_trabajador extends CI_Model{
	public function __construct(){
		$this->load->database();
	}

	public function getTrabajadorEmpresa(){
		$query = $this->db->query('select * from t_trabajador left join t_ambiente_actividad_trabajador on t_trabajador.idTrabajador=t_ambiente_actividad_trabajador.fk_idTrabajador inner join t_persona on t_persona.idPersona=t_trabajador.fk_idPersona
							inner join t_cargo on t_cargo.idCargo=t_trabajador.fk_IdCargo where  t_ambiente_actividad_trabajador.fk_idTrabajador is null ');
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}
	
	public function getTrabajadorDetalles($idTrabajador){
		$query = $this->db->query("select * from t_trabajador inner join t_persona on t_persona.idPersona=t_trabajador.fk_idPersona
							inner join t_cargo on t_cargo.idCargo=t_trabajador.fk_IdCargo where t_trabajador.idTrabajador= '".$idTrabajador."'");
	    if(empty($query)){
	    	return false;
	    }else{
	    	return $query->result_array();
	    }
	}

}
?>