@extends('admin.base.base_dashboard')
@section('title')
    Ordenes de trabajo
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Gestión de Registros</h3>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <div class="lead">
                    <div class="col-lg-5">
                        <!-- USE THIS CODE Instead of the Commented Code Above -->
                        <div class="input-group mb-3">
                            <input id="searchCliente" type="text" class="form-control" placeholder="Buscar cliente"
                                   aria-label="Buscar cliente"
                                   aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="searchInput btn btn-primary" type="button">Buscar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="" method="POST">
                                @csrf
                                @method('POST')

                                <div class="row">

                                    <div class="col-md-5 mx-5">
                                        <div class="form-group">
                                            <p><b>Nombre cliente: </b>
                                                &nbsp;&nbsp;&nbsp;&nbsp; <label class="nom_cli">S/N</label></p>
                                            <input hidden id="ordencliente" type="text">
                                        </div>
                                        <div class="form-group">
                                            <p><b>N° Cédula: </b>
                                                &nbsp;&nbsp;&nbsp;&nbsp; <label class="ci_cli"> 0000000000</label></p>
                                        </div>
                                        <div class="form-group">
                                            <p><b>Dirección cliente: </b>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<label class="dir_cli">
                                                    Ciudad/Avenida/Calle</label>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <p><b>Télefono: </b>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<label class="tlf_cli"> 00000</label></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mx-5">
                                        <div class="form-group">
                                            <p><b>N° Registro: </b>
                                                &nbsp;&nbsp;&nbsp;&nbsp; <label>{{$codigo_orden}}</label></p>
                                        </div>
                                        <div class="form-group">
                                            <p><b>Fecha ingreso: </b>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<label> {{$fecha_hora}}</label></p>
                                        </div>
                                        <div class="form-group">
                                            <p><b>Técnico: </b>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<label> {{$tecnico->id}}</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <a id="btnAgregarEquipo" class="btn btn-primary pull-right showModal"> <i
                                            class="batch-icon batch-icon-add"></i>
                                    agregar equipo</a>
                                <div class="card-table table-responsive">
                                    <table id="tablaOrden" class="table table-hover align-middle">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>N°</th>
                                            <th>N° Serie</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Tipo</th>
                                            <th>Accesorios</th>
                                            <th>Problema</th>
                                            <th>Fecha de salida</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{ csrf_field() }}
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-table">
                                    <div style="height: 40px;" class="bg-primary">
                                        <p style="text-align: center; padding-top: 10px; font-family: 'Arial Black', arial-black;"
                                           class="text-white">Detalles de la orden</p>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_orden"> Fecha de salida de la orden</label>
                                            <input id="fecha_orden" required type="date" class="form-control ">
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="orden_decrip">Observación del Problema</label>
                                            <textarea id="orden_decrip" required class="form-control">....Escriba aquí...</textarea>
                                        </div>

                                    </div>

                                </div>
                                <div class="divGenerarOrden pull-right">
                                    <button disabled class="btn btn-success btnGenerarOrden" type="button">Generar
                                        orden
                                    </button>
                                    <button disabled class="btn btn-danger btnCancelarOrden" type="button">Cancelar
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.dashboard.ordenes.modalRegistroEquipo')
@endsection


@section('script')
    <script>
        $(document).ready(function () {
            //  $('.divGenerarOrden').hide();
        });
        var contador = 0; //variable para controlar el numero de equipos en la lista del detalle de la orden
        //funcion para ver los agregar lo equipos al detalle de la orden

        function agregarRegistro() {
            var id_p = $('#ordencliente').val();
            // var _token = "{{csrf_token()}}";
            var serie_e = $('#serie_equipo').val();
            var marca_e = $('#marca_e').val();
            var modelo_t = $('#modelo_e').val();
            var tipo_t = $('#tipo_t').val();
            var descripcion_e = $('#descripcion_e').val();
            var problema_re = $('#problema_re').val();
            var fecha_salida_re = $('#fecha_salida_re').val();
            var accesorios_re = $('#accesorios_re').val();

            var fila = '<tr class="id' + contador + '">' +
                '<td>' + (contador + 1) + '</td>' +
                '<td class="serie">' + serie_e + '</td>' +
                '<td class="marca">' + marca_e + '</td>' +
                '<td class="modelo">' + modelo_t + '</td>' +
                '<td class="tipo">' + tipo_t + '</td>' +
                '<td class="accesorio">' + accesorios_re + '</td>' +
                '<td class="problema">' + problema_re + '</td>' +
                '<td class="fecha_salida">' + fecha_salida_re + '</td>' +
                '<td><a id="detalleOrden' + contador + '" class="deleteModal btn btn-success btn-sm">' +
                '<i class="batch-icon batch-icon-shuffle"></i>' +
                ' </a><textarea hidden class="descripccion">' + descripcion_e + '</textarea></td>' +
                '</tr>';
            contador++;
            $('#tablaOrden').append(fila);
            // $('.divGenerarOrden').show();
            //$('.btnGenerarOrden').removeAttr('disabled');
            desbloarBotonesOrnde();
            //$('.btnCancelarOrden').removeAttr('disabled');


        }

        function bloquearRegistroEquipo() {
            $('#serie_equipo').attr('disabled', 'disabled');
            $('#marca_e').attr('disabled', 'disabled');
            $('#modelo_e').attr('disabled', 'disabled');
            $('#tipo_t').attr('disabled', 'disabled');

        }

        function desbloquerRegistroEquipo() {
            $('#serie_equipo').removeAttr('disabled');
            $('#marca_e').removeAttr('disabled');
            $('#modelo_e').removeAttr('disabled');
            $('#tipo_t').removeAttr('disabled');

        }

        $('.btnsearchEquipo').click(function () {
            var query = $('#searchEquipo').val();
            $.ajax({
                url: "busqueda-equipo/{query}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function (data) {
                    if (data.mensaje == 'Datos no encontrados') {
                        $('#serie_equipo').val('');
                        $('#marca_e').val('');
                        $('#modelo_e').val('');
                        $('#descripcion_e').val('');
                        $('#searchEquipo').val(data.mensaje);
                        desbloquerRegistroEquipo();
                    } else {
                        $('#serie_equipo').val(data.serie_e);
                        $('#marca_e').val(data.marca_e);
                        $('#modelo_e').val(data.modelo_t);
                        $('#tipo_t').val(data.tipo_t);
                        $('#descripcion_e').val(data.descripcion_e);
                        $('#searchEquipo').val(data.serie_e);
                        bloquearRegistroEquipo();
                    }

                }
            })
        });

        //funcion para ocultar los inputs cuando el equipo ya exista
        function cargarEquipo() {

            $('#serie_equipo').val('');
            $('#marca_e').val('');
            $('#modelo_e').val('');
            $('#descripcion_e').val('');

        }

        ///FUNCIONES PARA VER LOS ERRORES
        function printErrorMsg(msg) {

            $(".print-error-msg").find("ul").html('');

            $(".print-error-msg").css('display', 'block');

            $.each(msg, function (key, value) {

                $(".print-error-msg").find("ul").append('<li>' + value + '</li>');

            });
        }

        function limpiarModal() {
            $('#serie_equipo').val('');
            $('#marca_e').val('');
            $('#modelo_e').val('');
            $('#descripcion_e').val('');
            $('#problema_re').val('');
            $('#accesorios_re').val('');
            $('#fecha_salida_re').val('');
            $('#searchEquipo').val('');
            desbloquerRegistroEquipo();
        }

        /// eventos para el clien de los elemtos 

        $('#fecha_orden').change(function () {
            desbloarBotonesOrnde();
        });
        $('#orden_decrip').keyup(function () {
            desbloarBotonesOrnde();
            if ($(this).val() == '') {
                $('#orden_decrip').addClass("border-danger");
            } else {
                $('#orden_decrip').removeClass("border-danger");
            }
        });

        function desbloarBotonesOrnde() {
            if (contador != 0 && $('#orden_decrip').val() != '' && $('#fecha_orden').val() != '') {
                $('.btnGenerarOrden').removeAttr('disabled');
                $('.btnCancelarOrden').removeAttr('disabled');
            }
        }

        $('.btnGenerarOrden').click(function () {
            let materiales = [];
            var fechaval = $('#fecha_orden').val();
            var descripor = $('#orden_decrip').val();
            if (contador == 0 && fechaval == '' && descripor == '') {


            } else {
                if (descripor == '') {
                    $('#orden_decrip').addClass("border-danger");
                } else {

                    $('#orden_decrip').removeClass("border-danger");
                    document.querySelectorAll('#tablaOrden tbody tr').forEach(function (e) {
                        let fila = {
                            serie: e.querySelector('.serie').innerText,
                            marca: e.querySelector('.marca').innerText,
                            modelo: e.querySelector('.modelo').innerText,
                            problema: e.querySelector('.problema').innerText,
                            accesorios: e.querySelector('.accesorio').innerText,
                            fecha_salida: e.querySelector('.fecha_salida').innerText,
                            descripcion: e.querySelector('.descripccion').innerText,
                            tipo: e.querySelector('.tipo').innerText,
                        };
                        materiales.push(fila);
                    });
                    console.log(materiales);
                    $.ajax({
                        url: "generarOrden",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            data: {
                                materiales
                            },
                            id_p: $('#ordencliente').val(),
                            _token: "{{csrf_token()}}",
                            fecha_salida_re: $('#fecha_orden').val(),
                            observacion_problema_or: $('#orden_decrip').val(),
                            //CONTIENEN LA COLECCION DE DATOS DEL DETALLE D ELA ORDEN DE TRABAJO

                            _method: "POST",
                            contador: contador,
                        },
                        success: function (data) {
                            $('.btnGenerarOrden').attr('disabled', 'disabled');
                            $('.btnCancelarOrden').attr('disabled', 'disabled');
                            $('#orden_decrip').removeClass("border-danger");
                        }
                    })
                    ;

                }


            }

        });

        $('#btncerrarModal').click(function () {
            limpiarModal();
        });

        $('#btnAgregarEquipo').click(function () {
            $('#idModal').modal('show');
        });
        $('.deleteModal').click(function () {
            var estado = $(this).data('estado-user');
            if (estado == 0) {
                $('.modal-title').text('Habilitar usuario');
            } else {
                $('.modal-title').text('Inhabilitar usuario');
            }
            var status = $(this).data('estado-actual');
            if (status != 'activo') {
                $('#estado-actua-user').removeClass('btn-success');
                $('#estado-actua-user').addClass('btn-deep-orange');
            } else {
                $('#estado-actua-user').removeClass('btn-deep-orange');
                $('#estado-actua-user').addClass('btn-success');
            }
            $('#idModalEliminacion').modal('show');
            $('#id-user-edit').val($(this).data('id-user'));
            $('#estado-user-edit').val($(this).data('estado-user'));
            $('#estado-actua-user').text($(this).data('estado-actual'));
            $('#ci-usuario').text($(this).data('cedula-actual'));
        });

        $('.actionBtn').click(function () {

            var id_user = $('#id-user-edit').val();
            var url = "estado-admin";
            $.ajax({
                type: "put",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,//"estado-admin/" + $(this).data('id-user') + "/",
                data: {
                    id: id_user,
                    _token: "{{csrf_token()}}",
                    _method: "PUT",
                },
                success: function (data) {
                    //  $('.usuarios' + data.id).replaceWith(" ");

                    //  $('#sectionRefresh').empty().append($(data));
                    location.reload();
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    if (errors) {
                        $.each(errors, function (i) {
                            console.log(errors[i]);
                        });
                    }
                }
            });
        });

        $('.searchInput').click(function () {
            var query = $('#searchCliente').val();
            $.ajax({
                url: "busqueda-cliente/{query}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function (data) {
                    if (data.mensaje == 'Datos no encontrados') {
                        $('.nom_cli').text(data.mensaje);
                        $('.ci_cli').text('');
                        $('.dir_cli').text('');
                        $('.tlf_cli').text('');
                    } else {
                        $('#ordencliente').val(data.id);
                        $('.nom_cli').text(data.nombres);
                        $('.ci_cli').text(data.cedula_p);
                        $('.dir_cli').text(data.direccion_p);
                        $('.tlf_cli').text(data.telefono_p);
                    }

                }
            })


        });


        $('#btnGuardarModal').click(function () {
            $.ajax({
                url: "{{route('ordenes.store')}}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id_p: $('#ordencliente').val(),
                    _token: "{{csrf_token()}}",
                    serie_e: $('#serie_equipo').val(),
                    marca_e: $('#marca_e').val(),
                    modelo_t: $('#modelo_e').val(),
                    tipo_t: $('#tipo_t').val(),
                    descripcion_e: $('#descripcion_e').val(),
                    problema_re: $('#problema_re').val(),
                    fecha_salida_re: $('#fecha_salida_re').val(),
                    accesorios_re: $('#accesorios_re').val(),
                    _method: "POST",

                },
                success: function (data) {

                    if ($.isEmptyObject(data.error)) {

                        // alert(data.success);
                        agregarRegistro();
                        limpiarModal();

                    } else {
                        printErrorMsg(data.error);

                    }
                }
            })
        });

    </script>
@endsection