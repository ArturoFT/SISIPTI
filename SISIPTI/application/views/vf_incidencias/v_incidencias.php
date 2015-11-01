<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Registrar Incidencia</h3>
	  </div>
	  <div class="panel-body">
	  
			<?php $this->load->helper('form');echo form_open_multipart("agregar/registrarIncidencias");?>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">			
				  <div class="form-group">
				    <label>Titulo:<?php echo form_error('titulo');?></label>
				    <input type="text" class="form-control" placeholder="Ingresar Titulo" name="titulo" value="<?php echo set_value('titulo'); ?>" required>
				  </div>
				  <div class="form-group">
				    <label>Descripcion:<?php// echo form_error('descripcion');?></label>
				    <textarea class="form-control" name="descripcion" placeholder="..." value="<?php echo set_value('descripcion'); ?>" required></textarea>
				  </div>
				  <div class="form-group">
				    <label>Fecha de Incidencia:<?php //echo form_error('fechaInicioI');?></label>
				    <input readonly="readonly" id="fechaInicioI" type="text" class="form-control" placeholder="Fecha inicio" name="fechaInicioI" value="<?php echo set_value('fechaInicioI'); ?>" required>
				  </div>
				  <?php 
				  $idA=$_POST['idAmb'];
				  if(isset($idA)){?>
				<div class="form-group">				
				    <input type="hidden" class="form-control"  name="idAm" value="<?php echo  $idA; ?>" required>
				 </div>
				 <?php }?>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				  <div class="form-group">
				    <label>Actividades involucradas:<?php echo form_error('actividadIn');?></label>
				    <input type="text" class="form-control" placeholder="Ingresar Actividad" name="actividadIn" value="<?php echo set_value('actividadIn'); ?>" required>
				  </div>
				  
				  <div class="form-group">
				    <label>Plan de Respuesta:<?php echo form_error('planR');?></label>
				    <textarea class="form-control" name="planR" placeholder="..." value="<?php echo set_value('planR'); ?>" required></textarea>
				  </div>

				  <div class="form-group">
				    <label>Detalles Adicionales:<?php echo form_error('detallesA');?></label>
				    <textarea class="form-control" name="detallesA" placeholder="detalle..." value="<?php echo set_value('detallesA'); ?>" required></textarea>
				  </div>

				
				
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  <div class="form-group text-right">
				  	<a href="<?php echo base_url()."index.php/agregar/registrarIncidencias";?>"><button type="submit" class="btn btn-primary" >Crear</button></a>
				    <a href="<?php echo base_url()."index.php/abrir/administrarAmbientes";?>"><button type="button" class="btn btn-danger">Cancelar</button></a>
				  </div>
			 	</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	

	$(function() {
        $("#fechaInicioI").datepicker({dateFormat: 'yy-mm-dd', 
                                showOtherMonths: true, 
                                selectOtherMonths: true});
    });
    $(function($){
        $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear:false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    }); 
</script>