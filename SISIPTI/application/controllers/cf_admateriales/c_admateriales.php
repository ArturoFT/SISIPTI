<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class C_admateriales extends CI_Controller {
	function __construct(){
		parent::__construct();
		 $this->load->helpers('form');
		  $this->load->model('mf_admateriales/m_admateriales');
		  $this->load->library('table');
		  $this->load->view('headers/librerias');
		  $this->load->helper('url');
		  $this->load->library('session');

	}	
 	function index(){
 		
 		$data['tabla']=$this->pintarTabla();
 		$this->load->view('nav1',$this->session->userdata);
 		$this->load->view('vf_admateriales/v_admateriales',$data);

 	
 	}	
 
 	function pintarTabla(){
 		
 		$arrayTabla= $this->m_admateriales->getTabla();
 		$tmpl = array ( 'table_open'   => '<table  class="table table-striped table-bordered" width="20%"  align="center" >' );
		$this->table->set_template($tmpl);
		$this->table->set_heading('Id', 'Nombre','precio','Proveedor','tipo','cantidad');
		foreach($arrayTabla as $fila){
			$this->table->add_row($fila->idMaterial,$fila->nombMaterial,$fila->precioMaterial,$fila->nombPersona,$fila->descTipoMaterial,$fila->Cantidad,
				"<a href='http://localhost/SISIPTI/index.php/cf_admateriales/c_admateriales/editar/$fila->idMaterial/$fila->idTipoMaterial'><button class='btn btn-success'>Detalles</button>");

		}

		$tabla = $this->table->generate();//log_message('error','tabl: '.$tabla);
		return $tabla;
 	}

 	function ingresar(){
			
		$data=$this->m_admateriales->getTabla();
 		$this->load->view('vf_admateriales/v_insertar',$data);

 	}

 	function insertar(){


		$dataM = array(
				'nombMaterial' => $this->input->post('nombre'),	
				'fk_idProveedor' => $this->input->post('proveedores'),
 				'precioMaterial' => $this->input->post('precio'),
 				'unidadMaterial' => $this->input->post('medida'),
 				'Cantidad' => $this->input->post('cantidad'),
 				'fk_idTipoMaterial' => $this->input->post('tipo')
 			);

		$this->m_admateriales->registrarMaterial($dataM);
 		redirect("<?php echo base_url().'index.php/cf_admateriales/c_admateriales/index';?>"); 
 	}

 	function editar($id=null,$idT){
 			

 		if(!$id){
 			show_404();
 		}
 		else{

 			$datos=$this->m_admateriales->getMaterial($id);

 			$this->load->view('vf_admateriales/v_editar',compact("id","idT","datos"));
 		}
 	
 	}
 	function Actualizar($id,$idT){

 		if(isset($_POST['nombre'])){
 				$data = array(
 				'nombMaterial' => $this->input->post('nombre'),	
 				'fk_idProveedor' => $this->input->post('proveedores'),
 				'precioMaterial' => $this->input->post('precio'),
 				'Cantidad' => $this->input->post('cantidad'),
 				'unidadMaterial' => $this->input->post('medida'),
 				'fk_idTipoMaterial' => $this->input->post('tipo')

 				
 			);

 			$this->m_admateriales->Actualizar($data,$id);
 			


 		

 			
 			
 			}
 			redirect("http://localhost/SISIPTI/index.php/cf_admateriales/c_admateriales/index"); 
 		}

 	function Eliminar($id,$idT){
		if(!$id){
 			show_404();
 		}
 			$this->m_admateriales->eliminarMa($id);
 			$this->m_admateriales->eliminar($idT);
 			redirect("http://localhost/SISIPTI/SISIPIT/index.php/cf_admateriales/c_admateriales/inde/2"); 
 			}		
}?>

