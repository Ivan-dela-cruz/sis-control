@extends('admin.base.base_dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Registro de usuarios</h1>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    Nuevo usuario
                </p>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="{{route('usuario.store')}}" id="registration-form">
                                @csrf
                                <div class="row pb-5">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cedula_p" class="active">Cédula</label>
                                            <input type="text" class="form-control" id="cedula_p" name="cedula_p"
                                                   data-validation="numeric"
                                                   data-validation-length="9-10"
                                                   data-validation-error-msg="El número debe tener(10 dígitos)"
                                                   placeholder="Ingrese su numero de cédula"
                                                   value="{{ old('cedula_p') }}"
                                            >
                                            @if($errors->has('cedula_p'))
                                                <label class="text-danger">{{$errors->first('cedula_p')}} </label>
                                            @endif

                                        </div>
                                        <div class="form-group">
                                            <label for="nombre_p" class="active">Nombres</label>
                                            <input type="text" class="form-control" id="nombre_p" name="nombre_p"
                                                   data-validation="alphabet" placeholder="Ingrese sus nombres"
                                                   value="{{old('nombre_p')}}">
                                            @if($errors->has('nombre_p'))
                                                <label class="text-danger">{{$errors->first('nombre_p')}} </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido_p" class="active">Apellidos</label>
                                            <input type="text" class="form-control" id="apellido_p" name="apellido_p"
                                                   data-validation="alphabet" placeholder="Ingrese sus apellidos"
                                                   value="{{old('direccion_p')}}">
                                            @if($errors->has('direccion_p'))
                                                <label class="text-danger">{{$errors->first('direccion_p')}} </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono_p" class="active">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono_p" name="telefono_p"
                                                   data-validation="numeric"
                                                   placeholder="Ingrese su numero de teléfono"
                                                   value="{{old('telefono_p')}}">
                                            @if($errors->has('telefono_p'))
                                                <label class="text-danger">{{$errors->first('telefono_p')}} </label>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion_p" class="active">Dirección</label>
                                            <input type="text" class="form-control" name="direccion_p" id="direccion_p"
                                                   data-validation="alphanumeric"
                                                   placeholder="Ingrese su dirección" value="{{old('direccion_p')}}">
                                            @if($errors->has('direccion_p'))
                                                <label class="text-danger">{{$errors->first('direccion_p')}} </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="direccion_p" class="active">Tipo de usuario</label>
                                            <select class="form-control" name="tipo_p" id="tipo_p">
                                                <option value="2">Cliente</option>
                                                <option value="0">Administrador</option>
                                                <option value="1">Técnico</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="active">Nombre de usuario(3-12 carácteres)</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   data-validation="length alphanumeric"
                                                   data-validation-length="3-12"
                                                   data-validation-error-msg="Username has to be an alphanumeric value (3-12 chars)"
                                                   placeholder="Ingrese el nombre de usuario" value=" {{old('name')}}">
                                            @if($errors->has('name'))
                                                <label class="text-danger">{{$errors->first('name')}} </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="active">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   data-validation="email" placeholder="Enter Email"
                                                   value="{{old('email')}}"
                                            >
                                            @if($errors->has('email'))
                                                <label class="text-danger">{{$errors->first('email')}} </label>
                                            @endif
                                        </div>


                                    </div>
                                    <div class="col-md-12">
                                        <button id="validate" type="submit" class="btn btn-primary pull-right">
                                            Registrar
                                        </button>
                                    </div>

                                </div>

                            </form>
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
    <script type="text/javascript" src="{{asset('assets/demo/js/forms-validation.js')}}"></script>
    <!-- SCRIPTS - DEMO START -->

    <script>
        /*
        $(document).ready(function () {
           // $('#lb_c').hide();

            $('#validate').on('click', function (e) {
                var value = $('#cedula_p').val();
                var n = value.length;

                if (n != 10) {

                    $('#lb_c').show();
                    $('#lb_c').addClass('text-danger');
                    $('#cedula_p').addClass('border-danger');
                } else {
                    $('#lb_c').hide();
                    // $('#cedula_p').closest('form').find('*').removeClass('border-danger, has-danger, text-danger');
                    $('#cedula_p').removeClass('border-danger');

                }
            });

        });*/
    </script>

@endsection