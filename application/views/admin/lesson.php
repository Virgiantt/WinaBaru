<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?=$pages?></h3>
      <hr>
      <button id="add" class="btn btn-success text-white btn-sm mb-3"><i class="fa-solid fa-plus"></i>  Tambah</button>
      <button id="edit" class="btn btn-warning text-white btn-sm mb-3"><i class="fa-solid fa-pen"></i>  Edit</button>
      <button id="del" class="btn btn-danger text-white btn-sm mb-3"><i class="fa-solid fa-trash-can"></i>  Hapus</button>
      <!-- Modal untuk Tambah/Edit Data -->
      <div class="modal fade" id="kelasModal" tabindex="-1" role="dialog" aria-labelledby="kelasModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="kelasModalLabel">Tambah</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form id="kelasForm">
                     <div class="form-group">
                        <label for="kelasName">Nama Pelatihan</label>
                        <input type="text" class="form-control" id="kelasName" required>
                     </div>
                     <div class="form-group">
                        <label for="kelasDesc">Deskripsi</label>
                        <textarea class="form-control" id="kelasDesc" required></textarea>
                     </div>
                     <input type="hidden" id="kelasId"> <!-- Hidden input for editing -->
                     <button type="submit" class="btn btn-primary">Simpan</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
		<div class="card border-primary">
         <div class="card-header bg-primary text-white">
            Data Pelatihan
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-striped table-hover table-sm table-bordered" id="list2" style="width:100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
	</div>
</main>
<script>
   $(document).ready(function() {
      // Initialize DataTable
      var table = $('#list2').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
            url: '<?=base_url()?>admin/fetch_lpelatihan',
            type: 'GET'
         },
         columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'desc' }
         ]
      });

      // Add New Class
      $('#add').click(function() {
         $('#kelasModalLabel').text('Tambah Kelas');
         $('#kelasForm')[0].reset();
         $('#kelasId').val('');
         $('#kelasModal').modal('show');
      });

      $('#list2 tbody').on('click', 'tr', function() {
         $(this).toggleClass('selected'); // Tambahkan atau hapus class selected saat baris diklik
      });
      // Edit Class on Button Click (button 'Edit' di atas DataTable)
      $('#edit').click(function() {
         var data = table.row('.selected').data(); // Mengambil data dari baris yang terpilih
         if (data) {
            $('#kelasModalLabel').text('Edit Kelas');
            $('#kelasId').val(data.id);
            $('#kelasName').val(data.name);
            $('#kelasDesc').val(data.desc);
            $('#kelasModal').modal('show');
         } else {
            Swal.fire('Peringatan', 'Pilih data yang ingin diedit terlebih dahulu!', 'warning');
         }
      });
      // Delete Class with SweetAlert2 Confirmation
      $('#del').click(function() {
         var data = table.row('.selected').data(); // Mengambil data dari baris yang terpilih
         if (data) {
            Swal.fire({
               title: 'Yakin ingin menghapus?',
               text: "Data kelas yang dihapus tidak dapat dikembalikan!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Hapus',
               cancelButtonText: 'Batal'
            }).then((result) => {
               if (result.isConfirmed) {
                  $.ajax({
                     url: '<?=base_url()?>admin/delete_lpelatihan',
                     method: 'DELETE',
                     data: { id: data.id },
                     success: function(response) {
                        table.ajax.reload();
                        Swal.fire('Terhapus!', 'Data kelas berhasil dihapus!', 'success');
                     },
                     error: function(error) {
                        Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data!', 'error');
                     }
                  });
               }
            });
         } else {
            Swal.fire('Peringatan', 'Pilih data yang ingin dihapus terlebih dahulu!', 'warning');
         }
      });
      // Setelah form disubmit dan modal ditutup
      $('#kelasForm').submit(function(e) {
         e.preventDefault();
         var kelasId = $('#kelasId').val();
         var kelasName = $('#kelasName').val();
         var kelasDesc = $('#kelasDesc').val();

         var url = kelasId ? '<?=base_url()?>admin/edit_lpelatihan' : '<?=base_url()?>admin/add_lpelatihan';
         var method = kelasId ? 'POST' : 'POST';

         $.ajax({
            url: url,
            method: method,
            data: {
               id: kelasId,
               name: kelasName,
               desc: kelasDesc
            },
            success: function(response) {
               $('#kelasModal').modal('hide');
               table.ajax.reload();
               Swal.fire('Sukses', 'Data kelas berhasil disimpan!', 'success');
               $('#list2 tbody tr').removeClass('selected'); // Menghapus class selected setelah modal ditutup
            },
            error: function(error) {
               Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan data!', 'error');
            }
         });
      });

      // Delete Class with SweetAlert2 Confirmation
      $('#del').click(function() {
         var data = table.row('.selected').data(); // Mengambil data yang terpilih
         if (data) {
            Swal.fire({
               title: 'Yakin ingin menghapus?',
               text: "Data Pelatihan yang dihapus tidak dapat dikembalikan!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Hapus',
               cancelButtonText: 'Batal'
            }).then((result) => {
               if (result.isConfirmed) {
                  $.ajax({
                     url: '<?=base_url()?>admin/delete_lpelatihan',
                     method: 'POST',
                     data: { id: data.id },
                     success: function(response) {
                        table.ajax.reload();
                        Swal.fire('Terhapus!', 'Data kelas berhasil dihapus!', 'success');
                     },
                     error: function(error) {
                        Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus data!', 'error');
                     }
                  });
               }
            });
         } else {
            Swal.fire('Peringatan', 'Pilih data yang ingin dihapus terlebih dahulu!', 'warning');
         }
      });
   });

</script>