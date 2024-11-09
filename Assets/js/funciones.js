let tblUsuarios, tblUsuariosInactivos, tblSauna, tblReservas;
document.addEventListener("DOMContentLoaded", function () {
  const language = {
    decimal: "",
    emptyTable: "No hay información",
    info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
    infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
    infoFiltered: "(Filtrado de _MAX_ total entradas)",
    infoPostFix: "",
    thousands: ",",
    lengthMenu: "Mostrar _MENU_ Entradas",
    loadingRecords: "Cargando...",
    processing: "Procesando...",
    search: "Buscar:",
    zeroRecords: "Sin resultados encontrados",
    paginate: {
      first: "Primero",
      last: "Ultimo",
      next: "Siguiente",
      previous: "Anterior",
    },
  };
  buttons = [
    {
      //Botón para Excel
      extend: "excel",
      footer: true,
      title: "Archivo",
      filename: "Export_File",

      //Aquí es donde generas el botón personalizado
      text: '<button class="btn btn-success"><i class="ti ti-explicit"></i></button>',
    },
    //Botón para PDF
    {
      extend: "pdf",
      footer: true,
      title: "Archivo PDF",
      filename: "reporte",
      text: '<button class="btn btn-danger"><i class="ti ti-file-text"></i></button>',
    },
    //Botón para print
    {
      extend: "print",
      footer: true,
      title: "Reportes",
      filename: "Export_File_print",
      text: '<button class="btn btn-info"><i class="ti ti-printer"></i></button>',
    },
  ];
  tblUsuarios = $("#tblUsuarios").DataTable({
    ajax: {
      url: base_url + "Usuarios/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_usuario" },
      { data: "ci" },
      { data: "nombres" },
      { data: "apellidos" },
      { data: "email" },
      { data: "telefono" },
      { data: "usuario" },
      { data: "estado" },
      { data: "acciones" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],

    dom:
      "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-9'i><'col-sm-3'p>>",
    language,
    buttons,
  });

  //fin de la tabla usuario

  ///tabla Saunas
  tblSauna = $("#tblSauna").DataTable({
    ajax: {
      url: base_url + "Saunas/listar",
      dataSrc: "",
    },
    columns: [
  
      { data: "numero_sauna" },
      { data: "tipo" },
      { data: "precio" },
      { data: "estado" },
      { data: "acciones" },
    ],
  });
  /// fin sauna
  ///Tabla Reservas
  tblReservas = $("#tblReservas").DataTable({
    ajax: {
      url: base_url + "Reservas/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id_reserva" },
      { data: "nombres" },
      { data: "tipo" },
      { data: "fecha" },
      { data: "hora_inicio" },
      { data: "hora_fin" },
      { data: "estado" },
      { data: "acciones" },
    ],
    responsive: true,
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],

    dom:
      "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-9'i><'col-sm-3'p>>",
    language,
    buttons,
  });
  /// Fin Tabla Reservas



  ///Tabla de Reservados2 
  $(document).ready(function() {
    $('#tblReservados2').DataTable({
      responsive: true,
      bDestroy: true,
      iDisplayLength: 20,
      order: [[0, "desc"]],
      dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
           "<'row'<'col-sm-12'tr>>" +
           "<'row'<'col-sm-9'i><'col-sm-3'p>>",
      language,
      buttons
    });
});
//Fin de la tabla reservados


  /**$('.nombre').select2({
    placeholder: 'Buscar Participante',
    minimumInputLength: 2,
    ajax: {
        url: base_url + 'Reservas/buscarCliente',
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                est: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    }
  }); */
  
/// select3
$("#select_usuario").autocomplete({
  minLength: 2,
  source: function (request, response) {
    $.ajax({
      url: base_url + "Usuarios/buscarUsuario/",
      dataType: "json",
      data: {
        user: request.term,
      },
      success: function (data) {
        response(data);
      },
    });
  },
  select: function (event, ui) {
    document.getElementById("id_user").value = ui.item.id_usuario;
    document.getElementById("select_usuario").value = ui.item.nombres;
  },
});
//fin de autocompletado para el input
/// select3
$("#select_sauna").autocomplete({
  minLength: 1,
  source: function (request, response) {
    $.ajax({
      url: base_url + "Saunas/buscarSauna/",
      dataType: "json",
      data: {
        sau: request.term,
      },
      success: function (data) {
        response(data);
      },
    });
  },
  select: function (event, ui) {
    document.getElementById("id_sau").value = ui.item.id_sauna;
    document.getElementById("select_sauna").value = ui.item.tipo;
  },
});
//fin de autocompletado para el input

});

function frmInactivos() {}
//fin de las tablas !!!!!-------------------------------------------------------------------------------------

function frmCambiarPass(e) {
  e.preventDefault();
  const actual = document.getElementById("clave_actual").value;
  const nueva = document.getElementById("clave_nueva").value;
  const confirmar = document.getElementById("confirmar_clave").value;
  if (actual == "" || nueva == "" || confirmar == "") {
    alertas("Todos los campos son obligatorio ☺", "warning");
  } else {
    if (nueva != confirmar) {
      alertas("Las contraseñas no conciden ☺", "warning");
    } else {
      const url = base_url + "Usuarios/cambiarPass"; //estamos enviando ala controlador
      const frm = document.getElementById("frmCambiarPass");
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          alertas(res.msg, res.icono);
          //    $("#cambiarPass").modal("hide"); //para que se oculte el domal de usuario
        }
      };
    }
  }
}

function frmUsuario() {
  document.getElementById("title").innerHTML = "Nuevo Usuario";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("claves").classList.remove("d-none"); //para mostrar compo de claves
  document.getElementById("frmUsuario").reset();

  $("#nuevo_usuario").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id").value = "";
}

function registrarUser(e) {
  e.preventDefault();
  const nombres = document.getElementById("nombres");
  const apellidos = document.getElementById("apellidos");
  const email = document.getElementById("email");
  const telefono = document.getElementById("telefono");
  const usuario = document.getElementById("usuario");

  if (nombres.value == "" || email.value == "" || usuario.value == "") {
    alertas("Todos los campos son obligatorio ☺", "warning");
  } else {
    const url = base_url + "Usuarios/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmUsuario");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);

        $("#nuevo_usuario").modal("hide"); //ocultar modal
        alertas(res.msg, res.icono);
        tblUsuarios.ajax.reload(); //para que se actualise automaticamente la pagina
      }
    };
  }
}

function btnEditarUser(id) {
  document.getElementById("title").innerHTML = "Actulizar Usuario";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Usuarios/editar/" + id; //estamos enviando ala controlador
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      document.getElementById("id").value = res.id_usuario;
      document.getElementById("nombres").value = res.nombres;
      document.getElementById("apellidos").value = res.apellidos;
      document.getElementById("email").value = res.email;
      document.getElementById("telefono").value = res.telefono;
      document.getElementById("usuario").value = res.usuario;

      document.getElementById("claves").classList.add("d-none"); //esto es para esconder campos de claves
      $("#nuevo_usuario").modal("show");
    }
  };
}

function btnEliminarUser(id) {
  Swal.fire({
    title: "Estas Seguro de Eliminar?",
    text: "El usuario nose eliminara de forma permanente,solo cambiara a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Usuarios/eliminar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          tblUsuarios.ajax.reload(); //recargar pagina de usuario
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}
function btnReingresarUser(id) {
  Swal.fire({
    title: "Estas Seguro de Reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Usuarios/reingresar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          //tblInactivos.ajax.reload(); //recargar pagina de usuario
          alertas(res.msg, res.icono);
          setTimeout(() => {
            window.location.reload();
          }, 2000);
        }
      };
    }
  });
}
function editarPerfil() {
  document.getElementById("editarPerfil").classList.remove("d-none");
}
function actualizarDatosUsuario(e) {
  e.preventDefault();
  const usuario = document.getElementById("usuario").value;
  const nombres = document.getElementById("nombres").value;
  const apellidos = document.getElementById("apellidos").value;
  const email = document.getElementById("email").value;
  const telefono = document.getElementById("telefono").value;

  if (
    usuario == "" ||
    nombres == "" ||
    apellidos == "" ||
    email == "" ||
    telefono == ""
  ) {
    alertas("Todo los campos son requeridos", "warning");
    return false;
  } else {
    const url = base_url + "Usuarios/actualizarDatosUsuario";
    const frm = document.getElementById("frmDatos");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        alertas(res.msg, res.icono);
        setTimeout(() => {
          location.reload();
        }, 3000);
      }
    };
  }
}
//fin de Usaurio !!!!!!--------------------------------------------------------------------------------------

function modificarEmpresa() {
  const frm = document.getElementById("frmConfig");
  const url = base_url + "ConfigAdmin/modificar";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(new FormData(frm));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      if (res == "ok") {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Modificado con Exito ☺",
          showConfirmButton: false,
          timer: 2000,
        });
      }
    }
  };

  // body...
}
///fin de empresa

function frmEstudiante() {
  document.getElementById("title").innerHTML = "Nuevo Estudiante";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmEstudiante").reset();

  $("#nuevo_estudiante").modal("show"); //esta mostrando modal de usuario
  document.getElementById("id").value = "";
}
function registrarEstudiante(e) {
  e.preventDefault();
  const ci = document.getElementById("ci");
  const nombre = document.getElementById("nombre");

  if (ci.value == "" || nombre.value == "") {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Estudiante/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmEstudiante");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // console.log(this.responseText);

        const res = JSON.parse(this.responseText);
        $("#nuevo_estudiante").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        frm.reset();

        tblestudiante.ajax.reload(); //para recargar la pagina
      }
    };
  }
}
function btnEditarEstudiante(id) {
  document.getElementById("title").innerHTML = "Actulizar Estudiante";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Estudiante/editar/" + id; //estamos enviando ala controlador
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      document.getElementById("id").value = res.id;
      document.getElementById("ci").value = res.ci;
      document.getElementById("nombre").value = res.nombre;

      //document.getElementById("claves").classList.add("d-none"); //esto es para esconder campos de claves
      $("#nuevo_estudiante").modal("show");
    }
  };
}

function btnEliminarEstudiante(id) {
  Swal.fire({
    title: "Estas Seguro de Eliminar?",
    text: "El usuario nose eliminara de forma permanente,solo cambiara a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Estudiante/eliminar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          tblestudiante.ajax.reload(); //recargar tabla
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}

function btnReingresarEstudiante(id) {
  Swal.fire({
    title: "Estas Seguro de Reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Estudiante/reingresar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje!", "Usuario Reingresado con exito.", "success");
            tblestudiante.ajax.reload(); //recargar pagina de usuario
          } else {
            Swal.fire("Mensaje!", "res", "error");
          }
        }
      };
    }
  });
}

///Fin de Estudinates

///Reservas
function frmReservaPanel(id_sauna) {
  document.getElementById("title").innerHTML = "Nueva Reserva";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmReservaPanel").reset();

  $("#nuevo_reservaPanel").modal("show"); //esta mostrando modal de reserva

  console.log(id_sauna);
  document.getElementById("idsauna").value = id_sauna;
}

//para configurar estado
/*
<td>
      ${row["estado"] === "Activo" 
         ? `<span class="badge badge-success">Activo</span>` 
         : row["estado"] === "Reservado"
         ? `<span class="badge badge-warning">Reservado</span>`
         : `<span class="badge badge-secondary">${row["estado"]}</span>`
      }
   </td>
*/

function frmReservaHoras(id_sauna) {
  document.getElementById("titleHoras").innerHTML = "Horas Reservados";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  // document.getElementById("frmReservaHoras").reset();

  $("#nuevo_reservaHoras").modal("show"); //esta mostrando modal de Horas

  console.log("Desde Console:" + id_sauna);
  document.getElementById("idsaunaHoras").value = id_sauna;

  const url = base_url + "Administracion/HorasReservas/" + id_sauna; //estamos enviando ala controlador

  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      let html = "";
      res.forEach((row) => {
        html += `<tr>
   
   <td>${row["id_reserva"]}</td>
   <td>${row["fecha"]}</td>
   <td>${row["hora_inicio"]}</td>
   <td>${row["hora_fin"]}</td>
    <td>
      ${
        row["estado"] === 2
          ? `<span class="badge badge-success text-bg-warning">Reservado</span>`
          : `<span class="badge badge-success">${row["estado"]}</span>`
      }
    </td>
 
 
                 </tr>`;
      });
      document.getElementById("tblHoras").innerHTML = html;
    }
  };
}

//Fin Reservas
///Reservas

//Fin Reservas
//
function RegistrarReservaPanel(e) {
  e.preventDefault();

  const nombres = document.getElementById("nombres");
  const fecha = document.getElementById("fecha");
  const hora_inicio = document.getElementById("hora_inicio");
  const hora_fin = document.getElementById("hora_fin");

  if (
    nombres.value == "" ||
    fecha.value == "" ||
    hora_inicio.value == "" ||
    hora_fin.value == ""
  ) {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Reservas/registrarPanel"; //estamos enviando ala controlador
    const frm = document.getElementById("frmReservaPanel");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);

        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
         
           $("#nuevo_reservaPanel").modal("hide"); //para que se oculte el domal de usuario
          frm.reset();
        } 


        alertas(res.msg, res.icono);

        tblReservas.ajax.reload(); //para recargar la pagina
      }
    };
  }
}

//Fin de Registrar Reservas nuevo
function frmReserva() {
  document.getElementById("title").innerHTML = "Reservas ♣♣♣";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmReserva").reset();

  $("#nuevo_reserva").modal("show"); //esta mostrando modal de reserva
  document.getElementById("id").value = "";
}
function registrarReserva(e) {
  e.preventDefault();
  const id_user = document.getElementById("id_user");
  const id_sau = document.getElementById("id_sau");
  const hora_inicio = document.getElementById("hora_inicio");
  const hora_fin = document.getElementById("hora_fin");

  if (id_user.value == "" || id_sau.value == "") {
    alertas("Todos los Campos son obligatorios ☺♣", "warning");
  } else {
    const url = base_url + "Reservas/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmReserva");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);

        const res = JSON.parse(this.responseText);
        $("#nuevo_reserva").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        if (res.icono == "success") {
          setTimeout(() => {
            window.open(base_url + "Reservas/generarPdf/" + res.id_reserva);
          }, 3000);
        }
        frm.reset();

        tblReservas.ajax.reload(); //para recargar la pagina
      }
    };
  }
}

function btnEditarReserva(id) {
  document.getElementById("title").innerHTML = "Actulizar Reserva";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Reservas/editar/" + id; //estamos enviando ala controlador
  console.log(id);
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      document.getElementById("id").value = res.id_reserva;
      document.getElementById("id_user").value = res.id_usuario;
      document.getElementById("select_usuario").value = res.nombres;
      document.getElementById("id_sau").value = res.id_sauna;
      document.getElementById("select_sauna").value = res.tipo;
      

      //document.getElementById("claves").classList.add("d-none"); //esto es para esconder campos de claves
      $("#nuevo_reserva").modal("show");
    }
  };
}
function btnEliminarReserva(id) {
  Swal.fire({
    title: "Estas Seguro de Eliminar?",
    text: "La reserva nose eliminara de forma permanente,solo cambiara a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Reservas/eliminar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          window.location.reload();
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}
function btnReingresarReserva(id) {
  Swal.fire({
    title: "¿Estás seguro de aprobar la reserva?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Reservas/reingresar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
          
         
            Swal.fire("Mensaje!", "Reserva aprobada con éxito", "success");
            setTimeout(() => {
              window.open(base_url + "Reservas/generarPdf/" + id);
              window.location.reload();
            }, 3000);
           
          } else {
            Swal.fire("Mensaje!", "res", "error");
          }
        }
      };
    }
  });
}

function btnReingresarReservaInactivo(id) {
  Swal.fire({
    title: "¿Estas Seguro de Reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Reservas/reingresarInactivo/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
          
         
            Swal.fire("Mensaje!", "Reserva Reingresado con exito.", "success");
            setTimeout(() => {
             
              window.location.reload();
            }, 3000);
           
          } else {
            Swal.fire("Mensaje!", "res", "error");
          }
        }
      };
    }
  });
}



///Sauna
function frmSauna() {
  document.getElementById("title").innerHTML = "Nueva Sauna";
  document.getElementById("btnAccion").innerHTML = "Registrar";
  document.getElementById("frmSauna").reset();

  $("#nuevo_sauna").modal("show"); //esta mostrando modal de reserva
  document.getElementById("id").value = "";
}

function registrarSauna(e) {
  e.preventDefault();
  const tipo = document.getElementById("tipo");
  const precio = document.getElementById("precio");

  if (tipo.value == "" || precio.value == "") {
    alertas("Todos los Campos son obligatorios ☺", "warning");
  } else {
    const url = base_url + "Saunas/registrar"; //estamos enviando ala controlador
    const frm = document.getElementById("frmSauna");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);

        const res = JSON.parse(this.responseText);
        $("#nuevo_sauna").modal("hide"); //para que se oculte el domal de usuario
        alertas(res.msg, res.icono);
        frm.reset();

        tblSauna.ajax.reload(); //para recargar la pagina
      }
    };
  }
}
function btnEditarSauna(id) {
  document.getElementById("title").innerHTML = "Actulizar Sauna";
  document.getElementById("btnAccion").innerHTML = "Modificar";
  const url = base_url + "Saunas/editar/" + id; //estamos enviando ala controlador
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //console.log(this.responseText);
      const res = JSON.parse(this.responseText);

      document.getElementById("id").value = res.id_sauna;
      document.getElementById("numero_sauna").value = res.numero_sauna;
      document.getElementById("tipo").value = res.tipo;
      document.getElementById("precio").value = res.precio;

      //document.getElementById("claves").classList.add("d-none"); //esto es para esconder campos de claves
      $("#nuevo_sauna").modal("show");
    }
  };
}
function btnEliminarSauna(id) {
  Swal.fire({
    title: "Estas Seguro de Eliminar?",
    text: "El usuario nose eliminara de forma permanente,solo cambiara a estado inactivo!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Saunas/eliminar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          tblSauna.ajax.reload(); //recargar tabla
          alertas(res.msg, res.icono);
        }
      };
    }
  });
}
function btnReingresarSauna(id) {
  Swal.fire({
    title: "Estas Seguro de Reingresar?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si!",
    cancelButtonText: "No",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "Saunas/reingresar/" + id; //estamos enviando ala controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res == "ok") {
            Swal.fire("Mensaje!", "Sauna Reingresado con exito.", "success");
            tblSauna.ajax.reload(); //recargar pagina de usuario
          } else {
            Swal.fire("Mensaje!", "res", "error");
          }
        }
      };
    }
  });
}

//Fin Sauna























function alertas(mensaje, icono) {
  Swal.fire({
    position: "top-end",
    icon: icono,
    title: mensaje,
    showConfirmButton: false,
    timer: 2000,
  });
}
