<?php
require_once("usuario.php");

$usuarioObj = new Usuario();

if (!isset($_POST['id'])) {
    exit("No se ha pasado el ID del usuario");
}

$id = $_POST['id'];

// Buscar usuario
$usuario = $usuarioObj->buscarId($id);
if (!$usuario) {
    exit("Usuario no encontrado");
}

// Si se presiona el botón borrar
if (isset($_POST['borrar'])) {
    try {
        $usuarioObj->borrar($id);
        $mensaje = "Usuario eliminado correctamente";
    } catch (Exception $e) {
        $mensaje = $e->getMessage();
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
        <p><strong>Nombre:</strong> <?php echo $usuario['nombre'] ?></p>
        <p><strong>Email:</strong> <?php echo $usuario['email'] ?></p>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo  $id ?>">
            <button type="submit" name="borrar">Borrar</button>
            <a href="mostrar.php">Cancelar</a>
        </form>
    <?php } ?>
</body>
</html>
