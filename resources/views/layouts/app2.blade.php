
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Sistem Pesan Dental Unit RSGM UGM</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{url('assets/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{url('assets/EasyAutocomplete/easy-autocomplete.css')}}">
    <!-- MetisMenu CSS -->
    <link href="{{url('assets/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{url('assets/dist/css/sb-admin-2.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/daterangepicker.css')}}" />
    <!-- Morris Charts CSS -->
    <link href="{{url('assets/vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{url('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
 <!-- jQuery -->
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
<script src="{{url('assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/moment.min.js')}}"></script>
<script src="{{url('assets/dist/jautocalc.js')}}"></script>
<script src="{{url('assets/js/jquery-ui.js')}}"></script>
<script src="{{url('assets/EasyAutocomplete/jquery.easy-autocomplete.min.js')}}"></script>

<script type="text/javascript" src="{{url('assets/js/daterangepicker.min.js')}}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Sistem Pesan Dental Unit RSGM UGM</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <li class="dropdown">
                 
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{route('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{url('/home')}}"><i class="fa fa-dashboard fa-fw"></i> Beranda</a>
                        </li>
                        @if(auth()->user()->role=='1')
                        <li>
                            <a href="{{route('transaksi.index')}}"><i class="fa fa-arrow">Daftar Pemesan</i></a>
                        </li>
                        <li>
                            <a href="{{route('dentalUnit.pesan')}}"><i class="fa fa-arrow">Pesan Dental Unit</i></a>
                        </li>
                        <li>
                            <a href="{{route('transaksi.riwayat')}}"><i class="fa fa-arrow">Riwayat Pemesanan Dental Unit</i></a>
                        </li>
                        @elseif(auth()->user()->role=='2')
                        <li>
                            <a href="{{route('dentalUnit.pesan')}}"><i class="fa fa-arrow">Pesan Dental Unit</i></a>
                        </li>
                        <li>
                            <a href="{{route('transaksi.riwayat')}}"><i class="fa fa-arrow">Riwayat Pemesanan Dental Unit</i></a>
                        </li>
                        @elseif(auth()->user()->role =='0')
                        <li>
                            <a href="{{route('transaksi.index')}}"><i class="fa fa-arrow">Daftar Pemesan</i></a>
                        </li>
                        <li>
                            <a href="{{route('dentalUnit.pesan')}}"><i class="fa fa-arrow">Pesan Dental Unit</i></a>
                        </li>
                        <li>
                            <a href="{{route('transaksi.riwayat')}}"><i class="fa fa-arrow">Riwayat Pemesanan Dental Unit</i></a>
                        </li>

                        <li>
                            <a href="#">Master Data<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{url('master-data/departemen')}}">Departemen</a>
                                </li>
                                <li>
                                    <a href="{{url('master-data/dental-unit')}}">Dental Unit</a>
                                </li>
                                <li>
                                    <a href="{{url('master-data/pegawai')}}">Pegawai</a>
                                </li>
                                <li>
                                    <a href="{{url('master-data/koas')}}">Mahasiswa Koas</a>
                                </li>
                                <li>
                                    <a href="{{url('master-data/pengguna')}}">Pengguna</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{url('pengaturan')}}"><i class="fa fa-cog"></i>Pengaturan</a>
                        </li>
                        @endif                        
                  </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('subtitle')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
           @yield('content')
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

   
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{url('assets/vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{url('assets/vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{url('assets/vendor/morrisjs/morris.min.js')}}"></script>
    <script src="{{url('assets/data/morris-data.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{url('assets/dist/js/sb-admin-2.js')}}"></script>

</body>

</html>
