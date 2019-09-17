<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.png">

    <title>AJ-COMPUTACIÓN|403</title>

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

    <!-- CSS - DEMO - START -->
    <link rel="stylesheet" href="{{asset('assets/demo/css/ui-icons-batch-icons.css')}}">
    <!-- CSS - DEMO - END -->

    <!-- CSS - OPTIONAL - END -->

    <!-- QuillPro Styles -->
    <link rel="stylesheet" href="{{asset('assets/css/quillpro/quillpro.css')}}">
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <div class="right-column">

            <main class="main-content p-5" role="main">
                <div class="row">
                    <div class="col-md-12 my-5 text-center">
                        <div class="text-danger">
                            <i class="batch-icon batch-icon-link-alt batch-icon-xxl"></i>
                            <i class="batch-icon batch-icon-search batch-icon-xxl"></i>
                            <i class="batch-icon batch-icon-link-alt batch-icon-xxl"></i>
                        </div>
                        <h1 class="display-1">403</h1>
                        <div class="display-4 mb-3">Acceso denegado no tiene los permisos suficientes</div>
                        <div class="lead">No podemos encontrar la página que estás buscando.
                        </div>
                        <div class="lead">Consulte con el administrador <br>
                            <a class="btn btn-primary btn-gradient waves-effect waves-light"
                               href="{{url()->previous()}}">regresar atras </a>.
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

</body>
</html>
