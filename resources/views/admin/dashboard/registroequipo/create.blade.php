@extends('admin.base.base_dashboard')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Gestión de equipos</h1>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    Registro de equipo
                </p>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">

                            {!! Form::open(['route' => 'registro-equipos.store', 'files' => true]) !!}

                            @include('admin.dashboard.registroequipo.partials.form')

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection