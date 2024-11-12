<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-3">
    <li class="breadcrumb-item active ">Reportes ☻</li>
</ol>

<div class="container mt-4 mb-4">
    <form method="POST" id="frmFiltrar">
        <div class="row">
            <div class="col-md-3">
                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                <div class="input-group ">
                    <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="Seleccione fecha de inicio">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                <div class="input-group ">
                    <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="Seleccione fecha de fin">
                    <span class="input-group-text">
                        <i class="bi bi-calendar"></i>
                    </span>
                </div>
            </div>

            <div class="col-md-4 align-self-end">
                <button type="button" class="btn btn-primary" onclick="btnReportesFiltrar(event)">Filtrar</button>

            </div>
        </div>
    </form>
</div>
<form action="<?php echo base_url; ?>Reportes/GenerarPdf" method="POST" target="_blank">
    <div class="row">
        <div class="col-md-3 d-md-none d-lg-none">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <div class="input-group">
                <input type="date" id="fecha_iniciopdf" name="fecha_iniciopdf" class="form-control" placeholder="Seleccione fecha de inicio">
                <span class="input-group-text">
                    <i class="bi bi-calendar"></i>
                </span>
            </div>
        </div>

        <div class="col-md-3 d-md-none d-lg-none">
            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
            <div class="input-group ">
                <input type="date" id="fecha_finpdf" name="fecha_finpdf" class="form-control" placeholder="Seleccione fecha de fin">
                <span class="input-group-text">
                    <i class="bi bi-calendar"></i>
                </span>
            </div>
        </div>
        <div class="col-md-4 position-relative text-end">
    <button type="submit" class="btn btn-danger position-absolute" style="top: -61px; right: -370px;">
        Generar Pdf
    </button>
</div>


    </div>
</form>

<!-- table table-dark // para volver la tabla oscuro-->
<table class="table table-light" id="tblFechaFiltrar">
    <thead class="thead-light">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Usuario</th>
            <th scope="col">Sauna</th>
            <th scope="col">Fecha </th>
            <th scope="col">Hora Inicio</th>
            <th scope="col">Hora Fin</th>
       
            <th scope="col">Acciones</th>

        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<div id="nuevo_estudiante" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Estudiante</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmEstudiante">

                    <div class="form-group">
                        <label for="ci">Dni</label>
                        <input type="text" id="id" name="id">
                        <input id="ci" class="form-control" type="text" name="ci" placeholder="Dni">
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre del Estudiante</label>

                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombres">
                    </div>

                    <button class="btn btn-primary" type="button" onclick="registrarEstudiante(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include "Views/Templates/footer.php"; ?>