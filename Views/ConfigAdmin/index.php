<?php include "Views/Templates/header.php"; ?>
<div class="card mt-4">
    <div class="card-header text-center bg-primary text-bg-info">
    Datos de la Institución
        <!--<?php print_r($data); ?> Para mostrar datos de la empresa-->
    </div>
    <div class="card-body ">
        <form id="frmConfig">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">

                        <input id="id" class="form-control" type="hidden" name="id" placeholder="id"
                            value="<?php echo $data['id'] ?>">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre"
                            value="<?php echo $data['nombre'] ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Telefono"
                            value="<?php echo $data['telefono'] ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Direccion"
                            value="<?php echo $data['direccion'] ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mensaje">Mensaje</label>
                        <textarea id="mensaje" class="form-control" name="mensaje"
                            rows="3"><?php echo $data['mensaje'] ?></textarea>
                    </div>
                </div>



            </div>

            <button class="btn btn-primary" type="button" onclick="modificarEmpresa()">Modificar</button>

        </form>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>