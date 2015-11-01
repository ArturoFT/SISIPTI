<div class="container">
	<div id="login" class="col-md-12">
		<div class="col-xs-12 col-sm-12    col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6" >
		
			<div id="primera" class="page-body" >
				<H1 class="cabecera-1">SISIPTI</H1>
				<div class="uCabecera-prim"></div>
					<div class="panel panel-default panel-login" style="divLoggin">
					  <div class="panel-body">
					    <?php $this->load->helper('form');echo form_open_multipart("login");?>
							<!-- imagen de Usuario-->
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
								<img src="<?php echo base_url().'/public/img/images-Loggin.jpg';?>" class="imagen-loggin">
							</div>
							<div class="interio-Loggin col-xs-12  col-sm-8 col-md-8 col-lg-8">
							  	<div class="form-group">
								    <?php echo form_error('usuario');if(isset($error)){echo $error;};?>
								    <input type="text" value="<?php echo set_value('usuario'); ?>" class="form-control" id="usuario" name="usuario" placeholder="Nombre">
							  	</div>
							  	<div class="form-group">
								    <?php echo form_error('clave');if(isset($error)){echo $error;};?>
								    <input type="password" value="<?php echo set_value('clave'); ?>" class="form-control" id="clave"  name="clave" placeholder="Constraseña">
							  	</div>
							  	<button class="btn btn-primary" type="submit">Ingresar</button>
							</div>	
					  	</form>
					  </div>
					</div>
				<div class="uFinal-prim"></div>		
			</div>
		</div>
	</div>	
</div>
