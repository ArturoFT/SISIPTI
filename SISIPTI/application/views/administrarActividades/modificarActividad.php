<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
	<div class="panel panel-warning">
	  <div class="panel-heading">
	    <h3 class="panel-title">Modificar Actividad</h3>
	  </div>
	  <div class="panel-body">
	  
			<?php $this->load->helper('form');echo form_open_multipart("modificar/actividad",array("id"=>"idMActividad"));?>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				  	<div class="form-group">
					    <label>Nombre: <?php echo form_error('nombreA');?></label>
					    <input id="inputNombre" type="text" class="form-control" placeholder="Nombre" name="nombreA" value="<?php echo set_value('nombreA'); ?>">
				  	</div>
				  	<div class="form-group">
				    	<label>Descripción: <?php echo form_error('descA');?></label>
				    	<textarea id="inputDesc" class="form-control" name="descA" placeholder="..." value="<?php echo set_value('descA'); ?>"></textarea>
				  	</div>
				  	<div class="form-group">
				    	<label>Prioridad: <?php echo form_error('prioridad');?></label>
					    <input id="prioridad" type="number" class="form-control" placeholder="Prioridad" name="prioridad" value="<?php echo set_value('prioridad'); ?>">
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
				  		<input id="idAct" name="idAct" type="hidden">
				  	</div>	

				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  <div class="form-group text-right">
				  	<button type="submit" class="btn btn-warning">Guardar</button>
				    <a href="<?php echo base_url()."index.php/abrir/administrarAmbientes";?>"><button type="button" class="btn btn-danger">Cancelar</button></a>
				  </div>
			 	</div>
			</form>
	  </div>
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
	<div class="panel panel-info">
	  <div class="panel-heading">
	    <h3 class="panel-title">Trabajadores Relacionados</h3>
	  </div>
	  <div class="panel-body">
	  		<div class="table-responsive">
				<table id="trabajadores" class="table table-hover table-bordered table-striped">
			  		<thead>
				        <tr>
				          <th class="text-center">Nombre y Apellido</th>
				          <th class="text-center">Cargo</th>
				        </tr>
			      	</thead>
			      	<tbody>
			      		
			      	</tbody>
				</table>
			</div>
	  </div>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function(){
		var inputNombre = <?php if(isset($nombActividad)){ echo "'".$nombActividad."'"; }else{echo "''";}?>;
		$("#inputNombre").val(inputNombre);
		var inputDesc = <?php if(isset($descActividad)){ echo "'".$descActividad."'"; }else{echo "''";}?>;
		$("#inputDesc").val(inputDesc);
		var prioridad = <?php if(isset($prioridadActividad)){ echo "'".$prioridadActividad."'"; }else{echo "''";}?>;
		$("#prioridad").val(prioridad);

		var fechaInicioA = <?php if(isset($fechaIniActividad)){ echo "'".$fechaIniActividad."'"; }else{echo "''";}?>;
		$("#fechaInicioA").val(fechaInicioA);
		var fechaReaA = <?php if(isset($fechaRealizacionActividad)){ echo "'".$fechaRealizacionActividad."'"; }else{echo "''";}?>;
		$("#fechaReaA").val(fechaReaA);
		var fechaFinA = <?php if(isset($fechaFinActividad)){ echo "'".$fechaFinActividad."'"; }else{echo "''";}?>;
		$("#fechaFinA").val(fechaFinA);

		var idAct = <?php if(isset($idActividad)){ echo "'".$idActividad."'"; }else{echo "''";}?>;
		$("#idAct").val(idAct);

		var tabla = <?php if(isset($tabla)){ echo "'".$tabla."'"; }else{echo "''";}?>;
		$("#trabajadores tbody").html(tabla);
		
	});

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