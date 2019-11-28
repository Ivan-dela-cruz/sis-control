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
                                        <div id="dir-p" class="subtext text-uppercase"></div>
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
                                        <div id="tipo-p" class="subtext text-uppercase"></div>
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


            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

            </div>

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