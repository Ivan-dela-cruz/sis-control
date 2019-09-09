{{--Modal para ver los datos--}}
<div id="idModalAsig" class="modal fade bd-example-modal-sizes" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header badge-primary bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLabel2">Asignar orden</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-media-list">
                    <div class="col-lg-7">
                        <div class="input-group mb-3">
                            <input name="query" id="searchTecnico" type="text" class="form-control"
                                   placeholder="Buscar técnico"
                                   aria-label="Buscar orden"
                                   aria-describedby="basic-addon2">
                        </div>

                    </div>
                    <div class="col-lg-12">
                        <div class="card-table table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="thead-light">
                                <tr>
                                    <th>Cédula</th>
                                    <th>Nombres</th>
                                    <th>Profesión</th>
                                    <th>Especialidad</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                                </thead>
                                <tbody class="table-tecnicos">
                                {{ csrf_field() }}
                                @foreach( $tecnicos as $row)
                                    <tr class="list-tecnico{{$row->id}}">
                                        <td>{{$row->cedula_p}} </td>
                                        <td> {{$row->nombre_p}}  {{$row->apellido_p}}</td>
                                        <td>{{$row->especialidad_t}} </td>
                                        <td>{{$row->profesion_t}}</td>
                                        <td>
                                            <form method="put" class="form-horizontal" role="modal">
                                                @csrf
                                                @method('put')
                                                <button type="button"
                                                        data-nombres-tec="{{$row->nombre_p}}  {{$row->apellido_p}}"
                                                        data-id-orden="{{$orden->id}}"
                                                        data-id-tecnico="{{$row->id}}"
                                                        class="btn btn-sm btn-primary boton-asig">
                                                    asignar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <hr>

                        </div>
                    </div>

                </div>

            </div>
            {{--


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