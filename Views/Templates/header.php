<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sauna ♣</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>Assets/img/favicon.png" />
  <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/styles.min.css" />

  <link href="<?php echo base_url; ?>Assets/css/jquery-ui.min.css" rel="stylesheet" />
  <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
  <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
  <link href="<?php echo base_url; ?>Assets/css/datatables.min.css" rel="stylesheet" crossorigin="anonymous" />

</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>

        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="<?php echo base_url ?>Administracion/home" class="text-nowrap logo-img">
            <img src="<?php echo base_url; ?>Assets/img/dark-logo.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">

          <ul id="sidebarnav">

            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo base_url ?>Administracion/home" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">COMPONENTES</span>
            </li>

            <?php if ($_SESSION['id_usuario'] == 1): ?>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo base_url ?>ConfigAdmin" aria-expanded="false">
                  <span>
                    <i class="ti ti-settings"></i>
                  </span>
                  <span class="hide-menu">Institución</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo base_url ?>Usuarios" aria-expanded="false">
                  <span>
                    <i class="ti ti-article"></i>
                  </span>
                  <span class="hide-menu">Usuarios</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo base_url ?>Saunas" aria-expanded="false">
                  <span>
                    <i class="ti ti-home-infinity"></i>
                  </span>
                  <span class="hide-menu">Saunas</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="<?php echo base_url ?>Reportes" aria-expanded="false">
                  <span>
                    <i class="ti ti-report"></i>
                  </span>
                  <span class="hide-menu">Reportes</span>
                </a>
              </li>
            <?php endif; ?>


            <li class="sidebar-item">
              <a class="sidebar-link" href="<?php echo base_url ?>Reservas" aria-expanded="false">
                <span>
                  <i class="ti ti-devices-pc"></i>
                </span>
                <span class="hide-menu">Reservas</span>
              </a>
            </li>



          </ul>

        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>

          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              


            <!-- Nav Item - Alerts -->
<?php if ($_SESSION['id_usuario'] == 1): ?>
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alert" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="ti ti-bell-minus fs-5"></i>
            <!-- Counter - Alerts -->
            <span id="TotalAlerta" class="badge bg-danger badge-counter"></span>
        </a>

        <!-- Alerts -->
        <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="alert">
            <h5 class="dropdown-header">Alertas</h5>
            <li>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div id="reservas-container">
                        <div id="reservas-list"></div>
                    </div>
                </a>
            </li>
        </ul>
    </li>
<?php endif; ?>
<!-- fin de alertas -->

              <span class="mr-2 d-none d-lg-inline text-gray-600 form-label "> ¡Hola!
                <?php echo $_SESSION['nombres'] ?>
              </span>

              <li class="nav-item dropdown">

                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="<?php echo base_url; ?>Assets/img/user-1.png" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="<?php echo base_url; ?>Usuarios/perfil" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Mi Perfil</p>
                    </a>

                    <a href="<?php echo base_url; ?>Usuarios/salir" class="btn btn-outline-primary mx-3 mt-2 d-block">Salir</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex ">
            <div class="card w-100 ">
              <div class="card-body">
              <?php
// Establecer la zona horaria de Bolivia
date_default_timezone_set('America/La_Paz');
?>