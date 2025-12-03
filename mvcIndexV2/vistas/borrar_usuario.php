<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar Usuario</title>
</head>
<body>
    <h1>Borrar Usuario</h1>

        <p>¿Estás seguro que deseas borrar este usuario?</p>
        <p><strong>Nombre:</strong> <?=   $datos['nombre'] ?></p>
        <p><strong>Contraseña:</strong> <?=   $datos['contrasenia'] ?></p>

        <a href="index.php?c=Usuario&m=borrar&id=<?= $_GET["id"] ?>"><button>Borrar</button></a>
        <a href="index.php?c=Usuario&m=mostrarUsuarios">Cancelar</a>
</body>
</html>
