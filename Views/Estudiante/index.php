<?php include "Views/Templates/header.php";?>
<ol class="breadcrumb mb-3">
 <li class="breadcrumb-item active ">Estudiantes ☻</li>
</ol>
 <button class="btn btn-primary mb-3"type="button" onclick="frmEstudiante();">Nuevo <i class="fa fa-user-plus"></i></button>
 <!-- table table-dark // para volver la tabla oscuro-->
        <table class="table table-light"id="tblestudiante">     
        <thead class="thead-light">
                                <tr>
                                  <th scope="col">Id</th>
                                  <th scope="col">DNI</th>
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col">Acciones</th>
                                  
                    
                                 
                                </tr>
         </thead>
                                                       
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

                    <button class="btn btn-primary" type="button"onclick="registrarEstudiante(event);"id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button"data-dismiss="modal" >Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php  include "Views/Templates/footer.php";?>