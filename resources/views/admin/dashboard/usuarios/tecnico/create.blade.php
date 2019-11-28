@extends('admin.base.base_dashboard')
@section('title')
    Nuevo-Técnicos
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic pull-right"><a href="{{route('tecnicos.index')}}">Técnicos</a>/Nuevo </p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    <a href="{{url()->previous()}}" class="btn btn-outline-white btn-sm pull-right">
                        <i class="batch-icon batch-icon-out"></i> Atras
                    </a>
                    Nuevo Técnico

                </p>
            </div>

            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">

                            {!! Form::open(['route' => 'tecnicos.store', 'files' => true]) !!}

                            @include('admin.dashboard.usuarios.tecnico.partials.form')

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

                        $('#lb-cedula-ecuador').attr("hidden", "hidden");
                        $('#validate').removeAttr('disabled');
                        // alert('la cedula:' + cedula + ' es correcta');

                    } else {
                        $('#lb-cedula-ecuador').removeAttr("hidden");
                        $('#lb-cedula-ecuador').text("El número de  cédula es inválido");
                        $('#validate').attr('disabled', 'disabled');
                        // alert('la cedula:' + cedula + ' es incorrecta');
                    }

                } else {
                    // imprimimos en consola si la region no pertenece
                    $('#lb-cedula-ecuador').removeAttr("hidden");
                    $('#validate').attr('disabled', 'disabled');
                    $('#lb-cedula-ecuador').text("El número de cédula no pertenece a ninguna región");
                    /// alert('Esta cedula no pertenece a ninguna region');
                }
            } else {
                //imprimimos en consola si la cedula tiene mas o menos de 10 digitos
                $('#lb-cedula-ecuador').removeAttr("hidden");
                $('#validate').attr('disabled', 'disabled');
                $('#lb-cedula-ecuador').text("El número de cédula no tiene  10 Digitos");
                /// alert('Esta cedula tiene menos de 10 Digitos');
            }
        })

    </script>

@endsection