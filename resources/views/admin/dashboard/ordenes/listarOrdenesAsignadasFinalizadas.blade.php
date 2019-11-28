@extends('admin.base.base_tecnicoPrincipal')
@section('title')
    Ordenes de trabajo asignadas
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="pull-right font-italic"><a href="{{route('listar-ordenes-asignadas')}}">Ordenes</a>/</p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    Ordenes de trabajo Finalizadas
                </p>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            {!! Form::open(['route' => 'listar-ordenes-finalizadas', 'method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
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
                                <table class="table table-hover table-striped table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="85px">Orden</th>
                                        <th class="th-lg">Cliente</th>
                                        <th>Observacion Genaral</th>
                                        <th class="text-center">Etapa</th>
                                        <th class="th-lg">Emisión</th>
                                        <th class="th-lg">Salida</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                    {{ csrf_field() }}
                                    @foreach($ordenes as $orden)
                                        <tr class="equipo{{$orden->id}}">

                                            <td>
                                                <a href="">orden - {{$orden->codigo_or}}</a>
                                            </td>
                                            <td class="text-uppercase">{{$orden->nombre_p}}  {{$orden->apellido_p}}</td>
                                            <td class="text-uppercase">{{$orden->observacion_problema_or}}</td>
                                            <td>
                                                @if($orden->etapa_servicio_or==3)
                                                    <span class="badge badge-success">Terminado</span>
                                                @endif
                                            </td>
                                            <td>{{Carbon\Carbon::parse($orden->created_at)->format('Y-m-d') }}</td>
                                            <td>{{$orden->fecha_salida_or}}</td>

                                            <td class="text-right">
                                                <a href="{{route('orden-pdf',$orden->id)}}"
                                                   class="btn  btn-orange btn-sm imprimirOrden"
                                                   data-id-orden="{{$orden->id}}">
                                                    <i class="batch-icon batch-icon-print"></i>
                                                </a>
                                                <a href="{{route('revision-orden-tecnico-finalizada',$orden->id)}}"
                                                   data-id-orden="{{$orden->id}}"
                                                   class="btn  btn-success btn-sm verOrden">
                                                    <i class="batch-icon batch-icon-eye"></i>
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
    @include('admin.dashboard.ordenes.modalSolucion')
@endsection
@section('script')
    <script>

        function desbloquearBotones() {
            $('#labelRechazoOrden').attr('hidden', 'hidden');
            $('.btnRechazarOrden').attr('hidden', 'hidden');
            $('.btnGuardarSolucion').removeAttr('hidden');
            $('#labelSolucion').removeAttr('hidden');
        }

        function bloquearBotones() {
            $('#labelRechazoOrden').removeAttr('hidden');
            $('.btnRechazarOrden').removeAttr('hidden');
            $('.btnGuardarSolucion').attr('hidden', 'hidden');
            $('#labelSolucion').attr('hidden', 'hidden');
        }

        $('.anularOrden').click(function () {
            $('#idModal').modal('show');
            $('#id_or').val($(this).data('id-orden'));
            bloquearBotones();
        });

        $('.btnRechazarOrden').click(function () {
            var texto = $('#orden-solucion').val();
            var id_or = $('#id_or').val();
            // $('.tecnico-encargado').text($(this).data('nombres-tec'));
            $.ajax({
                url: "{{route('rechazar-orden')}}",
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
                    $('.orden-solucion-id').text(data.observacion_solucion_or);
                    $('#solucion-anterior').val(data.observacion_solucion_or);
                    desbloquearBotones();
                    $('#idModal').modal('hide');
                    location.reload();
                    // $('#orden-solucion').val('');
                }
            })
        });
    </script>
@endsection