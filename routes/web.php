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
    return view('user.base.index');
});

Auth::routes();

Route::post('/login/custom', ['uses' => 'admin\LoginController@login', 'as' => 'login.custom']);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', function () {
        return view('admin/dashboard/inicio/inicio');
    })->name('dashboard');
    Route::get('/tecnico', function () {
        return view('admin/dashboard/registros/registroUsuarios');
    })->name('tecnico');
    Route::get('/user', function () {
        return view('welcome');
    })->name('user');

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
    Route::get('listar-ordenes', 'admin\OrdenTrabajoController@listarOrdenes')->name('listar-ordenes');
    Route::get('busqueda-ordenes', 'admin\OrdenTrabajoController@busquedaOrden')->name('busqueda-ordenes');
    Route::put('asignar-orden', 'admin\OrdenTrabajoController@asignarOrden')->name('asignar-orden');
    Route::get('listar-ordenes-asignadas', 'admin\OrdenTrabajoController@listarOrdenesASIGNADAS')->name('listar-ordenes-asignadas');
    Route::get('revision-orden-tecnico/{id}', 'admin\OrdenTrabajoController@revisionOrdenTecnico')->name('revision-orden-tecnico');
    Route::put('cambiar-fecha-orden', 'admin\OrdenTrabajoController@salidaOrden')->name('cambiar-fecha-orden');


    // <-------    rutas para los registros que estan en la papelera   -------------------->

    //ruta para el listar todos los usuarios inhabilitados
    Route::get('papelera-admins', 'admin\UserController@pepeleraAdmins')->name('papelera-admins');
    //ruta para el listar todos los clientes inhabilitados
    Route::get('papelera-clientes', 'admin\ClienteController@papeleraClientes')->name('papelera-clientes');
    //ruta para el listar todos los tecnicos inhabilitados
    Route::get('papelera-tecnicos', 'admin\TecnicoController@papeleraTecnico')->name('papelera-tecnicos');
    //ruta para el listar todos los equipos inhabilitados
    Route::get('papelera-equipos', 'admin\EquipoController@papeleraEquipos')->name('papelera-equipos');

});
