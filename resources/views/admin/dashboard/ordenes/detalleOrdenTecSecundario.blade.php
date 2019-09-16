@extends('admin.base.base_tecnicoSecundario')
@section('title')
    orden {{$orden->codigo_or}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic pull-right"><a href="{{route('listar-ordenes-ingresos')}}">Ordenes</a>/Detalle orden
                - {{$orden->codigo_or}} </p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <div class="lead">
                    <div class="col-lg-5">
                        <!-- USE THIS CODE Instead of the Commented Code Above -->
                        <div class="mb-3">
                            <div class="input-group-append">
                                <a href="{{route('listar-ordenes-ingresos')}}" class="btn btn-outline-white">
                                    <i class="batch-icon batch-icon-out"></i>
                                    Atras
                                </a>
                                <a href="{{route('crear-ordenes')}}" class="btn btn-outline-white mx-3">
                                    <i class="batch-icon batch-icon-clipboard-alt"></i>
                                    Nueva
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
                                    <h3>Datos del cliente</h3>
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
                                    <h3>Datos de la orden</h3>
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

                                        <td>{{$orden->observacion_problema_or}}</td>

                                    </tr>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="divGenerarOrden pull-right">

                                <a href="{{route('orden-pdf-ingreso',$orden->id)}}"
                                   class="btn btn-success   btn-md  btnGenerarOrden">
                                    <i class="batch-icon batch-icon-print"></i>
                                    Imprimir
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>

    </script>
@endsection