<div id='contenedor'>
	<?= $tabla;?>
</div>
<script type="text/javascript">
function verAmbientes(este){

	var id=$(este).attr('idProyecto');
	
	var ruta ="<?=base_url().'index.php/abrir/consultarAmbientesCliente';?>";
	$.ajax({
		type:'POST',
		url: ruta,
		data:'idProyecto='+id,
		success: function(data){

			$('#contenedor').html(data);

		}
	});
}
</script>