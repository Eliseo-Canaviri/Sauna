<?php include "Views/Templates/header.php"; ?>
<div class="bg mb-3">
  <div>
    <h2 class="mt-3"> Inactivos ♠</h2>
  </div>
</div>
<a class="btn btn-primary mb-3 " href="<?php echo base_url; ?>Usuarios"><i class="bi bi-reply-all"></i>Regresar </a>

<h1></h1>

<!-- table table-dark // para volver la tabla oscuro-->
<table class="table table-light " id="tblInactivos">
    <thead class="table-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Usuario</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>



        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['usuarios'] as $row) {
            if ($row['estado'] == 0) {
                $estado = '<span class="badge bg-danger">Inactivo</span>';
            }
            ?>
            <tr>
                <td>
                    <?php echo $row['id_usuario']; ?>
                </td>
                <td>
                    <?php echo $row['nombres']; ?>
                </td>
                <td>
                    <?php echo $row['apellidos']; ?>
                </td>
                <td>
                    <?php echo $row['email']; ?>
                </td>
                <td>
                    <?php echo $row['telefono']; ?>
                </td>
                <td>
                    <?php echo $row['usuario']; ?>
                </td>

                <td>
                    <?php echo $estado; ?>
                </td>
                <td>
                    <button class="btn btn-primary" type="button" onclick="btnReingresarUser(<?php echo $row['id_usuario'] ?>);"><i
                            class="ti ti-trash-x"></i></button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>



<?php include "Views/Templates/footer.php"; ?>