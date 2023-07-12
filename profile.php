<?php
include('access_control.php');
include('koneksi.php'); // File koneksi database

// Mendapatkan data pengguna
$user_id = $_SESSION['user_id']; // Anda perlu menambahkan kode ini untuk mendapatkan user_id dari session
$sql = "SELECT * FROM user WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Memeriksa apakah data pengguna ditemukan
if (!$user) {
    // Redirect atau tindakan lain jika data pengguna tidak ditemukan
}

// Mendapatkan email pengguna
$user_email = $user['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profile Pengguna</title>
  
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
<body class="sidebar-mini">
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
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Profile</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle"
                     src="img/avatar.png"
                     alt="User profile picture">
              </div>
              <h3 class="profile-username text-center"><?php echo $user_email;?></h3>
              <a href="#" class="btn btn-primary btn-block"><b>Selamat Datang</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <h4>Data Pengguna</h4>
            </div><!-- /.card-header -->
            <div class="card-body">
              <form class="form-horizontal" id="feedbackForm">
                <div class="form-group row">
                  <label for="username" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="user_username" id="user_username" value="<?php echo $user['user_username'];?>" placeholder="Username">
                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user['user_id'];?>" placeholder="User ID">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo $user_email;?>" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="user_password" class="form-control" id="user_password" placeholder="Update Password">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </form>
            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section><!--/.content -->



  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
<!-- DataTables & Plugins -->
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
<!-- SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
  // Menggunakan SweetAlert untuk menampilkan notifikasi setelah submit
  $('#feedbackForm').submit(function(e) {
    e.preventDefault();

    // Mengambil data dari form
    var user_id = $('#user_id').val();
    var user_username = $('#user_username').val();
    var user_password = $('#user_password').val();

    // Mengirim data menggunakan AJAX
    $.ajax({
      type: 'POST',
      url: 'profile_endpoint.php', 
      data: {
        user_id: user_id,
        user_username: user_username,
        user_password: user_password
      },
      success: function(response) {
        // Menampilkan notifikasi dengan SweetAlert
        Swal.fire({
          title: 'Success',
          text: 'Profile updated successfully',
          icon: 'success',
          showCancelButton: false,
          confirmButtonText: 'OK',
          confirmButtonColor: '#3085d6',
        }).then(function(result) {
          if (result.isConfirmed) {
            location.reload();
          }
        });
      },
      error: function(response) {
        // Menampilkan notifikasi dengan SweetAlert
        Swal.fire({
          title: 'Error',
          text: 'An error occurred. Please try again later.',
          icon: 'error',
          showCancelButton: false,
          confirmButtonText: 'OK',
          confirmButtonColor: '#d33',
        });
      }
    });
  });
});
</script>
</body>
</html>
