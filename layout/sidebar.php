<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="template/index3.html" class="brand-link">
    <img src="img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Diskominfo</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="img/avatar.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info" id="usernameInfo">
        
      <a href="profile.php" class="d-block"> 
      <?php echo $user_email; ?>
  </a>
       
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
             
            </p>
          </a>
          
        </li>

        <li class="nav-item">
          <a href="tamu.php" class="nav-link">
            <i class="nav-icon fas fa-book-open"></i>
            <p>
              Buku Tamu
              <span class="badge badge-info right"></span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="kategori.php" class="nav-link">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Kategori Tujuan
              <span class="badge badge-info right"></span>
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="feedback.php" class="nav-link">
            <i class="nav-icon far fa-thumbs-up"></i>
            <p>
              Feedback Pelanggan
              <span class="badge badge-info right"></span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="profile.php" class="nav-link">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
              Data Pengguna
              <span class="badge badge-info right"></span>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="register_admin.php" class="nav-link">
            <i class="nav-icon fas fa-user-alt"></i>
            <p>
              Tambah User
              <span class="badge badge-info right"></span>
            </p>
          </a>
        </li>
      </ul>
    
  </nav>
  <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>