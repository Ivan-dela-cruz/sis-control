@extends('admin.base.base_dashboard')
@section('title')
    Pagina sin datos
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="pull-right font-italic"><a href="{{route('listar-ordenes-asignadas')}}">Ordenes</a>/asignadas
                - sin datos </p>
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

                            <h1> No hay registros para mostrar</h1>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

