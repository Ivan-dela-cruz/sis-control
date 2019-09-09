<template>
    <main>
        <div class="row">
            <div class="col-md-12">
                <h1>Getión de equips</h1>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-12">

                <div class="card-header bg-dark bg-gradient">
                    <p class="lead">
                        Equipos
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
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th class="text-center">Estado</th>
                                            <th>Creado</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                        </thead>
                                        <tbody>


                                        <tr class="usuario">

                                            <td>
                                                <div class="media">
                                                    <div class="profile-picture bg-gradient bg-primary has-message float-right d-flex mr-3">
                                                        <img src="assets/img/profile-pic.jpg" width="44" height="44">
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="heading mt-1">

                                                        </div>
                                                        <div class="subtext"></div>

                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"></a>
                                            </td>
                                            <td class="text-center">

                                                <span class="badge badge-success">activo</span>


                                            </td>
                                            <td></td>
                                            <td class="text-right">
                                                <a data-id-user="" id="showModal"
                                                   class="btn  btn-primary btn-sm showModal">
                                                    <i class="batch-icon batch-icon-eye"></i>
                                                </a>

                                                <a data-id-user="" class="btn  btn-warning btn-sm">
                                                    <i class="batch-icon batch-icon-quill"></i>
                                                </a>

                                                <a data-id-user=""
                                                   data-estado-user=""
                                                   data-estado-actual="inactivo"
                                                   data-cedula-actual=""
                                                   class="deleteModal btn btn-deep-orange btn-sm">
                                                    <i class="batch-icon batch-icon-shuffle"></i>
                                                </a>


                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div id="idModal" class="modal fade bd-example-modal-sizes" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header badge-primary bg-gradient">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Vista de usuarios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="card-media-list">
                            <div class="col-lg-12">


                                <form method="post" action="" id="registration-form">

                                    <div class="row pb-5">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cedula_p" class="active">Cédula</label>
                                                <input type="text" class="form-control" id="cedula_p" name="cedula_p"
                                                       data-validation="numeric"
                                                       data-validation-length="9-10"
                                                       data-validation-error-msg="El número debe tener(10 dígitos)"
                                                       placeholder="Ingrese su numero de cédula"
                                                       value=""
                                                >


                                            </div>
                                            <div class="form-group">
                                                <label for="nombre_p" class="active">Nombres</label>
                                                <input type="text" class="form-control" id="nombre_p" name="nombre_p"
                                                       data-validation="alphabet" placeholder="Ingrese sus nombres"
                                                       value="">

                                            </div>
                                            <div class="form-group">
                                                <label for="apellido_p" class="active">Apellidos</label>
                                                <input type="text" class="form-control" id="apellido_p"
                                                       name="apellido_p"
                                                       data-validation="alphabet" placeholder="Ingrese sus apellidos"
                                                       value="">

                                            </div>
                                            <div class="form-group">
                                                <label for="telefono_p" class="active">Teléfono</label>
                                                <input type="text" class="form-control" id="telefono_p"
                                                       name="telefono_p"
                                                       data-validation="numeric"
                                                       placeholder="Ingrese su numero de teléfono"
                                                       value="">

                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="direccion_p" class="active">Dirección</label>
                                                <input type="text" class="form-control" name="direccion_p"
                                                       id="direccion_p"
                                                       data-validation="alphanumeric"
                                                       placeholder="Ingrese su dirección" value="">

                                            </div>
                                            <div class="form-group">
                                                <label for="direccion_p" class="active">Tipo de usuario</label>
                                                <select class="form-control" name="tipo_p" id="tipo_p">
                                                    <option value="1">Cliente</option>
                                                    <option value="0">Administrador</option>
                                                    <option value="2">Técnico</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="active">Nombre de usuario(3-12
                                                    carácteres)</label>
                                                <input type="text" class="form-control" name="name" id="name"
                                                       data-validation="length alphanumeric"
                                                       data-validation-length="3-12"
                                                       data-validation-error-msg="Username has to be an alphanumeric value (3-12 chars)"
                                                       placeholder="Ingrese el nombre de usuario" value="">

                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="active">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                       data-validation="email" placeholder="Enter Email"
                                                       value=""
                                                >

                                            </div>


                                        </div>
                                        <div class="col-md-12">
                                            <button id="validate" type="submit" class="btn btn-primary pull-right">
                                                Registrar
                                            </button>
                                        </div>

                                    </div>

                                </form>


                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </main>
</template>

<script>
    export default {
        name: "equipos"
    }
</script>

<style scoped>

</style>