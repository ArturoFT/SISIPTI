<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "c_usuario";
$route['404_override'] = '';


//Rutas usuario
$route['login'] = "c_usuario/login";
$route['cerrarSesion'] = "c_usuario/cerrarSesion";


//Cuya

$route['abrir/admTrabajadoresEmpresa'] = "cf_adtrabajador/c_admtrabajador";
$route['abrir/admMaterialesEmpresa'] = "cf_admateriales/c_admateriales";
$route['abrir/admUsuarios'] = "cf_adusuario/c_adusuario";

$route['abrir/incidencias'] = "cf_incidencias/c_incidencias/abrir_incidencias";
$route['agregar/registrarIncidencias'] = "cf_incidencias/c_incidencias/registrar";
$route['abrir/detalleIn'] = "cf_incidencias/c_incidencias/detalle";
$route['abrir/consultI'] = "cf_incidencias/c_incidencias/ver";



//Massimo
$route['traer/proyectos'] = "c_administrarProyecto/traer_proyectos";
$route['traer/tipoProyecto'] = "c_administrarProyecto/traer_tipoProyecto";
$route['traer/clienteProyecto'] = "c_administrarProyecto/traer_clienteProyecto";
$route['traer/ambientePrecargado'] = "c_administrarAmbientes/traer_ambientePrecargado";
$route['traer/actividadesPrecargadasAmbiente'] = "c_administrarAmbientes/traer_actividadesPrecargadasAmbiente";
$route['traer/ambientes'] = "c_administrarAmbientes/traer_ambientes";

$route['abrir/listaProyectos'] = "c_administrarProyecto/abrir_listaProyectos";
$route['abrir/agregarProyecto'] = "c_administrarProyecto/abrir_agregarProyecto";
$route['abrir/modificarProyecto'] = "c_administrarProyecto/abrir_modificarProyecto";
$route['abrir/administrarAmbientes'] = "c_administrarAmbientes/abrir_administrarAmbientes";
$route['abrir/agregarAmbiente'] = "c_administrarAmbientes/abrir_agregarAmbiente";
$route['abrir/modificarAmbiente'] = "c_administrarAmbientes/abrir_modificarAmbiente";
$route['abrir/administrarActividades'] = "c_administrarActividades/abrir_administrarActividades";
$route['abrir/agregarActividad'] = "c_administrarActividades/abrir_agregarActividad";
$route['abrir/modificarActividad'] = "c_administrarActividades/abrir_modificarActividad";

$route['crear/proyecto'] = "c_administrarProyecto/crear_proyecto";
$route['crear/ambiente'] = "c_administrarAmbientes/crear_ambiente";
$route['crear/actividad'] = "c_administrarActividades/crear_actividad";

$route['seleccionar/proyecto'] = "c_administrarProyecto/seleccionar_proyecto";

$route['suspender/proyecto'] = "c_administrarProyecto/suspender_proyecto";
$route['reanudar/proyecto'] = "c_administrarProyecto/reanudar_proyecto";

$route['modificar/proyecto'] = "c_administrarProyecto/modificar_proyecto";
$route['modificar/ambiente'] = "c_administrarAmbientes/modificar_ambiente";
$route['modificar/actividad'] = "c_administrarActividades/modificar_actividad";


$route['little/actualizarNombre'] = "c_administrarProyecto/little_actualizarNombre";





//Yarovy
$route['asignarRecursos'] = "c_AsignarRecursos/abrirAsignarRecursosHumanos";
$route['listarRecursosMaterialesAsignados'] = "c_AsignarRecursos/listarRecursosMaterialesAsignados";
$route['listarRecursos'] = "c_AsignarRecursos/listar";
$route['listarTrabajadoresProyecto'] = "c_AsignarRecursos/listarTrabajadoresProyecto";
$route['listaMaterialesProyecto'] = "c_AsignarRecursos/listaMaterialesProyecto";
$route['listarRecursosHumanosAsignados'] = "c_AsignarRecursos/listarRecursosHumanosAsignados";
$route['cargarActividadesPorAmbiente'] = "c_AsignarRecursos/cargarActividadesPorAmbiente";
$route['RegistraAsignacionRecursos'] = "c_AsignarRecursos/RegistraAsignacionRecursos";
$route['RegistrarAsignacionMat'] = "c_AsignarRecursos/RegistrarAsignacionMat";
$route['usuarios'] = "c_administrarUsuarios/usuarios";
$route['CargarUsuarios'] = "c_administrarUsuarios/CargarUsuarios";
$route['administrar_materiales'] = "c_administrar_recursos/c_AdministrarMateriales/abrir";
$route['administrar_trabajadores'] = "c_administrar_recursos/c_AdministrarTrabajadores/abrir";
$route['listarTrabajadoresProyectoLibres'] = "c_administrar_recursos/c_AdministrarTrabajadores/listarTrabajadoresProyectoLibres";
$route['agregarTrabajadoresAlProyecto'] = "c_administrar_recursos/c_AdministrarTrabajadores/agregarTrabajadoresAlProyecto";
$route['detallarTrabajador'] = "c_administrar_recursos/c_AdministrarTrabajadores/detallarTrabajador";
$route['EliminarDeProyecto'] = "c_administrar_recursos/c_AdministrarTrabajadores/EliminarDeProyecto";
$route['agregarTrabajadoresAlPozoDelProyecto'] = "c_administrar_recursos/c_AdministrarTrabajadores/agregarTrabajadoresAlPozoDelProyecto";
$route['listarMaterialesDelProyectoEnPozo'] = "c_administrar_recursos/c_AdministrarMateriales/listarMaterialesDelProyectoEnPozo";
$route['detallarMaterial'] = "c_administrar_recursos/c_AdministrarMateriales/detallarMaterial";
$route['cargarMaterialesDelPozo'] = "c_administrar_recursos/c_AdministrarMateriales/cargarMaterialesDelPozo";
$route['AsignarRecursosMatAlProyectoDeLaEmpresa'] = "c_administrar_recursos/c_AdministrarMateriales/AsignarRecursosMatAlProyectoDeLaEmpresa";



//Crashmona
$route['abrir/consultarActividades'] = "c_consultarActividades/abrir_consultarActividades";
$route['abrir/consultarAmbientesCliente'] = "c_consultarActividades/abrir_consultarAmbientes";
$route['abrir/consultarActividadesCliente'] = "c_consultarActividades/abrir_consultaActividadesCliente";
$route['abrir/consultarProyectosIngeniero']="c_consultarAmbientes/abrir_consultarProyectos";
$route['abrir/consultarAmbientesIngeniero']="c_consultarAmbientes/abrir_consultarAmbientes";
$route['abrir/consultarActividadesIngeniero']="c_consultarAmbientes/abrir_consultarActividades";
$route['abrir/consultarTrabajadoresIngeniero']="c_consultarAmbientes/abrir_consultarTrabajadores";



//Rutas de paginas
$route['abrirLogin'] = "c_usuario/abrir_login";

$route['adm_activides'] = "c_usuario/abrir_adm_gestionarProyecto_actividades";

/* End of file routes.php */
/* Location: ./application/config/routes.php */