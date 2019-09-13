@extends('admin.base.base_dashboard')
@section('title')
    Ordenes de trabajo
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic pull-right">
                <a href="{{route('administrador')}}">Inicio</a>/
                <a href="{{route('listar-ordenes-anuladas')}}">
                    Ordenes anuladas
                </a>/
            </p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    Ordenes de trabajo
                    <a class="btn btn-outline-white btn-sm pull-right" href="{{route('ordenes.index')}}">
                        <i class="batch-icon batch-icon-add"></i>
                        Agregar
                    </a>
                </p>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            {!! Form::open(['route' => 'listar-ordenes', 'method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
                            <div class="input-group mb-3">
                                {{Form::select('parametroBuscar',array(
                                   'cedula_p' => 'Cédula',
                                   'codigo_or' => 'N° Orden',
                                   'created_at' => 'Fecha',
                                   ),$parametro,['id'=>'parametroBuscar'])}}
                                <input name="query" id="searchOrdenes" type="text" class="form-control"
                                       placeholder="Buscar orden de trabajo"
                                       aria-label="Buscar orden"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btnSearchOrden btn btn-primary" type="submit">Buscar</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Orden</th>
                                        <th>Cliente</th>
                                        <th>Observacion Genaral</th>
                                        <th class="text-center">Etapa</th>
                                        <th>Emisión</th>
                                        <th>Salida</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{ csrf_field() }}
                                    @foreach($ordenes as $orden)
                                        <tr class="orden{{$orden->id}}">

                                            <td>
                                                <a href="">orden - {{$orden->codigo_or}}</a>
                                            </td>
                                            <td>{{$orden->nombre_p}}  {{$orden->apellido_p}}</td>
                                            <td>{{$orden->observacion_problema_or}}</td>
                                            <td>
                                                @if($orden->etapa_servicio_or==1)
                                                    <span class="badge badge-primary">Ingreso</span>

                                                @endif
                                                @if($orden->etapa_servicio_or==2)
                                                    <span class="badge badge-warning"> Revisión</span>

                                                @endif
                                                @if($orden->etapa_servicio_or==3)
                                                    <span class="badge badge-success">Terminado</span>

                                                @endif
                                            </td>
                                            <td>{{Carbon\Carbon::parse($orden->created_at)->format('Y-m-d') }}</td>
                                            <td>{{$orden->fecha_salida_or}}</td>

                                            <td class="text-right">
                                                <a title="Restaurar orden"
                                                   data-cod-orden="{{$orden->codigo_or}}"
                                                   data-id-orden="{{$orden->id}}"
                                                   class="btn  btn-success btn-sm restaurarOrden">
                                                    <i class="batch-icon batch-icon-refresh"></i>
                                                </a>
                                                <a title="Ver detalles" href="{{route('orden-papelera-detalle',$orden->id)}}"
                                                   data-id-orden="{{$orden->id}}"
                                                   class="btn  btn-primary btn-sm verOrden">
                                                    <i class="batch-icon batch-icon-eye"></i>
                                                </a>

                                                <a title="Eliminar orden"
                                                   data-cod-orden="{{$orden->codigo_or}}"
                                                   data-id-orden="{{$orden->id}}"
                                                   class="anularOrden btn btn-danger btn-sm">
                                                    <i class="batch-icon batch-icon-delete"></i>
                                                </a>


                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$ordenes->render()}}
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
                    $('.orden' + id_or).remove();
                    $('#idModalEliminacionOrden').modal('hide');
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
                    $('.orden' + data.id).remove();
                   // location.href = "{{route('listar-ordenes-anuladas')}}";
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