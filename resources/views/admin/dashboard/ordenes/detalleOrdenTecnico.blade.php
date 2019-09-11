@extends('admin.base.base_dashboard')
@section('title')
    orden {{$orden->codigo_or}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="pull-right font-italic"><a href="{{route('listar-ordenes-asignadas')}}">Ordenes</a>/Detalle orden
                - {{$orden->codigo_or}} </p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <div class="lead">
                    <div class="col-lg-5">
                        <!-- USE THIS CODE Instead of the Commented Code Above -->
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <a href="{{url()->previous()}}" class="btn btn-outline-white">
                                    <i class="batch-icon batch-icon-out"></i>
                                    Atras
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Datos del cliente</h4>
                            <div class="row">

                                <div class="col-md-5 mx-5">
                                    <div class="form-group">
                                        <p><b>Nombre cliente: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp; <label
                                                    class="nom_cli">{{$orden->user->nombre_p}} {{$orden->user->apellido_p}}</label>
                                        </p>
                                        <input hidden id="id-orden-detalle" type="text" value="{{$orden->id}}">
                                        <input hidden id="id-orden-cod" type="text" value="{{$orden->codigo_or}}">

                                    </div>
                                    <div class="form-group">
                                        <p><b>N° Cédula: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp; <label
                                                    class="ci_cli"> {{$orden->user->cedula_p}}</label></p>
                                    </div>
                                    <div class="form-group">
                                        <p><b>Dirección cliente: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label class="dir_cli">
                                                {{$orden->user->direccion_p}}</label>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <p><b>Télefono: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label
                                                    class="tlf_cli"> {{$orden->user->telefono_p}}</label></p>
                                    </div>
                                </div>
                                <div class="col-md-4 mx-5">
                                    <div class="form-group">
                                        <p><b>N° Registro: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp; <label>{{$orden->codigo_or}}</label></p>
                                    </div>
                                    <div class="form-group">
                                        <p><b>Fecha ingreso: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label>{{Carbon\Carbon::parse($orden->created_at)->format('Y-m-d')}}</label>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <p><b>Fecha salida: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label
                                                    class="fecha-orden-salida"> {{$orden->fecha_salida_or}}</label></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h4>Datos del Técnico encargado</h4>
                            <div class="row">

                                <div class="col-md-5 mx-5">
                                    <div class="form-group">
                                        <p><b>Nombres Técnico: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label
                                                    class="tecnico-encargado">{{$tecnico->user->nombre_p}}  {{$tecnico->user->apellido_p}}</label>
                                        </p>
                                    </div>

                                    <div class="form-group">
                                        <p><b>N° Cédula: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp; <label
                                                    class="ci_cli"> {{$tecnico->user->cedula_p}}</label></p>
                                    </div>

                                </div>
                                <div class="col-md-4 mx-5">
                                    <div class="form-group">
                                        <p><b>Profesión: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label class="dir_cli">
                                                {{$tecnico->profesion_t}}</label>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <p><b>Especialidad: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label
                                                    class="tlf_cli"> {{$tecnico->especialidad_t}}</label></p>
                                    </div>

                                </div>
                            </div>
                            <hr>
                            <h4>Lista de equipos</h4>
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
                                        <th>Fecha de ingreso</th>
                                        <th>Fecha de salida</th>
                                        <th>Modificar salida</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($registros as $registro)
                                        <tr class="detalle{{$registro->id}}">
                                            <td>
                                                <a href="">{{$registro->equipo->serie_e}}</a>
                                            </td>
                                            <td>{{$registro->equipo->marca_e}}</td>
                                            <td>{{$registro->equipo->modelo_t}}</td>
                                            <td>
                                                @if($registro->equipo->tipo_t==1)
                                                    Laptop
                                                @endif
                                                @if($registro->equipo->tipo_t==2)
                                                    CPU
                                                @endif
                                                @if($registro->equipo->tipo_t==3)
                                                    Monitor
                                                @endif
                                                @if($registro->equipo->tipo_t==4)
                                                    Tablet
                                                @endif

                                            </td>
                                            <td>{{$registro->accesorios_re}}</td>
                                            <td>{{$registro->problema_re}}</td>
                                            <td>{{Carbon\Carbon::parse($registro->created_at)->format('Y-m-d')}}</td>
                                            <td class="salida-regis{{$registro->id}}">{{$registro->fecha_salida_re}}</td>
                                            <td>
                                                <a data-fecha-registro="{{$registro->fecha_salida_re}}"
                                                   data-id-registro="{{$registro->id}}"
                                                   class="btn  btn-primary btn-sm editarFecha">
                                                    <i class="batch-icon batch-icon-quill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {{$registros->render()}}
                            </div>
                            <hr>
                            <h4>Observaciones</h4>
                            <div class="card-table">
                                <table id="tablaOrden" class="table table-hover align-middle">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Estado</th>
                                        <th>Problemática de la orden</th>
                                        <th>solución planteada</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        @if ($orden->etapa_servicio_or==1)
                                            <td>
                                                <span class="badge badge-primary">Ingreso</span>
                                            </td>
                                        @endif
                                        @if ($orden->etapa_servicio_or==2)
                                            <td>
                                                <span class="badge badge-warning">Revisón</span>
                                            </td>
                                        @endif
                                        @if ($orden->etapa_servicio_or==3)
                                            <td>
                                                <span class="badge badge-success">Terminado</span>
                                            </td>
                                        @endif
                                        <td>{{$orden->observacion_problema_or}}</td>
                                        <td class="orden-solucion-id{{$orden->id}}">{{$orden->observacion_solucion_or}}</td>
                                    </tr>
                                    <tbody>
                                    </tbody>
                                </table>
                                <textarea hidden name="" id="solucion-anterior" cols="30"
                                          rows="10">{{$orden->observacion_solucion_or}}</textarea>
                            </div>
                            <hr>
                            <div class="divGenerarOrden pull-right">
                                <a href="{{route('orden-pdf',$orden->id)}}"
                                   class="btn btn-success   btn-md  btnGenerarOrden">
                                    <i class="batch-icon batch-icon-print"></i>
                                    Imprimir
                                </a>
                                <button class="btn btn-deep-orange btn-md btnFechaOrdenCambio" type="button">
                                    <i class="batch-icon batch-icon-shuffle"></i>
                                    Modificar Fecha de salida
                                </button>
                                <button class="btn btn-primary btn-md btnSolucion" type="button">
                                    <i class="batch-icon batch-icon-user-alt"></i>
                                    Agregar solución
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.dashboard.ordenes.modalSolucion')
@endsection


@section('script')
    <script>

        $('.btnGuardarSolucion').click(function () {
            var texto = $('#orden-solucion').val();
            var id_or = $('#id-orden-detalle').val();
            // $('.tecnico-encargado').text($(this).data('nombres-tec'));
            $.ajax({
                url: "{{route('agregar-solucion',$orden->id)}}",
                method: 'put',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    observacion_solucion_or: texto,
                    id_or: id_or,
                    _token: "{{csrf_token()}}",
                },
                success: function (data) {
                    $('.orden-solucion-id{{$orden->id}}').text(data.observacion_solucion_or);
                    $('#solucion-anterior').val(data.observacion_solucion_or);
                    $('#idModal').modal('hide');
                    // $('#orden-solucion').val('');
                }
            })
        });
        $('.btnSolucion').click(function () {
            $('#idModal').modal('show');
            $('#orden-solucion').text($('#solucion-anterior').val());

        });
        $('.editarFecha').click(function () {
            $('#idModalFecha').modal('show');
            $('#fecha-actual').val($(this).data('fecha-registro'));
            $('#id-regis').val($(this).data('id-registro'));

        });
        $('#n-fecha-salida').change(function () {
            $('.btnFecha').removeAttr('disabled');
        });
        $('.cancelar-fecha').click(function () {
            limpiarFecha();
        });
        $('.btnFecha').click(function () {
            var fecha = $('#n-fecha-salida').val();
            var id = $('#id-regis').val();
            var url = "{{route('cambiar-fecha')}}";
            $.ajax({
                type: "put",
                url: url,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: "{{csrf_token()}}",
                    _method: "PUT",
                    id: id,
                    fecha_salida_re: fecha

                },
                success: function (data) {
                    $('.salida-regis' + data.id).replaceWith("<td>" + data.fecha_salida_re + "</td>");
                    limpiarFecha();
                    $('#idModalFecha').modal('hide');
                    // text(data.fecha_salida_re);
                }
            })

        });

        $('.btnFechaOrden').click(function () {
            var fecha = $('#orden-fecha-modal').val();
            var id = $('#id-ordentrajabo').val();
            var url = "{{route('cambiar-fecha-orden')}}";
            $.ajax({
                type: "put",
                url: url,
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: "{{csrf_token()}}",
                    _method: "PUT",
                    id: id,
                    fecha_salida_or: fecha

                },
                success: function (data) {
                    $('.fecha-orden-salida').text(data.fecha_salida_or)
                    limpiarFechaOrden();
                    $('#idModalFechaOrden').modal('hide');

                }
            })
        });
        $('.btnFechaOrdenCambio').click(function () {
            $('#idModalFechaOrden').modal('show');

            $('.cod-orden').text('Orden - ' + $('#id-orden-cod').val());

            $('#fecha-actual-orden').text($('.fecha-orden-salida').text());

            $('#id-ordentrajabo').val($('#id-orden-detalle').val());
        });

        $('#orden-fecha-modal').change(function () {
            $('.btnFechaOrden').removeAttr('disabled');
        });

        $('.cancelar-fechaOrden').click(function () {
            limpiarFecha();
        });

        function limpiarFechaOrden() {
            $('#fecha-actual-orden').text('');
            $('#orden-fecha-modal').val('');
            $('#id-ordentrajabo').val('');
            $('.btnFechaOrden').attr('disabled', 'disabled');
        }


        function limpiarFecha() {
            $('#fecha-actual').val('');
            $('#n-fecha-salida').val('');
            $('#id-regis').val('');
            $('.btnFecha').attr('disabled', 'disabled');
        }
    </script>
@endsection