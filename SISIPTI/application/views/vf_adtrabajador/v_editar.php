

<div class="container" >
		  <div class="row">
             <div class="col-lg-12">
         	  	   <h1 class="page-header">
                           <div>
                            Editar Trabajador
				</div>
                        </h1>
<?= form_open("/cf_adtrabajador/c_admtrabajador/actualizar/".$id."/".$idc)?><?php
	$nombre = array(
		'name' => 'nombre',
		'placeholder' => 'Escribe tu nombre',
		'class'=>'form-control',
		'value'=>"$datos->nombPersona"
		
		);

	$direccion = array(
		'name' => 'direccion',
		'placeholder' => 'Escribe la direccion',
		'class'=>'form-control',
		'value'=>"$datos->dirPersona"
		);
	$telefono = array(
		'name' => 'telefono',
		'placeholder' => 'Escribe el telefono',
		'class'=>'form-control',
		'value'=>"$datos->telefPersona"
		);
	$email = array(
		'name' => 'email',
		'placeholder' => 'Escribe el email',
		'class'=>'form-control',
		'value'=>"$datos->emailPersona"
		);
	$numerodoc = array(
		'name' => 'numerodoc',
		'placeholder' => 'Escribe el numero de documento',
		'class'=>'form-control',
		'value'=>"$datos->nroDocPersona"
		);	

	$nacionalidad = array(
		'name' => 'nacionalidad',
		'placeholder' => 'Escriba nacionalidad',
		'class'=>'form-control',
		'value'=>"$datos->nacionalidadTrabajador"
		);

	$sueldo = array(
		'name' => 'sueldo',
		'placeholder' => 'ingrese sueldo',
		'class'=>'form-control',
		'value'=>" $datos->sueldoTrabajador"
		);
	$cargo = array(
		'name' => 'cargo',
		'placeholder' => 'ingresar cargo',
		'class'=>'form-control',
		'value'=>" $datos->nombCargo"
		);


?>               
  				<div class="form-group">
					<label>Nombre</label>
					<?= form_input($nombre,'','required')?>
				</div>         
                
                <div class="form-group">
					<label>Telefono</label>
					<?= form_input($telefono,'','required')?>
				</div>

				<div class="form-group">
					<label>Direccion</label>
					<?= form_input($direccion,'','required')?>
				</div>

				<div class="form-group">
                    <label>Tipo de documento </label>
                    <select name="doc" id="doc" class="form-control" required>
                      
                        <?php if($datos->tipoDocPersona==1){
                       		echo '<option value="'.$datos->tipoDocPersona.'" selected>';
                        	echo 'DNI';
                        	echo '</option>';
                        	echo '<option value="2" >';
                        	echo 'Pasaporte';
                        	echo '</option>';

                        	}if($datos->tipoDocPersona==2){
                        	echo '<option value="'.$datos->tipoDocPersona.'" selected>';
                        	echo 'Pasaporte';
                        	echo '</option>';
                        	echo '<option value="1">';
                        	echo 'DNI';
                        	echo '</option>';
                        	}?>
                                        	
                    </select> 
                </div>        

         	  	<div class="form-group">
					<label>Numero de Documento</label>
					<?= form_input($numerodoc,'','required')?>
				</div>

				<div class="form-group">
					<label>Email </label>
					<?= form_input($email,'','required')?>
				</div>	

         	  	<div class="form-group">
					<label>Nacionalidad</label>
					<?= form_input($nacionalidad,'required')?>
				</div>
					

				<div class="form-group">
                    <label>Sexo </label>
                    <select name="sexo" id="estado" class="form-control">
                      
                        <?php if($datos->sexoTrabajador==1){
                       		echo '<option value="'.$datos->sexoTrabajador.'" selected>';
                        	echo 'M';
                        	echo '</option>';
                        	echo '<option value="2" >';
                        	echo 'F';
                        	echo '</option>';

                        	}if($datos->sexoTrabajador==2){
                        	echo '<option value="'.$datos->sexoTrabajador.'" selected>';
                        	echo 'F';
                        	echo '</option>';
                        	echo '<option value="1">';
                        	echo 'M';
                        	echo '</option>';
                        	}?>
                                        	
                    </select> 
                </div>   		

				<div class="form-group">
					<label>Sueldo </label>
					<?= form_input($sueldo,'required')?>
				</div>

				<div class="form-group">
					<label>Cargo </label>
					<?= form_input($cargo,'','required')?>
				</div>	

				<div class="form-group">
                    <label>Cargo </label>
                    <select name="cargo" id="estado" class="form-control" required>
                      
                        <?php if($datos->idCargo==4){
                       		echo '<option value="'.$datos->idCargo.'" selected>';
                        	echo 'jefe de proyecto';
                        	echo '</option>';
                        	echo '<option value="5" >';
                        	echo 'Ingeniero';
                        	echo '</option>';
                        	echo '<option value="6" >';
                        	echo 'Obrero';
                        	echo '</option>';

                        	}if($datos->idCargo==5){
                        	echo '<option value="'.$datos->idCargo.'" selected>';
                        	echo 'Ingeniero';
                        	echo '</option>';
                        	echo '<option value="4">';
                        	echo 'jefe de proyecto';
                        	echo '</option>';
                        	echo '<option value="6" >';
                        	echo 'Obrero';
                        	echo '</option>';

                        	}if($datos->idCargo==6){
                        	echo '<option value="'.$datos->idCargo.'" selected>';
                        	echo 'Obrero';
                        	echo '</option>';
                        	echo '<option value="5">';
                        	echo 'Ingeniero';
                        	echo '</option>';
                        	echo '<option value="4">';
                        	echo 'jefe de proyecto';
                        	echo '</option>';
                        	}?>
                                        	
                    </select> 
                </div>			

					<br>
					<br>
			
					<div >
						<button type="submit" class="btn btn-success btn-lg btn-block">Actualizar</button>		
					</div>
				</div>
			</div>
			
		</form>
			
		

	   		<?= form_open("/cf_adtrabajador/c_admtrabajador/index")?>
	   					<button type="submit" name="cancel" class="btn btn-danger btn-lg btn-block">Cancelar</button>
	   		<?= form_close() ?>	
	   		
	
	   		
	</body>
</html>

