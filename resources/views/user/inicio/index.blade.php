@extends('user.base.base')

@section('search')
    <div class="col-md-6">
        <div class="header-search">
            {!! Form::open(['route' => 'cliente', 'method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}

            {{Form::select('parametroBuscar',array(
               'codigo_or' => 'Orden',
               'created_at' => 'Fecha',
               ),$parametro,['id'=>'parametroBuscar','class'=>'input-select'])}}
            @if($parametro=='codigo_or')
                <input name="query" id="inputOrden" type="text" class="input"
                       placeholder="Buscar orden de trabajo" value="{{$query}}">
                <input disabled hidden name="query" id="inputFecha" type="date" class="input">
            @endif
            @if ($parametro=='created_at')
                <input disabled hidden name="query" id="inputOrden" type="text" class="input"
                       placeholder="Buscar orden de trabajo">
                <input name="query" id="inputFecha" type="date" class="input" value="{{$query}}">
            @endif

            <button class="btnSearchOrden search-btn" type="submit">Buscar</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('notificacion')
    @include('user.inicio.notificacion')
@endsection
@section('links')
    <li class="active"><a href="{{route('cliente')}}">Pendientes</a></li>
    <li class=""><a href="{{route('historial-cliente')}}">Mis ordenes</a></li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-responsive">
                        <thead style="background-color: #15161D;" class="bg-primary">
                        <tr>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Observacion Genaral</th>
                            <th class="text-center">Etapa</th>
                            <th width="100">Emisión</th>
                            <th width="100">Salida</th>
                            <th class="text-center">Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{ csrf_field() }}
                        @if (count($ordenes)>0)
                            @foreach($ordenes as $orden)
                                @if ($orden->etapa_servicio_or!=3)
                                    <tr class="orden{{$orden->id}}">
                                        <td>
                                            <a href="">orden - {{$orden->codigo_or}}</a>
                                        </td>
                                        <td>{{$orden->nombre_p}}  {{$orden->apellido_p}}</td>
                                        <td>{{$orden->observacion_problema_or}}</td>
                                        <td>
                                            @if($orden->etapa_servicio_or==1)
                                                <span class="btn-primary">Ingreso</span>
                                            @endif
                                            @if($orden->etapa_servicio_or==2)
                                                <span class="btn-warning"> Revisión</span>
                                            @endif
                                            @if($orden->etapa_servicio_or==3)
                                                <span class="btn-success">Terminado</span>
                                            @endif
                                        </td>
                                        <td>{{Carbon\Carbon::parse($orden->created_at)->format('Y-m-d') }}</td>
                                        <td>{{$orden->fecha_salida_or}}</td>
                                        <td class="text-right">
                                            @if ($orden->etapa_servicio_or==1)
                                                <a title="Imprimir orden"
                                                   href="{{route('orden-pdf-ingreso',$orden->id)}}"
                                                   class="btn  btn-success btn-sm imprimirOrden"
                                                   data-id-orden="{{$orden->id}}">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            @endif
                                            @if ($orden->etapa_servicio_or==2)
                                                <a title="Imprimir orden"
                                                   href="{{route('orden-pdf',$orden->id)}}"
                                                   class="btn  btn-success btn-sm imprimirOrden"
                                                   data-id-orden="{{$orden->id}}">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            @endif
                                            @if ($orden->etapa_servicio_or==3)
                                                <a title="Imprimir orden"
                                                   href="{{route('orden-pdf',$orden->id)}}"
                                                   class="btn  btn-success btn-sm imprimirOrden"
                                                   data-id-orden="{{$orden->id}}">
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            @endif
                                            <a title="Ver detalles" href="{{route('ver-orden-cliente',$orden->id)}}"
                                               data-id-orden="{{$orden->id}}"
                                               class="btn  btn-primary btn-sm verOrden">
                                                <i class="fa fa-file"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endif

                            @endforeach
                        @else
                            <tr>
                                <td colspan="7"><h3 class="text-center">No hay registros para mostrar</h3></td>
                            </tr>
                        @endif
                        </tbody>
                        {{$ordenes->render()}}
                    </table>
                </div>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

            if (isMobile()) {
                console.log('movil');
                $('#divNoti').hide();
            }
            console.log(isMobile());
        });

        function isMobile() {
            return (
                (navigator.userAgent.match(/Android/i)) ||
                (navigator.userAgent.match(/webOS/i)) ||
                (navigator.userAgent.match(/iPhone/i)) ||
                (navigator.userAgent.match(/iPod/i)) ||
                (navigator.userAgent.match(/iPad/i)) ||
                (navigator.userAgent.match(/BlackBerry/i))
            );
        }

        $('#parametroBuscar').change(function () {
            var selecion = $(this).val();
            if (selecion == 'created_at') {
                $('#inputFecha').removeAttr('disabled');
                $('#inputFecha').removeAttr('hidden');
                $('#inputOrden').attr('disabled', 'disabled');
                $('#inputOrden').attr('hidden', 'hidden');
            }
            if (selecion == 'codigo_or') {
                $('#inputOrden').removeAttr('disabled');
                $('#inputOrden').removeAttr('hidden');
                $('#inputFecha').attr('disabled', 'disabled');
                $('#inputFecha').attr('hidden', 'hidden');
            }
        });

    </script>
@endsection