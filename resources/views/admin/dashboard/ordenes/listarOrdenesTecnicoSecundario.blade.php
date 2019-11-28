@extends('admin.base.base_tecnicoSecundario')
@section('title')
    Ordenes de trabajo
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic pull-right"><a href="">Ordenes </a>/</p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    Ordenes de trabajo
                    <a class="btn btn-outline-white btn-sm pull-right" href="{{route('crear-ordenes')}}">
                        <i class="batch-icon batch-icon-add"></i>
                        Agregar
                    </a>
                </p>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            {!! Form::open(['route' => 'listar-ordenes-ingresos', 'method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
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
                                        <tr class="equipo{{$orden->id}}">

                                            <td>
                                                <a href="">orden - {{$orden->codigo_or}}</a>
                                            </td>
                                            <td class="text-uppercase">{{$orden->nombre_p}}  {{$orden->apellido_p}}</td>
                                            <td class="text-uppercase">{{$orden->observacion_problema_or}}</td>
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
                                                <a href="{{route('orden-pdf-ingreso',$orden->id)}}"
                                                   class="btn  btn-orange btn-sm imprimirOrden"
                                                   data-id-orden="{{$orden->id}}">
                                                    <i class="batch-icon batch-icon-print"></i>
                                                </a>
                                                <a href="{{route('ver-orden',$orden->id)}}"
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
@endsection
@section('script')
    <script>

    </script>
@endsection