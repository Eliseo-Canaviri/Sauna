<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sauna EDEN</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url; ?>Assets/img/favicon.png" />
  <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-4 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body ">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?php echo base_url; ?>Assets/img/dark-logo.png" width="180" alt="">
                </a>
                <p class="text-center">♣</p>
                <form class="text-center row g-3" id="frmLogin">
                <div class="col-md-12">
                  <!-- usuario input -->
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese Usuario ó email">
                    <label for="usuario">Usuario</label>
                  </div>

                  <!-- Password input -->
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="clave" name="clave" placeholder="Password">
                    <label for="clave">Password</label>
                  </div>
                  <div class="alert alert-danger text-center d-none" id="alerta" role="alert"></div>

          
                  <div class="d-flex align-items-center justify-content-center">

                    <button type="submit" class="btn btn-primary btn-user btn-block mb-2" onclick="frmLogin(event);">Iniciar Sesión</button>
                  </div>

                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Es nuevo en sistema?</p>
                    <a class="text-primary fw-bold ms-2" href="<?php echo base_url;?>Usuarios/registrarse">Cree una cuenta</a>
                  </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url; ?>Assets/js/jquery_3.7.0.min.js"></script>


  <script src="<?php echo base_url;?>Assets/js/bootstrap.bundle.min.js"></script>
  <script>
    const base_url = "<?php echo base_url; ?>";
  </script>
  <script src="<?php echo base_url; ?>Assets/js/login.js"></script>

</body>

</html>