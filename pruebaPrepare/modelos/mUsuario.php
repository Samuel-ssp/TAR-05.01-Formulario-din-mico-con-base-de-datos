<?php
require_once("conexion.php");
class MUsuario extends Conexion {

    public function registrar() {
        try {
            // 1. Insertar usuario  PDO
            $sqlUsuario = "INSERT INTO usuarios (nombre, contrasenia) 
                        VALUES (:nombre, :contrasenia)";
            
            $stmt = $this->conexion->prepare($sqlUsuario);
            
            return  $stmt->execute([
                ':nombre' => $_POST["nombre"],
                ':contrasenia' => $_POST["pw"]
            ]); 
            
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function obtenerUsuarios() {
        try{
            //Obtengo y devuelvo los usuarios
            $sql = "SELECT idUsuario,nombre,contrasenia FROM usuarios";
            $stmt = $this->conexion->query($sql);

            return  $stmt->fetchALL();

        }catch (PDOException $e) {

            echo "Error al mostrando usuarios: " . $e->getMessage();
        }
    }

    public function iniciarQuery(){
    try {
        
        $sql = 'SELECT * FROM usuarios WHERE nombre ="'.$_POST["nombre"].'" AND contrasenia = "'.$_POST["nombre"].'"';
        
        $resultado = $this->conexion->query($sql);
        
        return $resultado;

    } catch (PDOException $e) {

        throw new Exception("Error al obtener usuario: " . $e->getMessage());

    }
}

    public function iniciarPrepare(){
        echo "PREPARE";
        try {
            $sql = 'SELECT * FROM usuarios WHERE nombre  = :nombre AND contrasenia  = :contrasenia';
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(['nombre' => $_POST["nombre"],
                            'contrasenia' => $_POST["pw"]]);
            $usuario = $stmt->fetch();
            if($usuario){
                return $usuario;
            }
            return false;
            
        } catch (PDOException $e) {

            throw new Exception("Error al obtener usuario: " . $e->getMessage());

        }
    }
}
?>