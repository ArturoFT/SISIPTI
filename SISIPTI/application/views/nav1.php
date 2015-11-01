<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url()."index.php/adm_inicio";?>">SISIPTI</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
        <li><a class="spanProyectoS" href="<?php echo base_url()."index.php/abrir/listaProyectos";?>"><?php if (isset($nombPS)) {echo "Proyecto Seleccionado: ".$nombPS;}?> </a></li>        
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administración del Proyecto<span class="caret"></span></a>
          <ul id="ul-proyecto" class="dropdown-menu">
          <li><a href="<?php echo base_url()."index.php/abrir/listaProyectos";?>">Seleccionar Proyecto</a></li>
          <?php if (isset($idPS)) {
            if ($idPS!=-1) { 
          
            echo '<li><a href="'.base_url()."index.php/abrir/administrarAmbientes".'">Ambientes</a></li>';
            echo '<li><a href="'.base_url()."index.php/abrir/administrarActividades".'">Actividades</a></li>';
            echo '<li><a href="'.base_url()."index.php/administrar_materiales".'">Materiales</a></li>';
            echo '<li><a href="'.base_url()."index.php/administrar_trabajadores".'">Trabajadores</a></li>';
            echo '<li><a href="'.base_url()."index.php/asignarRecursos".'">Asignación de Recursos</a></li>';      

          
           }} ?>

          </ul>
        </li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Recursos de la Empresa<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url()."index.php/abrir/admTrabajadoresEmpresa";?>">Trabajadores</a></li>
            <li><a href="<?php echo base_url()."index.php/abrir/admMaterialesEmpresa";?>">Materiales</a></li>
            <li><a href="<?php echo base_url()."index.php/abrir/admUsuarios";?>">Usuarios</a></li>
          </ul>
        </li> 
        <li><a href="<?php echo base_url()."index.php/abrir/consultI";?>">Incidencias</a></li>       
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $nombUsuario ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Mi perfil</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url()."index.php/cerrarSesion";?>">Cerrar Sesion</a></li>
          </ul>
        </li>

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>