<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?=$pages?></h3>
      <hr>
      <button id="add" class="btn btn-success text-white btn-sm mb-3"><i class="fa-solid fa-plus"></i>  Tambah</button>
      <button id="edit" class="btn btn-warning text-white btn-sm mb-3"><i class="fa-solid fa-pen"></i>  Edit</button>
      <button id="del" class="btn btn-danger text-white btn-sm mb-3"><i class="fa-solid fa-trash-can"></i>  Hapus</button>
      <button id="detail" class="btn btn-info text-white btn-sm mb-3"><i class="fa-solid fa-search"></i>  Detail</button>

		<div class="card border-primary">
         <div class="card-header bg-primary text-white">
            Data Materi
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-striped table-hover table-sm table-bordered" id="list2" style="width:100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Modul</th>
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
<!-- Modal untuk Tambah/Edit Data -->
   <div class="modal fade" id="kelasModal" tabindex="-1" role="dialog" aria-labelledby="kelasModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="kelasModalLabel">Tambah</h5>
               <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form id="kelasForm">
                  <div class="row mb-2">
                     <label for="modul" class="col-sm-3 col-form-label">Modul</label>
                     <div class="col-sm-9">
                        <select class="col-md-12 form-select form-control select2 select2modul" id="modul" name="modul" style="width: 100% !important;" required></select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label for="kelasName">Nama Materi</label>
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
   <!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailLabel">Detail Materi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <!-- Detail Materi -->
		   <div class="row mb-2">
		   	<label for="materiTitle" class="col-sm-3 col-form-label">Name</label>
		   	<div class="col-sm-9">
		   		<input type="text" class="form-control form-control" id="materiTitle" name="materiTitle" readonly>
		   	</div>
		   </div>
		   <div class="row mb-2">
		   	<label for="materiDesc" class="col-sm-3 col-form-label">Desc</label>
		   	<div class="col-sm-9">
		   		<input type="text" class="form-control form-control" id="materiDesc" name="materiDesc" readonly>
		   	</div>
		   </div>
         <!-- Table Pembahasan -->
			<div class="card">
				<div class="card-header bg-warning">
               <div class="row">
                  <div class="col-md-8">Pembahasan</div>
                  <div class="col-md-4">
                     <button id="add" class="btn btn-success text-white btn-sm mb-3"><i class="fa-solid fa-plus"></i>  Tambah</button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <table class="table table-bordered" id="tableDiscuss">
                  <thead>
                     <tr>
                     <th>Name</th>
                     <th>Description</th>
                     <th>Link</th>
                     <th>File</th>
                     </tr>
                  </thead>
                  <tbody></tbody>
               </table>
            </div>
         </div>
        <!-- Table Soal -->
        <div class="card">
				<div class="card-header bg-warning">
               Soal
            </div>
            <div class="card-body">
               <table class="table table-bordered" id="tableQuiz">
                  <thead>
                     <tr>
                     <th>Question</th>
                     <th>Options</th>
                     <th>Answer</th>
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
            url: '<?=base_url()?>admin/fetch_lmateri',
            type: 'GET'
         },
         columns: [
            { data: 'id' },
            { data: 'modul' },
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
         $('#list2 tbody tr').removeClass('selected'); 
         $(this).addClass('selected'); 
      });

      $('#edit').click(function() {
         var data = table.row('.selected').data(); // Mengambil data dari baris yang terpilih
         if (data) {
            $('#kelasModalLabel').text('Edit Materi');
            $('#kelasId').val(data.id);
            $('#kelasName').val(data.name);
            $('#kelasDesc').val(data.desc);

            // Set nilai awal Select2 sesuai modul_id
            var selectedModul = new Option(data.modul, data.modul_id, true, true);
            $("#modul").append(selectedModul).trigger('change');

            $('#kelasModal').modal('show');
         } else {
            Swal.fire('Peringatan', 'Pilih data yang ingin diedit terlebih dahulu!', 'warning');
         }
      });
      mselect();
		function mselect(){
			$(".select2modul").select2({ 	
				theme: "bootstrap-5",
				dropdownParent: $("#kelasModal"),
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
      $('#del').click(function() {
         var data = table.row('.selected').data(); // Mengambil data dari baris yang terpilih
         if (data) {
            Swal.fire({
               title: 'Yakin ingin menghapus?',
               text: "Data Modul yang dihapus tidak dapat dikembalikan!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Hapus',
               cancelButtonText: 'Batal'
            }).then((result) => {
               if (result.isConfirmed) {
                  $.ajax({
                     url: '<?=base_url()?>admin/delete_lmateri',
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
      $('#kelasForm').submit(function(e) {
         e.preventDefault();
         var kelasId = $('#kelasId').val();
         var modulId = $('#modul').val();
         var kelasName = $('#kelasName').val();
         var kelasDesc = $('#kelasDesc').val();

         var url = kelasId ? '<?=base_url()?>admin/edit_lmateri' : '<?=base_url()?>admin/add_lmateri';
         var method = kelasId ? 'POST' : 'POST';

         $.ajax({
            url: url,
            method: method,
            data: {
               id: kelasId,
               modul: modulId,
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
               text: "Data Materi yang dihapus tidak dapat dikembalikan!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Hapus',
               cancelButtonText: 'Batal'
            }).then((result) => {
               if (result.isConfirmed) {
                  $.ajax({
                     url: '<?=base_url()?>admin/delete_lmateri',
                     method: 'POST',
                     data: { id: data.id },
                     success: function(response) {
                        table.ajax.reload();
                        Swal.fire('Terhapus!', 'Data Mdoul berhasil dihapus!', 'success');
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

      $('#detail').click(function() {
         var data = $('#list2').DataTable().row('.selected').data();
         if (!data) {
            Swal.fire('Peringatan', 'Pilih data terlebih dahulu!', 'warning');
            return;
         }

         $.ajax({
            url: "<?= base_url('admin/getDetailMateri') ?>",
            type: "post",
            data: { materi_id: data.id },
            dataType: "json",
            success: function(response) {
                  if (response.status === 'success') {
                     $('#materiTitle').val(response.materi.name);
                     $('#materiDesc').val(response.materi.desc);

                     // Isi tabel pembahasan
                     var discussTable = $('#tableDiscuss tbody');
                     discussTable.empty();
                     response.discuss.forEach(function(item, index) {
                        discussTable.append(`
                              <tr>
                                 <td>${index + 1}</td>
                                 <td>${item.name}</td>
                                 <td>${item.desc}</td>
                                 <td><a href="${item.link}" target="_blank">${item.link}</a></td>
                                 <td><a href="<?= base_url('uploads/') ?>${item.filepath}" download>${item.filename}</a></td>
                              </tr>
                        `);
                     });

                     // Isi tabel soal
                     var quizTable = $('#tableQuiz tbody');
                     quizTable.empty();
                     response.quiz.forEach(function(item, index) {
                        quizTable.append(`
                              <tr>
                                 <td>${index + 1}</td>
                                 <td>${item.question}</td>
                                 <td>${item.ans_1}</td>
                                 <td>${item.ans_2}</td>
                                 <td>${item.ans_3}</td>
                                 <td>${item.ans_4}</td>
                                 <td>${item.ans_5}</td>
                                 <td>${item['val_' + item.opt_1]}</td>
                              </tr>
                        `);
                     });

                     $('#modalDetail').modal('show');
                  } else {
                     Swal.fire('Error', response.message, 'error');
                  }
            }
         });
      });



   });

</script>