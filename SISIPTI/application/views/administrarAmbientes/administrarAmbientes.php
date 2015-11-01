<div id="generalCont" class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Administrar Ambientes</h3>
	  </div>
	  <div class="panel-body">
	  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	  	<div class="btn-group" role="group" aria-label="...">
		  <button id="btnModificar" onclick="modificarA()"  type="button" class="btn btn-warning" data-container="body"  data-trigger="manual" data-placement="bottom" data-content="No se ha seleccionado ningun ambiente.">Modificar</button>
		  <button style="display:none;" id="btnSuspender" type="button" class="btn btn-danger" data-container="body" data-trigger="manual" data-placement="bottom" data-content="No se ha seleccionado ningun ambiente." data-template="<div class='popover' role='tooltip'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div style='display:none;' id='seguro' class='col-md-12 text-center'><div class='btn-group' role='group' style='margin-bottom:5px;' aria-label='...'><button onclick='suspenderP2()' class='btn btn-danger'>Si</button><button onclick='cerrarSuspender()' class='btn btn-primary'>No</button></div></div></div>" disabled>Eliminar</button>
		  <button id="btnActividades" onclick="abrirActividades()"  type="button" class="btn btn-primary" data-container="body"  data-trigger="manual" data-placement="bottom" data-content="No se ha seleccionado ningun ambiente.">Actividades</button>
		  <button id="btnIncidencia" onclick="incidencia()"  type="button" class="btn btn-info" data-toggle="modal" data-target="#ingresar" data-container="body"  data-trigger="manual" data-placement="bottom" data-content="No se ha seleccionado ningun proyecto.">Incidencia</button>
		</div>
		    <a href="<?php echo base_url()."index.php/abrir/agregarAmbiente";?>"><button class="btn btn-primary pull-right">Agregar</button></a>
		</div>
	  </div>
	</div>
	<br>
	<?php $this->load->helper('form');echo form_open_multipart("abrir/administrarActividades",array("id"=>"fActividad"));?>
		 <input id="idAmb" name="idAmb" type="hidden" />
	</form>
	<div class="table-responsive">
		<table id="tablaAmbientes" class="table table-hover table-bordered table-striped">
	  		<thead>
		        <tr>
		          <th class="text-center">Ambiente</th>
		          <th class="text-center">Ubicación</th>
		          <th class="text-center">Fecha Realización</th>
		          <th class="text-center">Fecha Inicio</th>
		          <th class="text-center">Fecha Fin</th>
		          <th class="text-center">Seleccionar</th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		
	      	</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">

$(document).ready(function(){
	traerAmbientes();
});

function traerAmbientes(){
	var ruta = "<?= base_url().'index.php/traer/ambientes';?>";
	$.ajax({
	  type:'POST',
	  url: ruta,
	  data: '',
	  success: function(data){
	    $('#tablaAmbientes tbody').html(data);
	  }
	});
}

function modificarA(){
	if (!($('input:radio[name=ambienteSelec]:checked').val())) {
		$('#btnModificar').popover('show');
	}else{
		var ruta = "<?= base_url().'index.php/abrir/modificarAmbiente';?>";
		$.ajax({
		  type:'POST',
		  url: ruta,
		  data: 'idAmb='+$('input:radio[name=ambienteSelec]:checked').val(),
		  success: function(data){
		  	$("#generalCont").html(data);		 
		  	//alert(data);
		  }
		});
	}
}
function abrirActividades(){
	if (!($('input:radio[name=ambienteSelec]:checked').val())) {
		$('#btnActividades').popover('show');
	}else{
		var idx = $('input:radio[name=ambienteSelec]:checked').val();
		$("#idAmb").val(idx);
		$("#fActividad").submit();
	}
}

function checkP(){
	$('#btnModificar').popover('hide');
}

function incidencia(){
	if (!($('input:radio[name=ambienteSelec]:checked').val())) {
		$('#btnIncidencia').popover('show');
	}else{
		var ruta = "<?= base_url().'index.php/abrir/incidencias';?>";
		$.ajax({
		  type:'POST',
		  url: ruta,
		  data: 'idAmb='+$('input:radio[name=ambienteSelec]:checked').val(),
		  success: function(data){
		  	$("#generalCont").html(data);		  
		  }
		});
	}
}
</script>