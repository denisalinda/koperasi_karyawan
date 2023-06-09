@extends('admin.master')
@section('judul','Dashboard')

@section('konten')
<div class="container-fluid">



    <!-- Content Row -->
    <div class="row">

        {{-- @if (auth()->user()->role == "admin") --}}
                <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Anggota</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$jml_anggota}} Orang</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
             <!-- Earnings (Monthly) Card Example -->
             <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Data Perlu Persetujuan Pengawas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" >{{$pinjaman_pending}} Data</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>

    <!-- Content Row -->

    {{-- <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Bulanan</h6>

            </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}



</div>
    <!-- Page level plugins -->
    <script src="/admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    {{-- <script src="/admin/js/demo/chart-area-demo.js"></script> --}}

@endsection
