<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Agregar Actividad</h3>
	  </div>
	  <div class="panel-body">
	  
			<?php $this->load->helper('form');echo form_open_multipart("crear/actividad",array("id"=>"idNActividad"));?>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				  	<div class="form-group">
					    <label>Nombre: <?php echo form_error('nombreA');?></label>
					    <input type="text" class="form-control" placeholder="Nombre" name="nombreA" value="<?php echo set_value('nombreA'); ?>">
				  	</div>
				  	<div class="form-group">
				    	<label>Descripción: <?php echo form_error('descA');?></label>
				    	<textarea class="form-control" name="descA" placeholder="..." value="<?php echo set_value('descA'); ?>"></textarea>
				  	</div>
				  	<div class="form-group">
				    	<label>Prioridad: <?php echo form_error('prioridad');?></label>
					    <input type="number" class="form-control" placeholder="Prioridad" name="prioridad" value="<?php echo set_value('prioridad'); ?>">
				  	</div>

				  	<div class="form-group">
				    	<label>Fecha de inicio: <?php echo form_error('fechaInicioA');?></label>
				    	<input readonly="readonly" id="fechaInicioA" type="text" class="form-control" placeholder="Fecha inicio" name="fechaInicioA" value="<?php echo set_value('fechaInicioA'); ?>">
				  	</div>				  
				</div>				

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				  	<div class="form-group">
				    	<label>Fecha de Realización: <?php echo form_error('fechaReaA');?></label>
				    	<input readonly="readonly" id="fechaReaA" type="text" class="form-control" placeholder="Fecha de Realización" name="fechaReaA" value="<?php echo set_value('fechaReaA'); ?>">
				  	</div>
				  	<div class="form-group">
				    	<label>Fecha fin: <?php echo form_error('fechaFinA');?></label>
				    	<input readonly="readonly" id="fechaFinA" type="text" class="form-control" placeholder="Fecha Fin" name="fechaFinA" value="<?php echo set_value('fechaFinA'); ?>">
				  	</div>	

				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  <div class="form-group text-right">
				  	<button type="submit" class="btn btn-primary">Crear</button>
				    <a href="<?php echo base_url()."index.php/abrir/administrarAmbientes";?>"><button type="button" class="btn btn-danger">Cancelar</button></a>
				  </div>
			 	</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
        $("#fechaInicioA").datepicker({dateFormat: 'yy-mm-dd', 
                                showOtherMonths: true, 
                                selectOtherMonths: true});
    });
    $(function() {
        $("#fechaReaA").datepicker({dateFormat: 'yy-mm-dd', 
                                showOtherMonths: true, 
                                selectOtherMonths: true});
    });
    $(function() {
        $("#fechaFinA").datepicker({dateFormat: 'yy-mm-dd', 
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