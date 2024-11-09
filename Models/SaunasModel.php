<?php
class SaunasModel extends Query{
private $numero_sauna, $tipo,$precio,$id,$estado;
    public function __construct()
    {
        parent::__construct();
    }
  

public function getSauna(){
    $sql="SELECT * FROM sauna";
    $data= $this->selectAll($sql);
        return $data;
}
public function registrarSauna(int $numero_sauna,string $tipo, string $precio)
{
    $this->numero_sauna=$numero_sauna;
    $this->tipo=$tipo;
    $this->precio=$precio;

  
    $sql="INSERT INTO sauna (numero_sauna,tipo,precio)VALUES(?,?,?)";///no funciona
    $datos=array($this->numero_sauna,$this->tipo,$this->precio);
    $data=$this->save($sql,$datos);

    if ($data==1) {
        $res="ok";

    }else{
        $res="error";
    }
   return $res;


}
public function modificarSauna(int $numero_sauna,string $tipo, string $precio,int $id)
{
    $this->numero_sauna=$numero_sauna;
    $this->tipo=$tipo;
    $this->precio=$precio;
   $this->id=$id;
   $sql="UPDATE sauna SET numero_sauna=?, tipo=?, precio=?  WHERE id_sauna=?";
   $datos=array($this->numero_sauna,$this->tipo,$this->precio, $this->id);
   $data=$this->save($sql,$datos);
   if ($data==1) {
       $res="modificado";
   }else{
    $res="Error";
   }

  return $res;
}

public function editarSauna(int $id)
{
    $sql="SELECT * FROM sauna WHERE id_sauna=$id";
    $data=$this->select($sql);
  return $data;
}
public function accionSauna(int $estado, int $id)
{
    $this->id=$id;
    $this->estado=$estado;
    
$sql="UPDATE sauna SET estado=? WHERE id_sauna=?";
$datos=array($this->estado,$this->id);
$data=$this->save($sql,$datos);
return $data;

}
public function buscarSauna(string $valor)
{
    $sql = "SELECT id_sauna,numero_sauna, tipo, precio FROM sauna WHERE numero_sauna LIKE '%" . $valor . "%' or tipo LIKE'%" . $valor . "%' AND estado = 1";
    $data = $this->selectAll($sql);
    return $data;
}









    
}
?>