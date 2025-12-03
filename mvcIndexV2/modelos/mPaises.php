<?php
require_once("conexion.php");

class MPaises extends Conexion{


    public static function selectPaises() {

    try {
        // 1. Preparamos la consulta SQL
        $sql = "SELECT * FROM paises";
        
        // 2. Ejecutamos la consulta
        //Al ser estatico no puedo acceder a las ariables del conexion 
        $conexion = new Conexion();
        $stmt = $conexion->conexion->query($sql);
        
        return $stmt;
        
    } catch (PDOException $e) {
        echo "Error al obtener países: ".$e->getMessage();
    }
}


}