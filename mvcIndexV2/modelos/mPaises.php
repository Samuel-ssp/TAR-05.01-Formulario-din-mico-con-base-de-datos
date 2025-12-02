<?php
require_once(__dir__."/../confi/conexion.php");

class MPaises extends Conexion{


    public function selectPaises() {

    try {
        // 1. Preparamos la consulta SQL
        $sql = "SELECT * FROM paises";
        
        // 2. Ejecutamos la consulta
        $stmt = $this->conexion->query($sql);
        
        return $stmt;
        
    } catch (PDOException $e) {
        echo "Error al obtener países: ".$e->getMessage();
    }
}


}