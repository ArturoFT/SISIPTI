<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_admtrabajador extends CI_Controller {
	function __construct(){
		parent::__construct();
		 $this->load->helpers('form');
		  $this->load->model('mf_admtrab/m_adtrabajador');
		  $this->load->library('table');
		  $this->load->view('headers/librerias');
		  $this->load->helper('url');
		  $this->load->library('session');

	}	
 	function index(){
 		
 		$data['tabla']=$this->pintarTabla();
 		$this->load->view('nav1',$this->session->userdata);
 		$this->load->view('vf_adtrabajador/v_adtrabajador',$data);

 	
 	}	
 
 	function pintarTabla(){
 		
 		$arrayTabla= $this->m_adtrabajador->getTabla();
 		$tmpl = array ( 'table_open'   => '<table  class="table table-striped table-bordered" width="20%"  align="center" >' );
		$this->table->set_template($tmpl);
		$this->table->set_heading('Id', 'Nombres','Cargo','Nacionalidad','Sueldo','Estado');
		foreach($arrayTabla as $fila){
			$this->table->add_row($fila->idTrabajador,$fila->nombPersona,$fila->nombCargo,$fila->nacionalidadTrabajador,$fila->sueldoTrabajador,'Disponible',
				"<a href='http://localhost/SISIPTI/index.php/cf_adtrabajador/c_admtrabajador/editar/$fila->fk_idPersona/$fila->fk_idCargo'><button class='btn btn-success' >Detalles</button>");

		}

		$tabla = $this->table->generate();//log_message('error','tabl: '.$tabla);
		return $tabla;
 	}

 	function ingresar(){

 		$arraypersona=$this->m_adtrabajador->buscarNombre();
		
        
        	//$data['option']= '<option value="'.$fila->idPersona.'">';
			//$data['fila']=  $fila->idPersona;
			$data['c_option']=  '</option>';
		
 		$this->load->view('vf_adtrabajador/v_insertar',$data);

 	}

 	function insertar(){



		$dataP = array(
				'nombPersona' => $this->input->post('nombre'),	
 				'telefPersona' => $this->input->post('telefono'),
 				'dirPersona' => $this->input->post('direccion'),
 				'emailPersona' => $this->input->post('email'),
 				'nroDocPersona' => $this->input->post('numerodoc'),
 				'tipoDocPersona' => $this->input->post('doc')
 			
 			);
 		
 		$idP=$this->m_adtrabajador->registrarPersona($dataP);



 		$dataT = array(
 				'sueldoTrabajador' => $this->input->post('sueldo'),
 				'sexoTrabajador' => $this->input->post('sexo'),
 				'nacionalidadTrabajador' => $this->input->post('nacionalidad'),
 				'profesion' => $this->input->post('profesion'),
 				'fk_idCargo' => $this->input->post('cargo'),
 				'fk_idPersona' => $idP
 				//'fk_idCargo' => $idC
 				);

 		$this->m_adtrabajador->registrarTrabajador($dataT);

 			

 		redirect("http://localhost/SISIPTI/index.php/cf_adtrabajador/c_admtrabajador/index"); 
 		
 	}

 	function editar($id=null,$idc){
 			

 		if(!$idc){
 			show_404();
 		}
 		else{

 			$datos=$this->m_adtrabajador->getTrabajador($id);
 			$this->load->view('vf_adtrabajador/v_editar',compact("id","idc","datos"));
 		}
 	
 	}
 	function Actualizar($id){

 		if(isset($_POST['nombre'])){
 			$data = array(
 				'sueldoTrabajador' => $this->input->post('sueldo'),
 				'sexoTrabajador' => $this->input->post('sexo'),
 				'nacionalidadTrabajador' => $this->input->post('nacionalidad'),
 				'fk_idCargo' => $this->input->post('cargo')
 			);

 			$this->m_adtrabajador->ActualizarT($data,$id);

 			
 		
 		

 			$dataP = array(
				'nombPersona' => $this->input->post('nombre'),	
 				'telefPersona' => $this->input->post('telefono'),
 				'dirPersona' => $this->input->post('direccion'),
 				'emailPersona' => $this->input->post('email'),
 				'nroDocPersona' => $this->input->post('numerodoc'),
 				'tipoDocPersona' => $this->input->post('doc')
 			);	

 			$this->m_adtrabajador->ActualizarP($dataP,$id);
 			redirect("http://localhost/SISIPTI/index.php/cf_adtrabajador/c_admtrabajador/index");
 			}
 		}

 	function Eliminar($id,$idc){
	if(!$id){
 			show_404();
 		} 	

 			$this->m_adtrabajador->eliminarT($id);
 			$this->m_adtrabajador->eliminarP($id);
 			$this->m_adtrabajador->eliminarC($idc);
 			redirect("http://localhost/SISIPTI/index.php/cf_adtrabajador/c_admtrabajador/index");
 			}

 	function BuscarNombre(){
		
 		$arraypersona=$this->m_adtrabajador->buscarNombre();
		
        foreach($arraypersona as $fila){
        	echo '<option >';
			echo $fila->idPersona;
			echo '</option>';
		}

 	}		
 
}?>

