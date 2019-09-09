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
    
    <div class="input-group md-form form-sm form-1 pl-0">
        <div class="input-group-prepend">
    <span class="input-group-text purple lighten-3" id="basic-text1"><i class="fas fa-search text-white"
                                                                        aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
    </div>

    <div class="input-group md-form form-sm form-1 pl-0">
        <div class="input-group-prepend">
    <span class="input-group-text cyan lighten-2" id="basic-text1"><i class="fas fa-search text-white"
                                                                      aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
    </div>

    <div class="input-group md-form form-sm form-1 pl-0">
        <div class="input-group-prepend">
    <span class="input-group-text pink lighten-3" id="basic-text1"><i class="fas fa-search text-white"
                                                                      aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search">
    </div>

    <div class="input-group md-form form-sm form-2 pl-0">
        <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
    <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                                                       aria-hidden="true"></i></span>
        </div>
    </div>

    <div class="input-group md-form form-sm form-2 pl-0">
        <input class="form-control my-0 py-1 lime-border" type="text" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
    <span class="input-group-text lime lighten-2" id="basic-text1"><i class="fas fa-search text-grey"
                                                                      aria-hidden="true"></i></span>
        </div>
    </div>

    <div class="input-group md-form form-sm form-2 pl-0">
        <input class="form-control my-0 py-1 red-border" type="text" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
    <span class="input-group-text red lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                                                     aria-hidden="true"></i></span>
        </div>
    </div>
    Buscar con botones
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
<script type="text/javascript" src="{{asset('assets/plugins/form-validator/jquery.form-validator.min.js')}}"></script>
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
