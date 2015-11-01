<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_consultarActividades extends CI_Controller {
	function __construct(){
		parent::__construct();
		 $this->load->helpers('form');
		$this->load->model('mf_proyectosxCliente/m_proyectosporusuario');
		$this->load->library('table');
		 // $this->load->view('headers/librerias');  

 		$this->load->model('mf_proyectosxCliente/m_ambienteporproyecto');
		$this->load->model('mf_proyectosxCliente/m_actividadesporambiente');
		$this->load->helper('url');
		$this->load->library('session');

	}	



 	function abrir_consultarActividades(){
 
 		$this->load->view("head");
		$this->load->view("nav2",$this->session->userdata);

		$idUsuario=$this->session->userdata["idUsuario"];
 		$arrayTabla= $this->m_proyectosporusuario->traer_proyectosxUsuario($idUsuario);
 		$tabla='';
 		$tabla.='<table class="table table-striped text-center table-bordered"> <thead><tr><th class="text-center">Proyecto</th><th class="text-center">Direccion</th><th class="text-center">Fecha Inicio Proyecto</th><th class="text-center">Presupuesto Inicial Proyecto</th><th class="text-center">Seleccionar</th></tr></thead><tbody>';
 		foreach ($arrayTabla as  $value) {
 
 			$tabla.='<tr><td>'.$value['nombProyecto'].'</td><td>'.$value['dirProyecto'].'</td><td>'.$value['fechaIniProyecto'].'</td><td>'.$value['presupuestoIniProyecto'].'</td><td><button onClick="verAmbientes(this)" idProyecto="'.$value['idProyecto'].'" class="btn btn-success ">Ambientes</button></td></tr>';
 		}
 		$tabla.='</tbody></table>';
	
		$datos["tabla"]=$tabla;
		$this->load->view('vf_proyectosxCliente/v_proyectosporcliente',$datos);
 	
 	}


 	function abrir_consultarAmbientes(){

 		$arrayTabla= $this->m_ambienteporproyecto->traer_ambientesxProyecto($_POST['idProyecto']);
		$tabla='';
 		$tabla.='<table class="table table-striped text-center table-bordered"> <thead><tr><th class="text-center">Ambiente</th><th class="text-center">Descripción</th><th class="text-center">Precio</th></tr></thead><tbody>';
 		
 		foreach ($arrayTabla as  $value) {
 
 			$tabla.='<tr><td>'.$value['nombAmbiente'].'</td><td>'.$value['descAmbiente'].'</td><td>'.$value['precioAmbiente'].'</td><td><button onClick="verActividades(this)" idAmbiente="'.$value['idAmbiente'].'" class="btn btn-success ">Actividades</button></td></tr>';
 		}

 		$tabla.='</tbody></table>';
	
		$datos["tabla"]=$tabla;
		$datos["idProyecto"]=$_POST['idProyecto'];
		$this->load->view('head');
			$this->load->view('vf_proyectosxCliente/v_ambienteporproyecto',$datos);
 	

 	}

 	function abrir_consultaActividadesCliente(){



 		$arrayTabla= $this->m_actividadesporambiente->traer_actividadesxAmbiente($_POST['idAmbiente']);
 		
		$tabla='';
		$tabla.='<table class="table table-striped text-center table-bordered"> <thead><tr><th class="text-center">Actividad</th><th class="text-center">Prioridad</th><th class="text-center">Fecha Realización</th><th class="text-center">Fecha Inicio</th><th class="text-center">Fecha Fin</th></tr></thead><tbody>';
 		
 		foreach ($arrayTabla as  $value) {
 
 			$tabla.='<tr><td>'.$value['nombActividad'].'</td><td>'.$value['prioridadActividad'].'</td><td>'.$value['fechaRealizacionActividad'].'</td><td>'.$value['fechaIniActividad'].'</td><td>'.$value['fechaFinActividad'].'</td></tr>';
 		}

 		$tabla.='</tbody></table>';
	
		$datos["tabla"]=$tabla;
		$datos["idProyecto"]=$_POST['idProyecto'];
		$this->load->view('head');

			$this->load->view('vf_proyectosxCliente/v_actividadesporambiente',$datos);
 	
 	}

}
?>
