<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mostrar usuarios</title>
</head>
<body>
    <h1>Usuarios registrados</h1>
    <?php  
    
        if (isset($usuarios) && is_array($usuarios)) {
            foreach ($usuarios as $usuario) {
                echo '<div>
                        Nombre: <strong>' . $usuario["nombre"] . '</strong> 
                        Email: <strong>' . $usuario["email"] . '</strong> 
                        <a href="index.php?id=' . $usuario["id"] . '&accion=editar">
                            <button>Modificar</button>
                        </a> 
                        <a href="index.php?id=' . $usuario["id"] . '&accion=borrar">
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