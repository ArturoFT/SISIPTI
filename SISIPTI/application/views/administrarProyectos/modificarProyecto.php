<div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title">Modificar Proyecto</h3>
  </div>
  <div class="panel-body">
  
		<?php $this->load->helper('form');echo form_open_multipart("modificar/proyecto");?>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			  <input type="hidden" id="idProyecto"  name="idProyecto" value="-1">
			  <div class="form-group">
			    <label>Nombre del proyecto:<?php echo form_error('nombreP');?></label>
			    <input id="inputNombre" type="text" class="form-control" placeholder="Nombre" name="nombreP" value="<?php echo set_value('nombreP'); ?>">
			  </div>
			  <div class="form-group">
			    <label>Dirección del proyecto:<?php echo form_error('direccionP');?></label>
			    <input id="inputDireccion" type="text" class="form-control" placeholder="Dirección" name="direccionP" value="<?php echo set_value('direccionP'); ?>">
			  </div>
			  <div class="form-group">
			    <label>Fecha de inicio del proyecto:<?php echo form_error('fechaInicioP');?></label>
			    <input readonly="readonly" id="fechaInicioP" type="text" class="form-control" placeholder="Fecha inicio" name="fechaInicioP" value="<?php echo set_value('fechaInicioP'); ?>">
			  </div>
			  <div class="form-group">
			    <label>Alcance:<?php echo form_error('alcanceP');?></label>
			    <textarea id="inputAlcance" class="form-control" name="alcanceP" placeholder="..." value="<?php echo set_value('alcanceP'); ?>"></textarea>
			  </div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			  <div class="form-group">
			    <label>Exclusiones:<?php echo form_error('exclusionesP');?></label>
			    <textarea id="inputExclusiones" class="form-control" name="exclusionesP" placeholder="..." value="<?php echo set_value('exclusionesP'); ?>"></textarea>
			  </div>
			  <div class="form-group">
			    <label>Presupuesto del proyecto:<?php echo form_error('presupuestoP');?></label>
			    <input id="inputPresupuesto" type="text" class="form-control" placeholder="S/." name="presupuestoP" value="<?php echo set_value('presupuestoP'); ?>">
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
			  	<a href="<?php echo base_url()."index.php/crear/proyecto";?>"><button type="submit" class="btn btn-warning">Modificar</button></a>
			    <a href="<?php echo base_url()."index.php/abrir/listaProyectos";?>"><button type="button" class="btn btn-danger">Cancelar</button></a>
			  </div>
		 	</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	var cliente = 0;
	var tipo = 0;

	$(document).ready(function(){
		traerTipoProyecto();
		traerClienteProyecto();
		var inputNombre = <?php if(isset($nombProyecto)){ echo "'".$nombProyecto."'"; }else{echo "";}?>;
		$("#inputNombre").val(inputNombre);
		var inputDireccion = <?php if(isset($dirProyecto)){ echo "'".$dirProyecto."'"; }else{echo "";}?>;
		$("#inputDireccion").val(inputDireccion);
		var fechaInicioP = <?php if(isset($fechaIniProyecto)){ echo "'".$fechaIniProyecto."'"; }else{echo "";}?>;
		$("#fechaInicioP").val(fechaInicioP);
		var inputAlcance = <?php if(isset($alcanceProyecto)){ echo "'".$alcanceProyecto."'"; }else{echo "";}?>;
		$("#inputAlcance").val(inputAlcance);
		var inputExclusiones = <?php if(isset($exclusionesProyecto)){ echo "'".$exclusionesProyecto."'"; }else{echo "";}?>;
		$("#inputExclusiones").val(inputExclusiones);
		var inputPresupuesto = <?php if(isset($presupuestoIniProyecto)){ echo "'".$presupuestoIniProyecto."'"; }else{echo "";}?>;
		$("#inputPresupuesto").val(inputPresupuesto);
		cliente = <?php if(isset($fk_idCliente)){ echo $fk_idCliente; }else{echo 0;} ?>;
		tipo = <?php if(isset($fk_idTipoProyecto)){ echo $fk_idTipoProyecto; }else{echo 0;}?>;
		var idp = <?php if(isset($idProyecto)){ echo "'".$idProyecto."'"; }else{echo "";}?>;
		$("#idProyecto").val(idp);
	});

	function traerTipoProyecto(){
		var ruta = "<?= base_url().'index.php/traer/tipoProyecto';?>";
		$.ajax({
		  type:'POST',
		  url: ruta,
		  data: '',
		  success: function(data){
		    $('#tipoP').html(data);
		    $('#tipoP').val(tipo);
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
		    $('#clienteP').val(cliente);
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