<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_AdministrarTrabajadores extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('ted/m_material');
		$this->load->model('ted/m_material_proyecto');
		$this->load->model('ted/m_material_ambiente');
		$this->load->model('ted/m_ambiente_trabajador');
		$this->load->model('ted/m_proyecto_trabajador');
		$this->load->model('ted/m_ambiente');
		$this->load->model('ted/m_cargo');
		$this->load->model('ted/m_actividad');
		$this->load->model('ted/m_trabajador');
	}
	


	public function abrir(){
		$this->cargarVista("administrar_trabajadores/administrar_trabajadores",0,"login",0,"nav1",0);
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

//trabajadoresProyectoPrincipal
	public function listarTrabajadoresProyectoLibres(){
		$idProyecto = $this->session->userdata['idPS'];
		
		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$pozo = $this->m_ambiente_trabajador->getPozoProyecto($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		$lista = $this->m_proyecto_trabajador->getTrabajadorProyecto	($idProyecto,$pozo[0]['idAmbiente_actividad']);
		$cargo = $this->m_cargo->getNombreCargo();

		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$ambientes = $this->m_ambiente->getAmbientesProyecto($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		//tabla cabecera
		echo "<div class=\"portlet-body\">
				<table class=\"table table-striped table-bordered table-hover\" >";
		echo "<thread>";
		echo "<tr>
		          <th style=\"text-align: center; \" >Trabajador</th>
		          <th style=\"text-align: center; \" >Cargo</th>
		          <th style=\"text-align: center; \" >Detalles</th>
		        </tr>
		      </thead>
		      <tbody>";
		//data
		    //PENDIENTE CAMBIAR DATOS A MOSTRAR
		foreach ($lista as $value) {
		 	echo "<tr><td>";
			echo $value['apellidoPat']." ".$value['apellidoMat']." ".$value['nombPersona'] ;
			echo "</td><td>";
			echo $value['nombCargo'];
			echo "</td><td style='text-align: center;' >";
			echo "<button type=\"button\" onclick='detallarTrabajador(".$value['idTrabajador'].")' class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModalDetallarTrabajador\" >
		      Detalles</button>";
		    echo "</td></tr>";
		}
		echo "</tbody></table></div>";
		echo "<div class=\"bs-example bs-example-padded-bottom col-md-offset-5 col-md-2\">
		    <button type=\"button\" id=\"agregarTrabajadoresAlProyecto\" class=\"btn btn-primary btn-lg\" data-toggle=\"modal\" data-target=\"#myModalAgregarTrabajadoresAlProyecto\">
		      Agregar Más Trabajadores Al Proyecto
		    </button></div>";
	}

	public function agregarTrabajadoresAlProyecto(){
		$idProyecto = $this->session->userdata['idPS'];
		$lista = $this->m_trabajador->getTrabajadorEmpresa();
		$cargo = $this->m_cargo->getNombreCargo();

		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$ambientes = $this->m_ambiente->getAmbientesProyecto($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		foreach ($lista as $value) {
			echo "<tr><td>";
			echo $value['apellidoPat']." ".$value['apellidoMat'] ;
			echo "</td><td>";
			echo $value['nombPersona'];
			echo "</td><td>";
			echo $value['profesion'];
			echo "</td><td>";
			echo "<div style='text-align:center;' class=\"checkbox\"><label><input id=\"añadirAlProyecto\" value=\"".$value['idTrabajador']."\" name=\"seleccionParaAgregarTrabajadores[]\" type=\"checkbox\"></label></div> ";
			echo "</td></tr>";
		}
	}

	public function detallarTrabajador(){

		$idTrabajador= $_POST['idTrabajador'];
		$value = $this->m_trabajador->getTrabajadorDetalles($idTrabajador);
		echo "<form>
			  <div class='form-group'>
			    <label>Apellidos</label>
			    <input type='text' class='form-control' id='apellidosTraba' placeholder='Apellidos' value='".$value[0]['apellidoPat']." ".$value[0]['apellidoPat']."'>
			  </div>
			  <div class='form-group'>
			    <label>Nombres</label>
			    <input type='text' class='form-control' id='nobmresTraba' placeholder='Nombres' value='".$value[0]['nombPersona']."'>
			  </div>
			  <div class='form-group'>
			    <label>Tipo de Documento</label>
			    <input type='text' class='form-control' id='tipoDoc' placeholder='Tipo Documento' value='".$idTrabajador."'>
			  </div>
			  <div class='form-group'>
			    <label>Num Documento</label>
			    <input type='text' class='form-control' id='numDocu' placeholder='Num Documento' value=''>
			  </div>
			  <div class='form-group'>
			    <label>Estado</label>
			    <input type='text' class='form-control' id='estadoTrabajador' placeholder='Estado' value='Activo'>
			  </div>
			  <div class='form-group'>
			    <label>Cargo</label>
			    <input type='text' class='form-control' id='Cargo' placeholder='Cargo' value='".$value[0]['nombCargo']."'>
			  </div>
			  <div class='form-group'>
			    <label>Profesion</label>
			    <input type='text' class='form-control' id='Profesion' placeholder='Profesion' value='".$value[0]['profesion']."'>
			  </div>
			  <button type='button' onclick='EliminarDeProyecto(".$value[0]['idTrabajador'].")'  class='btn btn-danger'>Eliminar</button>
			</form>";
	}

	public function EliminarDeProyecto(){
		$idTrabajador= $_POST['idTrabajador'];
		$this->m_ambiente_trabajador->eliminaTrabajadorDeLaEmpresa($idTrabajador);
	}

	public function agregarTrabajadoresAlPozoDelProyecto(){
		$idProyecto = $this->session->userdata['idPS'];

		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$idPozoRecuperadoDeTrabajadores = $this->m_ambiente_trabajador->getPozoProyecto($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		$data = array(
				'idTrabajador' => $this->input->post('idTraba'),
				'idAmbiente_actividad' => $idPozoRecuperadoDeTrabajadores[0]['idAmbiente_actividad']
		);
		$this->m_ambiente_trabajador->agregaTrabajadorAlPozoDelProyecto($data);  
	}
}