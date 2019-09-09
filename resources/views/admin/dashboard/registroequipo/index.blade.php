@extends('admin.base.base_dashboard')
@section('title')
    Equipos
@endsection

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
                    Equipos
                    <a class="btn btn-primary btn-md pull-right" href="{{route('registro-equipos.create')}}">
                        <i class="batch-icon batch-icon-add"></i>
                        Agregar
                    </a>
                </p>

            </div>
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card-table table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>N°</th>
                                        <th>N° Serie</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Tipo</th>
                                        <th class="text-center">Estado</th>
                                        <th>Registrado</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{ csrf_field() }}
                                    @foreach($regis_equipos as $regis_equipo)
                                        <tr class="equipo{{$regis_equipo->id}}">
                                            <td>{{$regis_equipo->id}}</td>
                                            <td>{{$regis_equipo->serie_e}}</td>
                                            <td>{{$regis_equipo->marca_e}}</td>
                                            <td>{{$regis_equipo->modelo_t}}</td>
                                            <td>
                                                @if($regis_equipo->tipo_t==1)
                                                    Laptop
                                                @endif
                                                @if($regis_equipo->tipo_t==2)
                                                    CPU
                                                @endif
                                                @if($regis_equipo->tipo_t==3)
                                                    Monitor
                                                @endif
                                                @if($regis_equipo->tipo_t==4)
                                                    Tablet
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($regis_equipo->estado_e==1)
                                                    <span class="badge badge-success">activo</span>
                                                @else
                                                    <span class="badge badge-danger">inactivo</span>
                                                @endif

                                            </td>
                                            <td>{{$regis_equipo->created_at}}</td>
                                            <td class="text-right">
                                                <a data-id-user="{{$regis_equipo->id}}" id="showModal"
                                                   class="btn  btn-primary btn-sm showModal">
                                                    <i class="batch-icon batch-icon-eye"></i>
                                                </a>

                                                <a href="{{route('equipos.edit',$regis_equipo->id)}}"
                                                   data-id-user="{{$regis_equipo->id}}" class="btn  btn-warning btn-sm">
                                                    <i class="batch-icon batch-icon-quill"></i>
                                                </a>
                                                @if($regis_equipo->estado_e==0)
                                                    <a data-id-user="{{$regis_equipo->id}}"
                                                       data-estado-user="{{$regis_equipo->tipo_t}}"
                                                       data-estado-actual="inactivo"
                                                       class="deleteModal btn btn-deep-orange btn-sm">
                                                        <i class="batch-icon batch-icon-shuffle"></i>
                                                    </a>
                                                @else
                                                    <a data-id-user="{{$regis_equipo->id}}"
                                                       data-estado-user="{{$regis_equipo->tipo_t}}"
                                                       data-estado-actual="activo"
                                                       class="deleteModal btn btn-success btn-sm">
                                                        <i class="batch-icon batch-icon-shuffle"></i>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$regis_equipos->render()}}
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
                <h5 class="modal-title text-white" id="exampleModalLabel2">Vista de usuarios</h5>
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

                    //  $('#sectionRefresh').empty().append($(data));
                    location.reload();
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