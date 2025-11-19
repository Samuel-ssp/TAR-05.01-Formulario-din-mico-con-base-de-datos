<?php
require_once("usuario.php");

$usuarioObj = new Usuario();

// Comprobar que haya un ID
if (!isset($_GET['id'])) {

    exit("No se pasó el ID del usuario");
}

$id = $_GET['id'];

// Obtener datos del usuario 
try {
    $usuario = $usuarioObj->buscarId($id);
    if (!$usuario) {
        exit("Usuario no encontrado");
    }
} catch (Exception $e) {
    exit($e->getMessage());
}

// Tras darle a actualizar
if (isset($_POST['actualizar'])) {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);

    if ($nombre == '' || $email == '') {
        $error = "Nombre y Email son obligatorios";
    } else {
        try {
            $usuarioObj->actualizar($id, $nombre, $email);
            $mensaje = "Usuario actualizado correctamente";
            // Muestro los nuevos datos
            $usuario['nombre'] = $nombre;
            $usuario['email'] = $email;
        } catch (Exception $e) {

            $error = $e->getMessage();
        }
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

    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if(isset($mensaje)) echo "<p style='color:green;'>$mensaje</p>"; ?>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <label>Nombre: <input type="text" name="nombre" value="<?php echo  $usuario['nombre'] ?>"></label><br><br>
        <label>Email: <input type="email" name="email" value="<?php echo  $usuario['email'] ?>"></label><br><br>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>

    <p><a href="mostrar.php">Volver a usuarios</a></p>
</body>
</html>
