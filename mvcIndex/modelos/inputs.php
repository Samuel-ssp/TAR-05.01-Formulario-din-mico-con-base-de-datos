<?php
require_once(__dir__."/../confi/conexion.php");

class Input extends Conexion{


    public function selectPaises() {

    try {
        // 1. Preparamos la consulta SQL
        $sql = "SELECT * FROM paises_select";
        
        // 2. Ejecutamos la consulta
        $stmt = $this->conexion->query($sql);
        
        return $stmt;
        
    } catch (PDOException $e) {
        echo "Error al obtener países: ".$e->getMessage();
    }
}

    public function checkIntereses(){

        try{

            $sql="SELECT * FROM intereses_check";

            $stmt = $this->conexion->query($sql);

            return $stmt;
        }catch(PDOException $e){
            echo "Error al obtener los intereses: ".$e->getMessage();
        }
        
        
    }


}