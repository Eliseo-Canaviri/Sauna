<?php
class UsuariosModel extends Query{
   private $ci,$nombres,$apellidos, $email, $telefono, $usuario, $clave,$id,$estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario(string $usuario, string $clave ,int $estado)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave' AND estado=$estado ";
        $data = $this->select($sql);
        return $data;
    }


public function getUsuarios( $estado){
    $sql="SELECT * FROM usuarios WHERE estado= $estado";
    $data= $this->selectAll($sql);
        return $data;
}

public function registrarUsuario(int $ci,string $nombres,string $apellidos, string $email,string $telefono, string $usuario, string $clave)
{
    $this->ci=$ci;
    $this->nombres=$nombres;
    $this->apellidos=$apellidos;
     $this->email=$email;
     $this->telefono=$telefono;
      $this->usuario=$usuario;
       $this->clave=$clave;
       //para verificar si existe usuario
       $verificar="SELECT *FROM usuarios WHERE usuario='$this->usuario'";
       $existe=$this->select($verificar);
       if (empty($existe)) {
           $sql= "INSERT INTO usuarios(ci,nombres,apellidos, email, telefono,usuario, clave) VALUES (?,?,?,?,?,?,?)";
       $datos=array($this->ci, $this->nombres, $this->apellidos, $this->email, $this->telefono, $this->usuario, $this->clave);///estos valores se lo vamos enviar a un metodo que vamos crear en el archivo Quiery.
       $data=$this->save($sql,$datos);
       if ($data==1) {
           $res ="ok";
       }else{
        $res ="error";
       }  
       }else{
        $res="existe";
       }

     
       return $res ; 
       //este meotodo vamos llamar desde nuestro controlador usuario

}
public function modificarUsuario(int $ci,string $nombres, string $apellidos,string $email, int $telefono, string $usuario, int $id)
{
    $this->ci=$ci;
    $this->nombres=$nombres;
    $this->apellidos=$apellidos;
     $this->email=$email;
     $this->telefono=$telefono;
      $this->usuario=$usuario;
       $this->id=$id;
       //para verificar si existe usuario
         $sql= "UPDATE  usuarios SET ci=?, nombres=?, apellidos=?, email=?, telefono=?, usuario=? WHERE id_usuario=?";
       $datos=array($this->ci, $this->nombres, $this->apellidos, $this->email, $this->telefono, $this->usuario, $this->id);///estos valores se lo vamos enviar a un metodo que vamos crear en el archivo Quiery.
       $data=$this->save($sql,$datos);
       if ($data==1) {
           $res ="modificado";
       }else{
        $res ="error";
       } 
      

     
       return $res ; 
       //este meotodo vamos llamar desde nuestro controlador usuario

}

public function editarUser(int $id)
{//este metodo vamos llamar de controlador
  $sql= "SELECT * FROM usuarios WHERE id_usuario= $id";
 $data= $this->select($sql);

 return $data;
}
public function getPass(string $clave, int $id)
{//este metodo vamos llamar de controlador
  $sql= "SELECT * FROM usuarios WHERE clave= '$clave' AND id_usuario= $id";
 $data= $this->select($sql);

 return $data;
}

public function accionUser(int $estado ,int $id )
{
    // code...
    $this->id=$id;
    $this->estado=$estado;
    $sql="UPDATE usuarios SET estado= ? WHERE id_usuario=?";
    $datos=array($this->estado, $this->id);
    $data=$this->save($sql,$datos);
    return $data;
}

public function modificarPass(string $clave, int $id)
{
  
    $sql="UPDATE usuarios SET clave= ? WHERE id_usuario=?";
    $datos=array($clave, $id);
    $data=$this->save($sql,$datos);
    return $data;
    // code...
}

public function buscarUsuario(string $valor)
{
    $sql = "SELECT id_usuario,ci, nombres, apellidos FROM usuarios WHERE ci LIKE '%" . $valor . "%' or nombres LIKE'%" . $valor . "%' AND estado = 1";
    $data = $this->selectAll($sql);
    return $data;
}





    
}
?>