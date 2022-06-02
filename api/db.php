<?php
include_once("../paginas/conexion.php");

class DB
{
    private $db_host;
    private $db_database;
    private $db_user;
    private $db_password;
    private $openTransaction;
    private $mysqli;

    function __construct($db_host, $db_database, $db_user, $db_password)
    {
        $this->db_host = $db_host;
        $this->db_database = $db_database;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
        $this->openTransaction = false;
    }

    private function sqlErrorsToString($errors)
    {
        if ($this->mysqli->mysqliect_error) {
            die('Error de Conexión (' . $this->mysqli->mysqliect_errno . ')'
                . $this->mysqli->mysqliect_error);
        }
    }

    public function conectarDB()
    {
        $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_password,  $this->db_database);
        if (!$this->mysqli) throw new Exception("No se pudo establecer la conexión con la base de datos: " . $this->sqlErrorsToString($this->mysqli->errors()));
    }


    public function desconectarDB()
    {
        if ($this->mysqli) $this->mysqli->close();
    }

    public function beginTransaction()
    {
        $this->openTransaction = $this->mysqli->begin_transaction();
        return $this->openTransaction;
    }

    public function commitTransaction()
    {
        if ($this->openTransaction) $this->mysqli->commit();
        $this->openTransaction = false;
    }

    public function rollbackTransaction()
    {
        if ($this->openTransaction) $this->mysqli->rollback();
        $this->openTransaction = false;
    }

    public function closeQuery($r)
    {
        if ($r) $r->free();
    }

    public function doQuery($sql, $values = array())
    {

        $type = array_reduce($values, array($this, "getTypeOfValues"));

        $stmt =  $this->mysqli->prepare($sql);

        if ($type) {

            $stmt->bind_param($type, ...$values);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        if (!$result &&  $this->mysqli->errno != 0) {

            throw new Exception("Hubo un problema accediendo a la base de datos ($sql, params:" . print_r($values, true) . "): " .  $this->mysqli->error);
        }

        return $result;
    }

    private function getTypeofValues($string, $value)
    {

        if (is_float($value)) {
            $string .= "d";
        } elseif (is_integer($value)) {
            $string .= "i";
        } elseif (is_string($value)) {
            $string .= "s";
        } else {
            $string .= "b";
        }

        return $string;
    }

    public function doExecute($sql, $params = array(), $getIdentity = false)
    {
        $id = -1;
        $s = $sql;
        if ($getIdentity) $s .= ";SELECT SCOPE_IDENTITY()";
        $r = $this->doQuery($s, $params);
        if ($getIdentity) {
            $this->mysqli->next_result($r);
            $this->mysqli->fetch($r);
            $id = $this->mysqli->get_field($r, 0);
        }
        if($r) $r->free();
        return $id;
    }

    public function getSQLValue($sql, $params = array())
    {
        $s = "";
        $r = $this->doQuery($sql, $params);
        if ($r->num_rows>0) {
            $fila = $r->fetch_assoc();
            $s = reset($fila);
        }
        $r->free();
        return $s;
    }

    public function getSQLRegister($sql, $params = array())
    {
        $fila = false;
        $r = $this->doQuery($sql, $params);
        if ($r->num_rows>0) {
            $fila = $r->fetch_assoc();
        }
        $r->free();
        return $fila;
    }

    function query2Data($r, $titulo, $motivo)
    {
        if ($r->num_rows>0) {
            $fila = $r->fetch_assoc();
            $data['estado'] = "success";
            $data['tipo'] = "tabla";
            $data['titulo'] = $titulo;
            $data['cabeceras'] = array_keys($fila);
            $data['filas'][] = array_values($fila);
            while ($fila = $r->fetch_assoc()) {
                $data['filas'][] = array_values($fila);
            }
        } else {
            $data = array('estado' => 'warning', 'errorTitulo' => $titulo, 'errorMensaje' => $motivo);
        }
        return $data;
    }
}
