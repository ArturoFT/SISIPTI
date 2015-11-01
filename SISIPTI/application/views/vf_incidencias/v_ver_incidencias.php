<?php  
 $nid = array(
		'name' => 'idIn',		
		'type'=>'hidden',
		'id'=>'ID'
	
		
		);?>
 <div class="container" >
         <div class="row" align="center">
           <h1 class="page-header">
               S I S I P T I
           </h1>
 		</div>
 		<?= form_open('/cf_admateriales/c_admateriales/ingresar','name="f1"') ?>
 			
	 <br>
	 

	<div>
		<?= $tabla;?>
	</div>
	</form>
</div>


<script type="text/javascript">
function seleccionar_todo(){ 
   for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=0 
}

</script>


	<!-- Ajax -->	
 <?php $this->load->helper('form');echo form_open_multipart("abrir/detalleIn");?>
  <div class="modal fade" id="Nuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
 
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Nuevo</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center">INGRESO A DETALLE</h4>
      </div>
      <div id="nuevaA" class="modal-body">
            <form role="form">
              <div class="form-group">
           <div class="form-group">
				
          

			<div class="form-group">	
					<?= form_input($nid)?>
			</div>

  		 

	  
           </form>      
      </div>
      <div class="modal-footer" align="center"> 
      <button type="submit" class="btn btn-success btn-lg btn-block"  name="insertarRecursos">Detalle</button>		
					
	   
        <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">Cerrar</button>
              
      </div>
    </div>
  </div>

</div>

	 </form>