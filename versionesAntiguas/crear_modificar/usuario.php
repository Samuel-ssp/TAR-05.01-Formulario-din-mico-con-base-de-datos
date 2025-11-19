<?php
require_once("conexion.php");

class Usuario extends Conexion {
    
    private $nombre;
    private $email;
    private $genero;
    private $pais;
    private $nacimiento;
    private $intereses;

    public function comprobar() {
        // Asignar valores a las propiedades
        $this->nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : '';
        $this->email = isset($_POST["email"]) ? trim($_POST["email"]) : '';
        $this->genero = isset($_POST["genero"]) ? $_POST["genero"] : '';
        $this->pais = isset($_POST["pais"]) ? $_POST["pais"] : '';
        $this->nacimiento = isset($_POST["nacimiento"]) ? $_POST["nacimiento"] : '';
        $this->intereses = isset($_POST["intereses"]) ? $_POST["intereses"] : [];

        // Validar campos obligatorios
        if ($this->nombre == '') {
            echo '<h1><a href="formulario.php">Volver al formulario</a></h1>';
            exit("No se rellenó el campo nombre");
        }
        if ($this->email == '') {
            echo '<h1><a href="formulario.php">Volver al formulario</a></h1>';
            exit("No se rellenó el campo email");
        }
        if (empty($this->intereses)) {
            echo '<h1><a href="formulario.php">Volver al formulario</a></h1>';
            exit("No tienes intereses seleccionados");
        }
        if ($this->pais == '') {
            echo '<h1><a href="formulario.php">Volver al formulario</a></h1>';
            exit("No se seleccionó país");
        }

        return true;
    }

    public function registrar() {
        try {
            // 1. Insertar usuario  PDO
            $sqlUsuario = "INSERT INTO usuarios (nombre, email, genero, idpais, nacimiento) 
                          VALUES (:nombre, :email, :genero, :idpais, :nacimiento)";
            
            $stmt = $this->conexion->prepare($sqlUsuario);
            $stmt->execute([
                ':nombre' => $this->nombre,
                ':email' => $this->email,
                ':genero' => $this->genero,
                ':idpais' => $this->pais,
                ':nacimiento' => $this->nacimiento
            ]);
            
            // 2. Obtener ID del usuario insertado Version PDO
            $usuario_id = $this->conexion->lastInsertId();
            
            // 3. Insertar intereses
            if (!empty($this->intereses)) {
                $sqlInteres = "INSERT INTO usuario_intereses (usuario_id, interes_id) 
                              VALUES (:usuario_id, :interes_id)";
                
                $stmtInteres = $this->conexion->prepare($sqlInteres);
                
                foreach ($this->intereses as $idInteres) {
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

    public function mostrarUsuario($id) {
        try{

            $sql = "SELECT u.id, u.nombre, u.email FROM usuarios u";
            $stmt = $this->conexion->query($sql);

            foreach ($stmt as $usuario) {

                echo '<div>';
                echo 'Nombre: <strong>' . $usuario["nombre"] . '</strong> ';
                echo 'Email: <strong>' . $usuario["email"] . '</strong> ';

                // BOTÓN MODIFICAR (GET)
                echo '<a href="editar_usuario.php?id=' . $usuario["id"] . '">
                        <button type="button">Modificar</button>
                    </a> ';

                // BOTÓN BORRAR (DEBE)
                echo '
                    <form action="borrar_usuario.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="'. $usuario["id"] .'">
                        <button type="submit">
                            Borrar
                        </button>
                    </form>
                ';

                echo '</div>';
            }

        }catch (PDOException $e) {

            echo "Error al mostrando usuarios: " . $e->getMessage();
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

    public function actualizar($id, $nombre, $email) {
        try {
            $sqlUpdate = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
            $stmt = $this->conexion->prepare($sqlUpdate);
            return $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':id' => $id
            ]);
        } catch (PDOException $e) {

            throw new Exception("Error al actualizndo usuario: " . $e->getMessage());
        }
    }
}
?>