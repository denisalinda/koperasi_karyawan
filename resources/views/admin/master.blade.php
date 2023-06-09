<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('judul')</title>

    <!-- Custom fonts for this template-->
    <link href="/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/admin/css/sb-admin-2.css" rel="stylesheet">
    <script src="/admin/vendor/jquery/jquery.min.js"></script>
    <!-- Custom styles for this page -->
    <link href="/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="/assets/ckeditor/ckeditor.js"></script>
    <link href="/assets/select2/select2.min.css" rel="stylesheet" />
    <link href="/assets/datatables/buttons.min.css" rel="stylesheet" />
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="/image/koperasi.png" class="img-fluid" style="-webkit-transform: rotate(15deg)" alt="" srcset="">
                </div>
                <div class="sidebar-brand-text mx-2">Koperasi</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ 'dashboard' == request()->segment(2) ? 'active':'' }}">
                <a class="nav-link" href="/admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard </span></a>
            </li>
                

        

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Heading -->
            @if (auth()->user()->role == "superadmin"|| auth()->user()->role == "pengawas" || auth()->user()->role == "ketua")
            <div class="sidebar-heading">
                superadmin
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ 'tabel-user' == request()->segment(2) ? 'active':'' }}">
                <a class="nav-link" href="/admin/tabel-user">
                    <i class="fas fa-user-alt"></i>
                    <span>User</span></a>
            </li>
            @endif
         

            @if (auth()->user()->role == "ketua" || auth()->user()->role == "pengawas" || auth()->user()->role == "ketua")
            <div class="sidebar-heading">
                Ketua Koperasi
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ 'tabel-ketua-pengajuan' == request()->segment(2) ? 'active':'' }}">
                <a class="nav-link" href="/admin/tabel-ketua-pengajuan">
                    <i class="fas fa-scroll"></i>
                    <span>Pengajuan Pinjaman</span></a>
            </li>
            @endif
     
            <!-- Heading -->
            @if (auth()->user()->role == "pengawas" || auth()->user()->role == "ketua")
            <div class="sidebar-heading">
                Wakil Ketua
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ 'tabel-rekomendasi' == request()->segment(2) ? 'active':'' }}">
                <a class="nav-link" href="/admin/tabel-rekomendasi">
                    <i class="fas fa-book-open"></i>
                    <span>Rekomendasi</span></a>
            </li>
            @endif
            @if (auth()->user()->role == "sekretaris" || auth()->user()->role == "pengawas"|| auth()->user()->role == "ketua")
            <div class="sidebar-heading">
                Sekretaris
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ 'tabel-anggota' == request()->segment(2) ? 'active':'' }}">
                <a class="nav-link" href="/admin/tabel-anggota">
                    <i class="fas fa-user-alt"></i>
                    <span>Anggota</span></a>
            </li>
            <li class="nav-item {{ 'tabel-unit-usaha' == request()->segment(2) ? 'active':'' }}">
                <a class="nav-link" href="/admin/tabel-unit-usaha">
                    <i class="fas fa-store"></i>
                    <span>Unit Usaha</span></a>
            </li>
            @endif

            @if (auth()->user()->role == "bendahara" || auth()->user()->role == "pengawas" || auth()->user()->role == "ketua")
            <div class="sidebar-heading">
                Bendahara
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ 'tabel-anggota-pinjaman' == request()->segment(2) ? 'active':'' }}">
                <a class="nav-link" href="/admin/tabel-anggota-pinjaman">
                    <i class="fas fa-user-alt"></i>
                    <span>Pinjaman Anggota</span></a>
            </li>
            <li class="nav-item {{ 'tabel-pengajuan' == request()->segment(2) ? 'active':'' }}">
                <a class="nav-link" href="/admin/tabel-pengajuan">
                    <i class="fas fa-scroll"></i>
                    <span>Kelola Pinjaman</span></a>
            </li>
        
            
            <!-- <li class="nav-item {{ 'tabel-angsuran' == request()->segment(2) ? 'active':'' }}">
                <a class="nav-link" href="/admin/tabel-angsuran">
                    <i class="fas fa-pencil-alt"></i>
                    <span>Kelola Angsuran</span></a>
            </li> -->
            <li class="nav-item 
            {{ 'tabel-simpanan' == request()->segment(2) ? 'active':'' }}
            {{ 'tabel-simpanan-sukarela'== request()->segment(2) ? 'active':'' }}
            {{ 'tabel-simpanan-wajib'  == request()->segment(2) ? 'active':'' }}
            ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fas fa-dollar-sign"></i>
                    <span>Simpanan</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Simpan</h6>
                        <a class="collapse-item {{ 'tabel-simpanan' == request()->segment(2) ? 'active':'' }}" href="/admin/tabel-simpanan">Simpanan Pokok</a>
                        <a class="collapse-item {{ 'tabel-simpanan-sukarela' == request()->segment(2) ? 'active':'' }}" href="/admin/tabel-simpanan-sukarela">Simpanan Sukrela</a>
                        <a class="collapse-item {{ 'tabel-simpanan-wajib' == request()->segment(2) ? 'active':'' }}" href="/admin/tabel-simpanan-wajib">Simpanan Wajib</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ 'tabel-riwayat-transaksi' == request()->segment(2) ? 'active':'' }}">
                <a class="nav-link" href="/admin/tabel-riwayat-transaksi">
                    <i class="fas fa-file-alt"></i>
                    <span>Riwayat Transaksi</span></a>
            </li>
            @endif
    

      

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

  

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

              

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#"  aria-haspopup="true" aria-expanded="false">
                            Hallo ,
                            {{auth()->user()->name}} 
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                      

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang ,
                                     {{auth()->user()->name}}
                                     </span>
                                <img class="img-profile rounded-circle"
                                    src="/admin/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                {{-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a> --}}
                                <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/logout">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                     @yield('konten')
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Koperasi Stimata 2023</span>
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

    <script src="/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/admin/js/sb-admin-2.min.js"></script>



    <!-- Page level plugins -->
    <script src="/admin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/sweetalert.min.js"></script>
    <script src="/assets/select2/select2.min.js"></script>
    
    
    <!-- Datatable JS -->
    <script src="/assets/datatables/buttons1.min.js"></script>
    <script src="/assets/datatables/jzip.min.js"></script>
    <script src="/assets/datatables/pdfmake.min.js"></script>
    <script src="/assets/datatables/vfs_font.js"></script>
    <script src="/assets/datatables/buttonhtml5.min.js"></script>



    <script>
            const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        showCloseButton: true,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    }); 
    </script>

    <!-- Page level custom scripts -->
    {{-- <script src="/admin/js/demo/datatables-demo.js"></script> --}}
</body>

</html>