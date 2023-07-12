
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
          <div class="col-md-8 mx-auto">
            <div class="card">
              <div class="card-header">
                <h3 class="text-center">Selamat datang di dinas Kominfo Pakpak Barat</h3>
              </div>
              <div class="card-body">
                <h1>Halaman Admin</h1>
    
                <div id="scanner-container" class="d-flex justify-content-center">
                  <video id="scanner-video" class="w-100"></video>
                </div>
    
                <div id="result-container">
                  <h2>Hasil Pemindaian</h2>
                  <div id="result"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Tambahkan library SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Tambahkan script berikut untuk pemindaian otomatis -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
      // Buat objek Instascan dan konfigurasinya
      const scanner = new Instascan.Scanner({ video: document.getElementById('scanner-video') });
    
      // Memulai pemindaian
      Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function(error) {
        console.error(error);
      });
    
      // Fungsi untuk menampilkan Sweet Alert
      function showSuccessAlert(message) {
        Swal.fire({
      title: 'Sukses',
      text: message,
      icon: 'success',
      confirmButtonText: 'OK'
    }).then(function() {
      location.reload(); // Memuat ulang halaman setelah diklik tombol "OK"
    });
  }
    
      function showErrorAlert(message) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: message
        });
      }
    
      // Fungsi yang dijalankan saat pemindaian berhasil
      scanner.addListener('scan', function(content) {
        const resultContainer = document.getElementById('result');
        resultContainer.textContent = content;
    
        // Kirim data ke server PHP
        $.ajax({
          url: 'save_scan.php',
          type: 'POST',
          data: { data: content },
          success: function(response) {
            // Menampilkan Sweet Alert berdasarkan respons dari backend
            var data = JSON.parse(response);
            if (data.success) {
              
              showSuccessAlert(data.message);
              resultContainer.textContent = ''; // Mengosongkan hasil pemindaian setelah berhasil disimpan
              
            } else {
              showErrorAlert(data.message);
            }
          },
          error: function(xhr, status, error) {
            console.error('Terjadi kesalahan saat mengirim data ke server:', error);
          }
        });
      });
    </script>
    
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
                  <th>No</th>
                  <th>Nama Tamu</th>
                  <th>Instansi</th>
                  <th>Telepon</th>
                  <th>Keperluan</th>
                  <th>Tujuan</th>
                  <th>Feedback</th>
                  <th>Waktu Tiba</th>
                  <th>Waktu Keluar</th>
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
<!-- /.content -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
  // Mengambil data dari database menggunakan AJAX
  $.ajax({
    url: 'get_tamu.php',
    method: 'GET',
    dataType: 'json',
    success: function(response) {
      var data = response;
      var table = $('#example1').DataTable();

      // Menambahkan data ke dalam tabel
      for (var i = 0; i < data.length; i++) {
        var updatedDate = new Date(data[i].tamu_updated_at);
        

        // Mengambil nomor urutan dari jumlah data
        var noUrutan = i + 1;

        table.row.add([
          noUrutan,
          data[i].tamu_nama,
          data[i].tamu_instansi,
          data[i].tamu_telepon,
          data[i].tamu_keperluan,
          data[i].tamu_tujuan,
          data[i].tamu_feedback,         
          data[i].tamu_created_at,
          data[i].tamu_updated_at,
        ]).draw(false);
      }
    },
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});

</script>




  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Diskominfo</b> 
    </div>
    <strong>Copyright &copy; 2023 <a href="">Diskominfo</a>.</strong> 
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- <script src="template/plugins/jquery/jquery.min.js"></script> -->
<!-- Mengimpor library jQuery -->

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
</body>
</html>
