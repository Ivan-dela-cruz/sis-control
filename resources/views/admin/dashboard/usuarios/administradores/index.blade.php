@extends('admin.base.base_dashboard')
@section('title')
    Administradores
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="font-italic text-lg-right">
                <a href="#">Administradores</a>/
            </p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    Administradores
                    <a class="btn btn-outline-white btn-sm pull-right" href="{{route('usuario.create')}}">
                        <i class="batch-icon batch-icon-add"></i> Agregar
                    </a>
                </p>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            {!! Form::open(['route' => 'usuario.index', 'method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
                            <div class="input-group mb-3">
                                {{Form::select('parametroBuscar',array(
                                   'cedula_p' => 'Cédula de identificación',
                                   'email' => 'Email del administrador',
                                   ),$parametro,['id'=>'parametroBuscar'])}}
                                <input name="query" id="searchOrdenes" type="text" class="form-control"
                                       placeholder="Buscar administrador"
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
                                        <th>Nombres</th>
                                        <th>Cédula</th>
                                        <th>Télefono</th>
                                        <th>Email</th>
                                        <th class="text-center">Estado</th>
                                        <th>Creado</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{ csrf_field() }}
                                    @foreach($users as $user)
                                        <tr class="usuario{{$user->id}}">
                                            <td>
                                                <div class="media">
                                                    <div class="profile-picture bg-gradient bg-primary has-message float-right d-flex mr-3">
                                                        <img src="assets/img/profile-pic.jpg" width="44" height="44">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="heading mt-1">
                                                            {{$user->nombre_p}}  {{$user->apellido_p}}
                                                        </div>
                                                        <div class="subtext">{{$user->name}}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#">{{$user->cedula_p}}</a>
                                            </td>
                                            <td>
                                                <a href="#">{{$user->telefono_p}}</a>
                                            </td>
                                            <td>
                                                <a href="#">{{$user->email}}</a>
                                            </td>
                                            <td class="text-center">
                                                @if($user->estado_p==1)
                                                    <span class="badge badge-success">activo</span>
                                                @else
                                                    <span class="badge badge-danger">inactivo</span>
                                                @endif

                                            </td>
                                            <td>{{Carbon\Carbon::parse($user->created_at)->format('Y-m-d')}}</td>
                                            <td class="text-right">
                                                <a data-id-user="{{$user->id}}" id="showModal"
                                                   class="btn  btn-primary btn-sm showModal">
                                                    <i class="batch-icon batch-icon-eye"></i>
                                                </a>

                                                <a href="{{route('usuario.edit',$user->id)}}"
                                                   data-id-user="{{$user->id}}" class="btn  btn-warning btn-sm">
                                                    <i class="batch-icon batch-icon-quill"></i>
                                                </a>
                                                @if($user->estado_p==0)
                                                    <a data-id-user="{{$user->id}}"
                                                       data-estado-user="{{$user->estado_p}}"
                                                       data-estado-actual="inactivo"
                                                       data-cedula-actual="{{$user->cedula_p}}"
                                                       class="deleteModal btn btn-deep-orange btn-sm">
                                                        <i class="batch-icon batch-icon-shuffle"></i>
                                                    </a>
                                                @else
                                                    <a data-id-user="{{$user->id}}"
                                                       data-estado-user="{{$user->estado_p}}"
                                                       data-estado-actual="activo"
                                                       data-cedula-actual="{{$user->cedula_p}}"
                                                       class="deleteModal btn btn-success btn-sm">
                                                        <i class="batch-icon batch-icon-shuffle"></i>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$users->render()}}
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('admin.dashboard.usuarios.administradores.modalsAdmin')
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
            // alert($('#id-user-edit').val());
            //alert($('#estado-user-edit').val());
            var id_user = $('#id-user-edit').val();
            var url = "estado-admin";
            $.ajax({
                type: "put",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,//"estado-admin/" + $(this).data('id-user') + "/",
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

    </script>
@endsection