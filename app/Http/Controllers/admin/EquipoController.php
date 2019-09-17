<?php

namespace App\Http\Controllers\admin;

use App\Equipo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //hace una consulta de todos los administradores
        ///prametro de busqueda de los administradores
        /// en este caso solo se utilizara el email y el numero de cedula
        /// sin embrago si se incremeta los campos de busqueda en la interfaz se igual funcionara
        $parametro = $request->parametroBuscar;

        /// eat variable almacenara el contenido a buscar
        $query = trim($request->get('query'));
        // si existe una cadena de busqueda se ejecuta la consulta con la condane encontrada
        /// caso contrario se elista a todos los usuarios que esten en el estado de con valor de 0
        if ($query != '') {
            if ($parametro == 'cedula_p') {
                $user = User::where('cedula_p', $query)->where('estado_p', 1)->first();
                if ($user) {
                    $equipos = Equipo::where('id_p', $user->id)
                        ->where('estado_e', 1)
                        ->orderBy('id', 'DESC')
                        ->paginate(6);
                } else {
                    $equipos = Equipo::where('equipos.id', 'like', '%' . $query . '%')
                        ->where('estado_e', 1)
                        ->orderBy('id', 'DESC')
                        ->paginate(6);
                }

            } else {
                $equipos = Equipo::where('equipos.' . $parametro, 'like', '%' . $query . '%')
                    ->where('estado_e', 1)
                    ->orderBy('id', 'DESC')
                    ->paginate(6);
            }

            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.equipos.index', compact('equipos', 'parametro'));

        } else {
            $parametro = 'cedula_p';
            $equipos = Equipo::where('estado_e', 1)
                ->orderBy('id', 'DESC')
                ->paginate(6);
            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.equipos.index', compact('equipos', 'parametro'));
        }


        /// buscamos todos lo equipo que seran visualizados en la pagina principal index
        ///
        $equipos = Equipo::orderBy('id', 'DESC')->paginate(6);
        return view('admin.dashboard.equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // buscamos toda los usuarios registrados que tengan el rol de cliente 2
        // y estan habilitados e sdecir que el estado_p = true
        $users = User::where('tipo_p', 2)->where('estado_p', 1)
            ->orderBy('nombre_p', 'ASC')
            ->pluck('nombre_p', 'id');


        //rotornamos la vista con el array de objetos encontrados
        return view('admin.dashboard.equipos.create', compact('users'));
    }

/// metodo para buscar el usuario  para los registros
    public function busquedaEquipo()
    {
        $query = $_GET['query'];
        if ($query == '') {
            return response()->json(['mensaje' => 'Datos no encontrados']);

        } else {
            $equipo = Equipo::where('serie_e', $query)->where('estado_e', 1)->first();
            if ($equipo) {
                return response()->json([
                    'serie_e' => $equipo->serie_e,
                    'marca_e' => $equipo->marca_e,
                    'modelo_t' => $equipo->modelo_t,
                    'tipo_t' => $equipo->tipo_t,
                    'descripcion_e' => $equipo->descripcion_e,
                ]);

            } else {
                return response()->json(['mensaje' => 'Datos no encontrados']);
            }

        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Reglas de validacion de los campos del formulario  que vienen por POST
        $request->validate([
            //REGLAS DE VALIDACION
            'id_p' => 'required',
            'serie_e' => 'required|unique:equipos|min:1|max:120',
            'marca_e' => 'required',
            'modelo_t' => 'required',
            'descripcion_e' => 'required',
        ], [
            //MENSAJES CUANDO NO SE CUMPLE LA VALIDACION
            'id_p.required' => 'Debe elejir un cliente',
            'serie_e.unique' => 'Este equipo ya existe',
            'serie_e.required' => 'Este campo es obligatorio',
            'serie_e.min' => 'El número de serie debe contener mas de 2 caracteres',

            'marca_e.required' => 'Este campo es obligatorio',
            'modelo_t.required' => 'Este campo es obligatorio',
            'descripcion.required' => 'Este campo es obligatorio',

        ]);

        //UNA VEZ VALIDADOS LOS CAMPOS
        //CREAMOS UN NUEVO OBJETO EQUIPO
        $equipo = new Equipo();
        //ASIGNACION DE VALORES A LOS ATRIBUTOS DE LA CLASE EQUIPO
        $equipo->id_p = $request->id_p;
        $equipo->serie_e = $request->serie_e;
        $equipo->marca_e = $request->marca_e;
        $equipo->modelo_t = $request->modelo_t;
        $equipo->tipo_t = $request->tipo_t;
        $equipo->estado_e = true;
        $equipo->descripcion_e = $request->descripcion_e;


        //GUARADAR LOS DATOS EN LA TABLA EQUIPOS
        $equipo->save();
        // REDIRIJE A LA RUTA INDEX PARA VER LOS EQUIPOS REGISTRADOS
        return redirect()->route('equipos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        // buscamos el equipo con el param,etro id que viene desde el formulario

        $equipo = Equipo::find($id);

// buscamos toda los usuarios registrados que tengan el rol de cliente 2
        // y estan habilitados e sdecir que el estado_p = true
        $user = User::where('id', $equipo->id_p)->where('tipo_p', 2)->where('estado_p', 1)->first();

        //rotornamos la vista edit  con el array de objetos encontrados
        return view('admin.dashboard.equipos.edit', compact('user', 'equipo'));
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
        //Reglas de validacion de los campos del formulario  que vienen por POST
        $request->validate([
            //REGLAS DE VALIDACION
            'serie_e' => 'required|min:1|max:120',
            'marca_e' => 'required',
            'modelo_t' => 'required',
            'descripcion_e' => 'required',
        ], [
            //MENSAJES CUANDO NO SE CUMPLE LA VALIDACION
            // 'serie_e.unique' => 'Este equipo ya existe',
            'serie_e.required' => 'Este campo es obligatorio',
            'serie_e.min' => 'El número de serie debe contener mas de 2 caracteres',

            'marca_e.required' => 'Este campo es obligatorio',
            'modelo_t.required' => 'Este campo es obligatorio',
            'descripcion.required' => 'Este campo es obligatorio',

        ]);

        //UNA VEZ VALIDADOS LOS CAMPOS
        //buscamos el equipo por el parametro que viene del formulario
        $equipo = Equipo::find($id);
        //ASIGNACION DE VALORES A LOS ATRIBUTOS DE LA CLASE EQUIPO
        $equipo->id_p = $request->id_p;
        $equipo->serie_e = $request->serie_e;
        $equipo->marca_e = $request->marca_e;
        $equipo->modelo_t = $request->modelo_t;
        $equipo->tipo_t = $request->tipo_t;
        $equipo->descripcion_e = $request->descripcion_e;


        //GUARADAR LOS DATOS EN LA TABLA EQUIPOS
        $equipo->save();
        // REDIRIJE A LA RUTA INDEX PARA VER LOS EQUIPOS REGISTRADOS
        return redirect()->route('equipos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $equipo = Equipo::find($request->id);

       $equipo->delete();

        return response()->json([

            'mensaje' => 'Eliminado correctamente'
        ]);
    }

    public function busquedaCliente(Request $request)
    {


        $query = trim($request->get('query'));
        if ($query == '') {
            return response()->json('');

        } else {
            $user = User::where('cedula_p', $query)->where('estado_p', 1)->where('tipo_p', 2)->first();
            if ($user) {
                return response()->json([
                    'id' => $user->id,
                    'cedula_p' => $user->cedula_p,
                    'nombres' => $user->nombre_p . '  ' . $user->apellido_p,
                    'telefono_p' => $user->telefono_p,
                    'direccion_p' => $user->direccion_p,
                    'email' => $user->email
                ]);

            } else {
                return response()->json(['mensaje' => 'Datos no encontrados']);
            }

        }


    }

    public function desactivarEquipo(Request $request)
    {
        $id_e = $request->id;
        $equipo = Equipo::find($id_e);
        if ($equipo->estado_e == 1) {
            $equipo->estado_e = 0;
            $equipo->save();
        } else {
            $equipo->estado_e = 1;
            $equipo->save();
        }

        return response()->json([
            'mensaje' => 'cambio realizado con exito',
            'id' => $equipo->id
        ]);
    }

    public function papeleraEquipos(Request $request)
    {
        //hace una consulta de todos los administradores
        ///prametro de busqueda de los administradores
        /// en este caso solo se utilizara el email y el numero de cedula
        /// sin embrago si se incremeta los campos de busqueda en la interfaz se igual funcionara
        $parametro = $request->parametroBuscar;

        /// eat variable almacenara el contenido a buscar
        $query = trim($request->get('query'));
        // si existe una cadena de busqueda se ejecuta la consulta con la condane encontrada
        /// caso contrario se elista a todos los usuarios que esten en el estado de con valor de 0
        if ($query != '') {
            if ($parametro == 'cedula_p') {
                $user = User::where('cedula_p', $query)->where('estado_p', 1)->first();
                if ($user) {
                    $equipos = Equipo::where('id_p', $user->id)
                        ->where('estado_e', 0)
                        ->orderBy('id', 'DESC')
                        ->paginate(6);
                } else {
                    $equipos = Equipo::where('equipos.id', 'like', '%' . $query . '%')
                        ->where('estado_e', 0)
                        ->orderBy('id', 'DESC')
                        ->paginate(6);
                }

            } else {
                $equipos = Equipo::where('equipos.' . $parametro, 'like', '%' . $query . '%')
                    ->where('estado_e', 0)
                    ->orderBy('id', 'DESC')
                    ->paginate(6);
            }

            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.papelera.papeleraEquipos', compact('equipos', 'parametro'));

        } else {
            $parametro = 'cedula_p';
            $equipos = Equipo::where('estado_e', 0)
                ->orderBy('id', 'DESC')
                ->paginate(6);
            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.papelera.papeleraEquipos', compact('equipos', 'parametro'));
        }


        /// buscamos todos lo equipo que seran visualizados en la pagina principal index
        ///
        $equipos = Equipo::orderBy('id', 'DESC')->paginate(6);
        return view('admin.dashboard.papelera.papeleraEquipos', compact('equipos'));
    }
}
