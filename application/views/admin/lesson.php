<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?=$pages?></h3>
      <hr>
      <button id="add" class="btn btn-success text-white btn-sm mb-3"><i class="fa-solid fa-plus"></i>  Tambah</button>
      <button id="edit" class="btn btn-warning text-white btn-sm mb-3"><i class="fa-solid fa-pen"></i>  Edit</button>
      <button id="del" class="btn btn-danger text-white btn-sm mb-3"><i class="fa-solid fa-trash-can"></i>  Hapus</button>
      <button id="detail" class="btn btn-info text-white btn-sm mb-3"><i class="fa-solid fa-search"></i>  Akses Modul</button>
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

   <!-- Modal Detail -->
   <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
         <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modalDetailLabel">Detail Pelatihan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <!-- Detail Materi -->
               <div class="row mb-2">
                  <label for="materiTitle" class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control form-control" id="materiTitle" name="materiTitle" readonly>
                     <input type="hidden" id="lesson_iddet">
                  </div>
               </div>
               <div class="row mb-3">
                  <label for="materiDesc" class="col-sm-3 col-form-label">Desc</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control form-control" id="materiDesc" name="materiDesc" readonly>
                  </div>
               </div>
               <hr>
               <!-- Table modul -->
               <div class="card">
                  <div class="card-header bg-warning d-flex align-items-center gap-2">
                     <div class="col-md-8">
                        <select class="form-select select2 select2modul" id="idmodul" name="modul" required></select>
                     </div>
                     <button type="button" id="addmodul" class="btn btn-success text-white">
                        <i class="fa-solid fa-plus"></i> Tambah
                     </button>
                     <button type="button" id="delmodul" class="btn btn-danger text-white">
                        <i class="fa-solid fa-trash-can"></i> Hapus
                     </button>
                  </div>
                  <div class="card-body">
                     <table class="table table-striped table-hover table-sm table-bordered" id="tableDiscuss">
                        <thead>
                           <tr>
                           <th>No.</th>
                           <th>Name</th>
                           <th>Description</th>
                           </tr>
                        </thead>
                        <tbody></tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
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
      
      $('#detail').click(function() {
         var data = $('#list2').DataTable().row('.selected').data();
         if (!data) {
            Swal.fire('Peringatan', 'Pilih data terlebih dahulu!', 'warning');
            return;
         }
         $('#modalDetail').modal('show');
         detaillesson(data.id);
         mselect();
      });

      $('#addmodul').click(function() {
         var idmodul = $('#idmodul').val();
         var lesson_id = $('#lesson_iddet').val();
         $.ajax({
            type: "POST",
            url: "<?= base_url('admin/add_lesson_modul') ?>",
            data: {idmodul: idmodul, lesson_id: lesson_id},
            dataType: "json",
            success: function (response) {
               if (response.status === 'success') {
                     Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: response.message
                     }).then(() => {
                        detaillesson(lesson_id);
                     });
               } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message
                     });
               }
            },
            error: function () {
               Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: 'Terjadi kesalahan pada server'
               });
            }
         });
      });

      $('#tableDiscuss tbody').on('click', 'tr', function() {
         $('#tableDiscuss tbody tr').removeClass('selected'); 
         $(this).addClass('selected'); 
      });
      $('#delmodul').click(function() {
         var selectedRow = $("#tableDiscuss").DataTable().row('.selected').node(); 
         var id = $(selectedRow).attr('data-id');
         if (!selectedRow) {
            Swal.fire('Peringatan', 'Pilih data terlebih dahulu!', 'warning');
            return;
         }
         $.ajax({
            type: "POST",
            url: "<?= base_url('admin/del_lesson_modul') ?>",
            data: { id: id},
            dataType: "json",
            success: function (response) {
               if (response.status === 'success') {
                     Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: response.message
                     }).then(() => {
               var lesson_id = $('#lesson_iddet').val();
               detaillesson(lesson_id);
            });
               } else {
                     Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message
                     });
               }
            },
            error: function () {
               Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: 'Terjadi kesalahan pada server'
               });
            }
         });
      });

      function detaillesson(lesson_id) {
         $("#tableDiscuss").DataTable().destroy();
         $.ajax({
            url: "<?= base_url('admin/getlessonModul') ?>",
            type: "post",
            data: { lesson_id: lesson_id },
            dataType: "json",
            success: function(response) {
               if (response.status === 'success') {
                  $('#materiTitle').val(response.materi.name);
                  $('#materiDesc').val(response.materi.desc);
                  $('#lesson_iddet').val(response.materi.id);

                  // **Isi Tabel Diskusi**
                  var tableDiscuss = $('#tableDiscuss').DataTable();
                  tableDiscuss.clear(); // Hapus data lama

                  response.discuss.forEach(function(item, index) {
                     let rowNode = tableDiscuss.row.add([
                        index + 1,
                        item.name,
                        item.desc
                     ]).draw().node(); // Ambil node baris yang baru ditambahkan

                     $(rowNode).attr('data-id', item.id); // Tambahkan data-id di <tr>
                  });

               } else {
                  Swal.fire('Error', response.message, 'error');
               }
            }
         });
      }
      $('#modalDetail').on('hidden.bs.modal', function(){
	   });

      // Add New Class
      $('#add').click(function() {
         $('#kelasModalLabel').text('Tambah Pelatihan');
         $('#kelasForm')[0].reset();
         $('#kelasId').val('');
         $('#kelasModal').modal('show');
      });

      $('#list2 tbody').on('click', 'tr', function() {
         $('#list2 tbody tr').removeClass('selected'); 
         $(this).addClass('selected'); 
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
      
		function mselect(){
			$(".select2modul").select2({ 	
				theme: "bootstrap-5",
				dropdownParent: $("#modalDetail"),
				placeholder: 'Modul....',
			  	ajax: {
			    	url: "<?= base_url()?>admin/modulselect",
			    	dataType: 'json',
			    	data: (params) => {
			        return {
			          id: params.term,
			        }
			    	},
			    	processResults: (data, params) => {
			        	const results = data.items.map(item => {
			        	return {
			            id: item.id,
			            text: item.name,
			          };
			        });
			        return {
			          results: results,
			        }
			      },
			  	},
			});
		}
   });

</script>