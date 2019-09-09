{{--Modal para ver los datos--}}
<div id="idModal" class="modal fade bd-example-modal-sizes" tabindex="-1" role="dialog"
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

                    <form method="put" role="modal">
                        @csrf
                        @method('put')
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-group font-bold" for="orden-solucion">Solución Técnica</label>
                                <textarea class="form-control" id="orden-solucion"
                                          placeholder="Escriba un contenido"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary btnGuardarSolucion">Guardar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

{{--  Modal para cambiar la fecha del equipo--}}
<div id="idModalFecha" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header badge-primary bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLabel">Fecha Salida del Equipo</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="form-horizontal" role="modal">
                @csrf
                {{ method_field('PUT') }}
                <div class="modal-body">

                    <div class="form-group">
                        <div class="form-control">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input hidden type="text" class="form-control" id="id-regis">
                            <label class="form-group" for="id">Fecha actual</label>
                            <input type="date" class="form-control" id="fecha-actual">
                        </div>
                        <div class="form-control">
                            <label class="form-group" for="name">Nueva fecha</label>
                            <input type="date" class="form-control" id="n-fecha-salida">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger cancelar-fecha" data-dismiss="modal">Cancelar</button>
                    <button disabled type="button" class="btn btn-primary btnFecha">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>



{{--  Modal para la camio fecha orden--}}
<div id="idModalFechaOrden" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header badge-primary bg-gradient">
                <h5 class="modal-title text-white cod-orden" id="exampleModalLabel">Orden - </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" class="form-horizontal" role="modal">
                @csrf
                {{ method_field('PUT') }}
                <div class="modal-body">

                    <div class="form-group">
                        <div class="form-control">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <input hidden type="text" class="form-control" id="id-ordentrajabo">
                            <label class="form-group" for="id">Fecha actual</label>
                            <p type="date" class="form-control" id="fecha-actual-orden"></p>
                        </div>
                        <div class="form-control">
                            <label class="form-group" for="name">Nueva fecha</label>
                            <input type="date" class="form-control" id="orden-fecha-modal">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger cancelar-fechaOrden" data-dismiss="modal">Cancelar</button>
                    <button disabled type="button" class="btn btn-primary btnFechaOrden">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>