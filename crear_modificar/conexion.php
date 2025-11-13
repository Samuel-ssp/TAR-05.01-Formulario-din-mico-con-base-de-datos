<?php
require_once("configbd.php");

class Conexion{

    public $conexion;

    public function __construct(){

        try {
            $dsn ="mysql:host".SERVIDOR."bdname=".BBDD.":charset=utf8mb4";
            $this->conexion= new PDO($dsn,USUARIO,PASSWORD);
        } catch (PDOException $e) {
            die("Error de conexion:".$e->getMessage());
        }
        
    }


    public function __destruct(){

        $this->conexion = null;

    }
}