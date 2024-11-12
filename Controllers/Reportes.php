<?php
class Reportes extends Controller
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
        $numero_sauna = $_POST['numero_sauna'];
        $tipo = $_POST['tipo'];
        $precio = $_POST['precio'];
        $id = $_POST['id'];


        if (empty($tipo) || empty($precio)) {
            $msg = array('msg' => 'Todo los campos son obligatorios ☻', 'icono' => 'warning');
        } else {
            if ($id == "") {
                $data = $this->model->registrarSauna($numero_sauna, $tipo, $precio);

                if ($data == "ok") {
                    $msg = array('msg' => 'Estudiante registrado ☻', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al registrar ☻', 'icono' => 'error');
                }
            } else {
                $data = $this->model->modificarSauna($numero_sauna, $tipo, $precio, $id);
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

    public function FiltrarFecha()
    {
        // print_r($_POST);
        //die();
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];


        $data = $this->model->FiltrarFecha($fecha_inicio, $fecha_fin);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
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
    }function alertaHoras()  {
        $data=$this->model->alertaHoras();
    
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function GenerarPdf()
    {
       
  //  print_r($_POST);
  //    die();
        $fecha_inicio = $_POST['fecha_iniciopdf'];
        $fecha_fin = $_POST['fecha_finpdf'];

        $sauna = $this->model->sauna();
        $data = $this->model->FiltrarFecha($fecha_inicio, $fecha_fin);
       
        if (empty($data)) {
            echo '<p style="font-size: 30px; text-align: center; color:white; background-color: #2980b9;">Aun No Hay Datos Filtrados .</p>';
        } else {
            $precio = $this->model->PrecioTotal($fecha_inicio, $fecha_fin);
            require('Libraries/fpdf/fpdf.php');
            $pdf = new FPDF('P', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->SetMargins(5, 3, 0);
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetTitle('Reportes de Curso ' . $sauna['nombre']);

            //datos de infor
            $pdf->SetTextColor(0, 0, 0);
            $pdf->SetFont('Helvetica', 'B', 15);
            // $pdf->Cell(35, 5, "infor:", 0, 0, 'L');
          

            // Arial bold 15
            $pdf->SetFont('Helvetica', 'B', 15);
            // Título
            $pdf->Cell(0, 10, 'utf8_decode'('INFORME DE ') . strtoupper($sauna['nombre']),0, 1, 'C');
           // Arial bold 15
           $pdf->SetFont('Helvetica', 'B', 12);
            $pdf->Cell(0, 10, 'utf8_decode'('FECHA: ').$fecha_inicio.' al '.$fecha_fin, 0, 1, 'C');
            // Salto de línea
            $pdf->Ln(5);
            // Celda con color de fondo y color de texto



            $pdf->SetFont('Arial', 'B', 11);
            $pdf->SetFillColor(40, 116, 166); //Color de fondo color azul
            $pdf->SetTextColor(255, 255, 255); //color de texto blanco
            $pdf->Cell(10, 5, 'ID', 0, 0, 'L', true);
            $pdf->Cell(50, 5, 'Nombres', 0, 0, 'L', true);
            $pdf->Cell(30, 5, 'Sauna', 0, 0, 'L', true);
            $pdf->Cell(25, 5, 'Hora Inicio', 0, 0, 'L', true);
            $pdf->Cell(20, 5, 'Hora Fin', 0, 0, 'L', true);
            $pdf->Cell(30, 5, 'Fecha Registro', 0, 0, 'L', true);
            $pdf->Cell(35, 5, 'Precio (Bs.)', 0, 1, 'L', true);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetTextColor(0, 0, 0);
            foreach ($data as $row) {
                $pdf->SetFillColor(255, 255, 255); // Color de fondo
                $pdf->SetTextColor(0, 0, 0); // Color de texto
                $pdf->Cell(10, 5, $row['id_reserva'], 1, 0, 'L', 1);
                $pdf->Cell(50, 5, 'utf8_decode'($row['nombres'].''.$row['apellidos']), 1, 0, 'L', 1);
                $pdf->Cell(30, 5, 'utf8_decode'($row['tipo']), 1, 0, 'L', 1);
                $pdf->Cell(25, 5, 'utf8_decode'($row['hora_inicio']), 1, 0, 'L', 1);
                $pdf->Cell(20, 5, $row['hora_fin'], 1, 0, 'L', 1);
                $pdf->Cell(30, 5, $row['fecha'], 1, 0, 'L', 1);
                $pdf->Cell(35, 5, 'utf8_decode'($row['total_pre']), 1, 1, 'L', 1);
            }

            $pdf->Ln(5);
            //TOTAL DE CURSO
            $pdf->SetFillColor(40, 116, 166);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(30, 5, "TOTAL :", 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(35, 5, $precio['pretotal'] . ' Bs.', 0, 1, 'L');
            //curso
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(30, 5, "FECHA ACTUAL: ", 0, 0, 'L');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(40, 5, date('Y-m-d'), 0, 1, 'L');

            ///laboratorio
            /* 
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(35, 5, "LABORATORIO:", 0, 0, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(35, 5, $row['nombre_laboratorio'], 0, 1, 'L');*/

            //Usuario
            $pdf->Ln(10);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(0, 5, ".................................", 0, 1, 'C');
            //      $pdf->Cell(0, 5, $_SESSION['nombres'] . ' ' . $_SESSION['apellidos'], 0, 0, 'C');




            $pdf->Output();
        }
       
    }




}
