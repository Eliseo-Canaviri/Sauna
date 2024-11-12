<?php include "Views/Templates/header.php"; ?>


<h1 class="mt-3 mb-3">Dashboard</h1>

<div class="row">



  <!-- sauna 1-->
  <div class="container">
    <div class="row ">

      <?php foreach ($data['sauna'] as $row) { ?>
        <div class="col-xl-3 col-md-3">
          <div class="card bg-info text-white mb-2">

            <div class=" form-control fs-6 text-center text-bg-info ">
              Sauna # <?php echo $row['numero_sauna']; ?><br>
              <span class="text-light fs-5 "> <?php echo $row['tipo']; ?> <span class="badge rounded-pill text-bg-light"><?php echo $row['precio']; ?> Bs.</span>  </span>
            </div>


            <div class="text-center">

              <img src="<?php echo base_url; ?>Assets/img/user-1.jpg" width="150" height="150" class="" alt="">
            </div>

            <div class="modal-header  d-flex align-items-center justify-content-between mt-2 mb-2 ">


              <button class="btn btn-success " type="button" onclick="frmReservaPanel(<?php echo $row['id_sauna']; ?>)">Reservar </button>
              <button class="btn btn-warning " type="button" onclick="frmReservaHoras(<?php echo $row['id_sauna']; ?>)">Horas Disp. </button>

            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <!-- fin sauna 1 -->

  <!-- sauna 5 
  <div class="col-xl-3 col-md-6">
    <div class="card bg-info text-white mb-2">
      <div class="card-body form-control fs-6 text-center ">
        Sauna # 5<br>
        <span class="text-dark fs-5 ">Familiar </span>
      </div>

      <div class="text-center">
        <img src="<?php echo base_url; ?>Assets/img/user-1.jpg" width="200" height="150" class="" alt="">
      </div>
      <div class="card-footer d-flex align-items-center justify-content-between">
        <button class="btn btn-primary small text-white stretched-link form-control" type="button" onclick="frmReserva();">Reservar <i
            class="bi bi-person-fill-add"></i></button>
        <div class="small text-white"><i class="fas fa-angle-right"></i></div>


      </div>
    </div>
  </div>
   -->



</div>
<?php
// Establecer la zona horaria para Bolivia
date_default_timezone_set('America/La_Paz'); // Cambia esto a la zona horaria de Bolivia

// Obtener la hora actual en formato HH:MM
$current_time = date('H:i');
// Sumar una hora a la hora actual
$hora_fin = date('H:i', strtotime($current_time) + 3600); // 3600 segundos = 1 hora
?>


<!-- Modal  Reservas -->
<div class="modal fade" id="nuevo_reservaPanel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 text-white " id="title">Modal title</h1>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="POST" id="frmReservaPanel">
          <div class="form-group mb-1">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="hidden" id="id" name="id">
            <input id="nombres" class="form-control" type="text" name="nombres" placeholder="Nombre" value="<?php echo $_SESSION['nombres'] ?>" disabled>
          </div>
          <div class="form-group mb-1">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input id="apellidos" class="form-control" type="text" name="apellidos" placeholder="Apellidos" value=" <?php echo $_SESSION['apellidos'] ?>" disabled>
          </div>
          <div class="row mb-1" id="">
            <div class="col-md-6">
              <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control" type="text" name="email" placeholder="Email" value="<?php echo $_SESSION['email'] ?>" disabled>
              </div>
            </div>

            <!-- 
              <input id="fecha" class="form-control" type="text" name="fecha" value="<?php echo date('Y-m-d'); ?>" readonly>
                 -->

            <div class="col-md-6">
              <div class="form-group">
                <label for="fecha" class="form-label">Fecha</label>
                <input id="fecha" class="form-control" type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>">
              </div>
            </div>
          </div>


          <!-- Sacando id  -->
       <div class="form-group mb-1" >
        <!-- 
          <label for="idsauna" class="form-label">Id Sauna</label>
        -->
            <input id="idsauna" class="form-control" type="hidden" name="idsauna" placeholder="id sauna">
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
                  placeholder="Confirmar Clave" value="<?php echo $hora_fin; ?>">
              </div>
            </div>
          </div>

        </form>


      </div>
      <div class="modal-body ">

        <button type="button" class="btn btn-primary" onclick="RegistrarReservaPanel(event);" id="btnAccion">Registrar</button>
        <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<!-- fin de Modal Reservas-->

<!-- Modal  Horas -->
<div class="modal fade" id="nuevo_reservaHoras" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5 text-white " id="titleHoras">Modal title</h1>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="POST" id="frmReservaHoras">

          <div class="form-group mb-1">
            <!-- 
              <label for="idsaunaHoras" class="form-label">Id Sauna</label>
           -->
            <input id="idsaunaHoras" class="form-control" type="hidden" name="idsaunaHoras" placeholder="id sauna">
          </div>
          <table class="table table-light">
            <thead class="thead-light">
              <tr>

                <th>Id Sauna</th>
                <th>Fecha Actual</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Estado</th>


              </tr>
            </thead>
            <tbody id="tblHoras">

            </tbody>
          </table>







        </form>


      </div>
      <div class="modal-body ">

        <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Cerrar</button>
        
      </div>

    </div>
  </div>
</div>

<!-- fin de Modal Reservas-->



<?php include "Views/Templates/footer.php"; ?>