<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pemodal Sasuka | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.css" integrity="sha512-9iWaz7iMchMkQOKA8K4Qpz6bpQRbhedFJB+MSdmJ5Nf4qIN1+5wOVnzg5BQs/mYH3sKtzY+DOgxiwMz8ZtMCsw==" crossorigin="anonymous" />
    <!-- material dashboard template -->
    <link href="{{asset('/investor/css/material-dashboard.css')}}" rel="stylesheet"/>
    <!-- select2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!-- dataTable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css"> 
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css"> 
    <!-- custom responsive css -->
    <link rel="stylesheet" href="{{asset('sentiment/css/responsive/yobri_responsive.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/8365b93ec9.css">
    <script src="https://use.fontawesome.com/8365b93ec9.js"></script>
            @yield('custom_head')
</head>
<body class="dark-edition">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="wrapper ">
        @include('master.header')
        
        <div class="main-panel">
        <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">
                        <i class="material-icons">notifications</i>
                        <p class="d-lg-none d-md-block">
                            Notifications
                        </p>
                        </a>
                    </li>
                        <!-- your navbar here -->
                    </ul>
                </div>
                </div>
            </nav>
        <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid data_masuk" >
                    @yield('content')
                </div>
            </div>

            @include('master.footer')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    

    <script src="{{asset('/investor/js/core/popper.min.js')}}"></script>
    <script src="{{asset('/investor/js/core/bootstrap-material-design.min.js')}}"></script>
    <script src="{{asset('/investor/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- Chartist JS -->
    <script src="{{asset('/investor/js/plugins/chartist.min.js')}}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{asset('/investor/js/plugins/bootstrap-notify.js')}}"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('/investor/js/material-dashboard.js?v=2.1.0')}}"></script>
    <!-- datatable   -->
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
    @yield('custom_script')     
</body>
</html>