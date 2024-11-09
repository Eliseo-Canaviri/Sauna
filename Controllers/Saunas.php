<?php
class Saunas extends Controller
{
  public function __construct()
  {
    session_start();

    parent::__construct();
  }

  public function index()
  {
    if (empty($_SESSION['activo'])) {
      // code...
      header("location:" . base_url);
    }
    $this->views->getView($this, "index");

  }
  public function listar()
  {
    //vamos mandar por json a funciones.js
//print_r($this->model->getSauna());
 //die();

    $data = $this->model->getSauna();

    for ($i = 0; $i < count($data); $i++) {
      if ($data[$i]['estado'] == 1) {
        $data[$i]['estado'] = '<spam class="badge bg-success">Activo</spam';
        $data[$i]['acciones'] = '<div>
        <button class ="btn btn-primary" type="button"onclick="btnEditarSauna(' . $data[$i]['id_sauna'] . ');"><i class="ti ti-edit"></i></button>
        <button class ="btn btn-danger" type="button"onclick="btnEliminarSauna(' . $data[$i]['id_sauna'] . ');" ><i class="ti ti-trash"></i></button>
      
        <div/>';

      } else {
        $data[$i]['estado'] = '<spam class="badge bg-danger">Inactivo</spam';
        $data[$i]['acciones'] = '<div>
       
        <button class ="btn btn-success" type="button"onclick="btnReingresarSauna(' . $data[$i]['id_sauna'] . ');" ><i class="ti ti-trash-off"></i></button>
        <div/>';
      }



    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function registrar()
  {
    $numero_sauna=$_POST['numero_sauna'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];
    $id = $_POST['id'];


    if (empty($tipo) || empty($precio)) {
      $msg = array('msg' => 'Todo los campos son obligatorios ☻', 'icono' => 'warning');

    } else {
      if ($id == "") {
        $data = $this->model->registrarSauna($numero_sauna,$tipo, $precio);

        if ($data == "ok") {
          $msg = array('msg' => 'Estudiante registrado ☻', 'icono' => 'success');
        } else {
          $msg = array('msg' => 'Error al registrar ☻', 'icono' => 'error');
        }

      } else {
        $data = $this->model->modificarSauna($numero_sauna, $tipo,$precio, $id);
        if ($data == "modificado") {
          $msg = array('msg' => 'Sauna modificado con exito ☻', 'icono' => 'success');
        } else {
          $msg = array('msg' => 'Error al modificar ☻', 'icono' => 'error');
        }
      }

    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();

  }



  public function editar(int $id)
  {
    $data = $this->model->editarSauna($id);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function eliminar(int $id)
  {

    $data = $this->model->accionSauna(0, $id);
    if ($data == 1) {
      $msg = array('msg' => 'Sauna eliminado con exito ☻', 'icono' => 'success');
    } else {
      $msg = array('msg' => 'Error al eliminar Sauna ☻', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }



  public function reingresar(int $id)
  {
    $data = $this->model->accionSauna(1, $id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = array('msg' => 'Error al eliminar Sauna ☻', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function buscarSauna()
  {
      if (isset($_GET['sau'])) {
          $data = $this->model->buscarSauna($_GET['sau']);
          $datos = array();
          foreach ($data as $row) {
              $data['id_sauna'] = $row['id_sauna'];
              $data['label'] = $row['numero_sauna'] . ' ' . $row['tipo'];
              $data['value'] = $row['numero_sauna'] . ' ' . $row['tipo'];
              array_push($datos, $data);
          }
          echo json_encode($datos, JSON_UNESCAPED_UNICODE);
          die();
      }
  }


















}
?>