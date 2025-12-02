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
        <p><a href="index.php?accion=usuarios">Volver a usuarios</a></p>
    <?php } else { ?>
        <p>¿Estás seguro que deseas borrar este usuario?</p>
        <p><strong>Nombre:</strong> <?=   $usuario['nombre'] ?></p>
        <p><strong>Email:</strong> <?=   $usuario['email'] ?></p>

        <a href="index.php?accion=borrado&id=<?= $id ?>"><button>Borrar</button></a>
        <a href="index.php?accion=usuarios">Cancelar</a>
    <?php } ?>
</body>
</html>
