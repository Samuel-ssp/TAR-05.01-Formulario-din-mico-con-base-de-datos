<?php
require_once("usuario.php");
 $id = isset($_GET["id"]) ? $_GET["id"] : null;
 $usuario = new Usuario();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar usuarios</title>
</head>
<body>
    <h1>Usuarios registrados</h1>
    <?php  
        $usuario->mostrarUsuario($id);
    ?> 
</body>
</html>