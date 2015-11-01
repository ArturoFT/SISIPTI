<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_asignarRecurso extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('m_material');
		$this->load->model('m_material_proyecto');
	}

	public function abrirasignarRecursosHumanos(){
		$this->cargarVista("asignarRecursos/asignarRecursos",0,"login",0,"nav1",0);
	}

	public function cargarVista($view,$array,$viewEsrror,$arrayError,$nav,$bit){
    	$this->load->view("head");
		if (isset($this->session->userdata['nombUsuario'])) {
			$datos_sesion = $this->datosSesion();			
			$this->load->view($nav,$datos_sesion);
			if ($array==0) {
				$this->load->view($view);	
			}else{
				$this->load->view($view,$array);	
			}						
		}else{
			if($bit){
				$this->load->view($nav,$datos_sesion);
			}
			if ($arrayError==0) {
				$this->load->view($viewError);	
			}else{
				$this->load->view($viewError,$arrayError);	
			}		
		}
		return;
	}
	 public function cerrarSesion(){
		$this->session->sess_destroy();
		$this->load->view('head');
		$this->load->view('login');
	}

	public function datosSesion(){
		return $this->session->userdata;
	}

	public function listarRecursosMateriales(){
		$lista = $this->m_material->getMateriales();
		
		foreach ($lista as $value) {
		 	echo "<tr><th>";
			echo $value['nombMaterial'];
			echo "</th><th>";
			echo $value['unidadMaterial'];
			echo "</th></tr>";	
		}
	}

	public function listarMaterialesProyecto(){
		$lista =$this->m_material_proyecto->getMaterialesProyecto();
		foreach ($lista as $value) {
			echo "<tr><th>";
			echo $value['nombMaterial'];
			echo "</th><th>";
			echo $value['unidadMaterial'];
			echo "</th><th>";
			echo $value['cantDisponible'];
			echo "</th><th><div class=\"checkbox\"><label><input type=\"checkbox\"></label> </div> ";
			echo "</th><th><input class=\"form-control\" id=\"cantidadAsignada\" type=\"text\" value=\"\"></th><th>";
			echo "</th><th><select class=\"form-control\">
				  <option>1</option>
				  <option>2</option>
				  <option>3</option>
				  <option>4</option>
				  <option>5</option>
				</select></th></tr>";

				//PENDIENTE RECOLECTAR Y POBLAR SELECT
		}
	}

	public function cargarTrabajadoresDelProyecto(){
		$lista = $this->m_material_proyecto -> getMaterialesProyecto();
	}	

	public function sesionActiva($view,$array,$nav){
		
		if (isset($this->session->userdata['nombUsuario'])) {
			$datos_sesion = $this->datosSesion();
			$this->load->view("head");
			$this->load->view($nav,$datos_sesion);
			if ($array==0) {
				$this->load->view($view);	
			}else{
				$this->load->view($view,$array);	
			}			
			return true;
		}else{
			return false;

		}
	}

}