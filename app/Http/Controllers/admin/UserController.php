<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
            $users = DB::table('users')
                ->where('users.' . $parametro, 'like', '%' . $query . '%')
                ->where('tipo_p', '0')
                ->where('estado_p', 1)
                ->orderBy('id', 'desc')
                ->paginate(10);
            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.usuarios.administradores.index', compact('users', 'parametro'));

        } else {
            $parametro = 'cedula_p';
            $users = User::where('estado_p', 1)
                ->where('tipo_p', '0')
                ->paginate(10);
            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.usuarios.administradores.index', compact('users', 'parametro'));
        }

    }



    /// metod que permite listar todos los usuarios con el rol de
    /// cliente a la vista del administrado
    public function clinetes()
    {

        //hace una consulta de todos los administradores
        $users = User::orderBy('id', 'DESC')->where('tipo_p', '0')->paginate(3);;
        return view('admin.dashboard.usuarios.listarAdmins', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //hace una consulta de todos los usuarios
        $users = User::all();
        return view('admin.dashboard.usuarios.administradores.registroAdmin', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    /*  protected function validator(array $data)
      {
          return Validator::make($data, [
              'cedula_p' => ['required', 'string', 'max:255'],
              'nombre_p' => ['required', 'string', 'max:255'],
              'telefono_p' => ['required', 'string', 'max:255'],
              'tipo_p' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

          ]);
      }*/
    public function store(Request $request)
    {

        //Reglas de validacion de los campos del formulario  que vienen por POST
        $request->validate([
            //REGLAS DE VALIDACION
            'cedula_p' => 'required|numeric|unique:users',
            'nombre_p' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
            'apellido_p' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
            'telefono_p' => 'required|numeric',
            'direccion_p' => 'required',
            'name' => 'required|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
        ], [
            //MENSAJES CUANDO NO SE CUMPLE LA VALIDACION
            'email.unique' => 'Este email ya esta en uso',
            'email.required' => 'Este campo es obligatorio',
            'nombre_p.required' => 'Este campo es obligatorio',
            'nombre_p.regex' => 'Este campo solo acepta letras',
            'cedula_p.unique' => 'El usuario ya existe',
            'cedula_p.size' => 'El número debe contener 10 carácteres',
            'cedula_p.required' => 'Este campo es obligatorio',
            // 'cedula_p.max' => 'El número debe contener 10 carácteres',
            'cedula_p.numeric' => 'El campo solo acepta números',
            'apellido_p.required' => 'Este campo es obligatorio',
            'apellido_p.regex' => 'Este campo solo acepta letras',
            'direccion_p.required' => 'Este campo es obligatorio',
            'telefono_p.required' => 'Este campo es obligatorio',
            'telefono_p.numeric' => 'El campo solo acepta números',
            'name.unique' => 'El nombre de usuario ya existe',
            'name.required' => 'Este campo es obligatorio',
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
        $user->tipo_p = 0;
        $user->name = $request->name;
        $user->email = $request->email;
        //CIFRADO DE LA CONTRASEÑA  por defecto el valor será el numero de cedula
        $user->password = Hash::make($request->cedula_p);
        //GUARADAR LOS DATOS EN LA TABLA USUARIOS
        $user->save();

        //return $user;
        return redirect()->route('usuario.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    /// metodo para buscar el usuario  para los registros
    public function busquedaCliente()
    {


        $query = $_GET['query'];
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


    public function buscarTipoUsuario($tipo)
    {
        // identificamos el tipo de usuario
        $tipouser = "";
        switch ($tipo) {
            case 0;
                $tipouser = 'Administrador';
                break;
            case 2;
                $tipouser = 'Cliente';
                break;
            case 1;
                $tipouser = 'Técnico';
                break;
        }
        return $tipouser;

    }

    /* public function cambiarEstadoAdmin($id)
     {

         if (request()->ajax()) {
             $user = User::findOrFail($id);
             return response()->json(['data' => $user]);
         }

     }*/

    public function cambiarEstado(Request $request)
    {
        $rules = array(
            'estado_p' => 'required'
        );
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $user = User::find($request->id);
        $user->estado_p = $request->estado_p;
        $user->save();

        return response()->json($user);
    }

    public function recargarSeccion(Request $request)
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


    public function verAdmin()
    {
        //parametro id recibido por GET desde ajax
        $id = $_GET['id'];

        // buscamos los datos del usuario con el id ingresado
        $user = User::find($id);

        $status = "Activo";
        //verificamos el estado del usuario
        if ($user->estado_p) {
            $status = "Activo";
        } else {
            $status = "Inactivo";
        }

        //retornamos los datos del usuario encontrado
        return response()->json([
            'id' => $user->id,
            'cedula_p' => $user->cedula_p,
            'nombres' => $user->nombre_p . '  ' . $user->apellido_p,
            'telefono_p' => $user->telefono_p,
            'direccion_p' => $user->direccion_p,
            'tipo_p' => $this->buscarTipoUsuario($user->tipo_p),
            'estado_p' => $status,
            'name' => $user->name,
            'email' => $user->email
        ]);
    }

    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->where('estado_p', 1)->where('tipo_p', 0)->first();

        return view('admin.dashboard.usuarios.administradores.editAdmin', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function updateEstado(Request $request, $id)
    {
        $user = User::find($id);

        if ($user->estado_p == 1) {
            $user->estado_p = 0;
            $user->save();
            return response()->json(['message' => 'Update to Inactive']);
        } else {
            $user->estado_p = 1;
            $user->save();
            return response()->json(['message' => 'Update to Active']);
        }

    }

    public function update(Request $request, $id)
    {
        //Reglas de validacion de los campos del formulario  que vienen por POST
        $request->validate([
            //REGLAS DE VALIDACION
            'id' => 'required',
            'cedula_p' => ['required','numeric', 'size:10', Rule::unique('users')->ignore($id)],
            'nombre_p' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
            'apellido_p' => 'required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/u',
            'telefono_p' => 'required|numeric',
            'direccion_p' => 'required',
            'name' => ['required', Rule::unique('users')->ignore($id)],
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($id)],
        ], [
            //MENSAJES CUANDO NO SE CUMPLE LA VALIDACION
            'email.unique' => 'Este email ya esta en uso',
            'email.required' => 'Este campo es obligatorio',
            'nombre_p.required' => 'Este campo es obligatorio',
            'nombre_p.regex' => 'Este campo solo acepta letras',
            'cedula_p.unique' => 'El usuario ya existe',
            'cedula_p.size' => 'El número debe contener 10 carácteres',
            'cedula_p.required' => 'Este campo es obligatorio',
            // 'cedula_p.max' => 'El número debe contener 10 carácteres',
            'cedula_p.numeric' => 'El campo solo acepta números',
            'apellido_p.required' => 'Este campo es obligatorio',
            'apellido_p.regex' => 'Este campo solo acepta letras',
            'direccion_p.required' => 'Este campo es obligatorio',
            'telefono_p.required' => 'Este campo es obligatorio',
            'telefono_p.numeric' => 'El campo solo acepta números',
            'name.unique' => 'El nombre de usuario ya existe',
            'name.required' => 'Este campo es obligatorio',
        ]);

        //UNA VEZ VALIDADOS LOS CAMPOS
        //CREAMOS UN NUEVO OBJETO USUARIO
        $user = User::find($id);
        //ASIGNACION DE VALORES A LOS ATRIBUTOS DE LA CLASE USER
        $user->cedula_p = $request->cedula_p;;
        $user->nombre_p = $request->nombre_p;
        $user->apellido_p = $request->apellido_p;
        $user->telefono_p = $request->telefono_p;
        $user->direccion_p = $request->direccion_p;
        $user->name = $request->name;
        $user->email = $request->email;
        //CIFRADO DE LA CONTRASEÑA  por defecto el valor será el numero de cedula
        //  $user->password = Hash::make($request->cedula_p);
        //GUARADAR LOS DATOS EN LA TABLA USUARIOS
        $user->save();

        //return $user;
        return redirect()->route('usuario.index');

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

    public function pepeleraAdmins(Request $request)
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
            $users = DB::table('users')
                ->where('users.' . $parametro, 'like', '%' . $query . '%')
                ->where('tipo_p', '0')
                ->where('estado_p', 1)
                ->orderBy('id', 'desc')
                ->paginate(10);
            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.papelera.papeleraAdmins', compact('users', 'parametro'));

        } else {
            $parametro = 'cedula_p';
            $users = User::where('estado_p', 0)
                ->where('tipo_p', '0')
                ->paginate(10);
            ///retornamos los datos a la vista de la papelera y el ultimo valor definido en la busqueda
            return view('admin.dashboard.papelera.papeleraAdmins', compact('users', 'parametro'));
        }
    }

}
