<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar usuarios</title>
</head>
<body>
    <h1>Usuarios registrados</h1>
    <?php  
    
        if (isset($datos) && is_array($datos)) {
            foreach ($datos as $usuario) {
                echo '<div>
                        Nombre: <strong>' . $usuario["nombre"] . '</strong> 
                        Contraseña: <strong>' . $usuario["contrasenia"] . '</strong> 
                    </div>';
            }
        } else {
            echo "No hay usuarios";
        }
    ?> 
    <a href="index.php">Salir</a>
</body>
</html>