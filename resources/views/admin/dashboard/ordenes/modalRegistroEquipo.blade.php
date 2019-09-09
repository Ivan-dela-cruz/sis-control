{{--Modal para ver los datos--}}
<div id="idModal" class="modal fade bd-example-modal-sizes" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header badge-primary bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLabel2">Registro de equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-media-list">
                    <div class="col-lg-12">

                        <div class="lead">
                            <div class="col-lg-12">
                                <!-- USE THIS CODE Instead of the Commented Code Above -->
                                <div class="input-group mb-3">
                                    <input id="searchEquipo" type="text" class="form-control"
                                           placeholder="Número de serie del equipo"
                                           aria-label="Buscar equipo"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btnsearchEquipo btn btn-primary" type="button">Buscar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                        </div>
                        <form method="post" class="form-horizontal" role="modal">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="lead">
                                        <div class="col-lg-12">
                                            <h3 for="">Datos del equipo</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="divResgitroEquipo media-body">
                                            <div class="form-group">
                                                <label for="serie_equipo">Número de serie</label>
                                                <input name="serie_equipo" id="serie_equipo" class="form-control"
                                                       type="text">

                                            </div>
                                            <div class="form-group">
                                                <label for="marca_e">Marca</label>
                                                <input name="marca_e" id="marca_e" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="modelo_e">Modelo</label>
                                                <input name="modelo_e" id="modelo_e" class="form-control" type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion_e">Tipo</label>
                                                <select class="form-control" name="tipo_t" id="tipo_t">
                                                    <option value="1">Laptop</option>
                                                    <option value="2">CPU</option>
                                                    <option value="3">Monitor</option>
                                                    <option value="4">Tablet</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion_e">Descripción</label>
                                                <textarea name="descripcion_e" id="descripcion_e" class="form-control">
                                                </textarea>
                                            </div>


                                            <hr>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="lead">
                                        <div class="col-lg-12">
                                            <h3>Datos del registro</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="media-body">
                                            <div class="form-group">
                                                <label for="problema_re">Diagnóstico General</label>
                                                <textarea class="form-control" name="problema_re" id="problema_re">

                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="accesorios_re">Accesorios</label>
                                                <textarea class="form-control" name="accesorios_re" id="accesorios_re">

                                                </textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="fecha_salida_re">Fecha de salida</label>
                                                <input id="fecha_salida_re" name="fecha_salida_re" class="form-control"
                                                       type="date">
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="btncerrarModal" type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cerrar
                                </button>
                                <button id="btnGuardarModal" type="button" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>

                    </div>

                </div>

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
