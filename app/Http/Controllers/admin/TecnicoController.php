<?php

namespace App\Http\Controllers\admin;

use App\Tecnico;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TecnicoController extends Controller
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
            $tecnicos = DB::table('users')
                ->join('tecnicos', 'users.id', '=', 'tecnicos.id')
                ->select(
                    'users.*',
                    'tecnicos.id as id_tec',
                    'tecnicos.especialidad_t',
                    'tecnicos.profesion_t',
                    'tecnicos.tipo_t'
                )
                ->where('users.' . $parametro, 'like', '%' . $query . '%')
                ->where('tipo_p', '1')
                ->where('estado_p', 1)
                ->orderBy('id', 'desc')
                ->paginate(10);
            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.usuarios.tecnico.index', compact('tecnicos', 'parametro'));

        } else {
            $parametro = 'cedula_p';
            $tecnicos = DB::table('users')
                ->join('tecnicos', 'users.id', '=', 'tecnicos.id')
                ->select(
                    'users.*',
                    'tecnicos.id as id_tec',
                    'tecnicos.especialidad_t',
                    'tecnicos.profesion_t',
                    'tecnicos.tipo_t'
                )
                ->where('tipo_p', '1')
                ->where('estado_p', 1)
                ->orderBy('id', 'desc')
                ->paginate(10);
            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.usuarios.tecnico.index', compact('tecnicos', 'parametro'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.usuarios.tecnico.create');
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
            'cedula_p' => 'required|numeric|unique:users',
            'nombre_p' => 'required|alpha',
            'apellido_p' => 'required|alpha',
            'telefono_p' => 'required|numeric',
            'direccion_p' => 'required',
            'name' => 'required|unique:users',
            'email' => 'required|string|email|max:255|unique:users',

            // valida campos del tecnico
            'especialidad_t' => 'required|alpha',
            'profesion_t' => 'required|alpha',

        ], [
            //MENSAJES CUANDO NO SE CUMPLE LA VALIDACION
            'email.unique' => 'Este email ya esta en uso',
            'email.required' => 'Este campo es obligatorio',
            'nombre_p.required' => 'Este campo es obligatorio',
            'nombre_p.alpha' => 'Este campo solo acepta letras',
            'cedula_p.unique' => 'El usuario ya existe',
            'cedula_p.size' => 'El número debe contener 10 carácteres',
            'cedula_p.required' => 'Este campo es obligatorio',
            // 'cedula_p.max' => 'El número debe contener 10 carácteres',
            'cedula_p.numeric' => 'El campo solo acepta números',
            'apellido_p.required' => 'Este campo es obligatorio',
            'apellido_p.alpha' => 'Este campo solo acepta letras',
            'direccion_p.required' => 'Este campo es obligatorio',
            'telefono_p.required' => 'Este campo es obligatorio',
            'telefono_p.numeric' => 'El campo solo acepta números',
            'name.unique' => 'El nombre de usuario ya existe',
            'name.required' => 'Este campo es obligatorio',

            //validaciones del tecnico
            'especialidad_t.required' => 'Este campo es obligatorio',
            'especialidad_t.alpha' => 'Este debe contener solo carácteres',
            'profesion_t.required' => 'Este campo es obligatorio',
            'profesion_t.alpha' => 'Este debe contener solo carácteres',
        ]);

        //UNA VEZ VALIDADOS LOS CAMPOS
        //CREAMOS UN NUEVO OBJETO USUARIO
        $user = new User();
        //ASIGNACION DE VALORES A LOS ATRIBUTOS DE LA CLASE USER
        $user->cedula_p = $request->cedula_p;;
        $user->nombre_p = $request->nombre_p;
        $user->apellido_p = $request->apellido_p;
        $user->telefono_p = $request->telefono_p;
        $user->direccion_p = $request->direccion_p;
        $user->tipo_p = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        //CIFRADO DE LA CONTRASEÑA  por defecto el valor será el numero de cedula
        $user->password = Hash::make($request->cedula_p);
        //GUARADAR LOS DATOS EN LA TABLA USUARIOS
        $user->save();


        // creamos el tecnico con el usuario creado anteriormente

        $tecnico = new Tecnico();

        $tecnico->id = $user->id;

        $tecnico->especialidad_t = $request->especialidad_t;
        $tecnico->profesion_t = $request->profesion_t;
        $tecnico->tipo_t = $request->tipo_t;

        $tecnico->save();

        return redirect()->route('tecnicos.index');
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
        $tecnico = Tecnico::find($id);
        return view('admin.dashboard.usuarios.tecnico.edit', compact('tecnico'));
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
        $request->validate([
            //REGLAS DE VALIDACION
            'cedula_p' => ['required', 'numeric', Rule::unique('users')->ignore($id)],
            'nombre_p' => 'required|alpha',
            'apellido_p' => 'required|alpha',
            'telefono_p' => 'required|numeric',
            'direccion_p' => 'required',
            'name' => ['required', Rule::unique('users')->ignore($id)],
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($id)],

            // valida campos del tecnico
            'especialidad_t' => 'required|alpha',
            'profesion_t' => 'required|alpha',

        ], [
            //MENSAJES CUANDO NO SE CUMPLE LA VALIDACION
            'email.unique' => 'Este email ya esta en uso',
            'email.email' => 'Ingrese un email válido',
            'email.required' => 'Este campo es obligatorio',
            'nombre_p.required' => 'Este campo es obligatorio',
            'nombre_p.alpha' => 'Este campo solo acepta letras',
            'cedula_p.unique' => 'El usuario ya existe',
            'cedula_p.size' => 'El número debe contener 10 carácteres',
            'cedula_p.required' => 'Este campo es obligatorio',
            // 'cedula_p.max' => 'El número debe contener 10 carácteres',
            'cedula_p.numeric' => 'El campo solo acepta números',
            'apellido_p.required' => 'Este campo es obligatorio',
            'apellido_p.alpha' => 'Este campo solo acepta letras',
            'direccion_p.required' => 'Este campo es obligatorio',
            'telefono_p.required' => 'Este campo es obligatorio',
            'telefono_p.numeric' => 'El campo solo acepta números',
            'name.unique' => 'El nombre de usuario ya existe',
            'name.required' => 'Este campo es obligatorio',

            //validaciones del tecnico
            'especialidad_t.required' => 'Este campo es obligatorio',
            'especialidad_t.alpha' => 'Este debe contener solo letras',
            'profesion_t.required' => 'Este campo es obligatorio',
            'profesion_t.alpha' => 'Este debe contener solo letras',
        ]);

        //UNA VEZ VALIDADOS LOS CAMPOS
        //Busca el  NUEVO OBJETO USUARIO
        $user = User::find($id);
        //ASIGNACION DE VALORES A LOS ATRIBUTOS DE LA CLASE USER
        $user->cedula_p = $request->cedula_p;;
        $user->nombre_p = $request->nombre_p;
        $user->apellido_p = $request->apellido_p;
        $user->telefono_p = $request->telefono_p;
        $user->direccion_p = $request->direccion_p;

        $user->name = $request->name;
        $user->email = $request->email;
        //GUARADAR LOS DATOS EN LA TABLA USUARIOS
        $user->save();


        // Busca  el tecnico con el usuario creado actualizado anteriormente

        $tecnico = Tecnico::find($id);

        $tecnico->especialidad_t = $request->especialidad_t;
        $tecnico->profesion_t = $request->profesion_t;
        $tecnico->tipo_t = $request->tipo_t;

        // guarda los nuevos datos en la basee de datos
        $tecnico->save();

        //redirije a la vista principal de los tecnicos
        return redirect()->route('tecnicos.index');
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

    function busquedaTecnicos(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            //  $query = $request->get('query');
            $query = trim($request->get('query'));
            //$query = $_GET['query'];
            if ($query != '') {
                $data = DB::table('users')
                    ->join('tecnicos', 'users.id', '=', 'tecnicos.id')
                    ->select(
                        'users.*',
                        'tecnicos.id as id_tec',
                        'tecnicos.especialidad_t',
                        'tecnicos.profesion_t'
                    )
                    ->where('cedula_p', 'like', '%' . $query . '%')
                    ->orWhere('nombre_p', 'like', '%' . $query . '%')
                    ->orWhere('apellido_p', 'like', '%' . $query . '%')
                    ->where('estado_p', 1)
                    ->where('tipo_p', 1)
                    ->orderBy('id', 'desc')
                    ->get();

            } else {
                $data = DB::table('users')
                    ->join('tecnicos', 'users.id', '=', 'tecnicos.id')
                    ->select(
                        'users.*',
                        'tecnicos.id as id_tec',
                        'tecnicos.especialidad_t',
                        'tecnicos.profesion_t'
                    )
                    ->where('estado_p', 1)
                    ->where('tipo_p', 1)
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                foreach ($data as $row) {
                    $output .= '
                              <tr>
                               <td>' . $row->cedula_p . '</td>
                               <td>' . $row->nombre_p . '  ' . $row->apellido_p . '</td>
                               <td>' . $row->especialidad_t . '</td>
                               <td>' . $row->profesion_t . '</td>
                               <td>
                                      <input hidden class="id-input-tecnico' . $row->id . '" type="text" value="' . $row->id . '">
                                      <button data-id-tecnico="' . $row->id . '" class="btn btn-sm btn-primary boton">asignar</a>
                                </td>
                              </tr>

                              ';
                }
            } else {
                $output = '
                             <tr>
                              <td align="center" colspan="5">No se encontraron registros</td>
                             </tr>
                             ';
            }
            $data = array(
                'table_data' => $output
            );

            echo json_encode($data);
        }
    }

    public function descativarTecnico(Request $request)
    {
        $user = User::find($request->id);

        if ($user->estado_p == 1) {
            $user->estado_p = 0;
            $user->save();

        } else {
            $user->estado_p = 1;
            $user->save();

        }

        //  $users = User::orderBy('id', 'DESC')->where('tipo_p', '1')->paginate(3);;
        // $view = View::make('admin.dashboard.usuarios.administradores.index', compact('users'));

        return response()->json([
            'mensaje' => 'Cambiado corretamente'
        ]);
    }

    public function papeleraTecnico(Request $request)
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
            $tecnicos = DB::table('users')
                ->join('tecnicos', 'users.id', '=', 'tecnicos.id')
                ->select(
                    'users.*',
                    'tecnicos.id as id_tec',
                    'tecnicos.especialidad_t',
                    'tecnicos.profesion_t',
                    'tecnicos.tipo_t'
                )
                ->where('users.' . $parametro, 'like', '%' . $query . '%')
                ->where('tipo_p', '1')
                ->where('estado_p', 0)
                ->orderBy('id', 'desc')
                ->paginate(10);
            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.papelera.papeleraTecnicos', compact('tecnicos', 'parametro'));

        } else {
            $parametro = 'cedula_p';
            $tecnicos = DB::table('users')
                ->join('tecnicos', 'users.id', '=', 'tecnicos.id')
                ->select(
                    'users.*',
                    'tecnicos.id as id_tec',
                    'tecnicos.especialidad_t',
                    'tecnicos.profesion_t',
                    'tecnicos.tipo_t'
                )
                ->where('tipo_p', '1')
                ->where('estado_p', 0)
                ->orderBy('id', 'desc')
                ->paginate(10);
            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.papelera.papeleraTecnicos', compact('tecnicos', 'parametro'));
        }
    }


}
