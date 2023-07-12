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
                            <h3 class="text-center">Selamat datang di dinas Kominfo Pakpak Barat</h3>
                        </div>

                        <div class="card-body">

                    <h3 class="text-center">QRCode Buku Tamu</h3>
                    <div id="form-container">
        <!-- <h4>Form Tamu</h4> -->
                <form id="tamu-form">
                    <!-- <label for="nama">User ID:</label> -->
                    <input type="hidden" id="user_id" name="user_id"  value="<?php echo $user_id; ?>" class="form-control" required>
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" class="form-control" required>
                   
                    
                    <label for="organisasi">Organisasi/Instansi/Masyarakat:</label>
                    <input type="text" id="organisasi" name="organisasi" class="form-control" required>
                    
                    <label for="tujuan">Tujuan:</label>
                    <select id="tujuan" name="tujuan" class="form-control" required>
                      <option value="">Pilih Tujuan</option>
                      <!-- Opsi akan diisi secara dinamis oleh JavaScript -->
                    </select>
                    <input type="hidden" id="kategori_tujuan" name="kategori_tujuan">
                   
                    
                    <label for="keperluan">Keperluan:</label>
                    <input type="text" id="keperluan" name="keperluan" class="form-control" required>
                    
                    <label for="phone">No. Telepon/HP:</label>
                    <input type="tel" id="phone" name="phone"  class="form-control" required>
                    
                    <button type="button" class="btn btn-success" onclick="saveData()">Save to Generate QR Code</button>
                </form>
            </div>
            <div id="qrcode-container" style="display: none;" >
                <h2>QR Code</h2>
                <div class="text-center" id="qrcode"></div>
            </div>
                          




                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>



    <!-- script untuk tujuan -->
   
<script>
   function fillTujuanOptions() {
    var tujuanSelect = document.getElementById("tujuan");

    // Membuat request AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "get_kategori.php", true);

    // Mengatur callback untuk menangani respon AJAX
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Parsing respon JSON menjadi objek JavaScript
            var tujuan = JSON.parse(xhr.responseText);

            // Mengisi opsi "Tujuan" dengan data dari server
            for (var i = 0; i < tujuan.length; i++) {
                var option = document.createElement("option");
                option.value = tujuan[i].kategori_id;
                option.text = tujuan[i].kategori_tujuan;
                tujuanSelect.appendChild(option);
            }
        }
    };

    // Mengirim request AJAX
    xhr.send();
}



// Mendapatkan referensi elemen select "tujuan" dan input "kategori_tujuan"
var tujuanSelect = document.getElementById("tujuan");
var kategoriTujuanInput = document.getElementById("kategori_tujuan");

// Menambahkan event listener untuk perubahan pada select "tujuan"
tujuanSelect.addEventListener("change", function() {
    // Mendapatkan nilai kategori_tujuan terpilih
    var selectedKategori = tujuanSelect.options[tujuanSelect.selectedIndex].text;

    // Memasukkan nilai kategori_tujuan ke dalam input "kategori_tujuan"
    kategoriTujuanInput.value = selectedKategori;
});
// Panggil fungsi fillTujuanOptions() saat halaman selesai dimuat
window.onload = fillTujuanOptions;

 

</script>
   

<script>
    // Fungsi untuk menyimpan data tamu dan menampilkan QR Code
    
       
  
function saveData() {
    const nama = document.getElementById('nama').value;
    const organisasi = document.getElementById('organisasi').value;
    const tujuan = document.getElementById('tujuan').value;
    const kategori_tujuan = document.getElementById('kategori_tujuan').value;

    const keperluan = document.getElementById('keperluan').value;
    const phone = document.getElementById('phone').value;
    const user_id = document.getElementById('user_id').value;
    
    const tamuData = {

        
      
        user_id,
        tujuan,
        nama,
        organisasi,
        phone,
        keperluan,
        kategori_tujuan
    };

    // Kirim data tamu ke server (misalnya menggunakan AJAX atau Fetch API)
    // Setelah berhasil, tampilkan QR Code
    const qrCodeContainer = document.getElementById('qrcode-container');
    const qrCodeElement = document.getElementById('qrcode');

    // Buat URL data JSON untuk QR Code
    const jsonData = JSON.stringify(tamuData);
   
    const qrCodeDataUrl = `data:text/plain;charset=utf-8,${encodeURIComponent(jsonData)}`;

    // Tampilkan QR Code
    qrCodeElement.innerHTML = '';
    const imgElement = document.createElement('img');
    imgElement.src = `https://api.qrserver.com/v1/create-qr-code/?data=${qrCodeDataUrl}&size=200x200`;
    qrCodeElement.appendChild(imgElement);

    // Tampilkan kontainer QR Code
    qrCodeContainer.style.display = 'block';
}

</script>





<!-- end scander -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

           

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




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
