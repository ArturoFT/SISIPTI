
<div class="col-md-12">
<div class="panel panel-success">
  <div class="panel-heading">
    <h3 class="panel-title">Consultar:</h3>
  </div>
  <div id="contenedor" class="panel-body">
   <?= $tabla;?>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
function verAmbientes(este){

	var id=$(este).attr('idProyecto');
	
	var ruta ="<?=base_url().'index.php/abrir/consultarAmbientesIngeniero';?>";
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