@extends('admin.base.base_tecnicoSecundario')
@section('title')
    Ordenes de trabajo
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic pull-right"><a href="{{route('listar-ordenes-ingresos')}}">Ordenes</a>/Nueva</p>
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
                                        <h3>Datos del cliente</h3>
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
                                        <h3>Datos de la orden</h3>
                                        <div class="form-group">
                                            <p><b>N° Registro: </b>
                                                &nbsp;&nbsp;&nbsp;&nbsp; <label>{{$codigo_orden}}</label></p>
                                        </div>
                                        <div class="form-group">
                                            <p><b>Fecha ingreso: </b>
                                                &nbsp;&nbsp;&nbsp;&nbsp;<label> {{$fecha_hora}}</label></p>
                                        </div>
                                        <div class="form-group">
                                            <p><b>Regitrado por: </b>

                                                &nbsp;&nbsp;&nbsp;&nbsp;<label> {{$nombres_tec}}</label>
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
    <script type="text/javascript" src="{{asset('js/ajax/creaarOrdenIndex.js')}}"></script>
    <script>
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
                            location.href = 'ver-orden/' + data.id;
                        }
                    })
                    ;

                }


            }

        });


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

    </script>
@endsection