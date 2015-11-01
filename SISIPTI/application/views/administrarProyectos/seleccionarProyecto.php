<div id="generalCont" class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
	<div class="panel panel-default">
	  <div class="panel-body">
	  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	  		  <span id="spanS" class="spanProyectoS"> Proyecto seleccionado: <?php 
	  		 	if (isset($nombPS)) {
	  		 		echo $nombPS;
	  		 	} 
	  		 ?>
	  		 </span>
	  		 <br>
	  		 <br>
	  	</div>
	  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	  	<div class="btn-group" role="group" aria-label="...">
		  <button id="btnSeleccionar" onclick="seleccionarP()"  type="button" class="btn btn-primary" data-container="body" data-trigger="manual" data-placement="bottom" data-content="No se ha seleccionado ningun proyecto.">Guardar Selección</button>
		  <button id="btnModificar" onclick="modificarP()"  type="button" class="btn btn-warning" data-container="body"  data-trigger="manual" data-placement="bottom" data-content="No se ha seleccionado ningun proyecto.">Modificar</button>
		  <button id="btnSuspender" onclick="suspenderP()"  type="button" class="btn btn-danger" data-container="body" data-trigger="manual" data-placement="bottom" data-content="No se ha seleccionado ningun proyecto." data-template="<div class='popover' role='tooltip'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div style='display:none;' id='seguro' class='col-md-12 text-center'><div class='btn-group' role='group' style='margin-bottom:5px;' aria-label='...'><button onclick='suspenderP2()' class='btn btn-danger'>Si</button><button onclick='cerrarSuspender()' class='btn btn-primary'>No</button></div></div></div>">Suspender</button>
		</div>
		    <a href="<?php echo base_url()."index.php/abrir/agregarProyecto";?>"><button class="btn btn-success pull-right">Agregar</button></a>
		</div>
	  </div>
	</div>
	<br>
	<div class="table-responsive">
		<table id="tablaProyectos" class="table table-hover table-bordered table-striped">
	  		<thead>
		        <tr>
		          <th>Proyecto</th>
		          <th>Contratista</th>
		          <th>Direccion</th>
		          <th>Estado</th>
		          <th>Seleccionar</th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		
	      	</tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
var datosNav = '<?php
	 		echo '<li><a href="'.base_url()."index.php/abrir/listaProyectos".'">Selecionar Proyecto</a></li>';
			echo '<li><a href="'.base_url()."index.php/abrir/administrarAmbientes".'">Ambientes</a></li>';
            echo '<li><a href="'.base_url()."index.php/abrir/administrarActividades".'">Actividades</a></li>';
            echo '<li><a href="'.base_url()."index.php/adm_materiales".'">Materiales</a></li>';
            echo '<li><a href="'.base_url()."index.php/ruta".'">Trabajadores</a></li>';
            echo '<li><a href="'.base_url()."index.php/asignarRecursos".'">Asignación de Recursos</a></li>';
             ?>';
 var datosNav2 = '<?php echo '<li><a href="'.base_url()."index.php/abrir/listaProyectos".'">Selecionar Proyecto</a></li>';?>';
$(document).ready(function(){
	traerProyectos();
	//alert(datosNav);
  	$('[data-toggle="popover"]').popover();
});

function traerProyectos(){
	var ruta = "<?= base_url().'index.php/traer/proyectos';?>";
	$.ajax({
	  type:'POST',
	  url: ruta,
	  data: '',
	  success: function(data){
	    $('#tablaProyectos tbody').html(data);
	  }
	});
}

function seleccionarP(){
	if (!($('input:radio[name=proyectoSelec]:checked').val())) {
		$('#btnSeleccionar').popover('show');
	}else{
		$("#ul-proyecto").html(datosNav);
		var ruta = "<?= base_url().'index.php/seleccionar/proyecto';?>";
		$.ajax({
		  type:'POST',
		  url: ruta,
		  data: 'idP='+$('input:radio[name=proyectoSelec]:checked').val()+"&nombP="+$('input:radio[name=proyectoSelec]:checked').attr("nomb"),
		  success: function(data){
		  	$(".spanProyectoS").html("Proyecto Seleccionado: "+$('input:radio[name=proyectoSelec]:checked').attr("nomb"));		  
		  }
		});
	}
}

function actualizarNombre(){
	var ruta = "<?= base_url().'index.php/little/actualizarNombre';?>";
		$.ajax({
		  type:'POST',
		  url: ruta,
		  data: '',
		  success: function(data){
		  	$(".spanProyectoS").html(data);		
		  }
		});
}


function modificarP(){
	if (!($('input:radio[name=proyectoSelec]:checked').val())) {
		$('#btnModificar').popover('show');
	}else{
		var ruta = "<?= base_url().'index.php/abrir/modificarProyecto';?>";
		$.ajax({
		  type:'POST',
		  url: ruta,
		  data: 'idP='+$('input:radio[name=proyectoSelec]:checked').val(),
		  success: function(data){
		  	$("#generalCont").html(data);		  
		  }
		});
	}
}

function reanudarP(id){
	var ruta = "<?= base_url().'index.php/reanudar/proyecto';?>";
	$.ajax({
	  type:'POST',
	  url: ruta,
	  data: 'idP='+id,
	  success: function(data){
	  	actualizarNombre();
	  	traerProyectos();
	  }
	});
}

function suspenderP(){
	if (!($('input:radio[name=proyectoSelec]:checked').val())) {
		$('#btnSuspender').popover('show');
	}else{
		$("#btnSuspender").attr("data-content","¿Seguro que desea suspender "+$('input:radio[name=proyectoSelec]:checked').attr("nomb")+"?");
		$('#btnSuspender').popover('show');
		$('#seguro').slideDown();
	}
}

function suspenderP2(){
	$('#btnSuspender').popover('hide');
	<?php 
	 	if (isset($idPS)) {
	?>
			if($('input:radio[name=proyectoSelec]:checked').val()==<?php echo $idPS; ?>){
				$(".spanProyectoS").html("Proyecto Seleccionado:");				
			}
	<?php
	 	} 
 	?>

	var ruta = "<?= base_url().'index.php/suspender/proyecto';?>";
	$('#seguro').slideUp();
	$("#ul-proyecto").html(datosNav2);
	$.ajax({
	  type:'POST',
	  url: ruta,
	  data: 'idP='+$('input:radio[name=proyectoSelec]:checked').val(),
	  success: function(data){
	  	actualizarNombre();
	  	traerProyectos();
	  	$("#btnSuspender").attr("data-content","No se ha seleccionado ningun proyecto.");
	  }
	});
	

}

function checkP(){
	$('#btnSeleccionar').popover('hide');
	$('#btnSuspender').popover('hide');
	$('#btnModificar').popover('hide');
	$('#btnReanudar').popover('hide');
}

function cerrarSuspender () {
	$('#btnSuspender').popover('hide');
}

</script>