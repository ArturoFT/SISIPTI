<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_administrarActividades extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('m_actividad');
		$this->load->model('m_ambiente_actividad');
	}

	public function modificar_actividad(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {
				if (!isset($_POST["idAct"])) {
					$this->load->view('nav1',$this->session->userdata);
					$this->load->view('administrarAmbientes/administrarAmbientes');
					return;
				}
				$this->form_validation->set_rules('nombreA','Nombre de Ambiente','required');
				$this->form_validation->set_rules('descA','Descripción','required');
				$this->form_validation->set_rules('prioridad','Prioridad','required');	
				$this->form_validation->set_rules('fechaInicioA','Fecha de Inicio','required');
				$this->form_validation->set_rules('fechaReaA','Fecha de Realización','required');
				$this->form_validation->set_rules('fechaFinA','Fecha de Finalización','required');
			    $this->form_validation->set_error_delimiters('<span style="color:red;">','</span>') ;

				if ($this->form_validation->run() === FALSE){
					$datosAct = $this->m_actividad->traerActividad($_POST["idAct"]);
					$this->load->view('nav1',$this->session->userdata);
					$this->load->view('administrarActividades/modificarActividad',$datosAct);	
			    }else{
			    	$data_t_actividad = array(
			    		"nombActividad" => $_POST["nombreA"],
			    		"descActividad" => $_POST["descA"],
			    		"prioridadActividad" => $_POST["prioridad"],
			    		"fechaIniActividad" => $_POST["fechaInicioA"],
			    		"fechaRealizacionActividad" => $_POST["fechaReaA"],
			    		"fechaFinActividad" => $_POST["fechaFinA"]
			    	);

			    	$this->m_actividad->actualizar($data_t_actividad,$_POST["idAct"]);
			    	
			    	$this->load->view('nav1',$this->session->userdata);
			    	$datosExito = array("titulo"=>"¡Actividad modificada!","mensaje"=>"La Actividad se modificó correctamente.");
			    	$this->load->view('success',$datosExito );

			    }
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}
	}

	public function abrir_modificarActividad(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {	
			if ($this->session->userdata['idPS']!=-1) {
				if ($this->session->userdata['fk_idRol']==4) {
					if (!isset($_POST["idAct"])) {
						$this->load->view('nav1',$this->session->userdata);
						$this->load->view('administrarAmbientes/administrarAmbientes');
						return;
					}

					$datosAct = $this->m_actividad->traerActividad($_POST["idAct"]);

					$datosTrabajadores=$this->m_actividad->traerTrabajadoresxAct($_POST["idAct"]);

					$tabla="";
					foreach ($datosTrabajadores as $value) {
						$tabla.='<tr class="text-center"><td>'.$value["nombPersona"].' '.$value["apellidoPat"].'</td><td>'.$value["nombCargo"].'</td></tr>';
					}

					$datosAct["tabla"] = $tabla;

					$this->load->view('nav1',$this->session->userdata);
					$this->load->view('administrarActividades/modificarActividad',$datosAct);


				}else{
					$this->load->view('accesoDenegado');
				}
			}else{
				$datos = array("titulo"=>"¡Error!","mensaje"=>"Debe seleccionar un proyecto.");
		    	$this->load->view('success',$datos );
			}
		}else{
			$this->load->view('login');
		}	
	}

	public function abrir_administrarActividades(){
		$this->load->view('head');
		if (!isset($_POST["idAmb"])) {
			$this->load->view('nav1',$this->session->userdata);
			$this->load->view('administrarAmbientes/administrarAmbientes');
			return;
		}		
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {
				$actz = $this->m_actividad->traer_actividadesxAmb2($_POST["idAmb"]);
				$tabla = "";
				foreach ($actz as $value) {
					$tabla.="<tr class='text-center'><td>".$value["nombActividad"]."</td><td>".$value["prioridadActividad"]."</td><td>".$value["fechaIniActividad"]."</td><td>".$value["fechaRealizacionActividad"]."</td><td>".$value["fechaFinActividad"]."</td><td><button onClick='verAct(".$value["idActividad"].")' class='btn btn-success'>Ver</button></td></tr>";
				}
				$this->session->set_userdata('idAmb', $_POST["idAmb"]);
				$this->load->view('nav1',$this->session->userdata);
				$this->load->view('administrarActividades/administrarActividades',array('tabla' => $tabla));


			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}	
	}

	public function abrir_agregarActividad(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {	
			if ($this->session->userdata['idPS']!=-1) {
				if ($this->session->userdata['fk_idRol']==4) {
					$this->load->view('nav1',$this->session->userdata);
					$this->load->view('administrarActividades/agregarActividad');
				}else{
					$this->load->view('accesoDenegado');
				}
			}else{
				$datos = array("titulo"=>"¡Error!","mensaje"=>"Debe seleccionar un proyecto.");
		    	$this->load->view('success',$datos );
			}
		}else{
			$this->load->view('login');
		}	
	}

	public function crear_actividad(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {
				$this->form_validation->set_rules('nombreA','Nombre de Ambiente','required');
				$this->form_validation->set_rules('prioridad','Prioridad','required');				
				$this->form_validation->set_rules('descA','Descripción','required');
				$this->form_validation->set_rules('fechaInicioA','Fecha de Inicio','required');
				$this->form_validation->set_rules('fechaReaA','Fecha de Realización','required');
				$this->form_validation->set_rules('fechaFinA','Fecha de Finalización','required');
			    $this->form_validation->set_error_delimiters('<span style="color:red;">','</span>') ;

				if ($this->form_validation->run() === FALSE){
					$this->load->view('nav1',$this->session->userdata);				
					$this->load->view('administrarActividades/agregarActividad');					
			    }else{
			    	$data_t_actividad = array(
			    		"nombActividad" => $_POST["nombreA"],
			    		"descActividad" => $_POST["descA"],
			    		"prioridadActividad" => $_POST["prioridad"],
			    		"fechaIniActividad" => $_POST["fechaInicioA"],
			    		"fechaRealizacionActividad" => $_POST["fechaReaA"],
			    		"fechaFinActividad" => $_POST["fechaFinA"]
			    	);

			    	$nId = $this->m_actividad->insertar($data_t_actividad);
			    	$datosAmbAct = array("agregado" => 1,"fk_idAmbiente" => $this->session->userdata['idAmb'],"fk_idActividad" => $nId);
			    	$this->m_ambiente_actividad->insertarAmbienteActividad($datosAmbAct);

			    	$this->load->view('nav1',$this->session->userdata);
			    	$datosExito = array("titulo"=>"¡Actividad creada!","mensaje"=>"La Actividad se creó correctamente.");
			    	$this->load->view('success',$datosExito );

			    }
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}
	}

}