<?php include "Views/Templates/header.php";?>
<div class="">
  <div>
    <h2 class=""> Saunas</h2>
  </div>
</div>
 <button class="btn btn-primary mb-3"type="button" onclick="frmSauna();">Nuevo <i class="fa fa-user-plus"></i></button>
 <!-- table table-dark // para volver la tabla oscuro-->
        <table class="table table-light"id="tblSauna">     
        <thead class="table-dark">
                                <tr>
                                
                                 
                                  <th scope="col"># Sauna</th>
                                  <th scope="col">Tipo</th>
                                  <th scope="col">Precio (Bs.)</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col">Acciones</th>               
                                 
                                </tr>
         </thead>
                                                       
      </table>
  <!-- Modal -->
  <div class="modal fade" id="nuevo_sauna" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white " id="title">Modal title</h1>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                <form method="POST" id="frmSauna">
                <div class="form-group mb-1">
                  <label for="numero_sauna" class="form-label">Numero de Sauna</label>
                  <input type="hidden" id="id" name="id">
                    <input id="numero_sauna" class="form-control" type="text" name="numero_sauna" placeholder="Numero">
                  </div>
                  <div class="form-group mb-1">
                    <label for="tipo" class="form-label">Tipo</label>
                    <input id="tipo" class="form-control" type="text" name="tipo" placeholder="Tipos se sauna">
                  </div>
                  <div class="form-group mb-1">
                    <label for="precio" class="form-label">Precio (Bs.)</label>
                    <input id="precio" class="form-control" type="text" name="precio" placeholder="Precio">
                  </div>
               
                

                </form>


              </div>
              <div class="modal-body ">

                <button type="button" class="btn btn-primary" onclick="registrarSauna(event);" id="btnAccion">Registrar></button>
                <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Cerrar</button>
              </div>

            </div>
          </div>
        </div>

        <!-- fin de Modal -->



<?php  include "Views/Templates/footer.php";?>