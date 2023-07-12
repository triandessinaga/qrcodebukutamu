
<?php

include('access_control.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Diskominfo</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="template/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
   <!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    
  </ul>

  <!-- Center navbar text -->
  <div class="navbar-text mx-auto">
    <p id="datetime" class="text-center font-weight-bold text-primary"></p>
  </div>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a href="logout.php" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->


<!-- time -->
<!-- Add the following CSS code -->
<style>
  .navbar-text {
    flex-grow: 1;
  }
</style>

<!-- Add the JavaScript code -->
<script>
  function updateDateTime() {
    var now = new Date();
    var day = now.toLocaleString("default", { weekday: "long" });
    var date = now.toLocaleDateString("default", { year: "numeric", month: "long", day: "numeric" });
    var time = now.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
    var datetime = day + ', ' + date + ' ' + time;
    document.getElementById("datetime").innerHTML = datetime;
  }
  
  // Update the date and time every second
  setInterval(updateDateTime, 1000);
  
  // Initial update of the date and time
  updateDateTime();
</script>



<!-- sidebar -->
<?php
if ($user_role == "admin") {
    ?>
    <!-- sidebar -->
    <?php include 'layout/sidebar.php'; ?>
    <?php
} elseif ($user_role == "tamu") {
    ?>
    <!-- sidebar -->
    <?php include 'layout/sidebar_tamu.php'; ?>
    <?php
} else {
    
}
?>
      
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    


    <section class="mt-4 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card">
            <div class="card-header">
              <h3 class="text-center">Form Input Kategori</h3>
              <form id="kategoriForm">
                <div class="form-group">
                  <label for="tujuan">Tujuan</label>
                  <input type="text" name="tujuan" class="form-control" id="tujuan" placeholder="Masukkan tujuan instansi">
                </div>
                <button type="submit" class="btn btn-primary">Tambah Kategori</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




    <!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tabel Tamu</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">

              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama Kategori</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Tempat untuk menampilkan data dari database -->
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>



 <!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
      
      </div>
      <div class="modal-body">
        <form id="editForm">
          <input type="hidden" id="editId" name="kategori_id">
          <div class="mb-3">
            <label for="editTujuan" class="form-label">Tujuan</label>
            <input type="text" class="form-control" id="editTujuan" name="tujuan">
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
          
          
  
</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" id="editbatal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Apakah Anda yakin ingin menghapus kategori ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="deleteBtn">Hapus</button>
      </div>
    </div>
  </div>
</div>





  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function() {
      // Menggunakan jQuery untuk menangani pengiriman form secara asynchronous
      $('#kategoriForm').submit(function(event) {
        event.preventDefault(); // Mencegah form dikirimkan secara default

        var tujuan = $('#tujuan').val(); // Mengambil nilai input tujuan

        // Mengirim data form ke server menggunakan AJAX
        $.ajax({
          url: 'kategori_endpoint.php', // Ubah dengan URL endpoint yang sesuai dengan file "kategori.php"
          method: 'POST',
          data: { tujuan: tujuan },
          success: function(response) {
            // Menampilkan pesan sukses menggunakan SweetAlert
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: response.message
            }).then(() => {
              // Reload halaman setelah pesan sukses ditutup
              location.reload();
            });

            // Mengosongkan form
            $('#kategoriForm')[0].reset();
          },
          error: function(err) {
            // Menampilkan pesan error atau melakukan penanganan error lainnya
            console.error(err.responseJSON.message);
          }
        });
      });
    });
  </script>
</div>



</script>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Diskominfo</b> 
    </div>
    <strong>Copyright &copy; 2023 <a href="">Diskominfo</a>.
    </strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Bootstrap 4 -->
<script src="template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="template/plugins/jszip/jszip.min.js"></script>
<script src="template/plugins/pdfmake/pdfmake.min.js"></script>
<script src="template/plugins/pdfmake/vfs_fonts.js"></script>s
<script src="template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="template/dist/js/adminlte.min.js"></script>

<!-- AdminLTE App -->
<script src="template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="template/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": [ "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


  <script>
    $(document).ready(function() {
      // Cek apakah DataTable sudah diinisialisasi sebelumnya
      if ($.fn.DataTable.isDataTable('#example1')) {
        // Jika sudah diinisialisasi, hancurkan DataTable sebelumnya
        $('#example1').DataTable().destroy();
      }

      // Mengambil data dari database menggunakan AJAX
      $.ajax({
        url: 'kategori_data.php', // Ganti dengan URL yang sesuai untuk mengambil data dari database
        method: 'GET',
        dataType: 'json',
        success: function(response) {
          var data = response;

          // Inisialisasi tabel DataTable
          var table = $('#example1').DataTable({
            data: data,
            columns: [
              { data: 'kategori_id' },
              { data: 'kategori_tujuan' },
              {
                data: null,
                render: function(data, type, row) {
                  // Tambahkan tautan Edit dan Delete
                  return '<a href="#" class="edit-btn btn btn-warning" data-id="' + data.kategori_id + '">Edit</a> | ' +
                    '<a href="#" class="delete-btn btn btn-danger" data-id="' + data.kategori_id + '">Delete</a>';
                }
              }
            ]
          });

          var modal = new bootstrap.Modal(document.getElementById('editModal'));

          // Event listener untuk tombol Edit
          $('#example1').on('click', '.edit-btn', function() {
            var kategoriId = $(this).data('id');
            var kategoriTujuan = table.row($(this).closest('tr')).data().kategori_tujuan;
            editKategori(kategoriId, kategoriTujuan);
          });

          // Event listener untuk tombol Delete
          $('#example1').on('click', '.delete-btn', function() {
            var kategoriId = $(this).data('id');
            deleteKategori(kategoriId);
          });
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });

      // Fungsi untuk menampilkan modal edit
        function editKategori(kategoriId, kategoriTujuan) {
          $('#editId').val(kategoriId);
          $('#editTujuan').val(kategoriTujuan);
          $('#editModal').modal('show');
          $('#editbatal').modal('close');
          
        }

        // Submit form edit
        $('#editForm').submit(function(e) {
          e.preventDefault();
          var kategoriId = $('#editId').val();
          var kategoriTujuan = $('#editTujuan').val();

          $.ajax({
            url: 'kategori_endpoint.php',
            method: 'PUT',
            data: {
              kategori_id: kategoriId,
              tujuan: kategoriTujuan
            },
            success: function(response) {
              Swal.fire({
                title: 'Sukses',
                text: response.message,
                icon: 'success'
              }).then(function() {
                location.reload();
              });
            },
            error: function(xhr, status, error) {
              console.error(error);
            }
          });
        });


      // Fungsi untuk menampilkan modal konfirmasi delete
      function deleteKategori(kategoriId) {
        Swal.fire({
          title: 'Konfirmasi',
          text: 'Apakah Anda yakin ingin menghapus kategori ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Hapus',
          cancelButtonText: 'Batal'
        }).then(function(result) {
          if (result.value) {
            $.ajax({
              url: 'kategori_endpoint.php',
              method: 'DELETE',
              data: {
                kategori_id: kategoriId
              },
              success: function(response) {
                Swal.fire({
                  title: 'Sukses',
                  text: response.message,
                  icon: 'success'
                }).then(function() {
                  location.reload();
                });
              },
              error: function(xhr, status, error) {
                console.error(error);
              }
            });
          }
        });
      }
    });
  </script>



</body>
</html>
