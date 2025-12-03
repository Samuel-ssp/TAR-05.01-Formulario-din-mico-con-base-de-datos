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
                        <a href="index.php?id=' . $usuario["id"] . '&m=mostrarEditar&c=Usuario">
                            <button>Modificar</button>
                        </a> 
                        <a href="index.php?id=' . $usuario["id"] . '&m=mostrarBorrar&c=Usuario">
                            <button>Borrar</button>
                        </a> 
                    </div>';
            }
        } else {
            echo "No hay usuarios";
        }
    ?> 
</body>
</html>