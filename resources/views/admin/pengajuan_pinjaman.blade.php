@extends('admin.master')
@section('judul','Tabel Pengajuan')

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
    <h1 class="h3 mb-2 text-gray-800">Data Pengajuan </h1>
    <p class="mb-4">Di halaman ini anda dapat melihat Pengajuan</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pengajuan</h6>
        </div>
        <div class="card-body">


            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>nama</th>
                            <th>jumlah Pinjaman</th>
                            <th>bunga</th>
                            <th>jangka waktu</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>nama</th>
                            <th>jumlah Pinjaman</th>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Pengajuan</h5>
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
                           <input type="text" disabled required class="form-control"  id="nama" name="nama" aria-describedby="judul">
                      </div>
                    <div class="mb-3">
                        <label for="rupiah" class="form-label">Jumlah Pengajuan</label>
                        <input type="text" disabled required class="form-control"  id="rupiah" name="rupiah" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="bunga" class="form-label">Bunga</label>
                        <div class="input-group mb-3">
                            <input type="text" required disabled class="form-control" name="bunga" id="bunga" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                          </div>
                    </div>
                    <div class="mb-3">
                        <label for="jangka_waktu" class="form-label">Jangka Waktu</label>
                        <select class="form-control" disabled required name="jangka_waktu" id="jangka_waktu">
                            <option value="">-- Pilih --</option>
                            <option value="1">1 bulan</option>
                            <option value="3">3 bulan</option>
                            <option value="6">6 bulan</option>
                            <option value="12">12 bulan</option>
                            <option value="24">24 bulan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tujuan"    class="form-label">Tujuan Pengajuan</label>
                        <textarea name="tujuan"required disabled class="form-control"  id="tujuan" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="alamat"    class="form-label">Alamat</label>
                        <textarea name="alamat"required disabled class="form-control"  id="alamat" cols="30" rows="10"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="no_telpon"    class="form-label">Nomer Telpon</label>
                        <input type="text" disabled required class="form-control"  id="no_telpon" name="no_telpon" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label  for="email"    class="form-label">Email</label>
                        <input type="email" disabled required class="form-control"  id="email" name="email" aria-describedby="judul">
                    </div>
                    @csrf
            </div>
            <div class="modal-footer justify-content-center">
                @if (auth()->user()->role == "ketua" )
                <div id="btn_status">
                    <button id="btn_acc" class="btn btn-success">Setujui</button>
                    <button id="btn_tolak" class="btn btn-primary">Tolak</button>
                </div>
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
            url: `/admin/tabel-ketua-pengajuan/data`,
            dataSrc: 'data',
        },
        columns: [
            {
                data: 'name',
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
                        return `${data.jangka_waktu} Bulan`
                    },
            },
            {
                data: function(data, catatan, row) {

                        if(data.acc == 3){
                            return 'Rekomendasi';
                        }
                    }
            }

        ],
         aoColumnDefs: [{
                targets: 5,
                data: 'id',
                "render": function(data, catatan, row) {
                        return `
                            <a class="" href="#"  id="btn_edit" data-id="${data}"
                            data-id-anggota="${row.id_nama_anggota}"
                            data-bunga="${row.bunga}"
                            data-name="${row.name}"
                            data-jumlah-pinjaman="${row.jumlah_pinjman_diajukan}"
                            data-jangka-waktu="${row.jangka_waktu}"
                            data-tujuan="${row.tujuan_pinjaman}"
                            data-alamat="${row.alamat}"
                            data-nomor-hp="${row.nomor_hp}"
                            data-email="${row.email}"
                            data-acc="${row.acc}"
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
            var bunga = this.getAttribute('data-bunga');
            var nama = this.getAttribute('data-name');
            var pinjaman = this.getAttribute('data-jumlah-pinjaman');
            var jangka_waktu = this.getAttribute('data-jangka-waktu');
            var tujuan = this.getAttribute('data-tujuan');
            var no_hp = this.getAttribute('data-nomor-hp');
            var alamat = this.getAttribute('data-alamat');
            var email = this.getAttribute('data-email');
            var anggota = this.getAttribute('data-id-anggota');
            var data_acc = this.getAttribute('data-acc');

            if(data_acc == 3){
                $('#btn_status').show();
            }else{
                $('#btn_status').hide();
            }

            $('#id').val(id);
            $('#id_anggota').val(anggota);
            $('#nama').val(nama);
            $('#bunga').val(bunga);
            $('#rupiah').val(pinjaman);
            $('#jangka_waktu').val(jangka_waktu);
            $('#tujuan').val(tujuan);
            $('#alamat').val(alamat);
            $('#no_telpon').val(no_hp);
            $('#email').val(email);


            $('#modal_carosel').modal('show');
    });

    function test()
    {
        console.log();
    }

    $('#tambah_carosel').click(function(e){
        e.preventDefault();
        aksi_status = true;
        $('#modal_carosel').modal('show');
        clearData();
    });
    $('#btn_acc').click(function(e){
        e.preventDefault();

        var id =  $('#id').val();
        var waktu =  $('#jangka_waktu').val();
        var rupiah =  $('#rupiah').val();
        var id_anggota =  $('#id_anggota').val();

        $.ajax({
                url: "/admin/tabel-ketua-pengajuan/acc",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'id' : id, 'status' : 'acc', 'waktu' : waktu, 'rupiah' : rupiah, 'id_anggota' : id_anggota },
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
    $('#btn_tolak').click(function(e){
        e.preventDefault();

        var id =  $('#id').val();

        $.ajax({
                url: "/admin/tabel-ketua-pengajuan/acc",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {'id' : id, 'status' : 'tolak'},
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
