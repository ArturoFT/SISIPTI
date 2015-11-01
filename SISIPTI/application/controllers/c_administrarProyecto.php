<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_administrarProyecto extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('m_proyecto');
		$this->load->model('m_cliente');
		$this->load->model('m_tipoProyecto');
		$this->load->model('m_ambiente');
		$this->load->model('m_actividad');
		$this->load->model('m_ambiente_actividad');
	}

	public function suspender_proyecto(){
		
		if ($_POST["idP"]==$this->session->userdata['idPS']) {
			$this->session->set_userdata('idPS', -1);
			$this->session->set_userdata('nombPS', "");
		}
		//print_r($this->session->userdata);
		$this->m_proyecto->suspender_proyecto($_POST["idP"]);
	}

	public function reanudar_proyecto(){
		$this->m_proyecto->reanudar_proyecto($_POST["idP"]);
	}

	public function little_actualizarNombre(){
		echo "Proyecto Seleccionado: ".$this->session->userdata['nombPS'];
	}

	public function seleccionar_proyecto(){
		$this->session->set_userdata('idPS', $_POST["idP"]);
		$this->session->set_userdata('nombPS', $_POST["nombP"]);
		print_r($this->session->userdata);
	}

	public function crear_proyecto(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {

				$this->form_validation->set_rules('nombreP','Nombre','required');
				$this->form_validation->set_rules('direccionP','Dirección','required');
				$this->form_validation->set_rules('fechaInicioP','Fecha de inicio','required');
				$this->form_validation->set_rules('alcanceP','Alcance','required');
				$this->form_validation->set_rules('exclusionesP','Exclusiones','required');
				$this->form_validation->set_rules('presupuestoP','Presupuesto','required|numeric');
				$this->form_validation->set_rules('tipoP','Tipo de proyecto','required');
				$this->form_validation->set_rules('clienteP','Cliente del proyecto','required');
			    $this->form_validation->set_error_delimiters('<span style="color:red;">','</span>') ;

			    if ($this->form_validation->run() === FALSE){
					$this->load->view('nav1',$this->session->userdata);				
					$this->load->view('administrarProyectos/agregarProyecto');					
			    }else{
			    	$data = array(
		    			"nombProyecto"=>$_POST["nombreP"],
		    			"dirProyecto"=>$_POST["direccionP"],
		    			"fechaIniProyecto"=>$_POST["fechaInicioP"],
		    			"alcanceProyecto"=>$_POST["alcanceP"],
		    			"exclusionesProyecto"=>$_POST["exclusionesP"],
		    			"fechaRegistroProyecto"=>date("Y-m-d"),
		    			"presupuestoIniProyecto"=>$_POST["presupuestoP"],
		    			"fk_idEstado"=>1,
		    			"fk_idCliente"=>$_POST["clienteP"],
		    			"fk_idTipoProyecto"=>$_POST["tipoP"]
			    	);
			    	$idP = $this->m_proyecto->insertarProyecto($data);
			    	$data2 = array(
		    			"nombAmbiente"=> "Amb.Ini de ".$_POST["nombreP"],
		    			"descAmbiente"=>"Ambiente de inicialización.",
		    			"imgAmbiente"=>null,
		    			"precioAmbiente"=>null,			    			
		    			"fk_idProyecto"=>$idP,
		    			"fk_idTipoAmbiente"=>1
		    		);
			    	$idAmb = $this->m_ambiente->insertarAmbiente($data2);
			    	//$data3 = array(
		    		//	"nombActividad"=> "Act.Ini de ".$_POST["nombreP"],
		    		//	"descActividad"=>"Actividad de inicialización.",
		    		//	"prioridadActividad"=>0
		    		//);
			    	//$idAct = $this->m_actividad->insertarActividad($data3);
			    	$data4 = array(
		    			"agregado"=> 0,
		    			"fk_idActividad"=>1,
		    			"fk_idAmbiente"=>$idAmb
		    		);
			    	$idAct = $this->m_ambiente_actividad->insertarAmbienteActividad($data4);
			    	$this->load->view('nav1',$this->session->userdata);
			    	$datosExito = array("titulo"=>"¡Proyecto creado!","mensaje"=>"El proyecto ".$_POST["nombreP"]." se creó correctamente.");
			    	$this->load->view('success',$datosExito );
			    }
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}
	}

	public function modificar_proyecto(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {

				$this->form_validation->set_rules('nombreP','Nombre','required');
				$this->form_validation->set_rules('direccionP','Dirección','required');
				$this->form_validation->set_rules('fechaInicioP','Fecha de inicio','required');
				$this->form_validation->set_rules('alcanceP','Alcance','required');
				$this->form_validation->set_rules('exclusionesP','Exclusiones','required');
				$this->form_validation->set_rules('presupuestoP','Presupuesto','required|numeric');
				$this->form_validation->set_rules('tipoP','Tipo de proyecto','required');
				$this->form_validation->set_rules('clienteP','Cliente del proyecto','required');
			    $this->form_validation->set_error_delimiters('<span style="color:red;">','</span>') ;

			    if ($this->form_validation->run() === FALSE){
					$this->load->view('nav1',$this->session->userdata);	
					$data = $this->m_proyecto->traer_proyecto_table($_POST["idProyecto"]);			
					$this->load->view('administrarProyectos/modificarProyecto',$data);					
			    }else{
			    	$data = array(
		    			"nombProyecto"=>$_POST["nombreP"],
		    			"dirProyecto"=>$_POST["direccionP"],
		    			"fechaIniProyecto"=>$_POST["fechaInicioP"],
		    			"alcanceProyecto"=>$_POST["alcanceP"],
		    			"exclusionesProyecto"=>$_POST["exclusionesP"],
		    			"fechaRegistroProyecto"=>date("Y-m-d"),
		    			"presupuestoIniProyecto"=>$_POST["presupuestoP"],
		    			"fk_idCliente"=>$_POST["clienteP"],
		    			"fk_idTipoProyecto"=>$_POST["tipoP"]
			    	);
			    	$this->m_proyecto->modificarProyecto($data,$_POST["idProyecto"]);
			    	
			    	$this->load->view('nav1',$this->session->userdata);
			    	$datosExito = array("titulo"=>"¡Proyecto modificado!","mensaje"=>"El proyecto ".$_POST["nombreP"]." se modificó correctamente.");
			    	$this->load->view('success',$datosExito );
			    }
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}
	}

	public function traer_tipoProyecto(){
		$datos = $this->m_tipoProyecto->traer_tipoProyecto();
		echo '<option value="">Seleccionar...</option>';
		foreach ($datos as $value) {
			echo '<option value="'.$value["idTipoProyecto"].'">'.$value["descTipoProyecto"].'</option>';
		}
	}

	public function traer_clienteProyecto(){
		$datos = $this->m_cliente->traer_clienteProyecto();
		echo '<option value="">Seleccionar...</option>';
		foreach ($datos as $value) {			
			echo '<option value="'.$value["idCliente"].'">'.$value["nombPersona"].'</option>';
		}
	}

	public function traer_proyectos(){
		$cont = 0;
		$proyectos = $this->m_proyecto->traer_proyectos();
		foreach ($proyectos as $tr) {
			echo "<tr>";
			if($tr["fk_idEstado"]==2){
				$class="class='danger'";
			}else{$class="";}
			foreach ($tr as $td) {
				if ($cont>1) {
					echo "<td $class>$td</td>";
				}	
				$cont++;			
			}	
			$cont=0;
				echo "<td $class>";
					if ($class!="") {
						echo "<button onclick='reanudarP(\"".$tr["idProyecto"]."\")'  type='button' class='btn btn-info'>Reanudar</button>";
					}else{
					echo"<div class='checkbox'>
							<label style='padding-left:0px;'>";
								if (isset($this->session->userdata['idPS'])) {
									if ($this->session->userdata['idPS']==$tr["idProyecto"]) {
										echo "<input onclick='checkP()' name='proyectoSelec' nomb='".$tr["nombProyecto"]."' value='".$tr["idProyecto"]."' type='radio' checked='checked'>";
									}else{
										echo "<input onclick='checkP()' name='proyectoSelec' nomb='".$tr["nombProyecto"]."' value='".$tr["idProyecto"]."' type='radio'>";
									}
								}else{
									echo "<input onclick='checkP()' name='proyectoSelec' nomb='".$tr["nombProyecto"]."' value='".$tr["idProyecto"]."' type='radio'>";
								}						
						echo "</label>
						</div>";
					}
			  echo "</td>";
			echo "</tr>";		
		}	
	}

	public function abrir_listaProyectos(){
		if (isset($this->session->userdata['nombUsuario'])) {
			$this->load->view('head');
			if ($this->session->userdata['fk_idRol']==4) {
				$this->load->view('nav1',$this->session->userdata);				
				$this->load->view('administrarProyectos/seleccionarProyecto');
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}
	}

	public function abrir_agregarProyecto(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {
				$this->load->view('nav1',$this->session->userdata);				
				$this->load->view('administrarProyectos/agregarProyecto');
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}
	}

	public function abrir_modificarProyecto(){
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {
				$data = $this->m_proyecto->traer_proyecto_table($_POST["idP"]);
				$this->load->view('administrarProyectos/modificarProyecto',$data);
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}
	}
}	