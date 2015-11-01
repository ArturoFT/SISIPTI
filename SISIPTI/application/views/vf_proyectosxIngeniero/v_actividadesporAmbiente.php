
		<?= $tabla;?>

<div class="col-md-12">  <button onclick="regresar1()" class="btn btn-success">Regresar</button></div>

<script type="text/javascript">
	function regresar1(){
	var idProyecto=<?php if(isset($idProyecto)){ echo $idProyecto;}else{ echo "''";} ?>;
	var ruta ="<?=base_url().'index.php/abrir/consultarAmbientesIngeniero';?>";
	$.ajax({
		type:'POST',
		url: ruta,
		data:'idProyecto='+idProyecto,
		success: function(data){

			$('#contenedor').html(data);

		}
	});
	}

	
function verTrabajadores(este){

	var idProyecto=<?php if(isset($idProyecto)){ echo $idProyecto;}else{ echo "''";} ?>;
	var idAmbiente=<?php if(isset($idAmbiente)){ echo $idAmbiente;}else{ echo "''";} ?>;
	var id=$(este).attr('idActividad');
	
	var ruta ="<?=base_url().'index.php/abrir/consultarTrabajadoresIngeniero';?>";
	$.ajax({
		type:'POST',
		url: ruta,
		data:'idActividad='+id+'&idAmbiente='+idAmbiente+'&idProyecto='+idProyecto,
		success: function(data){

			$('#contenedor').html(data);

		}
	});
}

</script>