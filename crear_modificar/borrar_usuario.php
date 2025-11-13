<?php
require_once("usuario.php");

$usuarioObj = new Usuario();

if (!isset($_GET['id'])) {
    exit("No se pasó el ID de usuario");
}

$id = $_GET['id'];

try {
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $stmt = $usuarioObj->conexion->prepare($sql);
    $stmt->execute(['id' => $id]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC); // Se trae las filas como array asociado

    if (!$usuario) {
        exit("Usuario no encontrado");
    }
} catch (PDOException $e) {
    exit("Error al obtener usuario: " . $e->getMessage());
}


// Si se presiona el botón borrar
if (isset($_POST['borrar'])) {
    try {
        $sqlDelete = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $usuarioObj->conexion->prepare($sqlDelete);
        $stmt->execute(['id' => $id]);
        $mensaje = "Usuario eliminado correctamente";
    } catch (PDOException $e) {
        $mensaje = "Error al eliminar usuario: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar Usuario</title>
</head>
<body>
    <h1>Borrar Usuario</h1>

    <?php if(isset($mensaje)) { ?>
        <p style="color:green;"><?= $mensaje ?></p>
        <p><a href="mostrar.php">Volver a usuarios</a></p>
    <?php } else { ?>
        <p>¿Estás seguro que deseas borrar este usuario?</p>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>

        <form method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <button type="submit" name="borrar">Borrar</button>
            <a href="mostrar.php">Cancelar</a>
        </form>
    <?php } ?>
</body>
</html>
