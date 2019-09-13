<?php

namespace App\Http\Controllers\admin;

use App\Equipo;
use App\OrdenTrabajo;
use App\RegistroEquipo;
use App\Tecnico;
use App\TecnicoOrdenTrabajo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\Return_;
use Barryvdh\DomPDF\Facade as PDF;

class OrdenTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //consultamos todas las ordenes existentes para enviar a la vista 
        // y asi conseguir el numero de orden 
        $ordenes = OrdenTrabajo::all();

        //obtenemos el usaurio autenticado en el sistema para enviar sus datos al formulario
        // ene ste caso debera ser el tecnicio secundario
        $userAuth = Auth::id();
        $user = User::find($userAuth);


        // obteneos la fecha actual del servidor
        $mytime = Carbon::now('America/Guayaquil');
        $fecha_hora = $mytime->toDateString();


        // validamos que exista una orden
        $codigo_orden = 0;
        if (count($ordenes) != 0) {
            //obtnemos el ultimo registro
            $ultimoregistro = $ordenes->last();

            // encontramos el nuemro de codigo para mostrarlo en el DOM
            $codigo_orden = $ultimoregistro->codigo_or + 1;


            if ($user->tipo_p == 0) {
                // buscamos los datos del tecnico
                $tecnico = $user;
                $nombres_tec = $tecnico->nombre_p . '  ' . $tecnico->apellido_p;
                // retornamos la visat con los datos del tecnico y los datos de las ordenes
                return view('admin.dashboard.ordenes.index', compact('codigo_orden', 'nombres_tec', 'fecha_hora'));
            } else {
                // buscamos los datos del tecnico
                $tecnico = Tecnico::find($userAuth);
                $nombres_tec = $tecnico->user->nombre_p . '  ' . $tecnico->user->apellido_p;
                if ($tecnico->tipo_t == 1) {
                    // retornamos la visat con los datos del tecnico y los datos de las ordenes
                    return view('admin.dashboard.ordenes.registroEquipoTecSecundario', compact('codigo_orden', 'nombres_tec', 'fecha_hora'));
                } else {
                    return view('errores.errorPaginaVacia');
                }
            }

        } else {
            // si no existe ordenes registradas en la base de datos  se designara el valor de uno a los nueros de ordenes

            $codigo_orden = 1;

            if ($user->tipo_p == 0) {
                // buscamos los datos del tecnico
                $tecnico = $user;
                $nombres_tec = $tecnico->nombre_p . '  ' . $tecnico->apellido_p;
                // retornamos la visat con los datos del tecnico y los datos de las ordenes
                return view('admin.dashboard.ordenes.index', compact('codigo_orden', 'nombres_tec', 'fecha_hora'));
            } else {
                // buscamos los datos del tecnico
                $tecnico = Tecnico::find($userAuth);
                $nombres_tec = $tecnico->user->nombre_p . '  ' . $tecnico->user->apellido_p;
                if ($tecnico->tipo_t == 1) {
                    // retornamos la visat con los datos del tecnico y los datos de las ordenes
                    return view('admin.dashboard.ordenes.registroEquipoTecSecundario', compact('codigo_orden', 'nombres_tec', 'fecha_hora'));
                } else {
                    return view('errores.errorPaginaVacia');
                }
            }
        }


    }


    public function busquedaOrden(Request $request)
    {
        $query = trim($request->get('query'));
        if ($query != '') {
            $ordenes = DB::table('users')
                ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                ->select(
                    'users.*',
                    'orden_trabajos.*'
                )
                ->where('orden_trabajos.codigo_or', 'like', '%' . $query . '%')
                ->orWhere('users.cedula_p', 'like', '%' . $query . '%')
                ->paginate(3);
            return view('admin.dashboard.ordenes.listarOrdenes', compact('ordenes'));
        } else {
            $ordenes = DB::table('users')
                ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                ->select(
                    'users.*',

                    'orden_trabajos.*'
                )->paginate(3);
            return view('admin.dashboard.ordenes.listarOrdenes', compact('ordenes'));
        }
    }


    public function listarOrdenes(Request $request)
    {
        $id_user = Auth::id();
        $user = User::find($id_user);

        $parametro = $request->parametroBuscar;
        $query = trim($request->get('query'));
        if ($query != '') {
            if ($parametro == 'cedula_p') {
                $ordenes = DB::table('users')
                    ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                    ->select(
                        'users.*',
                        'orden_trabajos.*'
                    )
                    ->where('users.' . $parametro, 'like', '%' . $query . '%')
                    ->where('estado_or', 0)
                    ->where('orden_trabajos.status', 1)
                    ->orderBy('orden_trabajos.id', 'desc')
                    ->paginate(10);

                /// esta condiciones evaluan el tipo de usuario para dirigirle a la vista correspondiente
                /// en caso de que sea 0 corresponde a la vista del administrador
                if ($user->tipo_p == 0) {
                    return view('admin.dashboard.ordenes.listarOrdenes', compact('ordenes', 'parametro'));
                }
                /// en caso de que sea 0 corresponde a la vista tecnico
                if ($user->tipo_p == 1) {
                    /// aque evaluaremo solo tenga acceso el tecnico secundario
                    /// mediante una consulta utilizando el id del usuario autenticado
                    $tecnico = Tecnico::find($id_user);
                    if ($tecnico->tipo_t == 1) {
                        return view('admin.dashboard.ordenes.listarOrdenesTecnicoSecundario', compact('ordenes', 'parametro'));
                    }

                }

            } else {
                $ordenes = DB::table('users')
                    ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                    ->select(
                        'users.*',
                        'orden_trabajos.*'
                    )
                    ->where('orden_trabajos.' . $parametro, 'like', '%' . $query . '%')
                    ->where('estado_or', 0)
                    ->where('orden_trabajos.status', 1)
                    ->orderBy('orden_trabajos.id', 'DESC')
                    ->paginate(10);
                /// esta condiciones evaluan el tipo de usuario para dirigirle a la vista correspondiente
                /// en caso de que sea 0 corresponde a la vista del administrador
                if ($user->tipo_p == 0) {
                    return view('admin.dashboard.ordenes.listarOrdenes', compact('ordenes', 'parametro'));
                }
                /// en caso de que sea 0 corresponde a la vista tecnico
                if ($user->tipo_p == 1) {
                    /// aque evaluaremo solo tenga acceso el tecnico secundario
                    /// mediante una consulta utilizando el id del usuario autenticado
                    $tecnico = Tecnico::find($id_user);
                    if ($tecnico->tipo_t == 1) {
                        return view('admin.dashboard.ordenes.listarOrdenesTecnicoSecundario', compact('ordenes', 'parametro'));
                    }

                }
            }

        } else {
            $parametro = 'cedula_p';
            $ordenes = DB::table('users')
                ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                ->where('estado_or', 0)
                ->where('orden_trabajos.status', 1)
                ->select(
                    'users.*',

                    'orden_trabajos.*'
                )
                ->orderBy('orden_trabajos.id', 'DESC')
                ->paginate(10);
            /// esta condiciones evaluan el tipo de usuario para dirigirle a la vista correspondiente
            /// en caso de que sea 0 corresponde a la vista del administrador
            if ($user->tipo_p == 0) {
                return view('admin.dashboard.ordenes.listarOrdenes', compact('ordenes', 'parametro'));
            }
            /// en caso de que sea 0 corresponde a la vista tecnico
            if ($user->tipo_p == 1) {
                /// aque evaluaremo solo tenga acceso el tecnico secundario
                /// mediante una consulta utilizando el id del usuario autenticado
                $tecnico = Tecnico::find($id_user);
                if ($tecnico->tipo_t == 1) {
                    return view('admin.dashboard.ordenes.listarOrdenesTecnicoSecundario', compact('ordenes', 'parametro'));
                }

            }
        }

    }

    // metodo para generar el numero de codigo
    public function generarCodigo($numero_serie)
    {
        // contrimos la caena para contar la longitud
        $cadena = "" . '' . $numero_serie;
        //econtramos la longitus
        $longitud_indice = strlen($cadena);
        //restamos los caracteres del incide a la longitud de caracteres cero
        $indice = substr("0000000000", $longitud_indice);
        //concatenamos el indice y el valor del id para obtener el codigo de la orden
        $codigo_orden = $indice . '' . $cadena;
        return $codigo_orden;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipo = Equipo::where('serie_e', $request->serie_e)->first();
        if ($equipo == null) {
            // reglas de validacion para los campos que son obligatorios
            $validator = Validator::make($request->all(), [
                'id_p' => 'required',
                'serie_e' => 'required',
                'marca_e' => 'required',
                'modelo_t' => 'required',
                'descripcion_e' => 'required',
                'problema_re' => 'required',
                'fecha_salida_re' => 'required',
                'accesorios_re' => 'required',
            ], [
                //mensajes personalizados que van aparecer en el modal
                'id_p.required' => 'Por favor seleccione un cliente',
                'serie_e.required' => 'El número de serie es obligatorio',
                'marca_e.required' => 'La marca del equipo es obligatorio',
                'modelo_t.required' => 'El modelo del equipo  es obligatorio',
                'descripcion_e.required' => 'La descripción es obligatoria',
                'problema_re.required' => 'El diagnóstico es obligatorio',
                'fecha_salida_re.required' => 'Debe elegir una fecha de salida para el equipo',
                'accesorios_re.required' => 'El campo de los accesorios esta vacío',
            ]);

            //condicion que valida si existe errores si no existe entra registrara el equipo
            //caso contrario retornara la lista d errores
            if ($validator->passes()) {

                return response()->json([
                    'mensaje' => 'Datos validados correctamente.',
                    'id_p' => $request->id_p,
                    'serie_e' => $request->serie_e,
                    'marca_e' => $request->marca_e,
                    'modelo_t' => $request->modelo_t,
                    'descripcion_e' => $request->descripcion_e,
                    'problema_re' => $request->problema_re,
                    'fecha_salida_re' => $request->fecha_salida_re,
                    'accesorios_re' => $request->accesorios_re,
                ]);
            }
            return response()->json(['error' => $validator->errors()->all(),
                                        'message'=>'0']);
        } else {

            $validator = Validator::make($request->all(), [
                'id_p' => 'required',
                'serie_e' => 'required',
                'problema_re' => 'required',
                'fecha_salida_re' => 'required',
                'accesorios_re' => 'required',

            ], [
                //mensajes personalizados que van aparecer en el modal
                'id_p.required' => 'Por favor seleccione un cliente',
                'serie_e.required' => 'El número de serie es obligatorio',
                'problema_re.required' => 'El diagnóstico es obligatorio',
                'fecha_salida_re.required' => 'Debe elegir una fecha de salida para el equipo',
                'accesorios_re.required' => 'El campo de los accesorios esta vacío',

            ]);
            if ($validator->passes()) {

                if ($equipo->id_p == $request->id_p) {
                    return response()->json([
                        'mensaje' => 'Datos validados correctamente.',
                        'id_p' => $equipo->id_p,
                        'serie_e' => $equipo->serie_e,
                        'marca_e' => $equipo->marca_e,
                        'modelo_t' => $equipo->modelo_t,
                        'descripcion_e' => $equipo->descripcion_e,
                        'problema_re' => $request->problema_re,
                        'fecha_salida_re' => $request->fecha_salida_re,
                        'accesorios_re' => $request->accesorios_re,
                    ]);
                } else {
                    return response()->json([
                        'mensaje' => 'error',
                        'id_p' => $equipo->id_p,
                        'serie_e' => $equipo->serie_e,
                        'marca_e' => $equipo->marca_e,
                        'modelo_t' => $equipo->modelo_t,
                        'descripcion_e' => $equipo->descripcion_e,
                        'problema_re' => $request->problema_re,
                        'fecha_salida_re' => $request->fecha_salida_re,
                        'accesorios_re' => $request->accesorios_re,
                    ]);
                }

            }
            return response()->json(['error' => $validator->errors()->all(),
                                        'message'=>'existe']);


        }

        //return response()->json($request);
    }


    // metodo para registrar la orede de trabajo

    public function genererOrden(Request $request)
    {
        if (!$request->ajax()) return redirect('/');


        try {
            $userAuth = Auth::id();
            $user = User::find($userAuth);
            DB::beginTransaction();

            $ordenes = OrdenTrabajo::all();

            // variable que almacena los numeros de orden de trabajo es decir el codigo

            $codigo_orden = 0;

            // validamos que exista una orden
            if (count($ordenes) != 0) {
                //obtnemos el ultimo registro
                $ultimoregistro = $ordenes->last();
                //obtenemos el id del ultimo registro
                $numero_serie = $ultimoregistro->codigo_or + 1;

                // encontramos el nuemro de codigo para mostrarlo en el DOM
                $codigo_orden = $numero_serie;

            } else {
                // si no existe ordenes registradas en la base de datos  se designara el valor de uno a los nueros de ordenes
                $codigo_orden = 1;

            }

            // creamos la nueva orden de trabajo  para guardar los datos que llegan por post del
            // evento clik del formulario via ajax

            $orden = new OrdenTrabajo();
            $orden->id_cli = $request->id_p;
            $orden->codigo_or = $codigo_orden;
            $orden->fecha_salida_or = $request->fecha_salida_re;
            $orden->observacion_problema_or = $request->observacion_problema_or;
            // creamos la orden de trabajo que funciona de cabecera
            $orden->save();


            // extaermos la collecion de datos del detalle de la orden de trabajo
            // que vienen desde post en una variable
            $detalles = $request->data;//Array de detalles
            $contador = $request->contador;


            //Recorro todos los elementos
            $i = 0;
            foreach ($detalles as $ep => $det) {
                for ($j = 0; $j < $contador; $j++) {

                    //buscamos si el nuero de serie del equipo ya se encuetra registrado
                    // registramos el equipo en caso de ser nuevo y no constar en los registros
                    $equipo = Equipo::where('serie_e', $det[$i]['serie'])->first();

                    /// si existe el equipò solo se guradara los datos del registros es
                    /// decir el detalle del de lña tabla registroEquipo ya que el
                    /// equipo ya se encuentra registrado
                    if ($equipo != null) {

                        // creamos solamente el registro  del ingreso del equipo
                        $registro = new RegistroEquipo();
                        // el detalle del registro lleva el id de la orden de trabajo creada en las primeras
                        // lineas del metodo
                        $registro->id_or = $orden->id;
                        // lleva el id del equipo ya existemte
                        $registro->id_e = $equipo->id;
                        $registro->problema_re = $det[$i]['problema'];
                        $registro->fecha_salida_re = $det[$i]['fecha_salida'];
                        $registro->accesorios_re = $det[$i]['accesorios'];
                        // guarda el detalle del registro
                        $registro->save();
                    } /// si no existe el equipo se crea el equipo y posteriormente su detalle de registro
                    else {
                        // registramos el nuevo equipo
                        $nuevoEquipo = new Equipo();
                        $nuevoEquipo->id_p = $request->id_p;
                        $nuevoEquipo->serie_e = $det[$i]['serie'];
                        $nuevoEquipo->marca_e = $det[$i]['marca'];
                        $nuevoEquipo->modelo_t = $det[$i]['modelo'];
                        $nuevoEquipo->tipo_t = $det[$i]['tipo'];
                        $nuevoEquipo->descripcion_e = $det[$i]['descripcion'];
                        $nuevoEquipo->save();

                        // creamos el nuevo registro con los datos guradados el
                        // del equipo nuevo
                        $registro = new RegistroEquipo();
                        $registro->id_or = $orden->id;
                        $registro->id_e = $nuevoEquipo->id;
                        $registro->problema_re = $det[$i]['problema'];
                        $registro->fecha_salida_re = $det[$i]['fecha_salida'];
                        $registro->accesorios_re = $det[$i]['accesorios'];
                        //guaradmos en nuevo registro
                        $registro->save();
                    }
                    // el indici incrementa  para acceder a las demas posiones del array
                    //cuando este  array sea superio a 1 detalle de la orden
                    $i++;
                }
            }
            /// la funcion commit hace que se guarden los datos ingresados anteriormente
            /// cerrando la transaccion de forma satisfatoria

            DB::commit();

            /// el valor que retorna la vista de las ordnes degenerandas

            $userAuth = Auth::id();
            $user = User::find($userAuth);
            if ($user->tipo_p == 0) {
                return response()->json([
                    'id_or' => $orden
                ]);
            } else {
                // buscamos los datos del tecnico
                $tecnico = Tecnico::find($userAuth);
                if ($tecnico->tipo_t == 1) {
                    // retornamos la visata de registros de las ordenes
                    return response()->json($orden);
                }
            }


            /// en caso que haya algun error en el registro de la cabecera el y detalle
            /// la trasaccion se anulara
        } catch (Exception $e) {
            // la funcion rollback anula la trasaccion o los ultimos cambios en la base de datos
            DB::rollBack();

            $userAuth = Auth::id();
            $user = User::find($userAuth);
            if ($user->tipo_p == 0) {
                return redirect('listar-ordenes');
            } else {
                // buscamos los datos del tecnico
                $tecnico = Tecnico::find($userAuth);
                if ($tecnico->tipo_t == 1) {
                    // retornamos la visata de registros de las ordenes
                    return redirect('listar-ordenes-ingresos');
                }
            }
        }

        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // buscamos el usuario autenticado en el sistema
        $userAuth = Auth::id();
        $user = User::find($userAuth);

        // buscamos la ordene de trabajo mediate el parametro id que llega por parametro
        $orden = OrdenTrabajo::find($id);
        // buscammos todos los registros que son el detalle de la orden de trabajo
        $registros = RegistroEquipo::where('id_or', $orden->id)->paginate(10);
        // finalmente buscamos los ddatos del tecnico en cargado de la orden
        $tecnicos = DB::table('users')
            ->join('tecnicos', 'users.id', '=', 'tecnicos.id')
            ->select(
                'users.*',
                'tecnicos.id as id_tec',
                'tecnicos.especialidad_t',
                'tecnicos.profesion_t'
            )
            ->where('users.estado_p', 1)
            ->where('users.tipo_p', 1)
            ->where('tecnicos.tipo_t', 0)
            ->orderBy('id', 'desc')
            ->get();
        if ($user->tipo_p == 0) {
            return view('admin.dashboard.ordenes.detalleOrden', compact('orden', 'registros', 'tecnicos'));
        } else {
            $tec = Tecnico::find($user->id);
            if ($tec->tipo_t == 1) {
                return view('admin.dashboard.ordenes.detalleOrdenTecSecundario', compact('orden', 'registros'));
            }
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $observacion_solucion = $request->observacion_solucion_or;
        $id_orden = $id;

        $orden = OrdenTrabajo::find($id_orden);
        $orden->observacion_solucion_or = $observacion_solucion;
        $orden->etapa_servicio_or = 3;
        $orden->save();
        return response()->json($orden);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    ///metodo que permite la eliminacion de forma definitiva de las ordenes
    public function destroy(Request $request)
    {
        $orden = OrdenTrabajo::find($request->id);

        $orden->delete();
        return response()->json([

            'mensaje' => 'Eliminado correctamente'
        ]);
    }

    public function asignarOrden(Request $request)
    {
        $id_tecnico = $request->id_tec;
        $id_orden = $request->id_or;

        $orden = OrdenTrabajo::find($id_orden);
        $orden->id_tec = $id_tecnico;
        $orden->etapa_servicio_or = 2;
        $orden->estado_or = 1;
        $orden->save();
        return response()->json($orden);
    }

    public function listarOrdenesAsignadasAdministrador(Request $request)
    {
        $parametro = $request->parametroBuscar;
        $query = trim($request->get('query'));
        if ($query != '') {
            if ($parametro == 'cedula_p') {
                $ordenes = DB::table('users')
                    ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                    ->select(
                        'users.*',
                        'orden_trabajos.*'
                    )
                    ->where('users.' . $parametro, 'like', '%' . $query . '%')
                    ->where('estado_or', 1)
                    ->where('orden_trabajos.etapa_servicio_or', 2)
                    ->orderBy('orden_trabajos.id', 'desc')
                    ->paginate(10);
                return view('admin.dashboard.ordenes.listaOrdenesTecnicos', compact('ordenes', 'parametro'));
            } else {
                $ordenes = DB::table('users')
                    ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                    ->select(
                        'users.*',
                        'orden_trabajos.*'
                    )
                    ->where('orden_trabajos.' . $parametro, 'like', '%' . $query . '%')
                    ->where('estado_or', 1)
                    ->where('orden_trabajos.etapa_servicio_or', 2)
                    ->orderBy('orden_trabajos.id', 'desc')
                    ->paginate(10);
                return view('admin.dashboard.ordenes.listaOrdenesTecnicos', compact('ordenes', 'parametro'));
            }

        } else {
            $parametro = 'cedula_p';
            $ordenes = DB::table('users')
                ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                ->where('orden_trabajos.etapa_servicio_or', 2)
                ->where('estado_or', 1)
                ->select(
                    'users.*',

                    'orden_trabajos.*'
                )->paginate(10);
            return view('admin.dashboard.ordenes.listaOrdenesTecnicos', compact('ordenes', 'parametro'));
        }

    }

    public function listarOrdenesASIGNADAS(Request $request)
    {
        $userAuth = Auth::id();
        $user = User::find($userAuth);
        if ($user->tipo_p == 1) {
            $tecnicoAsignado = Tecnico::find($user->id);
            if ($tecnicoAsignado->tipo_t == 0) {
                $parametro = $request->parametroBuscar;
                $query = trim($request->get('query'));
                if ($query != '') {
                    if ($parametro == 'cedula_p') {
                        $ordenes = DB::table('users')
                            ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                            ->select(
                                'users.*',
                                'orden_trabajos.*'
                            )
                            ->where('users.' . $parametro, 'like', '%' . $query . '%')
                            ->where('orden_trabajos.estado_or', 1)
                            ->where('orden_trabajos.etapa_servicio_or', 2)
                            // condicion para enlistra solo las ordenes que petenezca al tecnico logeado
                            ->where('orden_trabajos.id_tec', $userAuth)
                            ->orderBy('orden_trabajos.id', 'desc')
                            ->paginate(10);


                        return view('admin.dashboard.ordenes.listarOrdenesAsignadas', compact('ordenes', 'parametro'));


                    } else {
                        $ordenes = DB::table('users')
                            ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                            ->select(
                                'users.*',
                                'orden_trabajos.*'
                            )
                            ->where('orden_trabajos.' . $parametro, 'like', '%' . $query . '%')
                            ->where('estado_or', 1)
                            ->where('orden_trabajos.etapa_servicio_or', 2)
                            // condicion para enlistra solo las ordenes que petenezca al tecnico logeado
                            ->where('orden_trabajos.id_tec', $userAuth)
                            ->orderBy('orden_trabajos.id', 'desc')
                            ->paginate(10);
                        return view('admin.dashboard.ordenes.listarOrdenesAsignadas', compact('ordenes', 'parametro'));
                    }

                } else {
                    $parametro = 'cedula_p';
                    $ordenes = DB::table('users')
                        ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                        ->where('estado_or', 1)
                        // condicion para enlistra solo las ordenes que petenezca al tecnico logeado
                        ->where('orden_trabajos.id_tec', $userAuth)
                        ->where('orden_trabajos.etapa_servicio_or', 2)
                        ->select(
                            'users.*',

                            'orden_trabajos.*'
                        )->paginate(10);
                    // si existen registros retornara la vista caso contrartio retoprnara una vista de datos vacios;

                    //  return $ordenes;
                    return view('admin.dashboard.ordenes.listarOrdenesAsignadas', compact('ordenes', 'parametro'));


                }


            }
        }

    }

    public function listarOrdenesFinalizadas(Request $request)
    {
        $userAuth = Auth::id();
        $user = User::find($userAuth);
        // buscammos el tecnico que esta autenticado en el sistema
        $tecnicoAsignado = Tecnico::find($user->id);


        $parametro = $request->parametroBuscar;
        $query = trim($request->get('query'));
        if ($query != '') {
            if ($parametro == 'cedula_p') {
                /// si el paraetro de busqueda es el nuemro de cedula  se hara el filtrado por el numero de cedula
                /// filtrando por la tabla de usuarios
                $ordenes = DB::table('users')
                    ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                    ->select(
                        'users.*',
                        'orden_trabajos.*'
                    )
                    ->where('users.' . $parametro, 'like', '%' . $query . '%')
                    ->where('orden_trabajos.estado_or', 1)
                    ->where('orden_trabajos.etapa_servicio_or', 3)
                    // condicion para enlistra solo las ordenes que petenezca al tecnico logeado
                    ->where('orden_trabajos.id_tec', $userAuth)
                    ->orderBy('orden_trabajos.id', 'desc')
                    ->paginate(10);

                if ($user->tipo_p == 0) {
                    return view('errores.errorPaginaVacia');

                } else {
                    /// si no es el administrador busca el tipo de tecnico para retornar  la vista
                    if ($tecnicoAsignado->tipo_t == 0) {
                        return view('admin.dashboard.ordenes.listarOrdenesAsignadasFinalizadas', compact('ordenes', 'parametro'));
                    }
                }

                /// si el parametro de busqueda es diferente al numeor de cedula
                /// se buscara por el parametro de fecha y codigo de la orden de la tabla ordenes de trabajo
            } else {
                $ordenes = DB::table('users')
                    ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                    ->select(
                        'users.*',
                        'orden_trabajos.*'
                    )
                    // se busc apor el tipode parametro de forma dinamica
                    ->where('orden_trabajos.' . $parametro, 'like', '%' . $query . '%')
                    ->where('estado_or', 1)
                    // condicion para enlistra solo las ordenes que petenezca al tecnico logeado
                    ->where('orden_trabajos.id_tec', $userAuth)
                    ->where('orden_trabajos.etapa_servicio_or', 3)
                    ->orderBy('orden_trabajos.id', 'desc')
                    ->paginate(10);
                if ($user->tipo_p == 0) {
                    // sis es el adminsitrador se retorna a la visa del administrador
                    return view('errores.errorPaginaVacia');
                } else {
                    /// si no es el administrador busca el tipo de tecnico para retornar  la vista
                    if ($tecnicoAsignado->tipo_t == 0) {
                        return view('admin.dashboard.ordenes.listarOrdenesAsignadasFinalizadas', compact('ordenes', 'parametro'));

                    }

                }
            }

        } else {
            $parametro = 'cedula_p';
            $ordenes = DB::table('users')
                ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                ->where('estado_or', 1)
                ->where('orden_trabajos.etapa_servicio_or', 3)
                // condicion para enlistra solo las ordenes que petenezca al tecnico logeado
                ->where('orden_trabajos.id_tec', $userAuth)
                ->select(
                    'users.*',

                    'orden_trabajos.*'
                )->paginate(10);
            // si existen registros retornara la vista caso contrartio retoprnara una vista de datos vacios;

            //  return $ordenes;
            if ($user->tipo_p == 0) {
                /// si es el administrador se reorna a la visata del administradors
                return view('errores.errorPaginaVacia');
            } else {
                /// si no es el administrador busca el tipo de tecnico para retornar  la vista
                if ($tecnicoAsignado->tipo_t == 0) {
                    return view('admin.dashboard.ordenes.listarOrdenesAsignadasFinalizadas', compact('ordenes', 'parametro'));
                }

            }
        }
    }

    /// metodo que busca todas las ordene sfinalizadas al perfil del administrador
    public function listarOrdenesFinalizadasAdmin(Request $request)
    {
        $userAuth = Auth::id();
        $user = User::find($userAuth);
        if ($user->tipo_p == 0) {
            $parametro = $request->parametroBuscar;
            $query = trim($request->get('query'));
            if ($query != '') {
                if ($parametro == 'cedula_p') {
                    /// si el paraetro de busqueda es el nuemro de cedula  se hara el filtrado por el numero de cedula
                    /// filtrando por la tabla de usuarios
                    $ordenes = DB::table('users')
                        ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                        ->select(
                            'users.*',
                            'orden_trabajos.*'
                        )
                        ->where('users.' . $parametro, 'like', '%' . $query . '%')
                        ->where('orden_trabajos.estado_or', 1)
                        ->where('orden_trabajos.etapa_servicio_or', 3)
                        ->orderBy('orden_trabajos.id', 'desc')
                        ->paginate(10);


                    return view('admin.dashboard.ordenes.listarOrdenesFinalizadasAdmin', compact('ordenes', 'parametro'));


                    /// si el parametro de busqueda es diferente al numeor de cedula
                    /// se buscara por el parametro de fecha y codigo de la orden de la tabla ordenes de trabajo
                } else {
                    $ordenes = DB::table('users')
                        ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                        ->select(
                            'users.*',
                            'orden_trabajos.*'
                        )
                        // se busc apor el tipode parametro de forma dinamica
                        ->where('orden_trabajos.' . $parametro, 'like', '%' . $query . '%')
                        ->where('estado_or', 1)
                        ->where('orden_trabajos.etapa_servicio_or', 3)
                        ->orderBy('orden_trabajos.id', 'desc')
                        ->paginate(10);

                    // sis es el adminsitrador se retorna a la visa del administrador
                    return view('admin.dashboard.ordenes.listarOrdenesFinalizadasAdmin', compact('ordenes', 'parametro'));


                }

            } else {
                $parametro = 'cedula_p';
                $ordenes = DB::table('users')
                    ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                    ->where('estado_or', 1)
                    ->where('orden_trabajos.etapa_servicio_or', 3)
                    ->select(
                        'users.*',

                        'orden_trabajos.*'
                    )
                    ->orderBy('orden_trabajos.id', 'desc')
                    ->paginate(10);
                // si existen registros retornara la vista caso contrartio retoprnara una vista de datos vacios;

                /// si es el administrador se reorna a la visata del administradors
                return view('admin.dashboard.ordenes.listarOrdenesFinalizadasAdmin', compact('ordenes', 'parametro'));


            }
        } else {
            return view('errores.errorPaginaVacia');
        }
    }

    // metodo que pasa muestra el detalle de la orden de trabajo asignada la tecnico
    public function revisionOrdenTecnicoFinalizada($id)
    {
        // buscamos el tipo de usuario logeado para redirigir a la vista correpondiente
        $id_us = Auth::id();
        $user = User::find($id_us);


        $orden = OrdenTrabajo::find($id);
        $registros = RegistroEquipo::where('id_or', $orden->id)->paginate(10);
        $tecnico = Tecnico::where('id', $orden->id_tec)->first();

        /// buscamos el tipo de usuario y tecnico mediat eestas validaciones de los if()
        if ($user->tipo_p == 0) {
            return view('admin.dashboard.ordenes.detalleOrdenAdminFinalizada', compact('orden', 'registros', 'tecnico'));

        } else {
            /// vista cuando no sea el administrador y la cueanta correponda al tip de persona
            /// con el rol de tecnico
            return view('admin.dashboard.ordenes.detalleOrdenTecnicoFinalizada', compact('orden', 'registros', 'tecnico'));

        }

    }

    // metodo que pasa muestra el detalle de la orden de trabajo asignada la tecnico
    public function revisionOrdenTecnico($id)
    {
        $orden = OrdenTrabajo::find($id);
        $registros = RegistroEquipo::where('id_or', $orden->id)->paginate(10);
        $tecnico = Tecnico::where('id', $orden->id_tec)->first();

        return view('admin.dashboard.ordenes.detalleOrdenTecnico', compact('orden', 'registros', 'tecnico'));
    }


    /// metodo para cambiar l afecha de salida de la orden de trabajo
    /// por parte del tecnico principal
    public function salidaOrden(Request $request)
    {
        $id = $request->id;
        $fecha = $request->fecha_salida_or;

        $orden = OrdenTrabajo::find($id);
        $orden->fecha_salida_or = $fecha;

        $orden->save();

        return response()->json($orden);

    }

    public function solucionOrden(Request $request, $id)
    {
        $observacion_solucion = $request->observacion_solucion_or;
        $id_orden = $id;

        $orden = OrdenTrabajo::find($id_orden);
        $orden->observacion_solucion_or = $observacion_solucion;
        $orden->etapa_servicio_or = 3;
        $orden->save();
        return response()->json($orden);
    }

    /// METODO PARA RECHAZAR LAS ORDENES DE TRABAJO POR PARTE DLE TECNICO PRINCIPAL
    public function rechazarOrden(Request $request)
    {
        $observacion_solucion = $request->observacion_solucion_or;
        $id_orden = $request->id_or;

        $orden = OrdenTrabajo::find($id_orden);
        $orden->observacion_solucion_or = $observacion_solucion;
        $orden->etapa_servicio_or = 1;
        $orden->id_tec = null;
        $orden->estado_or = 0;
        $orden->save();

        return response()->json($orden);
    }


    public function pdfOrdenes($id)
    {
        $orden = OrdenTrabajo::find($id);
        $registros = RegistroEquipo::where('id_or', $orden->id)->get();
        $tecnico = Tecnico::where('id', $orden->id_tec)->first();
        $pdf = PDF::loadView('pdf.ordenesPdf', compact('orden', 'registros', 'tecnico'));
        // return view('pdf.ordenesPdf');
        //   $pdf->setPaper('A4', 'landscape');
        $nombrePdf = 'orden-' . $orden->codigo_or . '.pdf';

        return $pdf->download($nombrePdf);
    }

    public function pdfOrdenesIngreso($id)
    {
        $orden = OrdenTrabajo::find($id);
        $registros = RegistroEquipo::where('id_or', $orden->id)->get();
        $pdf = PDF::loadView('pdf.ordenesPdfIngreso', compact('orden', 'registros'));
        $pdfNombre = 'orden-Ingreso-' . $orden->codigo_or . '.pdf';
        return $pdf->download($pdfNombre);
    }

//metodo para anular las ordnes de trabajo y pasarlas a la papelera
    public function anularOrden(Request $request)
    {
        //buscamo la orden a anular mediata el request que viene por peticion ajax
        //obtenemos el id
        $orden = OrdenTrabajo::find($request->id);

        //comparamos si la orden esta en estado 1 parra cambiar su setado a a0
        if ($orden->status == 1) {
            $orden->status = 0;
            $orden->save();

        } else {
            // si sul estado es 0 se cambiara a estado 1 y volvera a ser visualizada con las ordenes validas
            $orden->status = 1;
            $orden->save();
        }

        return response()->json($orden);
    }

    public function listarOrdenesAnuladas(Request $request)
    {
        $id_user = Auth::id();
        $user = User::find($id_user);
        // evaluamos si el usuaro autentticado tiene el perfil d eadministrador
        // si es verdadero ejecutara la accion de busqueda
        if ($user->tipo_p == 0) {

            $parametro = $request->parametroBuscar;
            $query = trim($request->get('query'));
            if ($query != '') {
                if ($parametro == 'cedula_p') {
                    $ordenes = DB::table('users')
                        ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                        ->select(
                            'users.*',
                            'orden_trabajos.*'
                        )
                        ->where('users.' . $parametro, 'like', '%' . $query . '%')
                        ->where('estado_or', 0)
                        ->where('orden_trabajos.status', 0)
                        ->orderBy('orden_trabajos.id', 'desc')
                        ->paginate(10);

                    /// esta condiciones evaluan el tipo de usuario para dirigirle a la vista correspondiente
                    /// en caso de que sea 0 corresponde a la vista del administrador

                    return view('admin.dashboard.ordenes.listarOrdenesAnuladas', compact('ordenes', 'parametro'));


                } else {
                    $ordenes = DB::table('users')
                        ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                        ->select(
                            'users.*',
                            'orden_trabajos.*'
                        )
                        ->where('orden_trabajos.' . $parametro, 'like', '%' . $query . '%')
                        ->where('estado_or', 0)
                        ->where('orden_trabajos.status', 0)
                        ->orderBy('orden_trabajos.id', 'DESC')
                        ->paginate(10);

                    return view('admin.dashboard.ordenes.listarOrdenesAnuladas', compact('ordenes', 'parametro'));

                }

            } else {
                $parametro = 'cedula_p';
                $ordenes = DB::table('users')
                    ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                    ->where('estado_or', 0)
                    ->where('orden_trabajos.status', 0)
                    ->select(
                        'users.*',

                        'orden_trabajos.*'
                    )
                    ->orderBy('orden_trabajos.id', 'DESC')
                    ->paginate(10);
                return view('admin.dashboard.ordenes.listarOrdenesAnuladas', compact('ordenes', 'parametro'));
            }
        } else {
            // sino es adminitrador mostrarar una ventana vacia
            return view('errores.errorPaginaVacia');
        }
    }

    // fucnio para ver el detalle de la orden que se encuentra en la papelera
    public function ordenPapeleraDetalle($id)
    {
        // buscamos el usuario autenticado en el sistema
        $userAuth = Auth::id();
        $user = User::find($userAuth);

        // buscamos la ordene de trabajo mediate el parametro id que llega por parametro
        $orden = OrdenTrabajo::find($id);
        // buscammos todos los registros que son el detalle de la orden de trabajo
        $registros = RegistroEquipo::where('id_or', $orden->id)->paginate(10);
        // finalmente buscamos los ddatos del tecnico en cargado de la orden
        $tecnicos = DB::table('users')
            ->join('tecnicos', 'users.id', '=', 'tecnicos.id')
            ->select(
                'users.*',
                'tecnicos.id as id_tec',
                'tecnicos.especialidad_t',
                'tecnicos.profesion_t'
            )
            ->where('users.estado_p', 1)
            ->where('users.tipo_p', 1)
            ->where('tecnicos.tipo_t', 0)
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.dashboard.ordenes.detalleOrdenPapelera', compact('orden', 'registros', 'tecnicos'));


    }

}
