<nav id="sidebar" class="px-0 bg-dark bg-gradient sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="logo-nav-item">
            <a class="navbar-brand" href="#">
                <img src="{{asset('img/rrr.png')}}" width="145" height="145" alt="QuillPro">
            </a>
        </li>
        <li>
            <h6 class="nav-header">TÉCNICO SECUNDARIO</h6>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="index.html">
                <i class="batch-icon batch-icon-browser-alt"></i>
                Panel de control <span class="sr-only">(current)</span>
            </a>
        </li>

    </ul>

    <ul class="nav nav-pills flex-column">
        <li>
            <h6 class="nav-header text-info">Aplicaciones</h6>
        </li>

        <li class="nav-item">
            <a class="nav-link nav-parent">
                <i class="batch-icon batch-icon-clipboard-alt"></i>
                Ordenes de trabajo
            </a>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('crear-ordenes')}}">
                        <i class="fa fa-file"></i> Nueva orden
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('listar-ordenes-ingresos')}}">
                        <i class="fa fa-list-alt"></i> Ordenes
                    </a>
                </li>
            </ul>
        </li>


    </ul>
</nav>