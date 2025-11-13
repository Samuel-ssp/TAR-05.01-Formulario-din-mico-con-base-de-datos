<?php
require_once("usuario.php");

$usuarioObj = new Usuario();

// Validar que haya un ID
if (!isset($_GET['id'])) {
    exit("No se pasó el ID de usuario");
}

$id = $_GET['id'];

// Obtener datos del usuario
try {
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $usuarioObj->conexion->prepare($sql);
    $stmt->execute(['id' => $id]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC); // trae la fila como array

    if (!$usuario) {
        exit("Usuario no encontrado");
    }
} catch (PDOException $e) {
    exit("Error al obtener usuario: " . $e->getMessage());
}


// Si se envia el formulario ocurre esto
if (isset($_POST['actualizar'])) {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);

    if ($nombre == '' || $email == '') {
        $error = "Nombre y Email son obligatorios";
    } else {
        $sqlUpdate = "UPDATE usuarios SET nombre = :nombre, email = :email WHERE id = :id";
        $stmt = $usuarioObj->conexion->prepare($sqlUpdate);
        $stmt->execute([
            'nombre' => $nombre,
            'email' => $email,
            'id' => $id
        ]);
        $mensaje = "Usuario actualizado correctamente";
        // Recargar datos
        $usuario['nombre'] = $nombre;
        $usuario['email'] = $email;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>

    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>";//Si da error lo muestro ?>
    <?php if(isset($mensaje)) echo "<p style='color:green;'>$mensaje</p>";//Si se modifica tengo un mensaje y lo muestro ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <label>Nombre: <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>"></label><br><br>
        <label>Email: <input type="email" name="email" value="<?= $usuario['email'] ?>"></label><br><br>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>

    <p><a href="mostrar.php">Volver a usuarios</a></p>
</body>
</html>
