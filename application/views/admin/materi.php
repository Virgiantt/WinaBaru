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
<!-- Modal untuk Tambah/Edit Data master materi -->
   <div class="modal fade" id="kelasModal" tabindex="-1" role="dialog" aria-labelledby="kelasModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="kelasModalLabel">Tambah</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
      <div class="modal-dialog modal-xl">
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
                     <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Data Pembahasan</button>
                     <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Data Soal</button>
                  </div>
                  <div class="tab-content w-100" id="v-pills-tabContent">
                     <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <!-- Table Pembahasan -->
                        <div class="card">
                           <div class="card-header bg-warning">
                              <button id="addpembahasan" class="btn btn-success text-white btn-sm"><i class="fa-solid fa-plus"></i>  Tambah</button>
                              <button id="delpembahasan" class="btn btn-danger text-white btn-sm"><i class="fa-solid fa-trash-can"></i>  Hapus</button>
                           </div>
                           <div class="card-body">
                              <table class="table table-striped table-hover table-sm table-bordered" id="tableDiscuss">
                                 <thead>
                                    <tr>
                                    <th>No.</th>
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
                     </div>
                     <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <!-- Table Soal -->
                        <div class="card">
                           <div class="card-header bg-warning">
                              <button id="addquiz" class="btn btn-success text-white btn-sm"><i class="fa-solid fa-plus"></i>  Tambah</button>
                              <button id="delquiz" class="btn btn-danger text-white btn-sm"><i class="fa-solid fa-trash-can"></i>  Hapus</button>
                           </div>
                           <div class="card-body">
                              <table class="table table-striped table-hover table-sm table-bordered" id="tableQuiz">
                                 <thead>
                                    <tr>
                                    <th>No.</th>
                                    <th>Question</th>
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
         </div>
      </div>
   </div>
   <!-- Modal untuk Tambah/Edit Data Pembahasan -->
   <div class="modal fade" id="bahasModal" tabindex="-1" role="dialog" aria-labelledby="bahasModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Tambah Pembahasan</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="bahasForm" method="post" enctype="multipart/form-data">
                  <input type="hidden" id="bahasId"> <!-- Untuk Edit Data -->

                  <div class="mb-3">
                     <label for="bahasName" class="form-label">Nama Pembahasan</label>
                     <input type="text" class="form-control" id="bahasName" required>
                  </div>

                  <div class="mb-3">
                     <label for="bahasDesc" class="form-label">Deskripsi</label>
                     <textarea class="form-control" id="bahasDesc" required></textarea>
                  </div>

                  <div class="mb-3">
                     <label for="bahasLink" class="form-label">Link</label>
                     <input type="url" class="form-control" id="bahasLink">
                  </div>

                  <div class="mb-3">
                     <label for="bahasTypeLink" class="form-label">Tipe Link</label>
                     <select id="bahasTypeLink" class="form-select">
                        <option value="pdf">PDF</option>
                        <option value="yt">Youtube</option>
                        <option value="doc">Word</option>
                     </select>
                  </div>

                  <div class="mb-3">
                     <label for="bahasFile" class="form-label">Upload File</label>
                     <input type="file" class="form-control" id="bahasFile">
                  </div>

                  <button type="submit" class="btn btn-primary">Simpan</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="quizModalLabel">Tambah Soal</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="quizForm">
                  <div class="mb-3">
                     <label for="question" class="form-label">Pertanyaan</label>
                     <textarea class="form-control" id="question" required></textarea>
                  </div>
                  <!-- Pilihan Jawaban -->
                  <div class="mb-3">
                     <label class="form-label">Pilihan Jawaban</label>
                     <div class="row">
                        <div class="col-8">
                           <input type="text" class="form-control" id="ans_1" name="ans_1" placeholder="Jawaban A" required>
                        </div>
                        <div class="col-4">
                           <input type="number" class="form-control" id="val_1" name="val_1" placeholder="Bobot" required>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-8">
                           <input type="text" class="form-control" id="ans_2" name="ans_2" placeholder="Jawaban B" required>
                        </div>
                        <div class="col-4">
                           <input type="number" class="form-control" id="val_2" name="val_2" placeholder="Bobot" required>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-8">
                           <input type="text" class="form-control" id="ans_3" name="ans_3" placeholder="Jawaban C" required>
                        </div>
                        <div class="col-4">
                           <input type="number" class="form-control" id="val_3" name="val_3" placeholder="Bobot" required>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-8">
                           <input type="text" class="form-control" id="ans_4" name="ans_4" placeholder="Jawaban D" required>
                        </div>
                        <div class="col-4">
                           <input type="number" class="form-control" id="val_4" name="val_4" placeholder="Bobot" required>
                        </div>
                     </div>
                     <div class="row mt-2">
                        <div class="col-8">
                           <input type="text" class="form-control" id="ans_5" name="ans_5" placeholder="Jawaban E" required>
                        </div>
                        <div class="col-4">
                           <input type="number" class="form-control" id="val_5" name="val_5" placeholder="Bobot" required>
                        </div>
                     </div>
                  </div>

                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                     <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="previewModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Preview</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
               </div>
               <div class="modal-body" id="modalContent">
                  <!-- Konten ditambahkan lewat jQuery -->
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
         $('#kelasModalLabel').text('Tambah Materi');
         $('#kelasForm')[0].reset();
         $('#kelasId').val('');
         $('#kelasModal').modal('show');
      });
      $('#addpembahasan').click(function() {
         $('#bahasForm')[0].reset();
         $('#bahasModal').modal('show');
      });
      $('#addquiz').click(function() {
         $('#quizForm')[0].reset();
         $('#quizModal').modal('show');
      });

      $('#list2 tbody').on('click', 'tr', function() {
         $('#list2 tbody tr').removeClass('selected'); 
         $(this).addClass('selected'); 
      });
      $('#tableDiscuss tbody').on('click', 'tr', function() {
         $('#tableDiscuss tbody tr').removeClass('selected'); 
         $(this).addClass('selected'); 
      });
      $('#tableQuiz tbody').on('click', 'tr', function() {
         $('#tableQuiz tbody tr').removeClass('selected'); 
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
                        Swal.fire('Terhapus!', 'Data Materi berhasil dihapus!', 'success');
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
         $('#modalDetail').modal('show');
         detailMateri(data.id);
      });
      function detailMateri(materi_id) {
         $.ajax({
            url: "<?= base_url('admin/getDetailMateri') ?>",
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
                     let fileLink = item.filename 
                        ? `<a href="#" class="openModal" data-type="file" data-url="<?= base_url() ?>${item.filepath}" data-filename="${item.filename}" data-typelink="${item.typelink}">${item.filename}</a>` 
                        : 'No File';

                     let linkDisplay = item.link 
                        ? `<a href="#" class="openModal btn btn-info btn-sm" data-type="link" data-url="${item.link}" data-typelink="${item.typelink}">Lihat File</a>` 
                        : 'No Link';

                     let rowNode = tableDiscuss.row.add([
                        index + 1,
                        item.name,
                        item.desc,
                        linkDisplay,
                        fileLink
                     ]).draw().node(); // Ambil node baris yang baru ditambahkan

                     $(rowNode).attr('data-id', item.id); // Tambahkan data-id di <tr>
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

      // **Handle Klik untuk Melihat File**
      $(document).on('click', '.openModal', function() {
         let url = $(this).data('url');
         let typelink = $(this).data('typelink'); // Ambil dari database
         let filename = $(this).data('filename') || '';

         let modalBody = $('#modalContent');
         modalBody.empty(); // Bersihkan isi modal

         if (typelink === "pdf") {
            modalBody.html(`<iframe src="${url}" width="100%" height="500px"></iframe>`);
         } else if (typelink === "doc") {
            modalBody.html(`<iframe src="https://view.officeapps.live.com/op/view.aspx?src=${encodeURIComponent(url)}" width="100%" height="500px"></iframe>`);
         } else if (typelink === "yt") {
            let videoId = url.split("v=")[1]?.split("&")[0] || url.split("youtu.be/")[1]?.split("?")[0];
            if (videoId) {
               modalBody.html(`<iframe width="100%" height="500px" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allowfullscreen></iframe>`);
            }
         } else {
            modalBody.html(`<p><a href="${url}" target="_blank">${url}</a></p>`);
         }

         $('#previewModal').modal('show');
      });
      
      // bahas act
      $('#bahasForm').submit(function(e) {
         e.preventDefault();

         var formData = new FormData();
         formData.append('id', $('#bahasId').val());
         formData.append('materi_id', $('#materi_iddet').val());
         formData.append('name', $('#bahasName').val());
         formData.append('desc', $('#bahasDesc').val());
         formData.append('link', $('#bahasLink').val());
         formData.append('typelink', $('#bahasTypeLink').val());
         formData.append('foto', $('#bahasFile')[0].files[0]);
         $.ajax({
               url: "<?= base_url('admin/saveDiscuss') ?>",
               type: "POST",
               data: formData,
               contentType: false,
               processData: false,
               dataType: "json",
               success: function(response) {
                  if (response.status === 'success') {
                     Swal.fire('Berhasil', 'Data pembahasan berhasil disimpan', 'success');
                     $('#bahasModal').modal('hide');
                     var data = $('#list2').DataTable().row('.selected').data();
                     if (!data) {
                        Swal.fire('Peringatan', 'Pilih data terlebih dahulu!', 'warning');
                        return;
                     }
                     detailMateri(data.id);
                  } else {
                     Swal.fire('Gagal', response.message, 'error');
                  }
               }
         });
      });

      // Delete Class with SweetAlert2 Confirmation
      $('#delpembahasan').click(function() {
         var selectedRow = $("#tableDiscuss").DataTable().row('.selected').node(); 
         var discussId = $(selectedRow).attr('data-id'); // Ambil id dari data-id

         if (discussId) {
            Swal.fire({
               title: 'Yakin ingin menghapus?',
               text: "Data Pembahasan yang dihapus tidak dapat dikembalikan!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonText: 'Hapus',
               cancelButtonText: 'Batal'
            }).then((result) => {
               if (result.isConfirmed) {
                  $.ajax({
                     url: '<?=base_url()?>admin/delete_lbahas',
                     method: 'POST',
                     data: { id: discussId },
                     success: function(response) {
                        var data = $('#list2').DataTable().row('.selected').data();
                        if (!data) {
                           Swal.fire('Peringatan', 'Pilih data terlebih dahulu!', 'warning');
                           return;
                        }
                        detailMateri(data.id);
                        Swal.fire('Terhapus!', 'Data Pembahasan berhasil dihapus!', 'success');
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

      $("#quizForm").submit(function(e) {
         e.preventDefault(); // Mencegah form reload

         // Ambil data dari form
         let formData = {
               materi_id: $('#materi_iddet').val(),
               question: $("#question").val(),
               ans_1: $("#ans_1").val(),
               val_1: $("#val_1").val(),
               ans_2: $("#ans_2").val(),
               val_2: $("#val_2").val(),
               ans_3: $("#ans_3").val(),
               val_3: $("#val_3").val(),
               ans_4: $("#ans_4").val(),
               val_4: $("#val_4").val(),
               ans_5: $("#ans_5").val(),
               val_5: $("#val_5").val()
         };

         // Kirim data ke server via AJAX
         $.ajax({
               url: "<?= base_url('admin/save_quiz') ?>",
               type: "POST",
               data: formData,
               dataType: "json",
               success: function(response) {
                  if (response.success) {
                     Swal.fire({
                           icon: "success",
                           title: "Berhasil!",
                           text: "Soal telah disimpan.",
                           timer: 2000,
                           showConfirmButton: false
                     });

                     // Reset form setelah berhasil
                     $("#quizForm")[0].reset();

                     // Tutup modal setelah submit sukses
                     $("#quizModal").modal("hide");
                        var data = $('#list2').DataTable().row('.selected').data();
                        if (!data) {
                           Swal.fire('Peringatan', 'Pilih data terlebih dahulu!', 'warning');
                           return;
                        }
                        detailMateri(data.id);
                  } else {
                     Swal.fire({
                           icon: "error",
                           title: "Gagal!",
                           text: response.message || "Terjadi kesalahan.",
                     });
                  }
               },
               error: function(xhr, status, error) {
                  Swal.fire({
                     icon: "error",
                     title: "Error!",
                     text: "Terjadi kesalahan saat menyimpan data.",
                  });
                  console.error(xhr.responseText);
               }
         });
      });

      $('#delquiz').click(function() {
         var selectedRow = $("#tableQuiz").DataTable().row('.selected').node(); 
         var quizId = $(selectedRow).attr('data-id'); // Ambil id dari atribut data-id
         console.log(quizId);
         if (quizId) {
            Swal.fire({
                  title: 'Yakin ingin menghapus?',
                  text: "Data Quiz yang dihapus tidak dapat dikembalikan!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Hapus',
                  cancelButtonText: 'Batal'
            }).then((result) => {
                  if (result.isConfirmed) {
                     $.ajax({
                        url: '<?=base_url()?>admin/delete_lquiz',
                        method: 'POST',
                        data: { id: quizId },
                        success: function(response) {
                              $("#tableQuiz").DataTable().row('.selected').remove().draw();
                              Swal.fire('Terhapus!', 'Data berhasil dihapus!', 'success');
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