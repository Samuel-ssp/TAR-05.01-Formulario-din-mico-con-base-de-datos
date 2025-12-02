
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial;
            background: #f2f2f2;
        }
        .contenedor-formulario {
            width: 300px;
            margin: 80px auto;
            padding: 20px;
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #3498db;
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <?php
        if(isset($_SESSION['error'])){
            echo '<div style="color: red">'.$_SESSION['error'].'</div>';
            unset($_SESSION['error']);  // Borra  error
        }
    ?>
    <div class="contenedor-formulario">
        <h3>Iniciar Sesión</h3>
        <form action="login.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
