<?php
class Usuarios extends Controller
{
    public function __construct()
    {
        session_start();

        parent::__construct();
    }

    public function index()
    {

        if (empty($_SESSION['activo'])) {

            header("location:" . base_url);
        }
        $this->views->getView($this, "index");
    }


    public function listar()
    {
        //vamos mandar por json a funciones.js
        //print_r($this->model->getUsuarios());
        //die();
   
        $data = $this->model->getUsuarios(1);
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i]['estado'] == 1) {
                if ($data[$i]['id_usuario']!=1) {
                    $data[$i]['estado'] = '<spam class="badge bg-success">Activo</spam';
                    $data[$i]['acciones'] = '<div>
            <button class ="btn btn-primary mb-1" type="button"onclick="btnEditarUser(' . $data[$i]['id_usuario'] . ');"><i class="ti ti-edit"></i></button>
            <button class ="btn btn-danger mb-1" type="button"onclick="btnEliminarUser(' . $data[$i]['id_usuario'] . ');" ><i class="ti ti-trash"></i></button>
            <div/>';
                }else{
                    $data[$i]['estado'] = '<spam class="badge bg-success">Activo</spam';
                    $data[$i]['acciones'] = '<spam class="badge bg-primary">Super Administrador</spam';    
                }
        
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validar()
    {
        //print_r($_POST);
        // die();

        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los Campos estan Vaciones";
            // code...
        } else {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $hash, 1);

            if ($data) {

                $_SESSION['id_usuario'] = $data['id_usuario'];
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombres'] = $data['nombres'];
                $_SESSION['apellidos'] = $data['apellidos'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['telefono'] = $data['telefono'];

                $_SESSION['activo'] = true;
                $msg = "ok";
                // code...
            } else {
                $msg = "Usuario o Contraseña Incorrecta!!!";
            }
        }

        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();

        // code...
    }

    public function registrar()
    {
        //print_r($_POST);
        //die();
        $ci = $_POST['ci'];
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $id = $_POST['id'];

        $hash = hash("SHA256", $clave);


        if (empty($nombres) || empty($email) || empty($usuario)) {
            $msg = array('msg' => 'Todos los campos son obligatorios ☻', 'icono' => 'warning');
        } else {
            if ($id == "") {
                if ($clave != $confirmar) {
                    $msg = array('msg' => 'Las Contraseñas no conciden ☻', 'icono' => 'warning');
                } else {
                    $data = $this->model->registrarUsuario($ci,$nombres, $apellidos, $email, $telefono, $usuario, $hash);
                    if ($data == "ok") {
                        $msg = array('msg' => 'Usuario registrado con exito ☻', 'icono' => 'success');
                    } else if ($data == "existe") {

                        $msg = array('msg' => 'El usuario ya existe ☻', 'icono' => 'warning');
                    } else {

                        $msg = array('msg' => 'Error al registrar al usuario ☻', 'icono' => 'error');
                    }
                }
                #code ..

            } else {
                $data = $this->model->modificarUsuario($ci,$nombres, $apellidos, $email, $telefono, $usuario, $id);
                if ($data == "modificado") {

                    $msg = array('msg' => 'Usuario modificado con exito ☻', 'icono' => 'success');
                } else {

                    $msg = array('msg' => 'Error al modificar al usuario ☻', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE); //enviando ala archivo funcion js
        die();
    }
    public function actualizarDatosUsuario()
    {
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        $usuario = ($_POST['usuario']);
        $ci = ($_POST['ci']);
        $nombres = ($_POST['nombres']);
        $apellidos = ($_POST['apellidos']);
        $email = ($_POST['email']);
        $telefono = ($_POST['telefono']);
        //$direccion = ($_POST['direccion']);
        $id = $_SESSION['id_usuario'];
      
        if ($id == "") {
           
                $msg = array('msg' => 'Error al Modificar ☻', 'icono' => 'warning');

        }    $data = $this->model->modificarUsuario($ci,$nombres, $apellidos, $email, $telefono, $usuario, $id);
        if ($data == "modificado") {

            $msg = array('msg' => 'Usuario modificado con exito ☻', 'icono' => 'success');
        } else {

            $msg = array('msg' => 'Error al modificar al usuario ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar(int $id)
    {
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE); //le estamos enviando 
        die();
    }

    public function eliminar(int $id)
    {

        $data = $this->model->accionUser(0, $id);
        if ($data == 1) {

            $msg = array('msg' => 'Usuario dado de baja ☻', 'icono' => 'success');
        } else {

            $msg = array('msg' => 'Error al eliminar usuario ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die(); //terminar el proceso
    }

    public function reingresar(int $id)
    {
        $data = $this->model->accionUser(1, $id);
        if ($data == 1) {

            $msg = array('msg' => 'Usuario reingresado con exito ☻', 'icono' => 'success');
        } else {

            $msg = array('msg' => 'Error al registrar el usuario ☻', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die(); //terminar el proceso
    }



    public function cambiarPass()
    {
      //  print_r($_POST);
      //  die();
        $actual = $_POST['clave_actual'];
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['confirmar_clave'];
        if (empty($actual) || empty($nueva) || empty($confirmar)) {
            $mensaje = array('msg' => 'Todo los Campos son obligatorios de controlador ☻', 'icono' => 'warning');
        } else {
            if ($nueva != $confirmar) {
                $mensaje = array('msg' => 'Las contraseñas no conciden de controlador ☻', 'icono' => 'warning');
            } else {
                $id = $_SESSION['id_usuario']; //optiniendo el id de la seccion
                $hash = hash("SHA256", $actual);
                $data = $this->model->getPass($hash, $id);

                if (!empty($data)) {

                    $verificar = $this->model->modificarPass(hash("SHA256", $nueva), $id);
                    if ($verificar == 1) {

                        $mensaje = array('msg' => 'Contraseña modificada ☻', 'icono' => 'success');
                    } else {

                        $mensaje = array('msg' => 'Erro al modificar contraseña ☻', 'icono' => 'error');
                    }
                } else {

                    $mensaje = array('msg' => 'Las contraseñas actual Incorrecta ☻', 'icono' => 'warning');
                }
            }
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();

        // code...
    }


    public function inactivos()
    {
        //vamos mandar por json a funciones.js
        //print_r($this->model->getUsuarios(0));
        //die   ();

        $data['usuarios'] = $this->model->getUsuarios(0);
        $this->views->getView($this, "inactivos", $data);
    }
    function registrarse()
    {
        $this->views->getView($this, "registrarse");
    }
    function perfil()
    {
        // $this->views->getView($this, "perfil");
        $id_user = $_SESSION['id_usuario'];
        $data = $this->model->editarUser($id_user);
        $this->views->getView($this, "perfil", $data);
    }

    public function buscarUsuario()
    {
        if (isset($_GET['user'])) {
            $data = $this->model->buscarUsuario($_GET['user']);
            $datos = array();
            foreach ($data as $row) {
                $data['id_usuario'] = $row['id_usuario'];
                $data['label'] = $row['nombres'] . ' ' . $row['apellidos'];
                $data['value'] = $row['nombres'] . ' ' . $row['apellidos'];
                array_push($datos, $data);
            }
            echo json_encode($datos, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
















    public function salir()
    {
        session_destroy();
        header("location:" . base_url);
        // code...
    }

















}
