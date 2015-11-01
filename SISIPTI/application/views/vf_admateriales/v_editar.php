<div class="container" >
		  <div class="row">
             <div class="col-lg-12">
         	  	   <h1 class="page-header">
                           <div>
                            Editar Trabajador
				</div>
                        </h1>
<?= form_open("/cf_admateriales/c_admateriales/actualizar/".$id."/".$idT)?><?php
	
	$nombre = array(
		'name' => 'nombre',
		'placeholder' => 'Escribe tu nombre',
		'class'=>'form-control',
		'value'=>"$datos->nombMaterial"
		);


	$precio = array(
		'name' => 'precio',
		'placeholder' => 'ingresar precio',
		'class'=>'form-control',
		'value'=>"$datos->precioMaterial"
		);
	$tipo = array(
		'name' => 'tipo',
		'placeholder' => 'ingresar tipo',
		'class'=>'form-control',
		'value'=>"$datos->descTipoMaterial"
		);

    $cantidad = array(
    'name' => 'cantidad',
    'placeholder' => 'Ingresar la cantidad',
    'class'=>'form-control',
    'value'=>"$datos->Cantidad",
    'type' =>'number'
    );

?>                        
                
				<br>
         	
					
				<div class="form-group">
					<label>Nombres </label>
					<?= form_input($nombre)?>
				</div>		

				<div class="form-group">
                    <label>Proveedores: </label>
                    <select name="proveedores" id="estado" class="form-control">

                        
                       
                       <?php
                       $dato=$this->m_admateriales->buscarNombre();
		
        				foreach($dato as $fila){
        				if($fila->idProveedor==$datos->fk_idProveedor){
                      	echo '<option value="'.$fila->idProveedor.'" selected>';
                       	echo $fila->nombPersona;
                       	echo '</option>';

                    	}  
                    	if($fila->idProveedor!=$datos->fk_idProveedor){

                    	echo '<option value="'.$fila->idProveedor.'" >';
                       	echo $fila->nombPersona;
                       	echo '</option>';
                       }
                   }

                       	?>
                    </Select>
                </div>

				<div class="form-group">
					<label>Precio Unitario</label>
					<?= form_input($precio)?>
				</div>
  
        <label>Tipo: </label>
                    

        <select name="tipo" id="tipo" class="form-control">

      <?php
            if($datos->fk_idTipoMaterial==1){
                       
              echo '<option value="'.$datos->fk_idTipoMaterial.'" selected>';
                          echo 'construccion';
                          echo '</option>';
                          echo '<option value="2" >';
                          echo 'Insumos de red';
                          echo '</option>';
                          echo '<option value="3" >';
                          echo 'Componentes electricos';
                          echo '</option>';
                        
                         }

                          if($datos->fk_idTipoMaterial==2){
                          echo '<option value="'.$datos->fk_idTipoMaterial.'" selected>';
                          echo 'Insumos de red';
                          echo '<option value="1" >';
                          echo 'construccion';
                          echo '</option>';
                          echo '<option value="3" >';
                          echo 'Componentes electricos';
                          echo '</option>';
                        
                         }
                          if($datos->fk_idTipoMaterial==3){
                          echo '<option value="'.$datos->fk_idTipoMaterial.'" selected>';
                          echo 'Componentes electricos';
                          echo '<option value="1" >';
                          echo 'construccion';
                          echo '</option>';
                          echo '<option value="2" >';
                          echo 'Insumos de red';
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
                    <select name="medida" id="estado" class="form-control">
                        <option value="Seleccionar" selected>Seleccionar</option>
                       	<?php
                       if(isset($datos->unidadMaterial)){
                       		if($datos->unidadMaterial==1){
                       
							echo '<option value="'.$datos->unidadMaterial.'" selected>';
                       		echo 'kg';
                       		echo '</option>';
                       		echo '<option value="2" >';
                       		echo 'm';
                       		echo '</option>';
                       		echo '<option value="3" >';
                       		echo 'T';
                       		echo '</option>';
                       		echo '<option value="4" >';
                       		echo 'Lt';
                       		echo '</option>';
                     		 }

                       		if($datos->unidadMaterial==2){
							echo '<option value="'.$datos->unidadMaterial.'" selected>';
                       		echo 'm';
                       		echo '<option value="1" >';
                       		echo 'kg';
                       		echo '</option>';
                       		echo '<option value="3" >';
                       		echo 'T';
                       		echo '</option>';
                       		echo '<option value="4" >';
                       		echo 'Lt';
                       		echo '</option>';
                     		 }

                       		if($datos->unidadMaterial==3){
							echo '<option value="'.$datos->unidadMaterial.'" selected>';
                       		echo 'T';
                       		echo '<option value="1" >';
                       		echo 'kg';
                       		echo '</option>';
                       		echo '<option value="2" >';
                       		echo 'm';
                       		echo '</option>';
                       		echo '<option value="4" >';
                       		echo 'Lt';
                       		echo '</option>';
                     		 }

                       		if($datos->unidadMaterial==4){
							echo '<option value="'.$datos->unidadMaterial.'" selected>';
                       		echo 'Lt';
                       		echo '</option>';
                       		echo '<option value="1" >';
                       		echo 'kg';
                       		echo '</option>';
                       		echo '<option value="2" >';
                       		echo 'm';
                       		echo '</option>';
                       		echo '<option value="3" >';
                       		echo 'T';
                       		echo '</option>';
                     		 }
                        }
                   
           

						
        			
                    	  ?>
                    </Select>
                </div>


					<br>
					<br>
			
					<div >
						<button type="submit" class="btn btn-success btn-lg btn-block">Actualizar</button>		
					</div>
				</div>
			</div>


	   		<?= form_open("/cf_admateriales/c_admateriales/index")?>
	   			 <br>
	   				<div>
	   					<button type="submit" name="cancel" class="btn btn-danger btn-lg btn-block">Cancelar</button>
	   				</div>
	   		
	   		<?= form_close() ?>	
	   		

	   		
	</body>
</html>
