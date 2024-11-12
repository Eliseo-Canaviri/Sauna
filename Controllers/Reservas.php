<?php
class Reservas extends Controller
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
    //print_r($this->model->getUsuarios());
    //  die();
    if ($_SESSION['id_usuario'] == 1) {
      $data = $this->model->getReservasAdmin(1);

      for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]['estado'] == 1) {
          $data[$i]['estado'] = '<spam class="badge bg-success">Activo</spam';
          $data[$i]['acciones'] = '<div>
        <button class ="btn btn-primary mb-1" type="button"onclick="btnEditarReserva(' . $data[$i]['id_reserva'] . ');"><i class="ti ti-edit"></i></button>
        <button class ="btn btn-danger mb-1" type="button"onclick="btnEliminarReserva(' . $data[$i]['id_reserva'] . ');" ><i class="ti ti-trash"></i></button>
      
      <a class ="btn btn-warning mb-1 "href="' . base_url . "Reservas/generarPdf/" . $data[$i]['id_reserva'] . '" target="_blank"><i class="ti ti-file-text"></i></a>
      <div/>';
        } else {
          $data[$i]['estado'] = '<spam class="badge bg-danger">Inactivo</spam';
          $data[$i]['acciones'] = '<div>
     
      <button class ="btn btn-success" type="button"onclick="btnReingresarEstudiante(' . $data[$i]['id_reserva'] . ');" ><i class="fas fa-undo"></i></button>
      <div/>';
        }
      }
    } else {

      $data = $this->model->getReservas($_SESSION['id_usuario']);

      for ($i = 0; $i < count($data); $i++) {
        if ($data[$i]['estado'] == 1) {
          $data[$i]['estado'] = '<spam class="badge bg-success">Activo</spam';
          $data[$i]['acciones'] = '<div>
          
        <div/>';
        } else {
          $data[$i]['estado'] = '<spam class="badge bg-danger">Reservado</spam';
          $data[$i]['acciones'] = '<div>
                 <button class ="btn btn-primary" type="button"onclick="btnEditarReserva2(' . $data[$i]['id_reserva'] . ');"><i class="ti ti-edit"></i></button>

        <div/>';
        }
      }
    }


    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function registrarPanel()
  {
    //print_r($_POST);
    //die();
    $id_usuario = $_SESSION["id_usuario"];
    $idsauna = $_POST['idsauna'];
    $fecha = $_POST['fecha'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $id = $_POST['id'];

    $estado = 2;

    if (empty($fecha) || empty($hora_inicio)) {
      $msg = array('msg' => 'Todo los campos son obligatorios ', 'icono' => 'warning');
    } else {
      if ($id == "") {
        $data = $this->model->registrarReservaPanel($fecha, $hora_inicio, $hora_fin, $id_usuario, $idsauna, $estado);

        if ($data == "ok") {
          $msg = array('msg' => 'Registro con exito ', 'icono' => 'success');
        } else if ($data == "existe") {

          $msg = array('msg' => 'Ya Esta Reservado. Elija Otra Hora.', 'icono' => 'warning');
        } else {
          $msg = array('msg' => 'Error al registrar ', 'icono' => 'error');
        }
      } else {
        $data = $this->model->modificarEstudiante($fecha, $fecha, $id);
        if ($data == "modificado") {
          $msg = array('msg' => ' modificado con exito ', 'icono' => 'success');
        } else {
          $msg = array('msg' => 'Error al modificar ', 'icono' => 'error');
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function registrar()
  {
    //   print_r($_POST);
    //die();
    $id_usuario = $_POST['id_user'];
    $id_sauna = $_POST['id_sau'];
    $fecha = $_POST['fecha'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $id = $_POST['id'];


    if (empty($id_usuario) || empty($id_sauna)) {
      $msg = array('msg' => 'Todo los campos son obligatorios ', 'icono' => 'warning');
    } else {
      if ($id == "") {
        $data = $this->model->registrarReserva($fecha, $hora_inicio, $hora_fin, $id_usuario, $id_sauna);
        if ($data == "ok") {
          
          $data = $this->model->getMaxIDReservar();
          foreach ($data as $row) {
            $id_MaxReserva = $row;
          }
          
          $msg = array('msg' => 'Registro con exito ', 'icono' => 'success', 'id_reserva' => $id_MaxReserva);
        } else if ($data == "existe") {

          $msg = array('msg' => 'Ya Esta Reservado. Elija Otra Hora.', 'icono' => 'warning');
        } else {
          $msg = array('msg' => 'Error al registrar ', 'icono' => 'error');
        }
      } else {
        $data = $this->model->modificarReserva($fecha, $hora_inicio, $hora_fin, $id_usuario, $id_sauna, $id);
        if ($data == "modificado") {

          $msg = array('msg' => 'Reserva modificado con exito ', 'icono' => 'success', 'id_reserva' => $id);
        } else if ($data == "existe") {

          $msg = array('msg' => 'Ya Esta Reservado. Elija Otra Hora.', 'icono' => 'warning');
        } else {
          $msg = array('msg' => 'Error al modificar ', 'icono' => 'error');
        }
      }
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }



  public function editar(int $id)
  {

    $data = $this->model->editarReservas($id, 1);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function editar2(int $id)
  {

    $data = $this->model->editarReservas($id, 2);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function eliminar(int $id)
  {

    $data = $this->model->accionReservas(0, $id);
    if ($data == 1) {
      $msg = array('msg' => 'Reserva eliminado con exito ', 'icono' => 'success');
    } else {
      $msg = array('msg' => 'Error al eliminar Reserva ', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }



  public function reingresar(int $id)
  {
    $data = $this->model->accionReservas(1, $id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = array('msg' => 'Error al reingresar Reserva ', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }

  public function reingresarInactivo(int $id)
  {
    $data = $this->model->accionReservas(2, $id);
    if ($data == 1) {
      $msg = "ok";
    } else {
      $msg = array('msg' => 'Error al reingresar Inactivo Reserva ', 'icono' => 'error');
    }
    echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    die();
  }
  public function buscarCliente()
  {
    if (isset($_GET['est'])) {
      $valor = $_GET['est'];
      $data = $this->model->buscarCliente($valor);
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
      die();
    }
  }

  public function reservados2()
  {
    //vamos mandar por json a funciones.js
    //print_r($this->model->getUsuarios(0));
    //die   ();

    $data['reservados'] = $this->model->getReservasAdmin(2);
    $this->views->getView($this, "reservados", $data);
  }





  public function inactivos()
  {
    //vamos mandar por json a funciones.js
    //print_r($this->model->getUsuarios(0));
    //die   ();

    $data['inactivos'] = $this->model->getReservasAdmin(0);
    $this->views->getView($this, "inactivos", $data);
  }


  function generarPdf($id_MaxReserva)
  {
    $dataint = $this->model->getInstitucion();
    $datares = $this->model->editarReservasPdf($id_MaxReserva);
    require('./Libraries/fpdf/fpdf.php');

    // Configuración del tamaño del ticket (80mm de ancho y 200mm de alto)
    $pdf = new FPDF('P', 'mm', array(80, 200)); // Cambia las dimensiones según el tamaño del ticket
    $pdf->AddPage();




    
 // Calcular el precio del Sauna
$entrada = strtotime($datares['hora_inicio']);
$salida = strtotime($datares['hora_fin']);

// Verificar si la hora de salida es posterior a la de entrada
if ($salida > $entrada) {
    // Calcular la diferencia en horas
    $diferenciaHoras = ($salida - $entrada) / 3600; // 3600 segundos en una hora
    
    // Redondear hacia arriba en incrementos de media hora
    $diferenciaHoras = ceil($diferenciaHoras * 2) / 2; // Multiplica por 2, redondea hacia arriba y divide por 2

    // Precio por hora
    $precioPorHora = $datares['precio'];

    // Calcular el total a pagar
    $totalPagar = $diferenciaHoras * $precioPorHora;
} else {
    // En caso de que la hora de salida sea igual o anterior a la de entrada, asignar un mensaje de error o un valor 0
    $totalPagar = "Error: La hora de salida debe ser posterior a la de entrada.";
}

// Si totalPagar es un número (no un error), mostrar el total formateado con 2 decimales
if (is_numeric($totalPagar)) {
    $totalPagar = number_format($totalPagar, 2); // Formato con dos decimales
}
    //$id_reser=$this->model->id_reser($id_MaxReserva);
   //Fin calcular precio
   $datatotalpre = $this->model->RegitrarTotalPrecio($id_MaxReserva,$totalPagar);

    // Establecer el título
    $pdf->SetFont('Arial', 'B', 13);
    $pdf->Cell(0, 10, '*********** ORIGINAL ***********', 0, 1, 'C');
    $pdf->Cell(0, 10, '********** NOTA # ' . $id_MaxReserva . ' **********', 0, 1, 'C');
    $pdf->Cell(0, 10, 'utf8_decode'($dataint['nombre']), 0, 1, 'C');
    $pdf->Ln(2); // Salto de línea

    // Información adicional del ticket
    $pdf->SetFont('Arial', '', 12);

    $pdf->Cell(0, 10, '-----------------------------------------------', 0, 1, 'C');
    // Añadir detalles con bordes
    date_default_timezone_set('America/La_Paz'); // Establecer la zona horaria de Bolivia
    $pdf->Cell(0, 5, 'Fecha: ' . date('d/m/Y H:i:s'), 0, 1);
    $pdf->Cell(0, 5, 'utf8_decode'("Cliente : " . $datares['nombres']), 0, 1);
    $pdf->Cell(0, 5, 'utf8_decode'("Sauna : " . $datares['tipo']), 0, 1);
    $pdf->Cell(0, 5, 'utf8_decode'("Fecha Rva : " . $datares['fecha']), 0, 1);
    $pdf->Cell(0, 5, 'utf8_decode'("Hora Ing. y Sal : " . $datares['hora_inicio'] . " a " . $datares['hora_fin']), 0, 1);
 // Imprimir el total en el PDF
 $pdf->Cell(0, 10, 'Total a Pagar: ' . $totalPagar.' Bs.', 0, 1);
  
    $pdf->Cell(0, 10, '-----------------------------------------------', 0, 1, 'C');
    $pdf->Ln(2); // Salto de línea
    // Mensaje de agradecimiento
    // Establecer el título
    $pdf->SetFont('Arial', 'B', 13);

    $pdf->Cell(0, 10, '>>>>> PAGO EN EFECTIVO <<<<< ', 0, 1, 'C');
 
  
    // $pdf->Cell(0, 10, 'Gracias por su preferencia!', 0, 1, 'C');
    $pdf->Cell(0, 10, 'utf8_decode'($dataint['mensaje']), 0, 1, 'C');
    // Opcional: Agregar un código QR o un código de barras (si es necesario)
    // Puedes usar una librería externa para generar códigos QR o de barras

    // Salida del PDF
    $pdf->Output('I', 'ticket.pdf'); // 'I' para mostrar en el navegador, 'D' para forzar descarga
  }
}
