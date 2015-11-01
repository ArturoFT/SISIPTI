<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_incidencias extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('table');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('mf_adincidencias/m_incidencias');
	}


		public function abrir_incidencias(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {
				//$this->load->view('nav1',$this->session->userdata);
				$this->load->view('vf_incidencias/v_incidencias');
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}			
	}

				  
			  public function registrar(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {

				//$this->form_validation->set_rules('titulo','Titulo','required');
				//$this->form_validation->set_rules('descripcion','Descripcion','required');
				//$this->form_validation->set_rules('fechaInicioI','Fecha de incidencia','required');
				//$this->form_validation->set_rules('planR','Plan de Respuesta','required');
				//$this->form_validation->set_rules('detallesA','Detalles Adicionales','required');
				//$this->form_validation->set_rules('actividadIn','Actividad Involucrada','required');

			    //$this->form_validation->set_error_delimiters('<span style="color:red;">','</span>') ;

			   // if ($this->form_validation->run() === FALSE){
				//	$this->load->view('nav1',$this->session->userdata);				
					//$this->load->view('vf_incidencias/v_incidencias');					
				 //  }else{
			    	$data = array(
		    			"tituloIncidencia"=>$_POST["titulo"],
		    			"Descripcion"=>$_POST["descripcion"],
		    			"fechaIniIncidenciaCambio"=>$_POST["fechaInicioI"],
		    			"planRespuesta"=>$_POST["planR"],
		    			"detallesAdicional"=>$_POST["detallesA"],
		    			"actividadInvolucrada"=>$_POST["actividadIn"],
		    			"fk_idAmbiente"=>$_POST["idAm"]
		    			
			    	);
			    	$this->m_incidencias->insertarIncidencias($data);
			   
			    	
			    	//$data3 = array(
		    		//	"nombActividad"=> "Act.Ini de ".$_POST["nombreP"],
		    		//	"descActividad"=>"Actividad de inicialización.",
		    		//	"prioridadActividad"=>0
		    		//);
			    	//$idAct = $this->m_actividad->insertarActividad($data3);

			    	$this->load->view('nav1',$this->session->userdata);
			    	//$datosExito = array("titulo"=>"¡Proyecto creado!","mensaje"=>"El proyecto  se creó correctamente.");
			    	//$this->load->view('success',$datosExito );
			    	$this->load->view('administrarAmbientes/administrarAmbientes');
			    //}
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}
	}




	 	function ver(){
 		$this->load->view('head');
 		$data['tabla']=$this->pintarTabla();
 		$this->load->view('nav1',$this->session->userdata);
 		$this->load->view('vf_incidencias/v_ver_incidencias',$data);

 	
 	}	
 
 	function pintarTabla(){
 		
 		$arrayTabla= $this->m_incidencias->getTabla();
 		$tmp = array ( 'table_open'   => '<table  class="table table-striped table-bordered" width="0%"  align="center" >');
		$this->table->set_template($tmp);
		$this->table->set_heading('I N C I D E N C I A S',"<a href='javascript:seleccionar_todo()'>Marcar todos</a>");
		foreach($arrayTabla as $fila){
			$this->table->add_row("<a  href='' data-toggle='modal' data-target='#Nuevo' onClick=\"javascript:$('#ID').val(".$fila->idIncidencia_cambio.")\">".$fila->tituloIncidencia.'</a>',
				"<input name='eliminar' id='eliminar' type='checkbox' />");

		}

		$tabla = $this->table->generate();//log_message('error','tabl: '.$tabla);
		return $tabla;
 	}

 	function detalle(){
 	$datos=$this->m_incidencias->buscarIncidencias($_POST['idIn']);
			   
 	$this->load->view('vf_incidencias/v_detalle',compact("datos"));

 	}	
}