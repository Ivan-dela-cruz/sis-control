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
    <link rel="stylesheet" href="{{asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.min.css')}}">
    <!-- Hamburger Menu -->
    <link rel="stylesheet" href="{{asset('assets/css/hamburgers/hamburgers.css')}}">

    <!-- CSS - REQUIRED - END -->

    <!-- CSS - OPTIONAL - START -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <!-- JVMaps -->
    <link rel="stylesheet" href="{{asset('assets/plugins/jvmaps/jqvmap.min.css')}}">
    <!-- CSS - OPTIONAL - END -->

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

    <div class="container-fluid">


        <div class="row">

            {{--Valida que el usuario haya iniciado sesión--}}
            @if(Auth::check())

                {{--Valida que el usuario tenga el rol de adminsitrador--}}
                @if (Auth::user()->tipo_p == 0)
                    @include('admin.plantilla.sidebaradministrador')
                    {{--Valida que el usuario tenga el rol de tecnico--}}
                @elseif (Auth::user()->tipo_p == 1)
                    @include('admin.plantilla.sidebarsecundiario')

                @endif

            @endif

            <div class="right-column">
                @include('admin/base/top_menu')
                <main id="sectionRefresh" class="main-content p-4" role="main">

                    @yield('content')


                </main>
                <br>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <footer class="pull-right">
                            <hr>
                            CompuMega - <a href="#"
                                           target="_blank"
                                           style="font-weight:300;color:#ffffff;background:#1d1d1d;padding:0 3px;">Solo
                                <span
                                        style="color:#ffa733;font-weight:bold">-</span>Tecnología

                            </a>
                            Dirección: Sucre y Quito 09-29 Ambato - Ecuador Teléfono: 0999323908

                            <hr>
                        </footer>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <!-- SCRIPTS - REQUIRED START -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- Bootstrap core JavaScript -->
    <!-- JQuery -->


    <script type="text/javascript" src="{{asset('assets/js/jquery/jquery-3.1.1.min.js')}}"></script>
    <!-- Popper.js - Bootstrap tooltips -->
    <script type="text/javascript" src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{asset('assets/js/bootstrap/mdb.min.js')}}"></script>

    <!-- Velocity -->
    <script type="text/javascript" src="{{asset('assets/plugins/velocity/velocity.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/velocity/velocity.ui.min.js')}}"></script>

    <!-- Custom Scrollbar -->
    <script type="text/javascript"
            src="{{asset('assets/plugins/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- jQuery Visible -->
    <script type="text/javascript" src="{{asset('assets/plugins/jquery_visible/jquery.visible.min.js')}}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script type="text/javascript" src="{{asset('assets/js/misc/ie10-viewport-bug-workaround.js')}}"></script>

    <!-- SCRIPTS - REQUIRED END -->

    <!-- Form Validation -->
    <script type="text/javascript"
            src="{{asset('assets/plugins/form-validator/jquery.form-validator.min.js')}}"></script>
    <!-- SCRIPTS - OPTIONAL START -->
    <!-- ChartJS -->
    <script type="text/javascript" src="{{asset('assets/plugins/chartjs/chart.bundle.min.js')}}"></script>
    <!-- JVMaps -->
    <script type="text/javascript" src="{{asset('assets/plugins/jvmaps/jquery.vmap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/jvmaps/maps/jquery.vmap.usa.js')}}"></script>
    <!-- Image Placeholder -->
    <script type="text/javascript" src="{{asset('assets/js/misc/holder.min.js')}}"></script>

    <!-- SCRIPTS - OPTIONAL END -->

    <!-- QuillPro Scripts -->
    <script type="text/javascript" src="{{asset('assets/js/scripts.js')}}"></script>


@yield('script')
</body>
</html>
