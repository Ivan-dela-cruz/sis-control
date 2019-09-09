<?php

namespace App\Http\Controllers\admin;

use App\Equipo;
use App\RegistroEquipo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegistroEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $regis_equipos = RegistroEquipo::orderBy('id', 'DESC')->paginate(6);

        // hacemos una consulta con las tablas equipos, persona y registro equipos mediante
        //la funcion join
        $regis_equipos = DB::table('users')
            ->join('equipos', 'users.id', '=', 'equipos.id_p')
            ->join('registro_equipos', 'registro_equipos.id_e', '=', 'equipos.id')
            ->select(
                'users.*',
                'equipos.*',
                'registro_equipos.*'
            )->paginate(3);

        return view('admin.dashboard.registroequipo.index', compact('regis_equipos'));

        //  return $regis_equipos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('tipo_p', 2)->where('estado_p', 1)
            ->orderBy('nombre_p', 'ASC')
            ->pluck('nombre_p', 'id');
        $equipos = Equipo::where('estado_e', 1)
            ->orderBy('id', 'DESC')
            ->pluck('serie_e', 'id');;

        return view('admin.dashboard.registroequipo.create', compact('users', 'equipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'problema_re' => 'required',
            'fecha_salida_re' => 'required',
            'accesorios_re' => 'required'
        ], [
            'problema_re.required' => 'Este campo es obligatorio',
            'fecha_salida_re.required' => 'Este campo es obligatorio',
            'accesorios_re.required' => 'Este campo es obligatorio'

        ]);
        // registramos todos los campos del formulario en el registro que pertenece a la clase RegustroEquipo

        $registro = new  RegistroEquipo();

        $registro->id_e = $request->id_e;
        $registro->problema_re = $request->problema_re;
        $registro->fecha_salida_re = $request->fecha_salida_re;
        $registro->accesorios_re = $request->accesorios_re;
        $registro->save();

        return redirect()->route('registro-equipos.index');

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
        $fecha = $request->fecha_salida_re;
        $registro = RegistroEquipo::find($id);
        $registro->fecha_salida_re = $fecha;
        $registro->save();

    }

    public function updateFecha(Request $request)
    {
        $id = $request->id;
        $fecha = $request->fecha_salida_re;
        $registro = RegistroEquipo::find($id);
        $registro->fecha_salida_re = $fecha;
        $registro->save();


        return response()->json($registro);

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
}
