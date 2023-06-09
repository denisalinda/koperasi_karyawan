@extends('admin.master')
@section('judul','Tabel Unit Usaha Jasa')
    
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
    <h1 class="h3 mb-2 text-gray-800">Unit Usaha Jasa</h1>
    <p class="mb-4">Di halaman ini anda dapat menambahkan Unit Usaha Jasa</a>.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabel</h6>
        </div>
        <div class="card-body">

            @if (auth()->user()->role == "sekretaris")
            <div class="d-flex justify-content-end mb-2 mt-2">
              <div><button type="button" class="btn btn-primary" id="tambah_carosel">Tambah Unit Usaha Jasa</button></div>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>nama</th>
                            <th>jasa</th>
                            <th>tanggal</th>
                            <th>harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>nama</th>
                            <th>jasa</th>
                            <th>tanggal</th>
                            <th>harga</th>
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
            <h5 class="modal-title" id="exampleModalLongTitle">Unit Usaha</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form id="form_carosel">
                    <div class="mb-3">
                        <label for="nama_pemesan" class="form-label">Nama <a class="red-star">*</a></label>
                        <input type="hidden" re class="form-control"  id="id" name="id" aria-describedby="judul">
                        <input type="text" class="form-control"   {{ auth()->user()->role == "sekretaris"  ? '' :  'disabled' }}  id="nama_pemesan" name="nama_pemesan" aria-describedby="judul">
                      </div>
                    <div class="mb-3">
                        <label for="jasa" class="form-label">Jasa <a class="red-star">*</a></label>
                        <input type="text" class="form-control"   {{ auth()->user()->role == "sekretaris"  ? '' :  'disabled' }}  id="jasa" name="jasa" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal <a class="red-star">*</a></label>
                        <input type="date" class="form-control"   {{ auth()->user()->role == "sekretaris"  ? '' :  'disabled' }} required id="tanggal" name="tanggal" aria-describedby="judul">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga <a class="red-star">*</a></label>
                        <input type="text" class="form-control"   {{ auth()->user()->role == "sekretaris"  ? '' :  'disabled' }}  required id="harga" name="harga" aria-describedby="judul">
                    </div>
                    @csrf
                    <div class="text-right"><a class="red-star">*</a> Wajib diisi</div>
            </div>
            <div class="modal-footer">
                @if (auth()->user()->role == "sekretaris")
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
    @if (auth()->user()->role == "sekretaris")
    <script>
        $(document).ready(function() {
 
         $('#nama_anggota').select2({
         dropdownParent: $('#modal_carosel')
       });
 
             var rupiah = document.getElementById('harga');
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
 
             var aksi_status = true;
 
             var table = $('#dataTable2').DataTable({
                 ajax: {
                     url: `/admin/tabel-unit-usaha/data`,
                     dataSrc: 'data',
                 },
                 columns: [
                     {
                         data: 'nama_pemesan',
                     },
                     {
                         data: 'jasa',
                     },
                     {
                         data: function(data, catatan, row) {
                                 return moment(`${data.tanggal}`).utc().format('DD-MM-YYYY')
                             },
                     },
                     {
                         data: 'harga',
                     }
                 ],         
                 aoColumnDefs: [{
                         targets: 4,
                         data: 'id',
                         "render": function(data, catatan, row) {
                                 return `
                                 <a class="" href="#" id="btn_edit" 
                                 data-id="${data}" 
                                 data-nama-pemesan="${row.nama_pemesan}" 
                                 data-nama-jasa="${row.jasa}" 
                                 data-tanggal="${row.tanggal}"
                                 data-harga="${row.harga}" 
 
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
                                 url: "/admin/tabel-unit-usaha/hapus",
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
                     var nama_pemesan = this.getAttribute('data-nama-pemesan');
                     var jasa = this.getAttribute('data-nama-jasa');
                     var tanggal = this.getAttribute('data-tanggal');
                     var harga = this.getAttribute('data-harga');
 
                     
                     $('#id').val(id);
                     $('#nama_pemesan').val(nama_pemesan);
                     $('#jasa').val(jasa);
                     $('#tanggal').val(tanggal);
                     $('#harga').val(harga);
 
                     $('#modal_carosel').modal('show');
             });
             
             $('#tambah_carosel').click(function(e){
                 e.preventDefault();
                 aksi_status = true;
                 $('#modal_carosel').modal('show');
                 clearData();
             });
             $('#form_carosel').submit(function(e){
                 e.preventDefault();
                 var data = new FormData(this);
                 if(aksi_status){
                     $.ajax({
                         url: "/admin/tabel-unit-usaha/tambah",
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
                         url: "/admin/tabel-unit-usaha/edit",
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
                 $('#nama_pemesan').val('');
                 $('#jasa').val('');
                 $('#tanggal').val('');
                 $('#harga').val('');
 
             }
         }); 
    </script>
    @else
    <script>
        $(document).ready(function() {
 
         $('#nama_anggota').select2({
         dropdownParent: $('#modal_carosel')
          });
 
             var rupiah = document.getElementById('harga');
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
 
             var aksi_status = true;
 
             var table = $('#dataTable2').DataTable({
                 ajax: {
                     url: `/admin/tabel-unit-usaha/data`,
                     dataSrc: 'data',
                 },
                 columns: [
                     {
                         data: 'nama_pemesan',
                     },
                     {
                         data: 'jasa',
                     },
                     {
                         data: function(data, catatan, row) {
                                 return moment(`${data.tanggal}`).utc().format('DD-MM-YYYY')
                             },
                     },
                     {
                         data: 'harga',
                     }
                 ],         
                 aoColumnDefs: [{
                         targets: 4,
                         data: 'id',
                         "render": function(data, catatan, row) {
                                 return `
                                 <a class="" href="#" id="btn_edit" 
                                 data-id="${data}" 
                                 data-nama-pemesan="${row.nama_pemesan}" 
                                 data-nama-jasa="${row.jasa}" 
                                 data-tanggal="${row.tanggal}"
                                 data-harga="${row.harga}" 
 
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
                     var nama_pemesan = this.getAttribute('data-nama-pemesan');
                     var jasa = this.getAttribute('data-nama-jasa');
                     var tanggal = this.getAttribute('data-tanggal');
                     var harga = this.getAttribute('data-harga');
 
                     
                     $('#id').val(id);
                     $('#nama_pemesan').val(nama_pemesan);
                     $('#jasa').val(jasa);
                     $('#tanggal').val(tanggal);
                     $('#harga').val(harga);
 
                     $('#modal_carosel').modal('show');
             });
             
             function clearData()
             {
                 $('#id').val('');
                 $('#nama_pemesan').val('');
                 $('#jasa').val('');
                 $('#tanggal').val('');
                 $('#harga').val('');
 
             }
         }); 
    </script>
    @endif
 
@endsection