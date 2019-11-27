@extends('admin.base.base_dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic text-lg-right">
                <a href="{{route('clientes.index')}}">Clientes</a>/Editar cliente - {{$user->cedula_p}}
            </p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    <a href="{{url()->previous()}}" class="btn btn-outline-white btn-sm pull-right">
                        <i class="batch-icon batch-icon-out"></i> Atras
                    </a>
                    Editar Cliente

                </p>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">

                            {!! Form::model($user, ['route' => ['clientes.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
                            @csrf
                            @method('PUT')
                            <div class="row pb-5">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input hidden name="id" id="id" type="text" value="{{$user->id}}">
                                        <label for="cedula_p" class="active">Cédula</label>
                                        <input type="text" class="form-control" id="cedula_p" name="cedula_p"
                                               data-validation="numeric"
                                               data-validation-length="9-10"
                                               data-validation-error-msg="El número debe tener(10 dígitos)"
                                               placeholder="Ingrese su numero de cédula"
                                               value="{{$user->cedula_p}}"
                                        >
                                        @if($errors->has('cedula_p'))
                                            <label class="text-danger">{{$errors->first('cedula_p')}} </label>
                                        @endif

                                    </div>
                                    <div class="form-group">
                                        <label for="nombre_p" class="active">Nombres</label>
                                        <input type="text" class="form-control" id="nombre_p" name="nombre_p"
                                               data-validation="alphabet" placeholder="Ingrese sus nombres"
                                               value="{{$user->nombre_p}}">
                                        @if($errors->has('nombre_p'))
                                            <label class="text-danger">{{$errors->first('nombre_p')}} </label>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido_p" class="active">Apellidos</label>
                                        <input type="text" class="form-control" id="apellido_p" name="apellido_p"
                                               data-validation="alphabet" placeholder="Ingrese sus apellidos"
                                               value="{{$user->apellido_p}}">
                                        @if($errors->has('apellido_p'))
                                            <label class="text-danger">{{$errors->first('apellido_p')}} </label>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono_p" class="active">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono_p" name="telefono_p"
                                               data-validation="numeric"
                                               placeholder="Ingrese su numero de teléfono"
                                               value="{{$user->telefono_p}}">
                                        @if($errors->has('telefono_p'))
                                            <label class="text-danger">{{$errors->first('telefono_p')}} </label>
                                        @endif
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="direccion_p" class="active">Dirección</label>
                                        <input type="text" class="form-control" name="direccion_p" id="direccion_p"
                                               placeholder="Ingrese su dirección"
                                               value="{{$user->direccion_p}}">
                                        @if($errors->has('direccion_p'))
                                            <label class="text-danger">{{$errors->first('direccion_p')}} </label>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label hidden for="direccion_p" class="active">Tipo de usuario</label>
                                        <select hidden disabled class="form-control" name="tipo_p" id="tipo_p">
                                            <option selected value="2">Cliente</option>
                                            <option  value="0">Administrador</option>
                                            <option value="1">Técnico</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="active">Nombre de usuario(3-12 carácteres)</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                               data-validation="length alphanumeric"
                                               data-validation-length="3-12"
                                               data-validation-error-msg="Username has to be an alphanumeric value (3-12 chars)"
                                               placeholder="Ingrese el nombre de usuario"
                                               value="{{$user->name}}">
                                        @if($errors->has('name'))
                                            <label class="text-danger">{{$errors->first('name')}} </label>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="active">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               data-validation="email" placeholder="Enter Email"
                                               value="{{$user->email}}"
                                        >
                                        @if($errors->has('email'))
                                            <label class="text-danger">{{$errors->first('email')}} </label>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-md-12 text-lg-right">
                                    <a href="{{url()->previous()}}" class="btn btn-danger ">
                                        Cancelar
                                    </a>
                                    <button id="validate" type="submit" class="btn btn-success">
                                        Guardar
                                    </button>

                                </div>

                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')

    <!-- SCRIPTS - DEMO START -->
    <!-- Form Validation -->
   {{---- <script type="text/javascript" src="{{asset('assets/demo/js/forms-validation.js')}}"></script>---}}
    <!-- SCRIPTS - DEMO START -->

    <script>
        $(document).ready(function () {
            $('.change-pass').hide();
        });

    </script>

@endsection