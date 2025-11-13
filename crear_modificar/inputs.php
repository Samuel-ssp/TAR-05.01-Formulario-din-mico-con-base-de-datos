<?php
require_once("conexion.php");

class Input extends Conexion{


    public function selectPaises() {

    try {
        // 1. Preparamos la consulta SQL
        $sql = "SELECT * FROM paises_select";
        
        // 2. Ejecutamos la consulta
        $stmt = $this->conexion->query($sql);
        
        
        foreach ($stmt as $pais) {
            echo '<option value="'.$pais["idpais"].'">'.$pais["contenido"].'</option>';
        }
        
        
    } catch (PDOException $e) {
        echo "Error al obtener países: ".$e->getMessage();
    }
}

    public function checkIntereses(){

        try{

            $sql="SELECT * FROM intereses_check";

            $stmt = $this->conexion->query($sql);


            foreach ($stmt as $interes){
                echo '<label><input type="checkbox" name="intereses[]" value="'.$interes["idinteres"].'">'.$interes["contenido"].'</label><br>';
            }
            
        }catch(PDOException $e){
            echo "Error al obtener los intereses: ".$e->getMessage();
        }
        
        
    }


}