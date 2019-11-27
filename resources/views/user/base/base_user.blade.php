<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : ''}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.png">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&amp;subset=latin-ext"
          rel="stylesheet">

    <!-- CSS - REQUIRED - START -->
    <!-- Batch Icons -->
    <link rel="stylesheet" href="{{asset('assets/fonts/batch-icons/css/batch-icons.css')}}">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap/bootstrap.min.css')}}">
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap/mdb.min.css')}}">
    <!-- Custom Scrollbar -->


    <!-- CSS - OPTIONAL - START -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <!-- JVMaps -->


    <!-- QuillPro Styles -->
    <link rel="stylesheet" href="{{asset('assets/css/quillpro/quillpro.css')}}">

    <!-- CSS - REQUIRED - END -->

    <!-- CSS - DEMO - START -->
    <link rel="stylesheet" href="{{asset('assets/demo/css/ui-icons-batch-icons.css')}}">

    <!-- CSS - DEMO - END -->

    @yield('css')
</head>

<body>
<div id="app">
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
                    <div class="col-md-6">
                        <div class="header-search">
                            <form>
                                <select name="parametroBuscar" class="input-select">
                                    <option value="cedula_p">Cédula</option>
                                    <option value="codigo_or">N° orden</option>
                                    <option value="created_at">Fecha</option>
                                </select>
                                <input class="input" placeholder="Escribe aquí">
                                <button class="search-btn">Buscar</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Tus ordenes</span>
                                    <div class="qty">3</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="./img/product01.png" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">orden lista</a></h3>
                                                <h4 class="product-price"><span class="qty">Ver solución</span></h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>

                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="./img/product02.png" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">orden lista</a></h3>
                                                <h4 class="product-price"><span class="qty">Ver solución</span></h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="#">Imprimir</a>
                                        <a href="#">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
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
                    <li><a href="#">Mis ordenes</a></li>
                    <li><a href="#">Pendientes</a></li>
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
                    <div class="col-md-4 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Contactos</h3>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-4 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Información</h3>
                            <ul class="footer-links">
                                <li><a href="#">Mis ordenes</a></li>
                                <li><a href="#">pendientes</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Servicios</h3>
                            <ul class="footer-links">
                                <li><a href="#">Mantenimiento</a></li>
                                <li><a href="#">Reparaciones</a></li>
                            </ul>
                        </div>
                    </div>
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
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                                                                    target="_blank">Colorlib</a>
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
</div>


<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-3.1.1.min.js')}}"></script>
<!-- Popper.js - Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{asset('assets/js/bootstrap/mdb.min.js')}}"></script>

<!-- Image Placeholder -->
<script type="text/javascript" src="{{asset('assets/js/misc/holder.min.js')}}"></script>

<!-- SCRIPTS - OPTIONAL END -->

<!-- QuillPro Scripts -->
<script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>


@yield('script')
</body>
</html>
