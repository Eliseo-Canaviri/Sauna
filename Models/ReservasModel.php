<?php
class ReservasModel extends Query
{
    private $fecha, $hora_inicio, $hora_fin, $id_usuario, $id_sauna, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }


    public function getReservas($id)
    {
        $sql = "SELECT re.* ,
us.nombres,
sa.tipo
FROM reservas AS re
INNER JOIN usuarios AS us
ON  re.id_usuario=us.id_usuario
INNER JOIN sauna AS sa
ON re.id_sauna=sa.id_sauna
WHERE re.id_usuario=$id 
";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getReservasAdmin($estado)
    {
        $sql = "SELECT re.* ,
us.nombres,
sa.tipo
FROM reservas AS re
INNER JOIN usuarios AS us
ON  re.id_usuario=us.id_usuario
INNER JOIN sauna AS sa
ON re.id_sauna=sa.id_sauna
WHERE  re.estado=$estado
";
        $data = $this->selectAll($sql);
        return $data;
    }


    public function registrarReservaPanel(string $fecha, string $hora_inicio, string $hora_fin, int $id_usuario, int $id_sauna, int $estado)
    {
        $this->fecha = $fecha;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->id_usuario = $id_usuario;
        $this->id_sauna = $id_sauna;
        $this->estado = $estado;

        //para verificar si existe usuario
        $verificar = "SELECT * FROM reservas WHERE hora_inicio='$this->hora_inicio' AND hora_fin='$this->hora_fin' AND id_sauna='$this->id_sauna '";
        $existe = $this->select($verificar);
        if (empty($existe)) {

            $sql = "INSERT INTO reservas(fecha,hora_inicio,hora_fin,id_usuario,id_sauna,estado)VALUES(?,?,?,?,?,?)"; ///no funciona
            $datos = array($this->fecha, $this->hora_inicio, $this->hora_fin, $this->id_usuario, $this->id_sauna, $this->estado);
            $data = $this->save($sql, $datos);

            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }

        return $res;
    }

    public function registrarReserva(string $fecha, string $hora_inicio, string $hora_fin, int $id_usuario, int $id_sauna)
    {
        $this->fecha = $fecha;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->id_usuario = $id_usuario;
        $this->id_sauna = $id_sauna;
        //para verificar si existe usuario
        $verificar = "SELECT * FROM reservas WHERE hora_inicio='$this->hora_inicio' AND hora_fin='$this->hora_fin' AND id_sauna='$this->id_sauna '";
        $existe = $this->select($verificar);
        if (empty($existe)) {

            $sql = "INSERT INTO reservas(fecha,hora_inicio,hora_fin,id_usuario,id_sauna)VALUES(?,?,?,?,?)"; ///no funciona
            $datos = array($this->fecha, $this->hora_inicio, $this->hora_fin, $this->id_usuario, $this->id_sauna);
            $data = $this->save($sql, $datos);

            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }

        return $res;
    }
    public function modificarReserva(string $fecha, string $hora_inicio, string $hora_fin, int $id_usuario, int $id_sauna, int $id)
    {
        $this->fecha = $fecha;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->id_usuario = $id_usuario;
        $this->id_sauna = $id_sauna;
        $this->id = $id;
        //para verificar si existe usuario
        $verificar = "SELECT * FROM reservas WHERE hora_inicio='$this->hora_inicio' AND hora_fin='$this->hora_fin' AND id_sauna='$this->id_sauna '";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "UPDATE reservas SET fecha=?, hora_inicio=?,hora_fin=?,id_usuario=?,id_sauna=? WHERE id_reserva=?";
            $datos = array($this->fecha, $this->hora_inicio, $this->hora_fin, $this->id_usuario, $this->id_sauna, $this->id);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "modificado";
            } else {
                $res = "Error";
            }
        } else {
            $res = "existe";
        }



        return $res;
    }

    public function editarReservas(int $id)
    {
        $sql = "SELECT re.* ,
us.nombres,
sa.tipo,
sa.precio
FROM reservas AS re
INNER JOIN usuarios AS us
ON  re.id_usuario=us.id_usuario
INNER JOIN sauna AS sa
ON re.id_sauna=sa.id_sauna
WHERE  re.id_reserva=$id AND re.estado=1";
        $data = $this->select($sql);
        return $data;
    }
    public function accionReservas(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;

        $sql = "UPDATE reservas SET estado=? WHERE id_reserva=?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }


    public function buscarCliente($valor)
    {
        $sql = "SELECT id_usuario, nombres,apellidos as text FROM usuarios WHERE nombres LIKE '%" . $valor . "%' AND estado = 1 OR apellidos LIKE '%" . $valor . "%'  AND estado = 1 LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }
    function getMaxIDReservar()
    {
        $sql = "SELECT MAX(id_reserva) AS id_reserva FROM reservas";
        $data = $this->select($sql);
        return $data;
    }



    public function getInstitucion(){
        $sql="SELECT * FROM institucion";
        $data= $this->select($sql);
            return $data;
    }
















}
