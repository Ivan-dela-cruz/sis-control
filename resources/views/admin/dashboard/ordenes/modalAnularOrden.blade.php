<div id="idModalEliminacion" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header badge-primary bg-gradient">
                <h5 class="modal-title text-white" id="exampleModalLabelAnular">Anular Orden de Trabajo</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="put" class="form-horizontal" role="modal">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-10 mx-3">
                            <p class="sms-anular">¿Está seguro que desea anular la orden?</p>
                            <a href="#">orden - <span id="txt-id"></span></a>
                            <input hidden type="text" class="form-control" id="id-orden-status">
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

<div id="idModalEliminacionOrden" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header badge-danger">
                <h5 class="modal-title text-white" id="exampleModalLabel">Eliminar Orden de Trabajo</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="put" class="form-horizontal" role="modal">
                @csrf
                @method('put')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-10 mx-3">
                            <p class="text-danger">¿Está seguro que desea eliminar la orden?</p>
                            <a href="#">orden - <span id="txt-id-del"></span></a>
                            <input hidden type="text" class="form-control" id="id-orden-status-del">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger actionBtnEliminar">Eliminar</button>
                </div>
            </form>

        </div>
    </div>
</div>