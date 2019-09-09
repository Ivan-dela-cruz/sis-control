@extends('admin.base.base_dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <p class="font-italic pull-right"><a href="{{route('tecnicos.index')}}">Técnicos</a>/Editar técnico - {{$tecnico->user->cedula_p}} </p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    <a href="{{url()->previous()}}" class="btn btn-outline-white btn-sm pull-right">
                        <i class="batch-icon batch-icon-out"></i> Atras
                    </a>
                    Editar Técnico - {{$tecnico->user->cedula_p}}

                </p>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::model($tecnico, ['route' => ['tecnicos.update', $tecnico->user->id], 'method' => 'PUT', 'files' => true]) !!}

                            @include('admin.dashboard.usuarios.tecnico.partials.formEdit')

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection