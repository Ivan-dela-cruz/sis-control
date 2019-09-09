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

        if ($user->tipo_p == 0) {
            // buscamos los datos del tecnico
            $tecnico = $user;
        } else {
            // buscamos los datos del tecnico
            $tecnico = Tecnico::find($userAuth);
        }

        // obteneos la fecha actual del servidor
        $mytime = Carbon::now('America/Guayaquil');
        $fecha_hora = $mytime->toDateString();

        /*$regis_equipos = DB::table('users')
            ->join('equipos', 'users.id', '=', 'equipos.id_p')
            ->join('registro_equipos', 'registro_equipos.id_e', '=', 'equipos.id')
            ->select(
                'users.*',
                'equipos.*',
                'registro_equipos.*'
            )->paginate(3);
        */
        // validamos que exista una orden
        $codigo_orden = 0;
        if (count($ordenes) != 0) {
            //obtnemos el ultimo registro
            $ultimoregistro = $ordenes->last();

            // encontramos el nuemro de codigo para mostrarlo en el DOM
            $codigo_orden = $ultimoregistro->codigo_or + 1;

            // retornamos la visat con los datos del tecnico y los datos de las ordenes
            return view('admin.dashboard.ordenes.index', compact('codigo_orden', 'tecnico', 'fecha_hora'));

        } else {
            // si no existe ordenes registradas en la base de datos  se designara el valor de uno a los nueros de ordenes

            $codigo_orden = 1;
            return view('admin.dashboard.ordenes.index', compact('codigo_orden', 'tecnico', 'fecha_hora'));
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

    /* public function busquedaOrden()
     {
         $query = $_GET['query'];
         if ($query == '') {
             return response()->json(['mensaje' => 'Datos no encontrados']);

         } else {
             $orden = OrdenTrabajo::where('codigo_or', $query)->where('estado_or', 1)->first();

             if ($orden) {
                 return response()->json([
                     'id' => $orden->id,
                     'codigo_or' => $orden->codigo_or,
                     'id_cli' => $orden->id_cli,
                     'cliente' => $orden->user->nombre_p . '' . $orden->user->apellido_p,
                     'observacion_problema_or' => $orden->observacion_problema_or,
                     'etapa_servicio_or' => $orden->etapa_servicio_or,
                     'estado_or' => $orden->estado_or,
                 ]);
             } else {
                 return response()->json(['mensaje' => 'Datos no encontrados']);
             }
         }
     }*/

    public function listarOrdenes(Request $request)
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
                    ->where('estado_or', 0)
                    ->orderBy('orden_trabajos.id', 'desc')
                    ->paginate(3);
                return view('admin.dashboard.ordenes.listarOrdenes', compact('ordenes', 'parametro'));
            } else {
                $ordenes = DB::table('users')
                    ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                    ->select(
                        'users.*',
                        'orden_trabajos.*'
                    )
                    ->where('orden_trabajos.' . $parametro, 'like', '%' . $query . '%')
                    ->where('estado_or', 0)
                    ->orderBy('orden_trabajos.id', 'desc')
                    ->paginate(3);
                return view('admin.dashboard.ordenes.listarOrdenes', compact('ordenes', 'parametro'));
            }

        } else {
            $parametro = 'cedula_p';
            $ordenes = DB::table('users')
                ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                ->where('estado_or', 0)
                ->select(
                    'users.*',

                    'orden_trabajos.*'
                )->paginate(3);
            return view('admin.dashboard.ordenes.listarOrdenes', compact('ordenes', 'parametro'));
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
                'success' => 'Datos validados correctamente.',
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

        return response()->json(['error' => $validator->errors()->all()]);

        //return response()->json($request);
    }


    // metodo para registrar la orede de trabajo

    public function genererOrden(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try {
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
            /// el valor que retora es para controlar el nuemro de registros realzao
            return [
                'var' => $i
            ];
            /// en caso que haya algun error en el registro de la cabecera el y detalle
            /// la trasaccion se anulara
        } catch (Exception $e) {
            // la funcion rollback anula la trasaccion o los ultimos cambios en la base de datos
            DB::rollBack();
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
        $orden = OrdenTrabajo::find($id);
        $registros = RegistroEquipo::where('id_or', $orden->id)->paginate(10);
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

        return view('admin.dashboard.ordenes.detalleOrden', compact('orden', 'registros', 'tecnicos'));

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
    public function destroy($id)
    {
        //
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

    public function listarOrdenesASIGNADAS(Request $request)
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
                    ->orderBy('orden_trabajos.id', 'desc')
                    ->paginate(3);
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
                    ->orderBy('orden_trabajos.id', 'desc')
                    ->paginate(3);
                return view('admin.dashboard.ordenes.listarOrdenesAsignadas', compact('ordenes', 'parametro'));
            }

        } else {
            $parametro = 'cedula_p';
            $ordenes = DB::table('users')
                ->join('orden_trabajos', 'users.id', '=', 'orden_trabajos.id_cli')
                ->where('estado_or', 1)
                ->select(
                    'users.*',

                    'orden_trabajos.*'
                )->paginate(3);
            return view('admin.dashboard.ordenes.listarOrdenesAsignadas', compact('ordenes', 'parametro'));
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
        $id_orden = $request->id_or;

        $orden = OrdenTrabajo::find($id_orden);
        $orden->observacion_solucion_or = $observacion_solucion;
        $orden->etapa_servicio_or = 3;
        $orden->save();
        return response()->json($orden);
    }

}
