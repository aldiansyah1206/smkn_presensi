<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title></title>

        <!-- Fonts -->
        <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="/css/sb-admin-2.min.css" rel="stylesheet">
        
        <!--calendar-->
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.css' rel='stylesheet' />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.8.0/main.min.js'></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
        <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
        
    </head>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center">
                 <div class="img">
                        <img src="/img/logosmkn.jpg" class="img-profile rounded-circle" width="65px"  >
                    </div>
                    <div class="sidebar-brand-text mx-3">Sistem Presensi</div>
                </a>
                <li class="nav-item">
               
               @if (Auth::user()->hasRole('admin'))
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/dashboard'}}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
            
                <!-- Heading -->
                <div class="sidebar-heading">
                    Menu
                </div>
                <!-- Nav Item - datapembina -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/userspembina'}}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Data Pembina </span></a>
                </li>
                <!-- Nav Item - datasiswa -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/userssiswa'}}">
                        <i class="fas fa-user-friends"></i>
                        <span>Data Siswa </span></a>
                </li>
                <!-- Nav Item - kelas -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/kelas'}}">
                        <i class="fas fa-users"></i>
                        <span>Kelas</span></a>
                </li>
                <!-- Nav Item -jurusan  -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/jurusan'}}">
                        <i class="fas fa-school"></i>
                        <span>Jurusan</span></a>
                </li>
                <!-- Nav Item kegitan  -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/kegiatan'}}">
                        <i class="fas fa-clipboard"></i>
                        <span>Kegiatan</span></a>
                </li>
                <!-- Nav Item penjadwalan  -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/penjadwalan'}}">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Jadwal Kegiatan</span></a>
                </li>
                @endif

                @if (Auth::user()->hasRole('pembina'))
                 <!-- Divider -->
                 <hr class="sidebar-divider my-0">
                 <!-- Nav Item - Dashboard -->
                 <li class="nav-item">
                     <a class="nav-link" href="{{'/dashboardpembina'}}">
                         <i class="fas fa-fw fa-tachometer-alt"></i>
                         <span>Dashboard</span></a>
                 </li>
                 <!-- Divider -->
                 <hr class="sidebar-divider">
             
                 <!-- Heading -->
                 <div class="sidebar-heading">
                     Menu
                 </div>
                <!-- Nav Item - datapresensi  -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/pembina/kegiatan' }}">
                        <i class="fas fa-user-friends"></i>
                        <span>Data Siswa</span></a>
                </li>
                <!-- Nav Item - datapresensi  -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/presensi' }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Presensi</span></a>
                </li>
                <!-- Nav Item penjadwalan  -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/jadwalpembina'}}">
                        <i class="fas fa-calendar"></i>
                        <span>Jadwal Kegiatan</span></a>
                </li>
                <!-- Nav Item - riwayatpresensi  -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/presensi/history'}}">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Presensi</span></a>
                </li>
                <!-- Nav Item - rekappresensi  -->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/presensi/rekap'}}">
                        <i class="fas fa-file-pdf"></i> 
                        <span>Rekap Presensi</span></a>
                </li>
                @endif
                @if (Auth::user()->hasRole('siswa'))
                 <!-- Divider -->
                 <hr class="sidebar-divider my-0">
                 <!-- Nav Item - Dashboard -->
                 <li class="nav-item">
                     <a class="nav-link" href="{{'/dashboardsiswa'}}">
                         <i class="fas fa-fw fa-tachometer-alt"></i>
                         <span>Dashboard</span></a>
                 </li>
                 <!-- Divider -->
                 <hr class="sidebar-divider">
             
                 <!-- Heading -->
                 <div class="sidebar-heading">
                     Menu
                 </div> 
                <!-- Nav Item penjadwalan  -->
                <li class="nav-item">
                <a class="nav-link" href="{{'/jadwalsiswa'}}">
                        <i class="fas fa-calendar"></i>
                        <span>Jadwal Kegiatan</span></a>
                </li>

                <!-- Nav Item -riwayat presensi-->
                <li class="nav-item">
                    <a class="nav-link" href="{{'/siswa/presensi/history'}}">
                        <i class="far fa-calendar-alt"></i>
                        <span>Riwayat Presensi</span></a>
                </li>
                @endif
                <!-- Divider -->
                <!-- Untuk logout) -->
                @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('pembina') || Auth::user()->hasRole('siswa'))
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                @endif

                <!-- Divider -->
                <hr class="sidebar-divider c9">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            
            </ul>
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content" style="background-color: #F5F5F5">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <div class="topbar-divider d-none d-sm-block"></div>
    
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        @if(session()->has('success'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                </div>
                            </div>
                        </div>
                        @elseif(session()->has('hapus'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('hapus') }}
                                </div>
                            </div>
                        </div>
                        @elseif(session()->has('danger'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('danger') }}
                                </div>
                            </div>
                        </div>
                        @elseif(session()->has('error'))
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                </div>
                            </div>
                        </div>
                        @endif
                    
                        @if ($errors->any())
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    
                        <!-- Page Heading -->
                        @yield('content')
                    </div>
                    
                    <!-- /.container-fluid -->
    
                </div>
                <!-- End of Main Content -->
    
                <!-- Footer -->
                <footer class="sticky-footer bg-white" style="margin-top: 20px">
                    <div class="container my-auto" >
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website <?= date('Y');?></span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
    
            </div>
            <!-- End of Content Wrapper -->
    
        </div>
        <!-- End of Page Wrapper -->
    
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="/vendor/jquery/jquery.min.js"></script>
        <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
        <!-- Core plugin JavaScript-->
        <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    
        <!-- Custom scripts for all pages-->
        <script src="/js/sb-admin-2.min.js"></script>
        @yield('script')
        <script>
            window.setTimeout(function() {
                document.querySelectorAll('.alert').forEach(function(alert) {
                    alert.style.display = 'none';
                });
            }, 2500); // Waktu dalam milidetik (misalnya 2500 = 2,5 detik)
        </script>
        @stack('js')
    </body>
</html>
