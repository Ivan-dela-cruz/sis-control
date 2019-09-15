@extends('user.base.base')
@section('css')
    <style>

        .headerOrden {
            margin: 0.5em;
            text-transform: capitalize;
        }
    </style>
@endsection
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
@if ($orden->etapa_servicio_or==3)
@section('links')
    <li class=""><a href="{{route('cliente')}}">Pendientes</a></li>
    <li class="active"><a href="{{route('historial-cliente')}}">Mis ordenes</a></li>
@endsection
@else
@section('links')
    <li class="active"><a href="{{route('cliente')}}">Pendientes</a></li>
    <li class=""><a href="{{route('historial-cliente')}}">Mis ordenes</a></li>
@endsection
@endif
@section('content')
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- Order Details -->
                    <div class="col-md-12 order-details">

                        <div class="table-responsive">


                            <table class="table-bordered align-middle">
                                <thead>
                                <tr>
                                    <th style="background-color: #D10024;" colspan="4"><h3
                                                style="color: white; margin: 0.5em;" class="title text-center">SU
                                            ORDEN</h3>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="4"><p class="headerOrden"><b>Orden de Trabajo</b></p></td>
                                </tr>
                                <tr>
                                    <td width="25%"><p class="headerOrden"><b>Código: </b> {{$orden->codigo_or}}</p>
                                    </td>
                                    <td width="25%"><p class="headerOrden"><b>Fecha de
                                                emisión: </b> {{$orden->codigo_or}}</p></td>
                                    <td width="25%"><p class="headerOrden"><b>Fecha de
                                                entrega: </b> {{$orden->user->cedula_p}}</p></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><p class="headerOrden"><b>Cliente</b></p></td>
                                </tr>
                                <tr>
                                    <td width="25%"><p class="headerOrden">
                                            <b>Nombres: </b> {{$orden->user->nombre_p}} {{$orden->user->apellido_p}}</p>
                                    </td>
                                    <td width="25%"><p class="headerOrden"><b>Cédula: </b> {{$orden->user->cedula_p}}
                                        </p>
                                    </td>
                                    <td width="25%"><p class="headerOrden">
                                            <b>Dirección: </b> {{$orden->user->direccion_p}}</p></td>
                                    <td width="25%"><p class="headerOrden">
                                            <b>Teléfono: </b> {{$orden->user->telefono_p}}</p></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><p class="headerOrden"><b>Técnico encargado</b></p></td>
                                </tr>

                                @if ($tecnico!=null)
                                    <tr>
                                        <td width="25%">
                                            <p class="headerOrden">
                                                <b>Nombres: </b> {{$tecnico->user->nombre_p}}  {{$tecnico->user->apellido_p}}
                                            </p></td>
                                        <td width="25%"><p class="headerOrden">
                                                <b>Cédula: </b> {{$tecnico->user->cedula_p}}
                                            </p>
                                        </td>
                                        <td width="25%"><p class="headerOrden">
                                                <b>Profesión: </b> {{$tecnico->profesion_t}}
                                            </p>
                                        </td>
                                        <td width="25%"><p class="headerOrden">
                                                <b>Especialidad: </b> {{$tecnico->especialidad_t}}</p></td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="4"><p>No hay un técnico asignado</p></td>
                                    </tr>
                                @endif


                                </tbody>
                            </table>
                        </div>
                        <hr>

                        <h4>Lista de equipos</h4>
                        <div class="card-table table-responsive">
                            <table id="tablaOrden" class="table table-hover align-middle table-bordered">
                                <thead class="thead-light">
                                <tr>

                                    <th>N° Serie</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Tipo</th>
                                    <th>Accesorios</th>
                                    <th>Problema</th>
                                    <th width="100px">Ingreso</th>
                                    <th width="105px">Salida</th>

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
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{$registros->render()}}
                        </div>
                        <hr>
                        <h4>Observaciones</h4>
                        <div class="card-table">
                            <table id="tablaOrden" class="table table-hover align-middle table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th>Estado</th>
                                    <th>Problemática de la orden</th>
                                    <th>solución planteada</th>
                                </tr>
                                </thead>
                                <tr>
                                    @if ($orden->etapa_servicio_or==2)
                                        <td>
                                            <span class="btn-warning">Revisión</span>
                                        </td>
                                    @endif
                                    @if ($orden->etapa_servicio_or==3)
                                        <td>
                                            <span class="btn-success">Terminado</span>
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
                        <a href="{{route('orden-pdf',$orden->id)}}" class="primary-btn order-submit">Descargar orden</a>
                    </div>
                    <!-- /Order Details -->
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