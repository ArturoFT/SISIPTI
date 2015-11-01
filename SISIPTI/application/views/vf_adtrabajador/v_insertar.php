 <script type="text/javascript"  src="<?php echo base_url()."public/js/funciones.js";?>"></script>

<form action="http://localhost/SISIPTI/index.php/cf_adtrabajador/c_admtrabajador/insertar" data-toggle="validator" role="form" method="post"  accept-charset="utf-8" class="form-horizontal"> <div class="container" >
<?php

	$nombre = array(
		'id'=>'nombre',
		'name' => 'nombre',
		'placeholder' => 'Escribe tu nombre',
		'class'=>'form-control'
		
		);


	$nacionalidad = array(
		'id'=>'nacionalidad',
		'name' => 'nacionalidad',
		'placeholder' => 'Escribe tu nacionalidad',
		'class'=>'form-control'
		);

	$sueldo = array(
		'id'=>'sueldo',
		'name' => 'sueldo',
		'placeholder' => 'Escribe el sueldo',
		'class'=>'form-control'

		);
	$profesion = array(
		'id'=>'profesion',
		'name' => 'profesion',
		'placeholder' => 'Escribe su profesion',
		'class'=>'form-control'

		);

	$direccion = array(
		'id'=>'direccion',
		'name' => 'direccion',
		'placeholder' => 'Escribe la direccion',
		'class'=>'form-control'
		);

	$cargo = array(
		'id'=>'cargo',
		'name' => 'cargo',
		'placeholder' => 'Escribe el cargo',
		'class'=>'form-control'
		);

	$telefono = array(
		'id'=>'telefono',
		'name' => 'telefono',
		'placeholder' => 'Escribe el telefono',
		'class'=>'form-control',
		'type'=> 'number'
		);
	$email = array(
		'id'=>'email',
		'name' => 'email',
		'placeholder' => 'Escribe el email',
		'class'=>'form-control',
		'type' => 'email'
		);
	$numerodoc = array(
		'id'=>'numerodoc',
		'name' => 'numerodoc',
		'placeholder' => 'Escribe el numero de documento',
		'class'=>'form-control',
		'type'=>'number'
		);

?>
 <div class="container" >
		  <div class="row">
             <div class="col-lg-12">
         	  	   <h1 class="page-header">
                            Nuevo Trabajador
                        </h1>
                

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
                    <select name="doc" id="estado" class="form-control" required>
                        <option value="Seleccionar" selected>Seleccionar</option>
                        <option value="1">DNI</option>
                        <option value="2">Pasaporte</option>
                    	
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
					<label>Profesion </label>
					<?= form_input($profesion,'','required')?>
				</div>
			

				<div class="form-group">
					<label>Nacionalidad </label>
					<?= form_input($nacionalidad,'','required')?>
				</div>		
							

				<div class="form-group">
                    <label>Sexo </label>
                    <select name="sexo" id="estado" class="form-control" required>
                        <option value="Seleccionar" selected>Seleccionar</option>
                        <option value="1">M</option>
                        <option value="2">F</option>
                    	
                    </select> 
                </div>  




				<div class="form-group">
					<label>Sueldo </label>
					<?= form_input($sueldo,'','required')?>
				</div>

				<div class="form-group">
					<label>Cargo </label>		
                    <select name="cargo" id="cargo" class="form-control">

                        <option value="Seleccionar" selected>Seleccionar</option>
                       <?php
                       $datos=$this->m_adtrabajador->buscarCargo();
		
        				foreach($datos as $fila){
                      	echo '<option value="'.$fila->idCargo.'">';
                       	echo $fila->nombCargo;
                       	echo '</option>';
                       }

                       	?>
                    </Select>
				</div>
			

					<br>
					<br>
			
					<div >
						<button type="submit" class="btn btn-success btn-lg btn-block">Aceptar</button>		
					</div>
				</div>
			</div>
		</div>	
	   	</form>
	   	<br>	
	   		<?= form_open("/cf_adtrabajador/c_admtrabajador/index")?>
	   			<div class="container">
	   				
	   					<button type="submit" name="cancel" id="enviar" class="btn btn-danger btn-lg btn-block">Cancelar</button>
	   				
	   			</div>
	   		<?= form_close() ?>	
	</body>
</html>
