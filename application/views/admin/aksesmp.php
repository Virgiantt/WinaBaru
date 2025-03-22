<main class="mt-5 pt-3">
	<div class="container-fluid">
		<h3><?=$pages?></h3>
      <hr>
      <div class="d-flex align-items-center gap-2">
         <div class="col-md-4">
            <select class="form-select select2 select2user" id="iduser" name="user" required></select>
         </div>
         <div class="col-md-4">
            <select class="form-select select2 select2lesson" id="idlesson" name="lesson" required></select>
         </div>
         <button id="add" class="btn btn-success text-white"><i class="fa-solid fa-plus"></i>  Tambah</button>
         <button id="del" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i>  Hapus</button>
      </div>
		<div class="card border-primary mt-3">
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
<script>
   $(document).ready(function() {
      // Initialize DataTable
      var table = $('#list2').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
            url: '<?=base_url()?>admin/fetch_mpakses',
            type: 'GET'
         },
         columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'desc' }
         ]
      });
      $('#list2 tbody').on('click', 'tr', function() {
         $(this).toggleClass('selected'); // Tambahkan atau hapus class selected saat baris diklik
      });
      // add user kelas akses
      $('#add').click(function() {
         var idmodul = $('#iduser').val();
         var lesson_id = $('#idlesson').val();
         $.ajax({
            type: "POST",
            url: "<?= base_url('admin/add_jabatan_mp') ?>",
            data: {idmodul: idmodul, lesson_id: lesson_id},
            dataType: "json",
            success: function (response) {
               if (response.status === 'success') {
                     Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: response.message
                     }).then(() => {
                        table.ajax.reload();
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
                     url: '<?=base_url()?>admin/delete_mpakses',
                     method: 'POST',
                     data: { id: data.id },
                     success: function(response) {
                        table.ajax.reload();
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
      userselect();

      function userselect(){
			$(".select2user").select2({ 	
				theme: "bootstrap-5",
				placeholder: 'User....',
			  	ajax: {
			    	url: "<?= base_url()?>admin/jabatanselect",
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
			            text: item.name ,
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
				placeholder: 'Menu main page....',
			  	ajax: {
			    	url: "<?= base_url()?>admin/main_pageselect",
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