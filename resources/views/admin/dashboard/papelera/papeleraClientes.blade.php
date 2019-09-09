@extends('admin.base.base_dashboard')
@section('title')
    Papelera - Clientes
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p class="text-priamry font-italic pull-right">Papelera /Clientes</p>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-header bg-dark bg-gradient">
                <p class="lead">
                    Clientes
                </p>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            {!! Form::open(['route' => 'papelera-admins', 'method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
                            <div class="input-group mb-3">
                                {{Form::select('parametroBuscar',array(
                                   'cedula_p' => 'Cédula de identificación',
                                   'email' => 'Email del administrador',
                                   ),$parametro,['id'=>'parametroBuscar'])}}
                                <input name="query" id="searchOrdenes" type="text" class="form-control"
                                       placeholder="Buscar cliente"
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
                                        <th>Modificado</th>
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
                                            <td>{{Carbon\Carbon::parse($user->updated_at)->format('Y-m-d')}}</td>
                                            <td class="text-right">
                                                <a data-id-user="{{$user->id}}" id="showModal"
                                                   class="btn  btn-primary btn-sm showModal">
                                                    <i class="batch-icon batch-icon-eye"></i>
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
                                                       class="deleteModal btn btn-success btn-sm id-user-estado">
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



@endsection


{{--Modal para ver los datos--}}
<div id="idModal" class="modal fade bd-example-modal-sizes" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header badge-primary bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLabel2">Vista de clientes inhabilitados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card-media-list">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="profile-picture-lg">
                                    <img class="pull-right" src="{{asset('img/user.png')}}" width="98" height="98">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="media-body">
                                    <div class="heading mt-1">
                                        <h3 id="nom-p"></h3>
                                        <br>

                                    </div>
                                    <div class="subtext"><p id="name-p"></p></div>

                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="col-lg-12 bg-dark">
                                    <h5 class="text-white py-5">Contactos</h5>
                                </div>
                                <div class="col-lg-12">
                                    <div class="media-body">
                                        <br>
                                        <div class="heading mt-1">
                                            Direccón domicilio
                                        </div>
                                        <div id="dir-p" class="subtext"></div>
                                        <hr>
                                    </div>
                                    <div class="media-body">
                                        <br>
                                        <div class="heading mt-1">
                                            Número de Teléfono
                                        </div>
                                        <div id="tel-p" class="subtext"></div>
                                        <hr>
                                    </div>
                                    <div class="media-body">
                                        <br>
                                        <div class="heading mt-1">
                                            Correo electrónico
                                        </div>
                                        <div id="email-p" class="subtext"></div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="col-lg-12 bg-dark">
                                    <h5 class="text-white py-5">Información del estado</h5>
                                </div>
                                <div class="col-lg-12">
                                    <div class="media-body">
                                        <br>
                                        <div class="heading mt-1">
                                            Cédula de identificación
                                        </div>
                                        <div id="cedula-p" class="subtext"></div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="media-body">
                                        <br>
                                        <div class="heading mt-1">
                                            Tipo de usuario
                                        </div>
                                        <div id="tipo-p" class="subtext"></div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="media-body">
                                        <br>
                                        <div class="heading mt-1">
                                            Estado del usuario
                                        </div>
                                        <div id="estado-p" class="subtext"></div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
            {{--

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            --}}
        </div>
    </div>
</div>

{{--  Modal para la eliminacion--}}
<div id="idModalEliminacion" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header badge-primary bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLabel">Habilitar</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="put" class="form-horizontal" role="modal">
                @csrf
                @method('put')
                <div class="modal-body">


                    <div class="row">

                        <div class="col-lg-5 mx-3">
                            <label class="form-group" for="id">Usuario</label>
                            <input hidden type="text" class="form-control" id="id-user-edit">
                            <p id="ci-usuario"></p>
                        </div>
                        <div class="col-lg-5">
                            <label class="form-group" for="name">Estado actual</label>
                            <a class="btn btn-success btn-sm" id="estado-actua-user"></a>
                            <input hidden type="name" class="form-control" id="estado-user-edit">
                        </div>


                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary actionBtn">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>

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
            var url = "estado-cliente";
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
                    //  $('#sectionRefresh').empty().append($(data));
                    // location.reload();
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