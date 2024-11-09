<?php include "Views/Templates/header.php"; ?>
<div class="bg mb-3">
  <div>
    <h2 class="mt-3"> Usuarios </h2>
  </div>
</div>

<button class="btn btn-primary mb-3" type="button" onclick="frmUsuario();">Nuevo <i
    class="bi bi-person-fill-add"></i></button>

<a class="btn btn-warning mb-3 " href="<?php echo base_url; ?>Usuarios/inactivos">Inactivos<i
    class="bi bi-person-fill-slash"></i></a>


<!-- table table-dark // para volver la tabla oscuro-->

<div class="row">
    <div class="col-lg-12">
      
              
        <table class="table table-hover table-bordered " id="tblUsuarios" style="width: 100%;">
          <thead class="table-dark  ">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">CI</th>
              <th scope="col">Nombres</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Email</th>
              <th scope="col">telefono</th>
              <th scope="col">Usuario</th>
              <th scope="col">Estado</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>

        </table>

        </div>
        </div>
       



        <!-- Modal -->
        <div class="modal fade" id="nuevo_usuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white " id="title">Modal title</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form method="post" id="frmUsuario">
                <div class="form-group">
                        <label for="ci" class="form-label">CI</label>
                        <input id="ci" class="form-control" type="number" name="ci" placeholder="ci">
                      </div>
                  <div class="form-group mb-1">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="hidden" id="id" name="id">
                    <input id="nombres" class="form-control" type="text" name="nombres" placeholder="Nombre">
                  </div>
                  <div class="form-group mb-1">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input id="apellidos" class="form-control" type="text" name="apellidos" placeholder="Apellidos">
                  </div>
                  <div class="row mb-1" id="">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" type="email" name="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input id="telefono" class="form-control" type="telefono" name="telefono" placeholder="Telefono">
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-1">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input id="usuario" class="form-control" type="text" name="usuario" placeholder="Usuario">
                  </div>
                  <div class="row " id="claves">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="clave" class="form-label">Clave</label>
                        <input id="clave" class="form-control" type="password" name="clave" placeholder="Clave">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="confirmar" class="form-label">Confirmar Clave</label>
                        <input id="confirmar" class="form-control" type="password" name="confirmar"
                          placeholder="Confirmar Clave">
                      </div>
                    </div>
                  </div>

                </form>


              </div>
              <div class="modal-body ">

                <button type="button" class="btn btn-primary" onclick="registrarUser(event);" id="btnAccion">Registrar></button>
                <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Cerrar</button>
              </div>

            </div>
          </div>
        </div>

        <!-- fin de Modal -->




        <?php include "Views/Templates/footer.php"; ?>