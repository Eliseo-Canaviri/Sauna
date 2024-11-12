<?php
class ReportesModel extends Query
{
    private $numero_sauna, $tipo, $precio, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }


    public function FiltrarFecha($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT re.* ,
sa.tipo,
sa.precio,
us.nombres,
us.apellidos,
pr.total_pre
FROM reservas AS re
INNER JOIN sauna AS sa  
ON  re.id_sauna=sa.id_sauna
INNER JOIN usuarios AS us 
ON re.id_usuario=us.id_usuario
INNER JOIN preciototal AS pr
ON re.id_reserva=pr.id_reserva
WHERE re.fecha >= '$fecha_inicio' AND re.fecha <= '$fecha_fin' AND re.estado=1";
        $data = $this->selectAll($sql);
        return $data;
    }
    function PrecioTotal($fecha_inicio, $fecha_fin)
    {
        $sql = "SELECT SUM(pr.total_pre) AS pretotal
        FROM reservas as re 
        INNER JOIN preciototal as pr
        ON re.id_reserva=pr.id_reserva
        WHERE fecha >= '$fecha_inicio' AND fecha <='$fecha_fin'AND  re.estado=1";
        $data = $this->select($sql);
        return $data;
    }


    public function sauna()
    {
        $sql = "SELECT * FROM institucion ";
        $data = $this->select($sql);
        return $data;
    }

    function alertaHoras()
    {

        $sql = "SELECT re.*,
us.nombres,
sa.tipo
FROM reservas AS re 
INNER JOIN usuarios AS us 
ON re.id_usuario= us.id_usuario
INNER JOIN sauna AS sa 
ON re.id_sauna= sa.id_sauna
WHERE re.fecha = CURRENT_DATE 
  AND re.hora_inicio BETWEEN NOW() AND NOW() + INTERVAL 10 MINUTE and re.estado=2";
        $data = $this->selectAll($sql);
        return $data;
    }














    public function registrarSauna(int $numero_sauna, string $tipo, string $precio)
    {
        $this->numero_sauna = $numero_sauna;
        $this->tipo = $tipo;
        $this->precio = $precio;


        $sql = "INSERT INTO sauna (numero_sauna,tipo,precio)VALUES(?,?,?)"; ///no funciona
        $datos = array($this->numero_sauna, $this->tipo, $this->precio);
        $data = $this->save($sql, $datos);

        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function modificarSauna(int $numero_sauna, string $tipo, string $precio, int $id)
    {
        $this->numero_sauna = $numero_sauna;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->id = $id;
        $sql = "UPDATE sauna SET numero_sauna=?, tipo=?, precio=?  WHERE id_sauna=?";
        $datos = array($this->numero_sauna, $this->tipo, $this->precio, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "Error";
        }

        return $res;
    }

    public function editarSauna(int $id)
    {
        $sql = "SELECT * FROM sauna WHERE id_sauna=$id";
        $data = $this->select($sql);
        return $data;
    }
    public function accionSauna(int $estado, int $id)
    {
        $this->id = $id;
        $this->estado = $estado;

        $sql = "UPDATE sauna SET estado=? WHERE id_sauna=?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function buscarSauna(string $valor)
    {
        $sql = "SELECT id_sauna,numero_sauna, tipo, precio FROM sauna WHERE numero_sauna LIKE '%" . $valor . "%' or tipo LIKE'%" . $valor . "%' AND estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }
}
