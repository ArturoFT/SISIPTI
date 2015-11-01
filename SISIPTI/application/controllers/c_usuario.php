<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_usuario extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('m_usuario');
		$this->load->model('mf_proyectosxCliente/m_proyectosporusuario');
	}

	public function index(){
		$activo = $this->sesionActiva("administrarProyectos/seleccionarProyecto",0,"nav1");
		if ($activo) {return;}
		$this->load->view('index');
	}

	public function login(){

		$activo = $this->sesionActiva("administrarProyectos/seleccionarProyecto",0,"nav1");
		if ($activo) {return;}

		if(isset($_POST["usuario"])){
			$p_u = $_POST["usuario"];
		}else{
			$p_u = "0";
		}

		$this->form_validation->set_rules('usuario','Usuario','required|callback_esxisteUsuario');
		$this->form_validation->set_rules('clave','Clave','required|callback_claveCorrecta['.$p_u.']');
	    $this->form_validation->set_error_delimiters('<div class="error">','</div>') ;

	    if ($this->form_validation->run() === FALSE){
		   	$activo = $this->sesionActiva("administrarProyectos/seleccionarProyecto",0,"nav1");
			if ($activo) {return;}

			$this->load->view('head');
			$this->load->view("login");
			
	    }else{
	    	$this->subirDatosSesion($_POST["usuario"]);
	    	
	    	if($this->session->userdata["fk_idRol"]==4){
	    		$this->cargarVista("administrarProyectos/seleccionarProyecto",0,"login",0,"nav1",0);
	    	}else if($this->session->userdata["fk_idRol"]==1){

	    		$this->load->view("head");
	    		$this->load->view("nav2",$this->datosSesion());

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

	    	}else if($this->session->userdata["fk_idRol"]==2){
	    		$this->load->view("head");
	    		$this->load->view("nav3",$this->datosSesion());
	    		$idUsuario=$this->session->userdata["idUsuario"];
		 		$arrayTabla= $this->m_proyectosporusuario->traer_proyectosxUsuario2($idUsuario);
		 		$tabla='';
		 		$tabla.='<table class="table table-striped text-center table-bordered"> <thead><tr><th class="text-center">Proyecto</th><th class="text-center">Direccion</th><th class="text-center">Fecha Inicio Proyecto</th><th class="text-center">Presupuesto Inicial Proyecto</th><th class="text-center">Seleccionar</th></tr></thead><tbody>';
		 		foreach ($arrayTabla as  $value) {
		 
		 			$tabla.='<tr><td>'.$value['nombProyecto'].'</td><td>'.$value['dirProyecto'].'</td><td>'.$value['fechaIniProyecto'].'</td><td>'.$value['presupuestoIniProyecto'].'</td><td><button onClick="verAmbientes(this)" idProyecto="'.$value['idProyecto'].'" class="btn btn-success ">Ambientes</button></td></tr>';
		 		}
		 		$tabla.='</tbody></table>';
			
				$datos["tabla"]=$tabla;
				$this->load->view('head');
				$this->load->view('vf_proyectosxIngeniero/v_proyectosporIngeniero',$datos);
	    	}else if($this->session->userdata["fk_idRol"]==3){
	    		$this->load->view("head");
	    		$this->load->view("nav4",$this->datosSesion());
	    		echo "hola";
	    	}

	    	
	    	//print_r($this->session->userdata);
	    }
	}	

	public function subirDatosSesion($usuario){		
		$datos_sesion = $this->m_usuario->getUsuario($usuario);
		$this->session->set_userdata($datos_sesion[0]);
		$this->session->set_userdata('idPS', -1);
		$this->session->set_userdata('nombPS', "");
	}

	public function esxisteUsuario($str){		
		$usuario = $this->m_usuario->usuarioExiste($str);
		if ($usuario){
           return TRUE;
        }else{
            $this->form_validation->set_message('esxisteUsuario', 'El campo %s no esta registrado.');
            return FALSE;
        }
	}

	public function claveCorrecta($str,$usuario){
		if ($usuario == "0") {
			$this->form_validation->set_message('claveCorrecta', '0');
            return FALSE;
		}else{
			$login = $this->m_usuario->claveCorrecta($usuario,$str);
			if ($login){       
	            return TRUE;
	        }else{
	        	$this->form_validation->set_message('claveCorrecta', '%s incorrecta.');
	            return FALSE;
	        }
	    }
	}

	

    //CLASES GENERALES
    public function cargarVista($view,$array,$viewError,$arrayError,$nav,$bit){
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

	public function sesionActiva($view,$array,$nav){
		
		if (isset($this->session->userdata['nombUsuario'])) {
			$datos_sesion = $this->datosSesion();
			$this->load->view("head");			
			if ($array==0) {
				if($this->session->userdata['fk_idRol']==4){
					$this->load->view($nav,$datos_sesion);
					$this->load->view($view);	
				}else if($this->session->userdata['fk_idRol']==1){
		    		$this->load->view("nav2",$datos_sesion);

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
				}else if($this->session->userdata['fk_idRol']==2){
					$this->load->view("head");
		    		$this->load->view("nav3",$this->datosSesion());
			 		$arrayTabla= $this->m_proyectosporusuario->traer_proyectosxUsuario2($this->session->userdata["idUsuario"]);
			 		$tabla='';
			 		$tabla.='<table class="table table-striped text-center table-bordered"> <thead><tr><th class="text-center">Proyecto</th><th class="text-center">Direccion</th><th class="text-center">Fecha Inicio Proyecto</th><th class="text-center">Presupuesto Inicial Proyecto</th><th class="text-center">Seleccionar</th></tr></thead><tbody>';
			 		foreach ($arrayTabla as  $value) {
			 
			 			$tabla.='<tr><td>'.$value['nombProyecto'].'</td><td>'.$value['dirProyecto'].'</td><td>'.$value['fechaIniProyecto'].'</td><td>'.$value['presupuestoIniProyecto'].'</td><td><button onClick="verAmbientes(this)" idProyecto="'.$value['idProyecto'].'" class="btn btn-success ">Ambientes</button></td></tr>';
			 		}
			 		$tabla.='</tbody></table>';
				
					$datos["tabla"]=$tabla;
					$this->load->view('head');
					$this->load->view('vf_proyectosxIngeniero/v_proyectosporIngeniero',$datos);
				}else if($this->session->userdata["fk_idRol"]==3){
		    		$this->load->view("head");
		    		$this->load->view("nav4",$this->datosSesion());
		    		echo "hola";
		    	}
			}else{
				if($this->session->userdata['fk_idRol']==4){
					$this->load->view($nav,$datos_sesion);
					$this->load->view($view,$array);	
				}else if($this->session->userdata['fk_idRol']==1){
					$this->load->view("nav2",$datos_sesion);
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
				}else if($this->session->userdata['fk_idRol']==2){
					$this->load->view("head");
		    		$this->load->view("nav3",$this->datosSesion());
			 		$arrayTabla= $this->m_proyectosporusuario->traer_proyectosxUsuario2($this->datosSesion());
			 		$tabla='';
			 		$tabla.='<table class="table table-striped text-center table-bordered"> <thead><tr><th class="text-center">Proyecto</th><th class="text-center">Direccion</th><th class="text-center">Fecha Inicio Proyecto</th><th class="text-center">Presupuesto Inicial Proyecto</th><th class="text-center">Seleccionar</th></tr></thead><tbody>';
			 		foreach ($arrayTabla as  $value) {
			 
			 			$tabla.='<tr><td>'.$value['nombProyecto'].'</td><td>'.$value['dirProyecto'].'</td><td>'.$value['fechaIniProyecto'].'</td><td>'.$value['presupuestoIniProyecto'].'</td><td><button onClick="verAmbientes(this)" idProyecto="'.$value['idProyecto'].'" class="btn btn-success ">Ambientes</button></td></tr>';
			 		}
			 		$tabla.='</tbody></table>';
				
					$datos["tabla"]=$tabla;
					$this->load->view('head');
					$this->load->view('vf_proyectosxIngeniero/v_proyectosporIngeniero',$datos);
				}else if($this->session->userdata["fk_idRol"]==3){
		    		$this->load->view("head");
		    		$this->load->view("nav4",$this->datosSesion());
		    		echo "hola";
		    	}
			}			
			return true;
		}else{
			return false;

		}
	}
	
	public function abrir_login(){
		$this->load->view("head");
		$this->load->view("login");
	}
}
