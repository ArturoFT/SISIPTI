<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Agregar Proyecto</h3>
	  </div>
	  <div class="panel-body">
	  
			<?php $this->load->helper('form');echo form_open_multipart("crear/proyecto");?>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				  <div class="form-group">
				    <label>Nombre del proyecto:<?php echo form_error('nombreP');?></label>
				    <input type="text" class="form-control" placeholder="Nombre" name="nombreP" value="<?php echo set_value('nombreP'); ?>">
				  </div>
				  <div class="form-group">
				    <label>Dirección del proyecto:<?php echo form_error('direccionP');?></label>
				    <input type="text" class="form-control" placeholder="Dirección" name="direccionP" value="<?php echo set_value('direccionP'); ?>">
				  </div>
				  <div class="form-group">
				    <label>Fecha de inicio del proyecto:<?php echo form_error('fechaInicioP');?></label>
				    <input readonly="readonly" id="fechaInicioP" type="text" class="form-control" placeholder="Fecha inicio" name="fechaInicioP" value="<?php echo set_value('fechaInicioP'); ?>">
				  </div>
				  <div class="form-group">
				    <label>Alcance:<?php echo form_error('alcanceP');?></label>
				    <textarea class="form-control" name="alcanceP" placeholder="..." value="<?php echo set_value('alcanceP'); ?>"></textarea>
				  </div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				  <div class="form-group">
				    <label>Exclusiones:<?php echo form_error('exclusionesP');?></label>
				    <textarea class="form-control" name="exclusionesP" placeholder="..." value="<?php echo set_value('exclusionesP'); ?>"></textarea>
				  </div>
				  <div class="form-group">
				    <label>Presupuesto del proyecto:<?php echo form_error('presupuestoP');?></label>
				    <input type="text" class="form-control" placeholder="S/." name="presupuestoP" value="<?php echo set_value('presupuestoP'); ?>">
				  </div>
				  <div class="form-group">
				    <label>Tipo de proyecto:<?php echo form_error('tipoP');?></label>
				    <select id="tipoP" class="form-control" name="tipoP">
				    <option value="">Seleccionar...</option>
				    <select>
				  </div>
				  <div class="form-group">
				    <label>Cliente del proyecto:<?php echo form_error('clienteP');?></label>
				    <select id="clienteP" class="form-control" name="clienteP">
				    <option value="">Seleccionar...</option>
				    <select>
				  </div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  <div class="form-group text-right">
				  	<a href="<?php echo base_url()."index.php/crear/proyecto";?>"><button type="submit" class="btn btn-primary">Crear</button></a>
				    <a href="<?php echo base_url()."index.php/abrir/listaProyectos";?>"><button type="button" class="btn btn-danger">Cancelar</button></a>
				  </div>
			 	</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		traerTipoProyecto();
		traerClienteProyecto();
	});

	function traerTipoProyecto(){
		var ruta = "<?= base_url().'index.php/traer/tipoProyecto';?>";
		$.ajax({
		  type:'POST',
		  url: ruta,
		  data: '',
		  success: function(data){
		    $('#tipoP').html(data);
		  }
		});
	}
	function traerClienteProyecto(){
		var ruta = "<?= base_url().'index.php/traer/clienteProyecto';?>";
		$.ajax({
		  type:'POST',
		  url: ruta,
		  data: '',
		  success: function(data){
		    $('#clienteP').html(data);
		  }
		});
	}
	$(function() {
        $("#fechaInicioP").datepicker({dateFormat: 'yy-mm-dd', 
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