<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->route('login');
});


Auth::routes();

Route::post('/login/custom', ['uses' => 'admin\LoginController@login', 'as' => 'login.custom']);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('cliente', 'admin\OrdenTrabajoController@listarOrdenesClinetes')->name('cliente');
    Route::get('ver-orden-cliente/{id}', 'admin\OrdenTrabajoController@verOrdenCliente')->name('ver-orden-cliente');
    Route::get('historial-cliente','admin\OrdenTrabajoController@listarHistorialOrdenesClinetes')->name('historial-cliente');
    Route::get('/administrador', function () {
        return view('admin/dashboard/inicio/inicio');
    })->name('administrador');


    Route::get('/tecnico-principal', function () {
        return view('admin.base.base_tecnicoPrincipal');
    })->name('tecnico-principal');


    Route::get('/tecnico-secundario', function () {
        return view('admin.base.base_tecnicoSecundario');
    })->name('tecnico-secundario');


    ////<<<<<---------------------------------RUTAS PARA EL ADMISNITRADOR    ---------->>>

    /// esta ruta lista todas las ordenes asignadas al tecnico principal
    Route::get('listar-ordenes-asignadas-admin', 'admin\OrdenTrabajoController@listarOrdenesAsignadasAdministrador')->name('listar-ordenes-asignadas-admin');
    Route::get('listar-ordenes', 'admin\OrdenTrabajoController@listarOrdenes')->name('listar-ordenes');
    /// ruta pa eliminar las ordenes  es importante recordar que una vez realizado esta accion no habara reversa d ela accion
    Route::delete('eliminar-orden', 'admin\OrdenTrabajoController@destroy')->name('eliminar-orden');
    Route::get('orden-papelera-detalle/{id}', 'admin\OrdenTrabajoController@ordenPapeleraDetalle')->name('orden-papelera-detalle');

    //ruta get, pots, put, delete para registrar usuarios
    Route::resource('usuario', 'admin\UserController');
    //Route::put('usuario-cambiar-estado/{$id}', 'admin\UserController@updateEstado')->name('usuario-cambiar-estado');
    //url para ver los datos del usuario
    Route::get('ver-admin/{id}', 'admin\UserController@verAdmin')->name('ver-admin');
    //url para cambiar el estado del usuario
    Route::put('estado-admin', 'admin\UserController@recargarSeccion')->name('estado-admin');


    //ur para la bsuqueda del cliente por el numero de cedula
    Route::get('busqueda-cliente/{query}', 'admin\UserController@busquedaCliente')->name('busqueda-cliente');
    Route::get('lista-tecnicos', 'admin\UserController@tecnicos')->name('lista-tecnicos');
    Route::get('busqueda-cliente-equipo', 'admin\EquipoController@busquedaCliente')->name('busqueda-cliente-equipo');
    Route::put('estado-equipo', 'admin\EquipoController@desactivarEquipo')->name('estado-equipo');


    ///rutas para gestionar los clientes
    Route::resource('clientes', 'admin\ClienteController');
    //url para cambiar el estado del usuario
    Route::put('estado-cliente', 'admin\ClienteController@descativarCliente')->name('estado-cliente');


    //ruta para la gestion de equipos

    Route::resource('equipos', 'admin\EquipoController');
    Route::get('busqueda-equipo/{query}', 'admin\EquipoController@busquedaEquipo')->name('busqueda-equipo');

    //ruta para la gestion de tecnicos

    Route::resource('tecnicos', 'admin\TecnicoController');
    Route::get('busqueda-tecnicos', 'admin\TecnicoController@busquedaTecnicos')->name('busqueda-tecnicos');
    //url para cambiar el estado del usuario
    Route::put('estado-tecnico', 'admin\TecnicoController@descativarTecnico')->name('estado-tecnico');


    //ruta para la gestion de registro de equipos

    Route::resource('registro-equipos', 'admin\RegistroEquipoController');


    Route::put('cambiar-fecha', 'admin\RegistroEquipoController@updateFecha')->name('cambiar-fecha');

    // ruta para las ordenes


    Route::resource('ordenes', 'admin\OrdenTrabajoController');
    Route::post('generarOrden', 'admin\OrdenTrabajoController@genererOrden')->name('generarOrden');
    Route::get('busqueda-ordenes', 'admin\OrdenTrabajoController@busquedaOrden')->name('busqueda-ordenes');
    Route::put('asignar-orden', 'admin\OrdenTrabajoController@asignarOrden')->name('asignar-orden');
    Route::get('listar-ordenes-finalizadas-admin', 'admin\OrdenTrabajoController@listarOrdenesFinalizadasAdmin')->name('listar-ordenes-finalizadas-admin');
    Route::get('revision-orden-tecnico/{id}', 'admin\OrdenTrabajoController@revisionOrdenTecnico')->name('revision-orden-tecnico');
    Route::get('revision-orden-admin-finalizada/{id}', 'admin\OrdenTrabajoController@revisionOrdenTecnicoFinalizada')->name('revision-orden-admin-finalizada');
    Route::put('anular-orden', 'admin\OrdenTrabajoController@anularOrden')->name('anular-orden');


    ///// <<<<<<---------------------------------Rutas para los tecnicos principales------->>>>>>>>>>>>>>>>>>

    /// esta ruta lista todas las ordenes asignadas al tecnico principal
    Route::get('listar-ordenes-asignadas', 'admin\OrdenTrabajoController@listarOrdenesASIGNADAS')->name('listar-ordenes-asignadas');
    //ruta para realizar los cambios de fecha por parte del tecnico pricipal
    Route::put('cambiar-fecha-orden', 'admin\OrdenTrabajoController@salidaOrden')->name('cambiar-fecha-orden');
    //ruta para agreagar la solucion por parte del tecnico principal
    Route::put('agregar-solucion/{id}', 'admin\OrdenTrabajoController@solucionOrden')->name('agregar-solucion');
    //ruta para rechazar la orden de trabajo por algun inconveniente
    Route::put('rechazar-orden', 'admin\OrdenTrabajoController@rechazarOrden')->name('rechazar-orden');
    // esta ruta muestra todas los ordenes terminadas del tecnico principal
    Route::get('listar-ordenes-finalizadas', 'admin\OrdenTrabajoController@listarOrdenesFinalizadas')->name('listar-ordenes-finalizadas');
    // esta ruta permite conocer el detalle de la ordenes que el tecnico ha culminado
    Route::get('revision-orden-tecnico-finalizada/{id}', 'admin\OrdenTrabajoController@revisionOrdenTecnicoFinalizada')->name('revision-orden-tecnico-finalizada');


    ///<<<<<<<<<<<<<<<<<<<<<<--------------RUTAS PARA LOS TECNICOS SECUNDARIOS -------------------------->>>>>>>>>>>>>>>>>

    Route::get('listar-ordenes-ingresos', 'admin\OrdenTrabajoController@listarOrdenes')->name('listar-ordenes-ingresos');
    Route::get('crear-ordenes', 'admin\OrdenTrabajoController@index')->name('crear-ordenes');
    Route::get('ver-orden/{id}', 'admin\OrdenTrabajoController@show')->name('ver-orden');


    //// <------- RUTAS PARA LOS PDFS ---------->>>>

    Route::get('orden-pdf/{id}', 'admin\OrdenTrabajoController@pdfOrdenes')->name('orden-pdf');
    Route::get('orden-pdf-ingreso/{id}', 'admin\OrdenTrabajoController@pdfOrdenesIngreso')->name('orden-pdf-ingreso');

    // <-------    rutas para los registros que estan en la papelera   -------------------->

    //ruta para el listar todos los usuarios inhabilitados
    Route::get('papelera-admins', 'admin\UserController@pepeleraAdmins')->name('papelera-admins');
    //ruta para el listar todos los clientes inhabilitados
    Route::get('papelera-clientes', 'admin\ClienteController@papeleraClientes')->name('papelera-clientes');
    //ruta para el listar todos los tecnicos inhabilitados
    Route::get('papelera-tecnicos', 'admin\TecnicoController@papeleraTecnico')->name('papelera-tecnicos');
    //ruta para el listar todos los equipos inhabilitados
    Route::get('papelera-equipos', 'admin\EquipoController@papeleraEquipos')->name('papelera-equipos');
    // ruta para listar las ordenes anuladas
    Route::get('listar-ordenes-anuladas', 'admin\OrdenTrabajoController@listarOrdenesAnuladas')->name('listar-ordenes-anuladas');


});
