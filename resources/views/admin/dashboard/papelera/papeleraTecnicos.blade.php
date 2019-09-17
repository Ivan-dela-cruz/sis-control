@extends('admin.base.base_dashboard')
@section('title')
    Paplera - Técnicos
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{route('tecnicos.index')}}" class="font-italic pull-right">Papelera/Técnicos/</a>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    Técnicos Inhabilitados
                </p>


            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-7">
                            {!! Form::open(['route' => 'tecnicos.index', 'method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
                            <div class="input-group mb-3">
                                {{Form::select('parametroBuscar',array(
                                   'cedula_p' => 'Cédula de identificación',
                                   'email' => 'Email del técnico',
                                   ),$parametro,['id'=>'parametroBuscar'])}}
                                <input name="query" id="searchOrdenes" type="text" class="form-control"
                                       placeholder="Buscar Técnico"
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
                                <table class="table table-hover align-middle">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cargo</th>
                                        <th>Especialidad</th>
                                        <th>Email</th>
                                        <th class="text-center">Estado</th>
                                        <th>Creado</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{ csrf_field() }}
                                    @foreach($tecnicos as $tecnico)
                                        <tr class="usuario{{$tecnico->id}}">

                                            <td>
                                                <div class="media">
                                                    <div class="profile-picture bg-gradient bg-primary has-message float-right d-flex mr-3">
                                                        <img src="assets/img/profile-pic.jpg" width="44" height="44">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="heading mt-1">
                                                            {{$tecnico->nombre_p}}  {{$tecnico->apellido_p}}
                                                        </div>
                                                        <div class="subtext">{{$tecnico->profesion_t}}</div>


                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($tecnico->tipo_t==0)
                                                    <p class="text-uppercase text-priamry">Tecnico principal</p>
                                                @else
                                                    <p class="text-uppercase text-secondary">Tecnico secundario</p>
                                                @endif


                                            </td>
                                            <td>
                                                <p>{{$tecnico->especialidad_t}}</p>
                                            </td>
                                            <td>
                                                <a href="#">{{$tecnico->email}}</a>
                                            </td>
                                            <td class="text-center">
                                                @if($tecnico->estado_p==1)
                                                    <span class="badge badge-success">activo</span>
                                                @else
                                                    <span class="badge badge-danger">inactivo</span>
                                                @endif

                                            </td>
                                            <td>{{\Carbon\Carbon::parse($tecnico->created_at)->format('Y-m-d')}}</td>
                                            <td class="text-right">
                                                <a data-id-user="{{$tecnico->id}}" id="showModal"
                                                   class="btn  btn-primary btn-sm showModal">
                                                    <i class="batch-icon batch-icon-eye"></i>
                                                </a>

                                                @if($tecnico->estado_p==0)
                                                    <a data-id-user="{{$tecnico->id}}"
                                                       data-estado-user="{{$tecnico->estado_p}}"
                                                       data-estado-actual="inactivo"
                                                       data-cedula-actual="{{$tecnico->cedula_p}}"
                                                       class="deleteModal btn btn-success btn-sm">
                                                        <i class="batch-icon batch-icon-shuffle"></i>
                                                    </a>
                                                @else
                                                    <a data-id-user="{{$tecnico->id}}"
                                                       data-estado-user="{{$tecnico->estado_p}}"
                                                       data-estado-actual="activo"
                                                       data-cedula-actual="{{$tecnico->cedula_p}}"
                                                       class="deleteModal btn btn-deep-orange btn-sm">
                                                        <i class="batch-icon batch-icon-shuffle"></i>
                                                    </a>
                                                @endif
                                                <a data-id-regis="{{$tecnico->id}}"
                                                   data-cod-regis="{{$tecnico->cedula_p}}"
                                                   class="btn  btn-danger btn-sm eliminarRegistro">
                                                    <i class="batch-icon batch-icon-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$tecnicos->render()}}
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('admin.dashboard.usuarios.tecnico.modals.modalVistaTecnico')
    @include('admin.dashboard.papelera.modalEliminacion')
@endsection



@section('script')
    <script>

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
            var estado = $(this).data('estado-user');
            if (estado == 0) {
                $('.modal-title').text('Habilitar usuario');
            } else {
                $('.modal-title').text('Inhabilitar usuario');
            }
            var status = $(this).data('estado-actual');
            if (status != 'activo') {
                $('#estado-actua-user').removeClass('btn-success');
                $('#estado-actua-user').addClass('btn-deep-orange');
            } else {
                $('#estado-actua-user').removeClass('btn-deep-orange');
                $('#estado-actua-user').addClass('btn-success');
            }
            $('#idModalEliminacion').modal('show');
            $('#id-user-edit').val($(this).data('id-user'));
            $('#estado-user-edit').val($(this).data('estado-user'));
            $('#estado-actua-user').text($(this).data('estado-actual'));
            $('#ci-usuario').text($(this).data('cedula-actual'));
        });

        $('.actionBtn').click(function () {

            var id_user = $('#id-user-edit').val();
            var url = "estado-tecnico";
            $.ajax({
                type: "put",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                data: {
                    id: id_user,
                    _token: "{{csrf_token()}}",
                    _method: "PUT",
                },
                success: function (data) {
                    //  $('.usuarios' + data.id).replaceWith(" ");
                    $('.usuario' + id_user).remove();
                    $('#idModalEliminacion').modal('hide');
                    $('#id-user-edit').val('');
                    $('#estado-user-edit').val('');
                    $('#estado-actua-user').text('');
                    $('#ci-usuario').text('');

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
        $('.eliminarRegistro').click(function () {
            var id_or = $(this).data('id-regis');
            $('#idModalEliminacionRegistro').modal('show');
            $('#id-orden-status-del').val(id_or);
            $('#txt-id-del').text($(this).data('cod-regis'));
        });
        $('.actionBtnEliminar').click(function () {
            var id_or = $('#id-orden-status-del').val();
            var url = "{{route('eliminar-user')}}";
            $.ajax({
                type: "delete",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,//"estado-admin/" + $(this).data('id-user') + "/",
                data: {
                    id: id_or,
                    _token: "{{csrf_token()}}",
                    _method: "delete",
                },
                success: function (data) {
                    $('.usuario' + id_or).remove();
                    $('#idModalEliminacionRegistro').modal('hide');
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