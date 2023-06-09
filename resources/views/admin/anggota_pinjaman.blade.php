@extends('admin.master')
@section('judul','Tabel Angsuran')
    
@section('konten')
<style>
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Angsuran </h1>
    <p class="mb-4">Di halaman ini anda dapat melihat angsuran</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel angsuran</h6>
        </div>
        <div class="card-body">

      

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>nik</th>
                            <th>nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>nik</th>
                            <th>nama</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                 
                    </tbody>
                </table>
            </div>
        </div>
    </div>

     <!-- Modal -->
    


</div>
    <script src="/assets/moment.min.js"></script>
    <script>
    $(document).ready(function() {

     var table = $('#dataTable2').DataTable({
        ajax: {
            url: `/admin/tabel-anggota-pinjaman/data`,
            dataSrc: 'data',
        },
        columns: [
            {
                data: 'nik',
            },
            {
                data: 'nama',
            },
            
        ],         
         aoColumnDefs: [{
                targets: 2,
                data: 'id',
                "render": function(data, catatan, row) {
        
                            return `
                            <a class="" href="/admin/tabel-anggota-pinjaman/${row.nik}"><i class="fas fa-edit" ></i></a>
                            `;
                      
                }
            }, ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        
    });


}); 
    </script>
@endsection