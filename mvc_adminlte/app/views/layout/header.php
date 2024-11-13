<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Penjualan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/adminlte/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Sidebar toggle button-->
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Additional Navbar Links -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="public/adminlte/index3.html" class="brand-link">
        <img src="public/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Sistem Penjualan</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="index.php?page=beranda" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Beranda</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?page=produk" class="nav-link">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p class="text">Produk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?page=pelanggan" class="nav-link">
                <i class="nav-icon far fa-circle text-success"></i>
                <p class="text">Pelanggan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?page=transaksi" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p class="text">Transaksi</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

  </div>