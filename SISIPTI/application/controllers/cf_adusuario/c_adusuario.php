<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_adusuario extends CI_Controller {
	function __construct(){
		parent::__construct();
		 $this->load->helpers('form');
		  $this->load->model('mf_adusuario/m_adusuario');
		  $this->load->library('table');
		  $this->load->view('headers/librerias');
		  $this->load->helper('url');
		  $this->load->library('session');

	}	
 	function index(){
 		
 		$data['tabla']=$this->pintarTabla();
 		$this->load->view('nav1',$this->session->userdata);
 		$this->load->view('vf_adusuario/v_adusuario',$data);

 	
 	}	
 
 	function pintarTabla(){
 		
 		$arrayTabla= $this->m_adusuario->getTabla();
 		$tmpl = array ( 'table_open'   => '<table  class="table table-striped table-bordered" width="20%"  align="center" >' );
		$this->table->set_template($tmpl);
		$this->table->set_heading('Id', 'Usuario','Rol','Detalles');
		foreach($arrayTabla as $fila){
			$this->table->add_row($fila->idUsuario,$fila->nombUsuario,$fila->nombRol,
				"<a href='http://localhost/SISIPTI/index.php/cf_adusuario/c_adusuario/editar/$fila->fk_idRol'><button class='btn btn-success' >Detalles</button>");

		}

		$tabla = $this->table->generate();//log_message('error','tabl: '.$tabla);
		return $tabla;
 	}

 	function insertar(){


		$dataP = array(
				'nombUsuario' => $this->input->post('usuario'),	
 				'claveUsuario' => $this->input->post('contrasena'),
 				'fk_idRol' => $this->input->post('rol'),
 				'estadoUsuario' => '1'
 			);
 		
 		$idP=$this->m_adusuario->registrarUsuario($dataP);

 		redirect("http://localhost/SISIPTI/index.php/cf_adusuario/c_adusuario/index"); 
 	
 		
 	}

 
 
}?>