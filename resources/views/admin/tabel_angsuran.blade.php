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
                            <th>angsuran</th>
                            <th>tanggal jatuh tempo</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>nik</th>
                            <th>nama</th>
                            <th>angsuran</th>
                            <th>tanggal jatuh tempo</th>
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
                <form id="form_carosel">
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nama</label>
                        <input type="hidden"  class="form-control"  id="id" name="id" aria-describedby="judul">
                        <input type="text" disabled  class="form-control"  id="nama" name="nama" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" disabled  class="form-control"  id="nik" name="nik" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="rupiah" class="form-label">Total Pinjaman</label>
                        <input type="text" disabled  class="form-control"  id="rupiah" name="rupiah" aria-describedby="judul">
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
    <script>
       $(document).ready(function() {
        var aksi_status = true;

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
            url: `/admin/tabel-angsuran/data`,
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
                        return formatRupiah(`${data.angsuran}`, 'Rp. ')
                    },
            },
            {
                data: function(data, catatan, row) {
                        return moment(`${data.tanggal_jatuh_tempo}`).format('DD-MM-YYYY');
                    }
            },
            {
                data: function(data, catatan, row) {
                    if(data.lunas == 0){
                        return 'Belom Bayar';
                    }else{
                        return 'Lunas';
                    }
                }
            }
            
        ],         
         aoColumnDefs: [{
                targets: 5,
                data: 'id',
                "render": function(data, catatan, row) {
                      if(row.lunas == 0){
                            return `
                            <a class="" href="#"  id="btn_edit" data-id="${data}" data-nama="${row.nama}" data-pengajuan="${row.jumlah_pinjman_diajukan}"  data-nik="${row.nik}" data-angsuran="${row.angsuran}" data-tanggal-tempo="${row.tanggal_jatuh_tempo}" ><i class="fas fa-edit" ></i></a>
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

    $('#dataTable2 tbody').on('click', '#btn_edit', function(e) {
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
            $('#rupiah').val(pengajuan);
            $('#tanggal_jatuh_tempo').val(moment(tanggal_jatuh_tempo).format('DD-MM-YYYY'));
  
            
            $('#modal_carosel').modal('show');
    });
    
    $('#tambah_carosel').click(function(e){
        e.preventDefault();
        aksi_status = true;
        $('#modal_carosel').modal('show');
        clearData();
    });

      
    $('#btn_lunas').click(function(e){
        e.preventDefault();
        var id =  $('#id').val();

        $.ajax({
                url: "/admin/tabel-angsuran/bayar",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'id' : id, 'status' : 'lunas'},
                success: function(data) {
                    table.ajax.reload();
                    $('#modal_carosel').modal('hide');
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
    function clearData()
    {
        $('#id').val('');
        $('#rupiah').val('');
        $('#jangka_waktu').val('');
        $('#tujuan').val('');

    }
}); 
    </script>
@endsection