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

///RUTA VACIA QUE DEDIRIJE  AL LOGIN A LOS USUARIOS
Route::get('/', function () {
    return redirect()->route('login');
});

///RUTAS PUBLICAS DEL LOGIN
Auth::routes();

////RUTA DEL LOGIN PERZONALIZADO
Route::post('/login/custom', ['uses' => 'admin\LoginController@login', 'as' => 'login.custom']);

///RUTA DEL HOME
Route::get('/home', 'HomeController@index')->name('home');

///GRUPO DE RUTAS PARA CONTROLAR QUE LOS USUARIOS QUE NO TENGAN LOS ROLES NO TENGAN ACCESOS  A LOS METODOS
/// QUE NO ESTAN AUTORZADOS
/// INICIAMOS CON EL GRUPO DE RUTAS PROPIAS DEL ADMINITRADOR
/// COMO EXISTEN VARIAS RUTAS QUE TIENEN UN CONTROLADOR DE RECURSOS
/// EL AGRUPAMIENTO SE LO HACE POR LOS PERMISOS QUE TIENE CADA UNO DE LOS ROLES


/// RUTAS PARA ROLES CON PERMISOS SOLO DE LECTURA SOLO DE LECTURA O CONSULTA
Route::group(['middleware' => ['permission:read cliente|read equipo']], function () {
    //ruta para la bsuqueda del cliente por el numero de cedula
    Route::get('busqueda-cliente/{query}', 'admin\UserController@busquedaCliente')->name('busqueda-cliente');
    ///RUTA PARA LA BUSQUEDA DE LOS EQUIPOS PARA LOS USUARIOS CON PERMISOS DE LECTURA DE EQUIPO Y CLINETES
    Route::get('busqueda-equipo/{query}', 'admin\EquipoController@busquedaEquipo')->name('busqueda-equipo');
});

///RUTAS PARA PERMISOS PARA CREAR ORDENES POR POST
Route::group(['middleware' => ['permission:create orden']], function () {
    ///RURA PRINCIPAL DE CREAR UNA ORDEN DE TRABAJO
    Route::post('generarOrden', 'admin\OrdenTrabajoController@genererOrden')->name('generarOrden');
});

///<<<<<<<<<<<<<<<<<<<<<<--------------RUTAS PARA LOS TECNICOS SECUNDARIOS -------------------------->>>>>>>>>>>>>>>>>
Route::group(['middleware' => ['role:secundario']], function () {
    Route::get('/tecnico-secundario', function () {
        return view('admin.base.base_tecnicoSecundario');
    })->name('tecnico-secundario');
    //RUTA QUE LISTA LAS ORDENES CREADAS POR EL TECNICO SECUNDARIO
    Route::get('listar-ordenes-ingresos', 'admin\OrdenTrabajoController@listarOrdenes')->name('listar-ordenes-ingresos');
    ///RUTA PARA CREAR ORDENES
    Route::get('crear-ordenes', 'admin\OrdenTrabajoController@index')->name('crear-ordenes');
    ///RUTA PARA VER LA ORDEN CREADA POR EL TECNICO SECUNDARIO
    Route::get('ver-orden/{id}', 'admin\OrdenTrabajoController@show')->name('ver-orden');
    ///RUTA PARA VALIDADR LOS DATOS EN EL CONTROLADOR DE ORDENESTRABAJOCONTROLLER METODO STORE
    Route::post('registro-validar', 'admin\OrdenTrabajoController@store')->name('registro-validar');
});

///// <<<<<<---------------------------------Rutas para los tecnicos principales------->>>>>>>>>>>>>>>>>>
Route::group(['middleware' => ['role_or_permission:principal']], function () {
    Route::get('/tecnico-principal', function () {
        return view('admin.base.base_tecnicoPrincipal');
    })->name('tecnico-principal');

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
    Route::get('revision-orden-tecnico/{id}', 'admin\OrdenTrabajoController@revisionOrdenTecnico')->name('revision-orden-tecnico');
});


Route::group(['middleware' => ['role:admin']], function () {

    ////<<<<<---------------------------------RUTAS PARA EL ADMISNITRADOR    ---------->>>.
    Route::get('/administrador', function () {
        return view('admin/dashboard/inicio/inicio');
    })->name('administrador');

    ////<<<<<<----------------------RUTAS PARA LAS ORDENES -----------------<<<<<<<<<<<<<<<<<<<
    /// esta ruta lista todas las ordenes asignadas al tecnico principal
    Route::get('listar-ordenes-asignadas-admin', 'admin\OrdenTrabajoController@listarOrdenesAsignadasAdministrador')->name('listar-ordenes-asignadas-admin');
    Route::get('listar-ordenes', 'admin\OrdenTrabajoController@listarOrdenes')->name('listar-ordenes');
    Route::get('revision-orden-admin-finalizada/{id}', 'admin\OrdenTrabajoController@revisionOrdenTecnicoFinalizada')->name('revision-orden-admin-finalizada');
    // CONTROLADOR DE RECURSOS PARA LAS RUTAS DE LAS ORDENES
    Route::resource('ordenes', 'admin\OrdenTrabajoController');
    //// QUETA QUE PERMITE BUSCAR UNA ORDEN DE TRABAJO
    Route::get('busqueda-ordenes', 'admin\OrdenTrabajoController@busquedaOrden')->name('busqueda-ordenes');
    ///RUTA PARA PODER ASIGNAR UNA ORDEN ALUSUARIO
    Route::put('asignar-orden', 'admin\OrdenTrabajoController@asignarOrden')->name('asignar-orden');
    ///RUTA QUE MUESTRA LAS ORDENES FINALIZADAS EN LA VISTA DEL ADMINITRADOR
    Route::get('listar-ordenes-finalizadas-admin', 'admin\OrdenTrabajoController@listarOrdenesFinalizadasAdmin')->name('listar-ordenes-finalizadas-admin');
    ///RUTA PARA VISUALIZAR LO ORDEN CUANDO ESTA HAYA FINALIZADO
    Route::get('revision-orden-admin-finalizada/{id}', 'admin\OrdenTrabajoController@revisionOrdenTecnicoFinalizada')->name('revision-orden-admin-finalizada');
    ///RUTA QUE PERMITE ELIMINAR UNA ORDEN SE TRABAJA EN SEGUNDO PLANO CON AJAX
    Route::put('anular-orden', 'admin\OrdenTrabajoController@anularOrden')->name('anular-orden');


    //////////////<<<<<<<<<<<<<<<<<<<---------------RUTAS PARA EL USUARIO-------------------------->>>>>>>>>>>>>>>>>>>>>>>
    //ruta DEL CONTROLADOR DE RECURSOS get, pots, put, delete para registrar usuarios
    Route::resource('usuario', 'admin\UserController');
    //url para ver los datos del usuario
    Route::get('ver-admin/{id}', 'admin\UserController@verAdmin')->name('ver-admin');
    //url para cambiar el estado del usuario
    Route::put('estado-admin', 'admin\UserController@recargarSeccion')->name('estado-admin');

    //////<-----------<<<<----------------RUTAS PARA LA GESTION DE LOS TECNICOS ----------->>>>>>>>>>>>>>
    Route::get('lista-tecnicos', 'admin\UserController@tecnicos')->name('lista-tecnicos');
    //RUTAS DEL CONTROLADOR DE RECURSOS PARA LOS TECNICOS
    Route::resource('tecnicos', 'admin\TecnicoController');
    /// RUTA PARA LA BUSQUEDA POR AJAX DEL TECNICO
    Route::get('busqueda-tecnicos', 'admin\TecnicoController@busquedaTecnicos')->name('busqueda-tecnicos');
    //url para cambiar el estado del TECNICO
    Route::put('estado-tecnico', 'admin\TecnicoController@descativarTecnico')->name('estado-tecnico');


    ////////<<<<<<<<<<-------------<<<<<<<<<---------RUTAS PARA LA GESTION DE EQUIPOS -------------->>>>>>>--------->>>>>>>>>>>>>
    /// //RUTAS DEL CONTROLADOR DE RECURSOS DE LOS EQUIPOS
    Route::resource('equipos', 'admin\EquipoController');
    /// RUTA PERMITE BUSCAR LOS EQUIPOS VIA AJAX
    Route::get('busqueda-cliente-equipo', 'admin\EquipoController@busquedaCliente')->name('busqueda-cliente-equipo');
    ///RUTA PARA HABILITAR O DESAHABILTAR LOS EQUIPOS
    Route::put('estado-equipo', 'admin\EquipoController@desactivarEquipo')->name('estado-equipo');


    /////<<<<<<<<<<<------------------<<<<<<<<<<----------RUTAS PARA LA GESTION DE CLIENTES ------------->>>>>>>>>>---------->>>>>>>>>
    ///rutas para gestionar los clientes
    Route::resource('clientes', 'admin\ClienteController');
    //url para cambiar el estado del usuario
    Route::put('estado-cliente', 'admin\ClienteController@descativarCliente')->name('estado-cliente');


    //////////<<<<<<<---------------<<<<<<<<<<<<<<----------------RUTAS PARA LA GESTION DEL REGISTRO DE LOS EQUIPOS -------->>>>>>>>>>----------->>>>>>>>>

    //ruta para la gestion de registro de equipos
    Route::resource('registro-equipos', 'admin\RegistroEquipoController');
    ///RUTA PARA CAMBIAR LAS FECHAS DE SALIDA DE CADA EUIPO REGISTRADO
    Route::put('cambiar-fecha', 'admin\RegistroEquipoController@updateFecha')->name('cambiar-fecha');


    // <<<<<<<<-------<<<<<<<<<<<<<----------- rutas para los registros que estan en la papelera  --------->>>>>>>>>>>>>>> -------------------->>>>>>>>>>>>>>>>>
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
    /// ruta pa eliminar las ordenes  es importante recordar que una vez realizado esta accion no habara reversa d ela accion
    Route::delete('eliminar-orden', 'admin\OrdenTrabajoController@destroy')->name('eliminar-orden');
    Route::get('orden-papelera-detalle/{id}', 'admin\OrdenTrabajoController@ordenPapeleraDetalle')->name('orden-papelera-detalle');

});

////<<<<-------------------------RUTAS DE METODOS GET---------->>>>>>>>>>>>>>>>>>>
/// RUTAS PARA ROLES CON PERMISOS SOLO DE LECTURA SOLO DE LECTURA O CONSULTA
Route::group(['middleware' => ['permission:read orden']], function () {

    //// <------- RUTAS PARA LOS PDFS ---------->>>>
    Route::get('orden-pdf/{id}', 'admin\OrdenTrabajoController@pdfOrdenes')->name('orden-pdf');
    Route::get('orden-pdf-ingreso/{id}', 'admin\OrdenTrabajoController@pdfOrdenesIngreso')->name('orden-pdf-ingreso');

});


///GRUPOP DE RUTAS PROTECGIDAS PARA ACCESO UNICO DE LOS USUARIOS CON ROL DE CLIENTE
Route::group(['middleware' => ['role:cliente']], function () {
    ///RUTA LOS LA VISTA INICIAL DEL CLIENTE
    Route::get('cliente', 'admin\OrdenTrabajoController@listarOrdenesClinetes')->name('cliente');
    //RUAT PARA VISUALIZAR LA ORDEN EN LA VENTANA DEL CLIENTE
    Route::get('ver-orden-cliente/{id}', 'admin\OrdenTrabajoController@verOrdenCliente')->name('ver-orden-cliente');
    ///RUTA QUE LISTA TODAS LAS ORDENES DE TRABJO PERTENECIENTES AL USUARIO LOGEADO
    Route::get('historial-cliente', 'admin\OrdenTrabajoController@listarHistorialOrdenesClinetes')->name('historial-cliente');
});



