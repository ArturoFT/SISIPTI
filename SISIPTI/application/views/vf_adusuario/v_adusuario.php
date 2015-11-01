 <?php $usuario = array(
		'name' => 'usuario',
		'placeholder' => 'Escribe tu usuario',
		'class'=>'form-control'
		
		);

	$contraseña = array(
		'name' => 'contrasena',
		'placeholder' => 'ingresar contraseña',
		'class'=>'form-control',
    'type'=>'password'
		); 
 ?>

 <div class="container" >
         <div class="row" align="center">
           <h1 class="page-header">
               S I S I P T I
           </h1>
 		</div>
 		
 		 <p>
       <button class="btn btn-success" data-toggle="modal" data-target="#Nuevo">Crear nuevo</button>
         </p>
 		
	 <br>
	 

	<div>
		<?= $tabla;?>
	</div>

</div>



		<!-- Ajax -->	
 <form action="http://localhost/SISIPTI/index.php/cf_adusuario/c_adusuario/insertar" data-toggle="validator" role="form" method="post"  >
 <div class="modal fade" id="Nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Nuevo</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center">CREAR USUARIO</h4>
      </div>
      <div id="nuevaA" class="modal-body">
            <form role="form">
              <div class="form-group">
           <div class="form-group">
				
           	<div class="form-group">
					<label>USUARIO</label>
					<?= form_input($usuario,'','required')?>
			</div>

			<div class="form-group">
					<label>CONTRASEÑA </label>
					<?= form_input($contraseña,'','required')?>
			</div>

  			<div class="form-group">
                    <label>ROL </label>
                    <select name="rol" id="estado" class="form-control">
                        <option value="Seleccionar" selected>Seleccionar</option>
                        <option value="1">Cliente</option>
                        <option value="2">Ingeniero</option>
                    	<option value="3">Jefe de Proyectos</option>
                    	<option value="4">Administrador</option>
                    </select> 
             </div> 

		
			  
			  
			  
           </form>      
      </div>
      <div class="modal-footer" align="center"> 
      <button type="submit" class="btn btn-success btn-lg btn-block"  name="insertarRecursos">Aceptar</button>		
					
	   
        <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Cerrar</button>
              
      </div>
    </div>
  </div>

</div>

	 </form>