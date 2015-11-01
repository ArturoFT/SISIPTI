<form action="http://localhost/SISIPTI/index.php/cf_admateriales/c_admateriales/insertar" role="form" method="post" accept-charset="utf-8" class="form-horizontal"> <div class="container" >
<?php
	$nombre = array(
		'name' => 'nombre',
		'placeholder' => 'Escribe tu nombre',
		'class'=>'form-control'
		);

	$precio = array(
		'name' => 'precio',
		'placeholder' => 'Ingresa el precio',
		'class'=>'form-control',
	

		);
	$tipo = array(
		'name' => 'tipo',
		'placeholder' => 'Ingresa el tipo de material',
		'class'=>'form-control'
		);

	$cantidad = array(
		'name' => 'cantidad',
		'placeholder' => 'Ingresar la cantidad',
		'class'=>'form-control',
		'type' =>'number'
		);


			
?>
 <div class="container" >
		  <div class="row">
             <div class="col-lg-12">
         	  	   <h1 class="page-header">
                            Nuevo Material
                        </h1>

				<div class="form-group">
					<label>Nombre Material </label>
					<?= form_input($nombre,'','required')?>
				</div>		

				<div class="form-group">
                    <label>Proveedores: </label>
                    <select name="proveedores" id="estado" class="form-control" required>

                        <option value="Seleccionar" selected>Seleccionar</option>
                       <?php
                       $datos=$this->m_admateriales->buscarNombre();
		
        				foreach($datos as $fila){
                      	echo '<option value="'.$fila->idProveedor.'">';
                       	echo $fila->nombPersona;
                       	echo '</option>';
                       }

                       	?>
                    </Select>
                </div>

				<div class="form-group">
					<label>Precio Unitario</label>
					<?= form_input($precio,'','required')?>
				</div>

			
				<div class="form-group">
                    <label>Tipo: </label>
                    <select name="tipo" id="estado" class="form-control" required>

                        <option value="Seleccionar" selected>Seleccionar</option>
                       <?php
                       $datos=$this->m_admateriales->buscarTipo();
		
        				foreach($datos as $fila){
                      	echo '<option value="'.$fila->idTipoMaterial.'">';
                       	echo $fila->descTipoMaterial;
                       	echo '</option>';
                       }

                       	?>
                    </Select>
                </div>


				<div class="form-group" >
					<label>Cantidad</label>
					<?= form_input($cantidad,'','required')?>
				</div>

					<div class="form-group">
                 <label>Unidad de medida: </label>
                    <select name="medida" id="estado" class="form-control" required>
                        <option value="Seleccionar" selected>Seleccionar</option>
                        <option value="kg">kg</option>
                        <option value="m">m</option>
                    	<option value="T">T</option>                   	
                    	<option value="Lt">Lt</option>
                    	<option value="Unid">Unid</option>
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
	   		<?= form_open("/cf_admateriales/c_admateriales/index")?>
	   			<div class="container">
	   				
	   					<button style="	display:none;" type="submit" name="cancel" class="btn btn-danger btn-lg btn-block">Cancelar</button>
	   				
	   			</div>
	   		<?= form_close() ?>	
	</body>
</html>
