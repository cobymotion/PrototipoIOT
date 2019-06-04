<?php

/***
 * Class Conexion
 * Genera la conexion con los datos prestablecidos en el archivo
 * Luis Cobián
 * 2 De junio
 */

class Conexion
{
    private $host;
    private $user;
    private $pass;
    private $db;
    public $clave_enc;

    public function __construct($d){
        $this->host = $d['host'];
        $this->user = $d['user'];
        $this->pass = $d['pass'];
        $this->db = $d['db'];
    }

    public function getConnection()
    {

        $conn = "";
        try {
            $conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
            $conn = $ex->getMessage();
        }
        return $conn;

    }
}