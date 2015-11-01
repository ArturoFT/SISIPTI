<?= $tabla;?>

<div class="col-md-12">  <button onclick="regresar()" class="btn btn-success">Regresar</button></div>

<script type="text/javascript">
	function regresar(){

	var ruta ="<?=base_url().'index.php/abrir/consultarProyectosIngeniero';?>";
	$.ajax({
		type:'POST',
		url: ruta,
		data:'',
		success: function(data){

			$('body').html(data);

		}
	});
	}
</script>

<script type="text/javascript">
	
function verActividades(este){
	var idProyecto=<?php if(isset($idProyecto)){ echo $idProyecto;}else{ echo "''";} ?>;
	var id=$(este).attr('idAmbiente');
	
	var ruta ="<?=base_url().'index.php/abrir/consultarActividadesIngeniero';?>";
	$.ajax({
		type:'POST',
		url: ruta,
		data:'idAmbiente='+id+'&idProyecto='+idProyecto,
		success: function(data){

			$('#contenedor').html(data);

		}
	});
}
</script>