@extends('admin.base.base_dashboard')
@section('title')
    Equipo- Nuevo
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <p class="font-italic pull-right"><a href="{{route('equipos.index')}}">Equipos</a>/Nuevo equipo </p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-5">
                            <!-- USE THIS CODE Instead of the Commented Code Above -->
                            <div class="input-group mb-3">

                                <input id="searchCliente" type="text" class="form-control" placeholder="Buscar cliente"
                                       aria-label="Buscar cliente"
                                       aria-describedby="basic-addon2">

                                <div class="input-group-append">
                                    <button class="searchInput btn btn-primary" type="button">Buscar</button>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-7">
                            <a href="{{route('clientes.create')}}" class="btn btn-outline-white pull-right">Añadir
                                cliente</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! Form::open(['route' => 'equipos.store', 'files' => true]) !!}
                            <h3>Datos del cliente</h3>
                            <div class="row">

                                <div class="col-md-5 mx-5">
                                    <div class="form-group">
                                        <p><b>Nombre cliente: </b>
                                            &nbsp;&nbsp;&nbsp;
                                            <input readonly="readonly" name="nom_cli" value="{{ old('nom_cli') }}"
                                                   id="nom_cli" type="text" class="nom_cli">
                                        </p>
                                        <input hidden id="ordencliente" type="text">
                                    </div>
                                    <div class="form-group">
                                        <p><b>N° Cédula: </b>

                                            <input readonly="readonly" name="ci_cli" value="{{ old('ci_cli') }}"
                                                   id="ci_cli" type="text" class="ci_cli">
                                        </p>
                                    </div>
                                    @if($errors->has('id_p'))
                                        <p style="font-size: 15px;" class="text-danger">{{$errors->first('id_p')}} </p>
                                    @endif
                                </div>
                                <div class="col-md-5 mx-5">

                                    <div class="form-group">
                                        <p><b>Dirección cliente: </b>
                                            &nbsp;
                                            <input readonly="readonly" name="dir_cli" value="{{ old('dir_cli') }}"
                                                   id="dir_cli" type="text" class="dir_cli">
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <p><b>Télefono: </b>
                                            &nbsp;&nbsp;&nbsp;
                                            <input readonly="readonly" name="tlf_cli" value="{{ old('tlf_cli') }}"
                                                   id="tlf_cli" type="text" class="tlf_cli">
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h3>Datos del Equipo</h3>

                            <input type="hidden" name="id_p" id="id_p" class="cliente-equipo" value="{{ old('id_p') }}">

                            @include('admin.dashboard.equipos.partials.form')

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function () {
            // alert('hola');
        });
        $('.searchInput').click(function () {
            // alert('hola');
            var query = $('#searchCliente').val();
            $.ajax({
                url: "{{route('busqueda-cliente-equipo')}}",
                method: 'GET',
                data: {
                    query: query
                },
                success: function (data) {
                    if (data.mensaje == 'Datos no encontrados') {
                        $('.nom_cli').val(data.mensaje);
                        $('.ci_cli').val('');
                        $('.dir_cli').val('');
                        $('.tlf_cli').val('');
                    } else {
                        $('#ordencliente').val(data.id);
                        $('.nom_cli').val(data.nombres);
                        $('.ci_cli').val(data.cedula_p);
                        $('.dir_cli').val(data.direccion_p);
                        $('.tlf_cli').val(data.telefono_p);
                        $('#id_p').val(data.id)
                    }

                }
            })


        });
    </script>
@endsection