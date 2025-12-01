
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
        <label>Nombre: <input type="text" name="nombre" value="<?=$usuario['nombre']  ?> "></label><br><br>
        <label>Email: <input type="email" name="email" value="<?= $usuario['email']  ?> "></label><br><br>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>

    <p><a href="mostrar.php">Volver a usuarios</a></p>
</body>
</html>
