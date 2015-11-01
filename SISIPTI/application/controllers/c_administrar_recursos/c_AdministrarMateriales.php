<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_AdministrarMateriales extends CI_Controller {

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
	}
	


	public function abrir(){
		//administrar_materiales/administarMateriales
		$this->cargarVista("administrar_materiales/administrarMateriales",0,"login",0,"nav1",0);
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
	
	public function listarMaterialesDelProyectoEnPozo(){
		$idProyecto = $this->session->userdata['idPS'];
		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$pozoProyecto = $this->m_material_proyecto->recuperaProyectoPozo($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		$lista =$this->m_material_proyecto->getMaterialesProyecto($idProyecto,$pozoProyecto[0]['idAmbiente_actividad']);
		
		//tabla cabecera
		echo "<div class=\"portlet-body\">
				<table class=\"table table-striped table-bordered table-hover\" >";
		echo "<thread>";
		echo "<tr>
				  <th style='text-align: center; '>Material</th>
			      <th style='text-align: center; '>Cantidad Disponible</th>
			      <th style='text-align: center; '>Unidad de Medida</th>
	              <th style='text-align: center; '>Detalles</th>
		      </tr>
		      </thead>
		      <tbody>";
		//data
		    //PENDIENTE CAMBIAR DATOS A MOSTRAR
		foreach ($lista as $value) {
			echo "<tr><td>";
			echo $value['nombMaterial'];
			echo "</td><td>";
			echo $value['unidadMaterial'];
			echo "</td><td>";
			echo $value['cantDispActividad_material'];
			echo "</td><td style='text-align: center;' >";
			echo "<button type=\"button\" onclick='detallarMaterial(".$value['idMaterial'].")' class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModalDetallarMaterial\" >
		      Detalles</button>";
		    echo "</td></tr>";
		}
		echo "</tbody></table></div>";
		echo "<div class=\"bs-example bs-example-padded-bottom col-md-offset-5 col-md-2\">
		    <button type=\"button\" id=\"agregarMaterialesesAlProyecto\" class=\"btn btn-primary btn-lg\" data-toggle=\"modal\" data-target=\"#myModalAgregarMaterialesAlPozo\">
		      Agregar Más Materiales Al Proyecto
		    </button></div>";
	}

	public function detallarMaterial(){

		$idMaterial= $_POST['idMaterial'];
		$value = $this->m_material->getDetalleMaterial($idMaterial);
		echo "<form>
			  <div class='form-group'>
			    <label>Material</label>
			    <input type='text' class='form-control' id='material' placeholder='material' value='".$value[0]['nombMaterial']."'>
			  </div>
			  <div class='form-group'>
			    <label>Proveedor</label>
			    <input type='text' class='form-control' id='proveedor' placeholder='proveedor' value='".$value[0]['apellidoPat']." ".$value[0]['apellidoPat'].$value[0]['nombPersona']."'>
			  </div>
			  <div class='form-group'>
			    <label>Marca</label>
			    <input type='text' class='form-control' id='marca' placeholder='marca' value=''>
			  </div>
			  <div class='form-group'>
			    <label>Unidad de Medida</label>
			    <input type='text' class='form-control' id='unidadMedida' placeholder='unidadMedida' value='".$value[0]['unidadMaterial']."'>
			  </div>
			  <div class='form-group'>
			    <label>Precio Unitario</label>
			    <input type='text' class='form-control' id='precioUnitario' placeholder='Estado' value='".$value[0]['precioMaterial']."'>
			  </div>
			  <button type='button' onclick='EliminarMaterialDeProyecto(".$value[0]['idMaterial'].")'  class='btn btn-danger'>Eliminar</button>
			</form>";
	}

	public function cargarMaterialesDelPozo(){
		$idProyecto = $this->session->userdata['idPS'];
		$Material = $this->m_material->getMaterialesEmpresa();
		$cont = 1;
		foreach ($Material as $value) {
			echo "<tr><td > ";
			echo "<label id= nombreMaterialParaMostrar".$value['idMaterial']."  >".$value['nombMaterial']."</label>";
			echo "</td><td>";
			echo "<label id= contMaterialPozo".$value['idMaterial']."  >".$value['Cantidad']."</label>";
			echo "</td><td>";
			echo $value['unidadMaterial'];
			echo "</td><td><div style='text-align:center;' class=\"checkbox\"><label><input numMatEmpre='".$cont."' id=\"asignarMatSele".$cont."\" value=\"".$value['idMaterial']."\" onclick='verificarMatEmpre(this)' name=\"seleccionMaterialesDeLaEmpresa[]\" class='check-Material' type=\"checkbox\"></label></div>";	
			echo "</td><td><input  class=\"form-control\"  id=\"cantidadAsignadaAlProyectoDesdeLaEmpresa".$cont."\" type=\"number\" value=\"\" disabled></td>";
			echo "</td></tr>";
			$cont++;
		}
	}

	public function comparadorDeExistencia ($matEmp,$MaterialesExistentesEnProyecto){
		$respuestaId="";
		$cantidadMaterialesTotal=count($MaterialesExistentesEnProyecto);
			for($i = 0 ;$i<$cantidadMaterialesTotal;$i++){
				print_r($MaterialesExistentesEnProyecto[$i]['idMaterial']);
				print_r("->".$matEmp);
				if ($MaterialesExistentesEnProyecto[$i]['idMaterial'] == $matEmp){
					$respuestaId = "no";
				}
			}

			if($respuestaId == ""){
				$respuestaId = $matEmp;
				return $respuestaId;
			}
			else{
				return $respuestaId;
			}
		
	}

	public function AsignarRecursosMatAlProyectoDeLaEmpresa(){
		$idProyecto = $this->session->userdata['idPS'];
		
		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$pozoProyecto= $this->m_material_proyecto->recuperaProyectoPozo($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		$MaterialesExistentesEnProyecto = $this->m_material->getMaterialesExistentesEnProyecto($idProyecto,$pozoProyecto[0]['idAmbiente_actividad']);
		$Material = $this->input->post('idMat');
		//print_r($MaterialesExistentesEnProyecto);
		$respuestaId = $this->comparadorDeExistencia($Material,$MaterialesExistentesEnProyecto);
		
		$data = array(
					'idMaterial' => $this->input->post('idMat'),
					'cantidad' => $this->input->post('cant')
			);

		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$idProyecto_pozo = $this->m_material_proyecto->recuperaProyectoPozo($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);		

		//AGREGA NUEVO
		if($respuestaId != "no"){
			
			$cantidadActualEnLaEmpresa1 = $this->m_material->getCantidadPorMaterial($data['idMaterial']);
			$nuevaCantidadRestadaParaLaEmpresa1 = $cantidadActualEnLaEmpresa1[0]['Cantidad'] - $data['cantidad'] ;
			$retira1 = array(
					'idMaterial' => $this->input->post('idMat'),
					'Cantidad' => $nuevaCantidadRestadaParaLaEmpresa1
			);
			print_r("MATERIALNO: ".$data['idMaterial']." cantidadActualEnLaEmpresa1 " .$cantidadActualEnLaEmpresa1[0]['Cantidad']." - ".$data['cantidad']);
			$this->m_material->retiraRecursoMatDeLaEmpresa($retira1);

			$this->m_material_ambiente->incorporaMaterial($data,$idProyecto_pozo[0]['idAmbiente_actividad']);
		}	
		//AGREGA A MATERIAL YA INCORPORADO
		else if ($respuestaId == "no"){			
			$dataCal = array(
					'idMaterial' => $this->input->post('idMat'),
					'idProyecto' => $idProyecto,
					'fk_idAmbiente_Actividad' => $idProyecto_pozo[0]['idAmbiente_actividad']
					//proyecto
			);

			$cantidadActualAsignadaEnElpozo = $this->m_material_ambiente->cantMatAsignadaAmbiente($dataCal);
			$cantidadActualEnLaEmpresa = $this->m_material->getCantidadPorMaterial($data['idMaterial']);
				

			$nuevaCantidadRestadaParaLaEmpresa = $cantidadActualEnLaEmpresa[0]['Cantidad'] - $data['cantidad'] ;
			$nuevaCantidadSumadaParaElProyecto = $cantidadActualAsignadaEnElpozo[0]['cantDispActividad_material'] + $data['cantidad'] ;
			print_r("MATERIAL: ".$data['idMaterial']." cantidadActualEnLaEmpresa " .$cantidadActualEnLaEmpresa[0]['Cantidad']." - ".$data['cantidad']);
			$retira = array(
					'idMaterial' => $this->input->post('idMat'),
					'Cantidad' => $nuevaCantidadRestadaParaLaEmpresa
			);
			$coloca = array(
					'idMaterial' => $this->input->post('idMat'),
					'fk_idAmbienteActividad' => $idProyecto_pozo[0]['idAmbiente_actividad'],
					'cantDispActividad_material' => $nuevaCantidadSumadaParaElProyecto
			);

			$this->m_material->retiraRecursoMatDeLaEmpresa($retira);
			$this->m_material_ambiente->asiganaMaterialAmbiente($coloca);
		}
		
	}
}	
