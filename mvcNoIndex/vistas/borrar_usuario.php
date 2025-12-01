<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar Usuario</title>
</head>
<body>
    <h1>Borrar Usuario</h1>

    <?php if(!empty($mensaje)) { ?>
        <p style="color:green;"><?= $mensaje ?></p>
        <p><a href="mostrar.php">Volver a usuarios</a></p>
    <?php } else { ?>
        <p>¿Estás seguro que deseas borrar este usuario?</p>
        <p><strong>Nombre:</strong> <?=   $usuario['nombre'] ?></p>
        <p><strong>Email:</strong> <?=   $usuario['email'] ?></p>

        <form method="index.php?accion=borrado&id=$id">
            <input type="hidden" name="id" value="<?=  $id ?>">
            <button type="submit" name="borrar">Borrar</button>
            <a href="mostrar.php">Cancelar</a>
        </form>
    <?php } ?>
</body>
</html>
