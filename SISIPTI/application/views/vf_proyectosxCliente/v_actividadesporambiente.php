
		<?= $tabla;?>

<div class="col-md-12">  <button onclick="regresar1()" class="btn btn-success">Regresar</button></div>

<script type="text/javascript">
	function regresar1(){
	var idProyecto=<?php if(isset($idProyecto)){ echo $idProyecto;}else{ echo "''";} ?>;
	var ruta ="<?=base_url().'index.php/abrir/consultarAmbientesCliente';?>";
	$.ajax({
		type:'POST',
		url: ruta,
		data:'idProyecto='+idProyecto,
		success: function(data){

			$('#contenedor').html(data);

		}
	});
	}
</script>
