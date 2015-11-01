<div id="generalCont" class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10">
	<div class="panel panel-primary">
	  <div class="panel-heading">
	    <h3 class="panel-title">Administrar Actividades</h3>
	  </div>
	  <div class="panel-body">
	  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	  	<div class="btn-group" role="group" aria-label="...">
		  <button style="display:none;" id="btnSuspender" type="button" class="btn btn-danger" data-container="body" data-trigger="manual" data-placement="bottom" data-content="No se ha seleccionado ninguna actividad." data-template="<div class='popover' role='tooltip'><div class='arrow'></div><h3 class='popover-title'></h3><div class='popover-content'></div><div style='display:none;' id='seguro' class='col-md-12 text-center'><div class='btn-group' role='group' style='margin-bottom:5px;' aria-label='...'><button onclick='suspenderP2()' class='btn btn-danger'>Si</button><button onclick='cerrarSuspender()' class='btn btn-primary'>No</button></div></div></div>" disabled>Eliminar</button>

		</div>
		    <a href="<?php echo base_url()."index.php/abrir/agregarActividad";?>"><button class="btn btn-primary pull-right">Agregar Actividad</button></a>
		</div>
	  </div>
	</div>
	<br>
	<div class="table-responsive">
		<table id="tablaActividades" class="table table-hover table-bordered table-striped">
	  		<thead>
		        <tr>
		          <th class="text-center">Actividad</th>
		          <th class="text-center">Prioridad</th>
		          <th class="text-center">Fecha Inicio </th>
		          <th class="text-center">Fecha Realización</th>
		          <th class="text-center">Fecha Fin</th>
		          <th class="text-center">Detalles</th>
		        </tr>
	      	</thead>
	      	<tbody>
	      		<?php echo $tabla ?>
	      	</tbody>
		</table>
	</div>
</div>
<?php $this->load->helper('form');echo form_open_multipart("abrir/modificarActividad",array("id"=>"idMActividad"));?>
	<input type="hidden" name="idAct" id="idAct">
</form>
<script type="text/javascript">
	function verAct(idAct){
		$("#idAct").val(idAct);
		$("#idMActividad").submit();		
	}
</script>