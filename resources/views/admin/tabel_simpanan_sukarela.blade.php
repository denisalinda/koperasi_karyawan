@extends('admin.master')
@section('judul','Tabel Simpanan Sukarela')
    
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
    <h1 class="h3 mb-2 text-gray-800">Data Simpanan Sukarela</h1>
    <p class="mb-4">Di halaman ini anda dapat melihat Simpanan Sukarela</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Simpanan Sukarela</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>nik</th>
                            <th>nama</th>
                            <th>saldo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>nik</th>
                            <th>nama</th>
                            <th>saldo</th>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Setor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="form_carosel">
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nama</label>
                        <input type="hidden"  class="form-control"  id="id" name="id" aria-describedby="judul">
                        <input type="hidden"  class="form-control"  id="id_anggota" name="id_anggota" aria-describedby="judul">
                        <input type="hidden"  class="form-control" value="sukarela"  id="jenis_simpanan" name="jenis_simpanan" aria-describedby="judul">
                        <input type="text" disabled class="form-control"  id="nama" name="nama" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="rupiah" class="form-label">Jumlah Setor</label>
                        <input type="text" required class="form-control" {{ auth()->user()->role == "bendahara"  ? '' :  'disabled' }}  id="rupiah" name="rupiah" aria-describedby="judul">
                    </div>
                    @csrf
            </div>
            <div class="modal-footer">
                @if (auth()->user()->role == "bendahara")
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                    <button type="submit" id="btn_simpan" class="btn btn-primary">Simpan</button>
                @endif
        </form>
            </div>
        </div>
        </div>
    </div>
     <!-- Modal -->
     <div class="modal  fade" id="modal_tarik" tabindex="-1" role="dialog" aria-labelledby="modal_carosel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tarik</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="form_tarik">
                    <div class="mb-3">
                        <label for="nama_tarik" class="form-label">Nama</label>
                        <input type="hidden"  class="form-control"  id="id_tarik" name="id_tarik" aria-describedby="judul">
                        <input type="hidden"  class="form-control"  id="id_anggota_tarik" name="id_anggota_tarik" aria-describedby="judul">
                        <input type="hidden"  class="form-control" value="sukarela"  id="jenis_simpanan" name="jenis_simpanan" aria-describedby="judul">
                        <input type="text" disabled class="form-control"  id="nama_tarik" name="nama_tarik" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="rupiah_tarik" class="form-label">Jumlah Tarik<a class="red-star">*</a></label>
                        <input type="text" required class="form-control" {{ auth()->user()->role == "bendahara"  ? '' :  'disabled' }}  id="rupiah_tarik" name="rupiah_tarik" aria-describedby="judul">
                    </div>
                    @csrf
                    <div class="text-right"><a class="red-star">*</a> Wajib diisi</div>
            </div>
            <div class="modal-footer">
            @if (auth()->user()->role == "bendahara")
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
    <script>
       $(document).ready(function() {
        var aksi_status = true;

        var rupiah_tarik = document.getElementById('rupiah_tarik');
		rupiah_tarik.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah_tarik.value = formatRupiah(this.value, 'Rp. ');
		});
        var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
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

        $('#nama_anggota').select2({
            dropdownParent: $('#modal_carosel')
        });

    var table = $('#dataTable2').DataTable({
        ajax: {
            url: `/admin/tabel-simpanan-sukarela/data`,
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
                data: function(data, catatan, row) {
                        return formatRupiah(`${data.saldo}`, 'Rp. ')
                    },
            }
            
        ],         
         aoColumnDefs: [{
                targets: 3,
                data: 'id',
                "render": function(data, catatan, row) {

                            return `
                            <a class="" href="#"  id="btn_setor" data-id="${data}" data-id-anggota="${row.id_anggota}" data-nama="${row.nama}"   ><i class="fas fa-edit" ></i></a>
                            ||
                            <a class="" href="#" id="btn_tarik" data-id="${data}"  data-id-anggota="${row.id_anggota}" data-nama="${row.nama}" ><i class="fas fas fa-dollar-sign" ></i></a>
                            `;
                 
                }
            }, ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        
    });


    $('#dataTable2 tbody').on('click', '#btn_setor', function(e) {
            e.preventDefault();
            clearData();
            aksi_status = false;

            var id = this.getAttribute('data-id');
            var nama = this.getAttribute('data-nama');
            var id_anggota = this.getAttribute('data-id-anggota');

       
            $('#id').val(id);
            $('#nama').val(nama);
            $('#id_anggota').val(id_anggota);

            
            $('#modal_carosel').modal('show');
    });
    $('#dataTable2 tbody').on('click', '#btn_tarik', function(e) {
            e.preventDefault();
            clearData();
            aksi_status = false;

            var id = this.getAttribute('data-id');
            var nama = this.getAttribute('data-nama');
            var id_anggota = this.getAttribute('data-id-anggota');

       
            $('#id_tarik').val(id);
            $('#nama_tarik').val(nama);
            $('#rupiah_tarik').val('');
            $('#id_anggota_tarik').val(id_anggota);

            $('#modal_tarik').modal('show');
    });

    $('#form_carosel').submit(function(e){
        e.preventDefault();
        var data = new FormData(this);
            $.ajax({
                url: "/admin/tabel-simpanan/setor",
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
    });
    $('#form_tarik').submit(function(e){
        e.preventDefault();
        var data = new FormData(this);
            $.ajax({
                url: "/admin/tabel-simpanan/tarik",
                method: "POST",
                data:  data,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data.data);
                    if(data.data == "sukses"){
                        table.ajax.reload();
                        $('#modal_tarik').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: 'Tarik Saldo Berhasil'
                        });
                    }else{
                        Toast.fire({
                            icon: 'error',
                            title: 'Saldo Tidak Cukup'
                        });
                    }
                
                },
                error: function(data){
                    console.log(data);
                    Toast.fire({
                        icon: 'error',
                        title: data['responseJSON']['message']
                    });
                }
            });
    });
    
    function clearData()
    {
        $('#id').val('');
        $('#rupiah').val('');
        $('#nama').val('');

    }
}); 
    </script>
@endsection