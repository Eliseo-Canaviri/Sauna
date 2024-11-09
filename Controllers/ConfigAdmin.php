<?php 

class ConfigAdmin extends Controller{

public function __construct()
{
	session_start();
	/*if (empty($$_SESSION['activo'])) {
		header("location".base_url);
	}*/
	parent::__construct();

}
public function index()

{
	$data=$this->model->getInstitucion();
$this->views->getView($this,"index",$data);
}

public function modificar()
{
	$nombre=$_POST['nombre'];
	$telefono=$_POST['telefono'];
	$direccion=$_POST['direccion'];
	$mensaje=$_POST['mensaje'];
	$id=$_POST['id'];
	$data=$this->model->modificar($nombre, $telefono, $direccion, $mensaje, $id);
	if ($data="ok") {
		$msg="ok";
		// code...
	}else{
		$msg="Error";
	}
	echo json_encode ($msg,JSON_UNESCAPED_UNICODE );
	die();

}






}


 ?>