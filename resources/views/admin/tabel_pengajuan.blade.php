@extends('admin.master')
@section('judul','Tabel Pengajuan')

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
    <h1 class="h3 mb-2 text-gray-800">Data Pengajuan Pinjaman </h1>
    <p class="mb-4">Di halaman ini anda dapat menambahkan Pengajuan Pinjaman</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel Pengajuan</h6>
        </div>
        <div class="card-body">

        @if (auth()->user()->role == "bendahara")
            <div class="d-flex justify-content-end mb-2 mt-2">
                 <div><button type="button" class="btn btn-primary" id="tambah_carosel">Tambah Pengajuan</button></div>
            </div>
        @endif

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
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Pengajuan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="form_carosel">
                    <div class="mb-3">
                        <label for="nik" class="form-label">Nama <a class="red-star">*</a></label>
                        <input type="hidden"  class="form-control"  id="id" name="id" aria-describedby="judul">
                        <select class="js-example-basic-single" required id="nama_anggota" name="nama_anggota">
                            @foreach ($user as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                          </select>
                      </div>
                    <div class="mb-3">
                        <label for="rupiah" class="form-label">Jumlah Pengajuan <a class="red-star">*</a></label>
                        <input type="text" required class="form-control"  id="rupiah" name="rupiah" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="persen" class="form-label">Bunga <a class="red-star">*</a></label>
                        <div class="input-group mb-3">
                            <input type="text" required class="form-control" name="persen" id="persen" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                          </div>
                    </div>
                    <div class="mb-3">
                        <label for="jangka_waktu" class="form-label">Jangka Waktu <a class="red-star">*</a></label>
                        <select class="form-control" required name="jangka_waktu" id="jangka_waktu">
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
                        <textarea name="tujuan" required class="form-control"  id="tujuan" cols="30" rows="10"></textarea>
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

         <!-- Modal Bukti Pencairan-->
         <div class="modal  fade" id="modal_pencairan" tabindex="-1" role="dialog" aria-labelledby="modal_pencairan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Bukti Pencairan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="form_pencairan">
                        <div class="mb-3">
                            <label for="tujuan"   class="form-label">Bukti Pencairan <a class="red-star">*</a></label>
                            <input type="hidden"  class="form-control"  id="id_bukti" name="id_bukti" aria-describedby="judul">
                            <input type="file" required  class="form-control"   id="bukti" name="bukti" aria-describedby="judul">
                        </div>
                        <div class="mb-3">
                            <label for="tujuan"   class="form-label">Tanggal Pencairan <a class="red-star">*</a></label>
                            <input type="date" required  class="form-control"  id="tanggal_bukti" name="tanggal_bukti" aria-describedby="judul">
                        </div>
                        <div class="mb-3">
                            <label for="tujuan"   class="form-label">Pencairan <a class="red-star">*</a></label>
                            <select class="form-control" required name="pencairan" id="pencairan">
                                <option value="">-- Pilih --</option>
                                <option value="transfer">transfer</option>
                                <option value="cash">cash</option>
                            </select>
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

         <!-- Modal Bukti Pencairan-->
         <div class="modal  fade" id="modal_bukti" tabindex="-1" role="dialog" aria-labelledby="modal_bukti" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Bukti Pencairan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form id="">
                        <div class="mb-3">
                            <label for="tujuan"   class="form-label">Bukti Pencairan</label>
                            <div class="col-md-12 text-center mb-2">
                                <img src="/storage/" id="foto_bukti" alt="" class="img-fluid" srcset="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tujuan"   class="form-label">Tanggal Pencairan</label>
                            <input type="date" disabled  class="form-control"  id="tanggal_bukti_2" name="tanggal_bukti_2" aria-describedby="judul">
                        </div>
                        <div class="mb-3">
                            <label for="tujuan"   class="form-label">Pencairan</label>
                            <select class="form-control" disabled name="pencairan_bukti" id="pencairan_bukti">
                                <option value="">-- Pilih --</option>
                                <option value="transfer">transfer</option>
                                <option value="cash">cash</option>
                            </select>
                        </div>
                        @csrf
                </div>
                <div class="modal-footer">
                    @if (auth()->user()->role == "bendahara")
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

                    var persen = document.getElementById('persen');
                    persen.addEventListener('keyup', function(e){
                        // tambahkan 'Rp.' pada saat form di ketik
                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                        persen.value = formatnumber(this.value, 'Rp. ');
                    });

                         /* Fungsi formatRupiah */
                    function formatnumber(angka, prefix){
                        var number_string = angka.replace(/[^.\d]/g, '').toString(),
                        split   		= number_string.split('.'),
                        sisa     		= split[0].length % 3,
                        persen     		= split[0].substr(0, sisa),
                        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

                        // tambahkan titik jika yang di input sudah menjadi angka ribuan
                        if(ribuan){
                            separator = sisa ? '' : '';
                            persen += separator + ribuan.join('');
                        }

                        persen = split[1] != undefined ? persen + '.' + split[1] : persen;
                        return prefix == undefined ? persen : (persen);
                    }

                    $('#nama_anggota').select2({
                        dropdownParent: $('#modal_carosel')
                    });

                var table = $('#dataTable2').DataTable({
                    ajax: {
                        url: `/admin/tabel-pengajuan/data`,
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
                                if(row.acc == 0){
                                        return `
                                        <a class="" href="#"  id="btn_edit"
                                        data-id="${data}"
                                        data-bunga="${row.bunga}"
                                        data-name="${row.id_nama_anggota}"
                                        data-jumlah-pinjaman="${row.jumlah_pinjman_diajukan}"
                                        data-jangka-waktu="${row.jangka_waktu}"
                                        data-tujuan="${row.tujuan_pinjaman}"
                                        ><i class="fas fa-edit" ></i></a>
                                        <a class="" href="#" id="btn_deleted" data-id="${data}"  ><i class="fas fa-trash" ></i></a>
                                        `;
                                    }else if(row.acc == 1){
                                        return `
                                        <a class="" href="#"  id="btn_pencairan" data-id="${data}"  ><i  class="fas fas fa-dollar-sign" ></i></a>
                                        `;
                                    }else if(row.acc == 4){
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
                $('#dataTable2 tbody').on('click', '#btn_pencairan', function(e) {

                    var id = this.getAttribute('data-id');
                    clearData2();
                    $('#id_bukti').val(id);
                    $('#modal_pencairan').modal('show');
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
                                    url: "/admin/tabel-pengajuan/hapus",
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
                        var bunga = this.getAttribute('data-bunga');
                        var nama = this.getAttribute('data-name');
                        var pinjaman = this.getAttribute('data-jumlah-pinjaman');
                        var jangka_waktu = this.getAttribute('data-jangka-waktu');
                        var tujuan = this.getAttribute('data-tujuan');

                        console.log(bunga);
                        $('#id').val(id);
                        $('#persen').val(bunga);
                        $('#nama_anggota').val(nama).trigger('change');
                        $('#rupiah').val(pinjaman);
                        $('#jangka_waktu').val(jangka_waktu);
                        $('#tujuan').val(tujuan);


                        $('#modal_carosel').modal('show');
                });

                $('#tambah_carosel').click(function(e){
                    e.preventDefault();
                    aksi_status = true;
                    $('#modal_carosel').modal('show');
                    clearData();
                });

                $('#form_pencairan').submit(function(e){
                    e.preventDefault();
                    var data = new FormData(this);
                    $.ajax({
                            url: "/admin/tabel-pengajuan/pencairan",
                            method: "POST",
                            data:  data,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                table.ajax.reload();
                                $('#modal_pencairan').modal('hide');
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

                $('#form_carosel').submit(function(e){
                    e.preventDefault();
                    var data = new FormData(this);
                    if(aksi_status){
                        $.ajax({
                            url: "/admin/tabel-pengajuan/tambah",
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
                            url: "/admin/tabel-pengajuan/edit",
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
                    $('#persen').val('');
                    $('#rupiah').val('');
                    $('#jangka_waktu').val('');
                    $('#tujuan').val('');

                }
                function clearData2()
                {
                    $('#bukti').val('');
                    $('#tanggal_bukti').val('');
                    $('#pencairan').val('');


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
                        url: `/admin/tabel-pengajuan/data`,
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
                    $('#persen').val('');
                    $('#rupiah').val('');
                    $('#jangka_waktu').val('');
                    $('#tujuan').val('');

                }
            });
        </script>
    @endif

@endsection
