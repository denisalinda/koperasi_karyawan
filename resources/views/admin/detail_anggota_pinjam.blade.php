@extends('admin.master')
@section('judul','Data Angsuran Anggota')
    
@section('konten')
<style>
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Anggota</h6>
        </div>
        <div class="card-body">
      
            <div class="col-md-12 text-center mb-2">
                <img src="/storage/{{$anggota->image}}" alt="" class="img-fluid justify-content-center" srcset="">
            </div>
            <h1 class="h4 mb-2 text-gray-800 mt-2">Profil Anggota </h1>
            <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>NIK</td>
                    <td>{{$anggota->nik}}</td>
                  </tr>
                  <tr>
                    <td>Nama</td>
                    <td>{{$anggota->nama}}</td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td>{{$anggota->email}}</td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>{!! $anggota->is_active == 1 ? 'Aktif' : 'Tidak Aktif'; !!}</td>
                  </tr>
                </tbody>
              </table>
            <h1 class="h4 mb-2 text-gray-800 mt-2">Tabel Pinjaman </h1>
            <div class="table-responsive mt-4">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>jumlah pinjam</th>
                            <th>bunga</th>
                            <th>jangka waktu</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>no</th>
                            <th>jumlah pinjam</th>
                            <th>bunga</th>
                            <th>jangka waktu</th>
                            <th>status</th>
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
     <div class="modal  fade" id="modal_carosel" tabindex="-1" role="dialog" aria-labelledby="modal_carosel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Angsuran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive mt-4" >
                    <table class="table table-bordered display nowrap" id="dataTable3"  width="100%" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>tanggal jatuh tempo</th>
                                <th>tanggal bayar</th>
                                <th>jumlah</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>tanggal jatuh tempo</th>
                                <th>tanggal bayar</th>
                                <th>jumlah</th>
                                <th>status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                     
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>


      <!-- Modal -->
      <div class="modal  fade" id="modal_carosel_2" tabindex="-1" role="dialog" aria-labelledby="modal_carosel_2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Angsuran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="form_carosel">
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nama</label>
                        <input type="hidden"  class="form-control"  id="id" name="id" aria-describedby="judul">
                        <input type="hidden"  class="form-control"  id="id_pinjaman" name="id_pinjaman" aria-describedby="judul">
                        <input type="text" disabled  class="form-control"  id="nama" name="nama" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" disabled  class="form-control"  id="nik" name="nik" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="angsuran" class="form-label">Angsuran</label>
                        <input type="text" disabled   class="form-control"  id="angsuran" name="angsuran" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_jatuh_tempo" class="form-label">Tanggal Jatuh Tempo</label>
                        <input type="text" disabled  class="form-control"  id="tanggal_jatuh_tempo" name="tanggal_jatuh_tempo" aria-describedby="judul">
                    </div>
                    @csrf
            </div>
            <div class="modal-footer justify-content-center">
                @if (auth()->user()->role == "bendahara")
                    <button id="btn_lunas" class="btn btn-success">Lunas</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                @endif
        </form>
            </div>
        </div>
        </div>
    </div>


</div>
    <script src="/assets/moment.min.js"></script>
    @if (auth()->user()->role == "bendahara")
    <script>
            $(document).ready(function() {
            
                var myData ={};

            var table = $('#dataTable2').DataTable({
                ajax: {
                    url: `/admin/tabel-anggota-pinjaman/angsuran`,
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {'id' : `{{$anggota->id}}`},
                    dataSrc: 'data',
                },
                columns: [
                    {
                        data:null,"sortable": false, 
                                   render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }  
                    },
                    {
                        data: 'jumlah_pinjman_diajukan',
                    },
                    {
                        data: function(data, catatan, row) {
                                return `${data.bunga} %`
                            },
                    },
                    {
                        data: function(data, catatan, row) {
                                return `${data.jangka_waktu} bulan`
                            },
                    },
                    {
                        data: function(data, catatan, row) {
                              if(data.lunas == 1){return '<span class="badge badge-success">lunas</span>'}else{return '<span class="badge badge-danger">belom lunas</span>'}
                            },
                    },
                    
                ],         
                aoColumnDefs: [{
                        targets: 5,
                        data: 'id',
                        "render": function(data, catatan, row) {
                
                                    return `
                                    <a class="" href="#" id="btn_show" data-id="${data}"><i class="fas fa-edit" ></i></a>
                                    `;
                            
                        }
                    }, ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
                
            });

            $('#dataTable2 tbody').on('click', '#btn_show', function(e) {
                e.preventDefault();

                var id_query = this.getAttribute('data-id');
                myData.id = id_query;
                table3.ajax.reload();
                $('#modal_carosel').modal('show');
            });

            var table3 = $('#dataTable3').DataTable({
                        ajax: {
                            url: `/admin/tabel-anggota-pinjaman/angsuran/data`,
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: function ( d ) {
                                return  $.extend(d, myData);
                            },
                            dataSrc: 'data',
                        },
          
                        columns: [
                            
                            {
                                data:null,"sortable": false, 
                                   render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }  
                            },
                            {
                                data: function(data, catatan, row) {
                                return moment(`${data.tanggal_jatuh_tempo}`).format('DD-MM-YYYY');
                               }
                            },
                            {
                                data: function(data, catatan, row) {
                                return moment(`${data.updated_at}`).format('DD-MM-YYYY');
                            }
                            },
                            {
                                data: function(data, catatan, row) {
                                        return formatRupiah(`${data.angsuran}`,'Rp. ');
                                    },
                            },
                            {
                                data: function(data, catatan, row) {
                                    if(data.lunas == 1){return '<span class="badge badge-success">sudah bayar</span>'}else{return '<span class="badge badge-danger">belom bayar</span>'}
                                    },
                            },
                            
                        ],         
                        aoColumnDefs: [{
                                targets: 5,
                                data: 'id',
                                "render": function(data, catatan, row) {
                        
                                    if(row.lunas == 0){
                                        return `
                                        <a class="" href="#"  id="btn_edit" 
                                            data-id="${data}"
                                            data-id-pinjaman="${row.id_pinjaman}" 
                                            data-nama="${row.nama}" 
                                            data-pengajuan="${row.jumlah_pinjman_diajukan}" 
                                            data-nik="${row.nik}" data-angsuran="${row.angsuran}" 
                                            data-tanggal-tempo="${row.tanggal_jatuh_tempo}" 
                                          ><i class="fas fa-edit" ></i></a>
                                        `;
                                    }else{
                                        return `
                                        <a class="" href="#"  ><i style="color: grey" class="fas fa-edit" ></i></a>
                                        `;
                                    }
                                    
                                }
                            }, ],
                            
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                        
                    });

                    $('#dataTable3 tbody').on('click', '#btn_edit', function(e) {
                    e.preventDefault();
                    clearData();
                    aksi_status = false;

                    var id = this.getAttribute('data-id');
                    var id_pinjaman = this.getAttribute('data-id-pinjaman');
                    var nama = this.getAttribute('data-nama');
                    var nik = this.getAttribute('data-nik');
                    var angsuran = this.getAttribute('data-angsuran');
                    var pengajuan = this.getAttribute('data-pengajuan');
                    var tanggal_jatuh_tempo = this.getAttribute('data-tanggal-tempo');
            
                    $('#id').val(id);
                    $('#id_pinjaman').val(id_pinjaman);
                    $('#nama').val(nama);
                    $('#nik').val(nik);
                    $('#angsuran').val(formatRupiah(angsuran, 'Rp. '));
                    $('#tanggal_jatuh_tempo').val(moment(tanggal_jatuh_tempo).format('DD-MM-YYYY'));
        
                    
                    $('#modal_carosel').modal('hide');
                    $('#modal_carosel_2').modal('show');
            });

            $('#btn_lunas').click(function(e){
                e.preventDefault();
                var id =  $('#id').val();
                var id_pinjaman =  $('#id_pinjaman').val();

                $.ajax({
                        url: "/admin/tabel-angsuran/bayar",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {'id' : id, 'id_pinjaman' : id_pinjaman},
                        success: function(data) {
                            table3.ajax.reload();
                            table.ajax.reload();
                            $('#modal_carosel_2').modal('hide');
                            $('#modal_carosel').modal('show');
                            Toast.fire({
                                icon: 'success',
                                title: 'Berhasil update data'
                            });
                        },
                        error: function(data, exception){
                            Toast.fire({
                                icon: 'error',
                                title: exception
                            });
                        }
                    });
            });
            function formatRupiah(angka, prefix){
                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split   		= number_string.split(','),
                    sisa     		= split[0].length % 3,
                    rupiah     		= split[0].substr(0, sisa),
                    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        
                    // tambahkan titik jika yang di input sudah menjadi angka ribuan
                    if(ribuan){
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }
        
                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
                }
        
                function clearData()
            {
                $('#id').val('');
                $('#rupiah').val('');
                $('#jangka_waktu').val('');
                $('#tujuan').val('');

            }

        }); 
    </script>
    @else
    <script>
        $(document).ready(function() {
        
            var myData ={};

        var table = $('#dataTable2').DataTable({
            ajax: {
                url: `/admin/tabel-anggota-pinjaman/angsuran`,
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'id' : `{{$anggota->id}}`},
                dataSrc: 'data',
            },
            columns: [
                {
                    data:null,"sortable": false, 
                                   render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }  
                },
                {
                    data: 'jumlah_pinjman_diajukan',
                },
                {
                    data: function(data, catatan, row) {
                            return `${data.bunga} %`
                        },
                },
                {
                    data: function(data, catatan, row) {
                            return `${data.jangka_waktu} bulan`
                        },
                },
                {
                    data: function(data, catatan, row) {
                        if(data.lunas == 1){return '<span class="badge badge-success">lunas</span>'}else{return '<span class="badge badge-danger">belom lunas</span>'}
                        },
                },
                
            ],         
            aoColumnDefs: [{
                    targets: 5,
                    data: 'id',
                    "render": function(data, catatan, row) {
            
                                return `
                                <a class="" href="#" id="btn_show" data-id="${data}"><i class="fas fa-edit" ></i></a>
                                `;
                        
                    }
                }, ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
            
        });

        $('#dataTable2 tbody').on('click', '#btn_show', function(e) {
            e.preventDefault();

            var id_query = this.getAttribute('data-id');
            myData.id = id_query;
            table3.ajax.reload();
            $('#modal_carosel').modal('show');
        });

        var table3 = $('#dataTable3').DataTable({
                    ajax: {
                        url: `/admin/tabel-anggota-pinjaman/angsuran/data`,
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: function ( d ) {
                            return  $.extend(d, myData);
                        },
                        dataSrc: 'data',
                    },
                    columns: [
                        {
                            data:null,"sortable": false, 
                                   render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }  
                        },
                        {
                            data: function(data, catatan, row) {
                            return moment(`${data.tanggal_jatuh_tempo}`).format('DD-MM-YYYY');
                            }
                        },
                        {
                            data: function(data, catatan, row) {
                            return moment(`${data.updated_at}`).format('DD-MM-YYYY');
                             }
                        },
                        {
                            data: function(data, catatan, row) {
                                    return formatRupiah(`${data.angsuran}`,'Rp. ');
                                },
                        },
                        {
                            data: function(data, catatan, row) {
                                    if(data.lunas == 1){return '<span class="badge badge-success">sudah bayar</span>'}else{return '<span class="badge badge-danger">belom bayar</span>'}
                                },
                        },
                        
                    ],         
                    aoColumnDefs: [{
                            targets: 5,
                            data: 'id',
                            "render": function(data, catatan, row) {
                    
                        
                                    return `
                                    `;
                                
                            }
                        }, ],
                        
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                    
                });

                $('#dataTable3 tbody').on('click', '#btn_edit', function(e) {
                e.preventDefault();
                clearData();
                aksi_status = false;

                var id = this.getAttribute('data-id');
                var nama = this.getAttribute('data-nama');
                var nik = this.getAttribute('data-nik');
                var angsuran = this.getAttribute('data-angsuran');
                var pengajuan = this.getAttribute('data-pengajuan');
                var tanggal_jatuh_tempo = this.getAttribute('data-tanggal-tempo');
        
                $('#id').val(id);
                $('#nama').val(nama);
                $('#nik').val(nik);
                $('#angsuran').val(formatRupiah(angsuran, 'Rp. '));
                $('#tanggal_jatuh_tempo').val(moment(tanggal_jatuh_tempo).format('DD-MM-YYYY'));
    
                
                $('#modal_carosel').modal('hide');
                $('#modal_carosel_2').modal('show');
        });

        function formatRupiah(angka, prefix){
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split   		= number_string.split(','),
                sisa     		= split[0].length % 3,
                rupiah     		= split[0].substr(0, sisa),
                ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
    
                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if(ribuan){
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }
    
                rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            }
    
            function clearData()
        {
            $('#id').val('');
            $('#rupiah').val('');
            $('#jangka_waktu').val('');
            $('#tujuan').val('');

        }

    }); 
</script>
    @endif
 
@endsection