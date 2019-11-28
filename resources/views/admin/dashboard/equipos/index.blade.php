@extends('admin.base.base_dashboard')
@section('title')
    Equipos
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic pull-right"><a href="{{route('equipos.index')}}">Equipos</a>/</p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    Equipos
                    <a class="btn btn-outline-white btn-sm pull-right" href="{{route('equipos.create')}}">
                        <i class="batch-icon batch-icon-add"></i> Agregar
                    </a>
                </p>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            {!! Form::open(['route' => 'equipos.index', 'method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
                            <div class="input-group mb-3">
                                {{Form::select('parametroBuscar',array(
                                   'cedula_p' => 'Cédula de cliente',
                                   'serie_e' => 'Serie equipo',
                                   ),$parametro,['id'=>'parametroBuscar'])}}
                                <input name="query" id="searchOrdenes" type="text" class="form-control"
                                       placeholder="Buscar Equipo"
                                       aria-label="Buscar orden"
                                       aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btnSearchOrden btn btn-primary" type="submit">Buscar</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-lg-12">
                            <div class="card-table table-responsive">

                                <table class="table table-hover table-striped align-middle tabla-equipos">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>N°</th>
                                        <th>Serie</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Tipo</th>
                                        <th class="text-center">Estado</th>
                                        <th class="text-center">Descripción</th>
                                        <th>Cliente</th>
                                        <th>Actualizado</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{ csrf_field() }}
                                    @foreach($equipos as $equipo)
                                        <tr class="equipo{{$equipo->id}}">
                                            <td class="id_e">{{$equipo->id}}</td>
                                            <td class="serie_e">{{$equipo->serie_e}}</td>
                                            <td class="marca_e text-uppercase">{{$equipo->marca_e}}</td>
                                            <td>{{$equipo->modelo_t}}</td>
                                            <td>
                                                @if($equipo->tipo_t==1)
                                                    Laptop
                                                @endif
                                                @if($equipo->tipo_t==2)
                                                    CPU
                                                @endif
                                                @if($equipo->tipo_t==3)
                                                    Monitor
                                                @endif
                                                @if($equipo->tipo_t==4)
                                                    Tablet
                                                @endif
                                                @if($equipo->tipo_t==5)
                                                    Impresoras
                                                @endif
                                                @if($equipo->tipo_t==6)
                                                    Otros
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($equipo->estado_e==1)
                                                    <span class="badge badge-success">activo</span>
                                                @else
                                                    <span class="badge badge-danger">inactivo</span>
                                                @endif

                                            </td>
                                            <td class="text-uppercase">{{$equipo->descripcion_e}}</td>
                                            <td>{{$equipo->user->cedula_p}}</td>
                                            <td>{{\Carbon\Carbon::parse($equipo->updated_at)->format('Y-m-d')}}</td>
                                            <td class="text-center">
                                                <a href="{{route('equipos.edit',$equipo->id)}}"
                                                   data-id-user="{{$equipo->id}}" class="btn  btn-primary btn-sm">
                                                    <i class="batch-icon batch-icon-quill"></i>
                                                </a>
                                                @if($equipo->estado_e==0)
                                                    <a data-id-equipo="{{$equipo->id}}"
                                                       data-serie-equipo="{{$equipo->serie_e}}"
                                                       data-estado-equipo="{{$equipo->tipo_t}}"
                                                       data-estado-actual="inactivo"
                                                       class="deleteModal btn btn-deep-orange btn-sm">
                                                        <i class="batch-icon batch-icon-shuffle"></i>
                                                    </a>
                                                @else
                                                    <a data-id-equipo="{{$equipo->id}}"
                                                       data-serie-equipo="{{$equipo->serie_e}}"
                                                       data-estado-equipo="{{$equipo->tipo_t}}"
                                                       data-estado-actual="activo"
                                                       class="deleteModal btn btn-deep-orange btn-sm">
                                                        <i class="batch-icon batch-icon-shuffle"></i>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$equipos->render()}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('admin.dashboard.equipos.modalEquipos')
@endsection

@section('script')
    <script>

        $('.impri').click(function () {

            let materiales = [];

            document.querySelectorAll('.tabla-equipos tbody tr').forEach(function (e) {
                let fila = {
                    id: e.querySelector('.id_e').innerText,
                    serie: e.querySelector('.serie_e').innerText,
                    marca: e.querySelector('.marca_e').innerText

                };
                materiales.push(fila);
            });

            console.log(materiales);
        });

        $('.showModal').click(function () {
            $('#idModal').modal('show');
            $.ajax({
                url: "ver-admin/{id}",
                method: "GET",
                data: {id: $(this).data('id-user')},
                success: function (response) {
                    $('#id-p').text(response.id);
                    $('#cedula-p').text(response.cedula_p);
                    $('#nom-p').text(response.nombres);
                    $('#tel-p').text(response.telefono_p);
                    $('#dir-p').text(response.direccion_p);
                    $('#tipo-p').text(response.tipo_p);
                    $('#estado-p').text(response.estado_p);
                    $('#name-p').text(response.name);
                    $('#email-p').text(response.email);

                }

            });

        });
        $('.deleteModal').click(function () {
            var estado = $(this).data('estado-equipo');
            if (estado == 0) {
                $('.modal-title').text('Habilitar Equipo');
            } else {
                $('.modal-title').text('Inhabilitar equipo');
            }
            var status = $(this).data('estado-actual');
            if (status != 'activo') {
                $('#estado-actua-equipo').removeClass('btn-success');
                $('#estado-actua-equipo').addClass('btn-deep-orange');
            } else {
                $('#estado-actua-equipo').removeClass('btn-deep-orange');
                $('#estado-actua-equipo').addClass('btn-success');
            }
            $('#idModalEliminacion').modal('show');
            $('#id-equipo-edit').val($(this).data('id-equipo'));
            $('#estado-equipo-edit').val($(this).data('estado-equipo'));
            $('#estado-actua-equipo').text($(this).data('estado-actual'));
            $('#serie-equipo').text($(this).data('serie-equipo'));
        });

        $('.actionBtn').click(function () {
            // alert($('#id-user-edit').val());
            //alert($('#estado-user-edit').val());
            var id_equipo = $('#id-equipo-edit').val();
            var url = "{{route('estado-equipo')}}";
            $.ajax({
                type: "put",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,//"estado-admin/" + $(this).data('id-user') + "/",
                data: {
                    id: id_equipo,
                    _token: "{{csrf_token()}}",
                    _method: "PUT",
                },
                success: function (data) {
                    $('.equipo' + data.id).remove();
                    $('#idModalEliminacion').modal('hide');
                    $('#id-equipo-edit').val('');
                    $('#estado-equipo-edit').val('');
                    $('#estado-actua-equipo').text('');
                    $('#serie_equipo').text('');
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    if (errors) {
                        $.each(errors, function (i) {
                            console.log(errors[i]);
                        });
                    }
                }
            });
        });
    </script>
@endsection