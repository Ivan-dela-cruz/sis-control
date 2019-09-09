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
                            <h3>Datos del cliente</h3>
                            <div class="row">

                                <div class="col-md-5 mx-5">
                                    <div class="form-group">
                                        <p><b>Nombre cliente: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp; <label class="nom_cli">S/N</label></p>
                                        <input hidden id="ordencliente" type="text">
                                    </div>
                                    <div class="form-group">
                                        <p><b>N° Cédula: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp; <label class="ci_cli"> 0000000000</label></p>
                                    </div>
                                </div>
                                <div class="col-md-5 mx-5">

                                    <div class="form-group">
                                        <p><b>Dirección cliente: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label class="dir_cli">
                                                Ciudad/Avenida/Calle</label>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <p><b>Télefono: </b>
                                            &nbsp;&nbsp;&nbsp;&nbsp;<label class="tlf_cli"> 00000</label></p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h3>Datos del Equipo</h3>
                            {!! Form::open(['route' => 'equipos.store', 'files' => true]) !!}
                            <input type="hidden" name="id_p" id="id_p" class="cliente-equipo">
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
                        $('.nom_cli').text(data.mensaje);
                        $('.ci_cli').text('');
                        $('.dir_cli').text('');
                        $('.tlf_cli').text('');
                    } else {
                        $('#ordencliente').val(data.id);
                        $('.nom_cli').text(data.nombres);
                        $('.ci_cli').text(data.cedula_p);
                        $('.dir_cli').text(data.direccion_p);
                        $('.tlf_cli').text(data.telefono_p);
                        $('#id_p').val(data.id)
                    }

                }
            })


        });
    </script>
@endsection