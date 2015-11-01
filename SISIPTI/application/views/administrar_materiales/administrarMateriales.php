<div class="col-md-10 col-md-offset-1">
	<div class="portlet-body" id="MaterialesProyectoEnPozo">
				<thread></thread><table class="table table-striped table-bordered table-hover"><tbody><tr>
		          <th style="text-align: center; ">Material</th>
		          <th style="text-align: center; ">Cantidad Disponible</th>
		          <th style="text-align: center; ">Unidad de Medida</th>
              <th style="text-align: center; ">Detalles</th>
		        </tr>
		        </tbody>
		        </table>
		        </div>
</div>


<!--MODAL PARA Agregar Mas Tarbajadores-->
<div class="modal fade bs-example-modal-lg" id="myModalAgregarMaterialesAlPozo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Materiales del Proyecto</h4>
      </div>
      <div class="modal-body">
        <!--Tabla Materiales del Proyecto-->
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover" >
				<thead>
			        <tr>
			          <th style='text-align:center;'>Material</th>
			          <th style='text-align:center;'>Cantidad en la Empresa</th>
			          <th style='text-align:center;'>Unidad de Medida</th>
			          <th style='text-align:center;'>Asignar</th>
                <th style='text-align:center;'>Cantidad</th>
			        </tr>
			     </thead>
			     <tbody id="materialesDeLaEmpresa">
				  	<!--Datos de la tabla-->
			     </tbody>
		    </table>		
		</div>
    <div id="validadcionModalMaterialPozo" style="color:red;">
      
    </div>	        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onclick="limpiaModal()" data-dismiss="modal">Close</button>
        <button type="button" id="agregarMaterialesAlProyecto" class="btn btn-primary">Agregar al Proyecto</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-lg" id="myModalDetallarMaterial" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="myModalLabel">Detalles del Material</h3>
      </div>
      <div class="modal-body">
        <div id= "MaterialDetallado" >
        	
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
      listarMaterialesDelProyectoEnPozo();
      
    })
  function listarMaterialesDelProyectoEnPozo(){
      <?php $this ->load->helper('url'); ?>
      var ruta = "<?php echo base_url().'index.php/listarMaterialesDelProyectoEnPozo' ;?>";
      var dataString = '';
      $.ajax({
        type: 'POST',
        url: ruta,
        data: dataString,
        success: function (data){
          $('#MaterialesProyectoEnPozo').html(data);
        }
      })
    }

  function detallarMaterial(dat){
    //var dat1 = $("#ID").val;
    //var dat2 = $("#ID1").val;
    <?php $this->load->helper('url') ;?>
    var ruta = "<?php echo base_url().'index.php/detallarMaterial' ;?>";
    var dataString = 'idMaterial='+dat;
    //var dataString = 'estoesunadato='+dat1+"&asdaasdasd="+asdas;
    //$_post[estoesundato]
    $.ajax({
      type: 'POST',
      url : ruta,
      data : dataString,
      success: function(data){
        $("#MaterialDetallado").html(data);
      }
    })
  }

  $(document).on("click","#agregarMaterialesesAlProyecto",function(){
    cargarMaterialesDelPozo();
  })

  //Modal listar Materiales incorporados
  function cargarMaterialesDelPozo(){
    <?php $this->load->helper('url') ;?>
    var ruta = "<?php echo base_url().'index.php/cargarMaterialesDelPozo'; ?>";
    var dataString = '';
    $.ajax({
      type: 'POST',
      url : ruta,
      data : dataString,
      success: function(data){
        $("#materialesDeLaEmpresa").html(data);
      }
    })
  }

  function verificarMatEmpre(th){
    var numMatEmpre = $(th).attr('numMatEmpre');
    if($(th).is(':checked')){
      
        $('#cantidadAsignadaAlProyectoDesdeLaEmpresa'+numMatEmpre).removeAttr('disabled');
      }
      else{
        $('#cantidadAsignadaAlProyectoDesdeLaEmpresa'+numMatEmpre).attr('disabled',"");
      }

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
  $(document).on("click","#agregarMaterialesAlProyecto",function(){
    $('input[name="seleccionMaterialesDeLaEmpresa[]"]:checked').each(function() {
      //$(this).val() es el valor del checkbox correspondiente
      var checks = $(this).val();
      var num = $(this).attr("numMatEmpre");

      var reserva=parseInt($("#contMaterialPozo"+checks).text());
      var asignacion=parseInt($("#cantidadAsignadaAlProyectoDesdeLaEmpresa"+num).val());
      var nomMaterial=$("#nombreMaterialParaMostrar"+checks).text();

      //compara si el campo de asignacion es menor o igual a la reserva
      var apto =verificaCantidad(reserva,asignacion);
      var menor = menorACero(asignacion);
            if (apto == true && menor==false){
              AsignarRecursosMatAlProyectoDeLaEmpresa(checks,num);     
            }
            if(apto == true && menor==true){
              $("#validadcionModalMaterialPozo").html("");
              //alert("no apto  "+" res "+ reserva+" asignacion "+ asignacion +" " +apto)
              alerta = "Imposible asignar cantidad menor a 0 al material "+nomMaterial+"<br>";
              nalerta += $("#validadcionModalMaterialPozo").html()+alerta;
              $("#validadcionModalMaterialPozo").html(nalerta)
            }
            if(apto == false && menor == false){
              $("#validadcionModalMaterialPozo").html("");
              //alert("no apto  "+" res "+ reserva+" asignacion "+ asignacion +" " +apto)
              alerta = "No existen suficientes unidades de "+nomMaterial +" para la asignacion  "+"<br>";
              nalerta += $("#validadcionModalMaterialPozo").html()+alerta;
              $("#validadcionModalMaterialPozo").html(nalerta);

            }
    });
  })
  
  function menorACero(asignacion){
    if(asignacion < 0 ){
      return true;
    }
    else{
      return false;
    }
  }
  
  function limpiaModal(){
    $("#validadcionModalMaterialPozo").html("");
    alerta= "";
    nalerta = "";
  }

  function AsignarRecursosMatAlProyectoDeLaEmpresa(check,num){
    //ambiente activdad cargo
    <?php $this->load->helper('url') ;?>
    var ruta = "<?php echo base_url().'index.php/AsignarRecursosMatAlProyectoDeLaEmpresa' ;?>";
    var dataString = 'idMat='+check+'&cant='+$('#cantidadAsignadaAlProyectoDesdeLaEmpresa'+num).val();
    $.ajax({
      type: 'POST',
      url : ruta,
      data : dataString,
      success: function(data){
          listarMaterialesDelProyectoEnPozo();
          cargarMaterialesDelPozo();
      }
    })
  }

</script>