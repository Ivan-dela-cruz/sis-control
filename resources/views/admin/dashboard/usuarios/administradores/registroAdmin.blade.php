@extends('admin.base.base_dashboard')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic text-lg-right">
                <a href="{{route('usuario.index')}}">Administradores</a>/Nuevo
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
                    Nuevo Administrador

                </p>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="post" action="{{route('usuario.store')}}" id="registration-form">
                                @csrf
                                <h3>Datos personales</h3>
                                <div class="row pb-5">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cedula_p" class="active">Cédula</label>
                                            <input maxlength="10" type="number" class="form-control" id="cedula_p" name="cedula_p"
                                                   placeholder="Ingrese su numero de cédula"
                                                   value="{{ old('cedula_p') }}"
                                            >
                                            @if($errors->has('cedula_p'))
                                                <label class="text-danger">{{$errors->first('cedula_p')}} </label>
                                            @endif
                                            <label hidden id="lb-cedula-ecuador" class="text-danger">El número de cédula no pertenece a ninguna región del país </label>

                                        </div>
                                        <div class="form-group">
                                            <label for="nombre_p" class="active">Nombres</label>
                                            <input type="text" class="form-control" id="nombre_p" name="nombre_p"
                                                   placeholder="Ingrese sus nombres"
                                                   value="{{old('nombre_p')}}">
                                            @if($errors->has('nombre_p'))
                                                <label class="text-danger">{{$errors->first('nombre_p')}} </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido_p" class="active">Apellidos</label>
                                            <input type="text" class="form-control" id="apellido_p" name="apellido_p"
                                                   placeholder="Ingrese sus apellidos"
                                                   value="{{old('apellido_p')}}">
                                            @if($errors->has('apellido_p'))
                                                <label class="text-danger">{{$errors->first('apellido_p')}} </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono_p" class="active">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono_p" name="telefono_p"
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
                                                   placeholder="Ingrese su dirección" value="{{old('direccion_p')}}">
                                            @if($errors->has('direccion_p'))
                                                <label class="text-danger">{{$errors->first('direccion_p')}} </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label hidden for="direccion_p" class="active">Tipo de usuario</label>
                                            <select hidden disabled class="form-control" name="tipo_p" id="tipo_p">
                                                <option value="2">Cliente</option>
                                                <option selected value="0">Administrador</option>
                                                <option value="1">Técnico</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="active">Nombre de usuario(3-12 carácteres)</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   placeholder="Ingrese el nombre de usuario" value=" {{old('name')}}">
                                            @if($errors->has('name'))
                                                <label class="text-danger">{{$errors->first('name')}} </label>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="active">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   placeholder="Enter Email"
                                                   value="{{old('email')}}"
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
                                        <button  id="validate" type="submit" class="btn btn-success btn-guardar">
                                            Guardar
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

    <!-- SCRIPTS - DEMO START -->

    <script>

        $('#cedula_p').blur(function () {
            var cedula = $(this).val();

            //Preguntamos si la cedula consta de 10 digitos
            if (cedula.length == 10) {

                //Obtenemos el digito de la region que sonlos dos primeros digitos
                var digito_region = cedula.substring(0, 2);

                //Pregunto si la region existe ecuador se divide en 24 regiones
                if (digito_region >= 1 && digito_region <= 24) {

                    // Extraigo el ultimo digito
                    var ultimo_digito = cedula.substring(9, 10);

                    //Agrupo todos los pares y los sumo
                    var pares = parseInt(cedula.substring(1, 2)) + parseInt(cedula.substring(3, 4)) + parseInt(cedula.substring(5, 6)) + parseInt(cedula.substring(7, 8));

                    //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
                    var numero1 = cedula.substring(0, 1);
                    var numero1 = (numero1 * 2);
                    if (numero1 > 9) {
                        var numero1 = (numero1 - 9);
                    }

                    var numero3 = cedula.substring(2, 3);
                    var numero3 = (numero3 * 2);
                    if (numero3 > 9) {
                        var numero3 = (numero3 - 9);
                    }

                    var numero5 = cedula.substring(4, 5);
                    var numero5 = (numero5 * 2);
                    if (numero5 > 9) {
                        var numero5 = (numero5 - 9);
                    }

                    var numero7 = cedula.substring(6, 7);
                    var numero7 = (numero7 * 2);
                    if (numero7 > 9) {
                        var numero7 = (numero7 - 9);
                    }

                    var numero9 = cedula.substring(8, 9);
                    var numero9 = (numero9 * 2);
                    if (numero9 > 9) {
                        var numero9 = (numero9 - 9);
                    }

                    var impares = numero1 + numero3 + numero5 + numero7 + numero9;

                    //Suma total
                    var suma_total = (pares + impares);

                    //extraemos el primero digito
                    var primer_digito_suma = String(suma_total).substring(0, 1);

                    //Obtenemos la decena inmediata
                    var decena = (parseInt(primer_digito_suma) + 1) * 10;

                    //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
                    var digito_validador = decena - suma_total;

                    //Si el digito validador es = a 10 toma el valor de 0
                    if (digito_validador == 10)
                        var digito_validador = 0;

                    //Validamos que el digito validador sea igual al de la cedula
                    if (digito_validador == ultimo_digito) {

                        $('#lb-cedula-ecuador').attr("hidden","hidden");
                        $('#validate').removeAttr('disabled');
                       // alert('la cedula:' + cedula + ' es correcta');

                    } else {
                        $('#lb-cedula-ecuador').removeAttr("hidden");
                        $('#lb-cedula-ecuador').text("El número de  cédula es inválido");
                        $('#validate').attr('disabled','disabled');
                       // alert('la cedula:' + cedula + ' es incorrecta');
                    }

                } else {
                    // imprimimos en consola si la region no pertenece
                    $('#lb-cedula-ecuador').removeAttr("hidden");
                    $('#validate').attr('disabled','disabled');
                    $('#lb-cedula-ecuador').text("El número de cédula no pertenece a ninguna región");
                   /// alert('Esta cedula no pertenece a ninguna region');
                }
            } else {
                //imprimimos en consola si la cedula tiene mas o menos de 10 digitos
                $('#lb-cedula-ecuador').removeAttr("hidden");
                $('#validate').attr('disabled','disabled');
                $('#lb-cedula-ecuador').text("El número de cédula no tiene  10 Digitos");
               /// alert('Esta cedula tiene menos de 10 Digitos');
            }
        })

    </script>

@endsection