<?php
require_once("conexion.php");

class MUsuario extends Conexion {

    public function registrar() {
        try {
            // 1. Insertar usuario  PDO
            $sqlUsuario = "INSERT INTO usuarios (nombre, contrasenia, pais_id) 
                        VALUES (:nombre, :contrasenia, :pais_id)";
            
            $stmt = $this->conexion->prepare($sqlUsuario);
            
            return  $stmt->execute([
                ':nombre' => $_POST["nombre"],
                ':contrasenia' => $_POST["pw"],
                ':pais_id' => $_POST["pais"]
            ]); 
             
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function obtenerUsuarios() {
        try{
            //Obtengo y devuelvo los usuarios
            $sql = "SELECT id,nombre,contrasenia FROM usuarios";
            $stmt = $this->conexion->query($sql);

            return  $stmt->fetchALL();

        }catch (PDOException $e) {

            echo "Error al mostrando usuarios: " . $e->getMessage();
        }
    }

    public function iniciar(){
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

    public function buscarId() {
        try {

            $sql = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':id' => $_GET["id"]]);
            $usuario = $stmt->fetch(); // devuelve primera fila
            if ($usuario) {
                return $usuario;
            } else {
                return null;
            }

        } catch (PDOException $e) {

            throw new Exception("Error al obtener usuario: " . $e->getMessage());

        }
    }

    public function borrar() {
        try {

            $sqlDelete = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->conexion->prepare($sqlDelete);
            $borrado = $stmt->execute([':id' => $_GET["id"]]);
            return  $borrado;

        } catch (PDOException $e) {

            throw new Exception("Error al eliminar usuario: " . $e->getMessage());

        }
    }

    public function actualizar() {

        try {
            $sqlUpdate = "UPDATE usuarios SET nombre = :nombre, contrasenia = :contrasenia WHERE id = :id";
            $stmt = $this->conexion->prepare($sqlUpdate);
            return $stmt->execute([
                ':nombre' => $_POST["nombre"],
                ':contrasenia' => $_POST["contrasenia"],
                ':id' => $_POST["id"]
            ]);
        } catch (PDOException $e) {

            throw new Exception("Error al actualizndo usuario: " . $e->getMessage());
        }
    }
}
?>