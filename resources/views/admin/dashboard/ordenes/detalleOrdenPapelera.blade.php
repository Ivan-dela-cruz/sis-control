@extends('admin.base.base_tecnicoSecundario')
@section('title')
    orden {{$orden->codigo_or}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic pull-right"><a href="{{route('listar-ordenes-anuladas')}}">Ordenes anuladas</a>/Detalle
                orden
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
                                <a href="{{route('listar-ordenes-anuladas')}}" class="btn btn-outline-white">
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
                            <div class="row">

                                <div class="col-md-5 mx-5">
                                    <div class="form-group">
                                        <p><b>Nombre cliente: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp; <label
                                                    class="nom_cli">{{$orden->user->nombre_p}} {{$orden->user->apellido_p}}</label>
                                        </p>
                                        <input hidden id="ordencliente" type="text">
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
                                        <p><b>Fecha ingreso: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label> {{$orden->fecha_salida_or}}</label></p>
                                    </div>
                                    <div class="form-group">
                                        <p><b>Técnico: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label class="tecnico-encargado bg-success"></label>
                                        </p>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($registros as $registro)
                                        <tr>
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
                                                @if($registro->equipo->tipo_t==5)
                                                    Impresoras
                                                @endif
                                                @if($registro->equipo->tipo_t==6)
                                                    Otros
                                                @endif

                                            </td>
                                            <td>{{$registro->accesorios_re}}</td>
                                            <td>{{$registro->problema_re}}</td>
                                            <td>{{Carbon\Carbon::parse($registro->created_at)->format('Y-m-d')}}</td>
                                            <td>{{$registro->fecha_salida_re}}</td>
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
                                        <th>Solución planteada</th>
                                    </tr>
                                    </thead>
                                    <tr>
                                        @if ($orden->etapa_servicio_or==1)
                                            <td>
                                                <span class="badge badge-primary spanEtapaI">Ingreso</span>
                                            </td>
                                        @endif
                                        @if ($orden->etapa_servicio_or==2)
                                            <td>
                                                <span class="badge badge-warning spanEtapaR">Revisón</span>
                                            </td>
                                        @endif
                                        <td>{{$orden->observacion_problema_or}}</td>
                                        <td>{{$orden->observacion_solucion_or}}</td>
                                    </tr>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="divGenerarOrden pull-right">
                                <button data-id-orden="{{$orden->id}}"
                                        data-cod-orden="{{$orden->codigo_or}}"
                                        class="btn btn-primary btn-md restaurarOrden"
                                        type="button">
                                    <i class="batch-icon batch-icon-user-alt"></i>
                                    Restaurar orden
                                </button>

                                <button data-id-orden="{{$orden->id}}"
                                        data-cod-orden="{{$orden->codigo_or}}"
                                        class="btn btn-danger  btn-md  anularOrden"
                                        type="button">
                                    <i class="batch-icon batch-icon-delete"></i>
                                    Eliminar orden
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.dashboard.ordenes.modalAnularOrden')
@endsection


@section('script')
    <script>
        $('.anularOrden').click(function () {
            var id_or = $(this).data('id-orden');
            $('#idModalEliminacionOrden').modal('show');
            $('#id-orden-status-del').val(id_or);
            $('#txt-id-del').text($(this).data('cod-orden'));
        });
        $('.actionBtnEliminar').click(function () {
            var id_or = $('#id-orden-status-del').val();
            var url = "{{route('eliminar-orden')}}";
            $.ajax({
                type: "delete",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,//"estado-admin/" + $(this).data('id-user') + "/",
                data: {
                    id: id_or,
                    _token: "{{csrf_token()}}",
                    _method: "delete",
                },
                success: function (data) {
                    $('#idModalEliminacionOrden').modal('hide');
                    location.href = "{{route('listar-ordenes-anuladas')}}";
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

        $('.restaurarOrden').click(function () {
            var id_or = $(this).data('id-orden');
            $('#idModalEliminacion').modal('show');
            $('#exampleModalLabelAnular').text('Restaurar orden');
            $('.sms-anular').text('¿Está seguro que desea restaurar la orden?');
            $('#id-orden-status').val(id_or);
            $('#txt-id').text($(this).data('cod-orden'));
        });
        $('.actionBtn').click(function () {
            var id_or = $('#id-orden-status').val();
            var url = "{{route('anular-orden')}}";
            $.ajax({
                type: "put",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,//"estado-admin/" + $(this).data('id-user') + "/",
                data: {
                    id: id_or,
                    _token: "{{csrf_token()}}",
                    _method: "PUT",
                },
                success: function (data) {
                    $('#idModalEliminacion').modal('hide');
                    location.href = "{{route('listar-ordenes-anuladas')}}";
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

    </script>
@endsection