<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_AsignarRecursos extends CI_Controller {

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
	


	public function abrirAsignarRecursosHumanos(){
		$this->cargarVista("AsignarRecursos/asignarRecursos",0,"login",0,"nav1",0);
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

	public function listarRecursosMaterialesAsignados(){
		$idProyecto = $this->session->userdata['idPS'];
		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$idAmbiente_actividad = $this->m_material_proyecto->recuperaProyectoPozo($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);

		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$lista = $this->m_material_ambiente->getMaterialesAmbiente($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		//tabla cabecera
		echo "<div class=\"portlet-body\">
				<table class=\"table table-striped table-bordered table-hover\" >";
		echo "<thread>";
		echo "<tr>
		          <th style=\"text-align: center; \" >Material</th>
		          <th style=\"text-align: center; \" >Cantidad Asignada</th>
		          <th style=\"text-align: center; \" >Unidad de Medida</th>
		          <th style=\"text-align: center; \" class=\"sorting\">Ambiente</th>
		        </tr>
		      </thead>
		      <tbody>";
		//data
		    //PENDIENTE CAMBIAR DATOS A MOSTRAR
		foreach ($lista as $value) {
		 	echo "<tr><td>";
			echo $value['nombMaterial'];
			echo "</td><td>";
			echo $value['cantDispActividad_material'];
			echo "</td><td>";
			echo $value['unidadMaterial'];
			echo "</td><td>";
			echo $value['descAmbiente'];
			echo "</td></tr>";	
		}
		//cierra tabla
		echo "</tbody></table></div>";
		echo "<div class=\"bs-example bs-example-padded-bottom col-md-offset-5 col-md-2\">
		    <button type=\"button\" id=\"asignarRecursosMateriales\" class=\"btn btn-primary btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\">
		      Asignar Más Materiales
		    </button></div>";
	}

	public function listaMaterialesProyecto(){
		$idProyecto = $this->session->userdata['idPS'];
		//cambiado
		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$idAmbiente_Actividad = $this->m_material_proyecto->recuperaProyectoPozo($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		$lista =$this->m_material_proyecto->getMaterialesProyecto($idProyecto, $idAmbiente_Actividad[0]['idAmbiente_actividad']);
		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$ambientes = $this->m_ambiente->getAmbientesProyecto($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		$cont = 1;
		foreach ($lista as $value) {
			echo "<tr><td>";
			echo "<label id= nombreMaterialParaMostrarAsignar".$value['idMaterial']."  >".$value['nombMaterial']."</label>";
			echo "</td><td>";
			echo $value['unidadMaterial'];
			echo "</td><td>";
			echo "<label id= contMaterialPozoAsignar".$value['idMaterial']."  >".$value['cantDispActividad_material']."</label>";
			echo "</td><td><div class=\"checkbox\"><label><input idamb='' num='".$cont."' id=\"asignarMatSel".$cont."\" value=\"".$value['idMaterial']."\" onclick='verificar(this)' name=\"seleccionMateriales[]\" class='check-Material' type=\"checkbox\"></label></div>";	
			echo "</td><td><input  class=\"form-control\"  id=\"cantidadAsignada".$cont."\" type=\"number\" value=\"\" disabled></td>";
			echo "<td><select id='selectMat".$cont."' class=\"form-control selectS\" num='".$cont."' disabled>
				  <option>Elige un Ambiente</option>";
				 	foreach ($ambientes as $value) {
					echo "<option id='ambienteSelectMateriales' value=\"".$value['idAmbiente']."\" >".$value['descAmbiente']."</option>";
					}
			echo "</select></td></tr>";
			$cont++;
		}
	}

	//LISTAR RECURSOS HUMANOS PENDIENTE RECOLECCION CORRECTA
	public function listarRecursosHumanosAsignados(){
		$idProyecto = $this->session->userdata['idPS'];
		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$lista = $this->m_ambiente_trabajador->getAmbienteTrabajador($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		//tabla cabecera
		echo "<div class=\"portlet-body\">
				<table class=\"table table-striped table-bordered table-hover\">";
		echo "<thread>";
		echo "   <tr>
		          <th style=\"text-align: center; \" >Apellidos</th>
		          <th style=\"text-align: center; \" >Nombres</th>
		          <th style=\"text-align: center; \" >Ambiente</th>
		          <th style=\"text-align: center; \" >Cargo</th>
		          <th style=\"text-align: center; \" >Actividad Actual</th>
		        </tr>
		      </thead>
		      <tbody>";
		//data
		foreach ($lista as $value) {
		 	echo "<tr><td>";
			echo $value['apellidoPat']." ".$value['apellidoMat'] ;
			echo "</td><td>";
			echo $value['nombPersona'];
			echo "</td><td>";
			echo $value['descAmbiente'];
			echo "</td><td>";
			echo $value['nombCargo'];
			echo "</td><td>";
			echo $value['nombActividad'];
			echo "</td></tr>";	
		}
		//cierra tabla
		echo "</tbody></table></div>";
		echo "<div class=\"bs-example bs-example-padded-bottom col-md-offset-5 col-md-2\">
		    <button type=\"button\" id=\"asignarRecursosHumanos\" class=\"btn btn-primary btn-lg\" data-toggle=\"modal\" data-target=\"#myModalHumanos\">
		      Asignar Más Trabajadores
		    </button></div>";
	}

	public function listarTrabajadoresProyecto(){
		$idProyecto = $this->session->userdata['idPS'];
		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$pozo = $this->m_ambiente_trabajador->getPozoProyecto($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		$lista = $this->m_proyecto_trabajador->getTrabajadorProyecto($idProyecto,$pozo[0]['idAmbiente_actividad']);
		$cargo = $this->m_cargo->getNombreCargo();

		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$ambientes = $this->m_ambiente->getAmbientesProyecto($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);
		$cont = 1;
		foreach ($lista as $value) {
			echo "<tr><td>";
			echo $value['apellidoPat']." ".$value['apellidoMat'] ;
			echo "</td><td>";
			echo $value['nombPersona'];
			echo "</td><td>";
			echo $value['profesion'];
			echo "</td><td><div class=\"checkbox\"><label><input numMat=".$cont."  id=\"asignar\" value=\"".$value['idTrabajador']."\" onclick='verificarMaterial(this)' name=\"seleccion[]\" type=\"checkbox\"></label></div></td> ";
			echo "<td>" .$value1['nombCargo']."</td>";
			echo "<td><select onchange='llenarSActividad(".$cont.")' selNum = ".$cont." id='selectAmbiente".$cont."' class=\"sAmiente form-control\" disabled >";
					echo "<option>Escoja un Ambiente</option>";
				  foreach ($ambientes as $value2) {
				  	echo "<option id=\"ambiente\" value=\"".$value2['idAmbiente']."\">".$value2['descAmbiente']."</option>";
				  }

			echo "</select></td>";
			echo "<td><select id='retornaActividades".$cont."' class=\"form-control\" numActSel='".$cont."' disabled>";
			
			echo "</select></td></tr>";
			$cont++;
		}
	}	

	public function cargarActividadesPorAmbiente(){
		$idProyecto = $this->session->userdata['idPS'];

		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$actividades= $this->m_actividad->getActividadAmbientes($idProyecto,$_POST['idAmbiente'],$idAmbienteFantasma[0]['idAmbiente']);
		$cont = 1;
			foreach ($actividades as $value) {
			  	echo "<option id='actividad' value=\"".$value['idActividad']."\">".$value['nombActividad']."</option>";
			}
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

	public function RegistraAsignacionRecursos(){
		$idProyecto = $this->session->userdata['idPS'];
		$data = array(
				'idTrabajador' => $this->input->post('idTraba'),
				'idActividad' => $this->input->post('idAct'),
				'idAmbiente' => $this->input->post('idAmb')
		);
		$idAmbiente_Actividad = $this->m_ambiente_trabajador->retornaIdAmbienteActividad($data); 
		
		$AmbienteFantasmaActual = $this->m_ambiente_trabajador->retornaAmbienteFantasmaActual($data); 

		/*print_r($idAmbiente_Actividad[0]['idAmbiente_Actividad']);
		exit();*/
		
		$dataUp = array(
				'idTrabajador' => $this->input->post('idTraba'),
				'AmbienteFantasmaActual' => $AmbienteFantasmaActual[0]['fk_idAmbiente_Actividad'],
				'idAmbiente_Actividad' =>$idAmbiente_Actividad[0]['idAmbiente_Actividad'],
				'idCargo' => $this->input->post('idCarg')
		);
		$this->m_ambiente_trabajador->asignaTrabajador($dataUp); 
	}

	public function RegistrarAsignacionMat(){
		$idProyecto = $this->session->userdata['idPS'];
		$data = array(
				'idMaterial' => $this->input->post('idMat'),
				'idAmbiente' => $this->input->post('idAmb'),
				'cantidad' => $this->input->post('cant')
		);

		$idAmbiente_Actividad_pozo = $this->m_material_ambiente->recuperaPozo($data,$idProyecto);

		$idAmbienteFantasma = $this->m_ambiente->getIdAmbienteFantasmaPorTipo($idProyecto);
		$idProyecto_pozo = $this->m_material_proyecto->recuperaProyectoPozo($idProyecto,$idAmbienteFantasma[0]['idAmbiente']);		


		$dataCal = array(
				'idMaterial' => $this->input->post('idMat'),
				'idProyecto' => $idProyecto,
				'fk_idAmbiente_Actividad' => $idAmbiente_Actividad_pozo[0]['idAmbiente_actividad']
				//proyecto
		);

		$cantidadActualAsignada = $this->m_material_ambiente->cantMatAsignadaAmbiente($dataCal);
		$cantidadActualProyecto = $this->m_material_ambiente->cantMatDispProy($dataCal);

			

		$nuevaCantidadRestada = $cantidadActualProyecto[0]['cantDispActividad_material'] - $data['cantidad'] ;
		$nuevaCantidadSumada = $cantidadActualAsignada[0]['cantDispActividad_material'] + $data['cantidad'] ;
		//
		//print_r($nuevaCantidadResta);
		//exit();
		$retira = array(
				'idMaterial' => $this->input->post('idMat'),
				'fk_idAmbienteActividad' => $idProyecto_pozo[0]['idAmbiente_actividad'],
				'cantDispActividad_material' => $nuevaCantidadRestada
		);
		$coloca = array(
				'idMaterial' => $this->input->post('idMat'),
				'fk_idAmbienteActividad' => $idAmbiente_Actividad_pozo[0]['idAmbiente_actividad'],
				'cantDispActividad_material' => $nuevaCantidadSumada
		);

		$this->m_material_ambiente->retiraRecursoParaAsignacion($retira);
		$this->m_material_ambiente->asiganaMaterialAmbiente($coloca);


	}

}