
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

    <form method="POST" action="index.php?c=Usuario&m=actualizar">
        <label>Nombre: <input type="text" name="nombre" value="<?=$datos['nombre'] ?> "></label><br><br>
        <label>Contraseña: <input type="text" name="contrasenia" value="<?= $datos['contrasenia'] ?> "></label><br><br>
        <input type="hidden" name="id" value="<?= $datos['id'] ?>">
        <input type="submit" value="Actualizar"/>
    </form>

    <p><a href="index.php?c=Usuario&m=mostrarUsuarios">Volver a usuarios</a></p>
</body>
</html>
