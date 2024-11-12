<?php include "Views/Templates/header.php"; ?>
<div class="bg mb-3">
  <div>
    <h2 class="mt-3"> Reservas </h2>
  </div>
</div>
<?php if ($_SESSION['id_usuario'] == 1) { ?> <!-- Assuming 'user_role' is the key you're checking -->

  <button class="btn btn-primary mb-3" type="button" onclick="frmReserva();">Nuevo <i class="fa fa-user-plus"></i></button>
  <a class="btn btn-warning mb-3" type="button" href="<?php echo base_url; ?>Reservas/reservados2">Reservados <i class="fa fa-user-plus"></i></a>
  <a class="btn btn-danger mb-3" type="button" href="<?php echo base_url; ?>Reservas/inactivos">Inactivos <i class="fa fa-user-plus"></i></a>

<?php } ?> <!-- Make sure to close the PHP tag correctly -->


<!--<div class="col-md-9">
    <div class="form-group">
        <label for="nombre">Nombres</label><br>
        <select name="nombre" id="nombre" class="form-control nombre" required style="width: 100%;">
        </select>
    </div>
</div>  -->


<!-- table table-dark // para volver la tabla oscuro-->
<table class="table table-light table-hover table-bordered" id="tblReservas" style="width: 100%;">
  <thead class="table-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nombres</th>
      <th scope="col">Sauna</th>
      <th scope="col">Fecha Actual</th>
      <th scope="col">Hora Inicio</th>
      <th scope="col">Hora Fin</th>
      <th scope="col">Estado</th>
      <th scope="col">Acciones</th>



    </tr>
  </thead>

</table>
<?php
// Establecer la zona horaria para Bolivia
date_default_timezone_set('America/La_Paz'); // Cambia esto a la zona horaria de Bolivia

// Obtener la hora actual en formato HH:MM
$current_time = date('H:i');
$hora_fin = date('H:i', strtotime($current_time) + 3600); // 3600 segundos = 1 hora
?>
<!-- Modal -->
<div class="modal fade" id="nuevo_reserva" data-bs-backdrop="static" tabindex="-1" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 text-white " id="title">Modal title</h1>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="POST" id="frmReserva">

          <div class="form-group mb-1">
            <input type="hidden" id="id" name="id">
          </div>

          <div class="row " id="claves">
            <div class="col-md-6">

              <!-- mi selct3 -->
              <div class="form-floating mb-3">
                <input type="hidden" id="id_user" name="id_user">
                <input id="select_usuario" class="form-control" type="text" name="select_usuario"
                  placeholder="Buscar por Nombre" required>
                <label for="select_usuario">Buscar Cliente <span class="text-danger fw-bold">*</span></label>
              </div>
              <!-- fin select3 -->
            </div>
            <div class="col-md-6">

              <!-- mi selct3  sauna -->
              <div class="form-floating mb-3">
                <input type="hidden" id="id_sau" name="id_sau">
                <input id="select_sauna" class="form-control" type="text" name="select_sauna"
                  placeholder="Buscar por Nombre" required>
                <label for="select_sauna">Buscar Sauna <span class="text-danger fw-bold">*</span></label>
              </div>
              <!-- fin select3 -->

            </div>
          </div>
          <div class="col-md-6 mb-3">

            <div class="form-group">
              <label for="fecha" class="form-label">Fecha</label>
              <input id="fecha" class="form-control" type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>">
            </div>
          </div>
          <div class="row " id="claves">
            <div class="col-md-6">
              <div class="form-group">
                <label for="hora_inicio" class="form-label">Hora Inicio</label>
                <input id="hora_inicio" class="form-control" type="time" name="hora_inicio" placeholder="Clave" value="<?php echo $current_time; ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="hora_fin" class="form-label">Hora Fin</label>
                <input id="hora_fin" class="form-control" type="time" name="hora_fin"
                  placeholder="Confirmar Clave" value="<?php echo $hora_fin; ?>" >
              </div>
            </div>
          </div>

        </form>


      </div>
      <div class="modal-body ">

        <button type="button" class="btn btn-primary" onclick="registrarReserva(event);" id="btnAccion">Registrar></button>
        <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- fin de Modal -->





<?php include "Views/Templates/footer.php"; ?>