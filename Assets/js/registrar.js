function registrarUserPrinciapal(e) {
    e.preventDefault();
    const ci = document.getElementById("ci");
    const nombres = document.getElementById("nombres");
    const apellidos = document.getElementById("apellidos");
     const email = document.getElementById("email");
     const telefono = document.getElementById("telefono");
    const usuario = document.getElementById("usuario");
   
    if (nombres.value == ""||email.value==""||usuario.value=="" ) {
           alertas('Todos los campos son obligatorio ☺', 'warning');
    }  else {
        const url = base_url + "Usuarios/registrar"; //estamos enviando ala controlador
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
               console.log(this.responseText);
                const res =JSON.parse(this.responseText);
                alertas(res.msg, res.icono);
                    if (res.icono == "success") {
                      setTimeout(() => {
                       window.location.href='index';
                      }, 3000);
                      
                    }
  
            }
        }
    }
  }
  

function alertas(mensaje, icono) {
    Swal.fire({
      position: 'top-end',
      icon: icono,
      title: mensaje,
      showConfirmButton: false,
      timer: 2000
    })
}