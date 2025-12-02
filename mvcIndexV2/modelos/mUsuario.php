<?php
require_once(__dir__."/../confi/conexion.php");

class MUsuario extends Conexion {
    
   

    public function registrar($datos) {
        try {
            // 1. Insertar usuario  PDO
            $sqlUsuario = "INSERT INTO usuarios (nombre, email, genero, idpais, nacimiento) 
                          VALUES (:nombre, :email, :genero, :idpais, :nacimiento)";
            
            $stmt = $this->conexion->prepare($sqlUsuario);
            $stmt->execute([
                ':nombre' => $datos["nombre"],
                ':email' => $datos["email"],
                ':genero' => $datos["genero"],
                ':idpais' => $datos["pais"],
                ':nacimiento' => $datos["nacimiento"]
            ]);
            
            // 2. Obtener ID del usuario insertado Version PDO
            $usuario_id = $this->conexion->lastInsertId();
            
            // 3. Insertar intereses
            if (!empty($datos["intereses"])) {
                $sqlInteres = "INSERT INTO usuario_intereses (usuario_id, interes_id) 
                              VALUES (:usuario_id, :interes_id)";
                
                $stmtInteres = $this->conexion->prepare($sqlInteres);
                
                foreach ($datos["intereses"] as $idInteres) {
                    $stmtInteres->execute([
                        ':usuario_id' => $usuario_id,
                        ':interes_id' => $idInteres
                    ]);
                }
            }
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function obtenerUsuarios() {
        try{
            //Obtengo y devuelvo los usuarios
            $sql = "SELECT id,nombre,email FROM usuarios";
            $stmt = $this->conexion->query($sql);

            return  $stmt->fetchALL();

        }catch (PDOException $e) {

            echo "Error al mostrando usuarios: " . $e->getMessage();
        }
    }

    public function iniciar($datos){
        try {
            $sql = 'SELECT * FROM usuarios WHERE nombre  = :nombre AND email  = :email';
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(['nombre' => $datos["nombre"],
                            'email' => $datos["email"]]);
            $usuario = $stmt->fetch();
            if($usuario){
                return $usuario;
            }
            return false;
            
        } catch (PDOException $e) {

            throw new Exception("Error al obtener usuario: " . $e->getMessage());

        }
    }

    public function buscarId($id) {
        try {

            $sql = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(['id' => $id]);
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

    public function borrar($id) {
        try {

            $sqlDelete = "DELETE FROM usuarios WHERE id = :id";
            $stmt = $this->conexion->prepare($sqlDelete);
            $borrado = $stmt->execute(['id' => $id]);
            return  $borrado;

        } catch (PDOException $e) {

            throw new Exception("Error al eliminar usuario: " . $e->getMessage());

        }
    }

    public function actualizar($datos) {

        try {
            $sqlUpdate = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
            $stmt = $this->conexion->prepare($sqlUpdate);
            return $stmt->execute([
                ':nombre' => $datos["nombre"],
                ':email' => $datos["email"],
                ':id' => $datos["id"]
            ]);
        } catch (PDOException $e) {

            throw new Exception("Error al actualizndo usuario: " . $e->getMessage());
        }
    }
}
?>