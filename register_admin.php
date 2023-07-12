<?php
include('access_control.php');

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
  echo $email;
}

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
  <!-- jQuery -->
<script src="template/plugins/jquery/jquery.min.js"></script>

  <!-- Theme style -->
  <link rel="stylesheet" href="template/dist/css/adminlte.min.css">
</head>
<body class="Collapsed-transition sidebar-mini">
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
            <h1>Register</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>




<section class="mt-4 pb-5">
 <div class="container">

<div class="col-md-4 mx-auto">

   
    <div class="card mt-5">
        <div class="card-header text-center">
            <img src="img/logo.png" class="text-center" alt="Logo" style="height: 100px;" >
        </div>
<form id="registerForm" method="POST">
    <div class="card-body">
        <h2 class="card-title text-center mb-4">Register</h2>
    <div class="form-group">
        <input type="text" name="email" placeholder="Email" required class="form-control">
    </div>
    <div class="form-group">
        <input type="text" name="username" placeholder="Username" required class="form-control">
    </div>
    <div class="form-group">
        <input type="password" name="password" placeholder="Password" required class="form-control">
    </div>
    <div class="form-group">
        <select name="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="tamu">Tamu</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
   <a  type="submit"  class="btn btn-success"href="login.html">Login</a>
</form>

</div>

</div>
<script>
$(document).ready(function() {
    $('#registerForm').submit(function(e) {
        e.preventDefault(); // Mencegah submit form secara default

        // Mengambil data dari formulir
        var formData = $(this).serialize();

        // Mengirim permintaan AJAX ke register.php
        $.ajax({
            url: 'register.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration successful',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = "login.html"; // Redirect ke halaman login setelah popup ditutup
                    });
                } else if (response === 'error') {
                    alert('Registration failed. Please try again.');
                } else if (response === 'exists') {
                    alert('Email already registered.');
                }
            }
        });
    });
});
</script>
</section>

</div>






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
<script src="template/plugins/pdfmake/vfs_fonts.js"></script>
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
