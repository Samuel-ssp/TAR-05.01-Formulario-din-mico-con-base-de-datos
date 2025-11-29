<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php
        if(isset($_SESSION['error'])){
            echo '<div style="color: red">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']);  // Borra  error
        }
    ?>
        <form method="post" action="index.php?accion=iniciar">
            Usuario:<br>
            <input type="text" name="nombre"><br><br>

            Correo:<br>
            <input type="email" name="email"><br><br>

            <input type="submit" value="Entrar">
        </form>
        <a href="index.php?accion=registro">Regístrate aquí</a>
</body>
</html>