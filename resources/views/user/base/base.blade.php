<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>COMPUMEGA</title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{asset('user/css/bootstrap.min.css')}}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{asset('user/css/slick.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('user/css/slick-theme.css')}}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{asset('user/css/nouislider.min.css')}}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{asset('user/css/font-awesome.min.css')}}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{asset('user/css/style.css')}}"/>
@yield('css')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!-- HEADER -->
<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li><a href="#"><i class="fa fa-phone"></i> 099 932 3908</a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> compumega2019@gmail.com</a></li>
                <li><a href="#"><i class="fa fa-map-marker"></i> Dirección: Sucre y Quito 09-29 Ambato</a></li>
            </ul>
            <ul class="header-links pull-right">

                {{--
                <li><a href="#"><i class="fa fa-user-o"></i> Mi perfil</a></li>
                --}}
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="./img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
            @yield('search')
            <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
            @yield('notificacion')
            <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>
<!-- /HEADER -->

<!-- NAVIGATION -->
<nav id="navigation">
    <!-- container -->
    <div class="container">
        <!-- responsive-nav -->
        <div id="responsive-nav">
            <!-- NAV -->
            <ul class="main-nav nav navbar-nav">
                @yield('links')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name}} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Cerrar sesión') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            <!-- /NAV -->
        </div>
        <!-- /responsive-nav -->
    </div>
    <!-- /container -->
</nav>
<!-- /NAVIGATION -->


<!-- SECTION -->
<div class="section">
    @yield('content')

</div>
<!-- /SECTION -->

<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Contactos</h3>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>Sucre y Quito 09-29 Ambato - Ecuador</a>
                            </li>
                            <li><a href="#"><i class="fa fa-phone"></i>099 932 3908</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>compumega2019@gmail.com</a></li>
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>

                <div class="col-md-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Información</h3>
                        <ul class="footer-links">
                            <li><a href="{{route('historial-cliente')}}">Mis ordenes</a></li>
                            <li><a href="{{route('cliente')}}">Ordenes pendientes</a></li>
                        </ul>
                    </div>
                </div>
                {{----         <div class="col-md-4 col-xs-6">
                                    <div class="footer">
                                        <h3 class="footer-title">Servicios</h3>
                                        <ul class="footer-links">
                                            <li><a href="#">Mantenimiento</a></li>
                                            <li><a href="#">Reparaciones</a></li>
                                        </ul>
                                    </div>
                                </div>
                                ---}}
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Dirección: Sucre y Quito 09-29 Ambato - Ecuador Teléfono: 0999323908  Email:compumega495@gmail.com

                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>


                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->

<!-- jQuery Plugins -->
<script src="{{asset('user/js/jquery.min.js')}}"></script>
<script src="{{asset('user/js/bootstrap.min.js')}}"></script>
<script src="{{asset('user/js/slick.min.js')}}"></script>
<script src="{{asset('user/js/nouislider.min.js')}}"></script>
<script src="{{asset('user/js/jquery.zoom.min.js')}}"></script>
<script src="{{asset('user/js/main.js')}}"></script>
@yield('scripts')

</body>
</html>
