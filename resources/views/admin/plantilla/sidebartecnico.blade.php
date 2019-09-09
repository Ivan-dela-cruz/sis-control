<nav id="sidebar" class="px-0 bg-dark bg-gradient sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="logo-nav-item">
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/img/logo-white.png')}}" width="145" height="32.3" alt="QuillPro">
            </a>
        </li>
        <li>
            <h6 class="nav-header">Técnico</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="index.html">
                <i class="batch-icon batch-icon-browser-alt"></i>
                Panel de control <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-layout-content-left"></i>
                Usuarios
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('usuario.create')}}">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('usuario.index')}}">Administradores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="layout-top-menu-fixed.html">Técnicos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="layout-top-menu-normal.html">Clientes</a>
                </li>
            </ul>
        </li>

    </ul>

    <ul class="nav nav-pills flex-column">
        <li>
            <h6 class="nav-header">Aplicaciones</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link nav-parent" href="#">
                <i class="batch-icon batch-icon-store"></i>
                Equipos
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="ecommerce-dashboard.html">Nuevo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ecommerce-product-page.html">Registros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ecommerce-category-page.html">Edición</a>
                </li>

            </ul>
        </li>

    </ul>

    <ul class="nav nav-pills flex-column">
        <li>
            <h6 class="nav-header">Oredenes</h6>
        </li>

        <li class="nav-item">
            <a class="nav-link nav-parent">
                <i class="batch-icon batch-icon-compose-alt-2"></i>
                Reportes
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="forms.html">Nueva</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="forms-extras.html">Ver ordenes</a>
                </li>
            </ul>
        </li>

    </ul>
</nav>