<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro</title>
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
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?php echo base_url;?>Assets/img/dark-logo.png" width="180" alt="">
                </a>
                <p class="text-center">Your Social Campaigns</p>
                <form method="post" id="frmUsuario">
                <div class="col-md-6">
                      <div class="form-group">
                      <input type="hidden" id="id" name="id">
                        <label for="ci" class="form-label">CI <samp class="text-danger">*</samp></label>
                        <input id="ci" class="form-control" type="text" name="ci" placeholder="CI">
                      </div>
                    </div>



                  <div class="row mb-3" id="claves">
                                     <div class="col-md-6">
                      <div class="form-group">
                      <input type="hidden" id="id" name="id">
                        <label for="nombres" class="form-label">Nombres <samp class="text-danger">*</samp></label>
                        <input id="nombres" class="form-control" type="text" name="nombres" placeholder="Nombres">
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="apellidos" class="form-label">Apellidos <samp class="text-danger">*</samp></label>
                        <input id="apellidos" class="form-control" type="text" name="apellidos"
                          placeholder="Apellidos  ">
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3" id="">
                    <div class="col-md-6 mb-3 ">
                      <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" type="text" name="email" placeholder="Email">
                      </div>
                    </div>

                    <div class="col-md-6 mb-3">
                      <div class="form-group">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input id="telefono" class="form-control" type="number" name="telefono"
                          placeholder="Ingrese Telefono">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <label for="usuario" class="form-label">Usuario <samp class="text-danger">*</samp></label>
                      <input id="usuario" class="form-control" type="text" name="usuario"
                        placeholder="Ingrese Usuario">
                    </div>
                  </div>


                  <div class="row mb-3" id="">
                    <div class="col-md-6 ">
                      <div class="form-group">
                        <label for="clave" class="form-label">Contraseña <samp class="text-danger">*</samp></label>
                        <input id="clave" class="form-control" type="password" name="clave" placeholder="Ingrese Contraseña">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="confirmar" class="form-label">Confirmar Contraseña <samp class="text-danger">*</samp></label>
                        <input id="confirmar" class="form-control" type="password" name="confirmar"
                          placeholder="Confirmar Contraseña">
                      </div>
                    </div>
                  </div>
                </form>
                <button type="button" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" onclick="registrarUserPrinciapal(event);" id="btnAccion">Registrar</button>


                <div class="d-flex align-items-center justify-content-center">
                  <p class="fs-4 mb-0 fw-bold">Ya tienes una cuenta?</p>
                  <a class="text-primary fw-bold ms-2" href="<?php echo base_url; ?>Usuarios">Iniciar Sesión</a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?php echo base_url; ?>Assets/js/jquery_3.7.0.min.js"></script>


  <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js"></script>
 
  <script>
    const base_url = "<?php echo base_url; ?>";
</script>
<script src=" <?php echo base_url; ?>Assets/js/sweetalert2.all.min.js "></script>
<script src="<?php echo base_url; ?>Assets/js/registrar.js"></script>
</body>

</html>