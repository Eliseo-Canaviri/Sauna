<?php

class Administracion extends Controller
{
    public function __construct()
    {
        session_start();

        parent::__construct();
    }

    public function home()
    {
       
    //    $data['horas'] = $this->model->getHoras(1,1);
     
        // $data['usuarios'] = $this->model->getDatos('usuarios');
         $data['sauna'] = $this->model->GetSauna(1);//La funcion del linea de codigo es todo las consulta get saunas  esta almacenado en la variable data 
        //   $data['estudiante'] = $this->model->getDatos('estudiante');

        $this->views->getView($this, "home",$data);

    }
    function HorasReservas($id)  {

       //Se Mandando a Model Para que saber las horas de reserva de la Sauna
       $data = $this->model->getHoras(2,$id);
      
       echo json_encode($data, JSON_UNESCAPED_UNICODE);
         die();
       
    }
  









}

?>