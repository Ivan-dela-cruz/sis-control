<nav id="sidebar" class="px-0 bg-dark bg-gradient sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="logo-nav-item">
            <a class="navbar-brand" href="#">
                <img src="{{asset('img/logoaj.png')}}" width="120" height="120" alt="QuillPro">
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="{{route('administrador')}}">
                <i class="batch-icon batch-icon-browser-alt"></i>
                Panel de control <span class="sr-only">(current)</span>
            </a>
        </li>

    </ul>

    <ul class="nav nav-pills flex-column">
        <li>
            <h6 class="nav-header text-priamry font-weight-bold">Aplicaciones</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-user"></i>
                Administradores
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('usuario.create')}}">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('usuario.index')}}">Administradores</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-user-card"></i>
                Clientes
            </a>
            <ul class="nav nav-pills flex-column">

                <li class="nav-item">
                    <a class="nav-link" href="{{route('clientes.create')}}">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('clientes.index')}}">Registros</a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-settings"></i>
                Técnicos
            </a>
            <ul class="nav nav-pills flex-column">

                <li class="nav-item">
                    <a class="nav-link" href="{{route('tecnicos.create')}}">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('tecnicos.index')}}">Registros</a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-print"></i>
                Equipos
            </a>
            <ul class="nav nav-pills flex-column">

                <li class="nav-item">
                    <a class="nav-link" href="{{route('equipos.create')}}">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('equipos.index')}}">Listado de Equipos</a>
                </li>

            </ul>
        </li>

    </ul>
    <ul class="nav nav-pills flex-column">
        <li>
            <h6 class="nav-header text-priamry font-weight-bold">Oredenes</h6>
        </li>

        <li class="nav-item">
            <a class="nav-link nav-parent">
                <i class="batch-icon batch-icon-clipboard-alt"></i>
                Ordenes de trabajo
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('ordenes.index')}}">
                        <i class="fa fa-file"></i> Nueva orden
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('listar-ordenes')}}">
                        <i class="fa fa-list-alt"></i> Ordenes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('listar-ordenes-asignadas-admin')}}">
                        <i class="fa fa-check"></i> Ordenes asignadas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('listar-ordenes-finalizadas-admin')}}">
                        <i class="fa fa-print"></i> Ordenes finalizadas
                    </a>
                </li>
            </ul>
        </li>

    </ul>

    <ul class="nav nav-pills flex-column">
        <li>
            <h6 class="nav-header text-warning font-weight-bold">Papelera</h6>
        </li>

        <li  class="nav-item">
            <a class="nav-link nav-parent text-warning">
                <i class="batch-icon batch-icon-bin-alt"></i>
                Anulados
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('listar-ordenes-anuladas')}}">Ordenes anuladas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('papelera-admins')}}">Administradores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('papelera-tecnicos')}}">Técnicos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('papelera-clientes')}}">Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('papelera-equipos')}}">Equipos</a>
                </li>

            </ul>
        </li>

    </ul>
</nav>