<?php
require_once"conexion.php";

class Input extends Conexion{


    public function selectPaises() {

    try {
        // 1. Preparamos la consulta SQL
        $sql = "SELECT * FROM paises_select";
        
        // 2. Ejecutamos la consulta
        $stmt = $this->conexion->query($sql);
        
        // 3. Obtenemos todos los resultados como array asociativo
        $paises = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($paises as $pais) {
            echo '<option value="'.$pais["abreviatura"].'">"'.$pais["contenido"].'"</option>';
        }
        
        
    } catch (PDOException $e) {
        echo "Error al obtener países: ".$e->getMessage();
    }
}

    public function checkIntereses(){

        try{

            $sql="SELECT * FROM intereses_check";

            $stmt = $this->conexion->query($sql);

            $intereses = $stmt->fetchALL(PDO::FETCH_ASSOC);

            foreach ($intereses as $interes){
                echo '<input type="checkbox" name="intereses[]" value="'.$interes["idinteres"].'">"'.$interes["contenido"].'"';
            }
            
        }catch(PDOException $e){
            echo "Error al obtener los intereses: ".$e->getMessage();
        }
        
        
    }


}