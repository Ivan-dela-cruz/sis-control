<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand d-block d-sm-block d-md-block d-lg-none" href="#">
        <img src="{{asset('img/rrr.png')}}" width="50" height="32.3" alt="QuillPro">
    </a>
    <button class="hamburger hamburger--slider" type="button" data-target=".sidebar" aria-controls="sidebar"
            aria-expanded="false" aria-label="Toggle Sidebar">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
    </button>
    <!-- Added Mobile-Only Menu -->
    <ul class="navbar-nav ml-auto mobile-only-control d-block d-sm-block d-md-block d-lg-none">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbar-dropdown-navbar-profile"
               data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                <div class="profile-name">
                    {{Auth::user()->name}}
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-right"
                aria-labelledby="navbar-dropdown-navbar-profile">

                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-lock"></i>Cerrar sesión
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>

                {{---
                <li class="media">
                    <a class="dropdown-item" href="#">
                        <i class="fa fa-user"></i>
                        Mi perfil
                    </a>
                </li>
                ---}}
            </ul>
        </li>
    </ul>

    <!--  DEPRECATED CODE:
        <div class="navbar-collapse" id="navbarSupportedContent">
    -->
    <!-- USE THIS CODE Instead of the Commented Code Above -->
    <!-- .collapse added to the element -->
    <div class="collapse navbar-collapse" id="navbar-header-content">
        <ul class="navbar-nav navbar-language-translation mr-auto">
            <li class="nav-item dropdown">

            </li>
        </ul>
        <ul class="navbar-nav navbar-notifications float-right">
            <li class="nav-item dropdown">

            </li>

            <li class="nav-item dropdown">

            </li>
        </ul>
        <ul class="navbar-nav ml-5 navbar-profile">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbar-dropdown-navbar-profile"
                   data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                    <div class="profile-name">
                        {{Auth::user()->name}}
                    </div>
                    <div class="profile-picture bg-gradient bg-primary has-message float-right">
                        <img src="{{asset('img/user.png')}}" width="44" height="44">
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-right"
                    aria-labelledby="navbar-dropdown-navbar-profile">

                    <li class="media">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-lock"></i>Cerrar sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    {{-----
                    <li class="media">
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-user"></i>
                            Mi perfil
                        </a>
                    </li>
                    ---}}
                </ul>
            </li>
        </ul>
    </div>
</nav>