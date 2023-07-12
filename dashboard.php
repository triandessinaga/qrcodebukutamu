
<?php
include('access_control.php');
include('koneksi.php');


// Menghitung jumlah tamu dengan role "tamu"
$sql_jumlah_tamu = "SELECT COUNT(*) as total_tamu FROM user WHERE user_role = 'tamu'";
$result_jumlah_tamu = $conn->query($sql_jumlah_tamu);

if ($result_jumlah_tamu->num_rows > 0) {
    $row_jumlah_tamu = $result_jumlah_tamu->fetch_assoc();
    $jumlah_tamu = $row_jumlah_tamu['total_tamu'];
} else {
    $jumlah_tamu = 0;
}

// Menghitung jumlah admin dengan role "admin"
$sql_jumlah_admin = "SELECT COUNT(*) as total_admin FROM user WHERE user_role = 'admin'";
$result_jumlah_admin = $conn->query($sql_jumlah_admin);

if ($result_jumlah_admin->num_rows > 0) {
    $row_jumlah_admin = $result_jumlah_admin->fetch_assoc();
    $jumlah_admin = $row_jumlah_admin['total_admin'];
} else {
    $jumlah_admin = 0;
}

// Menghitung total user dengan jumlah tamu dan admin
$total_user = $jumlah_tamu + $jumlah_admin;

// Menghitung jumlah tamu yang mengisi data di tabel tamu
$sql_jumlah_tamu_tabel = "SELECT COUNT(*) as total_tamu_tabel FROM tamu";
$result_jumlah_tamu_tabel = $conn->query($sql_jumlah_tamu_tabel);

if ($result_jumlah_tamu_tabel->num_rows > 0) {
    $row_jumlah_tamu_tabel = $result_jumlah_tamu_tabel->fetch_assoc();
    $jumlah_tamu_tabel = $row_jumlah_tamu_tabel['total_tamu_tabel'];
} else {
    $jumlah_tamu_tabel = 0;
}

// Menutup koneksi ke database
$conn->close();
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
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>



    
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?php echo $jumlah_tamu; ?></h3>

            <p>Jumlah User Tamu</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?php echo $jumlah_admin; ?><sup style="font-size: 20px"></sup></h3>

            <p>Jumlah User Admin</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?php echo $total_user; ?></h3>

            <p>Total User</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
         
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?php echo $jumlah_tamu_tabel; ?></h3>

            <p>Data Buku Tamu </p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
         
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
    
    

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
