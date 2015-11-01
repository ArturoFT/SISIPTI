<div class="col-md-10 col-md-offset-1">
	<div class="portlet-body" id="trabajadoresProyectoLibres">
	
	</div>
</div>


<!--MODAL PARA Agregar Mas Tarbajadores-->
<div class="modal fade bs-example-modal-lg" id="myModalAgregarTrabajadoresAlProyecto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Trabajadores del Proyecto</h4>
      </div>
      <div class="modal-body">
        <!--Tabla Materiales del Proyecto-->
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover" >
				<thead>
			        <tr>
			          <th style='text-align:center;'>Apellidos</th>
			          <th style='text-align:center;'>Nombres</th>
			          <th style='text-align:center;'>Profesión</th>
			          <th style='text-align:center;'>Asignar</th>
			        </tr>
			     </thead>
			     <tbody id="trabajadorDeLaEmpresa">
				  	<!--Datos de la tabla-->
			     </tbody>
		    </table>		
		</div>	        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="agregarAlProyecto" class="btn btn-primary">Agregar al Proyecto</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalDetallarTrabajador" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Detalles del Trabajador</h3>
      </div>
      <div class="modal-body">
        <!--detalles de trabajador-->
        <div id= "TrabajadorDetallado">
        	
        </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="guardarAsiganados" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
			listarTrabajadoresProyectoLibres();
			
		})
	function listarTrabajadoresProyectoLibres(){
			<?php $this ->load->helper('url'); ?>
			var ruta = "<?php echo base_url().'index.php/listarTrabajadoresProyectoLibres' ;?>";
			var dataString = '';
			$.ajax({
				type: 'POST',
				url: ruta,
				data: dataString,
				success: function (data){
					$('#trabajadoresProyectoLibres').html(data);
				}
			})
		}
	$(document).on("click","#agregarTrabajadoresAlProyecto",function(){
		agregarTrabajadoresAlProyecto();
	})
	function agregarTrabajadoresAlProyecto(){
		<?php $this->load->helper('url') ;?>
		var ruta = "<?php echo base_url().'index.php/agregarTrabajadoresAlProyecto' ;?>";
		var dataString = '';
		$.ajax({
			type: 'POST',
			url : ruta,
			data : dataString,
			success: function(data){
				$("#trabajadorDeLaEmpresa").html(data);
			}
		})
	}


	function detallarTrabajador(dat){
		//var dat1 = $("#ID").val;
		//var dat2 = $("#ID1").val;
		<?php $this->load->helper('url') ;?>
		var ruta = "<?php echo base_url().'index.php/detallarTrabajador' ;?>";
		var dataString = 'idTrabajador='+dat;
		//var dataString = 'estoesunadato='+dat1+"&asdaasdasd="+asdas;
		//$_post[estoesundato]
		$.ajax({
			type: 'POST',
			url : ruta,
			data : dataString,
			success: function(data){
				$("#TrabajadorDetallado").html(data);
			}
		})
	}
	
	function EliminarDeProyecto(dat){
		//var dat1 = $("#ID").val;
		//var dat2 = $("#ID1").val;
		<?php $this->load->helper('url') ;?>
		var ruta = "<?php echo base_url().'index.php/EliminarDeProyecto' ;?>";
		var dataString = 'idTrabajador='+dat;
		//var dataString = 'estoesunadato='+dat1+"&asdaasdasd="+asdas;
		//$_post[estoesundato]
		$.ajax({
			type: 'POST',
			url : ruta,
			data : dataString,
			success: function(data){
				alert("Trabajador separado del Proyecto");
				listarTrabajadoresProyectoLibres();
			}
		})
	}

	$(document).on("click","#agregarAlProyecto",function(){
		$('input[name="seleccionParaAgregarTrabajadores[]"]:checked').each(function() {
			//$(this).val() es el valor del checkbox correspondiente
			var checks = $(this).val();
			agregarTrabajadoresAlPozoDelProyecto(checks);
		});
	})

	function agregarTrabajadoresAlPozoDelProyecto(check){
		//ambiente activdad cargo
		<?php $this->load->helper('url') ;?>
		var ruta = "<?php echo base_url().'index.php/agregarTrabajadoresAlPozoDelProyecto' ;?>";
		var dataString = 'idTraba='+check;
		$.ajax({
			type: 'POST',
			url : ruta,
			data : dataString,
			success: function(data){
				listarTrabajadoresProyectoLibres();
				agregarTrabajadoresAlProyecto();
			}
		})
	}

</script>