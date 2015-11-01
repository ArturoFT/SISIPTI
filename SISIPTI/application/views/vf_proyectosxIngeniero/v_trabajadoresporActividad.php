
		<?= $tabla;?>

<div class="col-md-12">  <button onclick="regresar2()" class="btn btn-success">Regresar</button></div>

<script type="text/javascript">
	function regresar2(){
	var idAmbiente=<?php if(isset($idAmbiente)){ echo $idAmbiente;}else{ echo "''";} ?>;
	var idProyecto=<?php if(isset($idProyecto)){ echo $idProyecto;}else{ echo "''";} ?>;
	var ruta ="<?=base_url().'index.php/abrir/consultarActividadesIngeniero';?>";
	$.ajax({
		type:'POST',
		url: ruta,
		data:'idAmbiente='+idAmbiente+'&idProyecto='+idProyecto,
		success: function(data){

			$('#contenedor').html(data);

		}
	});
	}
</script>
