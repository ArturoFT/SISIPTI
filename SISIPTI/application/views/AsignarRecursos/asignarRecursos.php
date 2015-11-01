
<div class="col-md-offset-1 col-md-10">
	<div class="tabbable tabs-below">
	  <ul class="nav nav-tabs" style="text-align:center;">
	      	<li class="col-md-6 active"><a  id="recursosMateriales" href="#A" style="color:#777777;" data-toggle="tab">Recursos Materiales Asignados</a></li>
	        <li class="col-md-6"><a href="#B" id="recursosHumanos" style="color:#777777;" data-toggle="tab">Recursos Humanos Asignados</a></li>
	  </ul>
	</div>

	<!--Datos a poblar-->
	<div id="datos">
		
	 </div>
</div>

<!--MODAL PARA INCORPORACION DE Materiales-->
<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Materiales del Proyecto</h4>
      </div>
	
	<thread>

      <div class="modal-body">
        <!--Tabla Materiales del Proyecto-->
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover" >
				<thead>
			        <tr>
			          <th>Material</th>
			          <th>Unidad de Medida</th>
			          <th>Cantidad Disponible</th>
			          <th>Asignar</th>
			          <th>Cantidad a Asignar</th>
			          <th>Ambiente</th>
			        </tr>
			    </thead>
			    <tbody id="materialesProyecto">
			    </tbody>
		     <!--Datos de la tabla-->
		    </table>		
		</div>	        
      </div>
      <div id="validadcionModalMaterialAsignar" style="color:red;">
      	
      </div>
      <div class="modal-footer">
        <button type="button" onclick="limpiaModal()" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="guardarMaterialessiganados" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!--MODAL PARA INCORPORACION DE Tarbajadores-->
<div class="modal fade bs-example-modal-lg" id="myModalHumanos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
			          <th>Apellidos</th>
			          <th>Nombres</th>
			          <th>Profesión</th>
			          <th>Asignar</th>
			          <th>Cargo</th>
			          <th>Ambiente</th>
			          <th>Actividad</th>
			        </tr>
			     </thead>
			     <tbody id="trabajadorProyecto">
				  	<!--Datos de la tabla-->
			     </tbody>
		    </table>		
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
		listarMaterialesProyectoAsignados();
		
	})

	function verificar(th){
		var num = $(th).attr('num');
		if($(th).is(':checked')){
			
				$('#cantidadAsignada'+num).removeAttr('disabled');
				$('#selectMat'+num).removeAttr('disabled');
			}
			else{
				$('#cantidadAsignada'+num).attr('disabled',"");
				$('#selectMat'+num).attr('disabled' , "");
			}

	}

	function verificarMaterial(th){
		var num = $(th).attr('numMat');
		if($(th).is(':checked')){
			
				$('#selectAmbiente'+num).removeAttr('disabled');
				$('#retornaActividades'+num).removeAttr('disabled');
			}
			else{
				$('#selectAmbiente'+num).attr('disabled',"");
				$('#retornaActividades'+num).attr('disabled' , "");
			}

	}

	$(document).on("click","#tablaMaterialesProyecto",function(){
		cargarMaterialesProyecto();
	})

	//recursos materiales asignados
	$(document).on("click","#recursosMateriales",function(){
		listarMaterialesProyectoAsignados();
	})
	function listarMaterialesProyectoAsignados(){
		<?php $this ->load->helper('url'); ?>
		var ruta = "<?php echo base_url().'index.php/listarRecursosMaterialesAsignados' ;?>";
		var dataString = '';
		$.ajax({
			type: 'POST',
			url: ruta,
			data: dataString,
			success: function (data){
				$('#datos').html(data);
			}
		})
	}

	$(document).on("click","#asignarRecursosMateriales",function(){
		cargarMaterialesProyecto();
	})

	//Modal listar Materiales incorporados
	function cargarMaterialesProyecto(){
		<?php $this->load->helper('url') ;?>
		var ruta = "<?php echo base_url().'index.php/listaMaterialesProyecto'; ?>";
		var dataString = '';
		$.ajax({
			type: 'POST',
			url : ruta,
			data : dataString,
			success: function(data){
				$("#materialesProyecto").html(data);
			}
		})
	}

	//recursos Humanos asignados
	$(document).on("click","#recursosHumanos",function(){
		cargarRecursosHumanosAsignados();
	})
	function cargarRecursosHumanosAsignados(){
		<?php $this ->load->helper('url'); ?>
		var ruta = "<?php echo base_url().'index.php/listarRecursosHumanosAsignados' ;?>";
		var dataString = '';
		$.ajax({
			type: 'POST',
			url: ruta,
			data: dataString,
			success: function (data){
				$('#datos').html(data);
			}
		})
	}
	 

	//recursos humanos del proyecto
	$(document).on("click","#asignarRecursosHumanos",function(){
		cargarRecursosHumanosProyecto();
	})
	function cargarRecursosHumanosProyecto(){
		<?php $this->load->helper('url') ;?>
		var ruta = "<?php echo base_url().'index.php/listarTrabajadoresProyecto' ;?>";
		var dataString = '';
		$.ajax({
			type: 'POST',
			url : ruta,
			data : dataString,
			success: function(data){
				$("#trabajadorProyecto").html(data);
			}
		})
	}

	//cargar ACTIVIDADES POR AMBIENTE
	function llenarSActividad(cont){
		//var dat1 = $("#ID").val;
		//var dat2 = $("#ID1").val;
		<?php $this->load->helper('url') ;?>
		var ruta = "<?php echo base_url().'index.php/cargarActividadesPorAmbiente' ;?>";
		var dataString = 'idAmbiente='+$("#selectAmbiente"+cont).val();
		//var dataString = 'estoesunadato='+dat1+"&asdaasdasd="+asdas;
		//$_post[estoesundato]
		$.ajax({
			type: 'POST',
			url : ruta,
			data : dataString,
			success: function(data){
				$("#retornaActividades"+cont).html(data);
			}
		})
	}

	//CARGAR ARRAY CNON CHECK BOX SELECIONADOS
	/*$(document).on("change","#asignar",function(){
        var checks = new Array();
		$('input[name="seleccion[]"]:checked').each(function() {
			//$(this).val() es el valor del checkbox correspondiente
			checks.push($(this).val());
		});
        alert(checks[1]);
	})*/
	
	$(document).on("click","#guardarAsiganados",function(){
		$('input[name="seleccion[]"]:checked').each(function() {
			//$(this).val() es el valor del checkbox correspondiente
			var checks = $(this).val();
			var sel= $(this).attr("numMat");			
			AsignarRecursos(checks,sel);
		});
	})


	function AsignarRecursos(check,sel,selact){
		//ambiente activdad cargo
		<?php $this->load->helper('url') ;?>
		var ruta = "<?php echo base_url().'index.php/RegistraAsignacionRecursos' ;?>";
		var dataString = 'idTraba='+check+'&idAmb='+$('#selectAmbiente'+sel).val()+'&idAct='+$('#retornaActividades'+sel).val()+'&idCarg='+$('#cargo').val();
		//var dataString = 'idTraba='+check+'&idAmb='+$('#ambiente').val()+'&idAct='+$('#actividad').val()+'&idCarg='+$('#cargo').val();
		$.ajax({
			type: 'POST',
			url : ruta,
			data : dataString,
			success: function(data){
				cargarRecursosHumanosProyecto();
				cargarRecursosHumanosAsignados();
			}
		})
	}

	function verificaCantidad(reserva,asignacion){
	    if(reserva>= asignacion){
	      return true;
	    }
	    else{
	      return false;
	    }
  	}

  	var alerta= "";
 	var nalerta = "";
	$(document).on("click","#guardarMaterialessiganados",function(){
		$('input[name="seleccionMateriales[]"]:checked').each(function() {
			//$(this).val() es el valor del checkbox correspondiente
			var checks = $(this).val();
			var idamb2= $(this).attr("idAmb");
			var num = $(this).attr("num");
		var reserva=parseInt($("#contMaterialPozoAsignar"+checks).text());
	    var asignacion=parseInt($("#cantidadAsignada"+num).val());
	    var nomMaterial=$("#nombreMaterialParaMostrarAsignar"+checks).text();

	    var apto =verificaCantidad(reserva,asignacion);
		var menor = menorACero(asignacion);

		if (apto == true && menor==false){
	        AsignarRecursosMat(checks,idamb2,num);
	      }
	    if(apto == true && menor==true){
              $("#validadcionModalMaterialAsignar").html("");
              //alert("no apto  "+" res "+ reserva+" asignacion "+ asignacion +" " +apto)
              alerta = "Imposible asignar cantidad menor a 0 al material "+nomMaterial+"<br>";
              nalerta += $("#validadcionModalMaterialAsignar").html()+alerta;
              $("#validadcionModalMaterialAsignar").html(nalerta)
          }
	    if(apto == false && menor == false){
	        $("#validadcionModalMaterialAsignar").html("");
	        alerta = "No existen suficientes unidades de "+nomMaterial +" para la asignacion  "+"<br>";
	        nalerta += $("#validadcionModalMaterialAsignar").html()+alerta;
	        $("#validadcionModalMaterialAsignar").html(nalerta);
			}
			
		});
	})




	$(document).on("change",".selectS",function(){
		var valor = $(this).val();
		var num = $(this).attr("num");
		$("#asignarMatSel"+num).attr("idAmb",valor);

	})

	function limpiaModal(){
    $("#validadcionModalMaterialAsignar").html("");
    alerta= "";
    nalerta = "";
  	}

	function AsignarRecursosMat(check,idAmb,num){
		//ambiente activdad cargo
		<?php $this->load->helper('url') ;?>
		var ruta = "<?php echo base_url().'index.php/RegistrarAsignacionMat' ;?>";
		var dataString = 'idMat='+check+'&idAmb='+$('#asignarMatSel'+num).attr('idAmb')+'&cant='+$('#cantidadAsignada'+num).val();
		$.ajax({
			type: 'POST',
			url : ruta,
			data : dataString,
			success: function(data){
				cargarMaterialesProyecto();
				listarMaterialesProyectoAsignados();
			}
		})
	}

	function menorACero(asignacion){
    if(asignacion < 0 ){
      return true;
    }
    else{
      return false;
    }
  }



</script>