<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand d-block d-sm-block d-md-block d-lg-none" href="#">
        <img src="assets/img/logo-dark.png" width="145" height="32.3" alt="QuillPro">
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
            <a class="nav-link dropdown-toggle" id="navbar-notification-search-mobile"
               data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                <i class="batch-icon batch-icon-search"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-fullscreen"
                aria-labelledby="navbar-notification-search-mobile">
                <li>
                    <form class="form-inline my-2 my-lg-0 no-waves-effect">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for..."
                                   aria-label="Search for..." aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-gradient waves-effect waves-light"
                                        type="button">
                                    <i class="batch-icon batch-icon-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </li>
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
                <a class="nav-link dropdown-toggle" id="navbar-notification-search" data-toggle="dropdown"
                   data-flip="false" aria-haspopup="true" aria-expanded="false">
                    <i class="batch-icon batch-icon-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-fullscreen"
                    aria-labelledby="navbar-notification-search">
                    <li>
                        <form class="form-inline my-2 my-lg-0 no-waves-effect">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for..."
                                       aria-label="Search for..." aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-gradient waves-effect waves-light"
                                            type="button">Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle no-waves-effect" id="navbar-notification-calendar"
                   data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                    <i class="batch-icon batch-icon-calendar"></i>
                    <span class="notification-number">6</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-md"
                    aria-labelledby="navbar-notification-calendar">
                    <li class="media">
                        <a href="task-list.html">
                            <i class="batch-icon batch-icon-calendar batch-icon-xl d-flex mr-3"></i>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1 notification-heading">Meeting with Project Manager</h6>
                                <div class="notification-text">
                                    Cras sit amet nibh libero
                                </div>
                                <span class="notification-time">Right now</span>
                            </div>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle no-waves-effect" id="navbar-notification-misc"
                   data-toggle="dropdown" data-flip="false" aria-haspopup="true" aria-expanded="false">
                    <i class="batch-icon batch-icon-bell"></i>
                    <span class="notification-number">4</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-md"
                    aria-labelledby="navbar-notification-misc">
                    <li class="media">
                        <a href="task-list.html">
                            <i class="batch-icon batch-icon-bell batch-icon-xl d-flex mr-3"></i>
                            <div class="media-body">
                                <h6 class="mt-0 mb-1 notification-heading">General Notification</h6>
                                <div class="notification-text">
                                    Cras sit amet nibh libero
                                </div>
                                <span class="notification-time">Just now</span>
                            </div>
                        </a>
                    </li>
                </ul>
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
                        <img src="assets/img/profile-pic.jpg" width="44" height="44">
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
                </ul>
            </li>
        </ul>
    </div>
</nav>