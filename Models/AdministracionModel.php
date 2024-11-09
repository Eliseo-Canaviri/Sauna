<?php
class AdministracionModel extends Query{
 
    public function __construct()
    {
        parent::__construct();
    }
  

public function getDatos(string $table ){
    $sql="SELECT COUNT(*) AS total FROM $table WHERE estado = 1";
    $data= $this->select($sql);
        return $data;
}
public function getDatosCurso(string $table ){
    $sql="SELECT COUNT(*) AS total FROM $table ";
    $data= $this->select($sql);
        return $data;
}
public function GetSauna(int $estado){
    $sql="SELECT * FROM sauna WHERE estado=$estado";
    $data= $this->selectAll($sql);
        return $data;
}
public function getHoras(int $estado,int $id_sauna){
    
    $sql="SELECT * FROM reservas WHERE id_sauna=$id_sauna AND estado=$estado ORDER BY hora_inicio";
    $data= $this->selectAll($sql);
        return $data;
}








    
}
?>