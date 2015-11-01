<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_administrarAmbientes extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('m_ambiente');
		$this->load->model('m_actividad');
		$this->load->model('m_ambiente_actividad');
	}

	public function traer_ambientes(){
		$ambientes = $this->m_ambiente->traer_ambientes($this->session->userdata['idPS']);
		foreach ($ambientes as $value) {
			echo "<tr class='text-center'><td>".$value["nombAmbiente"]."</td><td>".$value["ubicacionAmbiente"]."</td><td>".$value["fechaRealAmbiente"]."</td><td>".$value["fechaIniAmbiente"]."</td><td>".$value["fechaFinAmbiente"]."</td><td><input onclick='checkP()' name='ambienteSelec' nomb='".$value["nombAmbiente"]."' value='".$value["idAmbiente"]."' type='radio'></td></tr>";
		}
	}

	public function crear_ambiente(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {
				$this->form_validation->set_rules('tipoA','Tipo de Ambiente','required');
				$this->form_validation->set_rules('nombreA','Nombre de Ambiente','required');
				$this->form_validation->set_rules('descA','Descripción','required');
				$this->form_validation->set_rules('fechaInicioA','Fecha de Inicio','required');
				$this->form_validation->set_rules('fechaReaA','Fecha de Realización','required');
				$this->form_validation->set_rules('fechaFinA','Fecha de Finalización','required');
				$this->form_validation->set_rules('ubicacionA','Ubicación','required');
				$this->form_validation->set_rules('precioA','Precio','required|numeric');
			    $this->form_validation->set_error_delimiters('<span style="color:red;">','</span>') ;

				if ($this->form_validation->run() === FALSE){
					$this->load->view('nav1',$this->session->userdata);				
					$this->load->view('administrarAmbientes/agregarAmbiente');					
			    }else{
			    	$idActividades = explode("/", $_POST["idActividades"]);
			    	$data_t_ambiente = array(
			    		"nombAmbiente" => $_POST["nombreA"],
			    		"descAmbiente" => $_POST["descA"],
			    		"fechaIniAmbiente" => $_POST["fechaInicioA"],
			    		"fechaRealAmbiente" => $_POST["fechaReaA"],
			    		"fechaFinAmbiente" => $_POST["fechaFinA"],
			    		"precioAmbiente" => $_POST["precioA"],
			    		"ubicacionAmbiente" => $_POST["ubicacionA"],
			    		"fk_idProyecto" => $this->session->userdata["idPS"],
			    		"fk_idTipoAmbiente" => $this->m_ambiente->idTipoAmbiente($_POST["tipoA"])["idTipoAmbiente"],
			    	);

			    	$idNuevoAmbiente=$this->m_ambiente->insertarAmbiente($data_t_ambiente);

			    	$actPreCargadas = $this->m_ambiente->traer_actividadesPrecargadasAmbienteClon($_POST["tipoA"]);

			    	foreach ($actPreCargadas as $value) {
			    		$agregado = 0;
			    		for ($i=1; $i < sizeof($idActividades); $i++) { 
			    			if ((int)$idActividades[$i] == $value['idActividad']) {
			    				$agregado = 1;
			    			}
			    		}
			    		$value['idActividad']="";
			    		$idNuevaAct = $this->m_actividad->insertarActividad($value);
			    		$datosAmbAct = array("agregado" => $agregado,"fk_idAmbiente" => $idNuevoAmbiente,"fk_idActividad" => $idNuevaAct);
			    		$idNuevaAmbAct = $this->m_ambiente_actividad->insertarAmbienteActividad($datosAmbAct);
			    	}

			    	$datosAmbAct = array("agregado" => 0,"fk_idAmbiente" => $idNuevoAmbiente,"fk_idActividad" => 1);
		    		$idNuevaAmbAct = $this->m_ambiente_actividad->insertarAmbienteActividad($datosAmbAct);

			    	$this->load->view('nav1',$this->session->userdata);
			    	$datosExito = array("titulo"=>"¡Ambiente creado!","mensaje"=>"El Ambiente se creó correctamente.");
			    	$this->load->view('success',$datosExito );

			    }
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}
	}

	public function modificar_ambiente(){
		if (!isset($_POST["idAmb"])) {
			$this->load->view('head');
			$this->load->view('nav1',$this->session->userdata);
			$this->load->view('administrarAmbientes/administrarAmbientes');
			return;
		}
		$this->load->view('head');
		$mod = $_POST["mod"];
		$idAmb=$_POST["idAmb"];
		if (isset($this->session->userdata['nombUsuario'])) {			
			if ($this->session->userdata['fk_idRol']==4) {

				if ($mod) {}else{
		    		$this->form_validation->set_rules('tipoA','Tipo de Ambiente','required');
		    	}
				
				$this->form_validation->set_rules('nombreA','Nombre de Ambiente','required');
				$this->form_validation->set_rules('descA','Descripción','required');
				$this->form_validation->set_rules('fechaInicioA','Fecha de Inicio','required');
				$this->form_validation->set_rules('fechaReaA','Fecha de Realización','required');
				$this->form_validation->set_rules('fechaFinA','Fecha de Finalización','required');
				$this->form_validation->set_rules('ubicacionA','Ubicación','required');
				$this->form_validation->set_rules('precioA','Precio','required|numeric');
			    $this->form_validation->set_error_delimiters('<span style="color:red;">','</span>') ;

				if ($this->form_validation->run() === FALSE){
					echo "0";
					$this->load->view('nav1',$this->session->userdata);							
					$amb= $this->m_ambiente->traer_ambiente($idAmb);
					$actAmb = $this->m_actividad->traer_actividadesxAmb($idAmb);
					$tabla="";
					foreach ($actAmb as $value) {
						$tabla.= "<tr class='text-center'><td>".$value["nombActividad"]."</td><td>".$value["descActividad"]."</td>";
						if ($value["agregado"]==0) {
							$tabla.= "<td><div class='checkbox'><label><input name='idActividad[]'  value='".$value["idActividad"]."' type='checkbox'></label></div></td>";
						}else{
							$num=count($this->m_actividad->actividad_noModificable_mat($value["idAmbiente_actividad"]))+count($this->m_actividad->actividad_noModificable_tra($value["idAmbiente_actividad"]));
							//print_r($num);
							if($num<1){
								$tabla.= "<td><div class='checkbox'><label><input name='idActividad[]'  value='".$value["idActividad"]."' type='checkbox' checked='checked'></label></div></td>";
							}else{
								$mod = 1;
								$tabla.= "<td class='danger'>*No modificable.<br>(Agregado)</td>";
							}
						}
						$tabla.= "</tr>";
					}	
					
					$this->array_put_to_position($amb, $tabla, 0, 'tabla');
					$this->array_put_to_position($amb, $mod, 0, 'mod');
					$this->array_put_to_position($amb, $idAmb, 0, 'idAmb');
					
					$this->load->view('administrarAmbientes/modificarAmbiente', $amb);
					//print_r($amb);
								
			    }else{
			    	$data_t_ambiente = array(
			    		"nombAmbiente" => $_POST["nombreA"],
			    		"descAmbiente" => $_POST["descA"],
			    		"fechaIniAmbiente" => $_POST["fechaInicioA"],
			    		"fechaRealAmbiente" => $_POST["fechaReaA"],
			    		"fechaFinAmbiente" => $_POST["fechaFinA"],
			    		"precioAmbiente" => $_POST["precioA"],
			    		"ubicacionAmbiente" => $_POST["ubicacionA"]
			    	);

			    	$this->m_ambiente->actualizar_ambiente($data_t_ambiente,$idAmb);
			    	$idActividades = explode("/", $_POST["idActividades"]);	    	


			    	if ($mod) {
			    		//CUANDO NO SE PUEDE MODIFICAR EL TIPO
			    		echo "1<br>";
			    		for ($i=1; $i < count($idActividades); $i++) { 
			    			$valor = explode("*", $idActividades[$i]);
			    			//echo "idActividad = ".$valor[0]." agregado = ".$valor[1]."<br>";
			    			$this->m_ambiente_actividad->update_agregado($idAmb,$valor[0],$valor[1]);
			    		}
			    		
			    	}else{
			    		echo "2 ".$idAmb."<br>";
			    		
			    		$tipoActualizacion = $_POST["tipoActualizacion"];
			    		if ($tipoActualizacion == 0) {
			    			for ($i=1; $i < count($idActividades); $i++) { 
				    			$valor = explode("*", $idActividades[$i]);
				    			//echo "idActividad = ".$valor[0]." agregado = ".$valor[1]."<br>";
				    			$this->m_ambiente_actividad->update_agregado($idAmb,$valor[0],$valor[1]);
				    		}
			    		}else{
			    			//print_r($idActividades);
			    			
			    			//MAL MAL eliminar actividades actualmente relacionadas al ambiente.
			    			$idsActs = $this->m_ambiente_actividad->traerIdsActs($idAmb);
			    			foreach ($idsActs as $value) {
			    				$idsActs2[]= $value["idActividad"];
			    			}

			    			for ($i=0; $i < count($idsActs2) ; $i++) { 
			    				$this->m_ambiente_actividad->eliminar($idsActs2[$i],$idAmb);
			    			}			    			

			    			$this->m_actividad->eliminar($idsActs2);


				    		//cambiar el tipo de ambiente.
				    		$this->m_ambiente->actualizarTipo(array("fk_idTipoAmbiente" => $this->m_ambiente->idTipoAmbiente($_POST["tipoA"])["idTipoAmbiente"]),$idAmb);
				    		//traer las actividades precargadas del nuevo ambiente.
				    		$actPreCargadas = $this->m_ambiente->traer_actividadesPrecargadasAmbienteClon($_POST["tipoA"]);
				    		//agregando las nuevas actividades.
				    		foreach ($actPreCargadas as $value) {
					    		$agregado = 0;
					    		for ($i=1; $i < sizeof($idActividades); $i++) {
					    			if ((int)$idActividades[$i] == $value['idActividad']) {
					    				$agregado = 1;
					    			}
					    		}
					    		$value['idActividad']="";
					    		$idNuevaAct = $this->m_actividad->insertarActividad($value);
					    		$datosAmbAct = array("agregado" => $agregado,"fk_idAmbiente" => $idAmb,"fk_idActividad" => $idNuevaAct);
					    		$idNuevaAmbAct = $this->m_ambiente_actividad->insertarAmbienteActividad($datosAmbAct);
					    	}

			    		}
			    		echo "tipoActualizacion ->> ".$tipoActualizacion;			    		
			    	}
					//print_r($idActividades);
			    	$this->load->view('nav1',$this->session->userdata);
					$this->load->view('administrarAmbientes/administrarAmbientes');	   

			    }
			}else{
				$this->load->view('accesoDenegado');
			}
		}else{
			$this->load->view('login');
		}
	}

	public function abrir_administrarAmbientes(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {	
			if ($this->session->userdata['idPS']!=-1) {
				if ($this->session->userdata['fk_idRol']==4) {
					$this->load->view('nav1',$this->session->userdata);
					$this->load->view('administrarAmbientes/administrarAmbientes');
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

	public function abrir_modificarAmbiente(){
		$mod = 0;
		if (isset($this->session->userdata['nombUsuario'])) {	
			if ($this->session->userdata['idPS']!=-1) {
				if ($this->session->userdata['fk_idRol']==4) {
					$idAmb=$_POST["idAmb"];
					$amb= $this->m_ambiente->traer_ambiente($idAmb);
					$actAmb = $this->m_actividad->traer_actividadesxAmb($idAmb);
					$tabla="";
					foreach ($actAmb as $value) {
						$tabla.= "<tr class='text-center'><td>".$value["nombActividad"]."</td><td>".$value["descActividad"]."</td>";
						if ($value["agregado"]==0) {
							$tabla.= "<td><div class='checkbox'><label><input name='idActividad[]'  value='".$value["idActividad"]."' type='checkbox'></label></div></td>";
						}else{
							$num=count($this->m_actividad->actividad_noModificable_mat($value["idAmbiente_actividad"]))+count($this->m_actividad->actividad_noModificable_tra($value["idAmbiente_actividad"]));
							//print_r($num);
							if($num<1){
								$tabla.= "<td><div class='checkbox'><label><input name='idActividad[]'  value='".$value["idActividad"]."' type='checkbox' checked='checked'></label></div></td>";
							}else{
								$mod = 1;
								$tabla.= "<td class='danger'>*No modificable.<br>(Agregado)</td>";
							}
						}
						$tabla.= "</tr>";
					}	
					
					$this->array_put_to_position($amb, $tabla, 0, 'tabla');
					$this->array_put_to_position($amb, $mod, 0, 'mod');
					$this->array_put_to_position($amb, $idAmb, 0, 'idAmb');
					
					$this->load->view('administrarAmbientes/modificarAmbiente', $amb);
					//print_r($amb);
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

	public function abrir_agregarAmbiente(){
		$this->load->view('head');
		if (isset($this->session->userdata['nombUsuario'])) {	
			if ($this->session->userdata['idPS']!=-1) {
				if ($this->session->userdata['fk_idRol']==4) {
					$this->load->view('nav1',$this->session->userdata);
					$this->load->view('administrarAmbientes/agregarAmbiente');
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

	public function traer_ambientePrecargado(){
		$datos = $this->m_ambiente->traer_ambientePrecargado();
		echo '<option value="">Seleccionar...</option>';
		foreach ($datos as $value) {
			echo '<option class="ta-'.$value["idTipoAmbiente"].'" value="'.$value["idAmbiente"].'">'.$value["nombTipoAmbiente"].'</option>';
		}
	}
	public function traer_actividadesPrecargadasAmbiente(){
		$idAmbiente = $_POST["idAmbiente"];
		$datos = $this->m_ambiente->traer_actividadesPrecargadasAmbiente($idAmbiente);
		foreach ($datos as $value) {
			echo "<tr class='text-center'><td>".$value["nombActividad"]."</td><td>".$value["descActividad"]."</td>";
			if ($value["agregado"]==0) {
				echo "<td><div class='checkbox'>
    						<label>
      							<input name='idActividad[]'  value='".$value["idActividad"]."' type='checkbox'>
    						</label>
  					      </div>
  					  </td>";
			}
			echo "</tr>";
		}
		//print_r($datos);
	}
	function array_put_to_position(&$array, $object, $position, $name = null)
	{
	        $count = 0;
	        $return = array();
	        foreach ($array as $k => $v) 
	        {   
	                // insert new object
	                if ($count == $position)
	                {   
	                        if (!$name) $name = $count;
	                        $return[$name] = $object;
	                        $inserted = true;
	                }   
	                // insert old object
	                $return[$k] = $v; 
	                $count++;
	        }   
	        if (!$name) $name = $count;
	        if (!$inserted) $return[$name];
	        $array = $return;
	        return $array;
	}

}