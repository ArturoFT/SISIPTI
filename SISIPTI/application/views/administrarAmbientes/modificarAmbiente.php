<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
	<div class="panel panel-warning">
	  <div class="panel-heading">
	    <h3 class="panel-title">Modificar Ambiente <?php echo $mod ?></h3>
	  </div>
	  <div class="panel-body">
	  
			<?php $this->load->helper('form');echo form_open_multipart("modificar/ambiente",array("id"=>"idNAmbiente"));?>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="form-group" id="st">
					    <label>Tipo de Ambiente: <?php echo form_error('tipoA');?></label>
					    <select id="tipoA" class="form-control" name="tipoA" onchange="traerActividadesPrecargadas(this.id)">
					    	<option value="">Seleccionar...</option>
					    <select>
				  	</div>
				  	<div class="form-group">
					    <label>Nombre: <?php echo form_error('nombreA');?></label>
					    <input id="inputNombre" type="text" class="form-control" placeholder="Nombre" name="nombreA" value="<?php echo set_value('nombreA'); ?>">
				  	</div>
				  	<div class="form-group">
				    	<label>Descripción: <?php echo form_error('descA');?></label>
				    	<textarea id="inputDesc" class="form-control" name="descA" placeholder="..." value="<?php echo set_value('descA'); ?>"></textarea>
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
				  	<div class="form-group">
			    		<label>Ubicación:<?php echo form_error('ubicacionA');?></label>
				    	<input id="ubicacionA" type="text" class="form-control" placeholder="Ubicación" name="ubicacionA" value="<?php echo set_value('ubicacionA'); ?>">
				  	</div>

				  	<div class="form-group">
						<label>Precio de ambiente:<?php echo form_error('precioA');?></label>
					    <input id="precioA" type="text" class="form-control" placeholder="S/." name="precioA" value="<?php echo set_value('precioA'); ?>">
					    <input type="hidden" name="idActividades" id="idActividades">
					    <input type="hidden" name="mod" id="mod">
					    <input type="hidden" name="idAmb" id="idAmb">
					    <input type="hidden" name="tipoActualizacion" id="tipoActualizacion">
					</div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  <div class="form-group text-right">
				  	<button onclick="modificarAmbiente()" type="button" class="btn btn-warning">Modificar</button>
				    <a href="<?php echo base_url()."index.php/abrir/administrarAmbientes";?>"><button type="button" class="btn btn-danger">Cancelar</button></a>
				  </div>
			 	</div>
			</form>
		</div>
	</div>
	<div class="table-responsive">
		<table id="tablaActividadesPre" class="table table-hover table-bordered table-striped">
	  		<thead>
		        <tr>
		          <th class="text-center">Acitivdades pre - establecidas</th>
		          <th class="text-center">Detalle</th>
		          <th class="text-center">Agregar</th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		
	      	</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	var tipoActualizacion = 0;
	var saveTable = "<?php if (isset($tabla)) {echo $tabla;}else{echo "''";};?>"; 
	var mod = <?php if (isset($mod)) {echo $mod;}else{echo "''";};  ?>; 
	var idAmb = <?php if (isset($idAmb)) {echo $idAmb;}else{echo "''";};  ?>; 
	$("#mod").val(mod);
	$("#idAmb").val(idAmb);
	$(document).ready(function(){
		$("#tablaActividadesPre tbody").html(saveTable);
		

		if (mod) {
			$("#st").remove();
		}else{
			traerTipoAmbientes();
		}

		var inputNombre = <?php if(isset($nombAmbiente)){ echo "'".$nombAmbiente."'"; }else{echo "";}?>;
		$("#inputNombre").val(inputNombre);
		var inputDesc = <?php if(isset($descAmbiente)){ echo "'".$descAmbiente."'"; }else{echo "";}?>;
		$("#inputDesc").val(inputDesc);

		var fechaInicioA = <?php if(isset($fechaIniAmbiente)){ echo "'".$fechaIniAmbiente."'"; }else{echo "";}?>;
		$("#fechaInicioA").val(fechaInicioA);
		var fechaReaA = <?php if(isset($fechaRealAmbiente)){ echo "'".$fechaRealAmbiente."'"; }else{echo "";}?>;
		$("#fechaReaA").val(fechaReaA);
		var fechaFinA = <?php if(isset($fechaFinAmbiente)){ echo "'".$fechaFinAmbiente."'"; }else{echo "";}?>;
		$("#fechaFinA").val(fechaFinA);

		var ubicacionA = <?php if(isset($ubicacionAmbiente)){ echo "'".$ubicacionAmbiente."'"; }else{echo "";}?>;
		$("#ubicacionA").val(ubicacionA);
		var precioA = <?php if(isset($precioAmbiente)){ echo "'".$precioAmbiente."'"; }else{echo "";}?>;
		$("#precioA").val(precioA);	
		
	});

	function modificarAmbiente(){
		var idActividades = "";

		if (tipoActualizacion != 0) {
			$('input[name="idActividad[]"]:checked').each(function(){			
				idActividades += "/"+$(this).val();
			});
		}else{
			$('input[name="idActividad[]"]').each(function(){			
				idActividades += "/"+$(this).val()+"*";
				if ($(this).is(':checked')) {
					idActividades += "1";
				}else{
					idActividades += "0";
				}		
			});
		}

		
		$("#idActividades").val(idActividades);
		$("#tipoActualizacion").val(tipoActualizacion);

		$("#idNAmbiente").submit();

	}

	function traerTipoAmbientes(){
		var ruta = "<?= base_url().'index.php/traer/ambientePrecargado';?>";
		$.ajax({
		  type:'POST',
		  url: ruta,
		  data: '',
		  success: function(data){
		    $('#tipoA').html(data);
		    var tipoA = <?php if(isset($fk_idTipoAmbiente)){ echo "'".$fk_idTipoAmbiente."'"; }else{echo "";}?>;
			$("#tipoA").val($(".ta-"+tipoA).attr("value"));	
		  }
		});
	}

	function traerActividadesPrecargadas(id){
		var idAmbiente = $("#"+id).val();



		if ($('option[value="'+$("#"+id).val()+'"]').hasClass("ta-<?php echo $fk_idTipoAmbiente;?>")) {
			$("#tablaActividadesPre tbody").html(saveTable);
			tipoActualizacion = 0;
		}else{
			tipoActualizacion = 1;
			var ruta = "<?= base_url().'index.php/traer/actividadesPrecargadasAmbiente';?>";
			$.ajax({
			  type:'POST',
			  url: ruta,
			  data: 'idAmbiente='+idAmbiente,
			  success: function(data){
			    $('#tablaActividadesPre tbody').html(data);
			  }
			});
		}		
	}
	
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