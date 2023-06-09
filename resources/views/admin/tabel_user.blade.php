@extends('admin.master')
@section('judul','Tabel User')
    
@section('konten')
<style>
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
    .red-star{
        color: red
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data User</h1>
    <p class="mb-4">Di halaman ini anda dapat menambahkan data User</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel</h6>
        </div>
        <div class="card-body">

            @if (auth()->user()->role == "superadmin")
             <div class="d-flex justify-content-end mb-2 mt-2">
                <div><button type="button" class="btn btn-primary" id="tambah_carosel">Tambah User</button></div>
              </div>
            @endif
          

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>nik</th>
                            <th>nama</th>
                            <th>nomer telpon</th>
                            <th>jabatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>nik</th>
                            <th>nama</th>
                            <th>nomer telpon</th>
                            <th>jabatan</th>
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
            <h5 class="modal-title" id="exampleModalLongTitle">User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 text-center mb-2">
                    <img src="/storage/" id="img_view" alt="" class="img-fluid" srcset="">
                </div>
                <form id="form_carosel">
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK <a class="red-star">*</a></label>
                        <input type="hidden" re class="form-control"  id="id" name="id" aria-describedby="judul">
                        <input type="hidden" re class="form-control"  id="foto_lama" name="foto_lama" aria-describedby="judul">
                        <input type="number" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} class="form-control" required id="nik" name="nik" aria-describedby="judul">
                      </div>
                    <div class="mb-3">
                        <label for="npwp" class="form-label">NPWP</label>
                        <input type="text" class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} id="npwp" name="npwp" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk <a class="red-star">*</a></label>
                        <input type="date" class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} required id="tanggal_masuk" name="tanggal_masuk" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama <a class="red-star">*</a></label>
                        <input type="text" class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} required id="nama" name="nama" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <a class="red-star">*</a></label>
                        <input type="email" class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} required id="email" name="email" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir <a class="red-star">*</a></label>
                        <input type="text" class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} required id="tempat_lahir" name="tempat_lahir" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir <a class="red-star">*</a></label>
                        <input type="date" class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }}  required id="tanggal_lahir" name="tanggal_lahir" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin <a class="red-star">*</a></label>
                        <select class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} required name="jenis_kelamin" id="jenis_kelamin">
                            <option value="">-- Pilih --</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nomer_telpon" class="form-label">Nomer Telpon <a class="red-star">*</a></label>
                        <input type="number" class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }}  required id="nomer_telpon" name="nomer_telpon" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <a class="red-star">*</a></label>
                        <textarea name="alamat" class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} id="alamat" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }}  id="foto" name="foto" aria-describedby="foto">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role <a class="red-star">*</a></label>
                        <select class="form-control" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} required name="role" id="role">
                            <option value="">-- Pilih --</option>
                            <option value="superadmin">Admin</option>
                            <option value="pengawas">Pengawas</option>
                            <option value="ketua">Ketua</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Status <a class="red-star">*</a></label>
                        <div class="form-check">
                            <input class="form-check-input"  {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} type="radio" value="1" name="status" id="radio_1">
                            <label class="form-check-label" for="radio_1">
                              Aktif
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input"  {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} type="radio" value="0" name="status" id="radio_2" checked>
                            <label class="form-check-label" for="radio_2">
                              Tidak Aktif
                            </label>
                          </div>
                    </div>
                    @if (auth()->user()->role == "superadmin" )
                        <div class="mb-3">
                            <label for="Password"  class="form-label">Password <a id="star_edit_2"></a></label>
                            <input type="password" {{ auth()->user()->role == "superadmin"  ? '' :  'disabled' }} class="form-control" id="password" name="password" aria-describedby="judul">
                        </div>
                    @endif
                    @csrf
                    <div class="text-right"><a class="red-star">*</a> Wajib diisi</div>
            </div>
            <div class="modal-footer">
                @if (auth()->user()->role == "superadmin" )
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                    <button type="submit" id="btn_simpan" class="btn btn-primary">Simpan</button>
                @endif

        </form>
            </div>
        </div>
        </div>
    </div>


</div>
    <script src="/assets/moment.min.js"></script>
    @if (auth()->user()->role == "superadmin")
    <script>
         $(document).ready(function() {
            var aksi_status = true;

            var table = $('#dataTable2').DataTable({
            ajax: {
                url: `/admin/tabel-user/data`,
                dataSrc: 'data',
            },
            columns: [
                {
                    data: 'nik',
                },
                {
                    data: 'nama',
                },
                {
                    data: 'nomor_hp',
                },
                {
                    data: 'role',
                }
            ],         
            aoColumnDefs: [{
                    targets: 4,
                    data: 'id',
                    "render": function(data, catatan, row) {
                            return `
                            <a class="" href="#" id="btn_edit" data-id="${data}" 
                            data-nik="${row.nik}" data-npwp="${row.npwp}"
                             data-nama="${row.nama}" data-email="${row.email}" 
                             data-ttl="${row.tanggal_lahir}" 
                             data-kelamin="${row.jenis_kelamin}" 
                             data-tlpn="${row.nomor_hp}" 
                             data-alamat="${row.alamat}" 
                             data-foto="${row.image}" 
                             data-role="${row.role}" 
                             data-tanggal-masuk="${row.tanggal_masuk}" 
                             data-tempat-lahir="${row.tempat_lahir}" 
                             data-status="${row.is_active}" 
                             ><i class="fas fa-edit" ></i></a>
                            <a class="" href="#" id="btn_deleted" data-id="${data}"  ><i class="fas fa-trash" ></i></a>
                            `;
                        }
                    }, ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
                
            });
                
    $('#dataTable2 tbody').on('click', '#btn_deleted', function(e) {
        e.preventDefault();
        var id = this.getAttribute('data-id');
        Swal.fire({
        title: 'Apa kamu yakin ingin hapus data ini?',
        text: "Data akan hilang setelah dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya hapus data ini!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                    url: "/admin/tabel-user/hapus",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {'id' : id},
                    success: function(data) {
                        table.ajax.reload();
                        $('#modal_carosel').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Berhasil hapus data'
                        });
                    },
                    error: function(data, exception){
                        Toast.fire({
                            icon: 'error',
                            title: exception
                        });
                    }
                });
        }
        });
    
    });


$('#dataTable2 tbody').on('click', '#btn_edit', function(e) {
        e.preventDefault();
        clearData();
        aksi_status = false;

        var id = this.getAttribute('data-id');
        var nik = this.getAttribute('data-nik');
        var npwp = this.getAttribute('data-npwp');
        var nama = this.getAttribute('data-nama');
        var email = this.getAttribute('data-email');
        var ttl = this.getAttribute('data-ttl');
        var kelamin = this.getAttribute('data-kelamin');
        var tlpn = this.getAttribute('data-tlpn');
        var alamat = this.getAttribute('data-alamat');
        var foto = this.getAttribute('data-foto');
        var role = this.getAttribute('data-role');
        var tanggal_masuk = this.getAttribute('data-tanggal-masuk');
        var tempat_lahir = this.getAttribute('data-tempat-lahir');
        var status = this.getAttribute('data-status');

        if(status == 0){
            $('#radio_1').prop("checked", false);
            $('#radio_2').prop("checked", true);
        }else{
            $('#radio_1').prop("checked", true);
            $('#radio_2').prop("checked", false);
        }

        $(`#star_edit_2`).html(``);
        
        $('#id').val(id);
        $('#foto_lama').val(foto);
        $('#nik').val(nik);
        $('#npwp').val(npwp);
        $('#nama').val(nama);
        $('#email').val(email);
        $('#tanggal_lahir').val(ttl);
        $('#jenis_kelamin').val(kelamin);
        $('#nomer_telpon').val(tlpn);
        $('#alamat').val(alamat);
        $('#role').val(role);
        $('#tanggal_masuk').val(tanggal_masuk);
        $('#tempat_lahir').val(tempat_lahir);
        $('#img_view').attr(`src`,`/storage/${foto}`);
        
        $('#modal_carosel').modal('show');
        });

        $('#tambah_carosel').click(function(e){
            e.preventDefault();
            aksi_status = true;
            $('#modal_carosel').modal('show');
            clearData();
            $(`#star_edit_2`).html(`<a class="red-star">*</a>`);
        });
        $('#form_carosel').submit(function(e){
            e.preventDefault();
            var data = new FormData(this);
            if(aksi_status){
                $.ajax({
                    url: "/admin/tabel-user/tambah",
                    method: "POST",
                    data:  data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        table.ajax.reload();
                        $('#modal_carosel').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Simpan Berhasil'
                        });
                    },
                    error: function(data){
                        console.log(data);
                        Toast.fire({
                            icon: 'error',
                            title: data['responseJSON']['message']
                        });
                    }
                });
            }else{
                $.ajax({
                    url: "/admin/tabel-user/edit",
                    method: "POST",
                    data:  data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        table.ajax.reload();
                        $('#modal_carosel').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Simpan Berhasil'
                        });
                    },
                    error: function(data){
                        Toast.fire({
                            icon: 'error',
                            title: data['responseJSON']['message']
                        });
                    }
                });
            }


        });

        function clearData()
        {
            $('#id').val('');
            $('#foto_lama').val('');
            $('#nik').val('');
            $('#npwp').val('');
            $('#nama').val('');
            $('#email').val('');
            $('#tanggal_lahir').val('');
            $('#jenis_kelamin').val('');
            $('#nomer_telpon').val('');
            $('#alamat').val('');
            $('#foto').val('');
            $('#role').val('');
            $('#password').val('');
            $('#tanggal_masuk').val('');
            $('#tempat_lahir').val('');
            $('#img_view').attr(`src`,`/storage/}`);
            $('#radio_1').prop("checked", false);
            $('#radio_2').prop("checked", false);
        }
                    }); 
            </script>
        @else
<script>
    $(document).ready(function() {
       var table = $('#dataTable2').DataTable({
       ajax: {
           url: `/admin/tabel-user/data`,
           dataSrc: 'data',
       },
       columns: [
           {
               data: 'nik',
           },
           {
               data: 'nama',
           },
           {
               data: 'nomor_hp',
           },
           {
               data: 'role',
           }
       ],         
       aoColumnDefs: [{
               targets: 4,
               data: 'id',
               "render": function(data, catatan, row) {
                       return `
                       <a class="" href="#" id="btn_edit" data-id="${data}" 
                            data-nik="${row.nik}" data-npwp="${row.npwp}"
                             data-nama="${row.nama}" data-email="${row.email}" 
                             data-ttl="${row.tanggal_lahir}" 
                             data-kelamin="${row.jenis_kelamin}" 
                             data-tlpn="${row.nomor_hp}" 
                             data-alamat="${row.alamat}" 
                             data-foto="${row.image}" 
                             data-role="${row.role}" 
                             data-tanggal-masuk="${row.tanggal_masuk}" 
                             data-tempat-lahir="${row.tempat_lahir}" 
                             data-status="${row.is_active}" 
                             ><i class="fas fa-edit" ></i></a>
                       `;
                   }
               }, ],
           dom: 'Bfrtip',
           buttons: [
               'copy', 'csv', 'excel', 'pdf', 'print'
           ]
           
       });


  
    $('#dataTable2 tbody').on('click', '#btn_edit', function(e) {
            e.preventDefault();
            clearData();
            aksi_status = false;

            var id = this.getAttribute('data-id');
            var nik = this.getAttribute('data-nik');
            var npwp = this.getAttribute('data-npwp');
            var nama = this.getAttribute('data-nama');
            var email = this.getAttribute('data-email');
            var ttl = this.getAttribute('data-ttl');
            var kelamin = this.getAttribute('data-kelamin');
            var tlpn = this.getAttribute('data-tlpn');
            var alamat = this.getAttribute('data-alamat');
            var foto = this.getAttribute('data-foto');
            var role = this.getAttribute('data-role');
            var tanggal_masuk = this.getAttribute('data-tanggal-masuk');
            var tempat_lahir = this.getAttribute('data-tempat-lahir');
            var status = this.getAttribute('data-status');

            if(status == 0){
                $('#radio_1').prop("checked", false);
                $('#radio_2').prop("checked", true);
            }else{
                $('#radio_1').prop("checked", true);
                $('#radio_2').prop("checked", false);
            }
            
            $('#id').val(id);
            $('#foto_lama').val(foto);
            $('#nik').val(nik);
            $('#npwp').val(npwp);
            $('#nama').val(nama);
            $('#email').val(email);
            $('#tanggal_lahir').val(ttl);
            $('#jenis_kelamin').val(kelamin);
            $('#nomer_telpon').val(tlpn);
            $('#alamat').val(alamat);
            $('#role').val(role);
            $('#tanggal_masuk').val(tanggal_masuk);
            $('#tempat_lahir').val(tempat_lahir);
            $('#img_view').attr(`src`,`/storage/${foto}`);
            
            $('#modal_carosel').modal('show');
    });


        function clearData()
        {
            $('#id').val('');
            $('#foto_lama').val('');
            $('#nik').val('');
            $('#npwp').val('');
            $('#nama').val('');
            $('#email').val('');
            $('#tanggal_lahir').val('');
            $('#jenis_kelamin').val('');
            $('#nomer_telpon').val('');
            $('#alamat').val('');
            $('#foto').val('');
            $('#role').val('');
            $('#password').val('');
            $('#tanggal_masuk').val('');
            $('#tempat_lahir').val('');
            $('#img_view').attr(`src`,`/storage/}`);
            $('#radio_1').prop("checked", false);
            $('#radio_2').prop("checked", false);
        }
       }); 
</script>
@endif



@endsection