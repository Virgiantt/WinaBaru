<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?=$pages?></h3>
      <hr>
      <button id="add" class="btn btn-success text-white btn-sm mb-3"><i class="fa-solid fa-plus"></i>  Tambah</button>
      <button id="edit" class="btn btn-warning text-white btn-sm mb-3"><i class="fa-solid fa-pen"></i>  Edit</button>
      <button id="del" class="btn btn-danger text-white btn-sm mb-3"><i class="fa-solid fa-trash-can"></i>  Hapus</button>
      <button id="detail" class="btn btn-info text-white btn-sm mb-3"><i class="fa-solid fa-search"></i>  Pelatihan & Member</button>
      <!-- Modal untuk Tambah/Edit Data -->
      <div class="modal fade" id="kelasModal" tabindex="-1" role="dialog" aria-labelledby="kelasModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="kelasModalLabel">Tambah Kelas</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form id="kelasForm">
                     <div class="form-group">
                        <label for="kelasName">Nama Kelas</label>
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
            Data Kelas
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-striped table-hover table-sm table-bordered" id="list2" style="width:100%">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Nama Kelas</th>
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
            <h5 class="modal-title" id="modalDetailLabel">Pelatihan & Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <!-- Detail Materi -->
               <div class="row mb-2">
                  <label for="materiTitle" class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control form-control" id="materiTitle" name="materiTitle" readonly>
                     <input type="hidden" id="materi_iddet">
                  </div>
               </div>
               <div class="row mb-3">
                  <label for="materiDesc" class="col-sm-3 col-form-label">Desc</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control form-control" id="materiDesc" name="materiDesc" readonly>
                  </div>
               </div>
               <div class="d-flex align-items-start">
                  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                     <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Akses user</button>
                     <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Akses Pelatihan</button>
                  </div>
                  <div class="tab-content w-100" id="v-pills-tabContent">
                     <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <!-- Table Pembahasan -->
                        <div class="card">
                           <div class="card-header bg-warning d-flex align-items-center gap-2">
                              <div class="col-md-8">
                                 <select class="form-select select2 select2user" id="iduser" name="user" required></select>
                              </div>
                              <button id="adduserkelas" class="btn btn-success text-white"><i class="fa-solid fa-plus"></i>  Tambah</button>
                              <button id="delpembahasan" class="btn btn-danger text-white"><i class="fa-solid fa-trash-can"></i>  Hapus</button>
                           </div>
                           <div class="card-body">
                              <table class="table table-striped table-hover table-sm table-bordered" id="tableDiscuss">
                                 <thead>
                                    <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    </tr>
                                 </thead>
                                 <tbody></tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <!-- Table Soal -->
                        <div class="card">
                           <div class="card-header bg-warning d-flex align-items-center gap-2">
                              <div class="col-md-8">
                                 <select class="form-select select2 select2lesson" id="idlesson" name="lesson" required></select>
                              </div>
                              <button id="addquiz" class="btn btn-success text-white"><i class="fa-solid fa-plus"></i>  Tambah</button>
                              <button id="delquiz" class="btn btn-danger text-white"><i class="fa-solid fa-trash-can"></i>  Hapus</button>
                           </div>
                           <div class="card-body">
                              <table class="table table-striped table-hover table-sm table-bordered" id="tableQuiz">
                                 <thead>
                                    <tr>
                                    <th>No.</th>
                                    <th>Nama Pelatihan</th>
                                    <th>Deskripsi</th>
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
            url: '<?=base_url()?>admin/fetch_lkelas',
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
      $('#tableDiscuss tbody').on('click', 'tr', function() {
         $('#tableDiscuss tbody tr').removeClass('selected'); 
         $(this).addClass('selected'); 
      });
      $('#tableQuiz tbody').on('click', 'tr', function() {
         $('#tableQuiz tbody tr').removeClass('selected'); 
         $(this).addClass('selected'); 
      });
      
      $('#detail').click(function() {
         var data = $('#list2').DataTable().row('.selected').data();
         if (!data) {
            Swal.fire('Peringatan', 'Pilih data terlebih dahulu!', 'warning');
            return;
         }
         $('#modalDetail').modal('show');
         userselect();
         detailMateri(data.id);
      });
      function detailMateri(materi_id) {
         $.ajax({
            url: "<?= base_url('admin/getDetailKelas') ?>",
            type: "post",
            data: { materi_id: materi_id },
            dataType: "json",
            success: function(response) {
               if (response.status === 'success') {
                  $('#materiTitle').val(response.materi.name);
                  $('#materiDesc').val(response.materi.desc);
                  $('#materi_iddet').val(response.materi.id);

                  // **Isi Tabel Diskusi**
                  var tableDiscuss = $('#tableDiscuss').DataTable();
                  tableDiscuss.clear(); // Hapus data lama

                  response.discuss.forEach(function(item, index) {
                     let rowNode = tableDiscuss.row.add([
                        index + 1,
                        item.name,
                        item.username,
                        item.email
                     ]).draw().node(); // Ambil node baris yang baru ditambahkan

                     $(rowNode).attr('data-id', item.user_id); // Tambahkan data-id di <tr>
                  });

                  tableDiscuss.draw(); // Gambar ulang tabel dengan data baru

                  // **Isi Tabel Soal**
                  var tableQuiz = $('#tableQuiz').DataTable();
                  tableQuiz.clear();

                  response.quiz.forEach(function(item, index) {
                     let answerList = `
                        <ul class="list-unstyled">
                              <li>A. ${item.ans_1} (${item.val_1})</li>
                              <li>B. ${item.ans_2} (${item.val_2})</li>
                              <li>C. ${item.ans_3} (${item.val_3})</li>
                              <li>D. ${item.ans_4} (${item.val_4})</li>
                              <li>E. ${item.ans_5} (${item.val_5})</li>
                        </ul>`;

                     let rowNode = tableQuiz.row.add([
                        index + 1,
                        item.question,
                        answerList
                     ]).draw().node();  // Ambil node baris yang baru ditambahkan

                     $(rowNode).attr('data-id', item.id); // Tambahkan data-id di <tr>
                  });

                  tableQuiz.draw();

               } else {
                  Swal.fire('Error', response.message, 'error');
               }
            }
         });
      }
      // add user kelas akses
      $('#adduserkelas').click(function() {
         var idmodul = $('#iduser').val();
         var lesson_id = $('#materi_iddet').val();
         $.ajax({
            type: "POST",
            url: "<?= base_url('admin/add_user_kelas') ?>",
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
                     url: '<?=base_url()?>admin/delete_lkelas',
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
      // Setelah form disubmit dan modal ditutup
      $('#kelasForm').submit(function(e) {
         e.preventDefault();
         var kelasId = $('#kelasId').val();
         var kelasName = $('#kelasName').val();
         var kelasDesc = $('#kelasDesc').val();

         var url = kelasId ? '<?=base_url()?>admin/edit_lkelas' : '<?=base_url()?>admin/add_lkelas';
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

      function userselect(){
			$(".select2user").select2({ 	
				theme: "bootstrap-5",
				dropdownParent: $("#modalDetail"),
				placeholder: 'User....',
			  	ajax: {
			    	url: "<?= base_url()?>admin/userselect",
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
			            text: item.name + " | " + item.username + " | " + item.email,
			          };
			        });
			        return {
			          results: results,
			        }
			      },
			  	},
			});
			$(".select2lesson").select2({ 	
				theme: "bootstrap-5",
				dropdownParent: $("#modalDetail"),
				placeholder: 'Pelatihan....',
			  	ajax: {
			    	url: "<?= base_url()?>admin/lessonselect",
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