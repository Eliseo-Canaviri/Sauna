<?php include "Views/Templates/header.php"; ?>
<div class="bg mb-3">
    <div>
        <h2 class="mt-3"> Reservados ♠</h2>
    </div>
</div>
<a class="btn btn-primary mb-3 " href="<?php echo base_url; ?>Reservas"><i class="bi bi-reply-all"></i>Regresar </a>

<h1></h1>

<!-- table table-dark // para volver la tabla oscuro-->
<table class="table table-light " id="tblReservados2" style="width: 100%;">
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
    <tbody>
        <?php foreach ($data['reservados'] as $row) {
            if ($row['estado'] == 2) {
                $estado = '<span class="badge bg-warning">Reservado</span>';
            }
        ?>
            <tr>
                <td>
                    <?php echo $row['id_reserva']; ?>
                </td>
                <td>
                    <?php echo $row['nombres'] . ' ' . $row['apellidos']; ?>
                </td>

                <td>
                    <?php echo $row['tipo']; ?>
                </td>
                <td>
                    <?php echo $row['fecha']; ?>
                </td>
                <td>
                    <?php echo $row['hora_inicio']; ?>
                </td>
                <td>
                    <?php echo $row['hora_fin']; ?>
                </td>



                <td>
                    <?php echo $estado; ?>
                </td>
                <td>
                    <button class="btn btn-danger" type="button" onclick="btnReingresarReserva(<?php echo $row['id_reserva'] ?>);"><i class="ti ti-printer"></i></button>
      
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>



<?php include "Views/Templates/footer.php"; ?>