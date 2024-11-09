<?php
class ConfigAdminModel extends Query{
 //  private $sitios,$nom_usuario,  $notas, $pass,$id,$estado;
    public function __construct()
    {
        parent::__construct();
    }
  

public function getInstitucion(){
    $sql="SELECT * FROM institucion";
    $data= $this->select($sql);
        return $data;
}
public function modificar(string $nombre, string $telefono , string $direccion ,string $mensaje , int $id)
{
    $sql = "UPDATE institucion SET nombre=?, telefono=?, direccion=?, mensaje=? WHERE id=?";
    $datos=array ($nombre ,$telefono,$direccion,$mensaje,$id);
    $data=$this->save($sql,$datos);
    if ($data==1) {
        $res="ok";

        // code...
    }else{
        $res="error";
    }
    return $res;
}










    
}
?>