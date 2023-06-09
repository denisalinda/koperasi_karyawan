@extends('admin.master')
@section('judul','Tabel Rekomendasi')

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
    <h1 class="h3 mb-2 text-gray-800">Data Rekomendasi </h1>
    <p class="mb-4">Di halaman ini anda dapat menambahkan Rekomendasi</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Rekomendasi</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>nik</th>
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
                            <th>nik</th>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Rekomendasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="form_carosel">
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nama <a class="red-star">*</a></label>
                        <input type="hidden" required class="form-control"   id="id" name="id" aria-describedby="judul">
                        <input type="text" required class="form-control" disabled  id="nama" name="nama" aria-describedby="judul">
                      </div>
                    <div class="mb-3">
                        <label for="rupiah" class="form-label">Jumlah Pengajuan <a class="red-star">*</a></label>
                        <input type="text" required class="form-control"  disabled id="rupiah" name="rupiah" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="bunga" class="form-label">Bunga <a class="red-star">*</a></label>
                        <div class="input-group mb-3">
                            <input type="text" required disabled class="form-control" name="bunga" id="bunga" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                          </div>
                    </div>
                    <div class="mb-3">
                        <label for="jangka_waktu" class="form-label">Jangka Waktu <a class="red-star">*</a></label>
                        <select class="form-control" required disabled name="jangka_waktu" id="jangka_waktu">
                            <option value="">-- Pilih --</option>
                            <option value="1">1 bulan</option>
                            <option value="3">3 bulan</option>
                            <option value="6">6 bulan</option>
                            <option value="12">12 bulan</option>
                            <option value="24">24 bulan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tujuan"   class="form-label">Tujuan Pengajuan  <a class="red-star">*</a></label>
                        <textarea name="tujuan" required disabled class="form-control"  id="tujuan" cols="30" rows="10"></textarea>
                    </div>
                    @csrf
                    <div class="text-right"><a class="red-star">*</a> Wajib diisi</div>
            </div>
            <div class="modal-footer justify-content-center">
                @if (auth()->user()->role == "pengawas")
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">tutup</button>
                    <button type="submit" id="btn_rek" class="btn btn-success">Rekomendasi</button>
                    <button type="submit" id="btn_tolak" class="btn btn-primary">Tolak</button>
                @endif
        </form>
            </div>
        </div>
        </div>
    </div>



</div>
    <script src="/assets/moment.min.js"></script>
    @if (auth()->user()->role == "pengawas")
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
                        url: `/admin/tabel-rekomendasi/data`,
                        dataSrc: 'data',
                    },
                    columns: [
                        {
                            data: 'nik',
                        },
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
                                if(data.acc == 0){
                                        return 'Belom Acc';
                                    } else if (data.acc == 2) {
                                        return 'Di tolak';
                                    }else if(data.acc == 3){
                                        return 'Pengajuan';
                                    }else if(data.acc == 4){
                                        return 'Sudah Cair';
                                    }else{
                                        return 'Acc';
                                    }
                                }
                        }

                    ],
                    aoColumnDefs: [{
                            targets: 6,
                            data: 'id',
                            "render": function(data, catatan, row) {

                                        return `
                                        <a class="" href="#"  id="btn_edit" data-id="${data}"
                                        data-name="${row.id_nama_anggota}"
                                        data-bunga="${row.bunga}"
                                        data-nama="${row.name}"
                                         data-jumlah-pinjaman="${row.jumlah_pinjman_diajukan}"
                                          data-jangka-waktu="${row.jangka_waktu}"
                                           data-tujuan="${row.tujuan_pinjaman}"
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
                        var data_nama = this.getAttribute('data-nama');
                        var pinjaman = this.getAttribute('data-jumlah-pinjaman');
                        var jangka_waktu = this.getAttribute('data-jangka-waktu');
                        var tujuan = this.getAttribute('data-tujuan');

                        $('#id').val(id);
                        $('#nama').val(data_nama);
                        $('#bunga').val(bunga);
                        $('#rupiah').val(pinjaman);
                        $('#jangka_waktu').val(jangka_waktu);
                        $('#tujuan').val(tujuan);

                        $('#modal_carosel').modal('show');
                });


                // $('#form_carosel').submit(function(e){
                //     e.preventDefault();
                //         $.ajax({
                //             url: "/admin/tabel-rekomendasi/aksi",
                //             method: "POST",
                //             data:  new FormData(this),
                //             processData: false,
                //             contentType: false,
                //             success: function(data) {
                //                 table.ajax.reload();
                //                 $('#modal_carosel').modal('hide');
                //                 Toast.fire({
                //                     icon: 'success',
                //                     title: 'Simpan Berhasil'
                //                 });
                //             },
                //             error: function(data){
                //                 console.log(data);
                //                 Toast.fire({
                //                     icon: 'error',
                //                     title: data['responseJSON']['message']
                //                 });
                //             }
                //         });

                // });

                $('#btn_rek').click(function(e){
                    e.preventDefault();
                   var id = $('#id').val();
                   $.ajax({
                            url: "/admin/tabel-rekomendasi/aksi",
                            method: "POST",
                            headers: {
                                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                     },
                            data:  {'id' : id},
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

                $('#btn_tolak').click(function(e){
                    e.preventDefault();
                   var id = $('#id').val();
                   $.ajax({
                            url: "/admin/tabel-rekomendasi/tolak",
                            method: "POST",
                            headers: {
                                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                     },
                            data:  {'id' : id},
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
                        url: `/admin/tabel-rekomendasi/data`,
                        dataSrc: 'data',
                    },
                    columns: [
                        {
                            data: 'nik',
                        },
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
                                if(data.acc == 0){
                                        return 'Belom Acc';
                                    } else if (data.acc == 2) {
                                        return 'Di tolak';
                                    }else if(data.acc == 3){
                                        return 'Pengajuan';
                                    }else if(data.acc == 4){
                                        return 'Sudah Cair';
                                    }else{
                                        return 'Acc';
                                    }
                                }
                        }

                    ],
                    aoColumnDefs: [{
                            targets: 6,
                            data: 'id',
                            "render": function(data, catatan, row) {
                                if(row.acc == 4){
                                    return `
                                    <a class="" href="#"  id="btn_bukti"
                                        data-id="${data}"
                                        data-tanggal="${row.tanggal_pencarian}"
                                        data-bukti="${row.bukti_pencairan}"
                                        data-melalui="${row.pencairan_melalui}"
                                        ><i  class="fas fas fa-dollar-sign" ></i></a>
                                    `;
                                }else{
                                    return `
                                        <a class="" href="#"  ><i style="color: grey" class="fas fa-edit" ></i></a>
                                        <a class="" href="#"  ><i style="color: grey" class="fas fa-trash" ></i></a>
                                        `;
                                }


                            }
                        }, ],
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]

                });


                $('#dataTable2 tbody').on('click', '#btn_bukti', function(e) {
                    var tanggal = this.getAttribute('data-tanggal');
                    var bukti = this.getAttribute('data-bukti');
                    var melalui = this.getAttribute('data-melalui');

                    $('#pencairan_bukti').val(melalui);
                    $('#tanggal_bukti_2').val(tanggal);
                    $('#foto_bukti').attr(`src`,`/storage/${bukti}`);

                    $('#modal_bukti').modal('show');
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
    @endif

@endsection
