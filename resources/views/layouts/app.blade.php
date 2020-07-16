
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>@yield('title') - Sistem Pesan Dental Unit RSGM UGM</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link href="{{url('assets/vendor/fonts/circular-std/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
</head>

<body>

      <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
       <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="{{url('home')}}">DU RSGM UGM </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{url('assets/images/avatar-1.jpg')}}" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">
                                    {{strtoupper(auth()->user()->name)}}</h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <!-- <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Pegaturan</a> -->
                                <a class="dropdown-item" href="{{route('pengguna.ubahSandi')}}"><i class="fas fa-cog mr-2"></i>Ubah Kata Sandi</a>
                                <a class="dropdown-item" href="{{url('logout')}}"><i class="fas fa-power-off mr-2"></i>Keluar</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
      <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('home')}}"><i class="fa fa-fw fa-rocket"></i>Beranda</a>
                            </li>
                            @if(auth()->user()->role=='0')
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('transaksi.index')}}"><i class="fa fa-fw fa-rocket"></i>Daftar Pemesan </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('dentalUnit.pesan')}}"><i class="fa fa-fw fa-rocket"></i>Pesan Dental Unit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('transaksi.riwayat')}}"><i class="fa fa-fw fa-rocket"></i>Pesan Riwayat Pemesanan Dental Unit </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw fa-columns"></i>Master Data</a>
                                <div id="submenu-8" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('master-data/departemen')}}">Departemen</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('master-data/dental-unit')}}">Dental Unit</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('master-data/pegawai')}}">Pegawai</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('master-data/koas')}}">Mahasiswa Koas</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('master-data/pengguna')}}">Pengguna</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            @elseif(auth()->user()->role=='1')
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('transaksi.index')}}"><i class="fa fa-fw fa-rocket"></i>Daftar Pemesan </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('transaksi.riwayat')}}"><i class="fa fa-fw fa-rocket"></i>Riwayat Pemesanan Dental Unit </a>
                            </li>
                            @elseif(auth()->user()->role=='2')
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('dentalUnit.pesan')}}"><i class="fa fa-fw fa-rocket"></i>Pesan Dental Unit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('transaksi.riwayat')}}"><i class="fa fa-fw fa-rocket"></i>Riwayat Pemesanan Dental Unit</a>
                            </li><!--end master data-->
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">@yield('subtitle') </h2>
                        <?php $link = "" ?>
                            <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet vestibulum mi. Morbi lobortis pulvinar quam.</p>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Pages</a></li>
                            @for($i = 1; $i <= count(Request::segments()); $i++)
                                @if($i < count(Request::segments()) & $i > 0)
                                <?php $link .= "   >   " . Request::segment($i); ?>
                                        <li class="breadcrumb-item" aria-current="page"> 
                                            <a href="<?= $link ?>">{{ ucwords(str_replace(' - ',' ',Request::segment($i)))}}</a> >
                                        </li>
                                @else {{ucwords(str_replace('-',' ',Request::segment($i)))}}
                                @endif
                            @endfor
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            © 2020<a href="http://rsgm.ugm.ac.id"> RSGM UGM Prof. Soedomo.</a><br>
                            © 2018 Concept. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <!-- <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- Optional JavaScript -->
    <script src="{{url('assets/vendor/jquery/jquery-3.3.1.min.js')}}"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.js')}}"></script>
    <script src="{{url('assets/vendor/slimscroll/jquery.slimscroll.js')}}"></script>
    <script src="{{url('assets/libs/js/main-js.js')}}"></script>
</body>
</html>