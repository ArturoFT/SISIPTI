<div class="form-group">
<?php 

echo "Descripcion: ".$datos->Descripcion;
echo '</div>';
echo "<div>";
echo "Actividad Involucrada:  ".$datos->actividadInvolucrada;
echo "</div>";  
echo "<div >";
echo "Plan de Respuesta:  ".$datos->planRespuesta; 
echo '</div>';
echo "<div >"; 
echo "Detalles Adicionales:  ".$datos->detallesAdicional;
echo "</div>"; 
echo "<div >";
echo "Ambiente:  ".$datos->nombAmbiente;
echo "</div>"; 





?>


 <div class="form-group">
				    <label>Responder:<?php// echo form_error('descripcion');?></label>
				    <textarea class="form-control" name="descripcion" placeholder="..." value="<?php echo set_value('descripcion'); ?>" required></textarea>
				  </div>
 <button type="submit" class="btn btn-success btn-lg btn-block"  name="insertarRecursos">Responder</button>		
	